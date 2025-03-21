<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('role') === 'admin') {
            return redirect()->to('/admin');
        }
        
        return view('/dashboard');
    }
}