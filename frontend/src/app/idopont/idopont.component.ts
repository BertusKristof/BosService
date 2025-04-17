import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../api.service';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { ChangeDetectorRef } from '@angular/core';

@Component({
  selector: 'app-idopont',
  standalone: true,
  templateUrl: './idopont.component.html',
  styleUrls: ['./idopont.component.css'],
  imports: [CommonModule, FormsModule]
})
export class IdopontComponent implements OnInit { 
  appointmentData = {contact_name: '', appointment_service: '', appointment_date: '', appointment_time: ''};
  selectedService: string = '';
  selectedDate: string  = '';
  selectedTime: string = '';
  summary: string = '';
  minDate: string = '';
  timeSlots: string[] = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
  bookedTimes: string[] = [];
  originalTimeSlots: string[] = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
  carData = { license_plate: '', brand: '', model: '', year: ''};
  appointment_id: string | null = null;
  errorMessage = '';
  showCarModal: boolean = false;

  constructor(private apiService: ApiService, private router: ActivatedRoute, private http: HttpClient, private cdr: ChangeDetectorRef) {}
  
  selectService(service: string) {
    this.selectedService = service;
    this.updateSummary();
  }

  selectTime(time: string) {
    this.selectedTime = time;
    this.updateSummary();
  }

  selectDate(event: any) {
    const inputElement = event.target as HTMLInputElement;
    this.selectedDate = event.target.value;

    this.timeSlots = [...this.originalTimeSlots];

    this.apiService.getBookedTimes(this.selectedDate).subscribe({
      next: (times) => {
        this.bookedTimes = times;
        this.updateAvailableTimes();
        this.cdr.detectChanges(); 
      },
      error: () => {
        console.error('Nem sikerült a foglalt időpontokat lekérni');
      }
    });
    this.updateSummary();
  }
  
  updateAvailableTimes() {
    this.timeSlots = this.originalTimeSlots.filter(time => !this.bookedTimes.includes(time));
    this.cdr.detectChanges(); 
  }

  updateSummary() {
    this.summary = `
      Szolgáltatás: ${this.selectedService || 'Nincs kiválasztva'}
      Dátum: ${this.selectedDate || 'Nincs kiválasztva'}
      Időpont: ${this.selectedTime || 'Nincs kiválasztva'}
    `;
  }

  openCarModal() {
    this.showCarModal = true;
  }

  closeCarModal() {
    this.showCarModal = false;
  }

  submitCarModal() {
    if (!this.carData.license_plate || !this.carData.brand || !this.carData.model || !this.carData.year) {
      alert('Kérlek, töltsd ki az összes mezőt az autó adataihoz!');
      return;
    }
  
    this.apiService.updateCar(Number(localStorage.getItem('userId')), this.carData).subscribe({
      next: () => {
        this.closeCarModal();
        window.location.reload(); 
      },
      error: (error) => {
        console.error('Hiba történt az autó adatok mentése során:', error);
      },
    });
  }

  confirmBooking() {
    if (!this.selectedService || !this.selectedDate || !this.selectedTime) {
      alert("Kérlek, töltsd ki az összes mezőt!");
      return;
    }
  
    const bookingData = {
      service: this.selectedService,
      date: this.selectedDate,
      time: this.selectedTime,
    };
  
    this.apiService.appointment(Number(localStorage.getItem('userId')), bookingData).subscribe({
      next: () => window.location.reload(),
      error: (error) => console.error("Hiba történt a foglalás során:", error),
    });
  }

  ngOnInit() {
    this.minDate = new Date().toISOString().split('T')[0]; 
  }
}