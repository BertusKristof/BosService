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
  private apiUrl = 'http://127.0.0.1:8000/api';
  
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
        this.setToken(response.token);
      })
    );
  }
  
  register(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/register`, data);
  }

  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('token');
    if (!token) {
      console.warn('No token found!');
      return new HttpHeaders(); 
    }
    return new HttpHeaders().set('Authorization', `Bearer ${token}`);
  }
  
  getAppointment(): Observable<any> {
    return this.http.get(`${this.apiUrl}/appointment`, { headers: this.getAuthHeaders() });
  }

  bookOrUpdateAppointment(data: any): Observable<any> {
    return this.getAppointment().pipe(
      switchMap(appointment => {
        if (appointment) {
          return this.http.put(`${this.apiUrl}/appointment`, data, { headers: this.getAuthHeaders() });
        } else {
          return this.http.post(`${this.apiUrl}/appointment`, data, { headers: this.getAuthHeaders() });
        }
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
  
}
