<?php
namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * A route definíciók számára használt útvonalak előtagja.
     *
     * @var string
     */
    public const API = 'api';

    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::prefix(self::API)
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
