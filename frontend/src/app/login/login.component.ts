import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  imports: [CommonModule, FormsModule]
})
export class LoginComponent {
  loginData = { login_phone: '', login_email: '', login_password: '' };
  modalData = { email: '', newPassword: '', confirmPassword: '' };
  errorMessage = '';

  constructor(private apiService: ApiService, private router: Router) {}

  login() {
    this.apiService.login(this.loginData).subscribe({
      next:(response) => {
        console.log('Login successful', response);
        localStorage.setItem('token', response.token);  
        this.router.navigate(['/']); 
      },
      error: (error) => {
        this.errorMessage = 'Helytelen email/telefonszám vagy jelszó.';
        if (error.error.errors) {
          this.errorMessage = Object.values(error.error.errors).join(' ');
        }
      }
  });
  }

  showLoginModal() {
    const loginModal = document.getElementById('login_myModal');
    if (loginModal) {
      loginModal.style.display = 'block';
    }
  }

  closeLoginModal() {
    const loginModal = document.getElementById('login_myModal');
    if (loginModal) {
      loginModal.style.display = 'none';
    }
  }

  submitLoginModal() {
    if (this.modalData.newPassword !== this.modalData.confirmPassword) {
      alert('A jelszavak nem egyeznek.');
      return;
    }
    alert('Beírt szöveg: ' + this.modalData.newPassword);
    this.closeLoginModal();
  }
}