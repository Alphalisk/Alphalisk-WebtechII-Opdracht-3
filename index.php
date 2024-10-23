<?php

declare(strict_types = 1);

include 'includes/class-autoload.inc.php';

$routes = [
  '/' => controllers\BlogController::class,
  '/register' => controllers\RegisterController::class,
  '/login'=> controllers\LoginController::class,
  '/blog' => controllers\BlogController::class,
  '/echo' => controllers\EchoController::class,
];

$request = new \http\Request($_SERVER, $_POST);
$database_context = new \services\DatabaseContext();

$controller = new $routes[$_SERVER['REQUEST_URI']]($request, $database_context);
print $controller->handle();

?>