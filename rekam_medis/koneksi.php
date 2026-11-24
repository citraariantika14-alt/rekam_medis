<?php
$host = "localhost";
$user = "citra";
$pass = "smkn3tbn";
$db   = "db_rekam_medis";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>
