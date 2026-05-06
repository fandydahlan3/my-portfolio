<?php
session_start();

// Hapus cookie session (opsional - Membersihkan di sisi browser)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_unset();    // Menghapus semua variabel session ($_SESSION)
session_destroy();  // Menghapus session dari server

header('Location: login.php');
exit;               // Menghentikan eksekusi script
?>