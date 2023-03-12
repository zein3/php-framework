<?php

require_once __DIR__ . '/Core/Router.php';

// include semua controller
foreach(glob(__DIR__ . '/Controllers/*.php') as $controller) {
    include_once $controller;
}

$router = new Router();

// contoh route
$router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('/posts', ['controller' => 'PostController', 'action' => 'index']);
$router->add('/posts/{id:\d+}', ['controller' => 'Posts', 'action' => 'show']);
$router->add('/custom/{controller}/{action}');

$router->dispatch($_SERVER['REQUEST_URI']);

// testing
// echo $_SERVER['REQUEST_URI'] . "<br>" . $_SERVER['QUERY_STRING'] . "<br>";
// Display the routing table
// echo '<pre>';
// echo htmlspecialchars(print_r($router->getRoutes(), true));
// echo '</pre>';

// if ($router->match($_SERVER['REQUEST_URI'])) {
//     echo '<pre>';
//     var_dump($router->getParams());
//     echo '</pre>';
// } else {
//     echo '404: Route not found';
// }
