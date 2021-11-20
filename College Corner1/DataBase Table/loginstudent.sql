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
-- Table structure for table `loginstudent`
--

CREATE TABLE `loginstudent` (
  `sr no` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginstudent`
--

INSERT INTO `loginstudent` (`sr no`, `name`, `Branch`, `email`, `password`, `status`, `token`) VALUES
(3, 'Krish Dhorajiya', 'DepstarIT', '20dit020@charusat.edu.in', '$2y$10$zSarF1kztu8BKJXl.ij2M.g24HU26Cmi3sSKwBSN.eyIkY2qh6Oyq', 'active', '8a8ed2fa943f9594b31c5b513d0847'),
(5, 'Raj Tejani', 'DepstarIT', '20dit095@charusat.edu.in', '$2y$10$sbOZsx48l.Yb.aUaglqtu.KOesTQWqCmGsig174mKMt3OzeMewBdi', 'active', '2d76b668d701e7f72c0edda317380e'),
(8, 'Harshil Thummar', 'DepstarIT', '20dit099@charusat.edu.in', '$2y$10$iP8QFhQGZkZ82LX0zmzWreaYB8UA1mgp/qVTy.SN1H.V6cadKbkaq', 'inactive', '441cbc39897535d6da445d3cfe33ef'),
(10, 'Yash', 'DepstarIT', '20dit034@charusat.edu.in', '$2y$10$TP/X6W5DyyL2.JX6BMNQ2eEz.pj2MyityYVINEMEFh/EcyG.ceSMi', 'inactive', 'd780e189c1968c79e4ff3279ba0f8c'),
(12, 'Pritesh Vandra', 'DepstarIT', '20dit102@charusat.edu.in', '$2y$10$qOmcc2F81RHanXt/9mt0bOQbPEMg0ed52CWFZlHiyGS7YuXj0.8Zq', 'active', '28ee8d10f51a0ebdefe29debbaf264'),
(14, 'Bhargav Akabari', 'DepstarCSE', '20dcs002@charusat.edu.in', '$2y$10$Qq1JpFm7atpgaL9q9v15ZeGfMJ3oApqMYNTvtT4.qCQEWBj8/iFGe', 'active', 'e18523937772d79f9e68112e758950'),
(16, 'Zeeya Ramani', 'DepstarIT', '20dit074@charusat.edu.in', '$2y$10$xk88vz73x.Qdv9fNM/ipXu4H5tmnudksQ.jzEGtpiO8t6nOM1.v9i', 'active', 'ffb8cc646ffdd42c01dd6f23ad8b85'),
(17, 'Malav Patel', 'DepstarIT', '20dit059@charusat.edu.in', '$2y$10$i33BQenyyGaTCsGHVY99C.3T05E51LPV/hbyyyOO6kSBerjshPeVC', 'active', '3771f2ecce3a213f8947e83880c441');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loginstudent`
--
ALTER TABLE `loginstudent`
  ADD PRIMARY KEY (`sr no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loginstudent`
--
ALTER TABLE `loginstudent`
  MODIFY `sr no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
