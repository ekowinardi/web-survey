<?php
include "koneksi.php";

if (isset($_POST['login'])) {
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password     = $_POST['password'];
    $npsn         = mysqli_real_escape_string($koneksi, $_POST['npsn']); // Tambahan NPSN
    $nama_sekolah = mysqli_real_escape_string($koneksi, $_POST['nama_sekolah']);
    $role         = $_POST['role'];

    if ($role === 'guru_bk') {
        $nisn_db  = "NULL"; 
        $kelas_db = "NULL";
    } else {
        $val_nisn  = mysqli_real_escape_string($koneksi, $_POST['nisn']);
        $val_kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
        $nisn_db   = "'$val_nisn'"; 
        $kelas_db  = "'$val_kelas'";
    }

    // Hash Password
    $password_aman = password_hash($password, PASSWORD_BCRYPT);

    // Update Query: Tambahkan kolom npsn
    $query = "INSERT INTO users (nama, username, password, npsn, nama_sekolah, role, nisn, kelas) 
              VALUES ('$nama', '$username', '$password_aman', '$npsn', '$nama_sekolah', '$role', $nisn_db, $kelas_db)";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pendaftaran Berhasil!'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>