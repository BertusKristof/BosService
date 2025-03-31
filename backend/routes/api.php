<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AppointmentController;    
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\CarsDataController;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/appointment/{id}', [AppointmentController::class, 'manageAppointment']);
Route::put('/appointment/{id}', [AppointmentController::class, 'manageAppointment']);
Route::get('/appointment/{id}', [AppointmentController::class, 'getAppointment']);
Route::post('/booked-times', [AppointmentController::class, 'getBookedTimes']);
Route::post('/cars', [CarsDataController::class, 'carsData']);
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');
