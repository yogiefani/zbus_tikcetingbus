
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">Bus Ticket</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('tickets') ?>">Cari Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('bookings') ?>">Pemesanan Saya</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> <?= session()->get('name') ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profil Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <footer class="mt-5 py-4 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Bus Ticket Booking</h5>
                    <p>Sistem pemesanan tiket bus online yang mudah dan aman.</p>
                </div>
                <div class="col-md-3">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('/') ?>" class="text-white">Home</a></li>
                        <li><a href="<?= base_url('tickets') ?>" class="text-white">Cari Tiket</a></li>
                        <li><a href="<?= base_url('bookings') ?>" class="text-white">Pemesanan</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i> +62 123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i> info@busticket.com</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Bus Ticket Booking. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>