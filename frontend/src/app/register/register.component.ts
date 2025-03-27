import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { ApiService } from '../api.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {
  registerData = {
    name: '',
    email: '',
    password: '',
    confirmPassword: ''
  };
  
  errorMessage = '';

  constructor(
    private apiService: ApiService,
    private router: Router
  ) {}

  register(): void {
    // Reset error message
    this.errorMessage = '';

    // Validate form
    if (!this.registerData.name || !this.registerData.email || 
        !this.registerData.password || !this.registerData.confirmPassword) {
      this.errorMessage = 'Kérjük töltse ki minden mezőt!';
      return;
    }

    if (this.registerData.password !== this.registerData.confirmPassword) {
      this.errorMessage = 'A jelszavak nem egyeznek!';
      return;
    }

    // Call API service
    this.apiService.register(this.registerData).subscribe({
      next: (response) => {
        // Registration successful
        localStorage.setItem('token', response.token);
        this.router.navigate(['/']); // Redirect to home
      },
      error: (error) => {
        this.handleRegistrationError(error);
      }
    });
  }

  private handleRegistrationError(error: any): void {
    this.errorMessage = 'Hiba történt a regisztráció során.';
    if (error.error?.errors) {
      this.errorMessage = Object.values(error.error.errors).join(' ');
    } else if (error.error?.message) {
      this.errorMessage = error.error.message;
    }
  }
}