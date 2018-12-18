-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2018 at 12:24 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arduino_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnika` int(11) NOT NULL,
  `ime` varchar(255) COLLATE latin1_general_cs NOT NULL,
  `lozinka` varchar(255) COLLATE latin1_general_cs NOT NULL,
  `id_arduina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnika`, `ime`, `lozinka`, `id_arduina`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

-- --------------------------------------------------------

--
-- Table structure for table `merenja`
--

CREATE TABLE `merenja` (
  `id_merenja` int(11) NOT NULL,
  `id_arduina` int(11) NOT NULL,
  `vreme_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nadmorska_visina` int(11) NOT NULL,
  `vlaznost_vazduha` int(11) NOT NULL,
  `vazdusni_pritisak` int(11) NOT NULL,
  `temperatura` int(11) NOT NULL,
  `vlaznost_zemljista` int(11) NOT NULL,
  `navodnjavanje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `merenja`
--

INSERT INTO `merenja` (`id_merenja`, `id_arduina`, `vreme_datum`, `nadmorska_visina`, `vlaznost_vazduha`, `vazdusni_pritisak`, `temperatura`, `vlaznost_zemljista`, `navodnjavanje`) VALUES
(1, 1, '2018-10-17 17:26:52', 251, 58, 992, 13, 10, 1),
(2, 1, '2018-10-17 17:26:52', 245, 53, 997, 15, 16, 1),
(3, 1, '2018-10-17 17:26:52', 247, 58, 999, 12, 48, 0),
(4, 1, '2018-10-17 17:26:52', 254, 61, 994, 20, 37, 0),
(5, 1, '2018-10-17 17:26:52', 248, 67, 995, 17, 49, 0),
(6, 1, '2018-10-17 17:26:52', 250, 51, 996, 20, 53, 0),
(7, 1, '2018-10-17 17:26:52', 252, 48, 997, 13, 48, 0),
(8, 1, '2018-10-17 17:26:52', 255, 46, 994, 16, 43, 0),
(9, 1, '2018-10-17 17:26:52', 247, 47, 996, 12, 51, 0),
(10, 1, '2018-10-17 17:26:52', 247, 40, 1000, 15, 25, 1),
(11, 1, '2018-10-17 17:26:52', 248, 60, 999, 15, 46, 0),
(12, 1, '2018-10-17 17:26:53', 254, 66, 999, 17, 66, 0),
(13, 1, '2018-10-17 17:26:53', 254, 40, 996, 11, 24, 1),
(14, 1, '2018-10-17 17:26:53', 247, 70, 997, 11, 27, 1),
(15, 1, '2018-10-17 17:26:53', 249, 58, 1000, 13, 56, 0),
(16, 1, '2018-10-17 17:26:53', 249, 47, 990, 12, 58, 0),
(17, 1, '2018-10-17 17:26:53', 254, 56, 991, 14, 52, 0),
(18, 1, '2018-10-17 17:26:53', 251, 47, 998, 15, 20, 1),
(19, 1, '2018-10-17 17:26:53', 245, 56, 994, 16, 11, 1),
(20, 1, '2018-10-17 17:26:53', 246, 48, 1000, 15, 49, 0),
(21, 1, '2018-10-17 17:26:53', 246, 52, 993, 15, 53, 0),
(22, 1, '2018-10-17 17:26:53', 254, 68, 996, 12, 23, 1),
(23, 1, '2018-10-17 17:26:53', 250, 67, 996, 12, 49, 0),
(24, 1, '2018-10-17 17:26:53', 255, 46, 996, 17, 43, 0),
(25, 1, '2018-10-17 17:26:53', 252, 40, 994, 10, 38, 0),
(26, 1, '2018-10-17 17:26:53', 249, 50, 999, 10, 11, 1),
(27, 1, '2018-10-17 17:26:53', 245, 62, 1000, 16, 64, 0),
(28, 1, '2018-10-17 17:26:53', 254, 46, 992, 20, 21, 1),
(29, 1, '2018-10-17 17:26:53', 252, 44, 993, 19, 51, 0),
(30, 1, '2018-10-17 17:26:53', 247, 58, 998, 17, 41, 0),
(31, 1, '2018-10-17 17:26:53', 248, 53, 1000, 17, 14, 1),
(32, 1, '2018-10-17 17:26:53', 246, 44, 992, 19, 38, 0),
(33, 1, '2018-10-17 17:26:53', 246, 53, 994, 16, 68, 0),
(34, 1, '2018-10-17 17:26:53', 250, 43, 1000, 11, 34, 0),
(35, 1, '2018-10-17 17:26:53', 253, 61, 998, 15, 22, 1),
(36, 1, '2018-10-17 17:26:53', 252, 70, 995, 13, 14, 1),
(37, 1, '2018-10-17 17:26:53', 251, 45, 990, 12, 18, 1),
(38, 1, '2018-10-17 17:26:53', 253, 63, 992, 16, 26, 1),
(39, 1, '2018-10-17 17:26:53', 254, 69, 991, 10, 68, 0),
(40, 1, '2018-10-17 17:26:53', 255, 52, 995, 20, 49, 0),
(41, 1, '2018-10-17 17:26:53', 251, 50, 999, 19, 50, 0),
(42, 1, '2018-10-17 17:26:53', 247, 70, 996, 20, 59, 0),
(43, 1, '2018-10-17 17:26:53', 246, 60, 996, 13, 38, 0),
(44, 1, '2018-10-17 17:26:53', 254, 54, 996, 17, 22, 1),
(45, 1, '2018-10-17 17:26:53', 248, 52, 994, 18, 15, 1),
(46, 1, '2018-10-17 17:26:53', 245, 62, 999, 13, 48, 0),
(47, 1, '2018-10-17 17:26:53', 251, 40, 993, 13, 16, 1),
(48, 1, '2018-10-17 17:26:53', 251, 59, 993, 11, 28, 1),
(49, 1, '2018-10-17 17:26:53', 251, 52, 998, 12, 16, 1),
(50, 1, '2018-10-17 17:26:53', 249, 54, 995, 19, 55, 0),
(51, 1, '2018-10-17 17:26:53', 245, 43, 998, 20, 57, 0),
(52, 1, '2018-10-17 17:26:53', 255, 43, 993, 10, 19, 1),
(53, 1, '2018-10-17 17:26:53', 247, 56, 990, 13, 55, 0),
(54, 1, '2018-10-17 17:26:53', 253, 61, 991, 14, 43, 0),
(55, 1, '2018-10-17 17:26:53', 248, 54, 992, 14, 67, 0),
(56, 1, '2018-10-17 17:26:53', 253, 55, 998, 16, 68, 0),
(57, 1, '2018-10-17 17:26:53', 246, 50, 990, 15, 55, 0),
(58, 1, '2018-10-17 17:26:53', 250, 55, 997, 12, 56, 0),
(59, 1, '2018-10-17 17:26:53', 255, 42, 992, 15, 57, 0),
(60, 1, '2018-10-17 17:26:53', 249, 59, 999, 15, 18, 1),
(61, 1, '2018-10-17 17:26:53', 254, 41, 990, 13, 26, 1),
(62, 1, '2018-10-17 17:26:53', 246, 65, 994, 12, 54, 0),
(63, 1, '2018-10-17 17:26:53', 253, 68, 993, 11, 47, 0),
(64, 1, '2018-10-17 17:26:53', 249, 59, 996, 10, 64, 0),
(65, 1, '2018-10-17 17:26:53', 255, 42, 998, 11, 49, 0),
(66, 1, '2018-10-17 17:26:53', 248, 61, 995, 13, 42, 0),
(67, 1, '2018-10-17 17:26:53', 252, 64, 999, 14, 50, 0),
(68, 1, '2018-10-17 17:26:53', 250, 66, 993, 20, 13, 1),
(69, 1, '2018-10-17 17:26:53', 253, 70, 998, 17, 59, 0),
(70, 1, '2018-10-17 17:26:53', 245, 40, 994, 12, 23, 1),
(71, 1, '2018-10-17 17:26:53', 251, 55, 996, 16, 16, 1),
(72, 1, '2018-10-17 17:26:53', 247, 57, 996, 20, 34, 0),
(73, 1, '2018-10-17 17:26:53', 254, 63, 992, 12, 19, 1),
(74, 1, '2018-10-17 17:26:53', 251, 42, 995, 11, 52, 0),
(75, 1, '2018-10-17 17:26:53', 245, 55, 998, 12, 66, 0),
(76, 1, '2018-10-17 17:26:54', 251, 40, 996, 19, 32, 0),
(77, 1, '2018-10-17 17:26:54', 255, 67, 994, 19, 37, 0),
(78, 1, '2018-10-17 17:26:54', 253, 61, 999, 15, 16, 1),
(79, 1, '2018-10-17 17:26:54', 250, 61, 1000, 15, 41, 0),
(80, 1, '2018-10-17 17:26:54', 245, 68, 995, 18, 29, 1),
(81, 1, '2018-10-17 17:26:54', 248, 52, 994, 19, 10, 1),
(82, 1, '2018-10-17 17:26:54', 252, 61, 996, 16, 67, 0),
(83, 1, '2018-10-17 17:26:54', 250, 50, 992, 19, 37, 0),
(84, 1, '2018-10-17 17:26:54', 248, 62, 998, 17, 34, 0),
(85, 1, '2018-10-17 17:26:54', 249, 43, 999, 20, 38, 0),
(86, 1, '2018-10-17 17:26:54', 250, 60, 997, 19, 38, 0),
(87, 1, '2018-10-17 17:26:54', 251, 53, 991, 10, 33, 0),
(88, 1, '2018-10-17 17:26:54', 254, 64, 997, 20, 37, 0),
(89, 1, '2018-10-17 17:26:54', 249, 43, 997, 20, 12, 1),
(90, 1, '2018-10-17 17:26:54', 254, 52, 998, 13, 67, 0),
(91, 1, '2018-10-17 17:26:54', 251, 67, 996, 20, 68, 0),
(92, 1, '2018-10-17 17:26:54', 249, 57, 991, 18, 25, 1),
(93, 1, '2018-10-17 17:26:54', 255, 57, 991, 17, 70, 0),
(94, 1, '2018-10-17 17:26:54', 245, 49, 995, 14, 18, 1),
(95, 1, '2018-10-17 17:26:54', 254, 55, 993, 20, 49, 0),
(96, 1, '2018-10-17 17:26:54', 254, 67, 999, 13, 44, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `merenja`
--
ALTER TABLE `merenja`
  ADD PRIMARY KEY (`id_merenja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merenja`
--
ALTER TABLE `merenja`
  MODIFY `id_merenja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
