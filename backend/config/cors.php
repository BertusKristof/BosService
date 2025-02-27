<?php
<<<<<<< Updated upstream
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Allow API requests
    'allowed_methods' => ['*'], // Allow all HTTP methods
    'allowed_origins' => ['http://localhost:4200'], // Allow Angular frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Change to true if using authentication cookies
];
=======
    return [
        'supports_credentials' => true,
        'allowed_origins' => explode(',', env('CORS_ALLOW_ORIGINS')),
        'allowed_origins_patterns' => [],
        'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization'],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],
        'exposed_headers' => [],
        'max_age' => 0,
        'hosts' => [],
    ];
    
>>>>>>> Stashed changes
