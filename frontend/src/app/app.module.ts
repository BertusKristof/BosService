// app.module.ts
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common'; 
import { RouterModule } from '@angular/router'; // Fontos a RouterModule importálása

import { HeaderComponent } from './header/header.component';
import { MainComponent } from './main/main.component';
import { RegisterComponent } from './register/register.component';
import { LoginComponent } from './login/login.component';
import { IdopontComponent } from './idopont/idopont.component';
import { AppComponent } from './app.component';

@NgModule({
  declarations: [
    AppComponent, // AppComponent a declarations-be kerül
    HeaderComponent,
    MainComponent,
    RegisterComponent,
    IdopontComponent,
    LoginComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    CommonModule,
    RouterModule // RouterModule importálása a router-outlet miatt
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }