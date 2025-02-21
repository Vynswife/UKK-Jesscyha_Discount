<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table      = 'surat_m';
    protected $primaryKey = 'id_surat';

    protected $allowedFields = [
        'id_folder', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_surat', 'prioritas',
        'status', 'status_menunggu', 'lampiran', 'kategori', 'sub_kategori', 'no_agenda', 'file'
    ];

    // Fungsi untuk mengambil surat berdasarkan id_folder
    public function getSuratByFolder($id_folder)
    {
        return $this->where('id_folder', $id_folder)
                    ->orderBy('id_surat', 'desc')
                    ->findAll();
    }
}
