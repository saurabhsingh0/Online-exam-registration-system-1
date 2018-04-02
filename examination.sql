-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2018 at 09:24 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examination`
--

-- --------------------------------------------------------

--
-- Table structure for table `examlist`
--

CREATE TABLE `examlist` (
  `subjectid` varchar(5) NOT NULL,
  `examyear` date NOT NULL,
  `examperiod` varchar(1) NOT NULL,
  `examtype` enum('written','performance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examlist`
--

INSERT INTO `examlist` (`subjectid`, `examyear`, `examperiod`, `examtype`) VALUES
('1', '2018-04-12', '1', 'written');

-- --------------------------------------------------------

--
-- Table structure for table `examperiodlist`
--

CREATE TABLE `examperiodlist` (
  `examperiod` varchar(1) NOT NULL,
  `wregstart` date NOT NULL,
  `wregend` date NOT NULL,
  `writtentest` date NOT NULL,
  `wresult` date NOT NULL,
  `pregstart` date NOT NULL,
  `pregend` date NOT NULL,
  `performancetest` date NOT NULL,
  `finalresult` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examperiodlist`
--

INSERT INTO `examperiodlist` (`examperiod`, `wregstart`, `wregend`, `writtentest`, `wresult`, `pregstart`, `pregend`, `performancetest`, `finalresult`) VALUES
('1', '2018-04-05', '2018-04-05', '2018-04-05', '2018-04-05', '2018-04-05', '2018-04-05', '2018-04-05', '2018-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(12) NOT NULL,
  `member_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `admin` enum('NO','YES') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `member_name`, `dob`, `phone`, `email`, `password`, `admin`) VALUES
('saurabh', 'saurabh', '2018-04-10', '9619597850', 'singhsaurav727@gmail', '133057facf49cbe6520b15a4d96ee395', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` varchar(5) NOT NULL,
  `subjectname` varchar(30) NOT NULL,
  `subjectarea` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `subjectname`, `subjectarea`, `description`) VALUES
('1', 'Software Engineering', 'Engineering', 'S'),
('2', 'DD', 'Technical', 'Distributed Databases');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examlist`
--
ALTER TABLE `examlist`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `examlist`
--
ALTER TABLE `examlist`
  ADD CONSTRAINT `examlist_ibfk_1` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
