<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * A list of URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*',  // Az API végpontokat kivesszük a CSRF védelem alól
    ];
}
