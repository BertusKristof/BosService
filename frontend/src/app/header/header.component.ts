import { Component, OnDestroy, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Router, RouterModule } from '@angular/router';
import { Subscription } from 'rxjs';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit, OnDestroy {
  menuActive = false;
  isLoggedIn = false;
  private subscription: Subscription = new Subscription();

  constructor(
    private apiService: ApiService, 
    private router: Router
  ) {}

  ngOnInit(): void {
    this.subscription.add(
      this.apiService.isLoggedIn$.subscribe({
        next: (status: boolean) => {
          this.isLoggedIn = status;
        },
        error: (err) => {
          console.error('Error in login status subscription:', err);
        }
      })
    );
  }
  public logout(): void {
    this.apiService.logout().subscribe({
      next: () => {
        this.handleSuccessfulLogout();
      },
      error: (err) => {
        this.handleLogoutError(err);
      }
    });
  }

  private handleSuccessfulLogout(): void {
    this.isLoggedIn = false;
    this.router.navigate(['/login']);
  }

  private handleLogoutError(err: any): void {
    console.error('Logout failed:', err);
    alert('Hiba történt a kijelentkezés során. Kérjük, próbálja újra.');
  }

  toggleMenu(): void {
    this.menuActive = !this.menuActive;
  }

  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
}