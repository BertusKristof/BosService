import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-idopont',
  standalone: true,
  templateUrl: './idopont.component.html',
  styleUrls: ['./idopont.component.css'],
  imports: [CommonModule, FormsModule]
})
export class IdopontComponent implements OnInit {
  appointmentData = {appointment_service: '', appointment_date: '', appointment_time: ''};
  selectedService: string = '';
  selectedDate: string  = '';
  selectedTime: string = '';
  summary: string = '';
  timeSlots: string[] = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
  carData = { licensePlate: '', brand: '', model: '', year: '' };
  appointment_id: string | null = null;
  errorMessage = '';

  constructor(private apiService: ApiService, private router: Router, private http: HttpClient) {}
  
  selectService(service: string) {
    this.selectedService = service;
    this.updateSummary();
  }

  selectTime(time: string) {
    this.selectedTime = time;
    this.updateSummary();
  }

  updateSummary() {
    this.summary = `
      Szolgáltatás: ${this.selectedService || 'Nincs kiválasztva'}
      Dátum: ${this.selectedDate || 'Nincs kiválasztva'}
      Időpont: ${this.selectedTime || 'Nincs kiválasztva'}
    `;
  }

  showCarModal() {
    const carModal = document.getElementById('car_myModal');
    if (carModal) {
      carModal.style.display = 'block';
    }
  }

  closeCarModal() {
    const carModal = document.getElementById('car_myModal');
    if (carModal) {
      carModal.style.display = 'none';
    }
  }

  submitCarModal() {
    alert('Autó adatok: ' + JSON.stringify(this.carData));
    this.closeCarModal();
  }
  
  ngOnInit(): void {
    this.apiService.getAppointment().subscribe(
      (appointment) => {
        if(appointment){
          this.appointmentData = appointment;
        }
      },
      () => {
        console.log('No existing appointment found');
      }
    )
  }

  confirmBooking() {
    this.appointmentData.appointment_service = this.selectedService;
    this.appointmentData.appointment_time = this.selectedTime;
    this.appointmentData.appointment_date = this.selectedDate;

    this.apiService.bookOrUpdateAppointment(this.appointmentData).subscribe(
      (response) => {
        this.summary = "Időpont foglalás sikeres";
        console.log('Appointment saved', response);
        this.router.navigate(['/']);
      },
      (error) => {
        this.errorMessage = 'Hiba történt az időpont foglalás során';
        console.log('Error: ', error);
      }
    )
  }
  
  }