<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-label-primary pb-3">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bx bx-user-plus me-2 fs-3"></i> Registrasi Anggota Baru
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('anggota/store') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Nomor Anggota</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                <input type="text" class="form-control" name="nomor_anggota" placeholder="Contoh: AGT001" required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Nama Lengkap</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" name="nama_anggota" placeholder="Masukkan nama lengkap..." required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Jenis Kelamin</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-unite"></i></span>
                <select class="form-select" name="jenis_kelamin" required>
                  <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">No. Handphone</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                <input type="text" class="form-control" name="no_hp" placeholder="0812xxxx" required>
              </div>
            </div>
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Alamat Domisili</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-map"></i></span>
                <input type="text" class="form-control" name="alamat" placeholder="Nama jalan, RT/RW, Kecamatan..." required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Tanggal Lahir</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-cake"></i></span>
                <input type="date" class="form-control" name="tanggal_lahir" required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Tanggal Daftar</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-calendar-event"></i></span>
                <input type="date" class="form-control" name="tanggal_daftar" value="<?= date('Y-m-d') ?>" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-top">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x me-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bx bx-save me-1"></i> Simpan Anggota
          </button>
        </div>
      </form>
    </div>
  </div>
</div>