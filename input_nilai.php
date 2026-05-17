<?php
// Koneksi ke database
include 'koneksi.php'; 

// Ambil daftar siswa dari tabel user untuk dropdown
$query_siswa = mysqli_query($koneksi, "SELECT id_user, nama FROM users WHERE role = 'siswa'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Akademik | Guru BK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-primary { border-radius: 10px; padding: 10px 20px; font-weight: 600; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Input Nilai Akademik</h3>
                    <p class="text-muted">Masukkan nilai untuk kalkulasi rekomendasi jurusan</p>
                </div>

                <form action="proses_input_nilai.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Pilih Siswa</label>
                        <select name="id_user" class="form-select" required>
                            <option value="">-- Pilih Nama Siswa --</option>
                            <?php while($row = mysqli_fetch_array($query_siswa)) { ?>
                                <option value="<?php echo $row['id_user']; ?>">
                                    <?php echo $row['nama']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Nilai Matematika</label>
                        <input type="number" name="nilai_matematika" class="form-control" placeholder="0-100" min="0" max="100" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Nilai Bahasa Inggris</label>
                        <input type="number" name="nilai_binggris" class="form-control" placeholder="0-100" min="0" max="100" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan Nilai & Proses</button>
                        <a href="dashboard_guru.php" class="btn btn-link text-muted mt-2">Kembali ke Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>