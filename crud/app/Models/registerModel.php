<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'User_id';
    protected $allowedFields = ['User_user', 'User_password', 'Roles_fk', 'User_status_fk'];
    protected $useTimestamps = true;
}
