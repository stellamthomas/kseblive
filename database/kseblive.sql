-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 08:20 AM
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
(2, 'a0fd46ab', '2019-03-21', 200, '5ce2322d', 99),
(3, 'cf1929a7', '2024-03-21', 200, '5ce2322d', 99),
(4, '579414ac', '2021-04-21', 200, '12dea908', 99),
(5, '40fe4087', '2021-04-21', 200, '12dea908', 99);

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
  `loginid` int(11) NOT NULL,
  `supkey` varchar(8) NOT NULL,
  `delstatus` enum('0','1') NOT NULL,
  `supfeedback` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_addsupplyrequest`
--

INSERT INTO `tb_addsupplyrequest` (`supid`, `supname`, `supconno`, `supsection`, `supphno`, `suppurpose`, `supstatus`, `suppaymentstatus`, `supdate`, `loginid`, `supkey`, `delstatus`, `supfeedback`) VALUES
(3, 'Stella M', '1234567891234', 'Mundakayam [5302]', '9645023651', 'Needed for welding gates.', '2', '0', '2021-03-19', 99, '5ce2322d', '1', 'Not giving permission now.'),
(5, 'Stella M', '1234567891234', 'Mundakayam [5302]', '9645023651', 'Hellooo', '1', '1', '2021-04-21', 99, '12dea908', '0', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bill`
--

CREATE TABLE `tb_bill` (
  `id` int(11) NOT NULL,
  `billkey` varchar(10) NOT NULL,
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

INSERT INTO `tb_bill` (`id`, `billkey`, `billdate`, `duedate`, `dcdate`, `initialread`, `finalread`, `unitsused`, `fixedcharge`, `energycharge`, `total`, `consumerno`, `phno`, `status`, `loginid`) VALUES
(1, 'f7c58712bd', '2020-10-01', '2020-11-01', '2020-11-25', '1545', '1645', '100', '120', '8', '800', '2448283865927', '9562781951', '1', 12),
(2, 'aa01813e19', '2021-03-04', '2021-03-11', '2021-03-10', '1111', '1222', '1345', '120', '8', '200', '2448283865928', '9562781951', '1', 13);

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
(15, 'af5639a02d', '2019-03-21', 800, '2448283865927', '9562781951', 'f7c58712bd', 99),
(16, '3811d566e7', '2019-03-21', 200, '2448283865927', '9562781951', 'aa01813e19', 99),
(17, '3bc170c807', '2024-03-21', 800, '2448283865927', '9562781951', 'f7c58712bd', 99),
(18, '29a1168f36', '2024-03-21', 200, '2448283865927', '9562781951', 'aa01813e19', 99),
(19, 'a85d84535f', '2024-03-21', 200, '2448283865927', '9562781951', 'aa01813e19', 99),
(20, 'd5f44083c7', '2024-03-21', 800, '2448283865928', '9562781951', 'f7c58712bd', 0),
(21, '9b05d6a02a', '2024-03-21', 800, '2448283865928', '9562781951', 'f7c58712bd', 0),
(22, '0805b74088', '2024-03-21', 800, '2448283865928', '9562781951', 'f7c58712bd', 99),
(23, 'b6bb1a7502', '2024-03-21', 200, '2448283865928', '9562781951', 'aa01813e19', 99),
(24, '467bd7919a', '2024-03-21', 800, '2448283865928', '9562781951', 'f7c58712bd', 101);

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

--
-- Dumping data for table `tb_card`
--

INSERT INTO `tb_card` (`cid`, `ckey`, `cno`, `ccvc`, `cexp`, `cname`, `cbal`) VALUES
(1, 'aa01813e19', '1234123412341234', '123', '2023-03-29', 'Stella M Thomas', 49800);

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
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_complaints`
--

INSERT INTO `tb_complaints` (`id`, `name`, `section`, `comtype`, `phno`, `comdesc`, `status`, `trackid`, `curdate`, `feedback`, `loginid`) VALUES
(32, 'Stella M', '001 - Mundakayam', 'No Power Supply', '9562781951', 'reason?', '0', '02b493a4', '2021-01-27', 'okay will come soon.', 85);

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
  `status` enum('0','1','2','3','4','5') NOT NULL,
  `loginid` int(11) NOT NULL,
  `conno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_connectionreg`
--

INSERT INTO `tb_connectionreg` (`connid`, `fname`, `lname`, `email`, `address`, `gender`, `phno`, `district`, `section`, `pincode`, `supplytype`, `totalloads`, `category`, `aadhar`, `aadharfile`, `filekey`, `curdate`, `feedback`, `status`, `loginid`, `conno`) VALUES
(44, 'Stella', 'M', 'stellamthomas2021@mca.ajce.in', 'Muthuplackal House', 'Male', '9645023651', 'Idukki', 'Mundakayam [5302]', '695614', '3 Phase', '1200', 'Agriculture', '944171304193', 'config.inc.php.SAMPLE', '1dfed7b0', '2021-04-21', 'Approved - Consumer# Generated', '4', 101, '2448283865927'),
(46, 'Abhishek', 'A', 'stellamthomas2021@mca.ajce.in', 'Abhi Bhavan', 'Male', '9645023651', 'Kottayam', 'Mundakayam [5302]', '695614', '3 Phase', '2200', 'Commercial', '944171304192', 'captcha.html', '2ec2de88', '2022-04-21', 'Approved - Consumer# Generated', '4', 101, '2448283865928'),
(47, 'Stella', 'M Thomas', 'stellamthomas2021@mca.ajce.in', 'Muthuplackal House', 'Female', '9645000000', 'Idukki', 'Mundakayam [5302]', '695614', '1 Phase', '1200', 'Commercial', '944171304193', 'captcha.html', '97fefcf6', '2022-04-21', 'Approve soon.\r\n', '2', 101, NULL);

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
(11, '2448283865927', '41abc008', 'CFL 50$ for 1.', '2022-04-21', 101),
(12, '2448283865928', 'a30ea94e', '20CFL Bulbs @ 50$ each. Ofer Avilable on 21 April 2021', '2022-04-21', 101);

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
(65, 'Stella', 'M Thomas', 'muthuplackal', '9562781951', 'Female', 'Kollam', '685509', 99);

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
(22, 'aa01813e19', 'biju', 'nilavelil', 'nilavelil', 'Male', '7098675467', 'Kottayam', 'Kuttikanam [5303]', '685509', '2030-01-21', 98),
(24, 'f87ebddbac', 'thomas', 'ms', 'Muthuplackal House', 'Male', '9562781951', 'Idukki', 'Mundakayam [5302]', '685509', '2030-01-21', 101);

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

--
-- Dumping data for table `tb_jobs`
--

INSERT INTO `tb_jobs` (`jid`, `jkey`, `jtitle`, `jqual`, `jsalary`, `jdesc`, `jdistrict`, `jsection`, `jcurdate`, `jlastdate`, `jtotvacancy`, `jfeedback`, `jstatus`, `loginid`) VALUES
(1, 'ajI36792DD', 'Driver', 'Heavy Driving Licence', '1000/day', 'Need 24*7 Availability', 'Idukki', 'Kuttikanam [5303]	', '2020-11-24', '2020-12-10', 2, 'Not Possible.', '2', 35);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `utype` enum('0','1','2','3') NOT NULL,
  `otpstatus` enum('0','1') NOT NULL,
  `delstatus` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `password`, `status`, `utype`, `otpstatus`, `delstatus`) VALUES
(20, 'admin@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '0', '1', '0'),
(99, 'stellamthomas1997@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '1', '1', '0'),
(101, 'stellamthomas2021@mca.ajce.in', '751cb3f4aa17c36186f4856c8982bf27', '1', '2', '1', '0'),
(105, 'staff1@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', '1', '3', '1', '0');

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
(6, 'Stella M Thomas', '1234567891234', '001 - Mundakayam', '9562781951', 'gate', '1', '2021-04-21', 99, '6fb70cf9', '1');

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
(2, 'ajy84jf7', 'Pay bills as soon as possible', '2021-03-19', '1', '1', 99),
(4, 'ayuxhuyr', 'CFL bulls available at 50$', '2021-03-19', '0', '1', 99),
(5, 'fd066953', 'Bill pay as soon as possible', '2021-04-22', '0', '1', 101),
(6, '38922f21', 'April 31 Public Holiday', '2022-04-21', '2', '1', 101),
(7, '4a720e47', 'Pay bills of april before 30 April.', '2022-04-21', '1', '1', 101),
(8, 'f24e707a', 'April 31 - Working Day for All.', '2022-04-21', '2', '1', 101);

-- --------------------------------------------------------

--
-- Table structure for table `tb_staffreg`
--

CREATE TABLE `tb_staffreg` (
  `staffid` int(11) NOT NULL DEFAULT 0,
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
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_staffreg`
--

INSERT INTO `tb_staffreg` (`staffid`, `staffkey`, `fname`, `lname`, `address`, `gender`, `phno`, `district`, `section`, `pincode`, `curdate`, `loginid`) VALUES
(1, '4d92af1cf7', 'Staff', '1', 'Staff1 Villa', 'Male', '9645000000', 'Idukki', 'Mundakayam [5302]', '695614', '2021-04-21', 105);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_addsupplyreport`
--
ALTER TABLE `tb_addsupplyreport`
  MODIFY `rpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_addsupplyrequest`
--
ALTER TABLE `tb_addsupplyrequest`
  MODIFY `supid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_bill`
--
ALTER TABLE `tb_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_billpayreport`
--
ALTER TABLE `tb_billpayreport`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_card`
--
ALTER TABLE `tb_card`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_complaints`
--
ALTER TABLE `tb_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_connectionreg`
--
ALTER TABLE `tb_connectionreg`
  MODIFY `connid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_connotify`
--
ALTER TABLE `tb_connotify`
  MODIFY `connotid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tb_engineerreg`
--
ALTER TABLE `tb_engineerreg`
  MODIFY `engid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_jobs`
--
ALTER TABLE `tb_jobs`
  MODIFY `jid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tb_meterchangerequest`
--
ALTER TABLE `tb_meterchangerequest`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_notify`
--
ALTER TABLE `tb_notify`
  MODIFY `notid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
