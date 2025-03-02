<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('login_email', 'login_password');

        $user = user_login::where('login_email', $credentials['login_email'])
            ->orWhere('login_phone', $credentials['login_email'])
            ->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (Hash::check($credentials['login_password'], $user->login_password)) {
            Auth::login($user);

            $token = Sanctum::actingAs($user, ['*'])->plainTextToken;

            return response()->json([
                'token' => $token,
                'user_name' => $user->first_name . ' ' . $user->last_name,
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
