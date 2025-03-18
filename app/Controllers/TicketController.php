<?php

namespace App\Controllers;

use App\Models\ScheduleModel;
use App\Models\BookingModel;
use App\Models\RouteModel;

class TicketController extends BaseController
{
    protected $scheduleModel;
    protected $bookingModel;
    protected $routeModel;
    protected $session;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->bookingModel = new BookingModel();
        $this->routeModel = new RouteModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $routes = $this->routeModel->findAll();
        
        return view('tickets/search', [
            'routes' => $routes
        ]);
    }

    public function search()
    {
        $origin = $this->request->getGet('origin');
        $destination = $this->request->getGet('destination');
        $date = $this->request->getGet('date');
        
        $schedules = $this->scheduleModel
            ->select('schedules.*, routes.origin, routes.destination, routes.distance, buses.name as bus_name, buses.type as bus_type, buses.capacity')
            ->join('routes', 'routes.id = schedules.route_id')
            ->join('buses', 'buses.id = schedules.bus_id')
            ->where('routes.origin', $origin)
            ->where('routes.destination', $destination)
            ->where('schedules.departure_date', $date)
            ->where('schedules.available_seats >', 0)
            ->findAll();
        
        return view('tickets/results', [
            'schedules' => $schedules,
            'origin' => $origin,
            'destination' => $destination,
            'date' => $date
        ]);
    }

    public function book($scheduleId)
    {
        $schedule = $this->scheduleModel
            ->select('schedules.*, routes.origin, routes.destination, routes.distance, buses.name as bus_name, buses.type as bus_type')
            ->join('routes', 'routes.id = schedules.route_id')
            ->join('buses', 'buses.id = schedules.bus_id')
            ->where('schedules.id', $scheduleId)
            ->first();
        
        if (!$schedule) {
            return redirect()->to('/tickets')->with('error', 'Jadwal tidak ditemukan');
        }
        
        return view('tickets/book', [
            'schedule' => $schedule
        ]);
    }

    public function confirmBooking()
    {
        $scheduleId = $this->request->getPost('schedule_id');
        $seats = (int) $this->request->getPost('seats');
        $userId = $this->session->get('user_id');
        
        $schedule = $this->scheduleModel->find($scheduleId);
        
        if (!$schedule || $schedule['available_seats'] < $seats) {
            return redirect()->to('/tickets')->with('error', 'Kursi tidak tersedia');
        }
        
        $booking = [
            'user_id' => $userId,
            'schedule_id' => $scheduleId,
            'seats' => $seats,
            'total_price' => $schedule['price'] * $seats,
            'booking_date' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ];
        
        $this->bookingModel->insert($booking);
        $bookingId = $this->bookingModel->insertID();
        
        // Update available seats
        $this->scheduleModel->update($scheduleId, [
            'available_seats' => $schedule['available_seats'] - $seats
        ]);
        
        return redirect()->to('/bookings/' . $bookingId)->with('success', 'Pemesanan berhasil dibuat');
    }
}