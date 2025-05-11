<?php
namespace App\Core;

class Router
{
    private $routes = [];
    private $notFoundHandler;

    public function addRoute(string $uri, callable $handler)
    {
        $this->routes[$uri] = $handler;
    }

    public function setNotFoundHandler(callable $handler)
    {
        $this->notFoundHandler = $handler;
    }

    public function dispatch(string $requestUri)
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route => $handler) {
            if ($route === $uri) {
                return $handler();
            }
        }

        return ($this->notFoundHandler)();
    }
}