<?php
session_start();
include "koneksi.php";

if (isset($_POST['simpan_massal'])) {
    foreach ($_POST['mtk'] as $id_user => $nilai_mtk) {
        $nilai_ing = $_POST['inggris'][$id_user];
        
        // Lewati jika kedua nilai kosong agar tidak memenuhi database dengan data kosong
        if($nilai_mtk === "" && $nilai_ing === "") continue;

        $cek = mysqli_query($koneksi, "SELECT id_nilai FROM nilai_akademik WHERE id_user = '$id_user'");
        
        if (mysqli_num_rows($cek) > 0) {
            // Edit / Update data yang sudah ada
            mysqli_query($koneksi, "UPDATE nilai_akademik SET nilai_matematika = '$nilai_mtk', nilai_binggris = '$nilai_ing' WHERE id_user = '$id_user'");
        } else {
            // Input data baru
            mysqli_query($koneksi, "INSERT INTO nilai_akademik (id_user, nilai_matematika, nilai_binggris) VALUES ('$id_user', '$nilai_mtk', '$nilai_ing')");
        }
    }
    // KEMBALI KE HALAMAN INPUT NILAI
    header("Location: guru_input_nilai.php?status=success");
    exit;
}
?>