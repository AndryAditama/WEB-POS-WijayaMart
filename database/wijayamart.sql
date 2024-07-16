-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2023 pada 06.40
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wijayamart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `no_transaksi`, `idbarang`, `jumlah`, `harga`, `tanggal`) VALUES
(2, '202311020001', 98, 1, 3000, '2023-11-02'),
(3, '202311020001', 100, 1, 15000, '2023-11-02'),
(4, '202311020002', 98, 1, 3000, '2023-11-02'),
(5, '202311020002', 100, 1, 15000, '2023-11-02'),
(6, '202311020003', 98, 1, 3000, '2023-11-02'),
(7, '202311020003', 100, 1, 15000, '2023-11-02'),
(10, '202311020004', 101, 2, 26000, '2023-11-02'),
(11, '202311020004', 98, 4, 12000, '2023-11-02'),
(12, '202311020005', 99, 2, 28000, '2023-11-02'),
(13, '202311020006', 99, 1, 14000, '2023-11-02'),
(14, '202311020007', 99, 1, 14000, '2023-11-02'),
(15, '202311020007', 98, 2, 6000, '2023-11-02'),
(16, '202311020008', 100, 1, 15000, '2023-11-02'),
(17, '202311020009', 99, 1, 14000, '2023-11-02'),
(18, '202311020010', 99, 1, 14000, '2023-11-02'),
(19, '202311020010', 100, 1, 15000, '2023-11-02'),
(20, '202311020011', 99, 1, 14000, '2023-11-02'),
(21, '202311020011', 100, 2, 30000, '2023-11-02'),
(22, '202311020012', 99, 1, 14000, '2023-11-02'),
(23, '202311020012', 100, 1, 15000, '2023-11-02'),
(24, '202311020012', 98, 2, 6000, '2023-11-02'),
(25, '202311020013', 102, 4, 4000, '2023-11-02'),
(26, '202311020013', 99, 2, 28000, '2023-11-02'),
(27, '202311020013', 101, 1, 13000, '2023-11-02'),
(28, '202311020013', 100, 2, 30000, '2023-11-02'),
(29, '202311060001', 101, 1, 13000, '2023-11-06'),
(30, '202311060002', 98, 3, 9000, '2023-11-06'),
(31, '202311070001', 99, 1, 14000, '2023-11-07'),
(32, '202311070002', 101, 1, 13000, '2023-11-07'),
(33, '202311070003', 100, 1, 15000, '2023-11-07'),
(34, '202311070003', 99, 1, 14000, '2023-11-07'),
(35, '202311200001', 99, 1, 14000, '2023-11-20'),
(36, '202311200001', 101, 1, 13000, '2023-11-20'),
(37, '202311200001', 102, 5, 5000, '2023-11-20'),
(38, '202311200002', 98, 1, 3000, '2023-11-20'),
(39, '202311290001', 99, 1, 14000, '2023-11-29'),
(40, '202311290001', 101, 1, 13000, '2023-11-29'),
(41, '202311290002', 99, 1, 14000, '2023-11-29'),
(42, '202311290002', 101, 2, 26000, '2023-11-29'),
(43, '202312040001', 99, 1, 14000, '2023-12-04'),
(44, '202312040001', 100, 2, 30000, '2023-12-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_toko`
--

CREATE TABLE `profil_toko` (
  `id_profil` int(2) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil_toko`
--

INSERT INTO `profil_toko` (`id_profil`, `nama_toko`, `alamat`, `nama_pemilik`, `no_hp`, `email`, `facebook`, `instagram`, `logo`) VALUES
(1, 'Wijaya Mart', 'Jl. Wijaya Kusuma No.121 A Kab. Sampang', 'Nurul Chotimah', '085232088799', 'wijayamart_sampang@gmail.com', 'FB', 'IG', '17012265156566a81328fd4.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `stok`, `harga_beli`, `harga_jual`, `satuan`, `gambar`) VALUES
(98, 'sabun', 104, 2500, 3000, 'pcs', '16982201736538c88d962d5.png'),
(99, 'minyak goreng', 171, 12500, 14000, 'liter', ''),
(100, 'Kopi ABC', 50, 12000, 15000, 'Pcs', ''),
(101, 'Tepung terigu segitiga biru', 116, 12000, 13000, 'kg', ''),
(102, 'coki-coki', 45, 600, 1000, 'pcs', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_baranglaku` int(11) NOT NULL,
  `jumlah_baranglaku` int(11) NOT NULL,
  `harga_baranglaku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `pengeluaran` varchar(500) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `pengeluaran`, `jumlah`, `tanggal`) VALUES
(1, 'restok barang', 200000, '2022-03-24'),
(2, 'kebutuhan toko', 300000, '2022-03-24'),
(3, 'bahan', 100000, '2022-03-24'),
(8, 'bahan pokok', 400000, '2022-03-24'),
(21, 'salam', 500000, '2022-03-24'),
(24, 'kebutuhan pribadi', 50000, '2022-03-17'),
(25, 'kebutuhan pribadi', 5000000, '2022-03-26'),
(26, 'beli beli', 200000, '2022-05-28'),
(27, 'liburan', 200000, '2022-05-28'),
(30, 'Upgrade Toko', 5000000, '2022-03-29'),
(32, 'a', 10000, '2022-05-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id_stok` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `stok_masuk` int(5) NOT NULL,
  `harga_stok` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_stok`
--

INSERT INTO `tb_stok` (`id_stok`, `idbarang`, `stok_masuk`, `harga_stok`, `tanggal_masuk`) VALUES
(16, 100, 3, 36000, '2023-11-07'),
(17, 98, 5, 12500, '2023-11-07'),
(18, 101, 60, 720000, '2023-11-07'),
(19, 100, 20, 240000, '2023-11-07'),
(20, 99, 40, 500000, '2023-11-18'),
(21, 99, 10, 125000, '2023-11-29'),
(22, 101, 10, 120000, '2023-11-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `nomor_transaksi` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `harga_total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`nomor_transaksi`, `tanggal_transaksi`, `harga_total`, `bayar`, `kembalian`, `admin`) VALUES
('202311020001', '2023-11-02', 18000, 20000, 2000, 31),
('202311020002', '2023-11-02', 18000, 20000, 2000, 31),
('202311020003', '2023-11-02', 18000, 20000, 2000, 31),
('202311020004', '2023-11-02', 38000, 50000, 12000, 31),
('202311020005', '2023-11-02', 28000, 30000, 2000, 31),
('202311020006', '2023-11-02', 14000, 20000, 6000, 31),
('202311020007', '2023-11-02', 20000, 50000, 30000, 31),
('202311020008', '2023-11-02', 15000, 20000, 5000, 31),
('202311020009', '2023-11-02', 14000, 15000, 1000, 31),
('202311020010', '2023-11-02', 29000, 50000, 21000, 1),
('202311020011', '2023-11-02', 44000, 50000, 6000, 1),
('202311020012', '2023-11-02', 35000, 35000, 0, 31),
('202311020013', '2023-11-02', 75000, 100000, 25000, 31),
('202311060001', '2023-11-06', 13000, 15000, 2000, 31),
('202311060002', '2023-11-06', 9000, 10000, 1000, 31),
('202311070001', '2023-11-07', 14000, 15000, 1000, 31),
('202311070002', '2023-11-07', 13000, 13000, 0, 31),
('202311070003', '2023-11-07', 29000, 30000, 1000, 31),
('202311200001', '2023-11-20', 32000, 35000, 3000, 1),
('202311200002', '2023-11-20', 3000, 5000, 2000, 1),
('202311290001', '2023-11-29', 27000, 50000, 23000, 31),
('202311290002', '2023-11-29', 40000, 50000, 10000, 31),
('202312040001', '2023-12-04', 44000, 50000, 6000, 31);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin'),
(31, 'Mufawwas', '11', '11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_tr` (`no_transaksi`),
  ADD KEY `barang` (`idbarang`);

--
-- Indeks untuk tabel `profil_toko`
--
ALTER TABLE `profil_toko`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `keranjang` (`id_baranglaku`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `tambah_stok` (`idbarang`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`nomor_transaksi`),
  ADD KEY `admin` (`admin`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `profil_toko`
--
ALTER TABLE `profil_toko`
  MODIFY `id_profil` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `barang` FOREIGN KEY (`idbarang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `no_tr` FOREIGN KEY (`no_transaksi`) REFERENCES `tb_transaksi` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD CONSTRAINT `keranjang` FOREIGN KEY (`id_baranglaku`) REFERENCES `tb_barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `tambah_stok` FOREIGN KEY (`idbarang`) REFERENCES `tb_barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `admin` FOREIGN KEY (`admin`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
