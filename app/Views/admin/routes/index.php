<!-- app/Views/admin/routes/index.php -->
<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Rute</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= base_url('admin/routes/add') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Rute
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Rute</h6>
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
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Jarak (km)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($routes)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data rute.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($routes as $route) : ?>
                                <tr>
                                    <td><?= $route['id'] ?></td>
                                    <td><?= $route['origin'] ?></td>
                                    <td><?= $route['destination'] ?></td>
                                    <td><?= $route['distance'] ?></td>
                                    <td>
                                        <?php if ($route['status'] == 'active') : ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else : ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/routes/edit/' . $route['id']) ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('admin/routes/delete/' . $route['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rute ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
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