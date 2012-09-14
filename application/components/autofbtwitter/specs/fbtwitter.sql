-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2012 at 03:25 PM
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
('a51752a3aa2a996dc9bf227ad379c199', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344347613, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('73c2670a9dc63e660d8e0bb4656d3792', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344348516, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('b9e0969f225baf6a8d296c1fd84655d6', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344348921, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('d144e41b33e1a8f59997c2da6c9cfb59', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344347078, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('efde49c740b7339241cc71dc72038816', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344345952, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('3eb518d7fd05e95e3361c198bd54e14d', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344339475, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('ee848d79b4ff1936d2b10394c4879f7b', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344339782, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('144b3933ed27e6399dc91a8b34ba4630', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344340101, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('1af43dc7a52b6d7e46920c36b7f8a81e', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344349277, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('4154668836b18f7ffaf252d0f9cf7fe3', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344344644, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('3741ce413ef76f2d00da9aaa8394c025', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344345028, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('c1089cb557f01492a3bc806645d81de2', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344344259, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('4fe1c0342aea97abedf663bf726fe4d6', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344343135, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('057187dd2692122ea15c3794cc4ad4b6', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344349277, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('bdf37767be8e5dc1496e63a7037588bc', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344385977, 'a:4:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";s:6:"userid";s:1:"2";s:8:"username";s:4:"aldo";}'),
('90b0f0ed0913b04138118d2bf570b4b4', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344386443, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('91df14f86c21f5edfad5dfd20a73ccc2', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344386807, 'a:2:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";}'),
('71da8ed74ea8c795e8eafd746321e99f', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1344387164, 'a:4:{s:9:"user_data";s:0:"";s:8:"language";s:7:"english";s:6:"userid";s:1:"2";s:8:"username";s:4:"aldo";}');

-- --------------------------------------------------------

--
-- Table structure for table `com_autofbtwitter_account`
--

CREATE TABLE IF NOT EXISTS `com_autofbtwitter_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `com_autofbtwitter_account`
--

INSERT INTO `com_autofbtwitter_account` (`id`, `type`, `created_date`, `id_user`, `username`) VALUES
(1, 1, '2012-07-31 13:53:53', 2, 'ujianku'),
(2, 2, '2012-08-07 00:00:00', 2, 'tes2344'),
(3, 1, '2012-08-07 00:00:00', 2, 'uuhjn');

-- --------------------------------------------------------

--
-- Table structure for table `com_autofbtwitter_facebook`
--

CREATE TABLE IF NOT EXISTS `com_autofbtwitter_facebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_autofbtwitter_account_id` int(11) NOT NULL,
  `oauth_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_com_autofbtwitter_account` (`com_autofbtwitter_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `com_autofbtwitter_interval_type`
--

CREATE TABLE IF NOT EXISTS `com_autofbtwitter_interval_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `com_autofbtwitter_interval_type`
--

INSERT INTO `com_autofbtwitter_interval_type` (`id`, `name`) VALUES
(1, 'minute(s)'),
(2, 'hour(s)'),
(3, 'Day(s)'),
(4, 'Week(s)');

-- --------------------------------------------------------

--
-- Table structure for table `com_autofbtwitter_queue`
--

CREATE TABLE IF NOT EXISTS `com_autofbtwitter_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `interval_in_minute` int(11) NOT NULL,
  `com_autofbtwitter_account_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `start_date_server_time` datetime NOT NULL,
  `interval` int(11) NOT NULL,
  `interval_type` int(11) NOT NULL,
  `start_hhmm` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_accountx` (`com_autofbtwitter_account_id`),
  KEY `fk_userxt` (`id_user`),
  KEY `fk_interval` (`interval_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `com_autofbtwitter_queue`
--

INSERT INTO `com_autofbtwitter_queue` (`id`, `name`, `start_date`, `interval_in_minute`, `com_autofbtwitter_account_id`, `id_user`, `timezone`, `created_date`, `last_update`, `start_date_server_time`, `interval`, `interval_type`, `start_hhmm`) VALUES
(9, 'kue1', '2012-09-02', 3, 1, 2, 'Asia/Jakarta', '2012-09-02 01:37:22', '2012-09-02 01:37:22', '2012-09-02 08:00:00', 3, 1, '8:00');

-- --------------------------------------------------------

--
-- Table structure for table `com_autofbtwitter_queue_message`
--

CREATE TABLE IF NOT EXISTS `com_autofbtwitter_queue_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_autofbtwitter_queue_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `scheduled_date_time_server_time` datetime NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `error_message` text,
  PRIMARY KEY (`id`),
  KEY `fk_com_autofbtwitter_queue_message_user` (`id_user`),
  KEY `fk_com_autofbtwitter_queue_message_queue` (`com_autofbtwitter_queue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `com_autofbtwitter_queue_message`
--

INSERT INTO `com_autofbtwitter_queue_message` (`id`, `com_autofbtwitter_queue_id`, `id_user`, `message`, `created_date`, `last_update`, `scheduled_date_time_server_time`, `state`, `error_message`) VALUES
(61, 9, 2, 'yes', '2012-09-02 05:12:53', '2012-09-02 05:13:40', '2012-09-02 08:00:00', 2, ''),
(62, 9, 2, 'rawe rawe rantas malang2 putung', '0000-00-00 00:00:00', '2012-09-02 05:14:19', '2012-09-02 08:03:00', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `com_autofbtwitter_schedule`
--

CREATE TABLE IF NOT EXISTS `com_autofbtwitter_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_autofbtwitter_account_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_hhmm` varchar(5) NOT NULL,
  `schedule_tz` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `scheduled_date_time_server_time` datetime NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `error_message` text,
  PRIMARY KEY (`id`),
  KEY `fk_account` (`com_autofbtwitter_account_id`),
  KEY `fk_userx` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `com_autofbtwitter_schedule`
--

INSERT INTO `com_autofbtwitter_schedule` (`id`, `com_autofbtwitter_account_id`, `schedule_date`, `schedule_hhmm`, `schedule_tz`, `message`, `created_date`, `last_update`, `id_user`, `scheduled_date_time_server_time`, `state`, `error_message`) VALUES
(3, 1, '2012-09-02', '7:10', 'Asia/Jakarta', 'maknyus bro23 lagi777\n', '0000-00-00 00:00:00', '2012-09-02 05:16:49', 2, '2012-09-02 07:10:00', 0, ''),
(4, 1, '2012-09-02', '7:45', 'Asia/Jakarta', 'test twitter post bro', '0000-00-00 00:00:00', '2012-09-02 01:21:47', 2, '2012-09-02 07:45:00', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `com_autofbtwitter_twitter`
--

CREATE TABLE IF NOT EXISTS `com_autofbtwitter_twitter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_autofbtwitter_account_id` int(11) NOT NULL,
  `oauth_token_secret` varchar(255) NOT NULL,
  `oauth_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_com_autofbtwitter_account` (`com_autofbtwitter_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `com_autofbtwitter_twitter`
--

INSERT INTO `com_autofbtwitter_twitter` (`id`, `com_autofbtwitter_account_id`, `oauth_token_secret`, `oauth_token`) VALUES
(1, 1, 'Y5z2PEmOpdyBcnRHlAYNx7M2nPh1YEsgyikEhWFdX4', '110686696-PnRvUEsVr92OrvsNUykfEZ5ZTdd6TzsyldiYMFiN');

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
  PRIMARY KEY (`id`),
  KEY `fk_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_date`, `last_login`, `id_language`, `last_update`) VALUES
(2, 'aldo', '$2a$15$d0EL1WMz5oDoVV.7ZslVx.sU7YcuuO75tl6gTpWGkPY/rtK1AAM6m', 'aldopraherda2@gmail.com', '2012-07-21 14:38:21', '2012-07-21 14:38:21', 1, '2012-07-22 02:02:06'),
(4, 'bejo', '$2a$15$KjCbWD7p4NuEAuNkRa.eWu8mbd4DCdXLbKdwD0/t/EmP4TZvSC6cy', 'bejo3@gmail.com', '2012-07-22 01:00:54', '2012-07-22 01:00:54', 1, '0000-00-00 00:00:00'),
(10, 'jokotingkir', '$2a$15$3h783/YqflAHTOBV8L55d./qldfG1bcMt0boFEbaI.h.7ZQYMOKvK', 'jokotingkir@yahoo.com', '2012-07-22 01:13:13', '2012-07-22 01:13:13', 1, '0000-00-00 00:00:00'),
(13, 'jokoterop', '$2a$15$HYsTGfzmnq0YZphJLDAOwegDcDJuw2/RgogDISICVUwpp.Kvd15Uq', 'jokoa@yahoo.com', '2012-07-22 01:32:04', '2012-07-22 01:32:04', 1, '2012-07-22 01:32:42');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `com_autofbtwitter_account`
--
ALTER TABLE `com_autofbtwitter_account`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `com_autofbtwitter_facebook`
--
ALTER TABLE `com_autofbtwitter_facebook`
  ADD CONSTRAINT `fk_com_autofbtwitter_account0` FOREIGN KEY (`com_autofbtwitter_account_id`) REFERENCES `com_autofbtwitter_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `com_autofbtwitter_queue`
--
ALTER TABLE `com_autofbtwitter_queue`
  ADD CONSTRAINT `fk_accountx` FOREIGN KEY (`com_autofbtwitter_account_id`) REFERENCES `com_autofbtwitter_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_interval` FOREIGN KEY (`interval_type`) REFERENCES `com_autofbtwitter_interval_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userxt` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `com_autofbtwitter_queue_message`
--
ALTER TABLE `com_autofbtwitter_queue_message`
  ADD CONSTRAINT `fk_com_autofbtwitter_queue_message_queue` FOREIGN KEY (`com_autofbtwitter_queue_id`) REFERENCES `com_autofbtwitter_queue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_com_autofbtwitter_queue_message_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `com_autofbtwitter_schedule`
--
ALTER TABLE `com_autofbtwitter_schedule`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`com_autofbtwitter_account_id`) REFERENCES `com_autofbtwitter_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userx` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `com_autofbtwitter_twitter`
--
ALTER TABLE `com_autofbtwitter_twitter`
  ADD CONSTRAINT `fk_com_autofbtwitter_account` FOREIGN KEY (`com_autofbtwitter_account_id`) REFERENCES `com_autofbtwitter_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_language` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
