-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 06:38 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kseblive`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bill`
--

CREATE TABLE `tb_bill` (
  `id` int(11) NOT NULL,
  `billdate` date NOT NULL,
  `duedate` date NOT NULL,
  `dcdate` date NOT NULL,
  `initialread` varchar(15) NOT NULL,
  `finalread` varchar(15) NOT NULL,
  `unitsused` varchar(15) NOT NULL,
  `fixedcharge` varchar(20) NOT NULL,
  `energycharge` varchar(15) NOT NULL,
  `total` varchar(20) NOT NULL,
  `consumerno` varchar(13) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bill`
--

INSERT INTO `tb_bill` (`id`, `billdate`, `duedate`, `dcdate`, `initialread`, `finalread`, `unitsused`, `fixedcharge`, `energycharge`, `total`, `consumerno`, `phno`, `status`, `loginid`) VALUES
(1, '2020-10-01', '2020-11-01', '2020-11-25', '1545', '1645', '100', '120', '8', '800', '1234567891234', '9645000000', '0', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_complaints`
--

CREATE TABLE `tb_complaints` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `section` varchar(40) NOT NULL,
  `comtype` varchar(40) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `comdesc` varchar(500) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `trackid` varchar(10) NOT NULL,
  `curdate` date NOT NULL,
  `feedback` varchar(100) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_complaints`
--

INSERT INTO `tb_complaints` (`id`, `name`, `section`, `comtype`, `phno`, `comdesc`, `status`, `trackid`, `curdate`, `feedback`, `loginid`) VALUES
(13, 'Stella M Thomas', '004 - Kanjirampally', 'No Power Supply', '9645000001', 'No supply for the last 3hrs', '1', '6cffd650', '2020-11-09', 'Okay, we will correct it soon', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `district` varchar(40) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id`, `fname`, `lname`, `address`, `phno`, `gender`, `district`, `pincode`, `loginid`) VALUES
(8, 'Stella', 'M Thomas', 'Muthuplackal House, Chelimada, Kumily PO\r\n', '9645000001', 'Female', 'Idukki', '691532', 9),
(9, 'Rintu', 'Aleyamma', 'Rintu Pathanamthitta', '9645000000', 'Female', 'Trivandrum', '691536', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `utype` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `password`, `status`, `utype`) VALUES
(9, 'stellamthomas@gmail.com', '307adb8419a267bf033e7ac6d667cf3d', '1', '1'),
(10, 'rintu@gmail.com', '845ac5896769b498d2e52b7001ebf13d', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bill`
--
ALTER TABLE `tb_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_complaints`
--
ALTER TABLE `tb_complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bill`
--
ALTER TABLE `tb_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_complaints`
--
ALTER TABLE `tb_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
