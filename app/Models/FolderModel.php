<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
    protected $table      = 'folder';
    protected $primaryKey = 'id_folder';

    protected $allowedFields = ['nama_folder', 'permission'];

    // Fungsi untuk mengambil semua folder
    public function getAllFolders()
    {
        return $this->findAll();
    }
}
