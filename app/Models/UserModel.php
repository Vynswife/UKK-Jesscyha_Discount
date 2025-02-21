<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['email', 'level'];

    // Method to get users by level
    public function getUsersByLevel($level)
    {
        return $this->where('level', $level)->findAll(); // Returns users with matching level
    }
}
