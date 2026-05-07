<?php

namespace App\Controllers;

use App\Models\M_anggota;

class Anggota extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new M_anggota();
    }

    public function index()
    {
        $data['anggota'] = $this->anggotaModel->findAll();
        return view('data-anggota', $data);
    }

    public function store()
    {
        $this->anggotaModel->insert([
            'nomor_anggota'  => $this->request->getPost('nomor_anggota'),
            'nama_anggota'   => $this->request->getPost('nama_anggota'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'tanggal_daftar' => $this->request->getPost('tanggal_daftar'),
        ]);

        return redirect()->to('anggota');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        // 1. Cari ID angsuran untuk hapus pembayarannya dulu
        $angsuranIds = $db->table('data_angsuran')
                          ->select('id_angsuran')
                          ->where('nomor_anggota', $id)
                          ->get()
                          ->getResultArray();

        if (!empty($angsuranIds)) {
            $ids = array_column($angsuranIds, 'id_angsuran');
            // Hapus detail pembayaran
            $db->table('pembayaran_angsuran')->whereIn('id_angsuran', $ids)->delete();
        }

        // 2. Hapus data di tabel data_angsuran
        $db->table('data_angsuran')->where('nomor_anggota', $id)->delete();

        // 3. Hapus data di tabel data_iuran
        $db->table('data_iuran')->where('nomor_anggota', $id)->delete();

        // 4. Baru hapus data utama di tabel anggota
        $this->anggotaModel->delete($id);

        return redirect()->to('/anggota');
    }

    public function update()
    {
        $nomor = $this->request->getPost('nomor_anggota');

        $data = [
            'nama_anggota'   => $this->request->getPost('nama_anggota'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'tanggal_daftar' => $this->request->getPost('tanggal_daftar'),
        ];

        $this->anggotaModel->update($nomor, $data);

        return redirect()->to('/anggota')->with('success', 'Data berhasil diupdate');
    }
}