<?php

class Router
{
    /**
     * Tabel routing.
     */
    protected $routes = [];

    /**
     * Parameter dari url yg diterima, ini termasuk variabel url, query url, dan controller serta action.
     */
    protected $params = [];

    /**
     * Menambahkan route ke tabel routing.
     * @param string $route URL
     * @param array  $params array yang mengandung ('controller' = class), ('action' = method), dll
     */
    public function add(string $route, array $params = []): void {
        // escape garis miring agar bisa di regex
        $route = preg_replace('/\//', '\\/', $route);

        // convert {variable} menjadi regex
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // convert variable dengan regex custom spt. {id:\d+} menjadi regex
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // tambahkan pembuka dan penutup regex serta buat case insensitive
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Mencari route yg cocok dari tabel routing.
     * Variabel $params akan diisi jika ditemukan route yg cocok.
     * 
     * @param string $url
     * @return bool true jika ketemu, false jika tidak ketemu
     */
    public function match(string $url): bool {
        foreach($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /**
     * Match url and dispatch controllers
     */
    public function dispatch(string $url): void {
        if ($this->match($url)) {
            if (class_exists($this->params['controller'])) {
                $controller = new $this->params['controller']();
                $action = $this->params['action'];

                if (is_callable([$controller, $action])) {
                    $controller->$action();
                } else {
                    echo "500: Method missing";
                }
            } else {
                echo "500: Controller missing";
            }
        } else {
            echo "404: Not Found";
        }
    }

    public function getRoutes(): array {
        return $this->routes;
    }

    public function getParams(): array {
        return $this->params;
    }
}