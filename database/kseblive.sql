-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 05:30 PM
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
(1, '24a8fbfa', '2002-06-21', 200, '19994254', 3);

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
(1, 'Thomas S', '1234567890123', 'Mundakayam [5302]', '9562781951', 'House Construction', '1', '1', '2021-06-02', '2021-06-03', '2021-06-04', '2', '200', 3, '19994254', '0', 'Approved');

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
(1, 'ba331356', '2021-06-02', '2021-06-08', '2021-06-15', '12000', '12050', '50', '120', '8', '520', '1234567890123', '9562781951', '1', 4, 2, '0', NULL, '0'),
(2, '454d23cd', '2021-06-02', '2021-07-15', '2021-07-22', '12050', '12050', '0', '120', '8', '0', '1234567890123', '9562781951', '0', 4, 2, '1', 'IMG_20210530_094523 (1).jpg', '3'),
(3, 'e01d67dd', '2021-06-02', '2021-06-22', '2021-06-29', '12050', '12150', '100', '120', '8', '920', '1234567890123', '9562781951', '1', 4, 2, '1', 'IMG_20210530_094523 (1) (1).jpg', '2');

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
(1, '557e3f3912', '2002-06-21', 520, '7757349068491', '9562781951', 'ba331356', 3),
(2, '8e37a55b12', '2002-06-21', 920, '1234567890123', '9562781951', 'e01d67dd', 3);

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
(1, '', 'Mundakayam [5302]', 'Cable Broken', '9562781951', 'Cable broken at mundakyam town.', '1', 'a7382067', '2021-06-02', 'Okay. will come in 15minutes.', '2', 3),
(2, 'Stella M Thomas', 'Mundakayam [5302]', 'No Power Supply', '9562781951', 'Power supply is not here for the last 2 hours.', '1', '37ec0a66', '2021-06-02', 'Transformer Changing is going on, It will come after 3hours.', '0', 3),
(3, '', 'Mundakayam [5302]', 'Voltage High/Low', '', 'Voltage fluctuation is there.', '0', '88cd5a8b', '2021-06-02', NULL, '1', 3);

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
(1, 'Stella', 'M Thomas', 'stellamthomas1997@gmail.com', 'Muthuplackal House', 'Female', '9562781951', 'Idukki', 'Mundakayam [5302]', '456546', '1 Phase', '1200', 'Industrial', '944171304356', 'KSEBLive_Abstract_New.pdf', 'e506f465', '2002-06-21', 'Approved - Consumer# Generated', 'Mundakayam', 'Mundakayam', '2', '12', 'Mundakayam', 'BPL', '4', 2, '1234567890123');

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
(1, '1234567890123', '161c406a', 'Please upload the electricity bill details picture and last reading to get your new bill.', '2002-06-21', 2);

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
(1, 'Stell', 'M Thomas', 'Muthuplackal House, Chelimada, Kumily PO', '9562781951', 'Female', 'Idukki', '456546', 3);

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
(1, '40fe4b5fdd', 'Thomas', 'Terance', 'Thomas Villa,Mundakayam,Idukki', 'Male', '9645121787', 'Idukki', 'Mundakayam [5302]', '345456', '2002-06-21', 2);

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
(1, 'cada46db8b', 'Abhishek', 'A', 'Abhi Villa', 'Male', '9645234567', 'Idukki', 'Mundakayam [5302]', '456546', '2002-06-21', 2, 5);

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
(2, 'stellamthomas2021@mca.ajce.in', '751cb3f4aa17c36186f4856c8982bf27', '1', '2', '1', '0'),
(3, 'stellamthomas1997@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '1', '1', '0'),
(4, 'namithastaff@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '3', '1', '0'),
(5, 'abhisheklineman@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '4', '1', '0');

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
(2, 'Stella M Thomas', '1234567890123', 'Mundakayam [5302]', '9562781951', 'Meter not working properly.', '2', '2021-06-02', 3, '84c840c4', '1');

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
(1, '7757349068491', '454d23cd', '1', 'stellamthomas1997@gmail.com', '02 Jun 2021'),
(2, '7757349068491', 'e01d67dd', '3', 'stellamthomas1997@gmail.com', '02 Jun 2021');

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
(1, '4dddaa5e', 'Please pay the bill as early as possible, before the disconnection date.', '2002-06-21', '0', '1', 2),
(2, '30db991c', '20W CFL Bulbs at 100Rs.', '2002-06-21', '1', '1', 2);

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
(1, '8db7a5bc49', 'Namitha', 'P', 'Namitha Villa', 'Female', '9087678909', 'Idukki', 'Mundakayam [5302]', '456546', '2002-06-21', 2, 4);

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
(1, '9a46764c69', 'Add Bills', 'Add Bills to all consumers for the month june 2021', '02-06-21', '2', 4, 2),
(2, '777a7a8361', 'Cable Broken', 'Cable broken in mundakyam town. Correct it soon.', '02-06-21', '2', 5, 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
