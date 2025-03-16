<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserExists
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() === null) {
            // Token érvénytelenítése
            auth()->logout();
            return response()->json(['message' => 'Felhasználó nem található.'], 401);
        }

        return $next($request);
    }
}
