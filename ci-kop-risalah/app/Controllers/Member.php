<?php

namespace App\Controllers;

use App\Models\M_user;
use App\Models\M_anggota; 

class Member extends BaseController
{
    protected $userModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->userModel = new M_user();
        $this->anggotaModel = new M_anggota(); 
    }

    public function index()
    {
        $session = session();
        $db = \Config\Database::connect();
        
        $builder = $db->table('users');
        $builder->select('users.*, anggota.nama_anggota');
        $builder->join('anggota', 'anggota.nomor_anggota = users.nomor_anggota', 'left');

        $userRole = strtolower($session->get('role') ?? '');

        if ($userRole === 'admin') {
            $data['anggota'] = $builder->get()->getResultArray();
        } else {
            $data['anggota'] = $builder->where('users.id', $session->get('id_user'))->get()->getResultArray();
        }

        $data['list_anggota'] = $this->anggotaModel->findAll();

        return view('Member', $data);
    }

    public function store()
    {
      
        $username = $this->request->getPost('username');
        $cek = $this->userModel->where('username', $username)->first();

        if ($cek) {
            return redirect()->back()->withInput()->with('error', 'Username sudah terdaftar!');
        }

        $data = [
            'username'      => $username,
            'nomor_anggota' => $this->request->getPost('nomor_anggota'),
            'role'          => $this->request->getPost('role'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap'  => $username
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to(base_url('member'))->with('success', 'Akun berhasil dibuat!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }

    public function reset_password($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('member')->with('error', 'User tidak ditemukan!');
        }

        $this->userModel->update($id, [
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ]);

        return redirect()->to('member')->with('success', 'Password ' . $user['username'] . ' berhasil direset!');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('member')->with('success', 'Akun berhasil dihapus!');
    }
} 