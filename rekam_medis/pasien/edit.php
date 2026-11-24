<?php
require_once '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

$stmt = mysqli_prepare($koneksi, "SELECT * FROM pasien WHERE id_pasien = ?");
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
    <title>Edit Pasien - Rekam Medis</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">🏥 Rekam Medis</div>
        <ul class="sidebar-menu">
            <li><a href="../dashboard.php">Dashboard</a></li>
            <div class="menu-category">Data Master</div>
            <li><a href="index.php" class="active">Pasien</a></li>
            <li><a href="../dokter/index.php">Dokter</a></li>
            <li><a href="../obat/index.php">Obat</a></li>
            <div class="menu-category">Pelayanan</div>
            <li><a href="../rekam_medis/index.php">Rekam Medis</a></li>
            <li><a href="../riwayat/index.php">Riwayat Pemeriksaan</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav class="navbar">
            <button class="toggle-btn" id="toggleBtn">☰</button>
            <div>Edit Pasien</div>
        </nav>

        <main class="container">
            <h2>Edit Data Pasien</h2>
            <div class="form-box">
                <form action="update.php" method="POST">
                    <input type="hidden" name="id_pasien" value="<?= $data['id_pasien']; ?>">
                    <div class="form-group">
                        <label>No. RM</label>
                        <input type="text" name="no_rm" class="form-control" value="<?= htmlspecialchars($data['no_rm']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control" value="<?= htmlspecialchars($data['nama_pasien']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="L" <?= $data['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-Laki (L)</option>
                            <option value="P" <?= $data['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan (P)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['alamat']); ?></textarea>
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
