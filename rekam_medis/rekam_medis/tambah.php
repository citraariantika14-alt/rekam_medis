<?php
require_once '../koneksi.php';

$pasien_opt = mysqli_query($koneksi, "SELECT id_pasien, no_rm, nama_pasien FROM pasien ORDER BY nama_pasien ASC");
$dokter_opt = mysqli_query($koneksi, "SELECT id_dokter, nama_dokter FROM dokter ORDER BY nama_dokter ASC");
$obat_opt   = mysqli_query($koneksi, "SELECT id_obat, nama_obat, satuan FROM obat ORDER BY nama_obat ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rekam Medis - Aplikasi Rekam Medis</title>
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
            <li><a href="../obat/index.php">Obat</a></li>
            <div class="menu-category">Pelayanan</div>
            <li><a href="index.php" class="active">Rekam Medis</a></li>
            <li><a href="../riwayat/index.php">Riwayat Pemeriksaan</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav class="navbar">
            <button class="toggle-btn" id="toggleBtn">☰</button>
            <div>Form Catat Rekam Medis</div>
        </nav>

        <main class="container">
            <h2>Tambah Catatan Rekam Medis</h2>
            <div class="form-box">
                <form action="simpan.php" method="POST">
                    <div class="form-group">
                        <label>Pasien</label>
                        <select name="id_pasien" class="form-control" required>
                            <option value="">-- Pilih Pasien --</option>
                            <?php while ($p = mysqli_fetch_assoc($pasien_opt)): ?>
                                <option value="<?= $p['id_pasien']; ?>"><?= $p['no_rm']; ?> - <?= htmlspecialchars($p['nama_pasien']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dokter Penanggung Jawab</label>
                        <select name="id_dokter" class="form-control" required>
                            <option value="">-- Pilih Dokter --</option>
                            <?php while ($d = mysqli_fetch_assoc($dokter_opt)): ?>
                                <option value="<?= $d['id_dokter']; ?>"><?= htmlspecialchars($d['nama_dokter']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Obat Diberikan</label>
                        <select name="id_obat" class="form-control" required>
                            <option value="">-- Pilih Obat --</option>
                            <?php while ($o = mysqli_fetch_assoc($obat_opt)): ?>
                                <option value="<?= $o['id_obat']; ?>"><?= htmlspecialchars($o['nama_obat']); ?> (<?= $o['satuan']; ?>)</option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pemeriksaan</label>
                        <input type="date" name="tanggal_periksa" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Keluhan</label>
                        <textarea name="keluhan" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Diagnosa</label>
                        <textarea name="diagnosa" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Tindakan</label>
                        <textarea name="tindakan" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Resep & Aturan Pakai</label>
                        <input type="text" name="resep" class="form-control" placeholder="Contoh: 3x1 sehari sesudah makan" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Rekam Medis</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </main>
    </div>
    <script src="../assets/js/script.js"></script>
</body>
</html>
