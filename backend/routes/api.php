<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AppointmentController;

Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout']);
Route::post('/login', [LoginController::class, 'login']); 
Route::post('/appointments', [AppointmentController::class, 'store']);
Route::put('/appointments/{appointment_id}', [AppointmentController::class, 'updateAppointment']);


