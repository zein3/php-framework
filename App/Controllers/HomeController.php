<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class HomeController extends Controller
{
    public function index() {
        $roles = Database::getPDO()->query("SELECT * FROM roles");
        $this->view('home', [
            'name' => "zein haddad",
            'roles' => $roles
        ]);
    }

    public function showHello() {
        $this->view('home', [
            'name' => $this->route_params['name'],
        ]);
    }
}