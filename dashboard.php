<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// KERENTANAN LFI TETAP ADA
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    readfile($file);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BANKqita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">BANKqita</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="pegawai.php">Manajemen Pegawai</a>
                    </li>
                </ul>
                <span class="navbar-text text-white me-3">
                    Halo, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>)
                </span>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Download Laporan Keuangan</h4>
                    </div>
                    <div class="card-body">
                        <p>Silakan pilih laporan yang ingin Anda unduh.</p>
                        <div class="list-group">
                            <a href="dashboard.php?file=laporan_q1_2024.pdf" class="list-group-item list-group-item-action">Laporan Keuangan Kuartal 1 2024 (PDF)</a>
                            <a href="dashboard.php?file=laporan_q2_2024.pdf" class="list-group-item list-group-item-action">Laporan Keuangan Kuartal 2 2024 (PDF)</a>
                        </div>
                    </div>
                     <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>