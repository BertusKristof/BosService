<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class LogoutController extends Controller
{
    public function logout(Request $request)
{
    try {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json(['message' => 'Nincs bejelentkezett felhasználó'], 401);
        }

        // Sanctum token törlés
        $user->tokens()->delete();

        return response()->json(['message' => 'Sikeres kijelentkezés']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Hiba a kijelentkezés során', 'error' => $e->getMessage()], 500);
    }
}

}
