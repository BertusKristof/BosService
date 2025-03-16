<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AppointmentController;
use App\Http\Controllers\Auth\LogoutController;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']); 
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/appointment', [AppointmentController::class, 'manageAppointment']);
    Route::put('/appointment', [AppointmentController::class, 'manageAppointment']);
    Route::get('/appointment', [AppointmentController::class, 'getAppointment']);
});
Route::middleware(['auth:sanctum', 'ensure.user.exists'])->post('/logout', [LogoutController::class, 'logout']);
