-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2018 at 11:27 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(7) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_tahun_penilaian_aktif` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `alamat`, `id_tahun_penilaian_aktif`) VALUES
('K001', 'Inara Almahira Yasmin', 'Jl Kemerderkaan No 45 Jakarta Pusat', 'TA002'),
('K002', 'Ghalih pamungkas', 'Jl. Cenderawasih no 21 Yogyakarta', 'TA001');

--
-- Triggers `karyawan`
--
DELIMITER $$
CREATE TRIGGER `before_delete_karyawan` BEFORE DELETE ON `karyawan` FOR EACH ROW BEGIN

DELETE FROM mutasi WHERE mutasi.id_karyawan=OLD.id_karyawan;
DELETE FROM transaksi WHERE transaksi.id_karyawan=OLD.id_karyawan;
  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(7) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL,
  `bobot` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `bobot`) VALUES
('KR001', 'Performance  &amp;  Productivity / Kinerja &amp; Produktifitas', 40),
('KR002', 'Functional Technical Abilities / Kemampuan Fungsi Teknik', 10),
('KR003', 'Professional Ethics / Etika Profesionalisme', 10),
('KR004', 'Commitment / Komitmen', 10),
('KR005', 'Communication Skills / Kemampuan Berkomunikasi', 10),
('KR006', 'Customer Focused &amp; Quality / Kualitas dan Fokus Pelanggan', 10),
('KR007', 'Cost Management / Manajemen Biaya', 10);

--
-- Triggers `kategori`
--
DELIMITER $$
CREATE TRIGGER `after_delete_kategori` AFTER DELETE ON `kategori` FOR EACH ROW DELETE FROM transaksi WHERE id_kategori=OLD.id_kategori
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE `kompetensi` (
  `id_kompetensi` varchar(7) NOT NULL,
  `id_kategori` varchar(20) NOT NULL,
  `nama_kompetensi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`id_kompetensi`, `id_kategori`, `nama_kompetensi`) VALUES
('KO001', 'KR001', 'Menghasilkan kinerja yang diharapkan sesuai dengan harapan kerja (target kerjanya)'),
('KO002', 'KR001', 'Dapat mencapai hasil baik dengan waktu singkat meskipun dengan keterbatasan SDM'),
('KO003', 'KR001', 'Dengan efektifitas diri yang tinggi dan bisa mendorong kinerja organisasi'),
('KO004', 'KR002', 'Memiliki pengetahuan, keahlian dan pengalaman untuk mengerjakan pekerjaan dgn efektif.'),
('KO005', 'KR002', 'Dapat menjalankan fungsi/tugas-tugas/proses-proses dengan baik dan efektif.'),
('KO006', 'KR002', 'Dapat mengerjakan tugas-tugas/pekerjaan secara independen tanpa bantuan.'),
('KO007', 'KR003', 'Memiliki kejujuran dan loyalitas.'),
('KO008', 'KR003', 'Mengerti kode etik perusahaan dan bisa menerapkan etika standar terbaik.'),
('KO009', 'KR003', 'Menempatkan kepentingan perusahaan diatas kepentingan pribadi.'),
('KO010', 'KR004', 'Menunjukkan perilaku positif thd pekerjaan, rekan kerja, atasan dan perusahaan.'),
('KO011', 'KR004', 'Selalu berusaha untuk bekerja keras dan mempunyai rasa memiliki tempat kerjanya.'),
('KO012', 'KR004', 'Menyampaikan yang dijanjikan kepada atasan, klien (internal &amp; eksternal)/lainnya.'),
('KO013', 'KR005', 'Bisa menyampaikan &amp; menjelaskan ide secara jelas, sederhana, fokus dan efisien.'),
('KO014', 'KR005', 'Bisa berbicara dengan efektif.'),
('KO015', 'KR005', 'Membangun kepercayaan dgn membuka komunikasi 2 arah/komunikasi terbuka dgn lainnya.'),
('KO016', 'KR006', 'Melakukan hal yg benar dgn cara yg  benar untuk memenuhi kebutuhan dan harapan klien.'),
('KO017', 'KR006', 'Memahami dan mengidentifikasi siapa pelanggan internal / pelanggan eksternalnya.'),
('KO018', 'KR006', 'Melayani pelanggan dengan pro aktif menanggapi kebutuhan2 dan permintaan2 klien.'),
('KO019', 'KR007', 'Efektifitas perkiraan dan pengaturan anggaran, memonitor dan mengontrol biaya-biaya.'),
('KO020', 'KR007', 'Aktif melaksanakan program 5S dan program KAIZEN');

--
-- Triggers `kompetensi`
--
DELIMITER $$
CREATE TRIGGER `after_update_kompetensi` AFTER UPDATE ON `kompetensi` FOR EACH ROW UPDATE transaksi SET id_kategori=NEW.id_kategori WHERE id_kategori=OLD.id_kategori
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(3) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id` int(5) NOT NULL,
  `id_tahun_penilaian` varchar(10) NOT NULL,
  `id_karyawan` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`id`, `id_tahun_penilaian`, `id_karyawan`) VALUES
(19, 'TA001', 'K001'),
(20, 'TA002', 'K001'),
(21, 'TA001', 'K002');

--
-- Triggers `mutasi`
--
DELIMITER $$
CREATE TRIGGER `after_delete_mutasi` AFTER DELETE ON `mutasi` FOR EACH ROW BEGIN

DELETE FROM transaksi WHERE transaksi.id_karyawan=OLD.id_karyawan AND id_tahun_penilaian=OLD.id_tahun_penilaian;
  
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_mutasi` AFTER INSERT ON `mutasi` FOR EACH ROW INSERT INTO transaksi (id_karyawan,id_kategori,id_kompetensi,id_tahun_penilaian)
SELECT (NEW.id_karyawan),id_kategori,id_kompetensi,(NEW.id_tahun_penilaian) FROM kompetensi
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_mutasi` BEFORE INSERT ON `mutasi` FOR EACH ROW UPDATE karyawan SET id_tahun_penilaian_aktif=NEW.id_tahun_penilaian WHERE id_karyawan=NEW.id_karyawan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` varchar(7) NOT NULL,
  `nilai_rating` varchar(10) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `nilai_rating`, `keterangan`) VALUES
('TA001', '1', 'Not Achieved / Tidak Tercapai'),
('TA002', '2', 'Partially Achieved / Tercapai Sebagian'),
('TA003', '3', 'Achieved / Tercapai'),
('TA004', '4', 'Partially Exceeded / Tercapai Lebih'),
('TA005', '5', 'Consistently Exceeded / Selalu Tercapai Lebih');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_penilaian`
--

CREATE TABLE `tahun_penilaian` (
  `id_tahun_penilaian` varchar(7) NOT NULL,
  `nama_tahun_penilaian` varchar(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_penilaian`
--

INSERT INTO `tahun_penilaian` (`id_tahun_penilaian`, `nama_tahun_penilaian`, `keterangan`) VALUES
('TA001', '2018', '-'),
('TA002', '2019', '-'),
('TA003', '2020', '-');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(5) NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `id_kompetensi` varchar(10) NOT NULL,
  `id_tahun_penilaian` varchar(10) NOT NULL,
  `rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_karyawan`, `id_kategori`, `id_kompetensi`, `id_tahun_penilaian`, `rating`) VALUES
(123, 'K001', 'KR001', 'KO001', 'TA001', ''),
(124, 'K001', 'KR001', 'KO002', 'TA001', ''),
(125, 'K001', 'KR001', 'KO003', 'TA001', ''),
(126, 'K001', 'KR002', 'KO004', 'TA001', ''),
(127, 'K001', 'KR002', 'KO005', 'TA001', ''),
(128, 'K001', 'KR002', 'KO006', 'TA001', ''),
(129, 'K001', 'KR003', 'KO007', 'TA001', ''),
(130, 'K001', 'KR003', 'KO008', 'TA001', ''),
(131, 'K001', 'KR003', 'KO009', 'TA001', ''),
(132, 'K001', 'KR004', 'KO010', 'TA001', ''),
(133, 'K001', 'KR004', 'KO011', 'TA001', ''),
(134, 'K001', 'KR004', 'KO012', 'TA001', ''),
(135, 'K001', 'KR005', 'KO013', 'TA001', ''),
(136, 'K001', 'KR005', 'KO014', 'TA001', ''),
(137, 'K001', 'KR005', 'KO015', 'TA001', ''),
(138, 'K001', 'KR006', 'KO016', 'TA001', ''),
(139, 'K001', 'KR006', 'KO017', 'TA001', ''),
(140, 'K001', 'KR006', 'KO018', 'TA001', ''),
(141, 'K001', 'KR007', 'KO019', 'TA001', ''),
(142, 'K001', 'KR007', 'KO020', 'TA001', ''),
(143, 'K001', 'KR001', 'KO001', 'TA002', ''),
(144, 'K001', 'KR001', 'KO002', 'TA002', ''),
(145, 'K001', 'KR001', 'KO003', 'TA002', ''),
(146, 'K001', 'KR002', 'KO004', 'TA002', ''),
(147, 'K001', 'KR002', 'KO005', 'TA002', ''),
(148, 'K001', 'KR002', 'KO006', 'TA002', ''),
(149, 'K001', 'KR003', 'KO007', 'TA002', ''),
(150, 'K001', 'KR003', 'KO008', 'TA002', ''),
(151, 'K001', 'KR003', 'KO009', 'TA002', ''),
(152, 'K001', 'KR004', 'KO010', 'TA002', ''),
(153, 'K001', 'KR004', 'KO011', 'TA002', ''),
(154, 'K001', 'KR004', 'KO012', 'TA002', ''),
(155, 'K001', 'KR005', 'KO013', 'TA002', ''),
(156, 'K001', 'KR005', 'KO014', 'TA002', ''),
(157, 'K001', 'KR005', 'KO015', 'TA002', ''),
(158, 'K001', 'KR006', 'KO016', 'TA002', ''),
(159, 'K001', 'KR006', 'KO017', 'TA002', ''),
(160, 'K001', 'KR006', 'KO018', 'TA002', ''),
(161, 'K001', 'KR007', 'KO019', 'TA002', '4'),
(162, 'K001', 'KR007', 'KO020', 'TA002', '4'),
(174, 'K002', 'KR001', 'KO001', 'TA001', ''),
(175, 'K002', 'KR001', 'KO002', 'TA001', ''),
(176, 'K002', 'KR001', 'KO003', 'TA001', ''),
(177, 'K002', 'KR002', 'KO004', 'TA001', ''),
(178, 'K002', 'KR002', 'KO005', 'TA001', ''),
(179, 'K002', 'KR002', 'KO006', 'TA001', ''),
(180, 'K002', 'KR003', 'KO007', 'TA001', ''),
(181, 'K002', 'KR003', 'KO008', 'TA001', ''),
(182, 'K002', 'KR003', 'KO009', 'TA001', ''),
(183, 'K002', 'KR004', 'KO010', 'TA001', '3'),
(184, 'K002', 'KR004', 'KO011', 'TA001', ''),
(185, 'K002', 'KR004', 'KO012', 'TA001', ''),
(186, 'K002', 'KR005', 'KO013', 'TA001', '4'),
(187, 'K002', 'KR005', 'KO014', 'TA001', '3'),
(188, 'K002', 'KR005', 'KO015', 'TA001', '2'),
(189, 'K002', 'KR006', 'KO016', 'TA001', '3'),
(190, 'K002', 'KR006', 'KO017', 'TA001', '4'),
(191, 'K002', 'KR006', 'KO018', 'TA001', '5'),
(192, 'K002', 'KR007', 'KO019', 'TA001', '3'),
(193, 'K002', 'KR007', 'KO020', 'TA001', '4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
('US000', 'Administrator', 'admin', '123456', 'admin'),
('US0000', 'User', 'user', '123456', 'user'),
('US001', 'Alvaaro Al Kahfi', 'alvaro', 'alvaro', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`id_kompetensi`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `tahun_penilaian`
--
ALTER TABLE `tahun_penilaian`
  ADD PRIMARY KEY (`id_tahun_penilaian`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
