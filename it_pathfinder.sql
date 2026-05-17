-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2026 pada 18.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_pathfinder`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_rekomendasi`
--

CREATE TABLE `hasil_rekomendasi` (
  `id_hasil` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `skor_akhir_rpl` float DEFAULT NULL,
  `skor_akhir_tkj` float DEFAULT NULL,
  `skor_akhir_dkv` float DEFAULT NULL,
  `rekomendasi_utama` enum('RPL','TKJ','DKV') DEFAULT NULL,
  `tanggal_hasil` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_pertanyaan` int(11) DEFAULT NULL,
  `jawaban_pilihan` enum('Sangat Suka','Suka','Tidak Suka') NOT NULL,
  `skor_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_akademik`
--

CREATE TABLE `nilai_akademik` (
  `id_nilai` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nilai_matematika` int(11) DEFAULT NULL,
  `nilai_binggris` int(11) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_akademik`
--

INSERT INTO `nilai_akademik` (`id_nilai`, `id_user`, `nilai_matematika`, `nilai_binggris`, `semester`) VALUES
(1, 19, 70, 70, NULL),
(2, 20, 70, 70, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `teks_pertanyaan` text NOT NULL,
  `kategori` enum('RPL','TKJ','DKV') NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `bobot` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `npsn` varchar(10) DEFAULT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `role` enum('siswa','guru_bk','admin') NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `npsn`, `nama_sekolah`, `role`, `nisn`, `kelas`, `created_at`) VALUES
(4, 'Bu Diva', 'diva', '$2y$10$FJiZ94W5Ff1/K2Ky258dKuqqdOE24K3DeIEOmRvG9OiiVpwsWImom', NULL, NULL, 'admin', NULL, NULL, '2026-05-15 23:15:05'),
(5, 'Bu Sri', 'sri', '$2y$10$wGB8iaoLc7sxI7QqyK3g4uxSWFFUZaHTLW.QZIxBaLj7TWcZ.OwrO', '20554879', 'SMP Matholiul Anwar', 'guru_bk', NULL, NULL, '2026-05-09 23:36:20'),
(6, 'Intan Nuraini', 'intan', '$2y$10$pilhx2GLfNQ8F1lsYYSZceijwMfv2bahy5Sl.x.hfG61pkIN8ajv6', '20554879', 'SMP Matholiul Anwar', 'siswa', '2026.26', 'VII', '2026-05-09 23:38:47'),
(7, 'Danny Ismaya', 'dani', '$2y$10$voH4Nz1ypirKlPHcFX5Izu6viv7qdRnHWqfIrkO5Q4jJ8/nMNIoba', '20554879', 'SMP Matholiul Anwar', 'siswa', '2026.01', '9A', '2026-05-10 06:03:51'),
(19, 'Ayu Anita', 'ayu', '$2y$10$lsIeXex1yael7B5I0a6t1eagXik3.OcmlO.BWErT4gM9UAv0UqB9a', '20554879', 'SMP Matholiul Anwar', 'siswa', '1234567893', 'IX', '2026-05-11 14:15:46'),
(20, 'Siti Anisa', 'ica', '$2y$10$o74QKRoXukodEExWH.VAuew2E0rce0OFlwgRI8.5TXNsbKU49oucO', '20554879', 'SMP Matholiul Anwar', 'siswa', '1234567894', 'IX', '2026-05-11 14:43:54'),
(23, 'Pak Eko', 'eko', '$2y$10$kaxJ4I.fXCppusJY6Zej5udP2AZXeJSjhQTWysvAdwC3GuVWMo0zq', NULL, NULL, 'admin', NULL, NULL, '2026-05-15 23:35:16'),
(24, 'Pak Sholeh', 'sholeh', '$2y$10$MnXzuBWY/LyqTyJpwIagiOTtbvxe/8S.ub3EAk0gSneV5USOwGx2a', NULL, NULL, 'admin', NULL, NULL, '2026-05-15 23:36:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil_rekomendasi`
--
ALTER TABLE `hasil_rekomendasi`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indeks untuk tabel `nilai_akademik`
--
ALTER TABLE `nilai_akademik`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `npsn` (`npsn`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil_rekomendasi`
--
ALTER TABLE `hasil_rekomendasi`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_akademik`
--
ALTER TABLE `nilai_akademik`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_rekomendasi`
--
ALTER TABLE `hasil_rekomendasi`
  ADD CONSTRAINT `hasil_rekomendasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_akademik`
--
ALTER TABLE `nilai_akademik`
  ADD CONSTRAINT `nilai_akademik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
