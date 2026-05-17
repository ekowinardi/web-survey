<?php
session_start();
include "koneksi.php"; // Pastikan koneksi disertakan

// Cek apakah yang login adalah guru_bk
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guru_bk') {
    header("Location: login.php");
    exit;
}

// Ambil ID User dari session
$id_user = $_SESSION['id_user']; 

// Ambil data terbaru guru dari database (termasuk nama_sekolah)
$query_guru = mysqli_query($koneksi, "SELECT nama, nama_sekolah FROM users WHERE id_user = '$id_user'");
$data_guru = mysqli_fetch_assoc($query_guru);

$nama_guru = $data_guru['nama'];
$nama_sekolah = $data_guru['nama_sekolah']; // Sekarang dinamis sesuai database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru BK | IT-Pathfinder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --sidebar-bg: #1e293b;
        }
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        .sidebar {
            min-height: 100vh; 
    width: 16.666667%; /* Ini setara dengan col-md-2 Bootstrap */
    background: linear-gradient(180deg, #406acd 0%, #1e293b 100%) !important; 
    color: white; 
    padding-top: 20px; 
    border-right: 1px solid rgba(255, 255, 255, 0.05);
    position: fixed; 
    top: 0;
    left: 0;
    z-index: 1000;
        }
        .nav-link { color: rgba(255,255,255,0.7); margin-bottom: 10px; display: flex; align-items: center; gap: 10px; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); border-radius: 8px; }
        .card-feature { border: none; border-radius: 15px; transition: transform 0.2s; cursor: pointer; }
        .card-feature:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .icon-box { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar shadow">
            <div class="position-sticky px-3">
                <h4 class="fw-bold mb-4 px-2">IT-Pathfinder</h4>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="#"><i data-feather="home"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="guru_input_nilai.php"><i data-feather="edit-3"></i> Input Nilai</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i data-feather="file-text"></i> Hasil Kuesioner</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i data-feather="check-circle"></i> Validasi Jurusan</a></li>
                    <li class="nav-item mt-4"><a class="nav-link text-danger" href="index.html"><i data-feather="log-out"></i> Keluar</a></li>
                </ul>
            </div>
        </nav>

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <div>
                    <h1 class="h2 fw-bold">Selamat Datang, <?php echo $nama_guru; ?>!</h1>
                    <p class="text-muted">Guru Pembimbing di <strong><?php echo $nama_sekolah; ?></strong></p>
                </div>
                <div class="badge bg-primary p-2 px-3 rounded-pill">Role: Guru BK</div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-feature shadow-sm p-4">
                        <div class="icon-box bg-primary-subtle text-primary">
                            <i data-feather="book-open"></i>
                        </div>
                        <h5>1. Input Nilai Akademik</h5>
                        <p class="small text-muted">Input nilai Matematika & B. Inggris siswa untuk semester terakhir</p>
                        <a href="guru_input_nilai.php" class="btn btn-primary w-100">Buka Form Input</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-feature shadow-sm p-4">
                        <div class="icon-box bg-success-subtle text-success">
                            <i data-feather="file-text"></i>
                        </div>
                        <h5>2. Hasil Kuesioner Siswa</h5>
                        <p class="small text-muted">Melihat detail jawaban kuesioner minat bakat yang telah diisi siswa</p>
                        <button class="btn btn-outline-success btn-sm w-100">Lihat Laporan</button>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-feature shadow-sm p-4">
                        <div class="icon-box bg-warning-subtle text-warning">
                            <i data-feather="award"></i>
                        </div>
                        <h5>3. Validasi & Hasil Akhir</h5>
                        <p class="small text-muted">Daftar kecocokan siswa pada jurusan RPL, TKJ, atau DKV berdasarkan sistem</p>
                        <button class="btn btn-outline-warning btn-sm w-100">Cek Validasi</button>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 fw-bold text-dark">Daftar Siswa Binaaan (Preview)</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Nilai (Mtk/Ing)</th>
                                        <th>Status Kuesioner</th>
                                        <th>Rekomendasi Utama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Siswa Contoh 1</td>
                                        <td>IX-A</td>
                                        <td><span class="badge bg-secondary">Belum Diisi</span></td>
                                        <td><span class="text-success">Selesai</span></td>
                                        <td><strong>RPL</strong></td>
                                        <td><button class="btn btn-sm btn-light border">Detail</button></td>
                                    </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    feather.replace();
</script>
</body>
</html>