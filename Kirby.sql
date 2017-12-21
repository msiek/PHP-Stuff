-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2017 at 10:23 AM
-- Server version: 5.6.32-78.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `happyte8_Kirby`
--

-- --------------------------------------------------------

--
-- Table structure for table `CLIENT`
--

CREATE TABLE IF NOT EXISTS `CLIENT` (
  `ClientID` int(11) NOT NULL,
  `BusinessName` varchar(50) NOT NULL,
  `ClientPhone` char(10) NOT NULL,
  `PromotionalConsideration` tinyint(1) NOT NULL,
  `InvestmentAmount` decimal(6,2) NOT NULL,
  `EmployeeID` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CLIENT`
--

INSERT INTO `CLIENT` (`ClientID`, `BusinessName`, `ClientPhone`, `PromotionalConsideration`, `InvestmentAmount`, `EmployeeID`) VALUES
(1, 'Banton Media', '8432991221', 1, '3000.00', 1),
(2, 'RNDC', '8037390188', 0, '0.00', 10),
(3, 'Krispy Kreme', '8434571837', 0, '0.00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE IF NOT EXISTS `EMPLOYEE` (
  `EmployeeID` int(11) NOT NULL,
  `EmployeeName` varchar(25) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`EmployeeID`, `EmployeeName`) VALUES
(1, 'Christina Burzler'),
(2, 'Tracy Fryar'),
(3, 'Hannah Allen'),
(4, 'Blaine Holland'),
(5, 'ynnwood Young'),
(6, 'Taylor HUcks'),
(7, 'Michael McDoughnah'),
(8, 'Jason Ashmawi'),
(9, 'Kirby Hood'),
(10, 'Billy Huggins'),
(11, 'Michael Siek');

-- --------------------------------------------------------

--
-- Table structure for table `INTERVIEW`
--

CREATE TABLE IF NOT EXISTS `INTERVIEW` (
  `InterviewID` int(11) NOT NULL,
  `InterviewDesceiption` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `INTERVIEW`
--

INSERT INTO `INTERVIEW` (`InterviewID`, `InterviewDesceiption`) VALUES
(1, 'Ed Live on the Marshwalk for the Kick off of the event. LIVE for 5p, 6p, 7p, newscasts');

-- --------------------------------------------------------

--
-- Table structure for table `PARTNERSHIP`
--

CREATE TABLE IF NOT EXISTS `PARTNERSHIP` (
  `PartnershipID` int(11) NOT NULL,
  `ClientID` int(11) NOT NULL,
  `ContactID` int(11) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `PartnershipDescription` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PARTNERSHIP`
--

INSERT INTO `PARTNERSHIP` (`PartnershipID`, `ClientID`, `ContactID`, `Timestamp`, `PartnershipDescription`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', 'We always partner with them on all events'),
(2, 2, 2, '0000-00-00 00:00:00', 'Every year we cover the event with either a VO or Live shots. We also have entries if anyone would like to go, we just need to know who wants to go.');

-- --------------------------------------------------------

--
-- Table structure for table `PARTNERSHIP_CONTACT`
--

CREATE TABLE IF NOT EXISTS `PARTNERSHIP_CONTACT` (
  `ContactID` int(11) NOT NULL,
  `ContactName` varchar(25) NOT NULL,
  `ContactAddress` varchar(50) NOT NULL,
  `ContactCity` char(25) NOT NULL,
  `ContactState` char(15) NOT NULL,
  `ContactPostalCode` char(5) NOT NULL,
  `ContactPhoneNumber` char(10) NOT NULL,
  `ContactEmail` varchar(35) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PARTNERSHIP_CONTACT`
--

INSERT INTO `PARTNERSHIP_CONTACT` (`ContactID`, `ContactName`, `ContactAddress`, `ContactCity`, `ContactState`, `ContactPostalCode`, `ContactPhoneNumber`, `ContactEmail`) VALUES
(1, 'Will Stallings', '410 Foster Brothers Drive', 'West Columbia', 'South Carolina', '29172', '8438779981', 'Will.Stallings@RNDC-USA.com');

-- --------------------------------------------------------

--
-- Table structure for table `REQUEST`
--

CREATE TABLE IF NOT EXISTS `REQUEST` (
  `RequestID` int(11) NOT NULL,
  `PartnershipID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `InterviewID` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `EventName` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `REQUEST`
--

INSERT INTO `REQUEST` (`RequestID`, `PartnershipID`, `LocationID`, `InterviewID`, `Date`, `EventName`) VALUES
(1, 1, 1, 1, '0000-00-00 00:00:00', 'Christmas on the MARSHWALK');

-- --------------------------------------------------------

--
-- Table structure for table `REQUEST_LOCATION`
--

CREATE TABLE IF NOT EXISTS `REQUEST_LOCATION` (
  `LocationID` int(11) NOT NULL,
  `LocationName` varchar(100) NOT NULL,
  `LocationAddress` varchar(50) NOT NULL,
  `LocationCity` char(20) NOT NULL,
  `LocationState` char(25) NOT NULL,
  `LocationPostalCode` char(5) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `REQUEST_LOCATION`
--

INSERT INTO `REQUEST_LOCATION` (`LocationID`, `LocationName`, `LocationAddress`, `LocationCity`, `LocationState`, `LocationPostalCode`) VALUES
(1, 'Murrells Inlet Marshwalk', '4025 Hwy 17 Business', 'Murrells Inlet', 'South Carolina', '29576');

-- --------------------------------------------------------

--
-- Table structure for table `TALENT`
--

CREATE TABLE IF NOT EXISTS `TALENT` (
  `TalentID` int(11) NOT NULL,
  `TalentName` varchar(35) NOT NULL,
  `TalentTitle` varchar(25) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TALENT`
--

INSERT INTO `TALENT` (`TalentID`, `TalentName`, `TalentTitle`) VALUES
(1, 'Ed Piotrowski', 'Cheif Meterologist'),
(2, 'Amanda Kensith', 'Morning Reporter'),
(3, 'Cecil Chandler', 'Anchor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CLIENT`
--
ALTER TABLE `CLIENT`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `INTERVIEW`
--
ALTER TABLE `INTERVIEW`
  ADD PRIMARY KEY (`InterviewID`);

--
-- Indexes for table `PARTNERSHIP`
--
ALTER TABLE `PARTNERSHIP`
  ADD PRIMARY KEY (`PartnershipID`);

--
-- Indexes for table `PARTNERSHIP_CONTACT`
--
ALTER TABLE `PARTNERSHIP_CONTACT`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexes for table `REQUEST`
--
ALTER TABLE `REQUEST`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `REQUEST_LOCATION`
--
ALTER TABLE `REQUEST_LOCATION`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `TALENT`
--
ALTER TABLE `TALENT`
  ADD PRIMARY KEY (`TalentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CLIENT`
--
ALTER TABLE `CLIENT`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `INTERVIEW`
--
ALTER TABLE `INTERVIEW`
  MODIFY `InterviewID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `PARTNERSHIP`
--
ALTER TABLE `PARTNERSHIP`
  MODIFY `PartnershipID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `PARTNERSHIP_CONTACT`
--
ALTER TABLE `PARTNERSHIP_CONTACT`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `REQUEST`
--
ALTER TABLE `REQUEST`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `REQUEST_LOCATION`
--
ALTER TABLE `REQUEST_LOCATION`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `TALENT`
--
ALTER TABLE `TALENT`
  MODIFY `TalentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
