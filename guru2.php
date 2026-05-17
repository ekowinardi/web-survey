<?php
session_start();
include "koneksi.php";

if (isset($_POST['simpan_massal'])) {
    foreach ($_POST['mtk'] as $id_user => $nilai_mtk) {
        $nilai_ing = $_POST['inggris'][$id_user];
        
        // Cek apakah data sudah ada
        $cek = mysqli_query($koneksi, "SELECT id_nilai FROM nilai_akademik WHERE id_user = '$id_user'");
        
        if (mysqli_num_rows($cek) > 0) {
            // Update
            mysqli_query($koneksi, "UPDATE nilai_akademik SET mtk = '$nilai_mtk', inggris = '$nilai_ing' WHERE id_user = '$id_user'");
        } else {
            // Insert Baru
            mysqli_query($koneksi, "INSERT INTO nilai_akademik (id_user, nilai_matematika, nilai_binggris) VALUES ('$id_user', '$nilai_mtk', '$nilai_ing')");
        }
    }
    
    echo "<script>alert('Semua nilai berhasil diperbarui!'); window.location.href='guru_input_nilai.php';</script>";
}
?>