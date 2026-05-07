<?php
namespace App\Models;

use CodeIgniter\Model;

class m_input_kop extends Model
{
    protected $table = 'data_pendapatan'; 
    protected $primaryKey = 'id_pendapatan';
    protected $allowedFields = [
        'id_usaha',
        'jenis_pendapatan',
        'jumlah_pendapatan',
        'tanggal_pendapatan'
    ];

    public function getPendapatanWithUsaha()
{
    return $this->select('data_pendapatan.*, data_usaha.nama_usaha')
                ->join('data_usaha', 'data_usaha.id_usaha = data_pendapatan.id_usaha')
                ->findAll();
}

}
