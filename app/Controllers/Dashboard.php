<?php

namespace App\Controllers;


use App\Models\Product_Model;
use App\Models\Transaction_Model;
use App\Models\Member_Model;
use App\Models\CashierEmployee_Model;

class Dashboard extends BaseController {

    protected $product_model;
    protected $member_model;
    protected $cashier_model;

    protected $data;

    public function __construct() {
        $this->product_model = new Product_Model();
        $this->member_model = new Member_Model();
        $this->cashier_model = new CashierEmployee_Model();
    }

    public function index() {
        $this->data['page_title'] = 'Dashboard';
        $this->data['total_product'] = count($this->product_model->select('*')->get()->getResult());
        $this->data['total_member'] = count($this->member_model->select('*')->get()->getResult());
        $this->data['total_cashier'] = count($this->cashier_model->select('*')->get()->getResult());

        echo view('templates/header', $this->data);
        echo view('templates/aside', $this->data);
        echo view('dashboard/index', $this->data);
        echo view('templates/footer');
    }
}
