<?php

namespace App\Models;
use CodeIgniter\Model;

class m_d_angsuran extends Model
{
    protected $table = 'data_angsuran';
    protected $primaryKey = 'id_angsuran';
    protected $allowedFields = ['nomor_anggota','nominal_angsuran','tanggal_angsuran','status'];
}