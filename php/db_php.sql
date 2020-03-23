-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 18 Mei 2015 pada 03.07
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_php`
--
CREATE DATABASE IF NOT EXISTS `db_php` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_php`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_php`
--

CREATE TABLE IF NOT EXISTS `tb_php` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `tb_php`
--

INSERT INTO `tb_php` (`no`, `name`, `harga`) VALUES
(1, 'Bakso', '5000'),
(2, 'Rawon', '7500'),
(3, 'Nasi Goreng', '9000'),
(4, 'Nasi Pecel', '6000'),
(5, 'Bakmi', '10000'),
(6, 'Bebek Goreng', '15000'),
(7, 'Tahu Telur', '8000'),
(8, 'Ayam Goreng', '9000'),
(9, 'Siomay', '10000'),
(10, 'Nasi Lele Penyet', '8000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
