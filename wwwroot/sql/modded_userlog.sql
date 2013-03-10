-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2013 at 06:58 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gorrobust`
--

-- --------------------------------------------------------

--
-- Table structure for table `userlog_agent`
--

CREATE TABLE IF NOT EXISTS `userlog_agent` (
  `region_id` varchar(255) NOT NULL,
  `region_name` varchar(128) DEFAULT NULL,
  `agent_id` varchar(64) NOT NULL,
  `agent_name` varchar(128) NOT NULL,
  `agent_pos` varchar(255) NOT NULL,
  `agent_ip` varchar(255) NOT NULL,
  `agent_country` varchar(255) NOT NULL,
  `agent_viewer` varchar(255) NOT NULL,
  `agent_time` varchar(28) NOT NULL,
  `count` int(12) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`count`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `userlog_country`
--

CREATE TABLE IF NOT EXISTS `userlog_country` (
  `country_code` varchar(4) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  PRIMARY KEY (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userlog_region`
--

CREATE TABLE IF NOT EXISTS `userlog_region` (
  `region_id` varchar(64) NOT NULL,
  `region_name` varchar(128) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userlog_viewer`
--

CREATE TABLE IF NOT EXISTS `userlog_viewer` (
  `viewer` varchar(255) NOT NULL,
  PRIMARY KEY (`viewer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
