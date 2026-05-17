<?php
include "koneksi.php";

if (isset($_POST['nisn'])) {
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    
    // Cari apakah NISN sudah ada di database
    $query = mysqli_query($koneksi, "SELECT nisn FROM users WHERE nisn = '$nisn' AND nisn IS NOT NULL");
    
    if (mysqli_num_rows($query) > 0) {
        echo "exists"; // Mengirim respon jika sudah ada
    } else {
        echo "available"; // Mengirim respon jika belum ada
    }
}
?>