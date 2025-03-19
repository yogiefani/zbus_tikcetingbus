<!-- app/Views/bookings/index.php -->
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Pemesanan</h5>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (empty($bookings)) : ?>
                        <div class="alert alert-info">
                            <p class="mb-0">Anda belum memiliki riwayat pemesanan. <a href="<?= base_url('tickets') ?>">Pesan tiket sekarang</a>.</p>
                        </div>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Rute</th>
                                        <th>Tanggal</th>
                                        <th>Bus</th>
                                        <th>Kursi</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $booking) : ?>
                                        <tr>
                                            <td>#<?= $booking['id'] ?></td>
                                            <td><?= $booking['origin'] ?> - <?= $booking['destination'] ?></td>
                                            <td><?= date('d M Y', strtotime($booking['departure_date'])) ?></td>
                                            <td><?= $booking['bus_name'] ?></td>
                                            <td><?= $booking['seats'] ?></td>
                                            <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                                            <td>
                                                <?php if ($booking['status'] == 'confirmed') : ?>
                                                    <span class="badge bg-success">Confirmed</span>
                                                <?php elseif ($booking['status'] == 'pending') : ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php else : ?>
                                                    <span class="badge bg-danger">Cancelled</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('bookings/' . $booking['id']) ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if ($booking['status'] != 'cancelled' && strtotime($booking['departure_date']) > time()) : ?>
                                                    <a href="<?= base_url('bookings/cancel/' . $booking['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?')">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                <?php endif; ?>
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