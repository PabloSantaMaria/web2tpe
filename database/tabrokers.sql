-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2018 at 04:32 PM
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
(2, 'ALCOA', 1, '2.00', '9.23', 112333, '71.00', '71.00'),
(3, 'APPLE INC', 2, '845.00', '1.20', 3233990, '855.00', '825.00'),
(4, 'BARRICK GOLD CORP', 3, '426.00', '-5.54', 5263617, '426.00', '420.00'),
(8, 'ASSURED GUARANTY LTD', 4, '42.16', '-1.31', 194928, '42.85', '42.03'),
(9, 'ANGLOGOLD ASHANTI-SPON ADR', 9, '8.80', '3.65', 1471561, '8.80', '8.48'),
(10, 'GOLD FIELDS LTD-SPONS ADR', 9, '2.61', '3.98', 3169852, '2.63', '2.49'),
(11, 'IBM', 1, '565.00', '-2.42', 69140, '580.00', '565.00'),
(13, 'BASILEA PHARMACEUTICA AG', 6, '78.30', '3.16', 62846, '79.35', '77.10'),
(14, 'ALUMINUM CORP OF CHINA-ADR', 7, '10.16', '-4.87', 51184, '10.47', '10.16'),
(15, 'ATRESMEDIA', 5, '9.49', '3.83', 659675, '9.51', '9.18'),
(16, 'AT&T INC', 1, '440.00', '0.00', 17160, '440.00', '440.00'),
(18, 'ADVANTEST CORP-ADR', 10, '9.80', '0.16', 22009, '9.93', '9.77'),
(19, 'AEGON NV (AED)', 11, '25.36', '0.03', 36018, '25.38', '25.27'),
(62, 'accion', 2, '1.00', '2.00', 3, '4.00', '5.00'),
(74, 'can', 3, '213.00', '231.00', 213, '213.00', '213.00'),
(75, 'esp', 5, '456.00', '456.00', 456, '456.00', '456.00');

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
(17, 'Japon', 4),
(23, 'Chile', 2),
(53, 'lolo', 3),
(54, 'lolos', 2),
(55, 'lololo', 4),
(56, 'momomo', 4),
(57, 'lala', 2),
(58, 'sarasa', 1),
(59, 'soso', 7),
(60, 'palo', 1);

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
(5, 'Africa'),
(6, 'lolo'),
(7, 'soso'),
(8, 'aaaaa');

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
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accion`
--
ALTER TABLE `accion`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
