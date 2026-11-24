<?php
require_once '../koneksi.php';

$sql = "SELECT rm.id_rekam, rm.tanggal_periksa, rm.keluhan, rm.diagnosa, rm.tindakan, rm.resep,
               p.nama_pasien, p.no_rm,
               d.nama_dokter, d.spesialisasi,
               o.nama_obat, o.satuan
        FROM rekam_medis rm
        INNER JOIN pasien p ON rm.id_pasien = p.id_pasien
        INNER JOIN dokter d ON rm.id_dokter = d.id_dokter
        INNER JOIN obat o ON rm.id_obat = o.id_obat
        ORDER BY rm.tanggal_periksa DESC, rm.id_rekam DESC";

$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemeriksaan - Rekam Medis</title>
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
            <li><a href="../rekam_medis/index.php">Rekam Medis</a></li>
            <li><a href="index.php" class="active">Riwayat Pemeriksaan</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav class="navbar">
            <button class="toggle-btn" id="toggleBtn">☰</button>
            <div style="font-weight: 600; color: #1E3A8A;">Laporan Riwayat Pemeriksaan Pasien</div>
        </nav>

        <main class="container">
            <h2>Riwayat Pemeriksaan (SQL JOIN)</h2>

            <div class="table-container">
                <div class="table-header">
                    <h2>Semua Riwayat Medis</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Nama Obat</th>
                            <th>Tgl Periksa</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Resep</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($query) > 0): ?>
                            <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><strong><?= htmlspecialchars($row['nama_pasien']); ?></strong><br><small><?= $row['no_rm']; ?></small></td>
                                <td><?= htmlspecialchars($row['nama_dokter']); ?><br><small><?= htmlspecialchars($row['spesialisasi']); ?></small></td>
                                <td><?= htmlspecialchars($row['nama_obat']); ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_periksa'])); ?></td>
                                <td><?= htmlspecialchars($row['keluhan']); ?></td>
                                <td><?= htmlspecialchars($row['diagnosa']); ?></td>
                                <td><?= htmlspecialchars($row['tindakan']); ?></td>
                                <td><?= htmlspecialchars($row['resep']); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" style="text-align: center; color: #64748B;">Belum ada riwayat rekam medis.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="../assets/js/script.js"></script>
</body>
</html>
