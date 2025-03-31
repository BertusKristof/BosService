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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        user_login::create([
            'login_id' => $request->register_id,
            'login_email' => $request->register_email,
            'login_phone' => $request->register_phone,
            'login_password' => Hash::make($request->register_password),
        ]);

        appointments::create([
            'contact_name' => $request->first_name . '   ' . $request->last_name,
            'appointment_service' => null,
            'appointment_date' => null,
            'appointment_time' => null,
        ]);
        $token = $register_user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' =>[
                'id' => $register_user->register_id,
                'name' => $register_user->first_name . ' ' . $register_user->last_name,
            ]
        ], 201);

    }
    public function login(Request $request)
    {
        $credentials = $request->only('login_email', 'login_password');
    
        $login_user = user_login::where('login_email', $request->login_email)->first();
    
        if ($login_user && Hash::check($request->login_password, $login_user->login_password)) {
    
            $token = Str::random(64); 
    
            \DB::table('personal_access_tokens')->insert([
                'name' => 'autToken',
                'token' => hash('sha256', $token), 
                'abilities' => json_encode(['*']),
                'expires_at' => null, 
                'tokenable_id' => $login_user->register_id, 
                'tokenable_type' => 'App\Models\user_register', 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}