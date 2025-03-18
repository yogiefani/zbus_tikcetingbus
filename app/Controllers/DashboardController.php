<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\ScheduleModel;
use App\Models\RouteModel;

class DashboardController extends BaseController
{
    protected $bookingModel;
    protected $scheduleModel;
    protected $routeModel;
    protected $session;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->scheduleModel = new ScheduleModel();
        $this->routeModel = new RouteModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $userId = $this->session->get('user_id');
        
        // Get recent bookings
        $recentBookings = $this->bookingModel
            ->select('bookings.*, schedules.departure_date, routes.origin, routes.destination')
            ->join('schedules', 'schedules.id = bookings.schedule_id')
            ->join('routes', 'routes.id = schedules.route_id')
            ->where('bookings.user_id', $userId)
            ->orderBy('bookings.booking_date', 'DESC')
            ->limit(5)
            ->find();
        
        // Get upcoming trips
        $upcomingTrips = $this->bookingModel
            ->select('bookings.*, schedules.departure_date, schedules.departure_time, routes.origin, routes.destination')
            ->join('schedules', 'schedules.id = bookings.schedule_id')
            ->join('routes', 'routes.id = schedules.route_id')
            ->where('bookings.user_id', $userId)
            ->where('bookings.status', 'confirmed')
            ->where('schedules.departure_date >=', date('Y-m-d'))
            ->orderBy('schedules.departure_date', 'ASC')
            ->limit(3)
            ->find();
        
        // Get popular routes
        $popularRoutes = $this->routeModel
            ->select('routes.*, COUNT(bookings.id) as booking_count')
            ->join('schedules', 'schedules.route_id = routes.id')
            ->join('bookings', 'bookings.schedule_id = schedules.id')
            ->groupBy('routes.id')
            ->orderBy('booking_count', 'DESC')
            ->limit(5)
            ->find();
        
        return view('dashboard', [
            'recentBookings' => $recentBookings,
            'upcomingTrips' => $upcomingTrips,
            'popularRoutes' => $popularRoutes
        ]);
    }
}