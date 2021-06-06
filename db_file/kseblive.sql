-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2021 at 10:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
-- Table structure for table `tb_addsupplyreport`
--

CREATE TABLE `tb_addsupplyreport` (
  `rpid` int(11) NOT NULL,
  `rpkey` varchar(8) NOT NULL,
  `rpdate` date NOT NULL,
  `rpamt` float NOT NULL,
  `rpreqkey` varchar(9) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_addsupplyreport`
--

INSERT INTO `tb_addsupplyreport` (`rpid`, `rpkey`, `rpdate`, `rpamt`, `rpreqkey`, `loginid`) VALUES
(1, 'c6fa1555', '2006-06-21', 200, '7066a1eb', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_addsupplyrequest`
--

CREATE TABLE `tb_addsupplyrequest` (
  `supid` int(11) NOT NULL,
  `supname` varchar(50) NOT NULL,
  `supconno` varchar(15) NOT NULL,
  `supsection` varchar(50) NOT NULL,
  `supphno` varchar(10) NOT NULL,
  `suppurpose` varchar(100) NOT NULL,
  `supstatus` enum('0','1','2') NOT NULL,
  `suppaymentstatus` enum('0','1') NOT NULL,
  `supdate` date NOT NULL,
  `fdate` varchar(50) DEFAULT NULL,
  `tdate` varchar(50) DEFAULT NULL,
  `tdays` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `loginid` int(11) NOT NULL,
  `supkey` varchar(8) NOT NULL,
  `delstatus` enum('0','1') NOT NULL,
  `supfeedback` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_addsupplyrequest`
--

INSERT INTO `tb_addsupplyrequest` (`supid`, `supname`, `supconno`, `supsection`, `supphno`, `suppurpose`, `supstatus`, `suppaymentstatus`, `supdate`, `fdate`, `tdate`, `tdays`, `total`, `loginid`, `supkey`, `delstatus`, `supfeedback`) VALUES
(1, 'Stella M Thomas', '4181810607483', 'Mundakayam [5302]', '9645234567', 'Agriculture Works', '1', '1', '2021-06-06', '2021-06-09', '2021-06-11', '2', '290', 6, '7066a1eb', '0', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bill`
--

CREATE TABLE `tb_bill` (
  `id` int(11) NOT NULL,
  `billkey` varchar(8) NOT NULL,
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
  `staffid` int(11) NOT NULL,
  `engid` int(11) NOT NULL,
  `nonstatus` enum('0','1','','') NOT NULL DEFAULT '0',
  `meterfile` varchar(255) DEFAULT NULL,
  `approvestatus` enum('0','1','2','3') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bill`
--

INSERT INTO `tb_bill` (`id`, `billkey`, `billdate`, `duedate`, `dcdate`, `initialread`, `finalread`, `unitsused`, `fixedcharge`, `energycharge`, `total`, `consumerno`, `phno`, `status`, `staffid`, `engid`, `nonstatus`, `meterfile`, `approvestatus`) VALUES
(1, '7d412c32', '2021-06-06', '2021-06-10', '2021-06-17', '34567', '34667', '100', '120', '8', '920', '4181810607483', '9645234567', '1', 8, 7, '0', NULL, '0'),
(3, '005779e4', '2021-06-06', '2021-07-10', '2021-06-17', '34667', '34777', '110', '120', '8', '1000', '4181810607483', '9645234567', '1', 8, 7, '1', 'IMG_20210530_094523 (1) (1) (2).jpg', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_billpayreport`
--

CREATE TABLE `tb_billpayreport` (
  `payid` int(11) NOT NULL,
  `paykey` varchar(10) NOT NULL,
  `paydate` date NOT NULL,
  `payamt` float NOT NULL,
  `payconno` varchar(20) NOT NULL,
  `payphno` varchar(10) NOT NULL,
  `paybillkey` varchar(10) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_billpayreport`
--

INSERT INTO `tb_billpayreport` (`payid`, `paykey`, `paydate`, `payamt`, `payconno`, `payphno`, `paybillkey`, `loginid`) VALUES
(1, 'fbbd481c65', '2006-06-21', 920, '4181810607483', '9645234567', '7d412c32', 7),
(2, 'b1f757f42c', '2006-06-21', 1000, '4181810607483', '9645234567', '005779e4', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_card`
--

CREATE TABLE `tb_card` (
  `cid` int(11) NOT NULL,
  `ckey` varchar(10) NOT NULL,
  `cno` varchar(16) NOT NULL,
  `ccvc` varchar(3) NOT NULL,
  `cexp` date NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cbal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `feedback` varchar(100) DEFAULT NULL,
  `cutype` enum('0','1','2') NOT NULL DEFAULT '0',
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_complaints`
--

INSERT INTO `tb_complaints` (`id`, `name`, `section`, `comtype`, `phno`, `comdesc`, `status`, `trackid`, `curdate`, `feedback`, `cutype`, `loginid`) VALUES
(1, '', 'Mundakayam [5302]', 'Cable Broken', '7867878988', 'Post broken at 16th mile.', '1', 'ae180f50', '2021-06-06', 'correct it soon.', '2', 6),
(2, 'Stella M Thomas', 'Mundakayam [5302]', 'No Power Supply', '9756767777', 'Power supply is not in my house for the last 3hours.', '1', '48a3e3fb', '2021-06-06', 'Okay, correct it soon. Please wait.', '0', 6),
(3, '', 'Mundakayam [5302]', 'Voltage High/Low', '', 'Voltage fluctuation in this region.', '0', 'f6466735', '2021-06-06', NULL, '1', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_connectionreg`
--

CREATE TABLE `tb_connectionreg` (
  `connid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `district` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `supplytype` varchar(20) NOT NULL,
  `totalloads` varchar(10) NOT NULL,
  `category` varchar(20) NOT NULL,
  `aadhar` varchar(20) NOT NULL,
  `aadharfile` varchar(100) NOT NULL,
  `filekey` varchar(8) NOT NULL,
  `curdate` date NOT NULL,
  `feedback` varchar(100) DEFAULT NULL,
  `pnch` varchar(100) NOT NULL,
  `vlg` varchar(100) NOT NULL,
  `ward` varchar(100) NOT NULL,
  `hno` varchar(10) NOT NULL,
  `tlk` varchar(50) NOT NULL,
  `rtncard` varchar(10) NOT NULL,
  `status` enum('0','1','2','3','4','5') NOT NULL,
  `loginid` int(11) NOT NULL,
  `conno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_connectionreg`
--

INSERT INTO `tb_connectionreg` (`connid`, `fname`, `lname`, `email`, `address`, `gender`, `phno`, `district`, `section`, `pincode`, `supplytype`, `totalloads`, `category`, `aadhar`, `aadharfile`, `filekey`, `curdate`, `feedback`, `pnch`, `vlg`, `ward`, `hno`, `tlk`, `rtncard`, `status`, `loginid`, `conno`) VALUES
(1, 'Stella', 'M Thomas', 'stellamthomas1997@gmail.com', 'Muthuplackal House', 'Female', '9645234567', 'Idukki', 'Mundakayam [5302]', '567890', '3 Phase', '1200', 'Commercial', '944171397888', 'KSEBLive_Abstract_New.pdf', '92c48265', '2006-06-21', 'Approved - Consumer# Generated', 'Mundakayam', 'Mundakayam', '2', '12', 'Mundakayam', 'APL', '4', 7, '4181810607483');

-- --------------------------------------------------------

--
-- Table structure for table `tb_connotify`
--

CREATE TABLE `tb_connotify` (
  `connotid` int(11) NOT NULL,
  `conno` varchar(15) NOT NULL,
  `connotkey` varchar(8) NOT NULL,
  `connotdesc` varchar(200) NOT NULL,
  `connotdate` date NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_connotify`
--

INSERT INTO `tb_connotify` (`connotid`, `conno`, `connotkey`, `connotdesc`, `connotdate`, `loginid`) VALUES
(1, '4181810607483', '7628e324', 'Please pay the bill on or before DC date.', '2006-06-21', 7);

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
(1, 'Stella', 'M Thomas', 'Muthuplackal House', '9562781951', 'Female', 'Idukki', '695614', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_engineerreg`
--

CREATE TABLE `tb_engineerreg` (
  `engid` int(11) NOT NULL,
  `engkey` varchar(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `district` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `curdate` date NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_engineerreg`
--

INSERT INTO `tb_engineerreg` (`engid`, `engkey`, `fname`, `lname`, `address`, `gender`, `phno`, `district`, `section`, `pincode`, `curdate`, `loginid`) VALUES
(1, '31c3079ca9', 'Thomas', 'Terance', 'Thomas Vill', 'Male', '9876567898', 'Idukki', 'Mundakayam [5302]', '567890', '2006-06-21', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jobs`
--

CREATE TABLE `tb_jobs` (
  `jid` int(11) NOT NULL,
  `jkey` varchar(10) NOT NULL,
  `jtitle` varchar(50) NOT NULL,
  `jqual` varchar(50) NOT NULL,
  `jsalary` varchar(20) NOT NULL,
  `jdesc` varchar(100) NOT NULL,
  `jdistrict` varchar(30) NOT NULL,
  `jsection` varchar(50) NOT NULL,
  `jcurdate` date NOT NULL,
  `jlastdate` date NOT NULL,
  `jtotvacancy` int(11) NOT NULL,
  `jfeedback` varchar(150) NOT NULL,
  `jstatus` enum('0','1','2','3','4') NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_linemanreg`
--

CREATE TABLE `tb_linemanreg` (
  `lmid` int(11) NOT NULL,
  `lmkey` varchar(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `district` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `curdate` date NOT NULL,
  `engid` int(11) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_linemanreg`
--

INSERT INTO `tb_linemanreg` (`lmid`, `lmkey`, `fname`, `lname`, `address`, `gender`, `phno`, `district`, `section`, `pincode`, `curdate`, `engid`, `loginid`) VALUES
(1, '2b8bda35ea', 'Lineman', 'A', 'Lineman Vill', 'Male', '7867676767', 'Idukki', 'Mundakayam [5302]', '567890', '2006-06-21', 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `utype` enum('0','1','2','3','4') NOT NULL,
  `otpstatus` enum('0','1') NOT NULL,
  `delstatus` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `password`, `status`, `utype`, `otpstatus`, `delstatus`) VALUES
(1, 'admin@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '0', '0', '0'),
(6, 'stellamthomas1997@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '1', '1', '0'),
(7, 'stellamthomas2021@mca.ajce.in', '751cb3f4aa17c36186f4856c8982bf27', '1', '2', '1', '0'),
(8, 'staff@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '3', '1', '0'),
(9, 'lineman@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '4', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_meterchangerequest`
--

CREATE TABLE `tb_meterchangerequest` (
  `mid` int(11) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `mconno` varchar(20) NOT NULL,
  `msection` varchar(50) NOT NULL,
  `mphno` varchar(10) NOT NULL,
  `mpurpose` varchar(100) NOT NULL,
  `mstatus` enum('0','1','2') NOT NULL,
  `mdate` date NOT NULL,
  `loginid` int(11) NOT NULL,
  `mkey` char(8) NOT NULL,
  `delstatus` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_meterchangerequest`
--

INSERT INTO `tb_meterchangerequest` (`mid`, `mname`, `mconno`, `msection`, `mphno`, `mpurpose`, `mstatus`, `mdate`, `loginid`, `mkey`, `delstatus`) VALUES
(1, 'Stella M Thomas', '4181810607483', 'Mundakayam [5302]', '9645234567', 'Meter not working.', '2', '2021-06-06', 6, '77f9c185', '1'),
(2, 'Stella M Thomas', '4181810607483', 'Mundakayam [5302]', '9645023651', 'Meter not working properly.', '1', '2021-06-06', 6, '34f7dff6', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_noncontactbill`
--

CREATE TABLE `tb_noncontactbill` (
  `conbillid` int(11) NOT NULL,
  `conno` varchar(13) NOT NULL,
  `conbillkey` varchar(8) NOT NULL,
  `constatus` enum('0','1','2','3') NOT NULL,
  `username` varchar(50) NOT NULL,
  `curdate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_noncontactbill`
--

INSERT INTO `tb_noncontactbill` (`conbillid`, `conno`, `conbillkey`, `constatus`, `username`, `curdate`) VALUES
(1, '4181810607483', '644d84cd', '1', 'stellamthomas1997@gmail.com', '06 Jun 2021'),
(2, '4181810607483', '005779e4', '3', 'stellamthomas1997@gmail.com', '06 Jun 2021');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notify`
--

CREATE TABLE `tb_notify` (
  `notid` int(11) NOT NULL,
  `notkey` varchar(8) NOT NULL,
  `notdesc` varchar(100) NOT NULL,
  `notdate` date NOT NULL,
  `notstatus` enum('0','1','2') DEFAULT NULL,
  `isview` enum('0','1') NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_notify`
--

INSERT INTO `tb_notify` (`notid`, `notkey`, `notdesc`, `notdate`, `notstatus`, `isview`, `loginid`) VALUES
(1, 'fe15cb7a', 'Pay the bills as early as possible before DC Date.', '2006-06-21', '0', '1', 7),
(2, '39cf4182', '20W CFL Bulbs at 90rs.', '2006-06-21', '1', '1', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_staffreg`
--

CREATE TABLE `tb_staffreg` (
  `staffid` int(11) NOT NULL,
  `staffkey` varchar(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `district` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `curdate` date NOT NULL,
  `engid` int(11) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_staffreg`
--

INSERT INTO `tb_staffreg` (`staffid`, `staffkey`, `fname`, `lname`, `address`, `gender`, `phno`, `district`, `section`, `pincode`, `curdate`, `engid`, `loginid`) VALUES
(1, 'ffced0da8e', 'Staff', 'A', 'Staff Bhavan', 'Female', '9645234568', 'Idukki', 'Mundakayam [5302]', '123456', '2006-06-21', 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_work`
--

CREATE TABLE `tb_work` (
  `wkid` int(11) NOT NULL,
  `wkkey` varchar(10) NOT NULL,
  `wktitle` varchar(100) NOT NULL,
  `wkdesc` varchar(255) NOT NULL,
  `wkdate` varchar(100) NOT NULL,
  `wkstatus` enum('0','1','2','3') NOT NULL,
  `staffid` int(11) NOT NULL,
  `engid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_work`
--

INSERT INTO `tb_work` (`wkid`, `wkkey`, `wktitle`, `wkdesc`, `wkdate`, `wkstatus`, `staffid`, `engid`) VALUES
(1, 'd083e3cea5', 'Cable Broken', 'Cable broken at mundakayam.', '06-06-21', '2', 8, 7),
(2, 'fd1354895a', 'Line Broken', 'At mundakayam town.', '06-06-21', '2', 9, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_addsupplyreport`
--
ALTER TABLE `tb_addsupplyreport`
  ADD PRIMARY KEY (`rpid`);

--
-- Indexes for table `tb_addsupplyrequest`
--
ALTER TABLE `tb_addsupplyrequest`
  ADD PRIMARY KEY (`supid`);

--
-- Indexes for table `tb_bill`
--
ALTER TABLE `tb_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_billpayreport`
--
ALTER TABLE `tb_billpayreport`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `tb_card`
--
ALTER TABLE `tb_card`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tb_complaints`
--
ALTER TABLE `tb_complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_connectionreg`
--
ALTER TABLE `tb_connectionreg`
  ADD PRIMARY KEY (`connid`);

--
-- Indexes for table `tb_connotify`
--
ALTER TABLE `tb_connotify`
  ADD PRIMARY KEY (`connotid`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_engineerreg`
--
ALTER TABLE `tb_engineerreg`
  ADD PRIMARY KEY (`engid`);

--
-- Indexes for table `tb_jobs`
--
ALTER TABLE `tb_jobs`
  ADD PRIMARY KEY (`jid`);

--
-- Indexes for table `tb_linemanreg`
--
ALTER TABLE `tb_linemanreg`
  ADD PRIMARY KEY (`lmid`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_meterchangerequest`
--
ALTER TABLE `tb_meterchangerequest`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `tb_noncontactbill`
--
ALTER TABLE `tb_noncontactbill`
  ADD PRIMARY KEY (`conbillid`);

--
-- Indexes for table `tb_notify`
--
ALTER TABLE `tb_notify`
  ADD PRIMARY KEY (`notid`);

--
-- Indexes for table `tb_staffreg`
--
ALTER TABLE `tb_staffreg`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `tb_work`
--
ALTER TABLE `tb_work`
  ADD PRIMARY KEY (`wkid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_addsupplyreport`
--
ALTER TABLE `tb_addsupplyreport`
  MODIFY `rpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_addsupplyrequest`
--
ALTER TABLE `tb_addsupplyrequest`
  MODIFY `supid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_bill`
--
ALTER TABLE `tb_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_billpayreport`
--
ALTER TABLE `tb_billpayreport`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_card`
--
ALTER TABLE `tb_card`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_complaints`
--
ALTER TABLE `tb_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_connectionreg`
--
ALTER TABLE `tb_connectionreg`
  MODIFY `connid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_connotify`
--
ALTER TABLE `tb_connotify`
  MODIFY `connotid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_engineerreg`
--
ALTER TABLE `tb_engineerreg`
  MODIFY `engid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jobs`
--
ALTER TABLE `tb_jobs`
  MODIFY `jid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_linemanreg`
--
ALTER TABLE `tb_linemanreg`
  MODIFY `lmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_meterchangerequest`
--
ALTER TABLE `tb_meterchangerequest`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_noncontactbill`
--
ALTER TABLE `tb_noncontactbill`
  MODIFY `conbillid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_notify`
--
ALTER TABLE `tb_notify`
  MODIFY `notid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_staffreg`
--
ALTER TABLE `tb_staffreg`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_work`
--
ALTER TABLE `tb_work`
  MODIFY `wkid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
