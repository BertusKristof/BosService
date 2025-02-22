<?php
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
