<?php

require_once __DIR__ . '/../App/init.php';

// testing
require_once __DIR__ . '/../App/Controllers/HomeController.php';
$controller = new HomeController();
$controller->index();