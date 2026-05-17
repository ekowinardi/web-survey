<?php
session_start();
include "koneksi.php";

// 1. Proteksi Halaman
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guru_bk') {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// 2. Ambil NPSN Guru yang login untuk memfilter siswa
$query_guru = mysqli_query($koneksi, "SELECT npsn, nama_sekolah FROM users WHERE id_user = '$id_user'");
$data_guru = mysqli_fetch_assoc($query_guru);
$npsn_guru = $data_guru['npsn'];
$nama_sekolah = $data_guru['nama_sekolah'];

// 3. Ambil daftar siswa dengan NPSN yang sama
// Menggunakan LEFT JOIN agar siswa yang belum punya nilai tetap muncul di daftar
$query_siswa = "SELECT u.id_user, u.nama, u.kelas, u.nisn, 
                       n.nilai_matematika, n.nilai_binggris, n.id_nilai 
                FROM users u 
                LEFT JOIN nilai_akademik n ON u.id_user = n.id_user 
                WHERE u.npsn = '$npsn_guru' AND u.role = 'siswa'
                ORDER BY u.kelas ASC, u.nama ASC";
$result_siswa = mysqli_query($koneksi, $query_siswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8 glass">
    <title>Input Nilai Siswa | IT-Pathfinder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="style.css"> <style>
        .table-input { width: 80px; text-align: center; }
        .autofill-section { background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e2e8f0; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar shadow-sm">
            <div class="position-sticky pt-3">
                <div class="px-3 mb-4">
                    <h5 class="fw-bold text-white">IT-Pathfinder</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-white opacity-75" href="dashboard_guru.php"><i data-feather="home"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-white active fw-bold" href="#"><i data-feather="edit-3"></i> Input Nilai</a></li>
                    <li class="nav-item"><a class="nav-link text-white opacity-75" href="logout.php"><i data-feather="log-out"></i> Keluar</a></li>
                </ul>
            </div>
        </nav>

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Input Nilai Akademik</h1>
                <span class="badge bg-primary px-3 py-2"><?php echo $nama_sekolah; ?> (NPSN: <?php echo $npsn_guru; ?>)</span>
            </div>

            <div class="autofill-section">
                <div class="row align-items-center">
                    <div class="col-md-auto"><h6 class="mb-0"><strong><i data-feather="zap" class="me-1"></i> Quick Fill:</strong></h6></div>
                    <div class="col-md-2">
                        <input type="number" id="fillMtk" class="form-control form-control-sm" placeholder="Nilai MTK">
                    </div>
                    <div class="col-md-2">
                        <input type="number" id="fillIng" class="form-control form-control-sm" placeholder="Nilai B.Inggris">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-sm btn-dark w-100" onclick="applyAutofill()">Terapkan ke Semua</button>
                    </div>
                    <div class="col-md-4 text-muted small">
                        *Isi angka lalu klik terapkan. Anda tetap bisa mengubah nilai tiap siswa secara manual di tabel.
                    </div>
                </div>
            </div>

            <form action="proses_simpan_nilai.php" method="POST">
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th class="text-center">Matematika</th>
                                    <th class="text-center">B. Inggris</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($result_siswa)): ?>
                                <tr>
                                    <td><strong><?php echo $row['nama']; ?></strong></td>
                                    <td class="text-muted small"><?php echo $row['nisn']; ?></td>
                                    <td><span class="badge bg-light text-dark border"><?php echo $row['kelas']; ?></span></td>
                                    
                                    <td class="text-center">
                                        <input type="number" name="mtk[<?php echo $row['id_user']; ?>]" 
                                               class="form-control form-control-sm mx-auto table-input input-mtk" 
                                               value="<?php echo $row['mtk'] ?? ''; ?>" min="0" max="100" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="inggris[<?php echo $row['id_user']; ?>]" 
                                               class="form-control form-control-sm mx-auto table-input input-inggris" 
                                               value="<?php echo $row['inggris'] ?? ''; ?>" min="0" max="100" required>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row['id_nilai']): ?>
                                            <a href="hapus_nilai.php?id=<?php echo $row['id_nilai']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus nilai siswa ini?')"><i data-feather="trash-2" style="width:14px"></i></a>
                                        <?php else: ?>
                                            <span class="text-muted small">Baru</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white py-3">
                        <button type="submit" name="simpan_massal" class="btn btn-primary px-5">
                            <i data-feather="save" class="me-2"></i> Simpan Semua Nilai
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    feather.replace();

    // Fungsi Autofill ala Excel
    function applyAutofill() {
        const valMtk = document.getElementById('fillMtk').value;
        const valIng = document.getElementById('fillIng').value;

        if(valMtk !== "") {
            document.querySelectorAll('.input-mtk').forEach(input => {
                input.value = valMtk;
            });
        }
        if(valIng !== "") {
            document.querySelectorAll('.input-inggris').forEach(input => {
                input.value = valIng;
            });
        }
    }
</script>
</body>
</html>