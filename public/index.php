<?php
require_once __DIR__.'/../vendor/autoload.php';

// Инициализация Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../app/Views');
$twig = new \Twig\Environment($loader);

// Инициализация роутера
$router = new \App\Core\Router();
$controller = new \App\Controllers\PageController($twig);

// Регистрация маршрутов
$router->addRoute('/', function() use ($controller) {
    $controller->home();
});

$router->addRoute('/about', function() use ($controller) {
    $controller->about();
});

$router->addRoute('/contacts', function() use ($controller) {
    $controller->contacts();
});

$router->addRoute('/php-gd-info', function() use ($controller) {
    $controller->gdInfo();
});

// 404 обработчик
$router->setNotFoundHandler(function() use ($controller) {
    $controller->notFound();
});

// Запуск роутера
$router->dispatch($_SERVER['REQUEST_URI']);