<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\ScheduleModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $scheduleModel;
    protected $session;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->scheduleModel = new ScheduleModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $bookings = $this->bookingModel
            ->select('bookings.*, users.name as user_name, schedules.departure_date, schedules.departure_time, routes.origin, routes.destination, buses.name as bus_name')
            ->join('users', 'users.id = bookings.user_id')
            ->join('schedules', 'schedules.id = bookings.schedule_id')
            ->join('routes', 'routes.id = schedules.route_id')
            ->join('buses', 'buses.id = schedules.bus_id')
            ->orderBy('bookings.booking_date', 'DESC')
            ->findAll();
        
        return view('admin/bookings/index', [
            'bookings' => $bookings
        ]);
    }

    public function details($id)
    {
        $booking = $this->bookingModel
            ->select('bookings.*, users.name as user_name, users.email, users.phone, schedules.departure_date, schedules.departure_time, schedules.arrival_time, schedules.price, routes.origin, routes.destination, buses.name as bus_name, buses.type as bus_type')
            ->join('users', 'users.id = bookings.user_id')
            ->join('schedules', 'schedules.id = bookings.schedule_id')
            ->join('routes', 'routes.id = schedules.route_id')
            ->join('buses', 'buses.id = schedules.bus_id')
            ->where('bookings.id', $id)
            ->first();
        
        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Pemesanan tidak ditemukan');
        }
        
        return view('admin/bookings/details', [
            'booking' => $booking
        ]);
    }

    public function confirm($id)
    {
        $booking = $this->bookingModel->find($id);
        
        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Pemesanan tidak ditemukan');
        }
        
        $this->bookingModel->update($id, [
            'status' => 'confirmed',
            'payment_status' => 'paid'
        ]);
        
        return redirect()->to('/admin/bookings')->with('success', 'Status pemesanan berhasil diubah');
    }

    public function cancel($id)
    {
        $booking = $this->bookingModel->find($id);
        
        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Pemesanan tidak ditemukan');
        }
        
        $this->bookingModel->update($id, [
            'status' => 'cancelled'
        ]);
        
        // Return seats to availability
        $schedule = $this->scheduleModel->find($booking['schedule_id']);
        $this->scheduleModel->update($booking['schedule_id'], [
            'available_seats' => $schedule['available_seats'] + $booking['seats']
        ]);
        
        return redirect()->to('/admin/bookings')->with('success', 'Pemesanan berhasil dibatalkan');
    }
}