-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 06:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dayiary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`ID`, `USERNAME`, `PASSWORD`, `CREATED_AT`) VALUES
(1, 'sysadmin', '$2y$10$8DjKYP81mUG6emuvTeC9h.xMoJ/7hkyRsVq9rugW/zKH7L7rzRyKm', '2021-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `diary_table`
--

CREATE TABLE `diary_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USER_ID` bigint(20) NOT NULL,
  `CONTENT` varchar(10000) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_AT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diary_table`
--

INSERT INTO `diary_table` (`ID`, `USER_ID`, `CONTENT`, `STATUS`, `CREATED_AT`, `MODIFIED_AT`) VALUES
(12, 26, 'test content', 'Happy', '2021-11-30', '0000-00-00'),
(14, 26, 'asdf', 'Heart', '2021-11-30', '0000-00-00'),
(15, 31, 'test', 'Heart', '2021-12-01', '0000-00-00'),
(16, 31, 'test', '', '2021-12-02', '0000-00-00'),
(17, 31, 'test', 'Heart', '2021-12-02', '0000-00-00'),
(18, 31, 'test', '', '2021-12-03', '0000-00-00'),
(19, 31, 'test', 'Heart', '2021-12-04', '0000-00-00'),
(20, 31, 'test', '', '2021-12-04', '0000-00-00'),
(21, 31, 'test', 'Heart', '2021-12-04', '0000-00-00'),
(22, 31, 'test', 'Heart', '2021-12-04', '0000-00-00'),
(23, 31, 'tset', '', '2021-12-05', '0000-00-00'),
(24, 31, '', 'Heart', '2021-12-05', '0000-00-00'),
(25, 31, 'test', 'Heart', '2021-12-06', '0000-00-00'),
(26, 31, 'test', 'Heart', '2021-12-06', '0000-00-00'),
(27, 31, 'test', 'Heart', '2021-12-06', '0000-00-00'),
(28, 1, '12345', 'Heart', '2021-12-08', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_AT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`ID`, `USERNAME`, `PASSWORD`, `NAME`, `BIRTHDATE`, `CREATED_AT`, `MODIFIED_AT`) VALUES
(1, 'sysuser', '$2y$10$nMqtMx1ToPwGk/Rc8qGrT.i09Oc2IswV37wZbyKIqFKXCneS9FGC.', 'System User', '2021-12-06', '2021-12-06', '2021-12-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `diary_table`
--
ALTER TABLE `diary_table`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diary_table`
--
ALTER TABLE `diary_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
