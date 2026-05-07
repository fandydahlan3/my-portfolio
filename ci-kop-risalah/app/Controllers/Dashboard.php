<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // 1. Cek Login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'));
        }

        $db = \Config\Database::connect();
        $tahunSekarang = date('Y');
        $role  = session()->get('role');
        $nomor = session()->get('nomor_anggota');

        $whereUser = "";
        if ($role !== 'admin') {
            // Jika bukan admin, WAJIB filter berdasarkan nomor_anggota
            if (!empty($nomor)) {
                $whereUser = " WHERE nomor_anggota = '$nomor' ";
            } else {
                $whereUser = " WHERE nomor_anggota = 'KOSONG_DI_SESSION' ";
            }
        }

        // --- QUERY DATA IURAN ---
        $queryIuran = $db->query("SELECT 
            SUM(IFNULL(iuran_pokok, 0)) as pokok, 
            SUM(IFNULL(iuran_wajib, 0)) as wajib, 
            SUM(IFNULL(iuran_sukarela, 0)) as sukarela 
            FROM data_iuran $whereUser")->getRow();

        // --- QUERY DATA ANGSURAN ---
        $whereAngsuran = $whereUser; 
            if (empty($whereAngsuran)) {
                $whereAngsuran = " WHERE LOWER(status) != 'lunas' ";
            } else {
                $whereAngsuran .= " AND LOWER(status) != 'lunas' ";
            }

        $queryAngsuran = $db->query("SELECT 
            SUM(
                IFNULL(nominal_angsuran, 0) - 
                IFNULL((SELECT SUM(nominal_bayar) FROM pembayaran_angsuran WHERE pembayaran_angsuran.id_angsuran = data_angsuran.id_angsuran), 0)
            ) as total 
            FROM data_angsuran $whereAngsuran")->getRow();

        // --- QUERY PENDAPATAN USAHA (Tampil untuk semua) ---
        $queryPendapatan = $db->query("SELECT SUM(IFNULL(jumlah_pendapatan, 0)) as total FROM data_pendapatan")->getRow();
        $daftarUsaha     = $db->table('data_pendapatan')->get()->getResult();
        $totalUnitUsaha  = $db->table('data_pendapatan')->countAllResults();
        $queryTahunan = $db->query("SELECT SUM(IFNULL(jumlah_pendapatan, 0)) as total 
                            FROM data_pendapatan 
                            WHERE YEAR(tanggal_pendapatan) = '$tahunSekarang'")->getRow();

        // 4. Perhitungan Header
        $totalHeader = ($queryIuran->pokok ?? 0) + ($queryIuran->wajib ?? 0) + ($queryIuran->sukarela ?? 0);
        $targetUsaha = 100000000; 
        $totalPendapatan = $queryPendapatan->total ?? 0;
        $persenUsaha = ($totalPendapatan > 0) ? ($totalPendapatan / $targetUsaha) * 100 : 0;

        $data = [
            'title'                    => 'Dashboard - KOPERASI AR - RISALAH',
            'total_iuran_header'       => $totalHeader,
            'persen_usaha'             => $persenUsaha,
            'total_pendapatan'         => $totalPendapatan,
            'total_pendapatan_tahunan' => $queryTahunan->total ?? 0,
            'total_unit_usaha'         => $totalUnitUsaha,
            'daftar_usaha'             => $daftarUsaha,
            'total_pokok'              => $queryIuran->pokok ?? 0,
            'total_wajib'              => $queryIuran->wajib ?? 0,
            'total_sukarela'           => $queryIuran->sukarela ?? 0,
            'total_angsuran'           => $queryAngsuran->total ?? 0,
            'tahun_ini'                => $tahunSekarang,
        ];

        return view('dashboard', $data);
    }
}