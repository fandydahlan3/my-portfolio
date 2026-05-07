<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide">
<head>
    <meta charset="utf-8" />
    <title>Register - Koperasi Ar-Risalah</title>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-auth.css') ?>" />
</head>
<body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-2 text-center">Daftar Akun 🚀</h4>
              <p class="mb-4 text-center">Buat akun untuk mulai mengelola koperasi</p>

              <form action="<?= base_url('auth/register_action') ?>" method="POST">
                <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Masukkan username" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="············" required />
                </div>
              </form>

              <p class="text-center mt-3">
                <span>Sudah punya akun?</span>
                <a href="<?= base_url('auth') ?>">
                  <span>Login di sini</span>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>