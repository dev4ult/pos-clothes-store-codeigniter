<?php

namespace App\Controllers;

class Home extends BaseController {
    protected $data;

    public function index() {
        $this->data['page_title'] = 'Home';

        echo view('templates/header', $this->data);
        echo view('templates/aside', $this->data);
        echo view('main/home');
        echo view('templates/footer');
    }
}
