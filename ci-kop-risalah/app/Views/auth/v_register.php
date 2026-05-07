<form class="mb-3" action="<?= base_url('auth/register_action') ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Anda" required />
    </div>

    <div class="mb-3">
        <label class="form-label">Nomor Anggota</label>
        <input type="text" class="form-control" name="nomor_anggota" placeholder="Contoh: 123123123" required />
        <small class="text-muted">Pastikan nomor ini sesuai dengan data di tabel iuran.</small>
    </div>
    <div class="mb-3">
        <label class="form-label">Role / Jabatan</label>
        <select name="role" class="form-select" required>
            <option value="user">User </option>
            <option value="admin">Admin </option>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username unik" required />
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="············" required />
    </div>
    
    <button class="btn btn-primary d-grid w-100">Daftar</button>
</form>