<?php

require_once 'Core/Router.php';

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/{id:\d+}', ['controller' => 'Posts', 'action' => 'show']);
$router->add('custom/{controller}/{action}');

// Display the routing table
echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

if ($router->match($_SERVER['QUERY_STRING'])) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo '404: Route not found';
}
