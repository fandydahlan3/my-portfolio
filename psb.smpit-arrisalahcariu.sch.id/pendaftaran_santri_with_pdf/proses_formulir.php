<?php
include "koneksi.php";

function esc($koneksi, $val){
    return mysqli_real_escape_string($koneksi, $val);
}

$nama_lengkap = esc($koneksi, $_POST['nama_lengkap'] ?? '');
// ... (escape other fields similarly)
$nama_panggilan = esc($koneksi, $_POST['nama_panggilan'] ?? '');
$jenis_kelamin = esc($koneksi, $_POST['jenis_kelamin'] ?? '');
$tempat_lahir = esc($koneksi, $_POST['tempat_lahir'] ?? '');
$tanggal_lahir = esc($koneksi, $_POST['tanggal_lahir'] ?? '');
$hp = esc($koneksi, $_POST['hp'] ?? '');
$anak_ke = esc($koneksi, $_POST['anak_ke'] ?? '0');
$jumlah_saudara = esc($koneksi, $_POST['jumlah_saudara'] ?? '0');
$tinggi_badan = esc($koneksi, $_POST['tinggi_badan'] ?? '0');
$berat_badan = esc($koneksi, $_POST['berat_badan'] ?? '0');
$alamat = esc($koneksi, $_POST['alamat'] ?? '');

$sekolah_asal = esc($koneksi, $_POST['sekolah_asal'] ?? '');
$alamat_sekolah = esc($koneksi, $_POST['alamat_sekolah'] ?? '');
$pendidikan_terakhir = esc($koneksi, $_POST['pendidikan_terakhir'] ?? '');

$nama_ayah = esc($koneksi, $_POST['nama_ayah'] ?? '');
$tempat_lahir_ayah = esc($koneksi, $_POST['tempat_lahir_ayah'] ?? '');
$tanggal_lahir_ayah = esc($koneksi, $_POST['tanggal_lahir_ayah'] ?? '');
$pendidikan_ayah = esc($koneksi, $_POST['pendidikan_ayah'] ?? '');
$pekerjaan_ayah = esc($koneksi, $_POST['pekerjaan_ayah'] ?? '');
$penghasilan_ayah = esc($koneksi, $_POST['penghasilan_ayah'] ?? '');
$hp_ayah = esc($koneksi, $_POST['hp_ayah'] ?? '');
$alamat_ayah = esc($koneksi, $_POST['alamat_ayah'] ?? '');

$nama_ibu = esc($koneksi, $_POST['nama_ibu'] ?? '');
$tempat_lahir_ibu = esc($koneksi, $_POST['tempat_lahir_ibu'] ?? '');
$tanggal_lahir_ibu = esc($koneksi, $_POST['tanggal_lahir_ibu'] ?? '');
$pendidikan_ibu = esc($koneksi, $_POST['pendidikan_ibu'] ?? '');
$pekerjaan_ibu = esc($koneksi, $_POST['pekerjaan_ibu'] ?? '');
$penghasilan_ibu = esc($koneksi, $_POST['penghasilan_ibu'] ?? '');
$hp_ibu = esc($koneksi, $_POST['hp_ibu'] ?? '');
$alamat_ibu = esc($koneksi, $_POST['alamat_ibu'] ?? '');

// insert calon_santri
$sql1 = "INSERT INTO calon_santri (nama_lengkap, nama_panggilan, jenis_kelamin, tempat_lahir, tanggal_lahir, hp, anak_ke, jumlah_saudara, tinggi_badan, berat_badan, alamat)
VALUES ('$nama_lengkap','$nama_panggilan','$jenis_kelamin','$tempat_lahir','$tanggal_lahir','$hp','$anak_ke','$jumlah_saudara','$tinggi_badan','$berat_badan','$alamat')";
mysqli_query($koneksi, $sql1);
$id_santri = mysqli_insert_id($koneksi);

// pendidikan
$sql2 = "INSERT INTO pendidikan_santri (id_santri, sekolah_asal, alamat_sekolah, pendidikan_terakhir)
VALUES ('$id_santri','$sekolah_asal','$alamat_sekolah','$pendidikan_terakhir')";
mysqli_query($koneksi, $sql2);

// ayah
$sql3 = "INSERT INTO data_ayah (id_santri, nama_ayah, tempat_lahir, tanggal_lahir, pendidikan, pekerjaan, penghasilan, hp_ayah, alamat_ayah)
VALUES ('$id_santri','$nama_ayah','$tempat_lahir_ayah','$tanggal_lahir_ayah','$pendidikan_ayah','$pekerjaan_ayah','$penghasilan_ayah','$hp_ayah','$alamat_ayah')";
mysqli_query($koneksi, $sql3);

// ibu
$sql4 = "INSERT INTO data_ibu (id_santri, nama_ibu, tempat_lahir, tanggal_lahir, pendidikan, pekerjaan, penghasilan, hp_ibu, alamat_ibu)
VALUES ('$id_santri','$nama_ibu','$tempat_lahir_ibu','$tanggal_lahir_ibu','$pendidikan_ibu','$pekerjaan_ibu','$penghasilan_ibu','$hp_ibu','$alamat_ibu')";
mysqli_query($koneksi, $sql4);

echo "<script>alert('Pendaftaran berhasil dikirim!'); window.location='tables.php';</script>";
?>