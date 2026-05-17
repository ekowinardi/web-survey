<?php
include "koneksi.php";

if (isset($_POST['npsn'])) {
    $npsn = mysqli_real_escape_string($koneksi, $_POST['npsn']);
    $role = $_POST['role'];

    // Cek apakah sudah ada Guru BK dengan NPSN tersebut
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE npsn = '$npsn' AND role = 'guru_bk'");
    
    if (mysqli_num_rows($query) > 0) {
        echo "exists_guru";
    } else {
        echo "available";
    }
}
?>