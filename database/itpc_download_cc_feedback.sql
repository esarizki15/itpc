-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 11:49 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `itpc_download`
--

CREATE TABLE `itpc_download` (
  `id` int(11) NOT NULL,
  `playstore` text DEFAULT NULL,
  `appstore` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_download`
--

INSERT INTO `itpc_download` (`id`, `playstore`, `appstore`) VALUES
(1, NULL, 'https://apps.apple.com/id/app/itpc-barcelona-spain/id1543864740');

-- --------------------------------------------------------

--
-- Table structure for table `itpc_email_cc`
--

CREATE TABLE `itpc_email_cc` (
  `id` int(1) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_email_cc`
--

INSERT INTO `itpc_email_cc` (`id`, `email`) VALUES
(1, 'info@itpc-barcelona.es');

-- --------------------------------------------------------

--
-- Table structure for table `itpc_feedback`
--

CREATE TABLE `itpc_feedback` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `create_date` datetime NOT NULL,
  `delete_date` datetime NOT NULL,
  `delete_by` int(1) NOT NULL DEFAULT 1,
  `view` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itpc_email_cc`
--
ALTER TABLE `itpc_email_cc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itpc_feedback`
--
ALTER TABLE `itpc_feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itpc_feedback`
--
ALTER TABLE `itpc_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
