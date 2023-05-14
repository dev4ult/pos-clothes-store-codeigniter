<?php

namespace App\Controllers;


use App\Models\Product_Model;

class Dashboard extends BaseController {

    protected $product_model;

    public function __construct() {
        $this->product_model = new Product_Model();
    }

    public function index() {
        $data['page_title'] = 'Dashboard';
        $data['total_product'] = count($this->product_model->select('*')->get()->getResult());
        echo view('templates/header');
        echo view('templates/aside', $data);
        echo view('dashboard', $data);
        echo view('templates/footer');
    }
}
