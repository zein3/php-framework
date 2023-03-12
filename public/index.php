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

$router = new Router();

// contoh route
$router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('/posts', ['controller' => 'PostController', 'action' => 'index']);
$router->add('/posts/{id:\d+}', ['controller' => 'Posts', 'action' => 'show']);
$router->add('/custom/{controller}/{action}');

$router->dispatch($_SERVER['REQUEST_URI']);
