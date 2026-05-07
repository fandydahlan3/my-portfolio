<?php if (!empty($pendapatan)): ?>
    <?php 
    $p = is_array($pendapatan) ? (object)$pendapatan : $pendapatan; 
    ?>
    <form action="<?= base_url('input_kop/update') ?>" method="POST">
        <?= csrf_field(); ?>
        <input type="hidden" name="id_pendapatan" value="<?= $p->id_pendapatan ?>">

        <div class="row">
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Unit Usaha</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-store"></i></span>
                    <select name="id_usaha" class="form-select" required>
                        <option value="" disabled>-- Pilih Unit Usaha --</option>
                        <?php foreach ($usaha as $u): ?>
                            <option value="<?= $u['id_usaha'] ?>" <?= ($u['id_usaha'] == $p->id_usaha) ? 'selected' : '' ?>>
                                <?= $u['nama_usaha'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Nominal Pendapatan</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">Rp</span>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="format_jumlah_edit" 
                        value="<?= number_format($p->jumlah_pendapatan, 0, ',', '.') ?>" 
                        required 
                    />
                    <input type="hidden" name="jumlah_pendapatan" id="jumlah_asli_edit" value="<?= $p->jumlah_pendapatan ?>">
                </div>
                <small class="text-muted">Format otomatis: <span id="label_nominal_edit" class="badge bg-label-success">Rp <?= number_format($p->jumlah_pendapatan, 0, ',', '.') ?></span></small>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Tanggal Transaksi</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input 
                        type="date" 
                        name="tanggal_pendapatan" 
                        class="form-control" 
                        value="<?= $p->tanggal_pendapatan ?>" 
                        required 
                    />
                </div>
            </div>
        </div>

        <div class="modal-footer px-0 pb-0 mt-3 border-top pt-3">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x me-1"></i> Batal
            </button>
            <button type="submit" class="btn btn-success">
                <i class="bx bx-save me-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>

    <script>
    // Script khusus update label real-time di modal edit
    document.getElementById('format_jumlah_edit').addEventListener('input', function() {
        let val = this.value.replace(/\D/g, '');
        let label = document.getElementById('label_nominal_edit');
        if(val) {
            let formatted = new Intl.NumberFormat('id-ID').format(val);
            if(label) label.innerText = 'Rp ' + formatted;
        } else {
            if(label) label.innerText = 'Rp 0';
        }
    });
    </script>

<?php else: ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="bx bx-error-circle me-2"></i> Data tidak ditemukan.
    </div>
<?php endif; ?>