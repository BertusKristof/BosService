<?php
// filepath: /c:/Users/krist/Documents/PHP/bosservice-laravel/app/Providers/AuthServiceProvider.php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();
    }
}