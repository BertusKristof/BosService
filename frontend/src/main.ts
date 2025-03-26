import { bootstrapApplication } from '@angular/platform-browser';
import { AppComponent } from './app/app.component';
import { provideRouter } from '@angular/router';
import { routes } from './app/app.routes'; // ha van routingod

bootstrapApplication(AppComponent, {
  providers: [
    provideRouter(routes) // ha van routingod
  ]
}).catch(err => console.error(err));