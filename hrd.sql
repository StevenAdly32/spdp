-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2020 pada 19.47
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(6) NOT NULL,
  `departemen` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_id` int(10) NOT NULL,
  `tgl_waktu` datetime NOT NULL,
  `status` varchar(15) NOT NULL,
  `lokasi_finger` int(1) NOT NULL,
  `no_pin` int(10) NOT NULL,
  `kode_verifikasi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `kd_cuti` int(3) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `tanggal_cuti` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jumlah_cuti` int(2) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Approved','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`kd_cuti`, `nip`, `tanggal_cuti`, `tanggal_selesai`, `jumlah_cuti`, `keterangan`, `status`) VALUES
(1, '32669954', '2015-12-20', '2015-12-31', 1, 'Umroh', 'Rejected');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_dep` varchar(10) NOT NULL,
  `departemen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(10) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bagian` varchar(50) NOT NULL,
  `k1_join` date NOT NULL,
  `k1_finish` varchar(50) NOT NULL,
  `k2_join` date NOT NULL,
  `k2_finish` date NOT NULL,
  `status` enum('Berkas Pekara','P-17','P-19','P-20','P-21','Tahap II','Pelimpahan','Sikap Putusan') NOT NULL,
  `jpu` enum('MUHAMMAD ALI AKHBAR, S.H, M.H','SYAHRIL, SH, MH','MIFTAHUDDIN, SH','DARMAWAN HAMZAH SIREGAR, SH','FAKHRILLAH, SH, MH','Dr. FERRY ICHSAN KARUNIA, SH, MH','MARZA, SH','AL MUHAJIR, SH','MUHAMMAD DONI SIDIK, SH') NOT NULL,
  `jpuu` enum('MUHAMMAD ALI AKHBAR, S.H, M.H','SYAHRIL, SH, MH','MIFTAHUDDIN, SH','DARMAWAN HAMZAH SIREGAR, SH','FAKHRILLAH, SH, MH','Dr. FERRY ICHSAN KARUNIA, SH, MH','MARZA, SH','AL MUHAJIR, SH','MUHAMMAD DONI SIDIK, SH') NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama`, `bagian`, `k1_join`, `k1_finish`, `k2_join`, `k2_finish`, `status`, `jpu`, `jpuu`, `gambar`) VALUES
('Polres Lhokseumawe', 'X', '12345', '2020-07-01', '362', '2020-07-02', '2020-07-20', 'P-17', 'SYAHRIL, SH, MH', 'MIFTAHUDDIN, SH', 'foto_member/logosaga.jpg'),
('Testing', 'Testing', '123', '2020-07-10', 'Testing', '2020-07-10', '2020-07-30', 'Pelimpahan', 'DARMAWAN HAMZAH SIREGAR, SH', 'Dr. FERRY ICHSAN KARUNIA, SH, MH', 'foto_member/logosaga.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembur`
--

CREATE TABLE `lembur` (
  `kd_lembur` int(10) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `tanggal_lembur` date NOT NULL,
  `jam_lembur` int(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `level` varchar(30) NOT NULL,
  `gambar` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fullname`, `no_hp`, `level`, `gambar`) VALUES
(4, 'admin', 'admin', 'admin', '0822788990', 'admin', 'gambar_admin/logosaga-.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`kd_cuti`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`kd_lembur`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cuti`
--
ALTER TABLE `cuti`
  MODIFY `kd_cuti` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `lembur`
--
ALTER TABLE `lembur`
  MODIFY `kd_lembur` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
