<div class="modal fade" id="modalTambahAngsuran" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-label-primary pb-3">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bx bx-spreadsheet me-2 fs-3"></i> Form Input Angsuran
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('d_angsuran/store') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Cari Anggota</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" name="nomor_anggota" list="listAnggota" placeholder="Ketik nomor / nama anggota..." autocomplete="off" required>
              </div>
              <datalist id="listAnggota">
                <?php foreach ($anggota as $a): ?>
                  <option value="<?= $a['nomor_anggota'] ?>">
                    <?= $a['nomor_anggota'] ?> - <?= $a['nama_anggota'] ?>
                  </option>
                <?php endforeach; ?>
              </datalist>
            </div>
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Nominal Angsuran</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control" id="nominal_angsuran" placeholder="0" required>
                <input type="hidden" name="nominal_angsuran" id="nominal_angsuran_asli">
              </div>
              <small class="text-muted">Format otomatis: <span id="label_nominal_angsuran" class="badge bg-label-primary">Rp 0</span></small>
            </div>
            <div class="col-12 mb-2">
              <label class="form-label fw-bold">Tanggal Angsuran</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-calendar-check"></i></span>
                <input type="date" class="form-control" name="tanggal_angsuran" value="<?= date('Y-m-d') ?>"required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-top">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x me-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bx bx-check me-1"></i> Simpan Angsuran
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('input', function (e) {
    if (e.target.id === 'nominal_angsuran') {
        let input = e.target;
        let hiddenInput = document.getElementById('nominal_angsuran_asli');
        let label = document.getElementById('label_nominal_angsuran');
        
        let value = input.value.replace(/\D/g, '');
        if (value) {
            let formatted = new Intl.NumberFormat('id-ID').format(value);
            input.value = formatted;
            if(hiddenInput) hiddenInput.value = value;
            if(label) label.innerText = 'Rp ' + formatted;
        } else {
            input.value = '';
            if(hiddenInput) hiddenInput.value = '';
            if(label) label.innerText = 'Rp 0';
        }
    }
});
</script>