<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_login;
use App\Models\appointments;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('login_email', 'login_password');

    $user = user_login::where('login_email', $request->login_email)->first();

    if ($user && Hash::check($request->login_password, $user->login_password)) {

        $token = Str::random(64); 

        \DB::table('personal_access_tokens')->insert([
            'name' => 'autToken',
            'token' => hash('sha256', $token), 
            'abilities' => json_encode(['*']),
            'expires_at' => null, 
            'tokenable_id' => $user->register_id, 
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