<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }
    public function login(Request $request){
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);     
        $credential = user_login::where('login_email', $request->login)
        ->orWhere('login_phone', $request->login)
        ->first();

    if(!$credential || Hash::check($request->password, $credential->login_password)){
        return back()->withErrors(['login' => 'Helytelen email/telefonszám vagy jelszó.']);
    }

    return redirect()->route('main');
}
}
