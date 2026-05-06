<!DOCTYPE html>
<html>
<head>
<title>Formulir Pendaftaran Santri</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h3 class="text-center mb-4">Formulir Pendaftaran Santri Baru</h3>

    <form action="proses_formulir.php" method="POST" class="card p-4 shadow">

        <h5>Data Calon Santri</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nama Panggilan</label>
                <input type="text" name="nama_panggilan" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih...</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>No HP</label>
                <input type="text" name="hp" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Anak Ke</label>
                <input type="number" name="anak_ke" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Jumlah Saudara</label>
                <input type="number" name="jumlah_saudara" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Tinggi Badan (cm)</label>
                <input type="number" name="tinggi_badan" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Berat Badan (kg)</label>
                <input type="number" name="berat_badan" class="form-control">
            </div>

            <div class="col-12 mb-3">
                <label>Alamat Rumah</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
        </div>

        <hr>
        <h5>Pendidikan Santri</h5>
        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Sekolah Asal</label>
                <input type="text" name="sekolah_asal" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Pendidikan Terakhir</label>
                <select name="pendidikan_terakhir" class="form-control">
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="Paket A/B/C">Paket A/B/C</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="col-12 mb-3">
                <label>Alamat Sekolah</label>
                <textarea name="alamat_sekolah" class="form-control"></textarea>
            </div>

        </div>

        <hr>
        <h5>Data Ayah</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir_ayah" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir_ayah" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Pendidikan</label>
                <input type="text" name="pendidikan_ayah" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan_ayah" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Penghasilan</label>
                <input type="text" name="penghasilan_ayah" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>No HP Ayah</label>
                <input type="text" name="hp_ayah" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Alamat Ayah</label>
                <textarea name="alamat_ayah" class="form-control"></textarea>
            </div>
        </div>

        <hr>
        <h5>Data Ibu</h5>
        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir_ibu" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir_ibu" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Pendidikan</label>
                <input type="text" name="pendidikan_ibu" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan_ibu" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Penghasilan</label>
                <input type="text" name="penghasilan_ibu" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>No HP Ibu</label>
                <input type="text" name="hp_ibu" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Alamat Ibu</label>
                <textarea name="alamat_ibu" class="form-control"></textarea>
            </div>

        </div>

        <button class="btn btn-primary w-100 mt-3">Kirim Pendaftaran</button>
    </form>

</div>

</body>
</html>