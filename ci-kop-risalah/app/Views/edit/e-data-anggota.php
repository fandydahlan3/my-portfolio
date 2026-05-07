<div class="modal fade" id="modalEditAnggota" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-label-success pb-3">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bx bx-user-check me-2 fs-3"></i> Perbarui Data Anggota
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="formEditAnggota" action="<?= base_url('anggota/update') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          
          <input type="hidden" name="nomor_anggota" id="edit_nomor_anggota">

          <div class="row">
            
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Nama Lengkap</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" name="nama_anggota" id="edit_nama_anggota" placeholder="Nama anggota..." required>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Jenis Kelamin</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-unite"></i></span>
                <select class="form-select" name="jenis_kelamin" id="edit_jenis_kelamin" required>
                  <option value="">-- Pilih --</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">No. Handphone</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                <input type="text" class="form-control" name="no_hp" id="edit_no_hp" placeholder="0812..." required>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Tanggal Lahir</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-cake"></i></span>
                <input type="date" class="form-control" name="tanggal_lahir" id="edit_tanggal_lahir" required>
              </div>
            </div>

            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Alamat Lengkap</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-map"></i></span>
                <input type="text" class="form-control" name="alamat" id="edit_alamat" placeholder="Alamat lengkap..." required>
              </div>
            </div>

            <div class="col-12 mb-2">
              <label class="form-label fw-bold">Tanggal Daftar</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-calendar-check"></i></span>
                <input type="date" class="form-control" name="tanggal_daftar" id="edit_tanggal_daftar" required>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer border-top">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x me-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-success">
            <i class="bx bx-save me-1"></i> Simpan Perubahan
          </button>
        </div>
      </form>

    </div>
  </div>
</div>