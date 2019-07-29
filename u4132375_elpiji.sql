-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2019 at 01:44 PM
-- Server version: 10.2.25-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u4132375_ekpiji`
--

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE `agen` (
  `nik` varchar(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `siup` varchar(12) NOT NULL,
  `email` varchar(35) NOT NULL,
  `no_telp` varchar(11) NOT NULL,
  `alamat` varchar(55) NOT NULL,
  `katasandi` varchar(55) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`nik`, `nama`, `siup`, `email`, `no_telp`, `alamat`, `katasandi`, `status`) VALUES
('2222222', 'JAMILAH', '555555', 'yogiprazz@ymail.com', '087945612', 'Jakpus', '15de21c670ae7c3f6f3f1f37029303c9', 'aktif'),
('52353452354', 'wawas', 'admin1@mail.', 'yogiprazz@ymail.com', '78749238', 'Jonggol', '202cb962ac59075b964b07152d234b70', 'aktif');

--
-- Triggers `agen`
--
DELIMITER $$
CREATE TRIGGER `agen_approval` BEFORE UPDATE ON `agen` FOR EACH ROW BEGIN
    INSERT INTO log_agen_approval
    set nik = OLD.nik,
    status_sebelum = OLD.status,
    status_sekarang = new.status,
    tgl_approval = NOW(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(5) NOT NULL,
  `nik` varchar(225) NOT NULL,
  `sku` varchar(225) NOT NULL,
  `qty` int(15) NOT NULL,
  `harga` int(225) NOT NULL,
  `total` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_agen_approval`
--

CREATE TABLE `log_agen_approval` (
  `id_log` int(3) NOT NULL,
  `nik` varchar(225) NOT NULL,
  `tgl_approval` datetime NOT NULL,
  `status_sekarang` varchar(225) NOT NULL,
  `status_sebelum` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_agen_approval`
--

INSERT INTO `log_agen_approval` (`id_log`, `nik`, `tgl_approval`, `status_sekarang`, `status_sebelum`) VALUES
(5, '52353452354', '2019-07-27 13:37:48', 'approve', 'pending'),
(6, '52353452354', '2019-07-27 13:40:05', 'aktif', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `master_produk`
--

CREATE TABLE `master_produk` (
  `sku` int(5) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `atribut` varchar(35) NOT NULL,
  `harga` int(35) NOT NULL,
  `stok` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_produk`
--

INSERT INTO `master_produk` (`sku`, `nama`, `atribut`, `harga`, `stok`) VALUES
(1, 'Bright Gas 12 kg', 'non-supsidi', 140000, 222),
(2, 'Bright Gas 5,5 kg', 'non-supsidi', 67500, 100),
(24, 'Elpiji Biru 12 kg', 'non-supsidi', 134000, 100),
(25, 'Elpiji 50 kg', 'non-supsidi', 650000, 222),
(26, 'Gas Elpiji 3kg', 'supsidi', 21000, 200);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id_order` int(12) NOT NULL,
  `id_order_item` varchar(35) NOT NULL,
  `nik` varchar(225) NOT NULL,
  `sku` varchar(225) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id_order`, `id_order_item`, `nik`, `sku`, `qty`, `harga`, `total`) VALUES
(7, '1564156967618', '2222222', '1', 5, 140000, 700000),
(8, '1564156967618', '2222222', '26', 5, 21000, 105000),
(9, '1564195369390', '2222222', '2', 2, 67500, 135000),
(10, '1564195369390', '2222222', '1', 1, 140000, 140000),
(11, '1564197219856', '2222222', '1', 1, 140000, 140000),
(12, '1564197219856', '2222222', '1', 3, 140000, 420000),
(13, '1564207589819', '2222222', '1', 5, 140000, 700000),
(14, '1564207589819', '2222222', '26', 20, 21000, 420000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `faktur` int(12) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `id_order_item` varchar(35) NOT NULL,
  `nik` varchar(225) NOT NULL,
  `status` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`faktur`, `tanggal`, `id_order_item`, `nik`, `status`) VALUES
(5, '2019-07-26 23:02:47', '1564156967618', '2222222', 'dibayar'),
(6, '2019-07-27 09:42:49', '1564195369390', '2222222', 'pending payment'),
(7, '2019-07-27 10:13:39', '1564197219856', '2222222', 'pending payment'),
(8, '2019-07-27 13:06:30', '1564207589819', '2222222', 'pending payment');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user` int(3) NOT NULL,
  `email` varchar(30) NOT NULL,
  `katasandi` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id_user`, `email`, `katasandi`) VALUES
(1, 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `user_pertamina`
--

CREATE TABLE `user_pertamina` (
  `id_user` int(3) NOT NULL,
  `email` varchar(30) NOT NULL,
  `katasandi` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_pertamina`
--

INSERT INTO `user_pertamina` (`id_user`, `email`, `katasandi`) VALUES
(0, 'ptmn@admin.com', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `log_agen_approval`
--
ALTER TABLE `log_agen_approval`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`faktur`);

--
-- Indexes for table `user_pertamina`
--
ALTER TABLE `user_pertamina`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_agen_approval`
--
ALTER TABLE `log_agen_approval`
  MODIFY `id_log` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id_order` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `faktur` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
