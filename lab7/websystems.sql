-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2025 at 03:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websystems`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `crn` int(11) UNSIGNED NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `number` smallint(4) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `section` varchar(10) DEFAULT NULL,
  `year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crn`, `prefix`, `number`, `title`, `section`, `year`) VALUES
(35797, 'PHYS', 1100, 'Physics I', NULL, NULL),
(37514, 'CSCI', 1100, 'Introduction to Computer Science', NULL, NULL),
(37730, 'MATH', 2010, 'Multivar Calculus & Matrix Algebra', NULL, NULL),
(73048, 'ITWS', 2110, 'Web Systems Development', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `crn` int(11) UNSIGNED NOT NULL,
  `RIN` int(9) UNSIGNED NOT NULL,
  `grade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `crn`, `RIN`, `grade`) VALUES
(2, 37514, 662057099, 94),
(3, 37730, 662057098, 88),
(4, 73048, 662057097, 91),
(5, 35797, 662057096, 85),
(6, 37514, 662057099, 82),
(7, 37730, 662057098, 79),
(8, 73048, 662057097, 89),
(9, 35797, 662057096, 94),
(10, 37514, 662057099, 87),
(11, 37730, 662057098, 92);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `RIN` int(9) UNSIGNED NOT NULL,
  `RCSID` char(7) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `phone` int(10) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`RIN`, `RCSID`, `first_name`, `last_name`, `alias`, `phone`, `street`, `city`, `state`, `zip`) VALUES
(662057096, 'siongd', 'Dana', 'Siong Sin', 'dana', 1231231234, '4 College Ave', 'Troy', 'NY', '12180'),
(662057097, 'spauln', 'Nicole', 'Spaulding', 'nicole', 1231231233, '3 College Ave', 'Troy', 'NY', '12180'),
(662057098, 'sitc', 'Courteney', 'Sit', 'courteney', 1231231232, '2 College Ave', 'Troy', 'NY', '12180'),
(662057099, 'wongp4', 'Priscilla', 'Wong', 'priscilla', 1231231231, '1 College Ave', 'Troy', 'NY', '12180');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crn`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crn` (`crn`),
  ADD KEY `RIN` (`RIN`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`RIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `crn` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73049;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `RIN` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=662057100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`crn`) REFERENCES `courses` (`crn`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`RIN`) REFERENCES `students` (`RIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
