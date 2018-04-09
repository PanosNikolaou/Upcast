-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2017 at 11:18 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upcast`
--
CREATE DATABASE IF NOT EXISTS `upcast` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `upcast`;

-- --------------------------------------------------------

--
-- Table structure for table `upcast_banned_ips`
--

DROP TABLE IF EXISTS `upcast_banned_ips`;
CREATE TABLE IF NOT EXISTS `upcast_banned_ips` (
  `ipaddress` varchar(40) NOT NULL,
  PRIMARY KEY (`ipaddress`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `upcast_photo_category`
--

DROP TABLE IF EXISTS `upcast_photo_category`;
CREATE TABLE IF NOT EXISTS `upcast_photo_category` (
  `photo_category_id` int(11) NOT NULL,
  `photo_category` varchar(30) NOT NULL,
  PRIMARY KEY (`photo_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `upcast_photos_reg`
--

DROP TABLE IF EXISTS `upcast_photos_reg`;
CREATE TABLE IF NOT EXISTS `upcast_photos_reg` (
  `photo_uid` varchar(30) NOT NULL,
  `photo_name` varchar(40) NOT NULL,
  `photo_text` varchar(50) NOT NULL,
  `photo_category_id` varchar(20) NOT NULL,
  `photo_path` varchar(60) NOT NULL,
  `photo_lat` double NOT NULL,
  `photo_lng` double NOT NULL,
  `photo_likes` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`photo_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `upcast_users`
--

DROP TABLE IF EXISTS `upcast_users`;
CREATE TABLE IF NOT EXISTS `upcast_users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

--
-- Dumping data for table `upcast_users`
--

INSERT INTO `upcast_users` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES
('takisnik', '111', 'takis', 'nik', 'tksnik@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
