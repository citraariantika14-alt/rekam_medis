<?php
require_once '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

$stmt = mysqli_prepare($koneksi, "SELECT * FROM obat WHERE id_obat = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Obat - Rekam Medis</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">🏥 Rekam Medis</div>
        <ul class="sidebar-menu">
            <li><a href="../dashboard.php">Dashboard</a></li>
            <div class="menu-category">Data Master</div>
            <li><a href="../pasien/index.php">Pasien</a></li>
            <li><a href="../dokter/index.php">Dokter</a></li>
            <li><a href="index.php" class="active">Obat</a></li>
            <div class="menu-category">Pelayanan</div>
            <li><a href="../rekam_medis/index.php">Rekam Medis</a></li>
            <li><a href="../riwayat/index.php">Riwayat Pemeriksaan</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav class="navbar">
            <button class="toggle-btn" id="toggleBtn">☰</button>
            <div>Edit Obat</div>
        </nav>

        <main class="container">
            <h2>Edit Data Obat</h2>
            <div class="form-box">
                <form action="update.php" method="POST">
                    <input type="hidden" name="id_obat" value="<?= $data['id_obat']; ?>">
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" value="<?= htmlspecialchars($data['nama_obat']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" value="<?= htmlspecialchars($data['satuan']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" min="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </main>
    </div>
    <script src="../assets/js/script.js"></script>
</body>
</html>
