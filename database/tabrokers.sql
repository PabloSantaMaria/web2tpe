-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2018 at 06:12 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabrokers`
--
CREATE DATABASE IF NOT EXISTS `tabrokers` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tabrokers`;

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE `accion` (
  `id_accion` int(11) NOT NULL,
  `accion` text NOT NULL,
  `id_pais` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `variacion` decimal(10,2) NOT NULL,
  `volumen` int(11) NOT NULL,
  `maximo` decimal(10,2) NOT NULL,
  `minimo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accion`
--

INSERT INTO `accion` (`id_accion`, `accion`, `id_pais`, `precio`, `variacion`, `volumen`, `maximo`, `minimo`) VALUES
(10, 'GOLD FIELDS LTD-SPONS ADR', 9, '2.61', '3.98', 3169852, '2.63', '2.49'),
(14, 'ALUMINUM CORP OF CHINA-ADR', 7, '10.16', '-4.87', 51184, '10.47', '10.16'),
(18, 'ADVANTEST CORP-ADR', 10, '9.80', '0.16', 22009, '9.93', '9.77'),
(19, 'AEGON NV (AED)', 11, '25.36', '0.03', 36018, '25.38', '25.27'),
(82, '3M CO', 1, '1538.10', '80.92', 5498708, '1538.10', '1538.10'),
(83, 'ALCOA INC', 1, '71.00', '9.23', 25134, '71.00', '71.00'),
(84, 'AMERICAN EXPRESS COMPANY', 1, '407.00', '44.87', 62290, '412.00', '407.00'),
(85, 'AMERICAN INTERNATIONAL GROUP', 1, '405.00', '-4.71', 2270025, '405.00', '405.00'),
(86, 'CATERPILLAR INC', 1, '1030.50', '-11.16', 517343, '1170.00', '1030.50'),
(87, 'IBM', 1, '581.00', '0.89', 52260, '581.00', '580.00'),
(88, 'APPLE INC', 2, '802.00', '-0.99', 184570, '820.00', '800.00'),
(89, 'ACCENTURE PLC', 2, '157.43', '-1.47', 603765, '158.44', '156.97'),
(90, 'AMAZON.COM INC', 2, '1812.27', '-1.06', 1604422, '1830.15', '1810.59'),
(91, 'CISCO SYSTEMS INC', 2, '370.20', '1.42', 22112, '370.20', '370.20'),
(92, 'IFM INVESTMENTS LTD-ADS', 23, '0.68', '-11.69', 14355, '0.75', '0.66'),
(93, 'CIA PARANAENSE ENER-SP ADR P', 65, '6.71', '-1.18', 202508, '6.77', '6.64'),
(94, 'EMBRAER SA-ADR', 65, '20.04', '-1.28', 126178, '20.24', '20.02'),
(95, 'CREDIT SUISSE GROUP-SPON ADR', 6, '13.36', '-1.62', 761675, '13.45', '13.44'),
(96, 'DANAOS CORP', 66, '1.15', '-4.70', 24106, '1.17', '1.14'),
(97, 'ENI SPA-SPONSORED ADR', 67, '35.37', '-1.58', 312215, '35.65', '34.21'),
(98, 'SASOL LTD-SPONSORED ADR', 9, '35.66', '-2.75', 92960, '35.83', '34.20'),
(99, 'HARMONY GOLD MNG-SPON ADR', 9, '2.10', '3.69', 1245236, '2.12', '2.06'),
(100, 'ANGLOGOLD ASHANTI-SPON ADR', 9, '9.90', '3.61', 1323564, '9.91', '8.50'),
(101, 'CHINA MOBILE LTD-SPON ADR', 7, '49.46', '-0.02', 240265, '49.62', '49.20'),
(102, 'CHINA YUCHAI INTL LTD', 68, '15.33', '0.58', 8596, '15.36', '15.23'),
(103, 'HONDA MOTOR CO LTD-SPONS ADR', 10, '27.37', '-0.76', 245121, '27.60', '27.30'),
(104, 'ATRESMEDIA', 5, '9.49', '3.83', 659465, '9.51', '9.18'),
(105, 'DEUTSCHE BANK AG-REGISTERED', 69, '11.04', '-1.95', 1325957, '11.27', '11.02');

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `pais` text NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`id_pais`, `pais`, `id_region`) VALUES
(1, 'Argentina', 1),
(2, 'USA', 2),
(3, 'Canada', 2),
(4, 'Bermuda', 2),
(5, 'España', 3),
(6, 'Suiza', 3),
(7, 'China', 4),
(8, 'Emiratos Arabes Unidos', 4),
(9, 'Sudafrica', 5),
(10, 'Japón', 4),
(11, 'Países Bajos', 3),
(23, 'Chile', 2),
(65, 'Brasil', 2),
(66, 'Grecia', 3),
(67, 'Italia', 3),
(68, 'Singapur', 4),
(69, 'Alemania', 3);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `region` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id_region`, `region`) VALUES
(1, 'Argentina'),
(2, 'Resto de América'),
(3, 'Europa'),
(4, 'Asia'),
(5, 'Africa');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `pass`) VALUES
(7, 'admin', '$2y$10$1GOjrKkiDSW8Hmx.YIjnPOk.pkmqx5E//D450DGIvdh3zQU1rcRFK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id_accion`),
  ADD KEY `fk_pais` (`id_pais`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`),
  ADD KEY `fk_region` (`id_region`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accion`
--
ALTER TABLE `accion`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);

--
-- Constraints for table `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `fk_region` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
