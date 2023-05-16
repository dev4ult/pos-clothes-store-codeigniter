<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaction_Model extends Model {

    protected $table = "detail_transaksi";

    protected $allowedFields = ['id_detail_transaksi', 'id_transaksi', 'id_stok', 'jumlah_produk'];
}
