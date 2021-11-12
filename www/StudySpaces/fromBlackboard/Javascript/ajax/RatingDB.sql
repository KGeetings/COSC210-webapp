-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2018 at 08:27 AM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RatingDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `rating_table`
--

CREATE TABLE `rating_table` (
  `rating_id` smallint(6) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `date_submitted` date NOT NULL,
  `comment` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_table`
--

INSERT INTO `rating_table` (`rating_id`, `rating`, `date_submitted`, `comment`) VALUES
(1, 4, '2018-11-19', 'This is a test comment'),
(2, 3, '2018-11-19', 'This is a comment'),
(3, 2, '2018-11-19', 'This is a second test comment'),
(4, 5, '2018-11-19', 'This is a third comment'),
(5, 4, '2018-11-19', 'My of my, does this work?'),
(6, 1, '2018-11-19', 'Another comment'),
(7, 5, '2018-11-19', ''),
(8, 5, '2018-11-20', 'Wow! This star rating is cool!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rating_table`
--
ALTER TABLE `rating_table`
  ADD PRIMARY KEY (`rating_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rating_table`
--
ALTER TABLE `rating_table`
  MODIFY `rating_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
