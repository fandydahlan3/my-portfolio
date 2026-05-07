<?php

namespace App\Controllers;

use App\Models\m_iuran;
use App\Models\m_anggota;

class Iuran extends BaseController
{
    protected $iuranModel;

    public function __construct()
    {
        $this->iuranModel = new m_iuran();
    }

    public function index()
    {
        $anggotaModel = new m_anggota();
        $role = strtolower(session()->get('role')); 
        $nomorAnggota = session()->get('nomor_anggota'); 

        $data['anggota'] = $anggotaModel
            ->select('nomor_anggota, nama_anggota')
            ->orderBy('nama_anggota', 'ASC')
            ->findAll();

        $queryIuran = $this->iuranModel
            ->select('
                data_iuran.id_iuran,
                data_iuran.nomor_anggota,
                anggota.nama_anggota,
                data_iuran.iuran_pokok,
                data_iuran.iuran_wajib,
                data_iuran.iuran_sukarela,
                data_iuran.tanggal_iuran
            ')
            ->join('anggota', 'anggota.nomor_anggota = data_iuran.nomor_anggota');

        // Filter biar member cuma lihat punya sendiri
        if ($role !== 'admin') {
            $queryIuran->where('data_iuran.nomor_anggota', $nomorAnggota);
        }

        $data['iuran'] = $queryIuran->findAll();

        return view('data-iuran', $data);
    }
    public function store()
    {
        // Ambil ID User yang sedang login
        $userId = session()->get('id_user');

        $this->iuranModel->insert([
            'id_user'        => $userId, 
            'nomor_anggota'  => $this->request->getPost('nomor_anggota'),
            'iuran_pokok'    => $this->request->getPost('iuran_pokok'),
            'iuran_wajib'    => $this->request->getPost('iuran_wajib'),
            'iuran_sukarela' => $this->request->getPost('iuran_sukarela'),
            'tanggal_iuran'  => $this->request->getPost('tanggal_iuran'),
        ]);

        return redirect()->to('/iuran');
    }

    public function searchAnggota()
    {
        $keyword = $this->request->getGet('q');

        $anggota = (new m_anggota())
            ->like('nama_anggota', $keyword)
            ->orLike('nomor_anggota', $keyword)
            ->findAll(10);

        $data = [];

        foreach ($anggota as $a) {
            $data[] = [
                'id'   => $a['nomor_anggota'],
                'text' => $a['nomor_anggota'] . ' - ' . $a['nama_anggota']
            ];
        }

        return $this->response->setJSON($data);
    }
}