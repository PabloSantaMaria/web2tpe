-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2018 at 10:13 PM
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
(2, 'ALCOA INC', 1, '71.00', '9.23', 25134, '71.00', '71.00'),
(3, 'APPLE INC', 2, '845.00', '1.20', 3233990, '855.00', '825.00'),
(4, 'BARRICK GOLD CORP', 3, '426.00', '-5.54', 5263617, '426.00', '420.00'),
(7, 'AMERICAN AIRLINES GROUP INC', 2, '32.30', '-3.73', 3028979, '33.38', '32.01'),
(8, 'ASSURED GUARANTY LTD', 4, '42.16', '-1.31', 194928, '42.85', '42.03'),
(9, 'ANGLOGOLD ASHANTI-SPON ADR', 9, '8.80', '3.65', 1471561, '8.80', '8.48'),
(10, 'GOLD FIELDS LTD-SPONS ADR', 9, '2.61', '3.98', 3169852, '2.63', '2.49'),
(11, 'IBM', 1, '565.00', '-2.42', 69140, '580.00', '565.00'),
(12, 'ATRESMEDIA', 5, '9.49', '3.83', 659657, '9.18', '9.51'),
(13, 'BASILEA PHARMACEUTICA AG', 6, '78.30', '3.16', 62846, '79.35', '77.10'),
(14, 'ALUMINUM CORP OF CHINA-ADR', 7, '10.16', '-4.87', 51184, '10.47', '10.16');

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
(9, 'Sudafrica', 5);

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
(2, 'Resto_de_America'),
(3, 'Europa'),
(4, 'Asia'),
(5, 'Africa');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accion`
--
ALTER TABLE `accion`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
