import { Component } from '@angular/core';
import { HeaderComponent } from './header/header.component';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,  // standalone beállítás
  imports: [HeaderComponent, RouterOutlet],  // itt importáljuk a használt komponenseket
  template: `
    <app-header></app-header>
    <router-outlet></router-outlet>
  `
})
export class AppComponent {
  title = 'bosservice-angular';
}