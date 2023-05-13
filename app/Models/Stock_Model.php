<?php

namespace App\Models;

use CodeIgniter\Model;

class Stock_Model extends Model {

    protected $table = "stok_produk";

    protected $allowedFields = ['id_stok', 'id_produk', 'id_ukuran', 'stok'];
}