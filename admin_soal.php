<?php
session_start();
include "koneksi.php";

// Proteksi halaman Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Proses Simpan Soal
if (isset($_POST['simpan_soal'])) {
    $teks = mysqli_real_escape_string($koneksi, $_POST['teks_pertanyaan']);
    $kategori = $_POST['kategori'];
    $nama_file = null;

    // Logika Upload Gambar
    if ($_FILES['gambar']['name']) {
        $nama_file = time() . '_' . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/soal/' . $nama_file);
    }

    $query = "INSERT INTO pertanyaan (teks_pertanyaan, kategori, gambar) VALUES ('$teks', '$kategori', '$nama_file')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: admin_soal.php?status=success");
    }
}

// Proses Hapus Soal
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pertanyaan WHERE id_pertanyaan = '$id'");
    header("Location: admin_soal.php?status=deleted");
}

$nama_admin = $_SESSION['nama'];
$result_soal = mysqli_query($koneksi, "SELECT * FROM pertanyaan ORDER BY id_pertanyaan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Soal Kuesioner | Admin IT-Pathfinder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root { --admin-dark: #0f172a; --admin-sidebar: #1e293b; }
        body { background-color: #f1f5f9; font-family: 'Inter', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--admin-sidebar); color: white; position: fixed; width: 240px; }
        .main-content { margin-left: 240px; padding: 30px; }
        .nav-link { color: #94a3b8; padding: 12px 20px; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); border-radius: 8px; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .badge-tkj { background: #3b82f6; }
        .badge-rpl { background: #10b981; }
        .badge-dkv { background: #f59e0b; }
    </style>
</head>
<body>

<div class="container-fluid p-0 d-flex">
    <nav class="sidebar p-3 d-none d-md-block">
        <div class="d-flex align-items-center gap-3 px-3 mb-4">
            <div class="bg-primary p-2 rounded-3 text-white"><i data-feather="terminal"></i></div>
            <h5 class="fw-bold mb-0">IT-Pathfinder</h5>
        </div>
        <div class="nav flex-column">
            <a href="dashboard_admin.php" class="nav-link"><i data-feather="grid"></i> Dashboard</a>
            <a href="admin_soal.php" class="nav-link active"><i data-feather="help-circle"></i> Kelola Soal</a>
            <a href="laporan.php" class="nav-link"><i data-feather="bar-chart-2"></i> Laporan Hasil</a>
            <hr class="my-4 text-secondary">
            <a href="logout.php" class="nav-link text-danger"><i data-feather="log-out"></i> Keluar</a>
        </div>
    </nav>

    <main class="main-content w-100">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark">Kelola Bank Soal</h3>
                <p class="text-muted">Tambahkan soal kuesioner interaktif untuk minat jurusan siswa.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">Halo, <strong><?php echo $nama_admin; ?></strong></span>
                <div class="bg-white p-2 rounded-circle shadow-sm"><i data-feather="user"></i></div>
            </div>
        </header>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-custom p-4 mb-4">
                    <h5 class="fw-bold mb-3">Tambah Soal Baru</h5>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Teks Pertanyaan</label>
                            <textarea name="teks_pertanyaan" class="form-control" rows="3" placeholder="Contoh: Apakah kamu suka merakit komputer?" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Kategori Jurusan</label>
                            <select name="kategori" class="form-select" required>
                                <option value="TKJ">TKJ (Teknik Komputer Jaringan)</option>
                                <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                                <option value="DKV">DKV (Desain Komunikasi Visual)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Gambar Pendukung (Visual Chatbot)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                            <div class="form-text small">Opsional, untuk tampilan interaktif.</div>
                        </div>
                        <button type="submit" name="simpan_soal" class="btn btn-primary w-100 py-2 fw-bold">Simpan Pertanyaan</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card card-custom p-0 overflow-hidden">
                    <div class="card-header bg-white py-3 px-4 border-0">
                        <h6 class="m-0 fw-bold">Daftar Pertanyaan Tersedia</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="small text-uppercase text-muted">
                                    <th class="px-4">Soal</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Visual</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($result_soal)): ?>
                                <tr>
                                    <td class="px-4">
                                        <div class="fw-medium"><?php echo $row['teks_pertanyaan']; ?></div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-<?php echo strtolower($row['kategori']); ?> px-3">
                                            <?php echo $row['kategori']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row['gambar']): ?>
                                            <i data-feather="image" class="text-success"></i>
                                        <?php else: ?>
                                            <i data-feather="minus" class="text-muted"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="?hapus=<?php echo $row['id_soal']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus soal ini?')">
                                            <i data-feather="trash-2" style="width: 16px;"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>feather.replace();</script>
</body>
</html>