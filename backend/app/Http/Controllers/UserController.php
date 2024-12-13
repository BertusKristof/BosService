<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRegister;
use App\Models\UserLogin;

class UserController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:user_register,register_email',
            'password' => 'required|string|min:6',
            'phone' => [
                'required',
                'regex:/^(\+36|06)\s?([1-9]{1}[0-9]{1})\s?[0-9]{3}\s?[0-9]{4}$/'
            ],
        ]);
        DB::beginTransaction();

        try{
            $hashedPassword = Hash::make($validatedData['password']);

            $userRegister = UserRegister::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'register_email' => $validatedData['email'],
                'register_password' => $hashedPassword,
                'register_phone' => $validatedData['phone'],
            ]);
            $userLogin = UserLogin::create([
                'user_id' => $userRegister->id,
                'login_email' => $validatedData['email'],
                'login_phone' => $validatedData['phone'],
                'login_password' => $hashedPassword,
            ]);

            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Adatbázis hiba: ' . $e->getMessage()], 500);
        }
    }
}
