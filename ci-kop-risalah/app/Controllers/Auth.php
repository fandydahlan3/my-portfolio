<?php

namespace App\Controllers;

use App\Models\m_user;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new m_user();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/v_login');
    }

    public function login_action() 
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Cari user berdasarkan username
        $user = $this->userModel->where('username', $username)->first();

        // Jika user ditemukan dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            
            // Simpan semua data penting ke dalam session
            session()->set([
                'id_user'       => $user['id'],
                'username'      => $user['username'],
                'nama'          => $user['nama_lengkap'], // Nama yang akan muncul di Dashboard
                'role'          => $user['role'],         // Admin atau User
                'nomor_anggota' => $user['nomor_anggota'], // Nomor untuk filter iuran
                'logged_in'     => true,
            ]);

            return redirect()->to(base_url('dashboard')); 
        } else {
            // Jika gagal, kembali ke login dengan pesan error
            return redirect()->to(base_url('auth'))->with('error', 'Username atau Password Salah!');
        }
    }
    
    public function register_action()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'username'      => $this->request->getPost('username'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'nomor_anggota' => $this->request->getPost('nomor_anggota'), // TAMBAHKAN INI
            'role'          => $this->request->getPost('role') 
        ];

        $this->userModel->save($data);
        session()->setFlashdata('success', 'Akun ' . $data['role'] . ' berhasil didaftarkan!');
        return redirect()->to(base_url('dashboard')); 
    }

    public function change_password()
    {
        if (!session()->get('logged_in')) return redirect()->to(base_url('auth'));
        return view('auth/v_ganti_password');
    }

    public function update_password()
    {
        $username = session()->get('username');
        $pass_baru = $this->request->getPost('password_baru');

        $data = [
            'password' => password_hash($pass_baru, PASSWORD_BCRYPT)
        ];

        $this->userModel->where('username', $username)->set($data)->update();

        session()->setFlashdata('success', 'Password berhasil diperbarui!');
        return redirect()->to(base_url('dashboard'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth'));
    }
}