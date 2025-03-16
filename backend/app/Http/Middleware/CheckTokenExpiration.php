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
        $tokenString = $request->bearerToken();
        if ($tokenString) {
            $token = PersonalAccessToken::findToken($tokenString);
            if ($token && $token->expires_at <= Carbon::now()) {
                $token->delete(); 
                return response()->json(['message' => 'Token has expired'], 401);
            }
        }
        
        return $next($request);
    }
}
