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

    <title>PENDAPATAN - ABATASA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />

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
                    <span class="text-muted fw-light">Member /</span> Account
                </h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <ul class="nav nav-pills flex-column flex-md-row">
                                <li class="nav-item">
                                    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                                        <i class="bx bx-plus-circle me-1"></i> Tambah Pendapatan
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card shadow-sm border-0">
                            <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                                <h5 class="m-0 font-weight-bold text-primary">DATA PENDAPATAN</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle border-light" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th>Nama Usaha</th>
                                                <th>Jumlah Pendapatan</th>
                                                <th>Tanggal</th>
                                                <th class="text-center" width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach($pendapatan as $row): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td>
                                                    <span class="fw-semibold text-dark"><?= $row['nama_usaha'] ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-label-success">
                                                        Rp <?= number_format($row['jumlah_pendapatan'], 0, ',', '.') ?>
                                                    </span>
                                                </td>
                                                <td><i class="bx bx-calendar me-1 text-muted"></i> <?= date('d M Y', strtotime($row['tanggal_pendapatan'])) ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item btn-edit-kop" data-id="<?= $row['id_pendapatan'] ?>">
                                                                <i class="bx bx-edit-alt me-1 text-primary"></i> Edit
                                                            </button>
                                                            <a class="dropdown-item text-danger" href="<?= base_url('input_kop/delete/'.$row['id_pendapatan']) ?>" onclick="return confirm('Yakin hapus data?')">
                                                                <i class="bx bx-trash me-1"></i> Hapus
                                                            </a>
                                                        </div>
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
            <!-- / Content -->
            <!-- model tambah anggota -->
             <?php include __DIR__.'/pages/modal-pendapatan-usaha.php'; ?>
             <!-- / model tambah anggota -->
            <!-- Footer -->
              <?php
          include __DIR__.'/pages/footer.php';
          ?>
            <!-- / Footer -->

        <!-- / new -->
        <div class="content-backdrop fade"></div>
                </div>
                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <div class="modal fade" id="modalEditKop" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pendapatan Usaha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="isiModalEdit">
                    <div class="text-center py-3">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Memuat data...</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
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
    // 1. Inisialisasi DataTable (Pastikan library sudah dipasang di atas)
    if ($.fn.DataTable) {
        $('#dataTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            searching: true,
            dom: "<'row mb-2'<'col-sm-6'l><'col-sm-6 text-end'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row mt-2'<'col-sm-6'i><'col-sm-6 text-end'p>>",
            language: {
                search: "",
                searchPlaceholder: "Search:",
                paginate: { previous: "Previous", next: "Next" }
            }
        });
    }

    // 2. AJAX Modal Edit (Gunakan delegation agar tahan banting)
   $(document).on('click', '.btn-edit-kop', function() {
    const id = $(this).data('id');
    
    // TAMBAHKAN INI: Supaya header di file utama jadi hijau sukses
    $('.modal-header').addClass('bg-label-success').removeClass('bg-label-primary');
    
    $('#modalEditKop').modal('show');
    $.ajax({
        url: '<?= base_url("input_kop/edit") ?>/' + id,
        type: 'GET',
        success: function(data) { 
            $('#isiModalEdit').html(data); 
        }
    });
        
        // Tampilkan modal dan reset isinya ke loading
        $('#modalEditKop').modal('show');
        $('#isiModalEdit').html('<div class="text-center py-3"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Memuat data...</p></div>');
        
        $.ajax({
            url: '<?= base_url("input_kop/edit") ?>/' + id,
            type: 'GET',
            success: function(data) { 
                $('#isiModalEdit').html(data); 
            },
            error: function() {
                $('#isiModalEdit').html('<p class="text-danger text-center">Gagal memuat data.</p>');
            }
        });
    });

    // 3. Format Rupiah Otomatis (Global Listener)
    document.addEventListener('input', function (e) {
        const ids = ['format_jumlah', 'nominal_angsuran', 'format_jumlah_edit'];
        if (ids.includes(e.target.id)) {
            let input = e.target;
            let value = input.value.replace(/\D/g, ''); 
            
            if (value) {
                let formatted = new Intl.NumberFormat('id-ID').format(value);
                input.value = formatted;

                // Update hidden input (Tinggal sesuaikan ID-nya)
                let hiddenId = (input.id === 'format_jumlah') ? 'jumlah_asli' : 'jumlah_asli_edit';
                let hiddenInput = document.getElementById(hiddenId);
                if(hiddenInput) hiddenInput.value = value;

                // Update label jika ada
                let label = document.getElementById('label_nominal');
                if (label && input.id === 'format_jumlah') label.innerText = 'Rp ' + formatted;
            } else {
                input.value = '';
                // Clear hidden input
                let hiddenId = (input.id === 'format_jumlah') ? 'jumlah_asli' : 'jumlah_asli_edit';
                let hiddenInput = document.getElementById(hiddenId);
                if(hiddenInput) hiddenInput.value = '';
            }
        }
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
