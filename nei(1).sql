-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2012 at 11:18 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nei`
--
DROP SCHEMA IF EXISTS 'nei';
CREATE SCHEMA 'nei';
use 'nei';
-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookshelf`
--

CREATE TABLE IF NOT EXISTS `tbl_bookshelf` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(50) NOT NULL,
  `book_authors` varchar(30) NOT NULL,
  `book_publisher` varchar(30) NOT NULL,
  `edition` int(11) NOT NULL,
  `overview` varchar(200) NOT NULL,
  `book_address` varchar(50) NOT NULL,
  `book_tags` varchar(20) NOT NULL,
  `book_keywords` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_bookshelf`
--

INSERT INTO `tbl_bookshelf` (`book_id`, `book_title`, `book_authors`, `book_publisher`, `edition`, `overview`, `book_address`, `book_tags`, `book_keywords`) VALUES
(1, 'Introduction to Microelectronics', 'Martin Bates', 'Newnes', 3, 'Microelectronic circuits has provided....', '#', 'default', 'transistor, microeletronics'),
(2, 'Microelectronic devices', 'Prof. D. N. Chaudhary', 'Oxford', 5, 'this book explores into details of ....', '#', '', 'solid state devices, quantum mechanics'),
(3, 'DIGITAL Analysis and Design of Digital Integrated ', 'David A. Hodges', 'McGraw-Hill', 3, 'abc', '#', 'a', 'DIGITAL Analysis,Digital Integrated Circuits'),
(4, 'Principles of CMOS VLSI Design', 'Neil H. E. Weste', 'McGraw-Hill', 2, 'def', '#', 'b', 'vlsi,cmos'),
(5, 'Digital Integrated Circuits', 'Jan M. Rabaey  ', 'Prentice-Hall', 2, 'asf', '#', 'd', 'Digital Integrated Circuits,vlsi'),
(6, 'Principles of CMOS VLSI Design', 'Neil H. E. Weste', 'McGraw-Hill', 3, 'dgs', '#', 'b', 'vlsi,cmos'),
(7, 'CMOS Digital Integrated Circuits Analysis and Desi', 'Sung-Mo (Steve) Kang', 'McGraw-Hill', 3, 'ht', '#', 'd', 'cmos,DIGITAL Analysis,Digital Integrated Circuits'),
(8, 'Introduction to CMOS Op-Amps and Comparators', 'Roubik Gregorian', 'Wiley', 0, 'sdg', '#', 'h', 'analog,cmos,comparators'),
(9, 'VLSI Design Techniques for Analog and Digital Circ', 'R. L. Geiger', 'McGraw-Hill', 0, 'sdb', '#', 'xv', 'vlsi,mixed-signals,digital circuits'),
(10, 'Solid State Electronic Devices', 'Ben Streetman', 'Prentice Hall', 5, 'hrw', '#', 'v', 'solid state');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `MessageID` double NOT NULL AUTO_INCREMENT,
  `Message` text,
  `Author_id` int(11) DEFAULT NULL,
  `Email` text,
  `CreationDate` datetime NOT NULL,
  `ThreadID` double NOT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `Author_id` (`Author_id`),
  KEY `ThreadID` (`ThreadID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`MessageID`, `Message`, `Author_id`, `Email`, `CreationDate`, `ThreadID`) VALUES
(12, 'fgefwgwre', 1, '200901151@daiict.ac.in', '2012-04-01 11:08:15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE IF NOT EXISTS `tbl_course` (
  `course_id` int(11) NOT NULL,
  `course_type` enum('1','2','3') NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `basic_info` text NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_type`, `course_name`, `basic_info`) VALUES
(1, '1', 'Physics of Semiconductor Devices ', '(Lecture - 18 hours)\r\nIt will be offered during 1st NEI Workshop On DESIGNING OF CMOS ANALOG CIRCUITS June 11- 22, 2012'),
(2, '1', 'Band theory, Continuity equation, P-N junction ', 'It covers zero and reverse bias, forward bias current, capacitance, Metal-semiconductor contacts, MOS capacitor, BJTs & MOSFETs.\r\n'),
(3, '2', 'CMOS Analog Circuit Design', '(Lecture - 35 hours, Lab - 15 hours)\r\n\r\nIt will be offered during 1st NEI Workshop On DESIGNING OF CMOS ANALOG CIRCUITS June 11- 22, 2012.\r\n\r\nThe main objective of this course is to learn how to analyze and design CMOS analog amplifier circuits. The emphasis will be on circuit design, andin every phase of the course, the learner will be expected to design, on paper as well as in simulation, the circuits discussed in the lectures. This course will broadly cover the following topics: MOS transistors: physics, modeling and layout; Common-source amplifier: current source load, diodeload, frequency response, design; Cascode amplifier, Common-gate and common-drain amplifiers; Differential amplifier: dc and ac analysis, design; Current mirrors: basic, cascode, active, advanced; Opamps: one stage, two stage, CMFB, design; Stability and compensation, Parameter variations, Advanced amplifiers: high slew-rate, rail-to-rail, low power; Advanced Topics: D/A Converters, Types of Noise and its statistical characteristics, circuit representation, introduction to RF Design.'),
(4, '3', 'Selected Readings', 'Courses would be a set of readings of published papers, some foundational and some recent, designated by the Guide. The evaluation of the same would again usually be during a workshop in the Workshop Series. Typically, this would involve a presentation by the scholar to the guide and /or designated Mentor Panel members. \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_professor`
--

CREATE TABLE IF NOT EXISTS `tbl_course_professor` (
  `prof_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`prof_id`),
  KEY `member_id` (`member_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_subscribed`
--

CREATE TABLE IF NOT EXISTS `tbl_course_subscribed` (
  `subscription_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`subscription_id`),
  KEY `member_id` (`member_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discussion`
--

CREATE TABLE IF NOT EXISTS `tbl_discussion` (
  `ThreadID` double NOT NULL AUTO_INCREMENT,
  `Title` text,
  `Author_id` int(11) DEFAULT NULL,
  `Email` text NOT NULL,
  `Posts` double DEFAULT NULL,
  `CreationDate` datetime NOT NULL,
  `LastPostedTo` datetime NOT NULL,
  PRIMARY KEY (`ThreadID`),
  KEY `Author_id` (`Author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_discussion`
--

INSERT INTO `tbl_discussion` (`ThreadID`, `Title`, `Author_id`, `Email`, `Posts`, `CreationDate`, `LastPostedTo`) VALUES
(4, 'feq', 1, '200901151@daiict.ac.in', 1, '2012-04-01 11:08:15', '2012-04-01 11:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_institute`
--

CREATE TABLE IF NOT EXISTS `tbl_institute` (
  `institute_id` int(11) NOT NULL,
  `institute_name` varchar(50) NOT NULL,
  `institute_info` varchar(200) NOT NULL,
  PRIMARY KEY (`institute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_institute`
--

INSERT INTO `tbl_institute` (`institute_id`, `institute_name`, `institute_info`) VALUES
(1, 'DA-IICT', ''),
(2, 'SVNIT', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE IF NOT EXISTS `tbl_member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `picture` varchar(11) NOT NULL,
  `member_type` enum('Admin','Workshop','Expert','Ph.D.') NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `institute_id` (`institute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`member_id`, `first_name`, `last_name`, `password`, `institute_id`, `email`, `city`, `country`, `description`, `picture`, `member_type`) VALUES
(1, 'Kaushal', 'Hakani', 'admin', 1, '200901151@daiict.ac.in', 'gandhinagar', 'india', 'gdfgfdgdfgdfdbfb', '', 'Admin'),
(2, 'Nikhil', 'Jain', 'chasingcars', 1, '200901155@daiict.ac.in', 'Ahmedabad', 'India', 'hey.', '', 'Workshop'),
(3, 'Yashesh', 'Gaur', 'yashesh', 2, 'yashesh@gaur.com', 'Ahmedabad', 'India', 'hi!!', '', 'Expert'),
(4, 'Mazad', 'Zaveri', 'mazad', 1, 'mazad_zaveri@daiict.ac.in', 'Gandhinagar', 'India', 'PHD from.....', '', 'Expert'),
(5, 'Akansha', 'Singh', 'akansha', 2, 'akansha@gmail.com', 'Lucknow', 'India', 'Coder', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE IF NOT EXISTS `tbl_review` (
  `ThreadID` double NOT NULL AUTO_INCREMENT,
  `Title` text,
  `Author_id` int(11) DEFAULT NULL,
  `Email` text,
  `Posts` double DEFAULT NULL,
  `CreationDate` datetime NOT NULL,
  `LastPostedTo` datetime NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `abstract` varchar(300) NOT NULL,
  PRIMARY KEY (`ThreadID`),
  KEY `Author_id` (`Author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`ThreadID`, `Title`, `Author_id`, `Email`, `Posts`, `CreationDate`, `LastPostedTo`, `file_path`, `abstract`) VALUES
(25, 'fhsjld', 1, '200901151@daiict.ac.in', 0, '2012-04-01 11:04:35', '2012-04-01 11:04:35', 'upload/tbl_course.sql', 'fvlsvk'),
(26, 'Hi!!', 2, '200901155@daiict.ac.in', 1, '2012-04-01 11:11:31', '2012-04-01 11:12:06', 'upload/tbl_course.sql', 'sdfas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_review_comment` (
  `MessageID` double NOT NULL AUTO_INCREMENT,
  `Message` text,
  `Author_id` int(11) DEFAULT NULL,
  `Email` text,
  `CreationDate` datetime NOT NULL,
  `ThreadID` double NOT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `ThreadID` (`ThreadID`),
  KEY `Author_id` (`Author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_review_comment`
--

INSERT INTO `tbl_review_comment` (`MessageID`, `Message`, `Author_id`, `Email`, `CreationDate`, `ThreadID`) VALUES
(2, 'vsdm;lvds', 2, '200901155@daiict.ac.in', '2012-04-01 11:12:06', 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workshop`
--

CREATE TABLE IF NOT EXISTS `tbl_workshop` (
  `workshop_id` int(11) NOT NULL AUTO_INCREMENT,
  `workshop_title` varchar(100) NOT NULL,
  `workshop_details` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`workshop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_workshop`
--

INSERT INTO `tbl_workshop` (`workshop_id`, `workshop_title`, `workshop_details`, `start_date`, `end_date`, `date_added`) VALUES
(1, 'solid', 'sdvcsadvdsa', '2012-05-17', '2012-05-19', '2012-03-18 10:37:56'),
(2, 'solid state', 'wsvewfvvwfds', '2012-04-04', '2012-04-06', '2012-03-18 10:38:09'),
(3, 'solid state devices', 'fvdfvd ', '2012-03-06', '2012-03-08', '2012-03-18 10:38:25'),
(4, 'vlsi', 'fvfdvdf ', '2012-07-19', '2012-07-21', '2012-03-18 11:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workshop_attendes`
--

CREATE TABLE IF NOT EXISTS `tbl_workshop_attendes` (
  `attende_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `workshop_id` int(11) NOT NULL,
  PRIMARY KEY (`attende_id`),
  KEY `workshop_id` (`workshop_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_workshop_attendes`
--

INSERT INTO `tbl_workshop_attendes` (`attende_id`, `member_id`, `workshop_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workshop_conductor`
--

CREATE TABLE IF NOT EXISTS `tbl_workshop_conductor` (
  `conductor_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `workshop_id` int(11) NOT NULL,
  PRIMARY KEY (`conductor_id`),
  KEY `member_id` (`member_id`),
  KEY `workshop_id` (`workshop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workshop_course`
--

CREATE TABLE IF NOT EXISTS `tbl_workshop_course` (
  `workshop_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `workshop_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`workshop_course_id`),
  KEY `workshop_id` (`workshop_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_workshop_course`
--

INSERT INTO `tbl_workshop_course` (`workshop_course_id`, `workshop_id`, `course_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `tbl_comment_ibfk_4` FOREIGN KEY (`Author_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_comment_ibfk_3` FOREIGN KEY (`ThreadID`) REFERENCES `tbl_discussion` (`ThreadID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_course_professor`
--
ALTER TABLE `tbl_course_professor`
  ADD CONSTRAINT `tbl_course_professor_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_course_professor_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_course_subscribed`
--
ALTER TABLE `tbl_course_subscribed`
  ADD CONSTRAINT `tbl_course_subscribed_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_course_subscribed_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_discussion`
--
ALTER TABLE `tbl_discussion`
  ADD CONSTRAINT `tbl_discussion_ibfk_1` FOREIGN KEY (`Author_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD CONSTRAINT `tbl_member_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `tbl_institute` (`institute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`Author_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_review_comment`
--
ALTER TABLE `tbl_review_comment`
  ADD CONSTRAINT `tbl_review_comment_ibfk_2` FOREIGN KEY (`Author_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_review_comment_ibfk_1` FOREIGN KEY (`ThreadID`) REFERENCES `tbl_review` (`ThreadID`);

--
-- Constraints for table `tbl_workshop_attendes`
--
ALTER TABLE `tbl_workshop_attendes`
  ADD CONSTRAINT `tbl_workshop_attendes_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_workshop_attendes_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `tbl_workshop` (`workshop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_workshop_conductor`
--
ALTER TABLE `tbl_workshop_conductor`
  ADD CONSTRAINT `tbl_workshop_conductor_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_workshop_conductor_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `tbl_workshop` (`workshop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_workshop_course`
--
ALTER TABLE `tbl_workshop_course`
  ADD CONSTRAINT `tbl_workshop_course_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `tbl_workshop` (`workshop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_workshop_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
