<?php
// Tidak perlu session_start() lagi karena sudah ada di function.php
if(!isset($_SESSION['log'])){
    header('location:login.php');
    exit;
}
?>