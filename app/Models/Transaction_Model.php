<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaction_Model extends Model {

    protected $table = "transaksi";

    protected $allowedFields = ['id_transaksi', 'id_member', 'id_kasir', 'status'];
}
