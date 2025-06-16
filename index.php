<?php
// Cek apakah user sudah login
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    // Jika sudah login, arahkan ke dashboard
    header("Location: dashboard.php");
} else {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
}
exit();
