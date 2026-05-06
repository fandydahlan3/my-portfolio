<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Santri</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<h3 class="text-center mb-4">Data Pendaftaran Santri</h3>

<div class="mb-3">
    <a href="formulir.php" class="btn btn-success">Tambah Pendaftaran</a>
    <a href="export_pdf.php" class="btn btn-primary">Export PDF</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th>Sekolah Asal</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
        </tr>
    </thead>
    <tbody>
<?php
$no = 1;
$sql = "SELECT c.id_santri, c.nama_lengkap, c.jenis_kelamin, c.hp, p.sekolah_asal, a.nama_ayah, i.nama_ibu
FROM calon_santri c
LEFT JOIN pendidikan_santri p ON c.id_santri = p.id_santri
LEFT JOIN data_ayah a ON c.id_santri = a.id_santri
LEFT JOIN data_ibu i ON c.id_santri = i.id_santri
ORDER BY c.id_santri DESC";
$q = mysqli_query($koneksi, $sql);
while ($d = mysqli_fetch_array($q)) {
    echo '<tr>';
    echo '<td>'.($no++).'</td>';
    echo '<td>'.$d['nama_lengkap'].'</td>';
    echo '<td>'.$d['jenis_kelamin'].'</td>';
    echo '<td>'.$d['hp'].'</td>';
    echo '<td>'.$d['sekolah_asal'].'</td>';
    echo '<td>'.$d['nama_ayah'].'</td>';
    echo '<td>'.$d['nama_ibu'].'</td>';
    echo '</tr>';
}
?>
    </tbody>
</table>
</div>
</body>
</html>