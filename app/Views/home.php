
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1570125909232-eb263c188f7e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        
        .feature-box {
            padding: 30px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">Bus Ticket</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>" class="btn btn-outline-light">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-light" href="<?= base_url('register') ?>">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Pesan Tiket Bus dengan Mudah</h1>
            <p class="lead mb-5">Sistem pemesanan tiket bus online yang cepat, aman, dan terpercaya untuk perjalanan Anda</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="<?= base_url('register') ?>" class="btn btn-primary btn-lg">Daftar Sekarang</a>
                <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-lg">Login</a>
            </div>
        </div>
    </section>

    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4">Tentang Bus Ticket Booking</h2>
                    <p class="lead">Bus Ticket Booking adalah platform pemesanan tiket bus online yang dirancang untuk memberikan kemudahan dan kenyamanan bagi pengguna dalam memesan tiket perjalanan.</p>
                    <p>Dengan Bus Ticket Booking, Anda dapat dengan mudah mencari jadwal perjalanan, membandingkan harga, dan memesan tiket bus untuk berbagai rute di Indonesia. Sistem kami terintegrasi dengan berbagai operator bus untuk memberikan pilihan perjalanan yang beragam bagi pelanggan.</p>
                    <p>Kami berkomitmen untuk memberikan pengalaman pemesanan yang terbaik dan memudahkan perjalanan Anda.</p>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" alt="Bus Image" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Fitur Utama</h2>
                <p class="lead">Nikmati berbagai kemudahan dalam memesan tiket bus</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-box bg-white text-center">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>Pencarian Mudah</h4>
                        <p>Temukan jadwal perjalanan dengan mudah berdasarkan kota asal, tujuan, dan tanggal perjalanan.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box bg-white text-center">
                        <div class="feature-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h4>E-Ticket</h4>
                        <p>Dapatkan e-ticket yang dapat digunakan langsung untuk check-in tanpa perlu mencetak tiket fisik.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box bg-white text-center">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Pemesanan 24/7</h4>
                        <p>Lakukan pemesanan kapan saja, 24 jam sehari, 7 hari seminggu dengan sistem yang selalu aktif.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box bg-white text-center">
                        <div class="feature-icon">
                            <i class="fas fa-bus"></i>
                        </div>
                        <h4>Banyak Pilihan Bus</h4>
                        <p>Berbagai pilihan tipe bus dari ekonomi hingga eksekutif untuk menyesuaikan dengan kebutuhan Anda.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box bg-white text-center">
                        <div class="feature-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h4>Harga Terjangkau</h4>
                        <p>Harga tiket yang kompetitif dan berbagai promosi untuk menghemat biaya perjalanan Anda.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box bg-white text-center">
                        <div class="feature-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h4>Riwayat Pemesanan</h4>
                        <p>Akses riwayat pemesanan Anda dengan mudah dan kelola perjalanan yang akan datang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="mb-4">Siap untuk memulai perjalanan?</h2>
            <p class="lead mb-4">Daftar sekarang dan nikmati kemudahan pemesanan tiket bus online.</p>
            <a href="<?= base_url('register') ?>" class="btn btn-light btn-lg">Daftar Sekarang</a>
        </div>
    </section>

    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Bus Ticket Booking</h5>
                    <p>Sistem pemesanan tiket bus online yang mudah dan aman untuk perjalanan Anda.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="mb-3">Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('/') ?>" class="text-white">Home</a></li>
                        <li><a href="#about" class="text-white">Tentang</a></li>
                        <li><a href="#features" class="text-white">Fitur</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i> +62 123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i> info@busticket.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Contoh No. 123, Jakarta</li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-4"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-youtube"></i></a>
                    </div>
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