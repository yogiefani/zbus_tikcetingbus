
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Pemesanan #<?= $booking['id'] ?></h5>
                    <a href="<?= base_url('bookings') ?>" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-<?= ($booking['status'] == 'confirmed') ? 'success' : (($booking['status'] == 'pending') ? 'warning' : 'danger') ?>">
                                <strong>Status Pemesanan:</strong> 
                                <?php if ($booking['status'] == 'confirmed') : ?>
                                    Confirmed
                                <?php elseif ($booking['status'] == 'pending') : ?>
                                    Pending
                                <?php else : ?>
                                    Cancelled
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="card-title"><?= $booking['bus_name'] ?> (<?= ucfirst($booking['bus_type']) ?>)</h5>
                            <div class="d-flex justify-content-between align-items-center my-3">
                                <div class="text-center">
                                    <h5><?= $booking['departure_time'] ?></h5>
                                    <p class="text-muted mb-0"><?= $booking['origin'] ?></p>
                                </div>
                                <div class="mx-3">
                                    <i class="fas fa-arrow-right text-primary"></i>
                                </div>
                                <div class="text-center">
                                    <h5><?= $booking['arrival_time'] ?></h5>
                                    <p class="text-muted mb-0"><?= $booking['destination'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informasi Perjalanan</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: <?= date('d F Y', strtotime($booking['departure_date'])) ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Berangkat</td>
                                    <td>: <?= $booking['departure_time'] ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Tiba</td>
                                    <td>: <?= $booking['arrival_time'] ?></td>
                                </tr>
                                <tr>
                                    <td>Jarak</td>
                                    <td>: <?= $booking['distance'] ?> km</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Pemesanan</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Jumlah Kursi</td>
                                    <td>: <?= $booking['seats'] ?> kursi</td>
                                </tr>
                                <tr>
                                    <td>Harga per Tiket</td>
                                    <td>: Rp <?= number_format($booking['price'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Total Harga</td>
                                    <td>: Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pemesanan</td>
                                    <td>: <?= date('d F Y H:i', strtotime($booking['booking_date'])) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <?php if ($booking['status'] != 'cancelled' && strtotime($booking['departure_date']) > time()) : ?>
                        <div class="d-grid gap-2 mt-4">
                            <a href="<?= base_url('bookings/cancel/' . $booking['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?')">
                                <i class="fas fa-times me-1"></i> Batalkan Pemesanan
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ($booking['status'] == 'confirmed') : ?>
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">E-Ticket</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>BUS TICKET BOOKING</h5>
                        <p>E-Ticket untuk pemesanan #<?= $booking['id'] ?></p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td><strong>Penumpang</strong></td>
                                    <td><?= session()->get('name') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Rute</strong></td>
                                    <td><?= $booking['origin'] ?> - <?= $booking['destination'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal & Waktu</strong></td>
                                    <td><?= date('d F Y', strtotime($booking['departure_date'])) ?> <?= $booking['departure_time'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Bus</strong></td>
                                    <td><?= $booking['bus_name'] ?> (<?= ucfirst($booking['bus_type']) ?>)</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah Kursi</strong></td>
                                    <td><?= $booking['seats'] ?> kursi</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning">
                        <p class="mb-0"><i class="fas fa-info-circle me-1"></i> Silakan tunjukkan e-ticket ini saat check-in di terminal bus.</p>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" onclick="window.print()">
                            <i class="fas fa-print me-1"></i> Cetak E-Ticket
                        </button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>