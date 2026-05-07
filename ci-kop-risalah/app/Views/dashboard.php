<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('assets/') ?>"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>DASHBOARD - ABATASA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/logo.png') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/apex-charts/apex-charts.css') ?>" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/js/config.js') ?>"></script>
  </head>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
          <?= view('pages/sidebar'); ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">   

          <!-- Navbar -->
          <?= view('pages/navbar'); ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-12 mb-4">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                         <h5 class="card-title text-primary">
                          Selamat Datang, <?= session()->get('nama') ?: session()->get('username') ?>! 🎉</h5>
                      <p>
                          Status kamu: <span class="badge bg-label-info"><?= session()->get('role') ?: 'Member' ?></span>
                      </p>
                          <a href="<?= base_url('profile') ?>" class="btn btn-sm btn-outline-primary">Lihat Profil</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="<?= base_url('assets/img/illustrations/man-with-laptop-light.png') ?>"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Jumlah Profit -->
                <div class="col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                               <h5 class="text-nowrap mb-2">
                                <?= (session()->get('role') == 'admin') ? 'TOTAL IURAN KOPERASI' : 'TOTAL IURAN SAYA' ?>
                              </h5>
                                <span class="badge bg-label-warning rounded-pill">Tahun <?= date('Y') ?></span>
                              </div>
                              <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"
                                  ><i class="bx bx-chevron-up"></i> Data Real-time</small
                                >
                                <h3 class="mb-0"><?= number_format($total_iuran_header, 0, ',', '.') ?></h3>
                              </div>
                            </div>
                            <div id="profileReportChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                <!-- Total Revenue -->
                <div class="row">
                  <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                          <div class="avatar">
                            <img src="<?= base_url('assets/img/icons/unicons/chart-success.png') ?>" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Iuran Pokok</span>
                        <h3 class="card-title mb-2">Rp <?= number_format(($total_pokok ?? 0), 0, ',', '.') ?></h3>
                        <small class="text-success fw-semibold">
                          <i class="bx bx-up-arrow-alt"></i> Aktif
                        </small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                          <div class="avatar">
                            <img src="<?= base_url('assets/img/icons/unicons/wallet-info.png') ?>" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Iuran Wajib</span>
                        <h3 class="card-title mb-2">Rp <?= number_format(($total_wajib ?? 0), 0, ',', '.') ?></h3>
                        <small class="text-success fw-semibold">
                          <i class="bx bx-up-arrow-alt"></i> Aktif
                        </small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                          <div class="avatar">
                            <img src="<?= base_url('assets/img/icons/unicons/cc-primary.png') ?>" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Iuran Sukarela</span>
                        <h3 class="card-title mb-2">Rp <?= number_format(($total_sukarela ?? 0), 0, ',', '.') ?></h3>
                        <small class="text-success fw-semibold">
                          <i class="bx bx-up-arrow-alt"></i> Aktif
                        </small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                          <div class="avatar">
                            <img src="<?= base_url('assets/img/icons/unicons/paypal.png') ?>" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Sisa Tagihan Angsuran</span>
                          <h3 class="card-title mb-2">Rp <?= number_format(($total_angsuran ?? 0), 0, ',', '.') ?></h3>

                          <?php if ($total_angsuran <= 0) : ?>
                              <small class="text-info fw-semibold">
                                  <i class="bx bx-check-double"></i> Kewajiban Selesai
                              </small>
                          <?php else : ?>
                              <small class="text-warning fw-semibold">
                                  <i class="bx bx-wallet"></i> Silakan Melakukan Cicilan
                              </small>
                          <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Order Statistics --> 
              <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">USAHA KOPERASI</h5>
                        <small class="text-muted"><?= $total_unit_usaha ?? 0 ?> Total Unit Usaha</small>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="orederStatistics"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                          <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2">Rp <?= number_format(($total_pendapatan_tahunan ?? 0), 0, ',', '.') ?></h2>
                          <span>Total Pendapatan Pertahun</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                      </div>
                      <ul class="p-0 m-0">
                          <?php if (!empty($daftar_usaha)): ?>
                              <?php foreach ($daftar_usaha as $usaha): 
                                  $namaUsaha = $usaha->nama_pendapatan ?? $usaha->keterangan ?? $usaha->nama ?? 'Unit Usaha';
                                  $nominal   = $usaha->jumlah_pendapatan ?? $usaha->jumlah ?? $usaha->nominal ?? 0;
                              ?>
                              <li class="d-flex mb-4 pb-1">
                                  <div class="avatar flex-shrink-0 me-3">
                                      <span class="avatar-initial rounded bg-label-primary">
                                          <i class="bx bx-store-alt"></i>
                                      </span>
                                  </div>
                                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                      <div class="me-2">
                                          <h6 class="mb-0"><?= $namaUsaha ?></h6>
                                          <small class="text-muted">Unit Usaha Koperasi</small>
                                      </div>
                                      <div class="user-progress">
                                          <small class="fw-semibold">Rp <?= number_format($nominal, 0, ',', '.') ?></small>
                                      </div>
                                  </div>
                              </li>
                              <?php endforeach; ?>
                          <?php else: ?>
                              <li class="text-center text-muted">Belum ada data usaha.</li>
                          <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Order Statistics -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-4 order-2 mb-4">
                  <div class="card ">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Transaksi</h5>
                      <div class="dropdown">
                        <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="javascript:void(0);">Perbulan</a>
                          <a class="dropdown-item" href="javascript:void(0);">pertahun</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="<?= base_url('assets/img/icons/unicons/chart.png') ?>" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Angsuran</small>
                              <h6 class="mb-0">Total Kredit Masuk</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <span class="text-success fw-semibold">+ Rp <?= number_format($total_angsuran, 0, ',', '.') ?></span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="<?= base_url('assets/img/icons/unicons/wallet.png') ?>" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Iuran Pokok</small>
                              <h6 class="mb-0">Simpanan Anggota</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <span class="text-success fw-semibold">+ Rp <?= number_format($total_pokok, 0, ',', '.') ?></span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="<?= base_url('assets/img/icons/unicons/cc-success.png') ?>" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Iuran Wajib</small>
                              <h6 class="mb-0">Simpanan Bulanan</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <span class="text-success fw-semibold">+ Rp <?= number_format($total_wajib, 0, ',', '.') ?></span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="<?= base_url('assets/img/icons/unicons/cc-warning.png') ?>" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Iuran Sukarela</small>
                              <h6 class="mb-0">Simpanan Bebas</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <span class="text-success fw-semibold">+ Rp <?= number_format($total_sukarela, 0, ',', '.') ?></span>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
             <?= view('pages/footer'); ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url('assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/js/dashboards-analytics.js') ?>"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
  document.addEventListener("DOMContentLoaded", function() {
    var options = {
      chart: { height: 200, type: 'radialBar' },
      series: [<?= $persen_usaha ?>],
      colors: ['#696cff'],
      plotOptions: {
        radialBar: {
          hollow: { size: '70%' },
          dataLabels: { showOn: "always", name: { show: false }, value: { fontSize: "22px", show: true } }
        }
      },
      stroke: { lineCap: "round" }
    };
    var chart = new ApexCharts(document.querySelector("#usahaChart"), options);
    chart.render();
  });
</script>
  </body>
</html>
