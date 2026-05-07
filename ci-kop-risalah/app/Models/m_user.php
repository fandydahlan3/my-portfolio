<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'nomor_anggota', 'role'];

    // PAKSA MATIKAN TIMESTAMPS UNTUK TES
    protected $useTimestamps = false; 
}