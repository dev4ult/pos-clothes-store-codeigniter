<?php

namespace App\Models;

use CodeIgniter\Model;

class Category_Model extends Model {

    protected $table = "kategori";

    protected $allowedFields = ['id_kategori', 'nama_kategori'];
}