<?php

namespace App\Models;

use CodeIgniter\Model;

class Product_Model extends Model {

    protected $table = "produk_baju";

    protected $allowedFields = ['id_produk', 'id_kategori', 'nama_baju', 'deskripsi', 'harga', 'stok', 'gambar_baju'];
}