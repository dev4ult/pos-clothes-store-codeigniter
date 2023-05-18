<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_Model extends Model {

    protected $table = "admin";

    protected $allowedFields = ['id_admin', 'username', 'email', 'password', 'foto_profil'];
}
