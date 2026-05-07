<div class="modal fade" id="modalBayarAngsuran" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-label-success pb-3">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bx bx-money me-2 fs-3"></i> Bayar Cicilan Angsuran
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="formBayarCicilan">
        <div class="modal-body">
          <input type="hidden" name="id_angsuran" id="id_angsuran">

          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Nominal Bayar</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">Rp</span>
                <input 
                  type="text" 
                  id="format_bayar_cicilan" 
                  class="form-control" 
                  placeholder="Masukkan nominal..." 
                  required
                >
                <input type="hidden" name="nominal_bayar" id="nominal_bayar_asli">
              </div>
              <small class="text-muted">Format otomatis: <span id="label_bayar_cicilan" class="badge bg-label-success">Rp 0</span></small>
            </div>

            <div class="col-12 mb-2">
              <label class="form-label fw-bold">Tanggal Bayar</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                <input 
                  type="date" 
                  name="tanggal_bayar" 
                  class="form-control" 
                  value="<?= date('Y-m-d') ?>" 
                  required
                >
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer border-top">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x me-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-success">
            <i class="bx bx-check-double me-1"></i> Proses Bayar
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
document.getElementById('format_bayar_cicilan').addEventListener('input', function(e) {
    let value = this.value.replace(/\D/g, '');
    let hiddenInput = document.getElementById('nominal_bayar_asli');
    let label = document.getElementById('label_bayar_cicilan');
    
    if (value) {
        let formatted = new Intl.NumberFormat('id-ID').format(value);
        this.value = formatted;
        if(hiddenInput) hiddenInput.value = value;
        if(label) label.innerText = 'Rp ' + formatted;
    } else {
        this.value = '';
        if(hiddenInput) hiddenInput.value = '';
        if(label) label.innerText = 'Rp 0';
    }
});
</script>