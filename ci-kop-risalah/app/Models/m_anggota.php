<?php

namespace App\Models;

use CodeIgniter\Model;

class m_anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'nomor_anggota';

    protected $allowedFields = [
        'nomor_anggota',
        'nama_anggota',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'tanggal_lahir',
        'tanggal_daftar'
    ];
}
