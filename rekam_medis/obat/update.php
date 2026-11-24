<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_obat   = $_POST['id_obat'];
    $nama_obat = trim($_POST['nama_obat']);
    $satuan    = trim($_POST['satuan']);
    $stok      = (int)$_POST['stok'];

    $stmt = mysqli_prepare($koneksi, "UPDATE obat SET nama_obat = ?, satuan = ?, stok = ? WHERE id_obat = ?");
    mysqli_stmt_bind_param($stmt, "ssii", $nama_obat, $satuan, $stok, $id_obat);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=update");
        exit;
    }
}
header("Location: index.php?status=gagal");
?>
