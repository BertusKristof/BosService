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
      (response: any) => {
        if (response.token) {
          localStorage.setItem('token', response.token);
        }
  
        if (response.user && response.user.id) {
          localStorage.setItem('userId', response.user.id.toString());
        } else {
          
        }
  
        this.router.navigate(['/']).then(() => {
          window.location.reload(); 
        });
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