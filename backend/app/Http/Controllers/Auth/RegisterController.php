<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_register;
use App\Models\user_login;
use App\Models\appointments;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{
    public function register(Request $request){
        
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'register_email' => 'required|email|max:255|',
            'register_password' => [
                'required',
            Password::min(8) 
                ->letters() 
                ->mixedCase() 
                ->numbers() 
            ],
            'register_phone' => [
                'required',
                'regex:^(\+?[0-9]{1,3})?[-. ]?([0-9]{9,12})^'
            ],
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'Sikertelen regisztráció',
                'errors' => $validator->errors()
            ],422);
        }
        
        $register_user = user_register::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'register_email' => $request->register_email,
            'register_phone' => $request->register_phone,
            'register_password' => Hash::make($request->register_password),
        ]);
        appointments::create([
            'contact_name' => $request->first_name . '   ' . $request->last_name,
            'appointment_service' => null,
            'appointment_date' => null,
            'appointment_time' => null,
        ]);
        return response()->json([
            'message' => 'Sikeres regisztráció',
            'user' => $register_user
        ], 201);
    }
}