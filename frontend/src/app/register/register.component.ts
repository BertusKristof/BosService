import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-register',
  standalone: true,
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
  imports: [CommonModule, FormsModule]
})
export class RegisterComponent {
  registerData = { first_name: '', last_name: '', register_email: '', register_phone: '', register_password: '' };
  errorMessage = '';

  constructor(private apiService: ApiService, private router: Router) {}

  register() {
    this.apiService.register(this.registerData).subscribe(
      response => {
        console.log('Registration successful', response);
        localStorage.setItem('token', response.token); 
        this.router.navigate(['/']); 
      },
      error => {
        this.errorMessage = 'Hiba történt a regisztráció során.';
        if (error.error.errors) {
          this.errorMessage = Object.values(error.error.errors).join(' ');
        }
      }
    );
  }
}