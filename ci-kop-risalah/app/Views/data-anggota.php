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
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>DATA ANGGOTA - ABATASA</title>

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
                  <span class="text-muted fw-light">Member /</span> Account
              </h4>
              <div class="row">
                  <div class="col-12">
                      <div class="card mb-4">

                         <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom mb-3">
                                <h5 class="mb-0 fw-bold"><i class="bx bx-group me-2"></i>DATA MEMBER</h5>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                                    <i class="bx bx-user-plus me-1"></i> Tambah Anggota
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-hover table-bordered" id="dataTable" width="100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th>Nomor Anggota</th>
                                                <th>Nama Anggota</th>
                                                <th class="text-center">L/P</th>
                                                <th>Alamat</th>
                                                <th>No. Handphone</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Tanggal Daftar</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach($anggota as $a): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td><span class="fw-bold text-primary"><?= $a['nomor_anggota']; ?></span></td>
                                                <td><?= esc($a['nama_anggota']); ?></td>
                                                <td class="text-center">
                                                    <?php if($a['jenis_kelamin'] == 'Laki-laki' || $a['jenis_kelamin'] == 'L'): ?>
                                                        <span class="badge bg-label-info">L</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-label-danger">P</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><small><?= esc($a['alamat']); ?></small></td>
                                                <td><?= $a['no_hp']; ?></td>
                                                <td><?= date('d/m/Y', strtotime($a['tanggal_lahir'])); ?></td>
                                                <td><span class="badge bg-label-secondary"><?= date('d/m/Y', strtotime($a['tanggal_daftar'])); ?></span></td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button type="button" 
                                                            class="btn btn-icon btn-outline-success btn-sm btn-edit"
                                                            data-bs-toggle="tooltip" title="Edit Data"
                                                            data-nomor="<?= $a['nomor_anggota'] ?>"
                                                            data-nama="<?= $a['nama_anggota'] ?>"
                                                            data-jk="<?= $a['jenis_kelamin'] ?>"
                                                            data-alamat="<?= $a['alamat'] ?>"
                                                            data-nohp="<?= $a['no_hp'] ?>"
                                                            data-tgllahir="<?= $a['tanggal_lahir'] ?>"
                                                            data-tgldaftar="<?= $a['tanggal_daftar'] ?>">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </button>
                                                        <a href="<?= base_url('anggota/delete/'.$a['nomor_anggota']) ?>"
                                                            class="btn btn-icon btn-outline-danger btn-sm"
                                                            data-bs-toggle="tooltip" title="Hapus Data"
                                                            onclick="return confirm('Yakin hapus data ini?')">
                                                            <i class="bx bx-trash"></i>
                                                        </a>
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
          </div>
            <!-- / Content -->
            <!-- model tambah anggota -->
             <?= view('pages/modal-tambah-anggota'); ?>

             <!-- / model tambah anggota -->

             <!-- Modal Edit Anggota -->
            <?= view('edit/e-data-anggota'); ?>
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

$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var modal = $('#modalEditAnggota');

        modal.find('#edit_nomor_anggota').val($(this).data('nomor'));
        modal.find('#edit_nama_anggota').val($(this).data('nama'));
        modal.find('#edit_jenis_kelamin').val($(this).data('jk'));
        modal.find('#edit_alamat').val($(this).data('alamat'));
        modal.find('#edit_no_hp').val($(this).data('nohp'));
        modal.find('#edit_tanggal_lahir').val($(this).data('tgllahir'));
        modal.find('#edit_tanggal_daftar').val($(this).data('tgldaftar'));

        modal.modal('show');
    });

    $('#formEditAnggota').submit(function(){
    });
});
$(document).ready(function () {
    // Pastikan hanya ada SATU inisialisasi DataTable untuk #dataTable
    if ($.fn.DataTable.isDataTable('#dataTable')) {
        $('#dataTable').DataTable().destroy();
    }

    $('#dataTable').DataTable({
        "pageLength": 10, 
        "lengthMenu": [5, 10, 25, 50], 
        "ordering": true,
        "searching": true,
        "info": true,
        
        // Layout DOM: l=length (entries), f=filtering (search), t=table, i=info, p=pagination
        "dom": "<'row mb-3'<'col-sm-6'l><'col-sm-6 text-end'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row mt-3'<'col-sm-5'i><'col-sm-7 text-end'p>>",
               
        "language": {
            "search": "Search:", // Label search di kanan
            "lengthMenu": "Show _MENU_ entries", // Label entries di kiri
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
