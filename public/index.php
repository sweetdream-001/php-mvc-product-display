<?php
// Bootstrap the application
require_once __DIR__ . '/../vendor/autoload.php';

// Load configuration
$config = require_once __DIR__ . '/../config/app.php';

// Enable error display in development mode
if ($config['env'] === 'development' && $config['debug'] === true) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Make config available to the application
$GLOBALS['config'] = $config;

// Ensure placeholder image exists
$defaultImagePath = __DIR__ . $config['storage']['default_image'];
$defaultImageDir = dirname($defaultImagePath);

if (!is_dir($defaultImageDir)) {
    mkdir($defaultImageDir, 0755, true);
}

if (!file_exists($defaultImagePath)) {
    // Create a simple default image
    $image = imagecreatetruecolor(100, 100);
    $bgColor = imagecolorallocate($image, 200, 200, 200);
    $textColor = imagecolorallocate($image, 50, 50, 50);
    
    imagefill($image, 0, 0, $bgColor);
    imagestring($image, 3, 10, 40, 'No Image', $textColor);
    
    imagejpeg($image, $defaultImagePath);
    imagedestroy($image);
}

// Simple routing
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Default controller and action
$controllerName = 'App\\Controllers\\ProductController';
$action = 'index';

// Initialize controller and execute action
$controller = new $controllerName();
$controller->$action();

