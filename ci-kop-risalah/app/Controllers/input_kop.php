<?php

namespace App\Controllers;

use App\Models\m_input_kop;
use App\Models\m_usaha;

class Input_kop extends BaseController
{
    protected $inputKop;

    public function __construct()
    {
        $this->inputKop = new m_input_kop();
    }

    public function index()
    {
        $data['pendapatan'] = $this->inputKop->getPendapatanWithUsaha();
        
        $usahaModel = new m_usaha();
        $data['usaha'] = $usahaModel->findAll();

        return view('input-pendapatan-usaha', $data);
    }

    // Fungsi untuk AJAX Modal Edit
    public function edit($id = null)
    {
        if ($id == null) return "ID tidak ditemukan";
        $data['pendapatan'] = $this->inputKop->find($id);
        $usahaModel = new \App\Models\m_usaha();
        $data['usaha'] = $usahaModel->findAll();

        // Cek apakah data ditemukan, jika tidak kirim error agar AJAX tahu
        if (!$data['pendapatan']) {
            return $this->response->setStatusCode(404, 'Data tidak ditemukan');
        }

        return view('edit/e-input-kop', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_pendapatan');
        $this->inputKop->update($id, [
            'id_usaha'           => $this->request->getPost('id_usaha'),
            'jumlah_pendapatan'  => $this->request->getPost('jumlah_pendapatan'),
            'tanggal_pendapatan' => $this->request->getPost('tanggal_pendapatan'),
        ]);

        session()->setFlashdata('success', 'Data berhasil diperbarui.');
        return redirect()->to(base_url('input_kop'));
    }

    public function store()
    {
        $this->inputKop->save([
            'id_usaha'           => $this->request->getPost('id_usaha'),
            'jumlah_pendapatan'  => $this->request->getPost('jumlah_pendapatan'),
            'tanggal_pendapatan' => $this->request->getPost('tanggal_pendapatan'),
        ]);

        session()->setFlashdata('success', 'Data Pendapatan Berhasil Ditambah!');
        return redirect()->to(base_url('input_kop'));
    }

    public function delete($id)
    {
        $this->inputKop->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('input_kop'));
    }
}