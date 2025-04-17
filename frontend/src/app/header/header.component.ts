import { Component, OnDestroy, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-header',
  standalone: true,
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
  imports: [CommonModule]
})
export class HeaderComponent implements OnInit, OnDestroy {
  menuActive: boolean = false;
  isLoggedIn: boolean = false;
  private subscription: Subscription = new Subscription();

  constructor(public apiService: ApiService, public router: Router) {}
  ngOnInit() {
    this.subscription.add(
      this.apiService.isLoggedIn$.subscribe((status: boolean) => {
        console.log('isLoggedIn status:', status);
        this.isLoggedIn = status;
      })
    );
  }
  
  onLogout() {
    this.apiService.logout().subscribe({
      next: () => {
        this.router.navigate(['/']);
      },
      error: (err) => {
        console.error('Logout failed:', err);
        this.router.navigate(['/']);
      }
    });
  }

  toggleMenu(): void {
    this.menuActive = !this.menuActive;
  }
  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
