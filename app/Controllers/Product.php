<?php

namespace App\Controllers;

class Product extends BaseController {
    public function index() {
        $data['page_title'] = 'Produk';
        $data['list-produk'] = ;
        echo view('templates/header');
        echo view('templates/aside', $data);
        echo view('product/index', $data);
        echo view('templates/footer');
    }
}