<?php

namespace App\Core;

abstract class Controller
{
    protected $route_params = [];

    public function __construct(array $route_params) {
        $this->route_params = $route_params;
    }

    public function view(string $view, array $data = []): void {
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }

    public function json(array $data): void {
        header('Content-type: application/json');
        echo json_encode($data);
    }
}