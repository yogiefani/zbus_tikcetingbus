
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cari Tiket Bus</h5>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('tickets/search') ?>" method="get">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="origin" class="form-label">Kota Asal</label>
                                <select class="form-select" id="origin" name="origin" required>
                                    <option value="">Pilih Kota Asal</option>
                                    <?php 
                                    $origins = array_unique(array_column($routes, 'origin'));
                                    foreach($origins as $origin): 
                                    ?>
                                        <option value="<?= $origin ?>"><?= $origin ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="destination" class="form-label">Kota Tujuan</label>
                                <select class="form-select" id="destination" name="destination" required>
                                    <option value="">Pilih Kota Tujuan</option>
                                    <?php 
                                    $destinations = array_unique(array_column($routes, 'destination'));
                                    foreach($destinations as $destination): 
                                    ?>
                                        <option value="<?= $destination ?>"><?= $destination ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal Keberangkatan</label>
                            <input type="date" class="form-control" id="date" name="date" min="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Cari Tiket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>