<?php
require_once 'config.php';

// Hancurkan semua data sesi
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit();
?>