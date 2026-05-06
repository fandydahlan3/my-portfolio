<?php
require 'koneksi.php';
require_once 'dompdf/autoload.inc.php'; 

use Dompdf\Dompdf;
use Dompdf\Options;

$id = isset($_GET['id']) ? $_GET['id'] : '';
if(empty($id)) { die("ID Santri tidak ditemukan."); }

// QUERY SUPER LENGKAP - Tetap sama sesuai permintaan Anda
$query = "SELECT 
            cs.*, 
            da.nama_lengkap AS nama_ayah_lengkap, da.no_hp AS hp_ayah, da.suku AS suku_ayah, da.tempat_lahir AS tl_ayah, da.tanggal_lahir AS tgl_ayah, da.pendidikan_terakhir AS pend_ayah, da.pekerjaan_ayah, da.penghasilan_ayah, da.alamat_ayah,
            di.nama_lengkap AS nama_ibu_lengkap, di.no_hp AS hp_ibu, di.suku AS suku_ibu, di.tempat_lahir AS tl_ibu, di.tanggal_lahir AS tgl_ibu, di.pendidikan_terakhir AS pend_ibu, di.pekerjaan_ibu, di.penghasilan_ibu, di.alamat_ibu,
            ps.nama_sekolah_asal, ps.nisn, ps.tahun_lulus, ps.no_sttb, ps.alamat_sekolah
          FROM calon_santri cs
          LEFT JOIN data_ayah da ON cs.id_santri = da.id_santri 
          LEFT JOIN data_ibu di ON cs.id_santri = di.id_santri 
          LEFT JOIN pendidikan_santri ps ON cs.id_santri = ps.id_santri 
          WHERE cs.id_santri = '$id'";

$result = mysqli_query($koneksi, $query);
$d = mysqli_fetch_assoc($result);

if(!$d) { die("Data tidak ditemukan."); }

// --- BAGIAN PERBAIKAN LOGO ---
$path = 'assets/img/header.png'; // Jalur file gambar
if (file_exists($path)) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
} else {
    // Jika file tidak ditemukan, gunakan string kosong agar tidak error
    $base64 = ''; 
}
// -----------------------------

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$html = '
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 15px; }
        .judul-seksi { background: #157347; color: white; padding: 5px; font-weight: bold; margin: 10px 0 5px 0; border-radius: 3px; }
        table { width: 100%; border-collapse: collapse; }
        table td { padding: 5px; border-bottom: 1px solid #eee; vertical-align: top; }
        .label { width: 30%; font-weight: bold; }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 0px;">
        <img src="'.$base64.'" style="width: 100%; height: auto;">
    </div>
    <hr style="border: 1px solid #000; margin-top: 0px; margin-bottom: 15px;">

    <div style="text-align: center; font-weight: bold; font-size: 14px; margin-bottom: 10px;">
        FORMULIR PENDAFTARAN SANTRI BARU (PSB)
    </div>

    <div class="judul-seksi">I. IDENTITAS CALON SANTRI</div>
    <table>
        <tr><td class="label">Nama Lengkap</td><td>: '.strtoupper($d['nama_lengkap']).'</td></tr>
        <tr><td class="label">Nama Panggilan</td><td>: '.$d['nama_panggilan'].'</td></tr>
        <tr><td class="label">Jenis Kelamin</td><td>: '.$d['jenis_kelamin'].'</td></tr>
        <tr><td class="label">Tempat, Tgl Lahir</td><td>: '.$d['tempat_lahir'].', '.$d['tanggal_lahir'].'</td></tr>
        <tr><td class="label">Kewarganegaraan</td><td>: '.$d['kewarganegaraan'].'</td></tr>
        <tr><td class="label">Hobi</td><td>: '.$d['hobi'].'</td></tr>
        <tr><td class="label">Anak Ke</td><td>: '.$d['anak_ke'].' dari '.($d['jml_saudara_kandung']+$d['jml_saudara_tiri']).' bersaudara</td></tr>
        <tr><td class="label">Status Santri</td><td>: '.$d['status_santri'].'</td></tr>
    </table>

    <div class="judul-seksi">II. KETERANGAN TEMPAT TINGGAL</div>
    <table>
        <tr><td class="label">Jalan / Gang</td><td>: '.$d['alamat_jalan'].'</td></tr>
        <tr><td class="label">RT/RW</td><td>: '.$d['alamat_rt_rw'].'</td></tr>
        <tr><td class="label">Desa/Kelurahan</td><td>: '.$d['alamat_desa'].'</td></tr>
        <tr><td class="label">Kecamatan</td><td>: '.$d['alamat_kecamatan'].'</td></tr>
        <tr><td class="label">Kabupaten/Kota</td><td>: '.$d['alamat_kabupaten'].'</td></tr>
        <tr><td class="label">Provinsi</td><td>: '.$d['alamat_provinsi'].'</td></tr>
        <tr><td class="label">Alamat Lengkap</td><td>: '.$d['alamat_lengkap'].'</td></tr>
    </table>

    <div class="judul-seksi">III. KETERANGAN KESEHATAN</div>
    <table>
        <tr><td class="label">Golongan Darah</td><td>: '.$d['gol_darah'].'</td></tr>
        <tr><td class="label">Riwayat Penyakit</td><td>: '.$d['riwayat_penyakit'].'</td></tr>
        <tr><td class="label">Kelainan Jasmani</td><td>: '.$d['kelainan_jasmani'].'</td></tr>
        <tr><td class="label">Berat Badan</td><td>: '.$d['berat_badan'].' kg</td></tr>
    </table>

    <div class="judul-seksi">IV. KETERANGAN PENDIDIKAN</div>
    <table>
        <tr><td class="label">Asal Sekolah</td><td>: '.$d['nama_sekolah_asal'].'</td></tr>
        <tr><td class="label">NISN</td><td>: '.$d['nisn'].'</td></tr>
        <tr><td class="label">Tahun Lulus</td><td>: '.$d['tahun_lulus'].'</td></tr>
        <tr><td class="label">No. STTB</td><td>: '.$d['no_sttb'].'</td></tr>
        <tr><td class="label">Alamat Sekolah</td><td>: '.$d['alamat_sekolah'].'</td></tr>
    </table>

    <div class="judul-seksi">V. DATA AYAH</div>
    <table>
        <tr><td class="label">Nama Ayah</td><td>: '.$d['nama_ayah_lengkap'].'</td></tr>
        <tr><td class="label">Suku</td><td>: '.$d['suku_ayah'].'</td></tr>
        <tr><td class="label">Pekerjaan</td><td>: '.$d['pekerjaan_ayah'].'</td></tr>
        <tr><td class="label">No. HP</td><td>: '.$d['hp_ayah'].'</td></tr>
        <tr><td class="label">Alamat Ayah</td><td>: '.$d['alamat_ayah'].'</td></tr>
    </table>

    <div class="judul-seksi">VI. DATA IBU</div>
    <table>
        <tr><td class="label">Nama Ibu</td><td>: '.$d['nama_ibu_lengkap'].'</td></tr>
        <tr><td class="label">Suku</td><td>: '.$d['suku_ibu'].'</td></tr>
        <tr><td class="label">Pekerjaan</td><td>: '.$d['pekerjaan_ibu'].'</td></tr>
        <tr><td class="label">No. HP</td><td>: '.$d['hp_ibu'].'</td></tr>
        <tr><td class="label">Alamat Ibu</td><td>: '.$d['alamat_ibu'].'</td></tr>
    </table>

    <div style="margin-top:20px; text-align:right;">
        <p>Bogor, '.date('d F Y').'</p>
        <br><br><br>
        <p><strong>( Panitia PSB Ar-Risalah )</strong></p>
    </div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Pendaftaran_".$d['nama_lengkap'].".pdf", array("Attachment" => 0));
?>