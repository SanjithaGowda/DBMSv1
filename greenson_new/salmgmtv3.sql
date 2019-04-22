-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2019 at 08:23 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salmgmtv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `uname` varchar(20) NOT NULL,
  `paymentbal` float(10,2) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mob1` int(10) NOT NULL,
  `mob2` int(10) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`uname`, `paymentbal`, `name`, `gst`, `pwd`, `email`, `mob1`, `mob2`, `address`) VALUES
('google', 0.00, 'Alphabet', '1', '$2y$10$Rma8VZJJVcRf3sYEudymT.Bvs1Ih/74geH7EY7A0hI3XgDxLgTiNW', 'google@gmail.com', 2147483647, 0, 'paloalto'),
('surf', 1200.00, 'surf excel', '3', '$2y$10$ZaHmLS2BTQJTR9ehvsBGfeQvvLeh05k7SG1PI2N06qG8MfHvrhRoe', 'surf @ gmail.com', 673728, 0, 'india'),
('test', NULL, 'test', '646', '$2y$10$vPOe8I.h3dhhZ6WATOxFm.yyLOeaGPcT.ohhe2B5chX089KBa5tcm', 'preethamanw@gmail.com', 35354354, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `name` varchar(100) NOT NULL,
  `empid` int(20) NOT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `bsal` float(10,2) DEFAULT NULL,
  `ot` int(11) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`name`, `empid`, `uname`, `pwd`, `bsal`, `ot`, `image`) VALUES
('Glenda', 1, 'glenda', '$2y$10$VHzFZ0RFOvOrPdbgDYq4hOf0It5WQ9pOS5G.vEYpOMRWfa7eSgc1K', 5000.00, 10, 'empimg/01.jpg'),
('Vivian', 2, 'vivian', '$2y$10$MhDKS1UPznGqg.3FbeLFueOFFuyAfCHQtGsWt.QmELqOR2XiOudO.', 1000.00, 3, 'empimg/02.jpg'),
('Melissa', 3, 'melissa', '$2y$10$XhLfqHHU6x5fDvVdrAoLP.sxtpENWS9mCgx/0WF2Oq2YrpUZR36Wi', 5000.00, 1, 'empimg/03.jpg'),
('Juan', 4, 'juan', '$2y$10$NBI.5YkT.XasVVCWWEWUPOJOr9O/64sXkXV/7oQ5axMsNS7Uu2ram', 4000.00, 0, 'empimg/04.jpg'),
('Woodrow', 5, 'woodrow', '$2y$10$MQgoon5.9.pfgsU6.nf1dOJzsaC3gVPyn4el.hV1Xyd4eIbyvDFo6', 4200.00, 7, 'empimg/05.jpg'),
('Thomas', 6, 'thomas', '$2y$10$2PwGM99wPSiYbT9qgxdY7ezNnBo4LzVlTCjfkwLRyxSfjZxFEPgVC', 7000.00, 6, 'empimg/06.jpg'),
('Michael', 7, 'michael', '$2y$10$wRKWnpz8oKGQ5rtc.5yl5eZxrJ/Qt/LXCmVfcoJBfXKz.vV5iHFbu', 3800.00, 5, 'empimg/07.jpg'),
('Donald', 8, 'donald', '$2y$10$lmEh.siGd4k2mWfOv9cdgueEqA3gfHLs.rWGUj8OTZ9F8W92r7HTm', 2000.00, 10, 'empimg/08.jpg'),
('Ryan', 9, 'ryan', '$2y$10$XGpc2WWQU/Vz1MPvA7pm2eWmRxXAGnKkSgkGqvnwDxWsddCeWlFTC', 4600.00, 15, 'empimg/09.jpg'),
('Tommie', 10, 'tommie', '$2y$10$sys/fq5HCLbBlzsfaeJu2ODAhesQJwPmjXf3cJAU0rNsF4TIehyaS', 4500.00, 3, 'empimg/10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_pdts1`
--

CREATE TABLE `ordered_pdts1` (
  `pono` int(11) NOT NULL,
  `pid` int(5) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `finstage` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_pdts1`
--

INSERT INTO `ordered_pdts1` (`pono`, `pid`, `qty`, `finstage`) VALUES
(1, 4, 1, 'processing'),
(6, 1, 3, 'manufacturing'),
(6, 9, 1, 'manufacturing'),
(7, 1, 1, 'delivered'),
(8, 3, 1, 'processing'),
(9, 1, 1, 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `pono` int(11) NOT NULL,
  `cgst` varchar(20) DEFAULT NULL,
  `finished` int(11) DEFAULT NULL,
  `driverno` varchar(10) DEFAULT NULL,
  `ocost` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`pono`, `cgst`, `finished`, `driverno`, `ocost`) VALUES
(1, '1', 0, NULL, 10200.00),
(6, '1', 0, NULL, 93600.00),
(7, '3', 0, NULL, 1200.00),
(8, '3', 1, NULL, 1000.00),
(9, '3', 0, NULL, 1200.00);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `pwd` varchar(100) DEFAULT NULL,
  `uname` varchar(20) NOT NULL,
  `gst` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`pwd`, `uname`, `gst`) VALUES
('$2y$10$GR.el/wfqt0SBknUoLN34eUoTz7ozlaLwLjYO6Av7LTez9CYnkS7y', 'admin', '12121212');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(5) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pcost` float(10,2) NOT NULL,
  `qtyavail` int(11) NOT NULL,
  `pdesc` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pcost`, `qtyavail`, `pdesc`) VALUES
(1, 'clamps', 1200.00, 25, 'clamps'),
(2, 'silicon carbide heating elements', 10000.00, 8, 'silicon carbide heating elements'),
(3, 'HFK bricks', 1000.00, 12, 'HFK bricks'),
(4, 'gold melting graphite crucible', 10200.00, 17, 'gold melting graphite crucible'),
(5, 'silver melting graphite crucible', 10200.00, 10, 'silver melting graphite crucible'),
(6, 'Electrically operated gold multiple melting furnace', 175000.00, 13, 'Electrically operated gold multiple melting furnace'),
(7, 'L - Type thermocouple', 5000.00, 5, 'L - Type thermocouple'),
(8, 'Thermocouple cable (PtPtRh)', 200.00, 100, 'Thermocouple cable (PtPtRh)'),
(9, 'Oil fired furnace', 90000.00, 0, 'Oil fired furnace'),
(10, '150 kg Aluminium meltilng / holding furnace', 240000.00, 5, '150 kg Aluminium meltilng / holding furnace'),
(11, 'cruci', 2340.00, 12, 'it crucifies stuff');

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterials`
--

CREATE TABLE `rawmaterials` (
  `rid` int(5) NOT NULL,
  `rname` varchar(100) NOT NULL,
  `rcost` float(10,2) NOT NULL,
  `rqtyavail` int(11) NOT NULL,
  `sgst` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawmaterials`
--

INSERT INTO `rawmaterials` (`rid`, `rname`, `rcost`, `rqtyavail`, `sgst`) VALUES
(1, 'gear motor', 2400.00, 30, '01'),
(2, 'blower', 24000.00, 12, '01'),
(3, 'pumping elements', 48000.00, 4, '02'),
(4, 'fiberglass heaters', 9000.00, 5, '03'),
(5, 'PID controller', 8000.00, 2, '04'),
(6, 'temperature controller', 4500.00, 10, '05'),
(7, 'graphite mill board', 15000.00, 8, '06'),
(8, 'fvfv', 4.00, 4, '03');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `total_payment` float(10,2) NOT NULL,
  `sgst` varchar(20) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `saddr` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`total_payment`, `sgst`, `sname`, `saddr`) VALUES
(0.00, '01', 'Continental thermal', 'chennai'),
(0.00, '02', 'Mersen', 'Bommasandra'),
(0.00, '03', 'Abi Instruments', 'chennai'),
(0.00, '04', 'Mariton heaters', 'Hyderabad'),
(0.00, '05', 'Pavantranix', 'Magadi Road'),
(0.00, '06', 'San Process', 'Mathikere'),
(0.00, '07', 'Unipower', 'Bangalore'),
(0.00, '08', 'Alpha-tech', 'Jalahalli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`uname`),
  ADD UNIQUE KEY `gst` (`gst`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empid`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `ordered_pdts1`
--
ALTER TABLE `ordered_pdts1`
  ADD PRIMARY KEY (`pono`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`pono`),
  ADD KEY `cgst` (`cgst`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pname` (`pname`);

--
-- Indexes for table `rawmaterials`
--
ALTER TABLE `rawmaterials`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `sgst` (`sgst`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sgst`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `pono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordered_pdts1`
--
ALTER TABLE `ordered_pdts1`
  ADD CONSTRAINT `ordered_pdts1_ibfk_1` FOREIGN KEY (`pono`) REFERENCES `orders` (`pono`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordered_pdts1_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cgst`) REFERENCES `customer` (`gst`) ON DELETE CASCADE;

--
-- Constraints for table `rawmaterials`
--
ALTER TABLE `rawmaterials`
  ADD CONSTRAINT `rawmaterials_ibfk_1` FOREIGN KEY (`sgst`) REFERENCES `supplier` (`sgst`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
