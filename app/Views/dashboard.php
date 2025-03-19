
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Selamat Datang, <?= session()->get('name') ?>!</h2>
                    <p class="card-text">Selamat datang di sistem pemesanan tiket bus online. Di sini Anda dapat memesan tiket, melihat riwayat pemesanan, dan mengelola akun Anda.</p>
                    <a href="<?= base_url('tickets') ?>" class="btn btn-primary">Cari & Pesan Tiket</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Perjalanan Mendatang</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($upcomingTrips)): ?>
                        <p class="text-muted">Tidak ada perjalanan mendatang.</p>
                    <?php else: ?>
                        <div class="list-group">
                            <?php foreach($upcomingTrips as $trip): ?>
                                <a href="<?= base_url('bookings/' . $trip['id']) ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?= $trip['origin'] ?> - <?= $trip['destination'] ?></h6>
                                        <small><?= date('d M Y', strtotime($trip['departure_date'])) ?></small>
                                    </div>
                                    <p class="mb-1">Berangkat: <?= $trip['departure_time'] ?></p>
                                    <small class="text-success">Status: <?= $trip['status'] ?></small>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('bookings') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua Pemesanan</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Rute Populer</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($popularRoutes)): ?>
                        <p class="text-muted">Tidak ada data rute populer.</p>
                    <?php else: ?>
                        <div class="list-group">
                            <?php foreach($popularRoutes as $route): ?>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?= $route['origin'] ?> - <?= $route['destination'] ?></h6>
                                        <small class="badge bg-primary rounded-pill"><?= $route['booking_count'] ?> Pemesanan</small>
                                    </div>
                                    <p class="mb-1">Jarak: <?= $route['distance'] ?> km</p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Pemesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($recentBookings)): ?>
                        <p class="text-muted">Anda belum memiliki riwayat pemesanan.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Rute</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($recentBookings as $booking): ?>
                                        <tr>
                                            <td>#<?= $booking['id'] ?></td>
                                            <td><?= $booking['origin'] ?> - <?= $booking['destination'] ?></td>
                                            <td><?= date('d M Y', strtotime($booking['departure_date'])) ?></td>
                                            <td>
                                                <?php if($booking['status'] == 'confirmed'): ?>
                                                    <span class="badge bg-success">Confirmed</span>
                                                <?php elseif($booking['status'] == 'pending'): ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Cancelled</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('bookings/' . $booking['id']) ?>" class="btn btn-sm btn-info">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>