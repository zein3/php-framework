<?php

abstract class Controller
{
    public function view(string $view, array $data = []): void {
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }

    public function json(array $data): void {
        header('Content-type: application/json');
        echo json_encode($data);
    }
}