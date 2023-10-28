-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 06:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allocation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dev`
--

CREATE TABLE `tbl_dev` (
  `dev_id` int(11) NOT NULL,
  `dev_name` varchar(25) NOT NULL,
  `dev_branch` int(11) NOT NULL,
  `dev_email` varchar(20) NOT NULL,
  `dev_password` varchar(20) NOT NULL,
  `dev_status` int(11) NOT NULL DEFAULT 0,
  `dev_load` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_dev`
--

INSERT INTO `tbl_dev` (`dev_id`, `dev_name`, `dev_branch`, `dev_email`, `dev_password`, `dev_status`, `dev_load`) VALUES
(1, 'Abhijith', 0, 'abhi@mail.com', 'wasd', 0, 3),
(2, 'vy', 0, 'vy@gm.co', 'vy', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dev`
--
ALTER TABLE `tbl_dev`
  ADD PRIMARY KEY (`dev_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dev`
--
ALTER TABLE `tbl_dev`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
