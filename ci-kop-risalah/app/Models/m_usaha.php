<?php

namespace App\Models;
use CodeIgniter\Model;

class m_usaha extends Model
{
    protected $table = 'data_usaha'; 
    protected $primaryKey = 'id_usaha';
    protected $allowedFields = ['nama_usaha', 'alamat_usaha', 'tanggal_usaha'];
}