import { Component } from '@angular/core';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-login',
  standalone: true,
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  imports: [FormsModule, CommonModule],
})
export class LoginComponent {
  loginData = { login_email: '', login_password: '' };
  email: string = '';
  newPassword: string = '';
  confirmPassword: string = '';
  errorMessage: string = '';

  constructor(private apiService: ApiService, private router: Router) {}

  login() {
    this.apiService.login(this.loginData).subscribe({
      next: (response) => {
        if (response.access_token) {
          localStorage.setItem('token', response.access_token);
          this.router.navigate(['/']).then(() => window.location.reload());
        }
      },
      error: (error) => {
        this.errorMessage = 'Helytelen email vagy jelszó.';
      }
    });
  }

  showEmailModal() {
    const modal = document.getElementById('emailModal');
    if (modal) modal.style.display = 'block';
  }

  closeEmailModal() {
    const modal = document.getElementById('emailModal');
    if (modal) modal.style.display = 'none';
  }

  showPasswordModal() {
    const modal = document.getElementById('passwordModal');
    if (modal) modal.style.display = 'block';
  }

  closePasswordModal() {
    const modal = document.getElementById('passwordModal');
    if (modal) modal.style.display = 'none';
  }

  verifyEmail() {
    this.apiService.verifyEmail(this.email).subscribe({
      next: () => {
        this.closeEmailModal();
        this.showPasswordModal();
      },
      error: () => {
        alert('Az e-mail cím nem található!');
      }
    });
  }

  changePassword() {
    if (this.newPassword !== this.confirmPassword) {
      alert('A jelszavak nem egyeznek! Kérlek, ellenőrizd őket.');
      return;
    }
  
    if (this.newPassword.length < 8) {
      alert('A jelszónak legalább 8 karakter hosszúnak kell lennie!');
      return;
    }
  
    this.apiService.changePassword(this.email, this.newPassword).subscribe({
      next: () => {
        alert('A jelszó sikeresen megváltozott!');
        this.closePasswordModal();
      },
      error: () => {
        alert('Hiba történt a jelszó megváltoztatása során!');
      }
    });
  }
}