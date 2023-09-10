-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 01:06 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_boxtip_short`
--

-- --------------------------------------------------------

--
-- Table structure for table `resi`
--

CREATE TABLE `resi` (
  `id` int(11) NOT NULL,
  `no_resi` varchar(50) NOT NULL,
  `status_id` int(11) NOT NULL,
  `warehouse_at` int(11) NOT NULL,
  `eta_at` int(11) NOT NULL,
  `process_at` int(11) NOT NULL,
  `delivery_at` int(11) NOT NULL,
  `closed_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resi`
--

INSERT INTO `resi` (`id`, `no_resi`, `status_id`, `warehouse_at`, `eta_at`, `process_at`, `delivery_at`, `closed_at`) VALUES
(1, 'nomorpertamasekali', 3, 1620748370, 1620831766, 1620833571, 1620832611, 0),
(2, 'nomorpertama', 3, 1620748419, 1620831185, 1620833571, 0, 0),
(3, 'nomorkedua', 2, 1620748419, 1620831185, 0, 0, 0),
(4, 'nomorketiga', 2, 1620748419, 1620831185, 0, 0, 0),
(5, 'nomorempat', 3, 1620806999, 1620831766, 1620832696, 1620832611, 0),
(6, 'nomorlima', 2, 1620806999, 1620828597, 0, 0, 0),
(11, 'adfasdf', 1, 1620880733, 0, 0, 0, 0),
(12, 'adsfasdf', 1, 1620880733, 0, 0, 0, 0),
(13, 'resisatu', 1, 1620881271, 0, 0, 0, 0),
(14, 'residua', 1, 1620881271, 0, 0, 0, 0),
(15, 'resitigaasdf', 1, 1620881368, 0, 0, 0, 0),
(16, 'resiempat', 1, 1620881368, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `deskripsi`) VALUES
(1, 'Warehouse', 'Paket berada di Gudang China'),
(2, 'ETA', 'Paket dalam perjalanan menuju Batam'),
(3, 'On Process', 'Paket diproses di Batam'),
(4, 'Pick-up/deliver', 'Paket siap diantar/dijemput'),
(5, 'Closed', 'Pesanan Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$eNI50KiGyLXjpiHrDMvKFuPam6RT0mKILb97mOpt4adHUFdXA0LIW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resi`
--
ALTER TABLE `resi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resi`
--
ALTER TABLE `resi`
  ADD CONSTRAINT `resi_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
