-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2015 at 12:28 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_record`
--

CREATE TABLE IF NOT EXISTS `new_record` (
	`id` int(50) NOT NULL AUTO_INCREMENT,
	`trn_date` datetime NOT NULL,
	`name` varchar(100) NOT NULL,
	`des` varchar(100) NOT NULL,
	`des1` varchar(100) NOT NULL,
	`des2` varchar(100) NOT NULL,
	`gold` varchar(100) NOT NULL,
	`gold1` varchar(100) NOT NULL,
	`gold2` varchar(100) NOT NULL,
	`mak` varchar(100) NOT NULL,
	`mak1` varchar(100) NOT NULL,
	`mak2` varchar(100) NOT NULL,
	`was` varchar(100) NOT NULL,
	`was1` varchar(100) NOT NULL,
	`was2` varchar(100) NOT NULL,
	`qty` varchar(100) NOT NULL,
	`qty1` varchar(100) NOT NULL,
	`qty2` varchar(100) NOT NULL,
	`gram` varchar(100) NOT NULL,
	`gram1` varchar(100) NOT NULL,
	`gram2` varchar(100) NOT NULL,
    `amount` varchar(10) NOT NULL,
	`amount1` varchar(10) NOT NULL,
	`amount2` varchar(10) NOT NULL,
	`cgst` varchar(10) NOT NULL,
	`cgst1` varchar(10) NOT NULL,
	`cgst2` varchar(10) NOT NULL,
	`sgst` varchar(10) NOT NULL,
	`sgst1` varchar(10) NOT NULL,
	`sgst2` varchar(10) NOT NULL,
	`gst` varchar(10) NOT NULL,
	`gst1` varchar(10) NOT NULL,
	`gst2` varchar(10) NOT NULL,
	`subtotal` varchar(10) NOT NULL,
	`submittedby` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
