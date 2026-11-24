<?php
   $k = mysqli_connect("localhost", "citra", "smkn3tbn", "db_rekam_medis");
   echo $k ? "KONEKSI OK" : "GAGAL: " . mysqli_connect_error();