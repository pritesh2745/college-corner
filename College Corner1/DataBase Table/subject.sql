-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2021 at 02:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sr no` int(255) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `Sem` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sr no`, `Branch`, `Sem`, `subject`) VALUES
(1, 'DepstarIT', 'Sem-1', 'C_Program'),
(5, 'DepstarIT', 'Sem-2', 'CPP'),
(6, 'DepstarIT', 'Sem-3', 'Java'),
(7, 'DepstarIT', 'Sem-2', 'ME'),
(8, 'DepstarIT', 'Sem-3', 'Maths'),
(10, 'DepstarIT', 'Sem-3', 'DCN'),
(11, 'DepstarIT', 'Sem-1', 'Maths'),
(12, 'DepstarCSE', 'Sem-1', 'C_Program'),
(13, 'DepstarIT', 'Sem-3', 'DE'),
(14, 'DepstarIT', 'Sem-3', 'HSS'),
(15, 'DepstarCE', 'Sem-1', 'Maths'),
(16, 'DepstarIT', 'Sem-1', 'ME');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sr no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sr no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
