<?php
namespace App\Controllers;
use App\Models\m_usaha;

class Usaha extends BaseController
{
    protected $usahaModel;

    public function __construct()
    {
        $this->usahaModel = new m_usaha();
    }

    // tampil data usaha
    public function index()
    {
        $data['usaha'] = $this->usahaModel->findAll();
        return view('data-usaha', $data);
    }

    // simpan usaha baru
    public function store()
    {
        $this->usahaModel->save([
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'alamat_usaha' => $this->request->getPost('alamat_usaha'),
            'tanggal_usaha' => $this->request->getPost('tanggal_usaha'),
        ]);
        return redirect()->to(base_url('usaha'));
    }

    // update usaha
    public function update($id)
    {
        $this->usahaModel->update($id, [
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'alamat_usaha' => $this->request->getPost('alamat_usaha'),
            'tanggal_usaha' => $this->request->getPost('tanggal_usaha'),
        ]);
        return redirect()->to(base_url('usaha'));
    }

    // hapus usaha
    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->table('data_pendapatan')->where('id_usaha', $id)->delete();
        $this->usahaModel->delete($id);

        return redirect()->to(base_url('usaha'));
    }
}
