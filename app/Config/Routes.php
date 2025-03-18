<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::processRegister');
$routes->get('/logout', 'AuthController::logout');

// Routes yang memerlukan otentikasi
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'DashboardController::index');
    $routes->get('/profile', 'UserController::profile');
    $routes->post('/profile/update', 'UserController::updateProfile');
    
    // Rute untuk pengelolaan tiket
    $routes->get('/tickets', 'TicketController::index');
    $routes->get('/tickets/search', 'TicketController::search');
    $routes->get('/tickets/book/(:num)', 'TicketController::book/$1');
    $routes->post('/tickets/confirm', 'TicketController::confirmBooking');
    
    // Rute untuk riwayat pemesanan
    $routes->get('/bookings', 'BookingController::index');
    $routes->get('/bookings/(:num)', 'BookingController::details/$1');
    $routes->get('/bookings/cancel/(:num)', 'BookingController::cancel/$1');
});

// Rute admin
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('routes', 'Admin\RouteController::index');
    $routes->get('routes/add', 'Admin\RouteController::add');
    $routes->post('routes/add', 'Admin\RouteController::save');
    $routes->get('routes/edit/(:num)', 'Admin\RouteController::edit/$1');
    $routes->post('routes/update/(:num)', 'Admin\RouteController::update/$1');
    $routes->get('routes/delete/(:num)', 'Admin\RouteController::delete/$1');
    
    $routes->get('buses', 'Admin\BusController::index');
    $routes->get('buses/add', 'Admin\BusController::add');
    $routes->post('buses/add', 'Admin\BusController::save');
    $routes->get('buses/edit/(:num)', 'Admin\BusController::edit/$1');
    $routes->post('buses/update/(:num)', 'Admin\BusController::update/$1');
    $routes->get('buses/delete/(:num)', 'Admin\BusController::delete/$1');
    
    $routes->get('schedules', 'Admin\ScheduleController::index');
    $routes->get('schedules/add', 'Admin\ScheduleController::add');
    $routes->post('schedules/add', 'Admin\ScheduleController::save');
    $routes->get('schedules/edit/(:num)', 'Admin\ScheduleController::edit/$1');
    $routes->post('schedules/update/(:num)', 'Admin\ScheduleController::update/$1');
    $routes->get('schedules/delete/(:num)', 'Admin\ScheduleController::delete/$1');
    
    $routes->get('bookings', 'Admin\BookingController::index');
    $routes->get('bookings/details/(:num)', 'Admin\BookingController::details/$1');
    $routes->get('bookings/confirm/(:num)', 'Admin\BookingController::confirm/$1');
    $routes->get('bookings/cancel/(:num)', 'Admin\BookingController::cancel/$1');
    
    $routes->get('users', 'Admin\UserController::index');
    $routes->get('users/edit/(:num)', 'Admin\UserController::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserController::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\UserController::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}