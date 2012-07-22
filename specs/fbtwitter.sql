-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2012 at 04:27 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fbtwitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('2eaae3d35b131d4345a12380fb6dd816', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1342923544, 'a:4:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";s:6:"userid";s:1:"2";s:8:"username";s:4:"aldo";}');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`) VALUES
(1, 'english'),
(2, 'indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `id_language` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_date`, `last_login`, `id_language`, `last_update`) VALUES
(2, 'aldo', '$2a$15$d0EL1WMz5oDoVV.7ZslVx.sU7YcuuO75tl6gTpWGkPY/rtK1AAM6m', 'aldopraherda2@gmail.com', '2012-07-21 14:38:21', '2012-07-21 14:38:21', 1, '2012-07-22 02:02:06'),
(4, 'bejo', '$2a$15$KjCbWD7p4NuEAuNkRa.eWu8mbd4DCdXLbKdwD0/t/EmP4TZvSC6cy', 'bejo3@gmail.com', '2012-07-22 01:00:54', '2012-07-22 01:00:54', 1, '0000-00-00 00:00:00'),
(10, 'jokotingkir', '$2a$15$3h783/YqflAHTOBV8L55d./qldfG1bcMt0boFEbaI.h.7ZQYMOKvK', 'jokotingkir@yahoo.com', '2012-07-22 01:13:13', '2012-07-22 01:13:13', 1, '0000-00-00 00:00:00'),
(13, 'jokoterop', '$2a$15$HYsTGfzmnq0YZphJLDAOwegDcDJuw2/RgogDISICVUwpp.Kvd15Uq', 'jokoa@yahoo.com', '2012-07-22 01:32:04', '2012-07-22 01:32:04', 1, '2012-07-22 01:32:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
