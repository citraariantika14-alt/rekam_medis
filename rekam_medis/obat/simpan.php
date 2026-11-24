<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_obat = trim($_POST['nama_obat']);
    $satuan    = trim($_POST['satuan']);
    $stok      = (int)$_POST['stok'];

    if (!empty($nama_obat) && !empty($satuan)) {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO obat (nama_obat, satuan, stok) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssi", $nama_obat, $satuan, $stok);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?status=tambah");
            exit;
        }
    }
}
header("Location: index.php?status=gagal");
?>
