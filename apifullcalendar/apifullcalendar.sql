-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Jul-2018 às 07:58
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apifullcalendar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'reuniao', '#40E0D0', '2018-07-07 09:00:00', '2018-07-07 11:00:00'),
(2, 'palestra', '#40E0D0', '2018-07-09 08:00:00', '2018-07-09 14:00:00'),
(3, 'compromisso', '#009999', '2018-07-11 08:00:00', '2018-07-13 15:00:00'),
(6, 'planejamento', '#228B22', '2018-07-23 09:00:00', '2018-07-23 10:00:00'),
(7, 'outro teste', '#FFD700', '2018-07-26 09:00:00', '2018-07-26 14:30:00'),
(9, 'mais teste', '#FF4500', '2018-07-24 10:00:00', '2018-07-24 18:00:00'),
(10, 'orcamento', '#0071C5', '2018-07-31 08:35:00', '2018-07-31 10:30:00'),
(11, 'planejamento', '#0071C5', '2018-07-31 10:40:00', '2018-07-31 11:00:00'),
(12, 'palestra', '#FFD700', '2018-07-31 09:00:00', '2018-07-31 10:00:00'),
(13, 'reuniao', '#FF4500', '2018-07-31 09:00:00', '2018-08-01 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
