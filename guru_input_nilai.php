<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guru_bk') {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data guru untuk NPSN dan Nama Sekolah
$query_guru = mysqli_query($koneksi, "SELECT npsn, nama_sekolah FROM users WHERE id_user = '$id_user'");
$data_guru = mysqli_fetch_assoc($query_guru);
$npsn_guru = $data_guru['npsn'];
$nama_sekolah = $data_guru['nama_sekolah'];

// Query Siswa + Nilai (jika ada)
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
    <meta charset="UTF-8">
    <title>Input Nilai | IT-Pathfinder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        /* Menentukan lebar maksimal untuk input di dalam tabel */
.table-input {
    max-width: 80px; /* Lebar yang ideal untuk input angka */
    text-align: center;
    margin: 0 auto;
}

/* Memberikan warna selang-seling pada baris tabel */
.table-hover tbody tr:nth-of-type(odd) {
    background-color: rgba(37, 99, 235, 0.02);
}

/* Warna khusus untuk header tabel */
.table-primary-custom {
    background-color: #2563eb !important;
    color: white !important;
}




/* Fokus warna saat input diklik */
.table-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
}

/* Warna khusus untuk header tabel */
.table-primary-custom th {
    background-color: #eb8125 !important;
    color: white !important;
    border-bottom: none;
    vertical-align: middle; /* Menjaga teks header tetap di tengah secara vertikal */
    white-space: nowrap;    /* Mencegah teks header tertekuk ke bawah */
}

/* Warna selang-seling baris (zebra) */
.table-striped tbody tr:nth-of-type(odd) {
    --bs-table-accent-bg: rgba(37, 99, 235, 0.05) !important;
    color: var(--bs-table-striped-color);
}

/* Garis tipis antar baris agar lebih rapi */
.table td {
    border-color: #f1f5f9;
}
/* Menghilangkan panah spinner pada input number agar lebih bersih */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Memastikan teks NISN tidak terlalu dominan */
td.text-muted {
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar shadow">
            <div class="position-sticky px-3">
                <h4 class="fw-bold mb-4 px-2">IT-Pathfinder</h4>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="dashboard_guru.php"><i data-feather="home"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="guru_input_nilai.php"><i data-feather="edit-3"></i>Input Nilai</a></li>
                    
                    <li class="nav-item mt-4"><a class="nav-link text-danger" href="index.html"><i data-feather="log-out"></i>Keluar</a></li>
                </ul>
            </div>
        </nav>

            <main class="col-md-10 ms-sm-auto px-md-4 main-content">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Input Nilai Akademik</h1>
                    <p class="text-muted"><?php echo $nama_sekolah; ?> (NPSN: <?php echo $npsn_guru; ?>)</p>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body bg-light">
                        <div class="row align-items-center">
                            <div class="col-md-auto"><small class="fw-bold">Nilai KKM:</small></div>
                            <div class="col-md-2"><input type="number" id="fillMtk" class="form-control form-control-sm" placeholder="MTK"></div>
                            <div class="col-md-2"><input type="number" id="fillIng" class="form-control form-control-sm" placeholder="B.Inggris"></div>
                            <div class="col-md-2"><button type="button" class="btn btn-sm btn-success w-100" onclick="applyAutofill()">Terapkan</button></div>
                        </div>
                    </div>
                </div>

      

                <form action="proses_simpan_nilai.php" method="POST">
                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0">
    <thead class="table-primary-custom">
        <tr>
            <th class="text-center" width="50px">No.</th>
            <th>Nama Siswa</th>
            <th class="text-center" width="150px">NISN</th> 
            <th class="text-center" width="100px">Kelas</th>
            <th class="text-center" width="100px">MTK</th>
            <th class="text-center" width="100px">B. Inggris</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1; 
        while ($s = mysqli_fetch_assoc($result_siswa)): ?>
            <tr>
                <td class="text-center fw-bold text-muted"><?php echo $no++; ?></td>
                <td><div class="fw-bold"><?php echo $s['nama']; ?></div></td>
                <td class="text-center"><div class="small text-muted"><?php echo $s['nisn']; ?></div></td>
                <td class="text-center"><?php echo $s['kelas']; ?></td>
                <td class="text-center">
                    <input type="number" name="mtk[<?php echo $s['id_user']; ?>]" class="form-control form-control-sm mx-auto table-input in-mtk" value="<?php echo $s['nilai_matematika']; ?>">
                </td>
                <td class="text-center">
                    <input type="number" name="inggris[<?php echo $s['id_user']; ?>]" class="form-control form-control-sm mx-auto table-input in-ing" value="<?php echo $s['nilai_binggris']; ?>">
                </td>
                <td class="text-center">
                    <?php echo ($s['id_nilai']) ? '<span class="badge bg-success">Terisi</span>' : '<span class="badge bg-warning text-dark">Kosong</span>'; ?>
                </td>
                <td class="text-center">
                    <?php if ($s['id_nilai']): ?>
                        <a href="hapus_nilai.php?id=<?php echo $s['id_nilai']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus nilai siswa ini?')"><i data-feather="trash-2" style="width:14px"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <button type="submit" name="simpan_massal" class="btn btn-primary px-4"><i data-feather="save" class="me-2"></i>Simpan Semua Perubahan</button>
                        </div>

                      
<?php
// Ambil data nilai yang sudah tersimpan untuk ditampilkan di ringkasan
$query_ringkasan = "SELECT u.nama, u.nisn, u.kelas, n.nilai_matematika, n.nilai_binggris 
                    FROM nilai_akademik n
                    JOIN users u ON n.id_user = u.id_user
                    WHERE u.npsn = '$npsn_guru'
                    ORDER BY n.id_nilai DESC LIMIT 10"; // Menampilkan 10 data terbaru
$result_ringkasan = mysqli_query($koneksi, $query_ringkasan); ?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i data-feather="check-circle" class="me-2"></i>
            <div>
                <strong>Berhasil!</strong> Data nilai siswa telah diperbarui di sistem.
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-left: 5px solid #198754 !important;">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-success"><i data-feather="list" class="me-2"></i>Ringkasan Nilai Terakhir Disimpan</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-bordered mb-0">
                <thead class="bg-light">
                    <tr class="small text-uppercase text-muted">
                        <th class="text-center" width="80px">No.</th>
                        <th class="px-3">Siswa</th>
                        <th class="text-center">NISN</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center" width="300">MTK</th>
                        <th class="text-center" width="300">B.ING</th>
                    </tr>
                </thead>
                <tbody>
                     
                    <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result_ringkasan)): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?php echo $no++; ?></td>
                            <td class="px-3 fw-bold"><?php echo $row['nama']; ?></td>
                            <td class="text-center small"><?php echo $row['nisn']; ?></td>
                            <td class="text-center"><?php echo $row['kelas']; ?></td>
                            <td class="text-center text-primary fw-bold"><?php echo $row['nilai_matematika']; ?></td>
                            <td class="text-center text-primary fw-bold"><?php echo $row['nilai_binggris']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

                    </div>
                </form>
            </main>
        </div>
    </div>

    <script>
        feather.replace();

        function applyAutofill() {
            const m = document.getElementById('fillMtk').value;
            const i = document.getElementById('fillIng').value;
            if (m) document.querySelectorAll('.in-mtk').forEach(el => el.value = m);
            if (i) document.querySelectorAll('.in-ing').forEach(el => el.value = i);
        }

        // Script agar notifikasi hilang otomatis setelah 3 detik
setTimeout(function() {
    let alert = document.querySelector(".alert");
    if (alert) {
        let bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    }
}, 3000); // 3000 milidetik = 3 detik
    </script>
</body>

</html>