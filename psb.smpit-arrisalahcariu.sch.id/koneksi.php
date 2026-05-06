<?php
// Data dari panel MySQL Hostname Anda
$host = "sql100.infinityfree.com"; 
$user = "if0_40396515";           
$pass = "Bo3fDGDMOVXet"; // Pastikan ini password dari ikon mata di panel
$db   = "if0_40396515_psb_arrisalah";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// Jika berhasil, halaman akan tampil tanpa pesan error koneksi
?>