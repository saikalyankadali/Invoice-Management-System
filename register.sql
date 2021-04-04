-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2013 at 05:58 AM
-- Server version: 5.5.16
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `supermarket`
--

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `new_record` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `trn_date` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `des` varchar(100) NOT NULL,
   `amount` float(10) NOT NULL,
  `paid` float(10) NOT NULL,
  `balance` float(10) NOT NULL,
  `submittedby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `buy`
--

CREATE TABLE IF NOT EXISTS `buy` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` date NOT NULL,
  `pids` text NOT NULL,
  `total_amount` float(11) NOT NULL,
  `profit` float(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `pnames` text NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`purchase_id`, `purchase_date`, `pids`, `total_amount`, `profit`, `cid`,`pnames`,`first_name`, `last_name` ) VALUES
(1, '2012-11-02', '2,5,11',6250, 850, 1, 'dexter','Vikram', 'Singh'),
(2, '2012-11-02', '2,5,11,8', 7250, 950, 1, 'dexter','Vikram', 'Singh'),
(3, '2012-11-02', '8,5,1', 46120, 5120, 1,  'dexter','Vikram', 'Singh');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `cjoin_date` date NOT NULL,
  `cmoney_spent` int(11) NOT NULL,
  `caddress` varchar(50) NOT NULL,
  `cmoney_spent_reset` int(5) NOT NULL,
  `cphone` varchar(12) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cphone` (`cphone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `first_name`, `last_name`, `cjoin_date`, `cmoney_spent`, `caddress`, `cmoney_spent_reset`, `cphone`) VALUES
(1, 'Vikram', 'Singh', '2012-11-02', 36587, 'Plot #30, Gunrock Enclave, Sec', 0, 77229900),
(2, 'Rishab jain', 'Gupta', '2012-11-03', 100, 'Plot #12, Gandhi Nagar, Hyderabad', 0, 88337733),
(3, 'Pratik', 'Shah', '2012-11-03', 34243, 'Plot No 20, Hyderabad', 0, 44889933);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `manager_id` int(11) NOT NULL,
  `dept_id` int(5) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(40) NOT NULL,
  `manager_start_date` date NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`manager_id`, `dept_id`, `dept_name`, `manager_start_date`) VALUES
(1, 1, 'MEDICINE', '2020-04-01'),
(1, 2, 'FEED', '2020-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `salary` int(8) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `address` varchar(60) NOT NULL,
  `uid` int(11) NOT NULL,
  `join_date` date NOT NULL,
  `dob` date NOT NULL,
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `perks` int(11) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`first_name`, `last_name`, `id`, `dept_id`, `salary`, `phone_number`, `address`, `uid`, `join_date`, `dob`, `end_date`, `perks`, `admin`) VALUES
('Owner', '', 1, 0, 50000, 9949757554, 'Chintalagaruvu, Vaddiparru', 1234, '2020-04-01', '1992-10-01', '0000-00-00', 0, 2),
('Hareesh', 'kadali', 2, 1, 50000, 9949757554, 'Chintalagaruvu, Vaddiparru', 1111, '2020-04-01', '1992-12-11', '0000-00-00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `id`, `admin`) VALUES
('owner', 'owner@123', 1, 2),
('hareesh', 'hareesh@123', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_from`
--

CREATE TABLE IF NOT EXISTS `orders_from` (
  `status` tinyint(2) NOT NULL,
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(5) NOT NULL,
  `pid` int(11) NOT NULL,
  `sid` int(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `cost_price` float(10) NOT NULL,
  `supplier_id` int(6) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `discount` float(10) NOT NULL,
  `product_type` int(11) NOT NULL,
  `market_price` float(7) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `cost_price`, `supplier_id`, `product_name`, `quantity`,`discount`, `product_type`, `market_price`) VALUES

(1,1000,1 ,'A CHLOR 5 LIT',100 , 16.5, 1, 1000 ),
(2,1000,1 ,'AG LIME 40KG',100 , 16.5, 1, 1000 ),
(3,1000,2 ,'AQUA SOFT PLUS 1KG',100 , 16.5, 1, 1000 ),
(4,1000,3 ,'AQUAPRO 500GM',100 , 16.5, 1, 1000 ),
(5,1000,4 ,'AVANT BACT 500GM',100 , 16.5, 1, 1000 ),
(6,1000,4 ,'AVANT IMMUPAK 500GM',100 , 16.5, 1, 1000 ),
(7,1000,4 ,'AVANTI PROW 500GM',100 , 16.5, 1, 1000 ),
(8,1000,5 ,'AVANTI SOLD MIXTOR',100 , 16.5, 1, 1000 ),
(9,1000,1 ,'AVANTI SOLD MIXTOR',100 , 16.5, 1, 1000 ),
(10,1000,6 ,'AVANTI SOLD MIXTOR',100 , 16.5, 1, 1000 ),
(11,1000,3 ,'BIOCLAM 500GM',100 , 16.5, 1, 1000 ),
(12,1000,2 ,'BIOFLOC 1KG',100 , 16.5, 1, 1000 ),
(13,1000,2 ,'BLOOM DS 5KG',100 , 16.5, 1, 1000 ),
(14,1000,7 ,'CALCIUM PEROXIDE 1KG',100 , 16.5, 1, 1000 ),
(15,1000,8 ,'CALCIUM CHLORIDE 5KG',100 , 16.5, 1, 1000 ),
(16,1000,9 ,'CECLIVE PLUS 5LIT',100 , 16.5, 1, 1000 ),
(17,1000,10 ,'CLEAN SPOT',100 , 16.5, 1, 1000 ),
(18,1000,11,'CLINZEX-DS 25KG',100 , 16.5, 1, 1000 ),
(19,1000,3 ,'ECOBIO 500GM',100 , 16.5, 1, 1000 ),
(20,1000,12 ,'FASTMIN 10KG',100 , 16.5, 1, 1000 ),
(21,1000,1 ,'FENOFRESH 250GM',100 , 16.5, 1, 1000 ),
(22,1000,8 ,'FERRI CHLORIDE 5KG',100 , 16.5, 1, 1000 ),
(23,1000,8 ,'FORMALINE 5LIT',100 , 16.5, 1, 1000 ),
(24,1000,13 ,'GASEN PLUS POWDER 500GM',100 , 16.5, 1, 1000 ),
(25,1000,14 ,'GERMICIDAA 500GM',100 , 16.5, 1, 1000 ),
(26,1000,14 ,'GERMICIDAA 5KG',100 , 16.5, 1, 1000 ),
(27,1000,13 ,'HEPATAL-DS 5LIT',100 , 16.5, 1, 1000 ),
(28,1000,8 ,'HYDROGEN PEROXIDE 5LIT',100 , 16.5, 1, 1000 ),
(29,1000,7 ,'LEGROS BIO 500GM',100 , 16.5, 1, 1000 ),
(30,1000,7 ,'LEO C 500GM',100 , 16.5, 1, 1000 ),
(31,1000,7 ,'LEO FORCE 500GM',100 , 16.5, 1, 1000 ),
(32,1000,15 ,'LIPIDEL 5LIT',100 , 16.5, 1, 1000 ),
(33,1000,14 ,'LIVOTES GELL 5LIT',100 , 16.5, 1, 1000 ),
(34,1000,8 ,'MAGNISIUM CHLORIDE 5KG',100 , 16.5, 1, 1000 ),
(35,1000,7 ,'MEGA PS 20LIT',100 , 16.5, 1, 1000 ),
(36,1000,7 ,'MEGA PS 5LIT',100 , 16.5, 1, 1000 ),
(37,1000,16 ,'NATUREVEL-EEOPOUND 1LIT',100 , 16.5, 1, 1000 ),
(38,1000,16 ,'NATUREVEL-AQ-PH 1LIT',100 , 16.5, 1, 1000 ),
(39,1000,15 ,'NECCIAN 1KG',100 , 16.5, 1, 1000 ),
(40,1000,17 ,'ODOBAN 500GM',100 , 16.5, 1, 1000 ),
(41,1000,17 ,'ODOBLOC 500GM',100 , 16.5, 1, 1000 ),
(42,1000,1 ,'P.V.C 40KG',100 , 16.5, 1, 1000 ),
(43,1000,7 ,'POND FRESH 10KG',100 , 16.5, 1, 1000 ),
(44,1000,3 ,'PONDPO 500GM',100 , 16.5, 1, 1000 ),
(45,1000,8 ,'POTASSIUM CHLORIDE 5KG',100 , 16.5, 1, 1000 ),
(46,1000,7 ,'REAL EDTA 1KG',100 , 16.5, 1, 1000 ),
(47,1000,19 ,'SANDHYA SANPRO WS 500GM',100 , 16.5, 1, 1000 ),
(48,1000,2 ,'SEEDCARE 1LIT',100 , 16.5, 1, 1000 ),
(49,1000,8 ,'SODIUM BICORBATE 5KG',100 , 16.5, 1, 1000 ),
(50,1000,7 ,'SOFNER 1KG',100 , 16.5, 1, 1000 ),
(51,1000,15 ,'SOFTEX 1KG',100 , 16.5, 1, 1000 ),
(52,1000,15 ,'SOFTEX 5KG',100 , 16.5, 1, 1000 ),
(53,1000,1 ,'STERIDOL 20% 250ML',100 , 16.5, 1, 1000 ),
(54,1000,1 ,'STERIDOL 20% 500ML',100 , 16.5, 1, 1000 ),
(55,1000,15 ,'SUPERVIT-M 5KG',100 , 16.5, 1, 1000 ),
(56,1000,2 ,'SYNAMIN FS 1LIT',100 , 16.5, 1, 1000 ),
(57,1000,2 ,'SYNAMIN FS 5LIT',100 , 16.5, 1, 1000 ),
(58,1000,20 ,'TRIPKONS 500GM',100 , 16.5, 1, 1000 ),
(59,1000,7 ,'WHITEMIN 10KG',100 , 16.5, 1, 1000 ),
(60,1000,7 ,'YUCCA PLUS 500GM',100 , 16.5, 1, 1000 ),
(61,1000,13 ,'ZEDOX 25KG',100 , 16.5, 1, 1000 ),
(62,1000,6 ,'SANDHYA 1C 25KG',100 , 16.5, 2, 1000 ),
(63,1000,6 ,'SANDHYA 2C 25KG',100 , 16.5, 2, 1000 ),
(64,1000,6 ,'SANDHYA 2P 25KG',100 , 16.5, 2, 1000 ),
(65,1000,6 ,'SANDHYA 3S 25KG',100 , 16.5, 2, 1000 ),
(66,1000,6 ,'SANDHYA 3SP 25KG',100 , 16.5, 2, 1000 ),
(67,1000,6 ,'SANDHYA 3P 25KG',100 , 16.5, 2, 1000 ),
(68,1000,6 ,'SANDHYA 4S 25KG',100 , 16.5, 2, 1000 ),
(69,1000,6 ,'SANDHYA 4M 25KG',100 , 16.5, 2, 1000 );

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `discount` float(3) NOT NULL,
  `valid_upto` date NOT NULL,
  `promo_code` int(11) NOT NULL AUTO_INCREMENT,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`discount`, `valid_upto`, `promo_code`, `count`) VALUES
(12, '2010-05-04', 1, 0),
(25, '2014-05-04', 2, 1),
(10, '2012-12-01', 3, 9),
(20, '2010-01-01', 4, 0),
(15, '2013-01-01', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `sdealer` varchar(20) NOT NULL,
  `semail` varchar(40) ,
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `saddress` varchar(50) ,
  `sname` varchar(20) NOT NULL,
  `sphone` varchar(12) ,
  PRIMARY KEY (`sid`),
  UNIQUE KEY `sphone` (`sphone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sdealer`, `semail`, `sid`, `saddress`, `sname`, `sphone`) VALUES
('VENKAT SAI', '', 1, '', 'VENKAT SAI', '99999'),
('GENTLE', '', 2, '', 'GENTLE', '3253254'),
('VINNBIO', '', 3, '', 'VINNBIO', '35552534'),
('AVANTI', '', 4, '', 'AVANTI', '2356654'),
('KARTIKEYA', '', 5, '', 'KARTIKEYA', '42563452'),
('SATYA LAKSHMI', '', 6, '', 'SATYA LAKSHMI', '3426546'),
('LEO', '', 7, '', 'LEO', '67463'),
('AZYTUS', '', 8, '', 'AZYTUS', '73754'),
('RB', '', 9, '', 'RB', '45756'),
('IMKURAQ', '', 10, '', 'IMKURAQ', '356758'),
('BIOSTART', '', 11, '', 'BIOSTART', '536756'),
('SR SOLUTIONS', '', 12, '', 'BIOSTART', '565736'),
('DOCTORS', '', 13, '', 'DOCTORS', '375655'),
('INTAS', '', 14, '', 'INTAS', '24673576'),
('HALLMARK', '', 15, '', 'HALLMARK', '567546'),
('KALAGARA', '', 16, '', 'KALAGARA', '865876'),
('SYNERJY', '', 17, '', 'SYNERJY', '4676'),
('VINNBIO', '', 18, '', 'VINNBIO', '7876546'),
('SANDHYA', '', 19, '', 'SANDHYA', '276576775'),
('GLOBION', '', 20, '', 'GLOBION', '087653');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `p_name` varchar(40) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` float(11) NOT NULL DEFAULT '1',
  `discount` float(10) NOT NULL,
  `price` float(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
