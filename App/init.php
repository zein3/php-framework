<?php

require_once __DIR__ . '/Core/Router.php';

$router = new Router();

// contoh route
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('/posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('/posts/{id:\d+}', ['controller' => 'Posts', 'action' => 'show']);
$router->add('/custom/{controller}/{action}');

// testing
// echo $_SERVER['REQUEST_URI'] . "<br>" . $_SERVER['QUERY_STRING'] . "<br>";
// Display the routing table
echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

if ($router->match($_SERVER['REQUEST_URI'])) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo '404: Route not found';
}
