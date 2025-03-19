<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function profile()
    {
        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);
        
        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        return view('user/profile', [
            'user' => $user
        ]);
    }

    public function updateProfile()
    {
        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);
        
        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        $rules = [
            'name' => 'required|min_length[3]',
            'phone' => 'required|numeric|min_length[10]',
            'address' => 'permit_empty'
        ];
        
        if ($this->request->getPost('email') != $user['email']) {
            $rules['email'] = 'required|valid_email|is_unique[users.email]';
        }
        
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ];
        
        if ($this->request->getPost('email') != $user['email']) {
            $data['email'] = $this->request->getPost('email');
        }
        
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        
        $this->userModel->update($userId, $data);
        
        // Update session data
        $this->session->set([
            'name' => $data['name'],
            'email' => $data['email'] ?? $user['email']
        ]);
        
        return redirect()->to('/profile')->with('success', 'Profile berhasil diperbarui');
    }
}