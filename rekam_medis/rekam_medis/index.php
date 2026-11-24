<?php
require_once '../koneksi.php';

$sql = "SELECT rm.*, p.nama_pasien, p.no_rm, d.nama_dokter, o.nama_obat 
        FROM rekam_medis rm
        JOIN pasien p ON rm.id_pasien = p.id_pasien
        JOIN dokter d ON rm.id_dokter = d.id_dokter
        JOIN obat o ON rm.id_obat = o.id_obat
        ORDER BY rm.id_rekam DESC";
$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis - Aplikasi Rekam Medis</title>
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
            <div style="font-weight: 600; color: #1E3A8A;">Kelola Rekam Medis</div>
        </nav>

        <main class="container">
            <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
                <div class="alert alert-success">✓ Data rekam medis berhasil disimpan/diperbarui.</div>
            <?php elseif (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
                <div class="alert alert-danger">✕ Operasi gagal dilakukan.</div>
            <?php endif; ?>

            <div class="table-container">
                <div class="table-header">
                    <h2>Pemeriksaan Rekam Medis</h2>
                    <a href="tambah.php" class="btn btn-primary">+ Catat Pemeriksaan</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                            <th>Resep</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal_periksa'])); ?></td>
                            <td><?= htmlspecialchars($row['nama_pasien']); ?> (<?= $row['no_rm']; ?>)</td>
                            <td><?= htmlspecialchars($row['nama_dokter']); ?></td>
                            <td><?= htmlspecialchars($row['diagnosa']); ?></td>
                            <td><?= htmlspecialchars($row['resep']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_rekam']; ?>" class="btn btn-primary" style="padding: 4px 8px; font-size: 0.75rem;">Edit</a>
                                <button onclick="konfirmasiHapus('hapus.php?id=<?= $row['id_rekam']; ?>')" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.75rem;">Hapus</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="../assets/js/script.js"></script>
</body>
</html>
