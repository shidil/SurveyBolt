-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2014 at 02:02 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `surveymg`
--
CREATE DATABASE IF NOT EXISTS `surveymg` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `surveymg`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `answerID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `surveyID` int(11) NOT NULL,
  `answer` text NOT NULL,
  `date` datetime NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`answerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answerID`, `questionID`, `surveyID`, `answer`, `date`, `author`) VALUES
(52, 50, 112, 'true', '2014-03-16 10:11:40', 14),
(53, 51, 112, 'TV', '2014-03-16 10:11:40', 14),
(54, 52, 112, 'Test cricket', '2014-03-16 10:11:40', 14),
(55, 53, 112, 'Yuvraj Singh', '2014-03-16 10:11:40', 14),
(56, 54, 112, 'India', '2014-03-16 10:11:40', 14);

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE IF NOT EXISTS `choices` (
  `choiceID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `values` text NOT NULL,
  PRIMARY KEY (`choiceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`choiceID`, `questionID`, `values`) VALUES
(24, 49, '1st'),
(25, 49, '2nd'),
(26, 49, '3rd'),
(27, 51, 'TV'),
(28, 51, 'Stadium'),
(29, 51, 'Never'),
(30, 52, 'Test cricket'),
(31, 52, 'One day International'),
(32, 52, 'Twenty20'),
(33, 54, 'India'),
(34, 54, 'Australia'),
(35, 54, 'South Africa'),
(36, 54, 'Pakisthan');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
  `participantID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `date` datetime NOT NULL,
  `surveyID` int(11) NOT NULL,
  PRIMARY KEY (`participantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participantID`, `ip`, `date`, `surveyID`) VALUES
(14, '2130706433', '2014-03-16 10:11:40', 112);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `surveyID` int(11) NOT NULL,
  `questionType` varchar(10) NOT NULL,
  `required` varchar(10) NOT NULL DEFAULT 'true',
  `text` text NOT NULL,
  `help` text NOT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionID`, `surveyID`, `questionType`, `required`, `text`, `help`) VALUES
(38, 108, 'TXT', 'true', 'semester', 'your feedback'),
(39, 108, 'TXT', 'true', 'Name of subject', 'name of teacher??'),
(41, 109, 'TXT', 'true', 'Name of house owner?', ''),
(42, 109, 'PARA', 'true', 'Address', ''),
(43, 109, 'TXT', 'true', 'House number', ''),
(44, 109, 'TXT', 'true', 'Number of members in your family', ''),
(45, 109, 'TXT', 'true', 'Number of adults', ''),
(46, 109, 'TXT', 'true', 'Number of student', ''),
(47, 109, 'TF', 'true', 'Do you have any vehicles?', ''),
(48, 110, 'TXT', 'true', 'Name', 'your name'),
(49, 110, 'CL', 'true', 'Year of cource', ''),
(50, 112, 'TF', 'true', 'You likes cricket?', ''),
(51, 112, 'CB', 'true', 'Do you watch cricket', ''),
(52, 112, 'MC', 'true', 'Which format do you like the most?', ''),
(53, 112, 'TXT', 'false', 'Who is your favorite cricketer', ''),
(54, 112, 'CL', 'true', 'Which team is your favourite', '');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE IF NOT EXISTS `surveys` (
  `surveyID` int(11) NOT NULL AUTO_INCREMENT,
  `surveyName` text NOT NULL,
  `slug` text NOT NULL,
  `author` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `access` varchar(10) NOT NULL DEFAULT 'public',
  `design` int(11) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`surveyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`surveyID`, `surveyName`, `slug`, `author`, `date`, `modified`, `access`, `design`, `password`) VALUES
(108, 'feedback', 'feedback', 6, '2014-03-14 08:37:49', '2014-03-14 08:37:49', '', 0, NULL),
(109, 'census', 'census', 7, '2014-03-14 08:53:12', '2014-03-14 08:53:12', '', 0, NULL),
(110, 'Exam', 'exam', 8, '2014-03-14 09:10:49', '2014-03-14 09:10:49', '', 0, NULL),
(112, 'Cricket Poll', 'cricket-poll', 9, '2014-03-15 00:00:00', '2014-03-15 00:00:00', 'public', 0, 'aa'),
(113, 'asd', 'asd', 9, '2014-03-16 03:42:49', '2014-03-16 03:42:49', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateCreate` datetime NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fullName` varchar(150) NOT NULL,
  `prevl` varchar(10) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `email`, `dateCreate`, `password`, `fullName`, `prevl`) VALUES
(1, 'admin', 'shidil@gmail.com', '0000-00-00 00:00:00', '299527721e328e', 'Administrator', 'admin'),
(3, 'thamshid', 'thamshidcc@gmail.com', '0000-00-00 00:00:00', '329d376a082e8f0d', 'Thamshid cc', 'user'),
(4, 'mufeedh3', 'mufghhhh', '0000-00-00 00:00:00', '73ce772d4a', 'mufeedh', 'user'),
(5, 'rejul', 'reju@gmail.com', '0000-00-00 00:00:00', '73ce772d4a77ca51', 'Rejulp', 'user'),
(6, 'amitindian', 'ami@gmail.com', '0000-00-00 00:00:00', '23912d6d162f9900f1b4', ' Amit r', 'user'),
(7, 'thamshidcc', 'thamshid@gmail.com', '0000-00-00 00:00:00', '73ce772d4a77ca51a9', 'thamshid', 'user'),
(8, 'shidil123', 'shidil4shidil@gmail.com', '0000-00-00 00:00:00', '73ce772d4a77ca51', 'Shidil E', 'user'),
(9, 'fuller', 'robotx@live.com', '2014-03-15 08:07:14', '73ce77284d72cc5ba3', 'Fuller Man', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
