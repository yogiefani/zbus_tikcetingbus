<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        
        return view('auth/login');
    }

    public function processLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $user = $this->userModel->where('email', $email)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            $this->session->set([
                'user_id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);
            
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password salah')->withInput();
        }
    }

    public function register()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        
        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'phone' => 'required|numeric|min_length[10]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone' => $this->request->getPost('phone'),
            'role' => 'user'
        ];
        
        $this->userModel->insert($data);
        
        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}