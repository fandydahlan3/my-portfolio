<?php
namespace App\Models;
use CodeIgniter\Model;

class m_pembayaran extends Model {
    protected $table = 'pembayaran_angsuran';
    protected $primaryKey = 'id_pembayaran';
    protected $allowedFields = ['id_angsuran','nominal_bayar','tanggal_bayar','status'];
}
