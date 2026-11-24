<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pasien       = (int)$_POST['id_pasien'];
    $id_dokter       = (int)$_POST['id_dokter'];
    $id_obat         = (int)$_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan         = trim($_POST['keluhan']);
    $diagnosa        = trim($_POST['diagnosa']);
    $tindakan        = trim($_POST['tindakan']);
    $resep           = trim($_POST['resep']);

    if ($id_pasien && $id_dokter && $id_obat) {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO rekam_medis (id_pasien, id_dokter, id_obat, tanggal_periksa, keluhan, diagnosa, tindakan, resep) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iiisssss", $id_pasien, $id_dokter, $id_obat, $tanggal_periksa, $keluhan, $diagnosa, $tindakan, $resep);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?status=tambah");
            exit;
        }
    }
}
header("Location: index.php?status=gagal");
?>
