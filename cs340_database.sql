-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 13, 2018 at 10:27 PM
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
-- Database: `cs340_goertzel`
--


-- --------------------------------------------------------

--
-- Table structure for table `Cards`
--

CREATE TABLE `Cards` (
  `Card_ID` int(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Image_Path` varchar(50) DEFAULT NULL,
  `Set_Name` varchar(20) DEFAULT NULL,
  `Rarity` int(1) NOT NULL DEFAULT '1',
  `Rulings` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cards`
--

INSERT INTO `Cards` (`Card_ID`, `Name`, `Image_Path`, `Set_Name`, `Rarity`, `Rulings`) VALUES
(1, 'Knight of Dusk', NULL, 'Creature - Human Knight', 1, NULL),
(2, 'Dungrove Elder', NULL, 'Creature - Treefolk', 3, NULL),
(3, 'Lambholt Elder', NULL, 'Creature - Human Werewolf', 5, NULL),
(4, 'Flameblast Dragon', NULL, 'Creature - Dragon', 2, NULL),
(5, 'Furnace Dragon', NULL, 'Creature - Dragon', 1, NULL),
(6, 'Volcanic Dragon', NULL, 'Creature - Dragon', 6, NULL),
(7, 'Yavimaya Elder', NULL, 'Creature - Human Druid', 4, NULL),
(8, 'Knight of Glory', NULL, 'Creature - Human Knight', 2, NULL),
(9, 'Knight of Reliquary', NULL, 'Creature - Human Knight', 1, NULL),
(10, 'Thraben Sentry', NULL, 'Creature - Human Soldier', 1, NULL),
(11, 'Counterflux', NULL, 'Instant', 8, NULL),
(12, 'Grindclock', NULL, 'Artifact', 9, NULL),
(13, 'Staggershock', NULL, 'Instant', 10, NULL),
(14, 'Electrickery', NULL, 'Instant', 18, NULL),
(15, 'Gigantomancer', NULL, 'Creature - Human Shaman', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Collects`
--

CREATE TABLE `Collects` (
  `User_ID` varchar(25) NOT NULL,
  `Card_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Collects`
--

INSERT INTO `Collects` (`User_ID`, `Card_ID`, `Quantity`) VALUES
('TheK_in_K&RC', 1, 4),
('TheK_in_K&RC', 2, 6),
('TheK_in_K&RC', 3, 4),
('TheK_in_K&RC', 4, 2),
('TheK_in_K&RC', 5, 15),
('TheK_in_K&RC', 6, 12),
('TheK_in_K&RC', 7, 5),
('TheK_in_K&RC', 8, 22),
('LifeIsAJourney', 3, 1),
('LifeIsAJourney', 4, 3),
('LifeIsAJourney', 5, 5),
('LifeIsAJourney', 6, 7),
('LifeIsAJourney', 7, 9),
('LifeIsAJourney', 8, 11),
('LifeIsAJourney', 9, 13),
('LifeIsAJourney', 10, 15),
('PartyONdude', 4, 4),
('PartyONdude', 5, 3),
('PartyONdude', 6, 1),
('PartyONdude', 7, 7),
('PartyONdude', 8, 9),
('PartyONdude', 9, 14),
('YourAirness23', 5, 13),
('YourAirness23', 4, 30),
('YourAirness23', 3, 20),
('LazerRocketArm18', 3, 11),
('LazerRocketArm18', 2, 6),
('LazerRocketArm18', 6, 54),
('LazerRocketArm18', 9, 17),
('BringAtowel420', 3, 19),
('BringAtowel420', 1, 15),
('BringAtowel420', 5, 3),
('BringAtowel420', 10, 15),
('OGMoonWalker', 4, 5),
('OGMoonWalker', 5, 13),
('OGMoonWalker', 7, 10),
('OGMoonWalker', 4, 8),
('OGMoonWalker', 6, 19),
('GreenOGRE', 1, 4),
('GreenOGRE', 7, 23),
('GreenOGRE', 3, 10),
('TacoKisses', 3, 11),
('TacoKisses', 4, 4),
('TacoKisses', 5, 15),
('TacoKisses', 9, 2),
('TacoKisses', 8, 5),
('TacoKisses', 7, 8),
('TacoKisses', 1, 1),
('TacoKisses', 10, 4);

--
-- Triggers `Collects`
--
DELIMITER $$
CREATE TRIGGER `Card_Removed_From_Collection` AFTER DELETE ON `Collects` FOR EACH ROW BEGIN
  IF old.Card_ID IS NOT NULL THEN
    DELETE FROM `Contains`
        WHERE Card_ID=old.Card_ID;
        
        DELETE FROM `Trade`
        WHERE Trade_ID IN 
            (SELECT Trade_ID 
             FROM `Trade_Have`
             WHERE 
             Card_ID=old.Card_ID);
        
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Contains`
--

CREATE TABLE `Contains` (
  `Deck_ID` int(10) NOT NULL,
  `Card_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Contains`
--

INSERT INTO `Contains` (`Deck_ID`, `Card_ID`, `Quantity`) VALUES
(1, 1, 3),
(1, 2, 10),
(1, 4, 3),
(3, 5, 2),
(5, 3, 1);

--
-- Triggers `Contains`
--
DELIMITER $$
CREATE TRIGGER `Deck_Contains_Updated` AFTER UPDATE ON `Contains` FOR EACH ROW BEGIN
  IF (old.Quantity = 0) THEN
        DELETE FROM `Contains`
        WHERE (Deck_ID=new.Deck_ID) AND (Card_ID=new.Card_ID);
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Decks`
--

CREATE TABLE `Decks` (
  `Deck_ID` int(10) NOT NULL,
  `Deck_Name` varchar(25) NOT NULL,
  `User_ID` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Decks`
--

INSERT INTO `Decks` (`Deck_ID`, `Deck_Name`, `User_ID`) VALUES
(1, 'slayerDeck12', 'TheK_in_K&RC'),
(2, 'TacoTOOTH42', 'TacoKisses'),
(3, 'AngryBEAVER', 'PartyONdude'),
(4, 'HungryHippo', 'TacoKisses'),
(5, 'DirtyHIPPY', 'OGMoonWalker'),
(6, 'GirlyGoblins', 'TheK_in_K&RC'),
(7, 'LONEWolf221', 'LifeIsAJourney'),
(8, 'Jund66', 'PartyONdude'),
(9, 'Naya0101', 'OGMoonWalker'),
(6, 'HotRouteOmaha', 'LazerRocketArm18'),
(7, 'SexyMerfolk', 'GreenOGRE'),
(8, 'DemonGOD', 'BringAtowel420'),
(9, 'lebronWHO', 'YourAirness23'),
(10, 'EsperBanter01', 'TheK_in_K&RC');

--
-- Triggers `Decks`
--
DELIMITER $$
CREATE TRIGGER `Deck_Deleted` AFTER DELETE ON `Decks` FOR EACH ROW BEGIN
  IF old.Deck_ID IS NOT NULL THEN
    DELETE FROM `Contains`
        WHERE Deck_ID=old.Deck_ID;
        
        DELETE FROM `Discussions`
        WHERE Deck_ID=old.Deck_ID;
        
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Discussions`
--

CREATE TABLE `Discussions` (
  `Discussion_ID` int(10) NOT NULL,
  `Parent_ID` int(10) DEFAULT NULL,
  `Post_Type` varchar(10) NOT NULL,
  `Card_ID` int(10) DEFAULT NULL,
  `Deck_ID` int(10) DEFAULT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Discussions`
--

INSERT INTO `Discussions` (`Discussion_ID`, `Parent_ID`, `Post_Type`, `Card_ID`, `Deck_ID`, `User_ID`) VALUES
(1, NULL, 'Card', 1, NULL, 'TheK_in_K&RC'),
(2, 1, 'Card', 2, NULL, 'PartyONdude'),
(3, NULL, 'Card', 5, NULL, 'LifeIsAJourney'),
(4, NULL, 'Deck', NULL, 1, 'GreenOGRE'),
(5, 4, 'Deck', NULL, 2, 'TacoKisses'),
(6, 5, 'Card', 3, NULL, 'TheK_in_K&RC'),
(7, 3, 'Card', 3, NULL, 'LifeIsAJourney'),
(8, NULL, 'Card', 5, NULL, 'TacoKisses'),
(9, 7, 'Deck', NULL, 7, 'YourAirness23'),
(10, NULL, 'Deck', NULL, 9, 'PartyONdude');

-- --------------------------------------------------------

--
-- Table structure for table `Trades`
--

CREATE TABLE `Trades` (
  `Trade_ID` int(10) NOT NULL,
  `User_ID` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Trades`
--

INSERT INTO `Trades` (`Trade_ID`, `User_ID`) VALUES
(1, 'PartyONdude'),
(2, 'YourAirness23'),
(3, 'TacoKisses'),
(4, 'BringAtowel420'),
(5, 'YourAirness23'),
(6, 'PartyONdude'),
(7, 'TheK_in_K&RC'),
(8, 'OGMoonWalker'),
(9, 'BringAtowel420'),
(10, 'LazerRocketArm18');

--
-- Triggers `Trades`
--
DELIMITER $$
CREATE TRIGGER `Trade_Deleted` AFTER DELETE ON `Trades` FOR EACH ROW BEGIN
  IF old.Trade_ID IS NOT NULL THEN
    DELETE FROM `Trades`
        WHERE User_ID=old.User_ID;
        
        DELETE FROM `Trade_Have`
        WHERE Trade_ID=old.Trade_ID;
        
        DELETE FROM `Trade_Want`
        WHERE Trade_ID=old.Trade_ID;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Trade_Have`
--

CREATE TABLE `Trade_Have` (
  `Trade_ID` int(10) NOT NULL,
  `Card_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Trade_Have`
--

INSERT INTO `Trade_Have` (`Trade_ID`, `Card_ID`, `Quantity`) VALUES
(1, 2, 3),
(2, 4, 1),
(3, 1, 2),
(4, 5, 1),
(5, 3, 10),
(6, 10, 3),
(7, 9, 4),
(8, 7, 6),
(9, 6, 5),
(10, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Trade_Want`
--

CREATE TABLE `Trade_Want` (
  `Trade_ID` int(10) NOT NULL,
  `Card_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Trade_Want`
--

INSERT INTO `Trade_Want` (`Trade_ID`, `Card_ID`, `Quantity`) VALUES
(1, 3, 1),
(2, 5, 3),
(3, 4, 1),
(4, 2, 2),
(5, 1, 1),
(6, 3, 3),
(7, 6, 4),
(8, 10, 6),
(9, 1, 5),
(10, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_ID` varchar(25) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password_Hash` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_ID`, `Name`, `Email`, `Password_Hash`) VALUES
('TheK_in_K&RC', 'Brian Kernighan', 'unixFORlife@unix.org', 'd1752a02c826b19aef1a03bbf61d78'),
('TacoKisses', 'Jimmy Fallon', 'latenight@nbc.com', 'ae06b12d1ff2f00e86cc4754b92ec1',),
('PartyONdude', 'Mike Meyers', 'shwingShwing@waynesworld.com', 'a3ad822328fe70e3127cb9864bf422'),
('OGMoonWalker', 'Neil Armstrong', 'upThere@nasa.gov', '16673493314fa5d1c96f27ceeb4829'),
('YourAirness23', 'Michael Jordan', 'theGOAT@bulls.com', 'd1673c02c123b01wff0c03ppf61d78'),
('BringAtowel420', 'Mr Towel', 'towely@southpark.com', 'er47v46d0gg6g36h58ee4754b92ec1',),
('GreenOGRE', 'The Shrek', 'pigsareyummy@feedme.com', 'b5ed264890ed14h4578bg0329bf422'),
('LazerRocketArm18', 'Peyton Manning', '5xMVP@halloffame.com', '12394302659fo7f2v34d31ergh365'),
('LifeIsAJourney', 'Bilbo Baggins', 'unexpected@theHobbit.org', '2af8ed9f5c773d89c976fdd76a25a1');


--
-- Triggers `User`
--
DELIMITER $$
CREATE TRIGGER `User_Deleted` AFTER DELETE ON `User` FOR EACH ROW BEGIN
  IF old.User_ID IS NOT NULL THEN
    DELETE FROM `Trades`
        WHERE User_ID=old.User_ID;
        
        DELETE FROM `Collects`
        WHERE User_ID=old.User_ID;
        
        DELETE FROM `Decks`
        WHERE User_ID=old.User_ID;
            
        UPDATE `Discussions` 
        SET User_ID = "Anonymous"
        WHERE User_ID=old.User_ID;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cards`
--
ALTER TABLE `Cards`
  ADD PRIMARY KEY (`Card_ID`);

--
-- Indexes for table `Collects`
--
ALTER TABLE `Collects`
  ADD PRIMARY KEY (`User_ID`,`Card_ID`);

--
-- Indexes for table `Contains`
--
ALTER TABLE `Contains`
  ADD PRIMARY KEY (`Deck_ID`,`Card_ID`);

--
-- Indexes for table `Decks`
--
ALTER TABLE `Decks`
  ADD PRIMARY KEY (`Deck_ID`);

--
-- Indexes for table `Discussions`
--
ALTER TABLE `Discussions`
  ADD PRIMARY KEY (`Discussion_ID`);

--
-- Indexes for table `Trades`
--
ALTER TABLE `Trades`
  ADD PRIMARY KEY (`Trade_ID`);

--
-- Indexes for table `Trade_Have`
--
ALTER TABLE `Trade_Have`
  ADD PRIMARY KEY (`Trade_ID`,`Card_ID`);

--
-- Indexes for table `Trade_Want`
--
ALTER TABLE `Trade_Want`
  ADD PRIMARY KEY (`Trade_ID`,`Card_ID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_ID`);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
