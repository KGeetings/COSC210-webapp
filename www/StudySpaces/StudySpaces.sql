-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2019 at 03:26 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `StudySpaces`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`) VALUES
(1, 'Vermeer Science Center'),
(2, 'Roe'),
(3, 'Weller'),
(4, 'Jordan Hall');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` smallint(6) NOT NULL,
  `buildingid` tinyint(4) NOT NULL,
  `description` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `buildingid`, `description`) VALUES
(1, 1, '1st floor - 140 Northeast end, down spiral stairs from computer lab in 240'),
(1, 2, '1st floor Roe center'),
(2, 1, '1st floor - outside 141 by windows with water fountain'),
(3, 1, '1st floor - center of northern hallway'),
(4, 1, '1st floor - west end of northern hallway, outside of 180 and exit to Roe building'),
(5, 1, '1st floor - outside faculty offices north side of building'),
(6, 1, '1st floor - near southwest entrance, by elevator'),
(7, 1, '2nd floor - room 240, open computer lab, northeast corner'),
(8, 1, '2nd floor - northwest corner of building, above exit, health professions area'),
(9, 1, '2nd floor - outside faculty offices, north side of building');

-- --------------------------------------------------------

--
-- Table structure for table `loc_res`
--

CREATE TABLE `loc_res` (
  `loc_id` smallint(6) NOT NULL,
  `resource_id` tinyint(4) NOT NULL,
  `building_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loc_res`
--

INSERT INTO `loc_res` (`loc_id`, `resource_id`, `building_id`) VALUES
(1, 1, 1),
(1, 3, 2),
(1, 5, 1),
(1, 5, 2),
(1, 7, 1),
(1, 7, 2),
(1, 8, 2),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(2, 8, 1),
(4, 1, 1),
(4, 2, 1),
(4, 3, 1),
(4, 4, 1),
(4, 6, 1),
(5, 1, 1),
(5, 2, 1),
(5, 3, 1),
(5, 5, 1),
(5, 7, 1),
(7, 1, 1),
(7, 2, 1),
(7, 3, 1),
(7, 5, 1),
(8, 1, 1),
(8, 2, 1),
(8, 3, 1),
(9, 1, 1),
(9, 2, 1),
(9, 3, 1),
(9, 5, 1),
(9, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` tinyint(4) NOT NULL,
  `description` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `description`) VALUES
(1, 'power outlets'),
(2, 'ethernet jacks'),
(3, 'Tables'),
(4, 'Extended couch'),
(5, 'whiteboard'),
(6, 'chalkboard'),
(7, 'professors nearby'),
(8, 'restrooms nearby');

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `building_id` smallint(6) NOT NULL,
  `location_id` smallint(6) NOT NULL,
  `seating` tinyint(4) NOT NULL,
  `computers` tinyint(4) NOT NULL,
  `food` varchar(140) NOT NULL,
  `noise` tinyint(4) NOT NULL,
  `lighting` varchar(50) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`building_id`, `location_id`, `seating`, `computers`, `food`, `noise`, `lighting`, `rating`) VALUES
(1, 1, 4, 0, 'No food/drink', 3, 'natural lighting', 6),
(1, 2, 23, 0, 'vending machines, water fountain nearby', 4, 'natural lighting', 4),
(1, 3, 2, 0, 'No food/drink', 7, 'more artificial than natural', 3),
(1, 4, 17, 0, 'No food/drink', 4, 'more artificial than natural', 4),
(1, 5, 25, 3, 'No food/drink', 5, 'artificial lighting', 7),
(1, 6, 2, 0, 'No food/drink', 3, 'abundant natural lighting', 5),
(1, 7, 32, 14, 'No food/drink', 3, 'abundant natural lighting', 7),
(1, 8, 6, 1, 'No food/drink', 2, 'more artificial than natural', 8),
(1, 9, 25, 1, 'No food/drink', 5, 'abundant natural lighting', 7),
(1, 10, 1, 1, 'In the drawers', 2, 'Natural Light & Artificial', 0),
(1, 11, 1, 1, 'In the drawers and cabinets', 3, 'Natural Light & Artificial', 0),
(2, 1, 30, 0, 'Vending close by', 5, 'Natural light', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`,`buildingid`);

--
-- Indexes for table `loc_res`
--
ALTER TABLE `loc_res`
  ADD PRIMARY KEY (`loc_id`,`resource_id`,`building_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`building_id`,`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
