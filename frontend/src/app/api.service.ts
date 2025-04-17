import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap, catchError } from 'rxjs/operators';
import { throwError } from 'rxjs';
import { BehaviorSubject } from 'rxjs';
import { map, switchMap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = 'http://localhost:8000/api';
  
  private loggedIn = new BehaviorSubject<boolean>(!!localStorage.getItem('token'));
  isLoggedIn$ = this.loggedIn.asObservable();

  constructor(public http: HttpClient) { }

  getToken(): string | null {
    return localStorage.getItem('token');
  }

  setToken(token: string): void{
    localStorage.setItem('token', token);
    this.loggedIn.next(true);
  }

  removeToken(): void {
    localStorage.removeItem('token');
    this.loggedIn.next(false); 
  }
  
  login(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/login`, data).pipe(
      tap((response: any) => {
        console.log('Bejelentkezési válasz:', response);
  
        if (response.access_token) {
          localStorage.setItem('accessToken', response.access_token);
          console.log('Sikeres bejelentkezés! Access Token:', response.access_token);
        } else {
          console.error('A válasz nem tartalmaz access token-t!', response);
        }
      }),
      catchError((error) => {
        console.error('Bejelentkezési hiba:', error);
        return throwError(() => new Error('Hiba történt a bejelentkezés során!'));
      })
    );
  }
  
  register(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/register`, data).pipe(
      tap((response: any) => {
        console.log('Regisztráció válasz:', response);
  
        if (response.user && response.user.id) {
          localStorage.setItem('userId', response.user.id.toString());
          console.log(' Sikeres regisztráció! User ID:', response.user.id);
        } else {
          console.error('A válaszban nincs user ID! Válasz:', response);
        }
      }),
      catchError((error) => {
        console.error(' Regisztrációs hiba:', error);
        return throwError(error);
      })
    );
  }
  
  appointment(userId: number, data: any = {}): Observable<any> {
    const token = this.getToken();
    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      Authorization: `Bearer ${token}`,
    });
  
    return this.http.post(`${this.apiUrl}/appointment/${userId}`, data, { headers }).pipe(
      tap((response) => console.log('Foglalás sikeres!', response)),
      catchError((error) => {
        console.error('Foglalás hiba:', error);
        alert('Nem sikerült a foglalás. Próbáld újra!');
        return throwError(error);
      })
    );
  }
  
  bookAppointment(date: string, time: string): Observable<any> {
    return this.http.post(`${this.apiUrl}/appointment`, { date, time });
  }
  
  getAppointment(userId: number): Observable<any> {
    const token = this.getToken();
    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      Authorization: `Bearer ${token}`,
    });
  
    return this.http.get(`${this.apiUrl}/appointment/${userId}`, { headers }).pipe(
      tap((response) => console.log('Foglalás adatok:', response)),
      catchError((error) => {
        console.error('Foglalás lekérdezés hiba:', error);
        return throwError(error);
      })
    );
  }  
  
  getBookedTimes(date: string): Observable<string[]> {
    return this.http.post<string[]>(`${this.apiUrl}/booked-times`, { date }).pipe(
      tap((times) => console.log('Foglal időpontok:', times)),
      catchError((error) => {
        console.error('Hiba a foglalt időpontok lekérésekor:', error);
        return throwError(error);
      })
    );
  }  

  logout(): Observable<any> {
    const token = this.getToken();
    if (!token) {
      console.log('No token found during logout');
      return throwError('No token found');
    }
  
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
  
    return this.http.post(`${this.apiUrl}/logout`, {}, { headers }).pipe(
      tap(() => {
        this.removeToken();
        this.loggedIn.next(false);
        console.log('Logged out successfully');
      }),
      catchError((error) => {
        console.error('Logout error:', error);
  
        if (error.status === 401) {
          console.log('Unauthorized detected, force logout');
          this.removeToken();
          this.loggedIn.next(false);
        }
  
        return throwError(error);
      })
    );
  }
  updateCar(userId: number, carData: any): Observable<any> {
    const token = this.getToken();
    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      Authorization: `Bearer ${token}`,
    });
  
    return this.http.post(`${this.apiUrl}/cars/${userId}`, carData, { headers }).pipe(
      tap((response) => console.log('Autó adatok frissítése sikeres:', response)),
      catchError((error) => {
        console.error('Hiba történt az autó adatok frissítése során:', error);
        return throwError(error);
      })
    );
  }

  verifyEmail(email:string): Observable<any>{
    return this.http.post(`${this.apiUrl}/verify-email`, {email});
  }

  changePassword(email:string, newPassword:string): Observable<any>{
    return this.http.post(`${this.apiUrl}/change-password`, {email, newPassword});

  }
}