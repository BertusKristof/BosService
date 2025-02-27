<?php
<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
=======

>>>>>>> Stashed changes
namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
=======
>>>>>>> Stashed changes
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            $response = response('', 200);
        } else {
            $response = $next($request);
        }

        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
=======
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-CSRF-Token');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
>>>>>>> Stashed changes
=======
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-CSRF-Token');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
>>>>>>> Stashed changes

        return $response;
    }
}