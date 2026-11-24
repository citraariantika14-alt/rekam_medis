<?php
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_dokter = $_POST['id_dokter'];
    $nama_dokter = trim($_POST['nama_dokter']);
    $spesialisasi = trim($_POST['spesialisasi']);

    $stmt = mysqli_prepare($koneksi, "UPDATE dokter SET nama_dokter = ?, spesialisasi = ? WHERE id_dokter = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $nama_dokter, $spesialisasi, $id_dokter);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=update");
        exit;
    }
}
header("Location: index.php?status=gagal");
?>
