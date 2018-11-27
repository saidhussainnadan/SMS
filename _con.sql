-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 10:31 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `con`
--

-- --------------------------------------------------------

--
-- Table structure for table `cell`
--

CREATE TABLE IF NOT EXISTS `cell` (
`id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `error` int(11) NOT NULL,
  `Eror_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cell`
--

INSERT INTO `cell` (`id`, `phone`, `message`, `status`, `error`, `Eror_description`) VALUES
(1, '3059183196', 'this is msg', 0, 30201, 'Cannot find specified devicename'),
(2, '3419171941', 'this is message from this is message from this is message fromthis is message from this is message from this is message from', 0, 30201, 'Cannot find specified devicename'),
(3, '3109835824', 'said hussain 444', 0, 30201, 'Cannot find specified devicename'),
(4, '3129116372', 'this is message from this is message from this is message fromthis is message from this is message from this is message from', 0, 30201, 'Cannot find specified devicename'),
(5, '3149066994', 'this is msg 222', 0, 30201, 'Cannot find specified devicename'),
(6, '3078603878', 'this is message from this is message from this is message fromthis is message from this is message from this is message from', 0, 30201, 'Cannot find specified devicename'),
(7, '3078373539', 'daS DA D d A SD asd A D a xd AD ad', 0, 30201, 'Cannot find specified devicename');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cell`
--
ALTER TABLE `cell`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `phone` (`phone`), ADD KEY `phone_2` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cell`
--
ALTER TABLE `cell`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
