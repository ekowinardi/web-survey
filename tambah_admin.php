<?php
include 'koneksi.php';

$nama_baru     = "Pak Sholeh";
$username_baru = "sholeh";
$password_asli = "sholeh"; // Password yang nanti diketik di form login

// Baris ini yang paling penting! PHP akan membuat hash yang pas untuk sistemmu
$password_hash = password_hash($password_asli, PASSWORD_BCRYPT);

$query = "INSERT INTO users (nama, username, password, role) 
          VALUES ('$nama_baru', '$username_baru', '$password_hash', 'admin')";

if (mysqli_query($koneksi, $query)) {
    echo "Admin Sholeh berhasil ditambahkan! Silakan login dengan password: " . $password_asli;
} else {
    echo "Gagal menambah admin: " . mysqli_error($koneksi);
}
?>