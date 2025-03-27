import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-idopont',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './idopont.component.html',
  styleUrls: ['./idopont.component.css']
})
export class IdopontComponent implements OnInit {
  appointmentData = {
    appointment_service: '', 
    appointment_date: '', 
    appointment_time: '',
    car_data: {
      licensePlate: '',
      brand: '',
      model: '',
      year: ''
    }
  };
  
  selectedService: string = '';
  selectedDate: string = '';
  selectedTime: string = '';
  summary: string = '';
  timeSlots: string[] = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
  showCarModal: boolean = false;
  errorMessage: string = '';
  successMessage: string = '';
  carData = {
    licensePlate: '',
    brand: '',
    model: '',
    year: ''
  };

  constructor(
    private apiService: ApiService, 
    private router: Router, 
    private http: HttpClient
  ) {}

  ngOnInit(): void {
    this.loadExistingAppointment();
  }

  private loadExistingAppointment(): void {
    this.apiService.getAppointment().subscribe({
      next: (appointment) => {
        if (appointment) {
          this.appointmentData = appointment;
          this.selectedService = appointment.appointment_service;
          this.selectedDate = appointment.appointment_date;
          this.selectedTime = appointment.appointment_time;
          this.updateSummary();
        }
      },
      error: (err) => {
        console.log('No existing appointment found', err);
      }
    });
  }

  selectService(service: string): void {
    this.selectedService = service;
    this.updateSummary();
  }

  selectTime(time: string): void {
    this.selectedTime = time;
    this.updateSummary();
  }

  updateSummary(): void {
    this.summary = `
      Szolgáltatás: ${this.selectedService || 'Nincs kiválasztva'}
      Dátum: ${this.selectedDate || 'Nincs kiválasztva'}
      Időpont: ${this.selectedTime || 'Nincs kiválasztva'}
    `;
  }

  openCarModal(): void {
    this.showCarModal = true;
  }

  closeCarModal(): void {
    this.showCarModal = false;
  }

  submitCarModal(): void {
    this.appointmentData.car_data = this.carData;
    this.closeCarModal();
  }

  confirmBooking(): void {
    if (!this.validateForm()) {
      return;
    }

    this.appointmentData = {
      ...this.appointmentData,
      appointment_service: this.selectedService,
      appointment_date: this.selectedDate,
      appointment_time: this.selectedTime
    };

    this.apiService.bookOrUpdateAppointment(this.appointmentData).subscribe({
      next: (response) => {
        this.successMessage = "Időpont foglalás sikeres!";
        setTimeout(() => this.router.navigate(['/']), 2000);
      },
      error: (error) => {
        this.errorMessage = 'Hiba történt az időpont foglalás során: ' + 
          (error.error?.message || error.message || 'Ismeretlen hiba');
        console.error('Error:', error);
      }
    });
  }

  private validateForm(): boolean {
    if (!this.selectedService) {
      this.errorMessage = 'Kérjük válasszon szolgáltatást!';
      return false;
    }
    if (!this.selectedDate) {
      this.errorMessage = 'Kérjük válasszon dátumot!';
      return false;
    }
    if (!this.selectedTime) {
      this.errorMessage = 'Kérjük válasszon időpontot!';
      return false;
    }
    this.errorMessage = '';
    return true;
  }
}