<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RouteModel;

class RouteController extends BaseController
{
    protected $routeModel;

    public function __construct()
    {
        $this->routeModel = new RouteModel();
    }

    public function index()
    {
        $routes = $this->routeModel->orderBy('origin', 'ASC')->findAll();
        
        return view('admin/routes/index', [
            'routes' => $routes
        ]);
    }

    public function add()
    {
        return view('admin/routes/form', [
            'route' => null,
            'title' => 'Tambah Rute',
            'action' => 'add'
        ]);
    }

    public function save()
    {
        $rules = [
            'origin' => 'required|min_length[3]',
            'destination' => 'required|min_length[3]',
            'distance' => 'required|numeric|greater_than[0]',
            'status' => 'required|in_list[active,inactive]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'origin' => $this->request->getPost('origin'),
            'destination' => $this->request->getPost('destination'),
            'distance' => $this->request->getPost('distance'),
            'status' => $this->request->getPost('status')
        ];
        
        $this->routeModel->insert($data);
        
        return redirect()->to('admin/routes')->with('success', 'Rute berhasil ditambahkan');
    }

    public function edit($id)
    {
        $route = $this->routeModel->find($id);
        
        if (!$route) {
            return redirect()->to('admin/routes')->with('error', 'Rute tidak ditemukan');
        }
        
        return view('admin/routes/form', [
            'route' => $route,
            'title' => 'Edit Rute',
            'action' => 'update/' . $id
        ]);
    }

    public function update($id)
    {
        $route = $this->routeModel->find($id);
        
        if (!$route) {
            return redirect()->to('admin/routes')->with('error', 'Rute tidak ditemukan');
        }
        
        $rules = [
            'origin' => 'required|min_length[3]',
            'destination' => 'required|min_length[3]',
            'distance' => 'required|numeric|greater_than[0]',
            'status' => 'required|in_list[active,inactive]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'origin' => $this->request->getPost('origin'),
            'destination' => $this->request->getPost('destination'),
            'distance' => $this->request->getPost('distance'),
            'status' => $this->request->getPost('status')
        ];
        
        $this->routeModel->update($id, $data);
        
        return redirect()->to('admin/routes')->with('success', 'Rute berhasil diperbarui');
    }

    public function delete($id)
    {
        $route = $this->routeModel->find($id);
        
        if (!$route) {
            return redirect()->to('admin/routes')->with('error', 'Rute tidak ditemukan');
        }
        
        // Check if route is used in any schedules
        $db = \Config\Database::connect();
        $scheduleCount = $db->table('schedules')->where('route_id', $id)->countAllResults();
        
        if ($scheduleCount > 0) {
            return redirect()->to('admin/routes')->with('error', 'Rute tidak dapat dihapus karena digunakan dalam jadwal');
        }
        
        $this->routeModel->delete($id);
        
        return redirect()->to('admin/routes')->with('success', 'Rute berhasil dihapus');
    }
}