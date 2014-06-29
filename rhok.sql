-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2014 at 01:46 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rhok`
--
CREATE DATABASE IF NOT EXISTS `rhok` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rhok`;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `school_id`, `student_id`, `rating`, `type_id`, `date`, `status`) VALUES
(1, 1, 20, 5, 0, '2014-06-29 16:29:28', 1),
(2, 1, 20, 5, 0, '2014-06-29 16:29:42', 1),
(3, 1, 20, 1, 0, '2014-06-29 16:31:22', 1),
(4, 2, 20, 2, 0, '2014-06-29 17:04:59', 1),
(5, 2, 20, 3, 0, '2014-06-29 17:07:14', 1),
(6, 3, 20, 4, 0, '2014-06-29 17:11:05', 1),
(7, 2, 20, 5, 0, '2014-06-29 17:58:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

CREATE TABLE IF NOT EXISTS `school_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`id`, `school_name`, `address`, `pincode`, `district`, `state`, `status`) VALUES
(1, 'SCHOOL A', 'some random address', '560031', 'ramnagar', 'karnataka', '1'),
(2, 'SCHOOL B', 'some random address', '560031', 'mandya', 'karnataka', '1'),
(3, 'SCHOOL C', 'some random address', '560031', 'bangalore', 'karnataka', '1'),
(4, 'SCHOOL D', 'some random address', '560031', 'kolar', 'karnataka', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE IF NOT EXISTS `student_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `gaurdian` varchar(200) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `user_photo` varchar(100) NOT NULL,
  `school_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `class_details` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `username`, `address`, `gender`, `gaurdian`, `blood_group`, `user_photo`, `school_id`, `type_id`, `class_details`, `status`) VALUES
(1, 'girish', 'girish pune maharasthra', 'male', 'channappa', 'b-ve', '32370850.jpg', 1, 0, '', 1),
(2, 'sangeetha', 'sulla, hubli karanataka india', 'female', 'sadanand', 'o-ve', '246995410.jpg', 1, 0, 'v a', 1),
(3, 'kalmesh', 'gopunakoppa, hubli, karnataka', 'male', 'renuka', 'ab+ve', '150743382.jpg', 1, 0, 'III B', 1),
(4, 'priya', 'Mandya, Karnataka', 'female', 'Ramanna', 'b+ve', '163499370.jpg', 2, 0, 'IV B', 1),
(5, 'sunita', 'Bangalore, Karnataka', 'female', 'Savitha', 'ab-ve', '124176843.jpg', 2, 0, 'VI C', 1),
(6, 'Anil', 'Kolar, Karnataka', 'male', 'Sumitra', 'o+ve', '215898471.jpg', 3, 0, 'VII', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type_name`, `status`) VALUES
(1, 'mid-day meal', 1),
(2, 'uniform', 1),
(3, 'beer', 1),
(4, 'cycle', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
