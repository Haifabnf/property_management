<?php

$requestUri = $_SERVER['REQUEST_URI'];

$requestUri = strtok($requestUri, '?');

$routes = [
    '/' => 'home.php',
    '/api/signup' => '../src/Controllers/UserController.php',
    '/api/login' => '../src/Controllers/UserController.php',
    '/api/properties' => '../src/Controllers/PropertyController.php',
    '/api/properties/add' => '../src/Controllers/PropertyController.php',
    '/api/properties/delete' => '../src/Controllers/PropertyController.php',
];

if (array_key_exists($requestUri, $routes)) {
    include $routes[$requestUri];
} else {
    http_response_code(404);
    echo 'Page not found';
}
