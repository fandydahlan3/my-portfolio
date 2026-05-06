<?php
mysqli_report(MYSQLI_REPORT_OFF);

// SESUAIKAN DENGAN SCREENSHOT PANEL ANDA
$host = "sql100.infinityfree.com"; 
$user = "if0_40396515";
$pass = "Bo3fDGDMOVXet"; // Masukkan password yang dari ikon mata tadi
$db   = "if0_40396515_psb_arrisalah"; 

$conn = mysqli_connect($host, $user, $pass, $db);

// Baris ini akan muncul kalau koneksi gagal
if (!$conn) {
    echo "<div style='color:red; background:yellow; padding:5px; position:fixed; top:0; z-index:9999; width:100%; text-align:center;'>
          Koneksi Masih Error: " . mysqli_connect_error() . "
          </div>";
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>