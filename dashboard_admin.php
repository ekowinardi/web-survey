<?php
session_start();
// Proteksi halaman: Cek apakah yang login benar-benar admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$nama_admin = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | IT-Pathfinder</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --admin-dark: #0f172a;
            --admin-sidebar: #1e293b;
        }
        body { background-color: #f1f5f9; font-family: 'Inter', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--admin-sidebar); color: white; }
        .nav-link { color: #94a3b8; padding: 12px 20px; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
        .stat-card { border: none; border-radius: 12px; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-3px); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar p-0 shadow">
            <div class="p-4 border-bottom border-secondary mb-3 text-center">
                <h5 class="fw-bold mb-0 text-white">IT-Pathfinder</h5>
                <small class="text-secondary">Administrator System</small>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="#"><i data-feather="grid"></i> Ringkasan</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_soal.php"><i data-feather="help-circle"></i> Kelola Soal & Bobot</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i data-feather="layers"></i> Kelola Data Jurusan</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i data-feather="file-text"></i> Laporan Rekomendasi</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i data-feather="pie-chart"></i> Rekap Per Kelas</a></li>
                <li class="nav-item mt-5"><a class="nav-link text-danger" href="index.html"><i data-feather="log-out"></i> Logout</a></li>
            </ul>
        </nav>

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Dashboard Utama</h2>
                    <p class="text-muted small">Selamat bekerja kembali, <strong><?php echo $nama_admin; ?></strong></p>
                </div>
                <div class="d-flex gap-2 text-end">
                    <span class="badge bg-dark p-2">v1.0 Standard</span>
                </div>
            </div>

            <div class="row mb-5 g-3">
                <div class="col-md-3">
                    <div class="card stat-card bg-primary text-white shadow-sm">
                        <div class="card-body">
                            <h6 class="opacity-75 small">Total Soal</h6>
                            <h3 class="fw-bold">15 Butir</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-success text-white shadow-sm">
                        <div class="card-body">
                            <h6 class="opacity-75 small">Jurusan TI</h6>
                            <h3 class="fw-bold">3 Program</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-warning text-dark shadow-sm">
                        <div class="card-body">
                            <h6 class="opacity-75 small">Total Sekolah</h6>
                            <h3 class="fw-bold">12 Sekolah</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-info text-white shadow-sm">
                        <div class="card-body">
                            <h6 class="opacity-75 small">Siswa Terproses</h6>
                            <h3 class="fw-bold">1.240 Anak</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-primary-subtle p-3 rounded-circle text-primary"><i data-feather="settings"></i></div>
                            <div>
                                <h5 class="fw-bold mb-0">1. Kelola Soal & Bobot</h5>
                                <p class="text-muted small mb-0">Pengaturan 15 pertanyaan minat bakat & nilai bobot.</p>
                            </div>
                        </div>
                        <button class="btn btn-outline-primary w-100 mt-2">Buka Pengaturan Soal</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-success-subtle p-3 rounded-circle text-success"><i data-feather="database"></i></div>
                            <div>
                                <h5 class="fw-bold mb-0">2. Kelola Data Jurusan</h5>
                                <p class="text-muted small mb-0">Manajemen profil jurusan RPL, TKJ, dan DKV.</p>
                            </div>
                        </div>
                        <button class="btn btn-outline-success w-100 mt-2">Update Data Jurusan</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-warning-subtle p-3 rounded-circle text-warning"><i data-feather="archive"></i></div>
                            <div>
                                <h5 class="fw-bold mb-0">3. Laporan Rekomendasi</h5>
                                <p class="text-muted small mb-0">Melihat daftar detail hasil rekomendasi per individu siswa.</p>
                            </div>
                        </div>
                        <button class="btn btn-outline-warning w-100 mt-2">Buka Laporan</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-info-subtle p-3 rounded-circle text-info"><i data-feather="bar-chart"></i></div>
                            <div>
                                <h5 class="fw-bold mb-0">4. Rekap Jurusan Per Kelas</h5>
                                <p class="text-muted small mb-0">Statistik sebaran minat siswa di berbagai sekolah binaan.</p>
                            </div>
                        </div>
                        <button class="btn btn-outline-info w-100 mt-2">Lihat Statistik</button>
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