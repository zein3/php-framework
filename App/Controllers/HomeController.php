<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index() {
        $this->view('home', [
            'name' => "budi tabuti"
        ]);
    }

    public function showHello() {
        $this->view('home', [
            'name' => $this->route_params['name']
        ]);
    }
}