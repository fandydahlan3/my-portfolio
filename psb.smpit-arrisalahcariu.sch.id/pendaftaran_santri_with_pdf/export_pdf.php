<?php
// export_pdf.php
// Requires dompdf: composer require dompdf/dompdf
require 'vendor/autoload.php';
use Dompdf\Dompdf;

include 'koneksi.php';

// fetch data
$sql = "SELECT c.id_santri, c.nama_lengkap, c.jenis_kelamin, c.hp, p.sekolah_asal, a.nama_ayah, i.nama_ibu
FROM calon_santri c
LEFT JOIN pendidikan_santri p ON c.id_santri = p.id_santri
LEFT JOIN data_ayah a ON c.id_santri = a.id_santri
LEFT JOIN data_ibu i ON c.id_santri = i.id_santri
ORDER BY c.id_santri DESC";
$q = mysqli_query($koneksi, $sql);

// build html
$html = '<h2 style="text-align:center;">Daftar Pendaftaran Santri</h2>';
$html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
$html .= '<thead><tr style="background:#eee;"><th>No</th><th>Nama Santri</th><th>Jenis Kelamin</th><th>No HP</th><th>Sekolah Asal</th><th>Ayah</th><th>Ibu</th></tr></thead><tbody>';

$no = 1;
while ($d = mysqli_fetch_array($q)) {
    $html .= '<tr>';
    $html .= '<td>'.$no++.'</td>';
    $html .= '<td>'.$d['nama_lengkap'].'</td>';
    $html .= '<td>'.$d['jenis_kelamin'].'</td>';
    $html .= '<td>'.$d['hp'].'</td>';
    $html .= '<td>'.$d['sekolah_asal'].'</td>';
    $html .= '<td>'.$d['nama_ayah'].'</td>';
    $html .= '<td>'.$d['nama_ibu'].'</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// instantiate and use dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','landscape');
$dompdf->render();
$dompdf->stream('daftar_santri.pdf', array('Attachment' => 0)); // Attachment=0 -> open in browser
exit;
?>