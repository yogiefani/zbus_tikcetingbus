<?php

namespace App\Controllers;

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
        $userId = $this->session->get('user_id');
        
        $bookings = $this->bookingModel
            ->select('bookings.*, schedules.departure_date, schedules.departure_time, schedules.arrival_time, routes.origin, routes.destination, buses.name as bus_name')
            ->join('schedules', 'schedules.id = bookings.schedule_id')
            ->join('routes', 'routes.id = schedules.route_id')
            ->join('buses', 'buses.id = schedules.bus_id')
            ->where('bookings.user_id', $userId)
            ->orderBy('bookings.booking_date', 'DESC')
            ->findAll();
        
        return view('bookings/index', [
            'bookings' => $bookings
        ]);
    }

    public function details($id)
    {
        $userId = $this->session->get('user_id');
        
        $booking = $this->bookingModel
            ->select('bookings.*, schedules.departure_date, schedules.departure_time, schedules.arrival_time, schedules.price, routes.origin, routes.destination, routes.distance, buses.name as bus_name, buses.type as bus_type')
            ->join('schedules', 'schedules.id = bookings.schedule_id')
            ->join('routes', 'routes.id = schedules.route_id')
            ->join('buses', 'buses.id = schedules.bus_id')
            ->where('bookings.id', $id)
            ->where('bookings.user_id', $userId)
            ->first();
        
        if (!$booking) {
            return redirect()->to('/bookings')->with('error', 'Pemesanan tidak ditemukan');
        }
        
        return view('bookings/details', [
            'booking' => $booking
        ]);
    }

    public function cancel($id)
    {
        $userId = $this->session->get('user_id');
        
        $booking = $this->bookingModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->where('status !=', 'cancelled')
            ->first();
        
        if (!$booking) {
            return redirect()->to('/bookings')->with('error', 'Pemesanan tidak dapat dibatalkan');
        }
        
        // Update booking status
        $this->bookingModel->update($id, [
            'status' => 'cancelled'
        ]);
        
        // Return seats to availability
        $schedule = $this->scheduleModel->find($booking['schedule_id']);
        $this->scheduleModel->update($booking['schedule_id'], [
            'available_seats' => $schedule['available_seats'] + $booking['seats']
        ]);
        
        return redirect()->to('/bookings')->with('success', 'Pemesanan berhasil dibatalkan');
    }
}