-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 11, 2018 at 12:24 PM
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
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` varchar(25) NOT NULL,
  `PasswordHash` varchar(30) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `PasswordHash`, `Name`, `Email`) VALUES
('TheK_in_K&RC', 'd1752a02c826b19aef1a03bbf61d78', 'Brian Kernighan', 'unixFORlife@unix.org'),
('TacoKisses', 'ae06b12d1ff2f00e86cc4754b92ec1', 'Jimmy Fallon', 'latenight@nbc.com'),
('PartyONdude', 'a3ad822328fe70e3127cb9864bf422', 'Mike Meyers', 'shwingShwing@waynesworld.com'),
('OGMoonWalker', '16673493314fa5d1c96f27ceeb4829', 'Neil Armstrong', 'upThere@nasa.gov'),
('LifeIsAJourney', '2af8ed9f5c773d89c976fdd76a25a1', 'Bilbo Baggins', 'unexpected@theHobbit.org');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
