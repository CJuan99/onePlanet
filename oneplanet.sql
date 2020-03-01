-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 04:43 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oneplanet`
--

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `materialID` varchar(30) NOT NULL,
  `materialName` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `pointsPerKg` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`materialID`, `materialName`, `description`, `pointsPerKg`) VALUES
('MA001', 'Paper', 'Paper Material', '10.00'),
('MA002', 'Glass', 'Glass Material', '15.00'),
('MA003', 'CardBoard', 'CardBoard Material', '10.00'),
('MB001', 'Metal', 'Metal Material', '20.00'),
('MC001', 'Plastic', 'Plastic Material', '10.00'),
('MC002', 'Tires', 'Tires Material', '10.00'),
('MD001', 'Textiles', 'Textiles Material', '15.00'),
('MD002', 'Batteries', 'Batteries Material', '25.00'),
('MD003', 'Electronics', 'Electronics Material', '25.00'),
('MD004', 'Wood', 'Wood Material', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `registeredmaterial`
--

CREATE TABLE `registeredmaterial` (
  `materialID` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registeredmaterial`
--

INSERT INTO `registeredmaterial` (`materialID`, `username`) VALUES
('MA001', 'jessica'),
('MA002', 'emily'),
('MB001', 'emily'),
('MB001', 'jessica'),
('MC001', 'jessica'),
('MC002', 'ashley'),
('MD001', 'ashley'),
('MD001', 'emily'),
('MD003', 'emily'),
('MD004', 'tiffany');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `submissionID` varchar(30) NOT NULL,
  `proposedDate` date DEFAULT NULL,
  `actualDate` date DEFAULT NULL,
  `weightInKg` decimal(5,2) NOT NULL,
  `pointsAwarded` decimal(8,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `recycler` varchar(30) NOT NULL,
  `collector` varchar(30) NOT NULL,
  `materialID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`submissionID`, `proposedDate`, `actualDate`, `weightInKg`, `pointsAwarded`, `status`, `recycler`, `collector`, `materialID`) VALUES
('SA001', '2020-03-05', '2020-03-06', '3.00', '60.00', 'Submitted', 'ricky', 'emily', 'MB001'),
('SA002', '2020-03-07', '2020-03-07', '60.00', '600.00', 'Submitted', 'selena', 'jessica', 'MC001'),
('SA003', '2020-03-08', '2020-03-10', '5.00', '75.00', 'Submitted', 'ricky', 'ashley', 'MD001'),
('SA004', '2020-03-06', '2020-03-08', '204.00', '2040.00', 'Submitted', 'dylan', 'tiffany', 'MD004'),
('SA005', '2020-03-12', '2020-03-13', '4.00', '80.00', 'Submitted', 'john', 'jessica', 'MB001'),
('SA006', '2020-03-13', '2020-03-13', '1.00', '10.00', 'Submitted', 'alice', 'ashley', 'MC002'),
('SA007', '2020-03-10', '2020-03-12', '2.00', '50.00', 'Submitted', 'alice', 'emily', 'MD003'),
('SA008', '2020-03-07', NULL, '0.00', '0.00', 'Proposed', 'ricky', 'emily', 'MA002'),
('SA009', '2020-03-26', '2020-03-26', '6.00', '60.00', 'Submitted', 'ricky', 'jessica', 'MA001'),
('SA010', '2020-03-21', '2020-03-22', '2.00', '30.00', 'Submitted', 'harley', 'emily', 'MD001');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `totalPoints` decimal(8,2) NOT NULL,
  `ecoLevel` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `userType` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `totalPoints`, `ecoLevel`, `address`, `userType`) VALUES
('alice', 'alice123', 'Alice', '60.00', 'Eco Newbie', NULL, 'Recycler'),
('ashley', 'ashley123', 'Ashley', '85.00', NULL, 'Subang, Kuala Lumpur', 'Collector'),
('dylan', 'dylan123', 'Dylan', '2040.00', 'Eco Warrior', NULL, 'Recycler'),
('emily', 'emily123', 'Emily', '140.00', NULL, 'Batu Cave, Kuala Lumpur', 'Collector'),
('harley', 'harley123', 'Harley', '30.00', 'Eco Newbie', NULL, 'Recycler'),
('jessica', 'jessica123', 'Jessica', '740.00', NULL, 'One Utama, Kuala Lumpur', 'Collector'),
('john', 'john123', 'John', '80.00', 'Eco Newbie', NULL, 'Recycler'),
('ricky', 'ricky123', 'Ricky', '195.00', 'Eco Saver', NULL, 'Recycler'),
('selena', 'selena123', 'Selena', '600.00', 'Eco Hero', NULL, 'Recycler'),
('tiffany', 'tiffany123', 'Tiffany', '2040.00', NULL, 'Kepong, Kuala Lumpur', 'Collector');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`materialID`);

--
-- Indexes for table `registeredmaterial`
--
ALTER TABLE `registeredmaterial`
  ADD PRIMARY KEY (`materialID`,`username`),
  ADD KEY `registercollectmaterial_ibfk_2` (`username`),
  ADD KEY `materialID` (`materialID`),
  ADD KEY `materialID_2` (`materialID`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`submissionID`),
  ADD KEY `materialID` (`materialID`),
  ADD KEY `collector` (`collector`),
  ADD KEY `recycler` (`recycler`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registeredmaterial`
--
ALTER TABLE `registeredmaterial`
  ADD CONSTRAINT `registeredmaterial_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registeredmaterial_ibfk_3` FOREIGN KEY (`materialID`) REFERENCES `material` (`materialID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `collector` FOREIGN KEY (`collector`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materialID` FOREIGN KEY (`materialID`) REFERENCES `material` (`materialID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recycler` FOREIGN KEY (`recycler`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
