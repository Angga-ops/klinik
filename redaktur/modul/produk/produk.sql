-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 10. September 2019 jam 18:37
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_klinik_kecantikan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_p` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` int(20) NOT NULL,
  `nama_p` varchar(50) NOT NULL,
  `harga_beli` varchar(50) NOT NULL,
  `harga_jual` varchar(50) NOT NULL,
  `id_s` int(15) NOT NULL,
  `id_kategori` int(15) NOT NULL,
  `batas_minim` int(20) NOT NULL,
  `batas_percabang` int(20) NOT NULL,
  `id_kk` int(11) NOT NULL,
  `id_sup` int(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_p`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_p`, `kode_barang`, `nama_p`, `harga_beli`, `harga_jual`, `id_s`, `id_kategori`, `batas_minim`, `batas_percabang`, `id_kk`, `id_sup`, `jumlah`) VALUES
(1, 1, 'Garnier Sakura Night Cream', '20000', '25000', 1, 0, 10, 30, 0, 1, 200),
(10, 3, 'cuci muka', '20000', '30000', 3, 7, 200, 100, 0, 1, 400),
(9, 2, 'Emina Perfect', '21000', '30000', 4, 1, 250, 1500, 0, 2, 500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
