<?php

// Simple function to get environment variables with fallbacks
function env($key, $default = null) {
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    
    return $value;
}

// Load environment variables from .env file
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            // Remove quotes if present
            if (strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) {
                $value = substr($value, 1, -1);
            }
            
            putenv("$name=$value");
        }
    }
}

return [
    'name' => env('APP_NAME', 'Product Display App'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false) === 'true',
    'url' => env('APP_URL', 'http://localhost'),
    
    'storage' => [
        'products_json' => __DIR__ . '/..' . env('STORAGE_PATH', '/data/products.json'),
        'default_image' => env('DEFAULT_IMAGE', '/images/placeholders/default.jpg')
    ],
    
    'logging' => [
        'channel' => env('LOG_CHANNEL', 'file'),
        'level' => env('LOG_LEVEL', 'error')
    ]
];
