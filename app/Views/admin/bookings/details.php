<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Pemesanan #<?= $booking['id'] ?></h1>
        <a href="<?= base_url('admin/bookings') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Penumpang</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama</th>
                            <td><?= $booking['user_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $booking['email'] ?></td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td><?= $booking['phone'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status Pemesanan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Status</th>
                            <td>
                                <?php if ($booking['status'] == 'pending') : ?>
                                    <span class="badge bg-warning">Menunggu</span>
                                <?php elseif ($booking['status'] == 'confirmed') : ?>
                                    <span class="badge bg-success">Dikonfirmasi</span>
                                <?php elseif ($booking['status'] == 'cancelled') : ?>
                                    <span class="badge bg-danger">Dibatalkan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pemesanan</th>
                            <td><?= date('d M Y H:i', strtotime($booking['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <th>Pembayaran</th>
                            <td>
                                <?php if ($booking['payment_status'] == 'pending') : ?>
                                    <span class="badge bg-warning">Menunggu</span>
                                <?php elseif ($booking['payment_status'] == 'paid') : ?>
                                    <span class="badge bg-success">Dibayar</span>
                                <?php elseif ($booking['payment_status'] == 'refunded') : ?>
                                    <span class="badge bg-info">Dikembalikan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="mt-3">
                        <?php if ($booking['status'] == 'pending') : ?>
                            <a href="<?= base_url('admin/bookings/confirm/' . $booking['id']) ?>" class="btn btn-success me-2" onclick="return confirm('Konfirmasi pemesanan ini?')">
                                <i class="fas fa-check me-1"></i> Konfirmasi Pemesanan
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($booking['status'] != 'cancelled') : ?>
                            <a href="<?= base_url('admin/bookings/cancel/' . $booking['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan pemesanan ini?')">
                                <i class="fas fa-times me-1"></i> Batalkan Pemesanan
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Perjalanan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Bus</th>
                                    <td><?= $booking['bus_name'] ?> (<?= ucfirst($booking['bus_type']) ?>)</td>
                                </tr>
                                <tr>
                                    <th>Rute</th>
                                    <td><?= $booking['origin'] ?> - <?= $booking['destination'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Keberangkatan</th>
                                    <td><?= date('d M Y', strtotime($booking['departure_date'])) ?></td>
                                </tr>
                                <tr>
                                    <th>Waktu</th>
                                    <td><?= $booking['departure_time'] ?> - <?= $booking['arrival_time'] ?></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Jumlah Kursi</th>
                                    <td><?= $booking['seats'] ?></td>
                                </tr>
                                <tr>
                                    <th>Harga per Kursi</th>
                                    <td>Rp <?= number_format($booking['price'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>