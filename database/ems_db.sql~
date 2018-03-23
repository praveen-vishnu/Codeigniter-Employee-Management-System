-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2017 at 07:20 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ems_employee`
--

CREATE TABLE `ems_employee` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_bday` date NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `emp_salary` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ems_employee`
--

INSERT INTO `ems_employee` (`id`, `emp_id`, `emp_name`, `emp_bday`, `emp_address`, `emp_salary`) VALUES
(1, 'EMS2017001', 'Juan Dela Cruz', '1994-03-20', 'Sta. Cruz', 12000),
(2, 'EMS2017002', 'John Doe', '1992-07-04', 'San Fernando', 15000),
(7, 'EMS2017003', 'Alex Doe', '2017-07-20', 'San Luis', 10000),
(8, 'EMS2017004', 'Cristine Maun', '1992-08-12', 'Magalang, Pampanga', 20000),
(11, 'EMS2017005', 'Jane Doe', '1993-05-05', 'San Simon, Pampanga', 20000),
(12, 'EMS2017006', 'Billy Joe', '1991-07-04', 'Angeles City, Pampanga', 25000),
(13, 'EMS2017007', 'Jenny Doe', '1989-09-21', 'asdasdda', 12000),
(14, 'EMS2017008', 'Andy Leem', '1990-01-19', 'zxcxzcxzc', 15000),
(15, 'EMS2017009', 'Elise Sagum', '1994-03-24', 'qwewqewq', 16000),
(16, 'EMS2017010', 'Jerald Bondoc', '1991-07-19', 'kjjlkjlskjldkfj', 20000),
(17, 'EMS2017011', 'Jeffrey Wey', '1992-09-21', 'Pampanga', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `ems_users`
--

CREATE TABLE `ems_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ems_users`
--

INSERT INTO `ems_users` (`id`, `name`, `username`, `password`) VALUES
(1, 'Admin', 'admin', '$2a$08$Jo/6eisBA1vUzzrRYLgP9eL2aQ0nbsruwKJr2xkFqmi7a6VoEtAP6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ems_employee`
--
ALTER TABLE `ems_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ems_users`
--
ALTER TABLE `ems_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ems_employee`
--
ALTER TABLE `ems_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ems_users`
--
ALTER TABLE `ems_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
