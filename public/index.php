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

// use App\Models\Role;
// $role = new Role();
// $role->name = 'testing';
// $role->save();
// var_dump($role);
// $role->name = "test";
// $role->save(); // auto update

// echo "<br><br>";

// $roles = Role::getAll();
// var_dump($roles);

// echo "<br><br>";

// $role1 = Role::get(1);
// var_dump($role1);
// return;

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
