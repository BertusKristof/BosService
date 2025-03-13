<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        // Token ellenőrzése
        $tokenString = $request->bearerToken();
        if ($tokenString) {
            $token = PersonalAccessToken::findToken($tokenString);
            if ($token && $token->expires_at <= Carbon::now()) {
                $token->delete(); // Törlés, ha lejárt
                return response()->json(['message' => 'Token has expired'], 401);
            }
        }
        
        return $next($request);
    }
}
