<?php

declare(strict_types = 1);

//When the page is opened, than the session by default is ended.
session_unset();

include 'includes/class-autoload.inc.php';

$routes = [
  '/' => controllers\HomeController::class,
  '/register' => controllers\RegisterController::class,
  '/login'=> controllers\LoginController::class,
  '/blog' => controllers\BlogController::class,
  '/share' => controllers\ShareController::class,
  '/share?' => controllers\ShareController::class,
  '/delete' => controllers\BlogDeleteController::class,
  '/modifyView' => controllers\BlogModifyViewController::class,
  '/modify' => controllers\BlogModifyController::class,
];

$request = new \http\Request($_SERVER, $_POST);
$session = new \http\Session();
$database_context = new \services\DatabaseContext();

$controller = new $routes[$_SERVER['REQUEST_URI']]($request, $database_context, $session);
print $controller->handle();

?>