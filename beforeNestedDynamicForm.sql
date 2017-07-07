-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2017 at 03:25 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lims`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis_request`
--

CREATE TABLE `analysis_request` (
  `id` int(11) NOT NULL,
  `lpsb_order_no` varchar(100) NOT NULL,
  `id_kategori_klien` int(11) NOT NULL,
  `status_pengujian` enum('biasa','percepatan') NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `dp` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `analysis_request`
--

INSERT INTO `analysis_request` (`id`, `lpsb_order_no`, `id_kategori_klien`, `status_pengujian`, `tanggal_diterima`, `tanggal_selesai`, `total_biaya`, `dp`, `sisa`, `keterangan`) VALUES
(23, 'LPSB/AR/1', 2, 'percepatan', '2017-07-06', '2017-07-21', 1000000, 200000, 800000, 'Keterangan');

-- --------------------------------------------------------

--
-- Stand-in structure for view `analysis_request_data`
-- (See below for the actual view)
--
CREATE TABLE `analysis_request_data` (
`id` int(11)
,`lpsb_order_no` varchar(100)
,`kategori` varchar(100)
,`nama_sampel` varchar(100)
,`jenis` varchar(100)
,`kemasan` varchar(100)
,`jumlah` varchar(100)
,`jenis_metode_analisis` varchar(100)
,`status_pengujian` enum('biasa','percepatan')
,`tanggal_diterima` date
,`tanggal_selesai` date
,`total_biaya` int(11)
,`dp` int(11)
,`sisa` int(11)
,`keterangan` text
);

-- --------------------------------------------------------

--
-- Table structure for table `chem_storage`
--

CREATE TABLE `chem_storage` (
  `id` int(11) NOT NULL,
  `pemilik` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chem_storage`
--

INSERT INTO `chem_storage` (`id`, `pemilik`, `tanggal_masuk`) VALUES
(3, 'BARU1', '2017-04-16'),
(4, 'pemilik1', '2017-04-18'),
(5, 'fghjk', '2017-05-21'),
(6, 'asd', '2017-05-21'),
(7, 'asd', '2017-05-21'),
(8, 'asd', '2017-05-21'),
(9, 'asd', '2017-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `id_fakultas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `nama_departemen`, `id_fakultas`) VALUES
(1, 'MANAJEMEN SUMBERDAYA LAHAN', 1),
(2, 'AGRONOMI DAN HORTIKULTURA', 1),
(3, 'PROTEKSI TANAMAN', 1),
(4, 'ARSITEKTUR LANSKAP', 1),
(5, 'KEDOKTERAN HEWAN', 2),
(6, 'TEKNOLOGI & MANAJEMEN PERIKANAN BUDIDAYA', 3),
(7, 'MANAJEMEN SUMBERDAYA PERAIRAN', 3),
(8, 'TEKNOLOGI HASIL PERAIRAN', 3),
(9, 'TEKNOLOGI & MANAJEMEN PERIKANAN TANGKAP', 3),
(10, 'ILMU DAN TEKNOLOGI KELAUTAN', 3),
(11, 'TEKNOLOGI PRODUKSI TERNAK', 4),
(12, 'NUTRISI DAN TEKNOLOGI PAKAN', 4),
(13, 'TEKNOLOGI HASIL TERNAK', 4),
(14, 'MANAJEMEN HUTAN', 5),
(15, 'TEKNOLOGI HASIL HUTAN', 5),
(16, 'KONSERVASI SUMBERDAYA HUTAN & EKOWISATA', 5),
(17, 'SILVIKULTUR', 5),
(18, 'TEKNIK MESIN DAN BIOSISTEM', 6),
(19, 'TEKNOLOGI PANGAN', 6),
(20, 'TEKNOLOGI INDUSTRI PERTANIAN', 6),
(21, 'TEKNIK SIPIL DAN LINGKUNGAN', 6),
(22, 'STATISTIKA', 7),
(23, 'METEOROLOGI TERAPAN', 7),
(24, 'BIOLOGI', 7),
(25, 'KIMIA', 7),
(26, 'MATEMATIKA', 7),
(27, 'ILMU KOMPUTER', 7),
(28, 'FISIKA', 7),
(29, 'BIOKIMIA', 7),
(30, 'AKTUARIA', 7),
(31, 'EKONOMI DAN STUDI PEMBANGUNAN', 8),
(32, 'MANAJEMEN', 8),
(33, 'AGRIBISNIS', 8),
(34, 'EKONOMI SUMBERDAYA DAN LINGKUNGAN', 8),
(35, 'EKONOMI SYARIAH', 8),
(36, 'ILMU GIZI', 9),
(37, 'ILMU KELUARGA DAN KONSUMEN', 9),
(38, 'KOMUNIKASI DAN PENGEMBANGAN MASYARAKAT', 9),
(39, 'BISNIS', 10);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama_fakultas`) VALUES
(1, 'Fakultas Pertanian'),
(2, 'Fakultas Kedokteran Hewan'),
(3, 'Fakultas Perikanan dan Ilmu Kelautan'),
(4, 'Fakultas Peternakan'),
(5, 'Fakultas Kehutanan'),
(6, 'Fakultas Teknologi Pertanian'),
(7, 'Fakultas Matematika dan Ilmu Pengetahuan Alam'),
(8, 'Fakultas Ekonomi dan Manajemen'),
(9, 'Fakultas Ekologi Manusia'),
(10, 'Sekolah Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `no_invoice` varchar(100) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `terbilang` int(11) NOT NULL,
  `tanggal_penerbitan_invoice` date NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_analisis`
--

CREATE TABLE `jenis_analisis` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_analisis`
--

INSERT INTO `jenis_analisis` (`id`, `jenis`) VALUES
(1, 'Fitokimia'),
(2, 'Kapang/kamir'),
(3, 'PCA (TPC)'),
(4, 'Koliform'),
(5, 'Anti mikrob'),
(6, 'Pb'),
(7, 'Cd'),
(8, 'AS'),
(9, 'Androgafolida'),
(10, 'Apigenin'),
(11, 'Brazilin'),
(12, 'Philantine'),
(13, 'Sinensetin'),
(14, 'Total Fenol'),
(15, 'Total Flavonoid'),
(16, 'Xantorizol'),
(17, 'Gingerol'),
(18, 'Asiaticoside'),
(19, 'Kafein'),
(20, 'Kurkumin'),
(21, 'Capcaisin'),
(22, 'Kadar Tanin'),
(23, 'Kuersetin'),
(24, 'DPPH spektrometer'),
(25, 'DPPH mikroplate'),
(26, 'Enzim a-glukosidase'),
(27, 'Uji toksisitas'),
(28, 'Enzim Tyrosinasi'),
(29, 'FTIR'),
(30, 'Kadar Abu'),
(31, 'Kadar Abu tak larut asam'),
(32, 'Kadar Air'),
(33, 'Kadar Lemak'),
(34, 'Kadar sari larut air'),
(35, 'Kadar sari larut etanol'),
(36, 'Serat kasar'),
(37, 'Organoleptik'),
(38, 'pH'),
(39, 'Pola KLT'),
(40, 'Rotaf'),
(41, 'Pelet KBr');

-- --------------------------------------------------------

--
-- Table structure for table `kaji_ulang`
--

CREATE TABLE `kaji_ulang` (
  `id` int(11) NOT NULL,
  `parameter` varchar(100) NOT NULL DEFAULT '0',
  `metode` tinyint(1) NOT NULL DEFAULT '0',
  `peralatan` tinyint(1) NOT NULL DEFAULT '0',
  `personel` tinyint(1) NOT NULL DEFAULT '0',
  `bahan_kimia` tinyint(1) NOT NULL DEFAULT '0',
  `kondisi_akomodasi` tinyint(1) NOT NULL DEFAULT '0',
  `kesimpulan` varchar(100) NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_klien`
--

CREATE TABLE `kategori_klien` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_klien`
--

INSERT INTO `kategori_klien` (`id`, `kategori`) VALUES
(1, 'Internal'),
(2, 'Mahasiswa'),
(3, 'Instansi Pemerintah'),
(4, 'Perusahaan'),
(5, 'Individu');

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE `kwitansi` (
  `id` int(11) NOT NULL,
  `no_kwitansi` varchar(100) NOT NULL,
  `telah_terima_dari` varchar(100) NOT NULL,
  `untuk_pembayaran_analisis` varchar(100) NOT NULL,
  `terbilang` varchar(100) NOT NULL,
  `jumlah_biaya` int(11) NOT NULL,
  `tanggal_kwitansi` date NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lab_kit`
--

CREATE TABLE `lab_kit` (
  `id` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `jangka_kalibrasi` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `kalibrasi_selanjutnya` date NOT NULL,
  `status_penggunaan` enum('digunakan','tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lab_kit`
--

INSERT INTO `lab_kit` (`id`, `nama_alat`, `jangka_kalibrasi`, `tanggal_mulai`, `kalibrasi_selanjutnya`, `status_penggunaan`) VALUES
(1, 'TLC Aplikator', 1, '2016-08-22', '2017-07-07', 'tersedia'),
(2, 'Spektro UV - Vis', 1, '2016-08-22', '2017-07-07', 'tersedia'),
(3, 'Micro Plate', 2, '2017-04-30', '2017-07-19', 'tersedia'),
(5, 'FTIR', 3, '2017-06-03', '2017-07-21', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `lokasi_penyimpanan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `rak` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `lokasi_penyimpanan`, `rak`) VALUES
(1, 'Kulkas A', ''),
(2, 'Kulkas B', ''),
(3, 'Freezer', ''),
(4, 'Lemari', ''),
(5, 'Gudang', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing_penelitian`
--

CREATE TABLE `pembimbing_penelitian` (
  `id` int(11) NOT NULL,
  `nama_pembimbing` varchar(100) NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pemohon_analisis`
--

CREATE TABLE `pemohon_analisis` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `institusi_perusahaan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp_fax` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pemohon_analisis`
--

INSERT INTO `pemohon_analisis` (`id`, `nama_lengkap`, `institusi_perusahaan`, `alamat`, `telp_fax`, `no_hp`, `email`, `request_id`) VALUES
(23, 'Kurnia Fajar Fatih', 'Institut Pertanian Bogor', 'Jl. Padjadjaran, Bantarjati, RT 2/11, No. 30, Bogor', '097625678', '98726545678', 'kfajarf@gmail.com', 23);

-- --------------------------------------------------------

--
-- Table structure for table `peneliti`
--

CREATE TABLE `peneliti` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_tanggal_lahir` varchar(100) NOT NULL,
  `institusi` varchar(100) NOT NULL,
  `nrp_nim` varchar(100) NOT NULL,
  `no_handphone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat_dan_no_telp_bogor` varchar(100) NOT NULL,
  `alamat_dan_no_telp_orang_tua` varchar(100) NOT NULL,
  `judul_penelitian` varchar(100) NOT NULL,
  `tanggal_masuk_lpsb` date NOT NULL,
  `uang_masuk_lpsb` int(11) NOT NULL,
  `deposit_lpsb` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `biaya_hasil_rekapitulasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan_alat`
--

CREATE TABLE `penggunaan_alat` (
  `id` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `kit_id` int(11) NOT NULL,
  `tanggal_penggunaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penggunaan_alat`
--

INSERT INTO `penggunaan_alat` (`id`, `nama_pengguna`, `nim`, `kit_id`, `tanggal_penggunaan`) VALUES
(1, 'Fajar', 'G64130088', 2, '2016-09-29'),
(4, 'barru1', 'G61426', 3, '2017-04-28'),
(6, 'ME', 'G18289', 1, '2017-06-30'),
(8, 'PENGGUNA', 'TEST', 1, '2017-06-30'),
(10, 'hjkl', 'hjkl', 1, '2017-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `reagen`
--

CREATE TABLE `reagen` (
  `id` varchar(100) NOT NULL,
  `nama_reagen` varchar(100) NOT NULL,
  `jenis_reagen` enum('padat','cair') NOT NULL,
  `jumlah` double NOT NULL,
  `jumlah_minimum` double NOT NULL,
  `unit` varchar(20) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_storage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reagen`
--

INSERT INTO `reagen` (`id`, `nama_reagen`, `jenis_reagen`, `jumlah`, `jumlah_minimum`, `unit`, `tanggal_kadaluarsa`, `status`, `id_lokasi`, `id_supplier`, `id_storage`) VALUES
('id1', 'reagen12', 'padat', 0, 3, 'ml', '2017-11-24', 'LOW STOCK', 2, 2, 3),
('id2', 'BARU', 'cair', 3, 2, 'ml', '2017-12-27', '-', 3, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `rekapitulasi_bahan`
--

CREATE TABLE `rekapitulasi_bahan` (
  `id` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `spesifikasi` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sampel`
--

CREATE TABLE `sampel` (
  `id` int(11) NOT NULL,
  `sampel_id` varchar(100) NOT NULL,
  `nama_sampel` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `kemasan` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `jenis_metode_analisis` varchar(100) DEFAULT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sampel`
--

INSERT INTO `sampel` (`id`, `sampel_id`, `nama_sampel`, `id_jenis`, `kemasan`, `jumlah`, `jenis_metode_analisis`, `request_id`) VALUES
(21, '', 'Sampel 1', 1, 'Botol', '4', 'Metode 1', 23),
(22, '', 'Sampel 2', 4, 'Gelas', '5', 'Metode 2', 23),
(23, '', 'Sampel 3', 3, 'Plastik', '2', 'Metode 3', 23);

-- --------------------------------------------------------

--
-- Table structure for table `sampel_penelitian`
--

CREATE TABLE `sampel_penelitian` (
  `id` int(11) NOT NULL,
  `sampel` varchar(100) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `analisis` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `nama`, `nik`, `user_id`) VALUES
(1, 'Upper Staff', '99162640', 1),
(2, 'staff', '99276368', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier`) VALUES
(1, 'PT CMSI'),
(2, 'PT Intralab'),
(3, 'PT Elo Karsa Utama'),
(4, 'Brataco'),
(5, 'PT Merck'),
(6, 'CV Muji Lestari'),
(7, 'PD Frisconina'),
(8, 'CV Setia Guna');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `pembuat` varchar(100) NOT NULL,
  `tujuan_surat` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `file_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `nomor_surat`, `tanggal_surat`, `pembuat`, `tujuan_surat`, `perihal`, `keterangan`, `file_surat`) VALUES
(1, '1', '2017-07-05', 'asd', 'asd', 'asd', 'asd', 'Surat Keluar - Formulir Pendaftaran Seminar.pdf'),
(2, '123124', '2017-07-05', 'asdaf', 'tujuan', 'perihal', 'keterangan', 'Surat Keluar - VQ5XP.png');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `sumber_surat` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor_surat`, `tanggal_surat`, `tanggal_terima`, `sumber_surat`, `perihal`, `keterangan`, `file_surat`) VALUES
(3, '1', '2017-05-30', '2017-06-08', 'Pakde', 'Baru', '', 'Bebas-Tanggungan-Lab.pdf'),
(4, '2', '2017-07-06', '2017-07-05', 'RT', 'kegiatan', '', 'surat-masuk-Log Bimbingan Tugas Akhir.pdf'),
(6, 'asdasd', '2017-07-12', '2017-07-12', 'asd', 'asd', 'asd', 'Surat Masuk - Formulir Pendaftaran Seminar.pdf'),
(7, '123', '2017-07-05', '2017-07-05', 'Sumber', 'Perihal', 'Keterangan', 'Surat Masuk - Bebas-laboratorium_PRINT-PAKAI-KERTAS-HIJAU-MUDA.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `take_reagen`
--

CREATE TABLE `take_reagen` (
  `id_reagen` varchar(100) NOT NULL,
  `nama_reagen` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pengambilan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `take_reagen`
--

INSERT INTO `take_reagen` (`id_reagen`, `nama_reagen`, `jumlah`, `tanggal_pengambilan`) VALUES
('id1', 'reagen12', 2, '2017-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_penelitian_lain`
--

CREATE TABLE `tempat_penelitian_lain` (
  `id` int(11) NOT NULL,
  `nama_tempat` varchar(100) NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `top_management`
--

CREATE TABLE `top_management` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `top_management`
--

INSERT INTO `top_management` (`id`, `staff_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`) VALUES
(1, 'upper_management', NULL, '$2a$10$8cG1AlwouPGF4mZ9qFpxwOUp6NIFOlCRp9mRBd.LbjIE72ftRwps.', ''),
(2, 'staff', NULL, '$2a$10$8cG1AlwouPGF4mZ9qFpxwOUp6NIFOlCRp9mRBd.LbjIE72ftRwps.', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sampel`
-- (See below for the actual view)
--
CREATE TABLE `view_sampel` (
`nama_sampel` varchar(100)
,`jenis` varchar(100)
,`kemasan` varchar(100)
,`jumlah` varchar(100)
,`jenis_metode_analisis` varchar(100)
,`request_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `analysis_request_data`
--
DROP TABLE IF EXISTS `analysis_request_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `analysis_request_data`  AS  select `ar`.`id` AS `id`,`ar`.`lpsb_order_no` AS `lpsb_order_no`,`kk`.`kategori` AS `kategori`,`s`.`nama_sampel` AS `nama_sampel`,`ja`.`jenis` AS `jenis`,`s`.`kemasan` AS `kemasan`,`s`.`jumlah` AS `jumlah`,`s`.`jenis_metode_analisis` AS `jenis_metode_analisis`,`ar`.`status_pengujian` AS `status_pengujian`,`ar`.`tanggal_diterima` AS `tanggal_diterima`,`ar`.`tanggal_selesai` AS `tanggal_selesai`,`ar`.`total_biaya` AS `total_biaya`,`ar`.`dp` AS `dp`,`ar`.`sisa` AS `sisa`,`ar`.`keterangan` AS `keterangan` from (((`analysis_request` `ar` left join `kategori_klien` `kk` on((`kk`.`id` = `ar`.`id_kategori_klien`))) left join `sampel` `s` on((`s`.`request_id` = `ar`.`id`))) left join `jenis_analisis` `ja` on((`ja`.`id` = `s`.`id_jenis`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sampel`
--
DROP TABLE IF EXISTS `view_sampel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sampel`  AS  select `s`.`nama_sampel` AS `nama_sampel`,`ja`.`jenis` AS `jenis`,`s`.`kemasan` AS `kemasan`,`s`.`jumlah` AS `jumlah`,`s`.`jenis_metode_analisis` AS `jenis_metode_analisis`,`s`.`request_id` AS `request_id` from (`sampel` `s` left join `jenis_analisis` `ja` on((`s`.`id_jenis` = `ja`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis_request`
--
ALTER TABLE `analysis_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_pengguna` (`id_kategori_klien`);

--
-- Indexes for table `chem_storage`
--
ALTER TABLE `chem_storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `jenis_analisis`
--
ALTER TABLE `jenis_analisis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kaji_ulang`
--
ALTER TABLE `kaji_ulang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `kategori_klien`
--
ALTER TABLE `kategori_klien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kwitansi`
--
ALTER TABLE `kwitansi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `lab_kit`
--
ALTER TABLE `lab_kit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembimbing_penelitian`
--
ALTER TABLE `pembimbing_penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `pemohon_analisis`
--
ALTER TABLE `pemohon_analisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lpsb_order_no` (`request_id`),
  ADD KEY `lpsb_order_no_2` (`request_id`);

--
-- Indexes for table `peneliti`
--
ALTER TABLE `peneliti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penggunaan_alat`
--
ALTER TABLE `penggunaan_alat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kit_id` (`kit_id`);

--
-- Indexes for table `reagen`
--
ALTER TABLE `reagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_storage` (`id_storage`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `rekapitulasi_bahan`
--
ALTER TABLE `rekapitulasi_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `sampel`
--
ALTER TABLE `sampel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lpsb_order_no` (`request_id`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `sampel_penelitian`
--
ALTER TABLE `sampel_penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `take_reagen`
--
ALTER TABLE `take_reagen`
  ADD KEY `id_reagen` (`id_reagen`);

--
-- Indexes for table `tempat_penelitian_lain`
--
ALTER TABLE `tempat_penelitian_lain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `top_management`
--
ALTER TABLE `top_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis_request`
--
ALTER TABLE `analysis_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `chem_storage`
--
ALTER TABLE `chem_storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_analisis`
--
ALTER TABLE `jenis_analisis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `kaji_ulang`
--
ALTER TABLE `kaji_ulang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategori_klien`
--
ALTER TABLE `kategori_klien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kwitansi`
--
ALTER TABLE `kwitansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_kit`
--
ALTER TABLE `lab_kit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pembimbing_penelitian`
--
ALTER TABLE `pembimbing_penelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemohon_analisis`
--
ALTER TABLE `pemohon_analisis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `peneliti`
--
ALTER TABLE `peneliti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penggunaan_alat`
--
ALTER TABLE `penggunaan_alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `rekapitulasi_bahan`
--
ALTER TABLE `rekapitulasi_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sampel`
--
ALTER TABLE `sampel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `sampel_penelitian`
--
ALTER TABLE `sampel_penelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tempat_penelitian_lain`
--
ALTER TABLE `tempat_penelitian_lain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `top_management`
--
ALTER TABLE `top_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `analysis_request`
--
ALTER TABLE `analysis_request`
  ADD CONSTRAINT `analysis_request_ibfk_1` FOREIGN KEY (`id_kategori_klien`) REFERENCES `kategori_klien` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `departemen`
--
ALTER TABLE `departemen`
  ADD CONSTRAINT `departemen_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `peneliti` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `kaji_ulang`
--
ALTER TABLE `kaji_ulang`
  ADD CONSTRAINT `kaji_ulang_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `analysis_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembimbing_penelitian`
--
ALTER TABLE `pembimbing_penelitian`
  ADD CONSTRAINT `pembimbing_penelitian_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `peneliti` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pemohon_analisis`
--
ALTER TABLE `pemohon_analisis`
  ADD CONSTRAINT `pemohon_analisis_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `analysis_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penggunaan_alat`
--
ALTER TABLE `penggunaan_alat`
  ADD CONSTRAINT `penggunaan_alat_ibfk_1` FOREIGN KEY (`kit_id`) REFERENCES `lab_kit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reagen`
--
ALTER TABLE `reagen`
  ADD CONSTRAINT `reagen_ibfk_1` FOREIGN KEY (`id_storage`) REFERENCES `chem_storage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reagen_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id`),
  ADD CONSTRAINT `reagen_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `rekapitulasi_bahan`
--
ALTER TABLE `rekapitulasi_bahan`
  ADD CONSTRAINT `rekapitulasi_bahan_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `peneliti` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sampel`
--
ALTER TABLE `sampel`
  ADD CONSTRAINT `sampel_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `analysis_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sampel_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_analisis` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sampel_penelitian`
--
ALTER TABLE `sampel_penelitian`
  ADD CONSTRAINT `sampel_penelitian_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `peneliti` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `take_reagen`
--
ALTER TABLE `take_reagen`
  ADD CONSTRAINT `take_reagen_ibfk_1` FOREIGN KEY (`id_reagen`) REFERENCES `reagen` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tempat_penelitian_lain`
--
ALTER TABLE `tempat_penelitian_lain`
  ADD CONSTRAINT `tempat_penelitian_lain_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `peneliti` (`id`);

--
-- Constraints for table `top_management`
--
ALTER TABLE `top_management`
  ADD CONSTRAINT `top_management_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
