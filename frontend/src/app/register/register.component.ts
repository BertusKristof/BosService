import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { ApiService } from '../api.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [CommonModule, FormsModule, ReactiveFormsModule, RouterModule],
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {
  registerData = { 
    first_name: '', 
    last_name: '', 
    register_email: '', 
    register_phone: '', 
    register_password: '',
    password_confirmation: ''  // Új mező a jelszó megerősítéséhez
  };
  
  errorMessage = '';
  isSubmitting = false;

  constructor(
    private apiService: ApiService,
    private router: Router
  ) {}

  register(): void {
    // Validáció
    if (!this.validateForm()) {
      return;
    }

    this.isSubmitting = true;
    this.errorMessage = '';

    this.apiService.register(this.registerData).subscribe({
      next: (response) => {
        this.handleRegistrationSuccess(response);
      },
      error: (error) => {
        this.handleRegistrationError(error);
      },
      complete: () => {
        this.isSubmitting = false;
      }
    });
  }

  private validateForm(): boolean {
    if (this.registerData.register_password !== this.registerData.password_confirmation) {
      this.errorMessage = 'A jelszavak nem egyeznek!';
      return false;
    }
    return true;
  }

  private handleRegistrationSuccess(response: any): void {
    localStorage.setItem('token', response.token);
    this.router.navigate(['/']);
  }

  private handleRegistrationError(error: any): void {
    this.errorMessage = 'Hiba történt a regisztráció során.';
    if (error.error?.errors) {
      this.errorMessage = Object.values(error.error.errors).join(' ');
    }
    console.error('Registration error:', error);
  }
}