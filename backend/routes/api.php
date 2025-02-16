<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\Auth\AppointmentController;

// Route::post('login', [LoginController::class, 'login']);
// Route::post('register', [LoginController::class, 'register']);
// Route::middleware('auth:sanctum')->group(function (){
//     Route::get('user', [UserController::class, 'getUser']);
//     Route::post('update-user-appointment', [AppointmentController::class, 'UpdateUserAppointment']);
// }); 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example API route for fetching users
Route::get('/users', function (Request $request) {
    // Logic to fetch users from the database
});

// Example API route for creating a user
Route::post('/users', function (Request $request) {
    // Logic to create a new user
});

// Additional API routes can be defined here

