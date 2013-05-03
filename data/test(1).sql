-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2013 at 10:42 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(250) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'IT'),
(5, 'Accounting'),
(6, 'Maketing');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipprove` tinyint(1) DEFAULT NULL,
  `com_name` varchar(100) NOT NULL,
  `com_location` varchar(100) DEFAULT NULL,
  `com_phone` varchar(100) NOT NULL,
  `com_email` varchar(100) NOT NULL,
  `com_web` varchar(100) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `ipprove`, `com_name`, `com_location`, `com_phone`, `com_email`, `com_web`) VALUES
(1, 0, 'Mapring', 'PP', '012', 'mapring@gmail.com', 'www.mapring.com');

-- --------------------------------------------------------

--
-- Table structure for table `jobcategory`
--

CREATE TABLE IF NOT EXISTS `jobcategory` (
  `com_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`com_cat_id`),
  KEY `com_id` (`com_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `jobcategory`
--

INSERT INTO `jobcategory` (`com_cat_id`, `com_id`, `cat_id`) VALUES
(1, 1, 1),
(8, 1, 1),
(9, 1, 5),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `job_deadline` varchar(100) NOT NULL,
  `job_description` varchar(100) NOT NULL,
  PRIMARY KEY (`job_id`),
  KEY `com_id` (`com_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `com_id`, `cat_id`, `job_deadline`, `job_description`) VALUES
(17, 1, 1, '2013-01-02', 'aaaaa'),
(18, 1, 1, '2013-01-02', 'ddd'),
(19, 1, 5, '2013-01-01', 'nnnnnnnnnnnnn');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_cat_id` int(11) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `percentage` int(11) DEFAULT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `com_cat_id` (`com_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `com_cat_id`, `sub_name`, `percentage`) VALUES
(1, 1, 'javaScript', 10),
(2, 1, 'PHP', 30);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobcategory`
--
ALTER TABLE `jobcategory`
  ADD CONSTRAINT `jobcategory_ibfk_1` FOREIGN KEY (`com_id`) REFERENCES `company` (`com_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobcategory_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`com_id`) REFERENCES `jobcategory` (`com_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `jobcategory` (`cat_id`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`com_cat_id`) REFERENCES `jobcategory` (`com_cat_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
