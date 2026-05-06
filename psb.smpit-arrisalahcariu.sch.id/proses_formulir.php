<?php
require 'koneksi.php';

if (isset($_POST['proses'])) {
    // 1. DATA SANTRI (Tabel: calon_santri)
    $nama_lengkap     = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nama_panggilan   = mysqli_real_escape_string($koneksi, $_POST['nama_panggilan']);
    $jenis_kelamin    = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $jenjang          = mysqli_real_escape_string($koneksi, $_POST['jenjang_pendidikan']);
    $tempat_lahir     = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_santri']);
    $tgl_lahir        = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir_santri']);
    $kewarganegaraan  = mysqli_real_escape_string($koneksi, $_POST['kewarganegaraan_santri']);
    $hobi             = mysqli_real_escape_string($koneksi, $_POST['hobi_santri']);
    $anak_ke          = mysqli_real_escape_string($koneksi, $_POST['anak_ke']);
    $jml_saudara      = mysqli_real_escape_string($koneksi, $_POST['jml_saudara_kandung']);
    $jml_tiri         = mysqli_real_escape_string($koneksi, $_POST['jml_saudara_tiri']);
    $jml_angkat       = mysqli_real_escape_string($koneksi, $_POST['jml_saudara_angkat']);
    $status_santri    = mysqli_real_escape_string($koneksi, $_POST['status_santri']);
    $tinggal_dengan   = mysqli_real_escape_string($koneksi, $_POST['tinggal_dengan']);
    $alamat_lengkap   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $berat_badan      = mysqli_real_escape_string($koneksi, $_POST['berat_badan']);

    // SIMPAN KE TABEL calon_santri
    $sql_santri = "INSERT INTO calon_santri (nama_lengkap, nama_panggilan, jenis_kelamin, jenjang_pendidikan, tempat_lahir, tanggal_lahir, kewarganegaraan, hobi, anak_ke, jml_saudara_kandung, jml_saudara_tiri, jml_saudara_angkat, status_santri, tinggal_dengan, alamat_lengkap, berat_badan) 
                   VALUES ('$nama_lengkap', '$nama_panggilan', '$jenis_kelamin', '$jenjang', '$tempat_lahir', '$tgl_lahir', '$kewarganegaraan', '$hobi', '$anak_ke', '$jml_saudara', '$jml_tiri', '$jml_angkat', '$status_santri', '$tinggal_dengan', '$alamat_lengkap', '$berat_badan')";
    
    if (mysqli_query($koneksi, $sql_santri)) {
        $id_santri = mysqli_insert_id($koneksi); // Ambil ID Santri yang baru masuk

        // 2. DATA PENDIDIKAN (Tabel: pendidikan_santri)
        $asal_sekolah   = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
        $nisn           = mysqli_real_escape_string($koneksi, $_POST['nisn']);
        $tahun_lulus    = mysqli_real_escape_string($koneksi, $_POST['tahun_lulus']);
        $no_sttb        = mysqli_real_escape_string($koneksi, $_POST['no_sttb']);
        
        mysqli_query($koneksi, "INSERT INTO pendidikan_santri (id_santri, nama_sekolah_asal, nisn, tahun_lulus, no_sttb) 
                                VALUES ('$id_santri', '$asal_sekolah', '$nisn', '$tahun_lulus', '$no_sttb')");

        // 3. DATA AYAH (Tabel: data_ayah)
        $nama_ayah      = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap_ayah']);
        $hp_ayah        = mysqli_real_escape_string($koneksi, $_POST['no_hp_ayah']);
        $suku_ayah      = mysqli_real_escape_string($koneksi, $_POST['suku_ayah']);
        $tl_ayah        = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_ayah']);
        $tgl_ayah       = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_ayah']);
        $pend_ayah      = mysqli_real_escape_string($koneksi, $_POST['pendidikan_terakhir_ayah']);
        $kerja_ayah     = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ayah']);
        $hasil_ayah     = mysqli_real_escape_string($koneksi, $_POST['penghasilan_ayah']);

        mysqli_query($koneksi, "INSERT INTO data_ayah (id_santri, nama_lengkap, no_hp, suku, tempat_lahir, tanggal_lahir, pendidikan_terakhir, pekerjaan_ayah, penghasilan_ayah) 
                                VALUES ('$id_santri', '$nama_ayah', '$hp_ayah', '$suku_ayah', '$tl_ayah', '$tgl_ayah', '$pend_ayah', '$kerja_ayah', '$hasil_ayah')");

        // 4. DATA IBU (Tabel: data_ibu)
        $nama_ibu       = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap_ibu']);
        $hp_ibu         = mysqli_real_escape_string($koneksi, $_POST['no_hp_ibu']);
        $suku_ibu       = mysqli_real_escape_string($koneksi, $_POST['suku_ibu']);
        $tl_ibu         = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_ibu']);
        $tgl_ibu        = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_ibu']);
        $pend_ibu       = mysqli_real_escape_string($koneksi, $_POST['pendidikan_terakhir_ibu']);
        $kerja_ibu      = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ibu']);
        $hasil_ibu      = mysqli_real_escape_string($koneksi, $_POST['penghasilan_ibu']);

        mysqli_query($koneksi, "INSERT INTO data_ibu (id_santri, nama_lengkap, no_hp, suku, tempat_lahir, tanggal_lahir, pendidikan_terakhir, pekerjaan_ibu, penghasilan_ibu) 
                                VALUES ('$id_santri', '$nama_ibu', '$hp_ibu', '$suku_ibu', '$tl_ibu', '$tgl_ibu', '$pend_ibu', '$kerja_ibu', '$hasil_ibu')");

        echo "<script>
                alert('Berhasil! Data Tersimpan.');
                window.location.href='export_pdf.php?id=$id_santri';
              </script>";
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}
?>