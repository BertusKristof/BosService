import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { ApiService } from '../api.service';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  loginData = { 
    login_email: '', 
    login_password: '' 
  };
  
  modalData = { 
    email: '', 
    newPassword: '', 
    confirmPassword: '' 
  };
  
  errorMessage = '';
  showPasswordModal = false;

  constructor(
    private apiService: ApiService,
    private router: Router
  ) {}

  // Bejelentkezési függvény
  login(): void {
    if (!this.loginData.login_email || !this.loginData.login_password) {
      this.errorMessage = 'Kérjük töltse ki mindkét mezőt!';
      return;
    }

    this.apiService.login(this.loginData).subscribe({
      next: (response) => {
        localStorage.setItem('token', response.token);
        this.router.navigate(['/']);
      },
      error: (error) => {
        this.handleLoginError(error);
      }
    });
  }

  // Jelszóemlékeztető modal megnyitása
  openPasswordModal(): void {
    this.showPasswordModal = true;
  }

  // Modal bezárása
  closePasswordModal(): void {
    this.showPasswordModal = false;
    this.resetModal();
  }

  // Jelszóváltoztatás elküldése
  submitPasswordModal(): void {
    if (this.modalData.newPassword !== this.modalData.confirmPassword) {
      this.errorMessage = 'A jelszavak nem egyeznek!';
      return;
    }

    // TODO: Implementáld a jelszóváltoztatási logikát
    console.log('Jelszó változtatás kérés:', this.modalData);
    alert('Jelszóváltoztatási kérés elküldve!');
    this.closePasswordModal();
  }

  // Hibakezelés
  private handleLoginError(error: any): void {
    this.errorMessage = 'Helytelen email vagy jelszó.';
    if (error.error?.errors) {
      this.errorMessage = Object.values(error.error.errors).join(' ');
    }
  }

  // Modal adatok törlése
  private resetModal(): void {
    this.modalData = { 
      email: '', 
      newPassword: '', 
      confirmPassword: '' 
    };
    this.errorMessage = '';
  }
}