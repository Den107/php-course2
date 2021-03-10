<?php

require "../config/main.php";
require "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

if (!$requestUri = preg_replace(['#^/#', '#[?].*#', '#/$#'], '', $_SERVER['REQUEST_URI'])) {
  $requestUri = DEFAULT_CONTROLLER;
}

$parts = explode('/', $requestUri);
$controllerName = $parts[0];
$action = $parts[1];

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
  $controller = new $controllerClass();
  $controller->run();
}
