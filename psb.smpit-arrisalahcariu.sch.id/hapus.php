<?php
require 'koneksi.php';

$id = $_GET['id'];

// Hapus berdasarkan id_santri
mysqli_query($koneksi, "DELETE FROM data_ayah WHERE id_santri='$id'");
mysqli_query($koneksi, "DELETE FROM data_ibu WHERE id_santri='$id'");
mysqli_query($koneksi, "DELETE FROM pendidikan_santri WHERE id_santri='$id'");
mysqli_query($koneksi, "DELETE FROM calon_santri WHERE id_santri='$id'");

echo "<script>
        alert('Data berhasil dihapus!');
        window.location='tables.php';
      </script>";
?>
