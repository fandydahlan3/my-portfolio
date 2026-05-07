<?php

namespace App\Models;

use CodeIgniter\Model;

class m_iuran extends Model
{
    protected $table = 'data_iuran';
    protected $primaryKey = 'id_iuran';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nomor_anggota',
        'iuran_pokok',
        'iuran_wajib',
        'iuran_sukarela',
        'tanggal_iuran'
    ];
}
