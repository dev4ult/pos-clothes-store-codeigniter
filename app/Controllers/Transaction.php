<?php

namespace App\Controllers;


use App\Models\Transaction_Model;
use App\Models\DetailTransaction_Model;

class Transaction extends BaseController {

    protected $transaction_model;
    protected $detail_transaction_model;

    protected $data;

    public function __construct() {
        $this->transaction_model = new Transaction_Model();
        $this->detail_transaction_model = new DetailTransaction_Model();
    }

    public function save_transaction() {
    }

    public function finish_transaction() {
    }
}
