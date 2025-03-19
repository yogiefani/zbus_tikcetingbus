
<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= base_url('admin/routes') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Rute</h6>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('admin/routes/' . $action) ?>" method="post">
                <div class="mb-3">
                    <label for="origin" class="form-label">Kota Asal</label>
                    <input type="text" class="form-control" id="origin" name="origin" value="<?= old('origin') ?? ($route['origin'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="destination" class="form-label">Kota Tujuan</label>
                    <input type="text" class="form-control" id="destination" name="destination" value="<?= old('destination') ?? ($route['destination'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="distance" class="form-label">Jarak (km)</label>
                    <input type="number" class="form-control" id="distance" name="distance" value="<?= old('distance') ?? ($route['distance'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="active" <?= (old('status') ?? ($route['status'] ?? '')) == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= (old('status') ?? ($route['status'] ?? '')) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>