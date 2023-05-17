<?php

namespace App\Controllers;


use App\Models\Product_Model;

class Dashboard extends BaseController {

    protected $product_model;

    protected $data;

    public function __construct() {
        $this->product_model = new Product_Model();
    }

    public function index() {
        $this->data['page_title'] = 'Dashboard';
        $this->data['total_product'] = count($this->product_model->select('*')->get()->getResult());
        echo view('templates/header', $this->data);
        echo view('templates/aside', $this->data);
        echo view('dashboard', $this->data);
        echo view('templates/footer');
    }
}