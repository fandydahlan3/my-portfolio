<?php

namespace App\Controllers;

// Pastikan memanggil BaseController
use App\Controllers\BaseController; 
use App\Models\m_user;

class Profile extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'));
        }

        $userModel = new m_user();
        $data = [
            'title' => 'Profil Saya',
            'user'  => $userModel->find(session()->get('id_user'))
        ];
        return view('pages/v_profile', $data);
    }

    public function update()
    {
        $userModel = new m_user();
        $id = session()->get('id_user');
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
        ];

        $passBaru = $this->request->getPost('password_baru');
        if (!empty($passBaru)) {
            $data['password'] = password_hash($passBaru, PASSWORD_BCRYPT);
        }

        $userModel->update($id, $data);
        session()->set('nama', $data['nama_lengkap']);
        return redirect()->to(base_url('profile'))->with('success', 'Profil diperbarui!');
    }
}