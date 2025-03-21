<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\ScheduleModel;
use App\Models\RouteModel;
use App\Models\BusModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $bookingModel;
    protected $scheduleModel;
    protected $routeModel;
    protected $busModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->scheduleModel = new ScheduleModel();
        $this->routeModel = new RouteModel();
        $this->busModel = new BusModel();
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }
    

    public function index()
    {
        // Count total schedules
        $totalSchedules = $this->scheduleModel->countAll();
        
        // Count total routes
        $totalRoutes = $this->routeModel->countAll();
        
        // Count total buses
        $totalBuses = $this->busModel->countAll();
        
        // Count total users
        $totalUsers = $this->userModel->where('role', 'user')->countAllResults();
        
        // Count total bookings
        $totalBookings = $this->bookingModel->countAll();
        
        // Count confirmed bookings
        $confirmedBookings = $this->bookingModel->where('status', 'confirmed')->countAllResults();
        
        // Count pending bookings
        $pendingBookings = $this->bookingModel->where('status', 'pending')->countAllResults();
        
        // Count cancelled bookings
        $cancelledBookings = $this->bookingModel->where('status', 'cancelled')->countAllResults();
        
        // Get recent bookings
        $recentBookings = $this->bookingModel
            ->select('bookings.*, users.name as user_name, schedules.departure_date, routes.origin, routes.destination')
            ->join('users', 'users.id = bookings.user_id')
            ->join('schedules', 'schedules.id = bookings.schedule_id')
            ->join('routes', 'routes.id = schedules.route_id')
            ->orderBy('bookings.booking_date', 'DESC')
            ->limit(10)
            ->find();
            
        // Get popular routes
        $popularRoutes = $this->routeModel
            ->select('routes.*, COUNT(bookings.id) as booking_count')
            ->join('schedules', 'schedules.route_id = routes.id', 'left')
            ->join('bookings', 'bookings.schedule_id = schedules.id', 'left')
            ->groupBy('routes.id')
            ->orderBy('booking_count', 'DESC')
            ->limit(5)
            ->find();
        
        return view('admin/dashboard', [
            'totalSchedules' => $totalSchedules,
            'totalRoutes' => $totalRoutes,
            'totalBuses' => $totalBuses,
            'totalUsers' => $totalUsers,
            'totalBookings' => $totalBookings,
            'confirmedBookings' => $confirmedBookings,
            'pendingBookings' => $pendingBookings,
            'cancelledBookings' => $cancelledBookings,
            'recentBookings' => $recentBookings,
            'popularRoutes' => $popularRoutes
        ]);
    }
}