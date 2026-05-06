<?php
session_start();
include "koneksi.php";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$username = mysqli_real_escape_string($koneksi, $username);
$password = mysqli_real_escape_string($koneksi, $password);

$q = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_array($q);

if ($data) {
    $_SESSION["login"] = $data["username"];
    header("Location: tables.php");
} else {
    echo "<script>
            alert('Login gagal! Periksa username/password');
            window.location='login.php';
          </script>";
}
?>