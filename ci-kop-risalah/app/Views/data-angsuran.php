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

    <title>ANGSURAN - ABATASA</title>

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

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
           <?php
          include __DIR__.'/pages/sidebar.php';
          ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->
          <?php
          include __DIR__.'/pages/navbar.php';
          ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light">Finance /</span> Data Angsuran
                </h4>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                            <?php if (strtolower(session()->get('role')) === 'admin') : ?>
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="modal" data-bs-target="#modalTambahAngsuran">
                                        <i class="bx bx-plus-circle me-1"></i> Input Angsuran Baru
                                    </button>
                                </li>
                            <?php endif; ?>
                        </ul>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom mb-3">
                                <h5 class="mb-0 fw-bold">MONITORING ANGSURAN ANGGOTA</h5>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-hover table-bordered" id="dataTable" width="100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th>Nama Anggota</th>
                                                <th class="text-center">Total Pinjaman</th>
                                                <th class="text-center">Terbayar</th>
                                                <th class="text-center">Sisa Tagihan</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach($angsuran as $row): 
                                                $persen = ($row['total'] > 0) ? ($row['terbayar'] / $row['total']) * 100 : 0;
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td>
                                                    <div class="fw-bold text-dark"><?= esc($row['nama_anggota']) ?></div>
                                                    <small class="text-muted"><?= esc($row['nomor_anggota']) ?></small>
                                                </td>
                                                <td class="text-end fw-bold">Rp <?= number_format($row['total'],0,',','.') ?></td>
                                                <td class="text-end text-success">
                                                    <div>Rp <?= number_format($row['terbayar'],0,',','.') ?></div>
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $persen ?>%"></div>
                                                    </div>
                                                </td>
                                                <td class="text-end text-danger fw-bold">Rp <?= number_format($row['sisa'],0,',','.') ?></td>
                                                
                                                <td class="text-center">
                                                    <?php if($row['status'] == 'Lunas'): ?>
                                                        <span class="badge bg-label-success px-3">
                                                            <i class="bx bx-check-double me-1"></i> LUNAS
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-label-warning px-3 text-dark">
                                                            <i class="bx bx-time-five me-1"></i> DICICIL
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <?php if (strtolower(session()->get('role')) === 'admin') : ?>
                                                            <?php if($row['status'] != 'Lunas'): ?>
                                                                <button type="button" 
                                                                    class="btn btn-icon btn-outline-info btn-sm btn-cicilan"
                                                                    data-bs-toggle="tooltip" title="Bayar Cicilan"
                                                                    data-id="<?= $row['id_angsuran'] ?>">
                                                                    <i class="bx bx-money"></i>
                                                                </button>
                                                                <a href="<?= base_url('d_angsuran/lunasi/'.$row['id_angsuran']) ?>"
                                                                class="btn btn-icon btn-outline-primary btn-sm"
                                                                data-bs-toggle="tooltip" title="Lunasi Semua"
                                                                onclick="return confirm('Yakin ingin melunasi seluruh sisa tagihan?')">
                                                                    <i class="bx bx-rocket"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <button class="btn btn-icon btn-light btn-sm" disabled><i class="bx bx-lock-alt"></i></button>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="text-muted small">-</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Detai Tampil pinjaman -->
            <?php include __DIR__.'/pages/modal-detail-pinjaman.php'; ?>
             <!-- / Detai Edit pinjaman -->                                 
             <?php include __DIR__.'/pages/modal-bayar-angsuran.php'; ?>
            <!-- model tambah anggota -->
             <?php include __DIR__.'/pages/modal-input-angsuran.php'; ?>
             <!-- / model tambah anggota -->
            <!-- Footer -->
              <?php include __DIR__.'/pages/footer.php';?>
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

        // POSISI KOMPONEN (INI KUNCI TAMPILAN)
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
$(document).on('click', '.btn-cicilan', function () {
    $('#id_angsuran').val($(this).data('id'));
    $('#modalBayarAngsuran').modal('show');
});

$(document).on('submit', '#formBayarCicilan', function (e) {
    e.preventDefault();

    $.post(
        '<?= base_url("d_angsuran/store_cicilan") ?>',
        $(this).serialize(),
        function () {
            $('#modalBayarAngsuran').modal('hide');
            location.reload();
        }
    );
});

$(document).on('click', '.btn-detail', function() {
    const id = $(this).data('id');
    const noAnggota = $(this).data('nomor');

    $('#detailNoAnggota').text(noAnggota);
    $('#bodyDetailCicilan').html('<tr><td colspan="4">Loading...</td></tr>');

    $.ajax({
        url: '<?= base_url("d_angsuran/get_cicilan/") ?>' + id,
        method: 'GET',
        success: function(data){
            $('#bodyDetailCicilan').html(data);
            $('#modalDetailPinjaman').modal('show'); 
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
