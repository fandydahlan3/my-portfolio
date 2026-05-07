<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="card col-md-6">
    <div class="card-body">
        <h5 class="card-title">Ganti Password</h5>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= base_url('auth/update_password') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password_baru" class="form-control" placeholder="············" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>