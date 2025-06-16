<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// KERENTANAN BROKEN ACCESS CONTROL TETAP ADA
// Seharusnya ada pengecekan if ($_SESSION['role'] !== 'admin') { die('Akses ditolak'); }, tapi sengaja dihilangkan.

$search_result = [];
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search']; // Input tidak disanitasi untuk XSS
    $sql = "SELECT name, position, salary FROM employees WHERE name LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $search_result[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pegawai - BANKqita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">BANKqita</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="pegawai.php">Manajemen Pegawai</a>
                    </li>
                </ul>
                 <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Pencarian Data Pegawai</h3>
        <p>Halaman ini seharusnya hanya bisa diakses oleh Admin. User biasa bisa masuk karena adanya kerentanan **Broken Access Control**.</p>
        
        <form method="get" action="" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Cari Nama Pegawai..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <?php if (isset($_GET['search'])): ?>
            <div class="alert alert-secondary">
                Hasil pencarian untuk: <strong><?php echo $_GET['search']; // Variabel dicetak tanpa sanitasi ?></strong>
            </div>
        <?php endif; ?>

        <?php if (!empty($search_result)): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($search_result as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['position']); ?></td>
                        <td><?php echo "Rp " . number_format($row['salary'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif(isset($_GET['search'])): ?>
            <p class="text-center">Data tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>