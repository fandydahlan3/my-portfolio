<?php
require '../app/Config/Boot/development.php';
try {
    $db = \Config\Database::connect();
    echo "Koneksi berhasil!";
} catch (\Exception $e) {
    echo "Error koneksi: " . $e->getMessage();
}
