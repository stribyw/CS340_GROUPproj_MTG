-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 11, 2018 at 12:25 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_stribyw`
--

-- --------------------------------------------------------

--
-- Table structure for table `Discussion Board`
--

CREATE TABLE `Discussion Board` (
  `Discussion_ID` int(10) NOT NULL,
  `Parent_ID` int(10) NOT NULL,
  `Post_Type` varchar(20) NOT NULL,
  `Card_ID` int(10) NOT NULL,
  `Deck_ID` int(10) NOT NULL,
  `UserID` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Discussion Board`
--

INSERT INTO `Discussion Board` (`Discussion_ID`, `Parent_ID`, `Post_Type`, `Card_ID`, `Deck_ID`, `UserID`) VALUES
(1, 1, 'Card_Post', 44, 50, 'LifeIsAJourney'),
(2, 2, 'Card_Post', 11, 99, 'PartyONdude'),
(3, 3, 'Deck_Post', 21, 1, 'TacoKisses'),
(4, 4, 'Deck_Post', 42, 4, 'OGMoonWalker'),
(5, 5, 'Deck_Post', 34, 5, 'TheK_in_K&RC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Discussion Board`
--
ALTER TABLE `Discussion Board`
  ADD PRIMARY KEY (`Discussion_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
