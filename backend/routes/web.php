<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AppointmentController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function(){
    return view('main');
})->name('main');

Route::get('login',[LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register',[RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('idopont',[AppointmentController::class, 'showAppointmentForm'])->name('idopont');
Route::post('idopont', [AppointmentController::class, 'appointment']);
// Route::post('update-user-appointment', [AppointmentController::class, '	UpdateUserAppointment'])->name('update-user-appointment');
=======


Route::get('/', function(){
    return view('welcome');
});

// Route::get('login',[LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// // Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('register',[RegisterController::class, 'showRegisterForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);

// Route::get('idopont',[AppointmentController::class, 'showAppointmentForm'])->name('idopont');
// Route::post('idopont', [AppointmentController::class, 'appointment']);
// // Route::post('update-user-appointment', [AppointmentController::class, '	UpdateUserAppointment'])->name('update-user-appointment');
>>>>>>> Stashed changes

