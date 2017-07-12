-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2017 at 12:10 PM
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
-- Structure for view `data_jasa_layanan`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_jasa_layanan`  AS  select `ar`.`id` AS `id`,`ar`.`lpsb_order_no` AS `lpsb_order_no`,`kk`.`kategori` AS `kategori`,`pa`.`nama_lengkap` AS `nama_lengkap`,`pa`.`institusi_perusahaan` AS `institusi_perusahaan`,`pa`.`alamat` AS `alamat`,`pa`.`telp_fax` AS `telp_fax`,`pa`.`no_hp` AS `no_hp`,`pa`.`email` AS `email`,`ka`.`analisis` AS `analisis`,`s`.`sampel_id` AS `sampel_id`,`s`.`nama_sampel` AS `nama_sampel`,`s`.`kemasan` AS `kemasan`,`s`.`jumlah` AS `jumlah`,`ka`.`metode` AS `metode`,`ar`.`status_pengujian` AS `status_pengujian`,`ar`.`tanggal_diterima` AS `tanggal_diterima`,`ar`.`tanggal_selesai` AS `tanggal_selesai`,`ar`.`total_biaya` AS `total_biaya`,`ar`.`dp` AS `dp`,`ar`.`sisa` AS `sisa`,`ar`.`keterangan` AS `keterangan`,`ar`.`status` AS `status` from ((((`analysis_request` `ar` left join `pemohon_analisis` `pa` on((`pa`.`request_id` = `ar`.`id`))) left join `kategori_klien` `kk` on((`kk`.`id` = `ar`.`id_kategori_klien`))) left join `kategori_analisis` `ka` on((`ka`.`request_id` = `ar`.`id`))) left join `sampel` `s` on((`s`.`kategori_analisis_id` = `ka`.`id`))) ;

--
-- VIEW  `data_jasa_layanan`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
