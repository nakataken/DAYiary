-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2021 at 09:33 AM
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
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `FNAME` varchar(50) NOT NULL,
  `LNAME` varchar(50) NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`ID`, `EMAIL`, `PASSWORD`, `FNAME`, `LNAME`, `CREATED_AT`) VALUES
(1, 'admin@gmail.com', '$2y$10$t9uTfk2QtPbd1QQNKvRCVeUl6jHFMJexzdqDylukyCM', 'System', 'Administrator', '2021-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `diary_table`
--

CREATE TABLE `diary_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USER_ID` bigint(20) NOT NULL,
  `CONTENT` text NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_AT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diary_table`
--

INSERT INTO `diary_table` (`ID`, `USER_ID`, `CONTENT`, `STATUS`, `CREATED_AT`, `MODIFIED_AT`) VALUES
(6, 26, 'happyyyyyy', 'Happy', '2021-12-05', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL,
  `FNAME` varchar(50) NOT NULL,
  `LNAME` varchar(50) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_AT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`ID`, `EMAIL`, `PASSWORD`, `FNAME`, `LNAME`, `BIRTHDATE`, `CREATED_AT`, `MODIFIED_AT`) VALUES
(26, 'admin@example.com', '$2y$10$aUYPy0bgH2G/5kWXO8CV5uan1gQOc8p3bi9oSzlLoHcMLRihipUWm', 'Ken', 'Nakata', '2000-01-30', '2021-12-05', '0000-00-00');

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
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diary_table`
--
ALTER TABLE `diary_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
