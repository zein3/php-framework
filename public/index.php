<?php

// autoloader
spl_autoload_register(function ($class) {
    // pergi ke folder parent
    $root = dirname(__DIR__);
    // buat absolute path dari file nya
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;
use App\Core\DotEnv;

if (!DotEnv::load("../.env")) {
    return;
}

// contoh route
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $router = new Router();

    $router->add('', ['controller' => 'HomeController', 'action' => 'index']);
    $router->add('posts', ['controller' => 'HomeController', 'action' => 'show']);
    $router->add('posts/{id:\d+}', ['controller' => 'Posts', 'action' => 'show']);
    $router->add('hello/{name}', ['controller' => 'HomeController', 'action' => 'showHello']);
    $router->add('custom/{controller}/{action}');

    $router->dispatch($_SERVER['REQUEST_URI']);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $router = new Router();
}
