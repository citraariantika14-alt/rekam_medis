<?php
require_once '../koneksi.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = mysqli_prepare($koneksi, "DELETE FROM dokter WHERE id_dokter = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=hapus");
        exit;
    }
}
header("Location: index.php?status=gagal");
?>
