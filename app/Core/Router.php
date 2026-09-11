<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler, array $middlewares = []): void
    {
        $this->addRoute('GET', $path, $handler, $middlewares);
    }

    public function post(string $path, array $handler, array $middlewares = []): void
    {
        $this->addRoute('POST', $path, $handler, $middlewares);
    }

    public function put(string $path, array $handler, array $middlewares = []): void
    {
        $this->addRoute('PUT', $path, $handler, $middlewares);
    }

    public function delete(string $path, array $handler, array $middlewares = []): void
    {
        $this->addRoute('DELETE', $path, $handler, $middlewares);
    }

    private function addRoute(string $method, string $path, array $handler, array $middlewares): void
    {
        $this->routes[] = [
            'method'     => $method,
            'path'       => $path,
            'handler'    => $handler,
            'middleware' => $middlewares
        ];
    }

    public function dispatch(string $url, string $method): void
    {
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        $parsedUrl = parse_url($url, PHP_URL_PATH);
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);

        if (strpos($parsedUrl, $scriptDir) === 0) {
            $parsedUrl = substr($parsedUrl, strlen($scriptDir));
        }

        $parsedUrl = '/' . trim($parsedUrl, '/');

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;

            if (strpos($route['path'], '#') === 0) {
                if (preg_match($route['path'], $parsedUrl, $matches)) {
                    foreach ($route['middleware'] as $middleware) {
                        call_user_func([$middleware, 'handle']);
                    }
                    $params = array_slice($matches, 1);
                    [$controllerClass, $methodName] = $route['handler'];
                    $controller = new $controllerClass();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            } else {
                if ($route['path'] === $parsedUrl) {
                    foreach ($route['middleware'] as $middleware) {
                        call_user_func([$middleware, 'handle']);
                    }
                    [$controllerClass, $methodName] = $route['handler'];
                    $controller = new $controllerClass();
                    call_user_func([$controller, $methodName]);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "<h1 style='text-align:center; margin-top:50px;'>404 - Halaman Tidak Ditemukan</h1>";
    }
}