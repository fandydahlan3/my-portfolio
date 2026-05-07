<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide">
<head>
    <meta charset="utf-8" />
    <title>Login - Koperasi Ar-Risalah</title>
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
              <h4 class="mb-2 text-center">Selamat Datang! 👋</h4>
              <p class="mb-4 text-center">Silakan login ke akun Anda</p>

              <?php if (session()->getFlashdata('error')) : ?>
                  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
              <?php endif; ?>

              <form action="<?= base_url('auth/login_action') ?>" method="POST">
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Masukkan username" required autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="············" required />
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>