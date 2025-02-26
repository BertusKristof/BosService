import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../api.service';

@Component({
  selector: 'app-idopont',
  standalone: true,
  templateUrl: './idopont.component.html',
  styleUrls: ['./idopont.component.css'],
  imports: [CommonModule, FormsModule]
})
export class IdopontComponent {
  selectedService: string | null = null;
  selectedDate: string | null = null;
  selectedTime: string | null = null;
  summary: string = '';
  timeSlots: string[] = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
  carData = { licensePlate: '', brand: '', model: '', year: '' };

  constructor(private apiService: ApiService) {}

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
      Szolgáltatás: ${this.selectedService || 'Nincs kiválasztva'}<br>
      Dátum: ${this.selectedDate || 'Nincs kiválasztva'}<br>
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

  confirmBooking() {
    const bookingData = {
      service: this.selectedService,
      date: this.selectedDate,
      time: this.selectedTime,
      car: this.carData
    };
    const token = localStorage.getItem('authToken'); // Retrieve the token
    if (token) {
      this.apiService.updateUserAppointment(token, bookingData).subscribe(
        response => {
          console.log('Booking confirmed', response);
          // Handle successful booking
        },
        error => {
          console.error('Error confirming booking', error);
        }
      );
    } else {
      console.error('No authentication token found');
    }
  }
}