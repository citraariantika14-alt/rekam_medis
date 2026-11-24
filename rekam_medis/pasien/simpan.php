<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_rm         = trim($_POST['no_rm']);
    $nama_pasien   = trim($_POST['nama_pasien']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat        = trim($_POST['alamat']);

    if (empty($no_rm) || empty($nama_pasien) || empty($tanggal_lahir)) {
        header("Location: index.php?status=gagal");
        exit;
    }

    $stmt = mysqli_prepare($koneksi, "INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $no_rm, $nama_pasien, $jenis_kelamin, $tanggal_lahir, $alamat);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=tambah");
    } else {
        header("Location: index.php?status=gagal");
    }
}
?>
