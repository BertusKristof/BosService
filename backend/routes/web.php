<?php
namespace App\Http\Controllers;

use App\Models\UserLogin;
use App\Models\UserRegister;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'store'])->name('login');
Route::post('/register', [UserController::class, 'store'])->name('register');



class UserController extends Controller
{
    public function index() {
        return view('index');
    }

    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function idopont() {
        return view('idopont');
    }
}