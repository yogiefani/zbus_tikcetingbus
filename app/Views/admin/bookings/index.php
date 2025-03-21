<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <h1 class="h3 mb-4">Manajemen Pemesanan</h1>
    
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="bookings-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Penumpang</th>
                            <th>Rute</th>
                            <th>Tanggal</th>
                            <th>Kursi</th>
                            <th>Harga Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($bookings)) : ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pemesanan</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($bookings as $booking) : ?>
                                <tr>
                                    <td><?= $booking['id'] ?></td>
                                    <td><?= $booking['user_name'] ?></td>
                                    <td><?= $booking['origin'] ?> - <?= $booking['destination'] ?></td>
                                    <td><?= date('d M Y', strtotime($booking['departure_date'])) ?></td>
                                    <td><?= $booking['seats'] ?></td>
                                    <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($booking['status'] == 'pending') : ?>
                                            <span class="badge bg-warning">Menunggu</span>
                                        <?php elseif ($booking['status'] == 'confirmed') : ?>
                                            <span class="badge bg-success">Dikonfirmasi</span>
                                        <?php elseif ($booking['status'] == 'cancelled') : ?>
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/bookings/details/' . $booking['id']) ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <?php if ($booking['status'] == 'pending') : ?>
                                            <a href="<?= base_url('admin/bookings/confirm/' . $booking['id']) ?>" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pemesanan ini?')">
                                                <i class="fas fa-check"></i> Konfirmasi
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($booking['status'] != 'cancelled') : ?>
                                            <a href="<?= base_url('admin/bookings/cancel/' . $booking['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan pemesanan ini?')">
                                                <i class="fas fa-times"></i> Batalkan
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#bookings-table').DataTable();
    });
</script>
<?= $this->endSection() ?>