<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_rekam        = (int)$_POST['id_rekam'];
    $id_pasien       = (int)$_POST['id_pasien'];
    $id_dokter       = (int)$_POST['id_dokter'];
    $id_obat         = (int)$_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan         = trim($_POST['keluhan']);
    $diagnosa        = trim($_POST['diagnosa']);
    $tindakan        = trim($_POST['tindakan']);
    $resep           = trim($_POST['resep']);

    $stmt = mysqli_prepare($koneksi, "UPDATE rekam_medis SET id_pasien = ?, id_dokter = ?, id_obat = ?, tanggal_periksa = ?, keluhan = ?, diagnosa = ?, tindakan = ?, resep = ? WHERE id_rekam = ?");
    mysqli_stmt_bind_param($stmt, "iiisssssi", $id_pasien, $id_dokter, $id_obat, $tanggal_periksa, $keluhan, $diagnosa, $tindakan, $resep, $id_rekam);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=update");
        exit;
    }
}
header("Location: index.php?status=gagal");
?>
