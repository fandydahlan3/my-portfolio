<?php

namespace App\Controllers;

use App\Models\m_d_angsuran;
use App\Models\m_pembayaran;
use App\Models\m_anggota;

class d_angsuran extends BaseController
{
    protected $angsuran;
    protected $pembayaran;
    protected $anggotaModel;

    public function __construct()
    {
        $this->angsuran     = new m_d_angsuran();
        $this->pembayaran   = new m_pembayaran();
        $this->anggotaModel = new m_anggota();
    }

    public function index()
    {
        $role = strtolower(session()->get('role')); 
        $nomorAnggota = session()->get('nomor_anggota'); 

        $db      = \Config\Database::connect();
        // Gunakan 'data_angsuran' sesuai isi file Model kamu
        $builder = $db->table('data_angsuran'); 
        
        // Ambil semua dari data_angsuran + nama dari tabel anggota
        $builder->select('data_angsuran.*, anggota.nama_anggota');
        $builder->join('anggota', 'anggota.nomor_anggota = data_angsuran.nomor_anggota', 'left');

        if ($role !== 'admin') {
            $builder->where('data_angsuran.nomor_anggota', $nomorAnggota);
        }

        $angsuran = $builder->get()->getResultArray();

        foreach ($angsuran as &$row) {
            // ... kode perhitungan total, terbayar, sisa tetap sama seperti sebelumnya ...
            $total = $row['nominal_angsuran'];
            $terbayar = (int) $this->pembayaran
                ->selectSum('nominal_bayar')
                ->where('id_angsuran', $row['id_angsuran'])
                ->where('status', 'Lunas')
                ->get()
                ->getRow()
                ->nominal_bayar ?? 0;

            $sisa = max($total - $terbayar, 0);
            $row['total'] = $total;
            $row['terbayar'] = $terbayar;
            $row['sisa'] = $sisa;
            $row['status'] = ($sisa <= 0) ? 'Lunas' : 'DICICIL';
        }
        unset($row);

        return view('data-angsuran', [
            'angsuran' => $angsuran,
            'anggota'  => $this->anggotaModel->findAll()
        ]);
    }

// 1. Fungsi untuk simpan cicilan (dipanggil lewat AJAX di View kamu)
    public function store_cicilan()
    {
        $id_angsuran  = $this->request->getPost('id_angsuran');
        $nominal_bayar = $this->request->getPost('nominal_bayar');
        $tanggal_bayar = $this->request->getPost('tanggal_bayar');

        // Simpan ke tabel pembayaran_angsuran
        $this->pembayaran->insert([
            'id_angsuran'   => $id_angsuran,
            'nominal_bayar' => $nominal_bayar,
            'tanggal_bayar' => $tanggal_bayar,
            'status'        => 'Lunas'
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    // 2. Fungsi untuk mendapatkan riwayat cicilan (untuk Modal Detail)
    public function get_cicilan($id)
    {
        $data = $this->pembayaran->where('id_angsuran', $id)->findAll();
        
        if (empty($data)) {
            echo '<tr><td colspan="4" class="text-center">Belum ada riwayat cicilan</td></tr>';
            return;
        }

        $no = 1;
        foreach ($data as $row) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>" . date('d-m-Y', strtotime($row['tanggal_bayar'])) . "</td>
                    <td>Rp " . number_format($row['nominal_bayar'], 0, ',', '.') . "</td>
                    <td><span class='badge bg-success'>{$row['status']}</span></td>
                  </tr>";
            $no++;
        }
    }

    // 3. Fungsi Lunasi (Hapus sisa hutang dengan sekali bayar)
    public function lunasi($id)
    {
        $data = $this->angsuran->find($id);
        $total = $data['nominal_angsuran'];

        $terbayar = (int) $this->pembayaran
            ->selectSum('nominal_bayar')
            ->where('id_angsuran', $id)
            ->get()->getRow()->nominal_bayar ?? 0;

        $sisa = $total - $terbayar;

        if ($sisa > 0) {
            $this->pembayaran->insert([
                'id_angsuran'   => $id,
                'nominal_bayar' => $sisa,
                'tanggal_bayar' => date('Y-m-d'),
                'status'        => 'Lunas'
            ]);
        }

        return redirect()->to('/d_angsuran')->with('success', 'Angsuran berhasil dilunasi');
    }

    // Fungsi simpan 
    public function store()
    {
        $this->angsuran->insert([
            'id_user'          => session()->get('id_user'), // WAJIB ADA
            'nomor_anggota'    => $this->request->getPost('nomor_anggota'),
            'nominal_angsuran' => $this->request->getPost('nominal_angsuran'),
            'tanggal_angsuran' => $this->request->getPost('tanggal_angsuran'),
            'status'           => 'CICIL'
        ]);

        return redirect()->to('/d_angsuran');
    }

    
}