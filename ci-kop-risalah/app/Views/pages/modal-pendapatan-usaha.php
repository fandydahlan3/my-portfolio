<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered"> <div class="modal-content">
      
      <div class="modal-header bg-label-primary pb-3">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bx bx-wallet me-2 fs-3"></i> Tambah Pendapatan Usaha
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('input_kop/store') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Unit Usaha</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-store"></i></span>
                <select name="id_usaha" class="form-select" required>
                  <option value="" selected disabled>-- Pilih Unit Usaha --</option>
                  <?php foreach($usaha as $u): ?>
                    <?php if (!empty($u['nama_usaha'])) : ?>
                      <option value="<?= $u['id_usaha'] ?>"><?= $u['nama_usaha'] ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Nominal Pendapatan</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control" id="format_jumlah" placeholder="0"required/>
                <input type="hidden" name="jumlah_pendapatan" id="jumlah_asli">
              </div>
              <small class="text-muted">Format otomatis: <span id="label_nominal">Rp 0</span></small>
            </div>
            <div class="col-12 mb-2">
              <label class="form-label fw-bold">Tanggal Transaksi</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                <input type="date" class="form-control" name="tanggal_pendapatan" value="<?= date('Y-m-d') ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-top">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x me-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bx bx-check me-1"></i> Simpan Data
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('input', function (e) {
    if (e.target.id === 'format_jumlah') {
        let input = e.target;
        let hiddenInput = document.getElementById('jumlah_asli');
        let labelNominal = document.getElementById('label_nominal');
        let value = input.value.replace(/\D/g, '');
      
        if (value) {
            let formatted = new Intl.NumberFormat('id-ID').format(value);
            input.value = formatted;
            if(hiddenInput) hiddenInput.value = value;
            if(labelNominal) labelNominal.innerText = 'Rp ' + formatted;
        } else {
            input.value = '';
            if(hiddenInput) hiddenInput.value = '';
            if(labelNominal) labelNominal.innerText = 'Rp 0';
        }
    }
});
</script>