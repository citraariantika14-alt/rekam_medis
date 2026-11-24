<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_dokter = trim($_POST['nama_dokter']);
    $spesialisasi = trim($_POST['spesialisasi']);

    if (!empty($nama_dokter) && !empty($spesialisasi)) {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO dokter (nama_dokter, spesialisasi) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $nama_dokter, $spesialisasi);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?status=tambah");
            exit;
        }
    }
}
header("Location: index.php?status=gagal");
?>
