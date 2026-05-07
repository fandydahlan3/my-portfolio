<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-label-primary pb-3">
                <h5 class="modal-title" id="modalCenterTitle">
                    <i class="bx bx-wallet me-1"></i> Input Pembayaran Iuran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('iuran') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">  
                    <div class="row mb-4">
                        <div class="col">
                            <label class="form-label fw-bold"><i class="bx bx-user me-1"></i>Nama Anggota / Nomor</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" name="nomor_anggota" list="listAnggota" placeholder="Ketik nama atau nomor anggota..." autocomplete="off" required>
                            </div>
                            <datalist id="listAnggota">
                                <?php foreach ($anggota as $a): ?>
                                    <option value="<?= $a['nomor_anggota'] ?>">
                                        <?= $a['nomor_anggota'] ?> - <?= $a['nama_anggota'] ?>
                                    </option>
                                <?php endforeach ?>
                            </datalist>
                            <small class="text-muted">Pilih dari daftar yang muncul saat mengetik.</small>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-primary">Iuran Pokok</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <select class="form-select" name="iuran_pokok" required>
                                    <option value="0">0</option>
                                    <option value="50000">50.000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-primary">Iuran Wajib</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <select class="form-select" name="iuran_wajib" required>
                                    <option value="0">0</option>
                                    <option value="50000">50.000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-success">Iuran Sukarela</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-success">Rp</span>
                                <input type="number" name="iuran_sukarela" class="form-control" placeholder="0">
                            </div>
                            <small class="text-muted">Isi manual jika nominal beda.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Bayar</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="date" name="tanggal_iuran" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-check-circle me-1"></i>Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>