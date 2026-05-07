<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('assets/') ?>"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>DATA IURAN - ABATASA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/logo.png') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"/>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/apex-charts/apex-charts.css') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light">Finance /</span> Data Iuran
                </h4>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                            <?php if (session()->get('role') === 'admin') : ?>
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                                        <i class="bx bx-plus-circle me-1"></i> Input Iuran Baru
                                    </button>
                                </li>
                            <?php endif; ?>
                        </ul>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom mb-3">
                                <h5 class="mb-0 fw-bold">RIWAYAT PEMBAYARAN IURAN</h5>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="javascript:void(0);">Export Excel</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Cetak PDF</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-hover table-bordered" id="dataTable" width="100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th>Nama Anggota</th>
                                                <th class="text-center">Pokok</th>
                                                <th class="text-center">Wajib</th>
                                                <th class="text-center">Sukarela</th>
                                                <th class="text-center">Tanggal Bayar</th>
                                                <?php if (session()->get('role') === 'admin') : ?>
                                                    <th class="text-center">Aksi</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($iuran)) : ?>
                                                <?php $no = 1; foreach ($iuran as $row) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fw-bold text-dark"><?= esc($row['nama_anggota']) ?></span>
                                                                <small class="text-muted">ID: <?= esc($row['id_iuran']) ?></small>
                                                            </div>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="badge bg-label-primary">Rp <?= number_format($row['iuran_pokok'], 0, ',', '.') ?></span>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="badge bg-label-info">Rp <?= number_format($row['iuran_wajib'], 0, ',', '.') ?></span>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="badge bg-label-success">Rp <?= number_format($row['iuran_sukarela'], 0, ',', '.') ?></span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-muted"><i class="bx bx-calendar me-1"></i><?= date('d/m/Y', strtotime($row['tanggal_iuran'])) ?></span>
                                                        </td>
                                                        
                                                        <?php if (session()->get('role') === 'admin') : ?>
                                                            <td class="text-center">
                                                                <a href="<?= base_url('iuran/delete/'.$row['id_iuran']) ?>"
                                                                  class="btn btn-icon btn-outline-danger btn-sm"
                                                                  data-bs-toggle="tooltip" 
                                                                  title="Hapus Iuran"
                                                                  onclick="return confirm('Yakin hapus data iuran ini?')">
                                                                    <i class="bx bx-trash"></i>
                                                                </a>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="<?= (session()->get('role') === 'admin') ? '7' : '6' ?>" class="text-center py-4">
                                                        <img src="<?= base_url('assets/img/illustrations/empty-box.png') ?>" alt="No Data" width="100" class="mb-2 d-block mx-auto">
                                                        <span class="text-muted">Belum ada catatan iuran masuk.</span>
                                                    </td>
                                                </tr>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->
            <!-- model tambah anggota -->
             <?php include __DIR__.'/pages/modal-input-iuran.php'; ?>
             <!-- / model tambah anggota -->
            <!-- Footer -->
              <?php
          include __DIR__.'/pages/footer.php';?>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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
$(document).ready(function () {
    $('#dataTable').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        searching: true,
        info: true,
        dom:
          "<'row mb-2'<'col-sm-6'l><'col-sm-6 text-end'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row mt-2'<'col-sm-6'i><'col-sm-6 text-end'p>>",

        language: {
            search: "",
            searchPlaceholder: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            zeroRecords: "No data available",
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        }
    });
});

$(document).ready(function () {
  $('#anggota').select2({
    theme: 'bootstrap-5',
    dropdownParent: $('#modalTambahAnggota'),
    placeholder: 'Cari anggota...',
    minimumInputLength: 2,
    ajax: {
      url: "<?= base_url('iuran/searchAnggota') ?>",
      dataType: 'json',
      delay: 300,
      data: function (params) {
        return {
          q: params.term
        };
      },
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });
});

$(document).ready(function () {
    if ($.fn.DataTable.isDataTable('#dataTable')) {
        $('#dataTable').DataTable().destroy();
    }

    $('#dataTable').DataTable({
        "pageLength": 10, 
        "lengthMenu": [5, 10, 25, 50], 
        "ordering": true,
        "searching": true,
        "info": true,
        
        
        "dom": "<'row mb-3'<'col-sm-6'l><'col-sm-6 text-end'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row mt-3'<'col-sm-5'i><'col-sm-7 text-end'p>>",
               
        "language": {
            "search": "Search:", 
            "lengthMenu": "Show _MENU_ entries", 
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "paginate": {
                "next": "Next",
                "previous": "Previous"
            },
            "zeroRecords": "Data tidak ditemukan"
        }
    });
});
</script>

  </body>
</html>
