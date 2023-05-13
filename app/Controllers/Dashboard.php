<?php

namespace App\Controllers;

class Dashboard extends BaseController {
    public function index() {
        $data['page_title'] = 'Dashboard';
        echo view('templates/header');
        echo view('templates/aside', $data);
        echo view('dashboard');
        echo view('templates/footer');
    }
}