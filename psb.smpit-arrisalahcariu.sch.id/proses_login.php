<?php
session_start();
require 'koneksi.php';

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

// PREPARED STATEMENT
$sql = $koneksi->prepare("SELECT * FROM admin WHERE username = ?");
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();
$data = $result->fetch_assoc();

if ($data && password_verify($password, $data['password'])) {

    // regenerate session (AMAN)
    session_regenerate_id(true);

    $_SESSION["login"] = $data["username"];
    header("Location: tables.php");
    exit;

} else {
    echo "<script>
            alert('Login gagal! Username/Password salah');
            window.location='login.php';
          </script>";
}
?>
