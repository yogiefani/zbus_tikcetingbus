
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bus Ticket Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
        }
        
        body {
            overflow-x: hidden;
        }
        
        #wrapper {
            display: flex;
        }
        
        #sidebar-wrapper {
            min-height: 100vh;
            width: var(--sidebar-width);
            margin-left: 0;
            transition: margin 0.25s ease-out;
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
        }
        
        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: white;
            font-weight: bold;
        }
        
        #sidebar-wrapper .list-group {
            width: var(--sidebar-width);
        }
        
        #sidebar-wrapper .list-group-item {
            border: none;
            padding: 1rem 1.25rem;
            background-color: transparent;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }
        
        #sidebar-wrapper .list-group-item:hover,
        #sidebar-wrapper .list-group-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        #sidebar-wrapper .list-group-item i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        #page-content-wrapper {
            min-width: 100vw;
            transition: margin 0.25s ease-out;
        }
        
        #wrapper.toggled #sidebar-wrapper {
            margin-left: calc(-1 * var(--sidebar-width));
        }
        
        .navbar-brand {
            font-weight: bold;
        }
        
        @media (min-width: 768px) {
            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }
            
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
        }
        
        .border-left-primary {
            border-left: 4px solid #4e73df;
        }
        
        .border-left-success {
            border-left: 4px solid #1cc88a;
        }
        
        .border-left-info {
            border-left: 4px solid #36b9cc;
        }
        
        .border-left-warning {
            border-left: 4px solid #f6c23e;
        }
        
        .border-left-danger {
            border-left: 4px solid #e74a3b;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading">Bus Ticket Admin</div>
            <div class="list-group list-group-flush">
                <a href="<?= base_url('admin') ?>" class="list-group-item list-group-item-action <?= current_url() == base_url('admin') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="<?= base_url('admin/routes') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), '/routes') !== false ? 'active' : '' ?>">
                    <i class="fas fa-road"></i> Rute
                </a>
                <a href="<?= base_url('admin/buses') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), '/buses') !== false ? 'active' : '' ?>">
                    <i class="fas fa-bus"></i> Bus
                </a>
                <a href="<?= base_url('admin/schedules') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), '/schedules') !== false ? 'active' : '' ?>">
                    <i class="fas fa-calendar-alt"></i> Jadwal
                </a>
                <a href="<?= base_url('admin/bookings') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), '/bookings') !== false ? 'active' : '' ?>">
                    <i class="fas fa-ticket-alt"></i> Pemesanan
                </a>
                <a href="<?= base_url('admin/users') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), '/users') !== false ? 'active' : '' ?>">
                    <i class="fas fa-users"></i> Pengguna
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-1"></i> <?= session()->get('name') ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <?= $this->renderSection('content') ?>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle the side navigation
            const sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector('#wrapper').classList.toggle('toggled');
                });
            }
        });
    </script>
</body>
</html>