<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
{
    /**
     * A CORS kezeléséhez szükséges beállítások.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Az engedélyezett domainek listája
        $allowedOrigins = ['http://localhost:4200'];
        // A kéréshez tartozó "Origin" cím ellenőrzése
        if (in_array($request->header('Origin'), $allowedOrigins)) {
            // CORS fejlécek hozzáadása, ha a "Origin" cím engedélyezett
            return $next($request)
                ->header('Access-Control-Allow-Origin', $request->header('Origin'))
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, Accept');
        }

        return $next($request);
    }
}
