<?php

namespace App\Models;

use CodeIgniter\Model;

class CashierEmployee_Model extends Model {

    protected $table = "kasir";

    protected $allowedFields = ['id_kasir', 'username', 'email', 'password', 'nama_lengkap', 'nik', 'no_telepon', 'alamat', 'foto_profil'];
}
