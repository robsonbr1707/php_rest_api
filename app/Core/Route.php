<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Route
{
    private array $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;    
    }

    public function add()
    {
        $routes = $this->getRoutesToMethod();
        $url = isset($_GET['url']) ? '/'. rtrim($_GET['url'], '/') : '/';
        $pathControllers = "App\\Controllers\\";

        foreach ($routes as $value) {

            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $value[0]) . '$#';
            
            if (preg_match($pattern, $url, $matches)) {
                
                array_shift($matches);

                [$controller, $method] = explode("@", $value[1]);
                $newController = $pathControllers . $controller;
                $controller = new $newController(new Request, new Response);
                
                if (!class_exists($newController) || !method_exists($controller, $method)) {
                    return $this->notFound("Erro ao localizar controllador");
                }

                return $controller->$method(...array_values($matches));
            }
        }

        return $this->notFound("Erro ao encontrar rota");
    }

    private function getRoutesToMethod(): array
    {
        if (is_array($this->routes[Request::method()])) {
            return $this->routes[Request::method()];
        }

        return $this->notFound("Erro ao encontrar method");
    }

    private function notFound(string $message = 'Error inesperado'): array
    {
        return Response::json([
            'error_status_code' => 405,
            'message' => $message 
        ], 405);
    }
}