<?php
require_once 'koneksi.php';

$q_pasien = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pasien");
$total_pasien = mysqli_fetch_assoc($q_pasien)['total'];

$q_dokter = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM dokter");
$total_dokter = mysqli_fetch_assoc($q_dokter)['total'];

$q_obat = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM obat");
$total_obat = mysqli_fetch_assoc($q_obat)['total'];

$q_rekam = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM rekam_medis");
$total_rekam = mysqli_fetch_assoc($q_rekam)['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Rekam Medis</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            🏥 Rekam Medis
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <div class="menu-category">Data Master</div>
            <li><a href="pasien/index.php">Pasien</a></li>
            <li><a href="dokter/index.php">Dokter</a></li>
            <li><a href="obat/index.php">Obat</a></li>
            <div class="menu-category">Pelayanan</div>
            <li><a href="rekam_medis/index.php">Rekam Medis</a></li>
            <li><a href="riwayat/index.php">Riwayat Pemeriksaan</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav class="navbar">
            <button class="toggle-btn" id="toggleBtn">☰</button>
            <div style="font-weight: 600; color: #1E3A8A;">Sistem Informasi Rekam Medis</div>
        </nav>

        <main class="container">
            <h2>Dashboard</h2>
            
            <div class="card-grid">
                <div class="card">
                    <div class="card-icon">👤</div>
                    <div class="card-info">
                        <h3>Total Pasien</h3>
                        <p><?= $total_pasien; ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">👨‍⚕️</div>
                    <div class="card-info">
                        <h3>Total Dokter</h3>
                        <p><?= $total_dokter; ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">💊</div>
                    <div class="card-info">
                        <h3>Total Obat</h3>
                        <p><?= $total_obat; ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">📋</div>
                    <div class="card-info">
                        <h3>Rekam Medis</h3>
                        <p><?= $total_rekam; ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
