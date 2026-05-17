<?php
session_start();
// Proteksi halaman: Cek apakah yang login benar-benar siswa
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'siswa') {
    header("Location: login.php");
    exit;
}

// Mengambil nama siswa dari session yang diset di proses_login.php
$nama_siswa = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | IT-Pathfinder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .hero-student {
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }
        .card-menu {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card-menu:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .icon-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .btn-start {
            border-radius: 12px;
            padding: 10px 25px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">IT-PATHFINDER</a>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i data-feather="user" class="me-1"></i> <?php echo $nama_siswa; ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item text-danger" href="index.html"><i data-feather="log-out" class="me-2"></i>Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="hero-student">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-2">Halo, <?php echo $nama_siswa; ?>! 👋</h1>
                <p class="lead opacity-75">Sudah siap menemukan masa depanmu di dunia Teknologi Informasi?</p>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <i data-feather="compass" style="width: 100px; height: 100px; opacity: 0.5;"></i>
            </div>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-5">
            <div class="card card-menu h-100 shadow-sm p-4 text-center">
                <div class="icon-circle bg-primary-subtle text-primary">
                    <i data-feather="edit-2" style="width: 32px; height: 32px;"></i>
                </div>
                <h3 class="fw-bold">Isi Kuesioner</h3>
                <p class="text-muted">Jawab beberapa pertanyaan seru tentang hobi dan minatmu untuk melihat potensi dirimu.</p>
                <div class="mt-auto">
                    <a href="kuesioner.php" class="btn btn-primary btn-start w-100 shadow-sm">Mulai Tes Sekarang</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card card-menu h-100 shadow-sm p-4 text-center">
                <div class="icon-circle bg-success-subtle text-success">
                    <i data-feather="bar-chart-2" style="width: 32px; height: 32px;"></i>
                </div>
                <h3 class="fw-bold">Hasil Rekomendasi</h3>
                <p class="text-muted">Lihat hasil analisis jurusan SMK (RPL, TKJ, atau DKV) yang paling cocok buat kamu.</p>
                <div class="mt-auto">
                    <a href="hasil.php" class="btn btn-success btn-start w-100 shadow-sm">Lihat Hasil Saya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 text-muted small">
        <p>&copy; 2026 IT-Pathfinder - Temukan Jalur Karir IT-mu</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    feather.replace(); // Mengaktifkan icon feather
</script>
</body>
</html>