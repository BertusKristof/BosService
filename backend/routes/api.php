<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AppointmentController;

<<<<<<< Updated upstream
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->group(function (){
    Route::get('user', [UserController::class, 'getUser']);
    Route::post('update-user-appointment', [AppointmentController::class, 'UpdateUserAppointment']);
=======
Route::options('{any}', function () {
    return response()->json([], 204);
})->where('any', '.*');

// Route::post('login', [LoginController::class, 'login']);
// Route::middleware('cors')->post('/register', [RegisterController::class, 'register']);
// Route::post('/register', [RegisterController::class, 'register']);
// Route::options('/register', [RegisterController::class, 'options']);
Route::options('/register', function () {
    return Response::make('', 200)
        ->header('Access-Control-Allow-Origin', 'http://localhost:4200')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization');
});
// Route::middleware('auth:sanctum')->group(function (){
//     Route::get('user', [UserController::class, 'getUser']);
//     Route::post('update-user-appointment', [AppointmentController::class, 'UpdateUserAppointment']);
// });

Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'success']);
>>>>>>> Stashed changes
});