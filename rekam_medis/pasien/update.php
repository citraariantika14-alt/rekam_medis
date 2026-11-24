<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pasien     = $_POST['id_pasien'];
    $no_rm         = trim($_POST['no_rm']);
    $nama_pasien   = trim($_POST['nama_pasien']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat        = trim($_POST['alamat']);

    $stmt = mysqli_prepare($koneksi, "UPDATE pasien SET no_rm = ?, nama_pasien = ?, jenis_kelamin = ?, tanggal_lahir = ?, alamat = ? WHERE id_pasien = ?");
    mysqli_stmt_bind_param($stmt, "sssssi", $no_rm, $nama_pasien, $jenis_kelamin, $tanggal_lahir, $alamat, $id_pasien);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=update");
    } else {
        header("Location: index.php?status=gagal");
    }
}
?>
