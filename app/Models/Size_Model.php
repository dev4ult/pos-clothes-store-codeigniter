<?php

namespace App\Models;

use CodeIgniter\Model;

class Size_Model extends Model {

    protected $table = "ukuran";

    protected $allowedFields = ['id_ukuran', 'jenis_ukuran'];
}
