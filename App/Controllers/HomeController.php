<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Role;

class HomeController extends Controller
{
    public function index() {
        $roles = Role::getAll();
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