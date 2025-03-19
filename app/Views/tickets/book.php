
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Pemesanan Tiket</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="card-title"><?= $schedule['bus_name'] ?> (<?= ucfirst($schedule['bus_type']) ?>)</h5>
                            <div class="d-flex justify-content-between align-items-center my-3">
                                <div class="text-center">
                                    <h5><?= $schedule['departure_time'] ?></h5>
                                    <p class="text-muted mb-0"><?= $schedule['origin'] ?></p>
                                </div>
                                <div class="mx-3">
                                    <i class="fas fa-arrow-right text-primary"></i>
                                </div>
                                <div class="text-center">
                                    <h5><?= $schedule['arrival_time'] ?></h5>
                                    <p class="text-muted mb-0"><?= $schedule['destination'] ?></p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p><strong>Tanggal Keberangkatan:</strong> <?= date('d F Y', strtotime($schedule['departure_date'])) ?></p>
                                <p><strong>Jarak:</strong> <?= $schedule['distance'] ?> km</p>
                                <p><strong>Harga per Tiket:</strong> Rp <?= number_format($schedule['price'], 0, ',', '.') ?></p>
                                <p><strong>Kursi Tersedia:</strong> <?= $schedule['available_seats'] ?> kursi</p>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <form action="<?= base_url('tickets/confirm') ?>" method="post">
                        <input type="hidden" name="schedule_id" value="<?= $schedule['id'] ?>">
                        
                        <div class="mb-3">
                            <label for="seats" class="form-label">Jumlah Kursi</label>
                            <select class="form-select" id="seats" name="seats" required>
                                <?php for ($i = 1; $i <= min(5, $schedule['available_seats']); $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?> kursi</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="alert alert-info">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Harga per Tiket:</span>
                                <span>Rp <?= number_format($schedule['price'], 0, ',', '.') ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center" id="total-price-container">
                                <strong>Total Harga (1 kursi):</strong>
                                <strong>Rp <?= number_format($schedule['price'], 0, ',', '.') ?></strong>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Lanjutkan Pemesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const seatsSelect = document.getElementById('seats');
    const totalPriceContainer = document.getElementById('total-price-container');
    const pricePerTicket = <?= $schedule['price'] ?>;
    
    seatsSelect.addEventListener('change', function() {
        const seats = parseInt(this.value);
        const totalPrice = seats * pricePerTicket;
        
        totalPriceContainer.innerHTML = `
            <strong>Total Harga (${seats} kursi):</strong>
            <strong>Rp ${totalPrice.toLocaleString('id-ID')}</strong>
        `;
    });
});
</script>
<?= $this->endSection() ?>