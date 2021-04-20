-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2016 at 10:09 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transport`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id_car` int(8) NOT NULL,
  `licenceplates` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ทะเบียนรถ',
  `typecar` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ประเภทรถบรรทุก',
  `typefule` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชนิดเชื้อเพลิง',
  `status` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id_car`, `licenceplates`, `typecar`, `typefule`, `status`) VALUES
(2, 'กว 1122', 'เทเล่อ', 'NGV', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(10) NOT NULL,
  `namecustomer` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อลุกค้า',
  `address` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ที่อยู่',
  `phonenumber` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `status` int(4) DEFAULT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `namecustomer`, `address`, `phonenumber`, `status`) VALUES
(1, 'นายพิทยา  วงสกด', 'คลองใหญ่ ตราด', '0894841471', 1);

-- --------------------------------------------------------

--
-- Table structure for table `distance`
--

CREATE TABLE `distance` (
  `ID_DIS` int(12) NOT NULL,
  `shipping_cus` int(4) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `placecar` int(4) DEFAULT NULL COMMENT 'โรงงานที่จัดส่ง',
  `distance` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ระยะทางจัดส่ง',
  `ratefule` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'อัตราเชื้อเพลิง',
  `allowance1` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ค่าเบี้ยเลี้ยงเที่ยววิ่ง1',
  `allowance2` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ค่าเบี้ยเลี้ยงเที่ยววิ่ง2',
  `status` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `distance`
--

INSERT INTO `distance` (`ID_DIS`, `shipping_cus`, `placecar`, `distance`, `ratefule`, `allowance1`, `allowance2`, `status`) VALUES
(1, 1, 2, '100 กิโล', '50 ลิตร', '500', '700', '1');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id_driver` int(8) NOT NULL,
  `namedriver1` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อคนขับ',
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id_driver`, `namedriver1`, `status`) VALUES
(1, 'นาย ใจดี จริงใจ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fule`
--

CREATE TABLE `fule` (
  `id_fule` int(4) NOT NULL,
  `typefule` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชนิดเชื้อเพลิง',
  `price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `datenew` date DEFAULT NULL COMMENT 'วันที่ปรับราคา',
  `stastus` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insertdatawarehouse`
--

CREATE TABLE `insertdatawarehouse` (
  `IDwarehouse` int(16) NOT NULL,
  `invoicedsales` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT 'เลขที่ใบสั่งขาย',
  `taxinvoice` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เลขที่ใบกำกับภาษี',
  `slipinvoice` int(30) DEFAULT NULL COMMENT 'เลขที่ใบโอน',
  `customers` int(8) DEFAULT NULL COMMENT 'ลูกค้า',
  `Sendlocation` int(36) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `start` int(10) DEFAULT NULL COMMENT 'สถานที่เริ่มจัดส่ง',
  `datetimeout` date DEFAULT NULL COMMENT 'วันที่ส่งของ',
  `Posttime` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เวลาที่ส่งของ',
  `Orders` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รายการสินค้า',
  `counts` float DEFAULT NULL COMMENT 'จำนวน',
  `dateimport` date DEFAULT NULL COMMENT 'วันที่นำเข้าข้อมูล',
  `status` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะ 1 ยัง 2 รับแล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `insertdatawarehouse`
--

INSERT INTO `insertdatawarehouse` (`IDwarehouse`, `invoicedsales`, `taxinvoice`, `slipinvoice`, `customers`, `Sendlocation`, `start`, `datetimeout`, `Posttime`, `Orders`, `counts`, `dateimport`, `status`) VALUES
(1, '123456', '654321', 7890, 1, 1, 2, '2016-07-21', '12.00', 'ไม้อัด', 4, '2016-07-21', '1'),
(2, '123456', '654321', 7890, 1, 1, 2, '2016-07-22', '12.00', 'ไม้อัด', 4, '2016-07-21', '1');

-- --------------------------------------------------------

--
-- Table structure for table `insertdata_transport`
--

CREATE TABLE `insertdata_transport` (
  `id_transport` int(16) NOT NULL,
  `id_warehouse` int(16) DEFAULT NULL COMMENT 'ข้อมูลคลังสินค้า',
  `nameDriver` int(4) DEFAULT NULL COMMENT 'คนขับรถ',
  `idcar` int(4) DEFAULT NULL COMMENT 'ทะเบียนรถ',
  `runperday` int(2) DEFAULT NULL COMMENT 'เที่ยววิ่ง',
  `status` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `insertdata_transport`
--

INSERT INTO `insertdata_transport` (`id_transport`, `id_warehouse`, `nameDriver`, `idcar`, `runperday`, `status`) VALUES
(1, 1, 1, 2, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `placecar`
--

CREATE TABLE `placecar` (
  `IDPLACE` int(12) NOT NULL,
  `Nameplace` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(144) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `placecar`
--

INSERT INTO `placecar` (`IDPLACE`, `Nameplace`, `status`) VALUES
(1, 'สระบุรี', '1'),
(2, 'บ้านบึง', '1'),
(3, 'โรงกาว', '1'),
(4, 'อื่นๆ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id_ship` int(8) NOT NULL,
  `id_cus` int(8) DEFAULT NULL,
  `detailship` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `statusship` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id_ship`, `id_cus`, `detailship`, `statusship`) VALUES
(1, 1, 'บ้านบึง', 1),
(2, 1, 'กรุงเทพ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `sidebar_id` int(4) NOT NULL,
  `sidebarName` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sidebarTarget` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sidebarShow` int(4) DEFAULT NULL,
  `sidebarHead` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sidebarHeaddetail` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`sidebar_id`, `sidebarName`, `sidebarTarget`, `sidebarShow`, `sidebarHead`, `sidebarHeaddetail`) VALUES
(1, 'คลังสินค้า', NULL, 1, '1', '1'),
(2, 'ลงข้อมูลคลังสินค้า', 'insertdatawarehouse', 1, '1', '2'),
(3, 'ขนส่งบุญพร', NULL, 1, '2', '1'),
(4, 'ลงข้อมูลการจัดรถ', 'insertdatatransport', 1, '2', '2'),
(5, 'เพิ่มชื่อลูกค้า', 'addcustomer', 1, '1', '3'),
(6, 'ชื่อคนขับรถ', 'addnamedriver', 1, '2', '4'),
(7, 'สถานที่จัดส่ง', 'addplace', 1, '1', '5'),
(8, 'ลงข้อมูลรถ', 'addInformationcar', 1, '2', '6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id_car`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `distance`
--
ALTER TABLE `distance`
  ADD PRIMARY KEY (`ID_DIS`),
  ADD KEY `customer` (`shipping_cus`),
  ADD KEY `placecar` (`placecar`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indexes for table `fule`
--
ALTER TABLE `fule`
  ADD PRIMARY KEY (`id_fule`);

--
-- Indexes for table `insertdatawarehouse`
--
ALTER TABLE `insertdatawarehouse`
  ADD PRIMARY KEY (`IDwarehouse`);

--
-- Indexes for table `insertdata_transport`
--
ALTER TABLE `insertdata_transport`
  ADD PRIMARY KEY (`id_transport`),
  ADD KEY `id_warehouse` (`id_warehouse`),
  ADD KEY `distancefreight` (`idcar`),
  ADD KEY `Outrunperday` (`runperday`),
  ADD KEY `chauffeur` (`nameDriver`);

--
-- Indexes for table `placecar`
--
ALTER TABLE `placecar`
  ADD PRIMARY KEY (`IDPLACE`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id_ship`),
  ADD KEY `id_cus` (`id_cus`);

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`sidebar_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id_car` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `distance`
--
ALTER TABLE `distance`
  MODIFY `ID_DIS` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id_driver` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fule`
--
ALTER TABLE `fule`
  MODIFY `id_fule` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `insertdatawarehouse`
--
ALTER TABLE `insertdatawarehouse`
  MODIFY `IDwarehouse` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `insertdata_transport`
--
ALTER TABLE `insertdata_transport`
  MODIFY `id_transport` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `placecar`
--
ALTER TABLE `placecar`
  MODIFY `IDPLACE` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id_ship` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `sidebar_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
