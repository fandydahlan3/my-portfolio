<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    /* Merapikan Header DataTables (Entries & Search) */
    .dataTables_wrapper .row:first-child {
        padding: 0 1.5rem 1rem 1.5rem;
        align-items: center;
    }

    /* Styling Input Search agar lebih modern */
    div.dataTables_wrapper div.dataTables_filter input {
        border: 1px solid #d9dee3;
        border-radius: 5px;
        padding: 0.4rem 0.8rem;
        margin-left: 10px;
        width: 250px;
    }

    /* Styling Select Entries */
    div.dataTables_wrapper div.dataTables_length select {
        border: 1px solid #d9dee3;
        border-radius: 5px;
        padding: 0.4rem 2rem 0.4rem 0.8rem;
    }

    /* Footer Tabel (Info & Pagination) */
    .dataTables_wrapper .row:last-child {
        padding: 1rem 1.5rem;
    }

    .page-item.active .page-link {
        background-color: #696cff; /* Menyesuaikan warna primary template */
        border-color: #696cff;
    }

    .card-header {
        border-bottom: 1px solid #f0f2f4 !important;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> Data Akun Member</h4>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bx bx-list-ul me-2 text-primary"></i>Daftar Akun Registrasi</h5>
            <?php if (session()->get('role') === 'admin') : ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAkun">
                    <i class="bx bx-plus me-1"></i> Tambah Akun
                </button>
            <?php endif; ?>
        </div>
        
        <div class="card-body pt-4">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle" id="tableMember" width="100%">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>No. Anggota</th> 
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($anggota)) : ?>
                            <?php $no = 1; foreach($anggota as $a): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xs me-2">
                                            <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-user"></i></span>
                                        </div>
                                        <span class="fw-bold text-dark"><?= $a['username']; ?></span>
                                    </div>
                                </td>
                                <td><?= $a['nama_anggota'] ?? '<span class="text-muted small"><i>Belum Terhubung</i></span>'; ?></td>
                                <td><span class="text-primary fw-semibold"><?= $a['nomor_anggota'] ?: '-'; ?></span></td>
                                <td>
                                    <span class="badge <?= ($a['role'] == 'admin') ? 'bg-label-danger' : 'bg-label-info' ?> d-inline-flex align-items-center text-uppercase">
                                        <i class="bx <?= ($a['role'] == 'admin') ? 'bx-shield-quarter' : 'bx-user-circle' ?> me-1"></i>
                                        <?= $a['role']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= base_url('member/reset_password/'.$a['id']) ?>" 
                                           class="btn btn-icon btn-sm btn-outline-warning" 
                                           data-bs-toggle="tooltip" title="Reset Password"
                                           onclick="return confirm('Reset password?')">
                                             <i class="bx bx-key"></i>
                                        </a>
                                        <a href="<?= base_url('member/delete/'.$a['id']) ?>" 
                                           class="btn btn-icon btn-sm btn-outline-danger"
                                           data-bs-toggle="tooltip" title="Hapus Akun"
                                           onclick="return confirm('Hapus akun?')">
                                             <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
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

<div class="modal fade" id="modalTambahAkun" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-label-primary pb-3">
                <h5 class="modal-title d-flex align-items-center fw-bold">
                    <i class="bx bx-user-plus me-2 fs-3"></i> Tambah Akun Pengguna
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('member/store') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold text-primary">Hubungkan dengan Anggota</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-link-external"></i></span>
                                <select name="nomor_anggota" class="form-select">
                                    <option value="">-- Bukan Anggota (Hanya Admin) --</option>
                                    <?php if (!empty($list_anggota)): ?>
                                        <?php foreach ($list_anggota as $la): ?>
                                            <option value="<?= $la['nomor_anggota'] ?>"><?= $la['nomor_anggota'] ?> - <?= $la['nama_anggota'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-at"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="username..." required />
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user">Member</option> <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label fw-bold">Password Awal</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tableMember').DataTable({
        "language": {
            "lengthMenu": "_MENU_",
            "search": "",
            "searchPlaceholder": "Search...",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "paginate": {
                "next": '<i class="bx bx-chevron-right"></i>',
                "previous": '<i class="bx bx-chevron-left"></i>'
            },
            "zeroRecords": "Data tidak ditemukan"
        },
        "columnDefs": [
            { "orderable": false, "targets": 5 }
        ],
        "dom": '<"row mx-0"' +
               '<"col-sm-12 col-md-6 px-0 d-flex align-items-center"l>' +
               '<"col-sm-12 col-md-6 px-0 d-flex justify-content-md-end justify-content-center"f>' +
               '>t' +
               '<"row mx-0"' +
               '<"col-sm-12 col-md-6 px-0"i>' +
               '<"col-sm-12 col-md-6 px-0 d-flex justify-content-md-end justify-content-center"p>' +
               '>',
    });
});
</script>

<?= $this->endSection() ?>