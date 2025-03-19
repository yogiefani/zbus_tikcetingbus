
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hasil Pencarian Tiket</h4>
                    <p class="card-text">
                        <strong>Rute:</strong> <?= $origin ?> - <?= $destination ?><br>
                        <strong>Tanggal:</strong> <?= date('d F Y', strtotime($date)) ?>
                    </p>
                    <a href="<?= base_url('tickets') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Ubah Pencarian
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (empty($schedules)) : ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Tidak ada jadwal perjalanan yang tersedia untuk pencarian Anda. Silakan coba tanggal atau rute lain.
                </div>
            <?php else : ?>
                <?php foreach ($schedules as $schedule) : ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5 class="card-title"><?= $schedule['bus_name'] ?></h5>
                                    <p class="text-muted"><?= ucfirst($schedule['bus_type']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-center">
                                            <h5><?= $schedule['departure_time'] ?></h5>
                                            <p class="text-muted mb-0"><?= $origin ?></p>
                                        </div>
                                        <div class="mx-3">
                                            <i class="fas fa-arrow-right text-primary"></i>
                                        </div>
                                        <div class="text-center">
                                            <h5><?= $schedule['arrival_time'] ?></h5>
                                            <p class="text-muted mb-0"><?= $destination ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-0">Kapasitas: <?= $schedule['capacity'] ?> kursi</p>
                                    <p class="mb-0">Tersedia: <?= $schedule['available_seats'] ?> kursi</p>
                                </div>
                                <div class="col-md-3 text-end">
                                    <h4 class="text-primary mb-3">Rp <?= number_format($schedule['price'], 0, ',', '.') ?></h4>
                                    <a href="<?= base_url('tickets/book/' . $schedule['id']) ?>" class="btn btn-primary">
                                        <i class="fas fa-ticket-alt me-1"></i> Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>