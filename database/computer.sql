-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2018 at 11:17 AM
-- Server version: 5.6.31-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computer`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `show_part_of_day`()
begin
declare cur_time, day_part TEXT;
set cur_time = CURTIME();
if cur_time < '12:00:00' then
set day_part = 'morning';
elseif cur_time = '12:00:00' then
set day_part = 'noon';
else
set day_part = 'afternoon or night';
end if;
select cur_time, day_part;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Desktop`
--

CREATE TABLE IF NOT EXISTS `Desktop` (
  `Model` smallint(6) NOT NULL,
  `Speed` decimal(10,1) NOT NULL,
  `Ram` smallint(6) NOT NULL,
  `HD` smallint(6) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Desktop`
--

INSERT INTO `Desktop` (`Model`, `Speed`, `Ram`, `HD`, `Price`) VALUES
(1001, 2.5, 256, 80, 595),
(1002, 2.0, 256, 80, 399),
(1003, 3.1, 512, 120, 899),
(1004, 3.1, 1024, 120, 999),
(1005, 3.1, 256, 100, 999),
(1006, 4.5, 512, 180, 1099),
(1007, 4.5, 512, 200, 1399),
(1008, 4.0, 512, 100, 1199),
(1009, 4.5, 512, 120, 1299),
(1010, 3.0, 256, 60, 495);

--
-- Triggers `Desktop`
--
DELIMITER $$
CREATE TRIGGER `desk_delete` AFTER DELETE ON `Desktop`
 FOR EACH ROW INSERT INTO Desktop_log (action, model, ts )
VALUES ('delete', OLD.model,NOW() )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `desk_insert` AFTER INSERT ON `Desktop`
 FOR EACH ROW INSERT INTO Desktop_log (action, model, ts )
VALUES ('create', new.model, now() )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `desk_update` AFTER UPDATE ON `Desktop`
 FOR EACH ROW INSERT INTO Desktop_log (action, model, ts )
VALUES ('update', NEW.model, NOW() )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Laptop`
--

CREATE TABLE IF NOT EXISTS `Laptop` (
  `Model` smallint(6) NOT NULL,
  `Speed` decimal(10,1) NOT NULL,
  `Ram` smallint(6) NOT NULL,
  `Hd` smallint(6) NOT NULL,
  `Screen` decimal(10,0) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Laptop`
--

INSERT INTO `Laptop` (`Model`, `Speed`, `Ram`, `Hd`, `Screen`, `Price`) VALUES
(2001, 1.8, 256, 30, 12, 799),
(2002, 2.2, 128, 20, 14, 1499),
(2003, 2.2, 512, 40, 14, 1699),
(2004, 2.5, 256, 40, 12, 1499),
(2005, 2.5, 512, 60, 15, 1799),
(2006, 2.3, 256, 40, 15, 999),
(2007, 3.0, 1024, 80, 17, 1899),
(2008, 2.3, 256, 30, 14, 1599);

-- --------------------------------------------------------

--
-- Table structure for table `Printer`
--

CREATE TABLE IF NOT EXISTS `Printer` (
  `Model` smallint(6) NOT NULL,
  `Color` varchar(5) NOT NULL,
  `Type` varchar(6) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Printer`
--

INSERT INTO `Printer` (`Model`, `Color`, `Type`, `Price`) VALUES
(3001, 'TRUE', 'InkJet', 175),
(3002, 'TRUE', 'InkJet', 150),
(3003, 'FALSE', 'Laser', 295),
(3004, 'FALSE', 'Laser', 325),
(3005, 'FALSE', 'inkjet', 80),
(3006, 'FALSE', 'Laser', 259);

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `Maker` char(1) NOT NULL,
  `Model` smallint(6) NOT NULL,
  `Type` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`Maker`, `Model`, `Type`) VALUES
('A', 1001, 'desktop'),
('A', 1002, 'desktop'),
('A', 1003, 'desktop'),
('B', 1004, 'desktop'),
('C', 1005, 'desktop'),
('B', 1006, 'desktop'),
('C', 1007, 'desktop'),
('D', 1008, 'desktop'),
('D', 1009, 'desktop'),
('D', 1010, 'desktop'),
('D', 2001, 'laptop'),
('D', 2002, 'laptop'),
('D', 2003, 'laptop'),
('E', 2004, 'laptop'),
('F', 2005, 'laptop'),
('G', 2006, 'laptop'),
('G', 2007, 'laptop'),
('E', 2008, 'laptop'),
('D', 3001, 'printer'),
('B', 3002, 'printer'),
('D', 3003, 'printer'),
('B', 3004, 'printer'),
('H', 3005, 'printer'),
('I', 3006, 'printer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Desktop`
--
ALTER TABLE `Desktop`
  ADD PRIMARY KEY (`Model`);

--
-- Indexes for table `Laptop`
--
ALTER TABLE `Laptop`
  ADD PRIMARY KEY (`Model`);

--
-- Indexes for table `Printer`
--
ALTER TABLE `Printer`
  ADD PRIMARY KEY (`Model`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`Model`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
