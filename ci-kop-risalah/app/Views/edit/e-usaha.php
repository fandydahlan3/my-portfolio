<?php foreach($usaha as $row): ?>
<div class="modal fade" id="modalEditUsaha<?= $row['id_usaha'] ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header bg-label-success pb-3">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bx bx-edit me-2 fs-3"></i> Edit Unit Usaha
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url('usaha/update/'.$row['id_usaha']) ?>" method="post">
        <?= csrf_field(); ?>
        
        <div class="modal-body">
          <div class="row">
            
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Nama Usaha</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                <input 
                  type="text" 
                  name="nama_usaha" 
                  class="form-control" 
                  value="<?= $row['nama_usaha'] ?>" 
                  required
                />
              </div>
            </div>

            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Alamat Usaha</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-map"></i></span>
                <textarea 
                  name="alamat_usaha" 
                  class="form-control" 
                  rows="2" 
                  required
                ><?= $row['alamat_usaha'] ?></textarea>
              </div>
            </div>

            <div class="col-12 mb-2">
              <label class="form-label fw-bold">Tanggal Usaha</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                <input 
                  type="date" 
                  name="tanggal_usaha" 
                  class="form-control" 
                  value="<?= $row['tanggal_usaha'] ?>" 
                  required
                />
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
<?php endforeach; ?>