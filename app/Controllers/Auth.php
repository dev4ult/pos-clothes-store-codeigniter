<?php

namespace App\Controllers;

class Auth extends BaseController {
    public function index() {
        echo view('templates/header');
        echo view('auth/login');
        echo view('templates/footer');
    }
}