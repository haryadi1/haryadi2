-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2014 at 05:58 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `pegawai_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `gaji` double NOT NULL,
  `sex` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `tanggal_gabung` int(11) NOT NULL,
  PRIMARY KEY (`pegawai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `kode`, `nama`, `alamat`, `gaji`, `sex`, `status`, `jabatan`, `photo`, `tanggal_gabung`) VALUES
(1, 'PEG0001', 'Andrew Hutauruk', 'Barelang City', 4500000, 'Laki-Laki', 'Menikah', 'Programmer', 'PEG0001.jpg', 1410662452),
(2, 'PEG0002', 'Susan Martadinata', 'Nagoya', 2750000, 'Perempuan', 'Lajang', 'Supervisor', 'PEG0002.jpg', 1410662717),
(3, 'PEG0003', 'Shirley Cauadah', 'Batam Center', 2895000, 'Perempuan', 'Lajang', 'Supervisor', 'PEG0003.jpg', 1410662779),
(4, 'PEG0004', 'Junita Permata Sari', 'Batu Aji', 2650000, 'Perempuan', 'Lajang', 'Analis', 'PEG0004.jpg', 1410662834),
(5, 'PEG0005', 'Juan Carlos Diognito', 'Batam Center', 4000000, 'Laki-Laki', 'Menikah', 'Manajer', 'PEG0005.jpg', 1410663771),
(6, 'PEG0006', 'Seroz Verlonovina', 'Bengkong', 4500000, 'Laki-Laki', 'Menikah', 'Direktur', 'PEG0006.jpg', 1410663815),
(7, 'PEG0007', 'Fadli Zion', 'Piayu', 1500000, 'Laki-Laki', 'Menikah', 'Operator', 'PEG0007.jpg', 1410663889),
(8, 'PEG0008', 'Poltak Raja Minyak', 'Batu Aji', 2570000, 'Laki-Laki', 'Menikah', 'Teknisi', 'PEG0008.jpg', 1410663953),
(9, 'PEG0009', 'Hero Wajik', 'Tanjung Uncang', 2450000, 'Laki-Laki', 'Lajang', 'Operator', 'PEG0009.jpg', 1410664002),
(10, 'PEG0010', 'Frabiwa Harianto', 'Tanjung Uncang', 1545000, 'Laki-Laki', 'Lajang', 'Operator', 'PEG0010.jpg', 1410664095);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
