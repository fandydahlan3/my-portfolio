<?php namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model {
    public function getSummary() {
        $db = \Config\Database::connect();

        return [
            // Menghitung total iuran dari tabel data_iuran
            'total_pokok'    => $db->table('data_iuran')->selectSum('iuran_pokok')->get()->getRow()->iuran_pokok ?? 0,
            'total_wajib'    => $db->table('data_iuran')->selectSum('iuran_wajib')->get()->getRow()->iuran_wajib ?? 0,
            'total_sukarela' => $db->table('data_iuran')->selectSum('iuran_sukarela')->get()->getRow()->iuran_sukarela ?? 0,
            
            // Menghitung total angsuran
            'total_angsuran' => $db->table('data_angsuran')->selectSum('jumlah_angsuran')->get()->getRow()->jumlah_angsuran ?? 0,
            
            // Menghitung pendapatan usaha
            'total_pendapatan' => $db->table('data_pendapatan')->selectSum('jumlah_pendapatan')->get()->getRow()->jumlah_pendapatan ?? 0,
            
            // Mengambil 5 transaksi terakhir dari tabel pembayaran_angsuran
            'recent_transactions' => $db->table('pembayaran_angsuran')
                                        ->orderBy('tanggal_bayar', 'DESC')
                                        ->limit(5)
                                        ->get()
                                        ->getResultArray()
        ];
    }
}