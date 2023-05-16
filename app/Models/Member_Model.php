<?php

namespace App\Models;

use CodeIgniter\Model;

class Member_Model extends Model {

    protected $table = "member";

    protected $allowedFields = ['id_member', 'nama_lengkap', 'no_telepon'];
}
