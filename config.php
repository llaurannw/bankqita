<?php
// Konfigurasi Database
$dbHost = 'localhost';
$dbUsername = 'root'; // Ganti jika berbeda
$dbPassword = '';     // Ganti jika berbeda
$dbName = 'bankqita';

// Membuat koneksi
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memulai session
session_start();
?>