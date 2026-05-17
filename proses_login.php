<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Hubungkan ke database (pastikan nama file koneksi Anda benar)
include 'koneksi.php'; 

$recaptcha_secret = "6LfjhuEsAAAAAM5eWQtBcGKhgZcPtk-OqKaWp610";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Cari user berdasarkan username
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $data = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) > 0) {
        // Validasi password menggunakan password_verify karena kita menggunakan hashing
        if (password_verify($password, $data['password'])) {
            
            // Set session untuk menyimpan identitas login
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $data['role'];

            // Arahkan ke lembar kerja (dashboard) sesuai role
            if ($data['role'] == 'admin') {
                header("Location: dashboard_admin.php");
            } elseif ($data['role'] == 'guru_bk') {
                header("Location: dashboard_guru.php");
            } elseif ($data['role'] == 'siswa') {
                header("Location: dashboard_siswa.php");
            }
            exit;
            
        } else {
            // Password salah
            echo "<script>alert('Username atau Password salah!'); window.location='login.php';</script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Akun tidak ditemukan!'); window.location='login.php';</script>";
    }
}
?>