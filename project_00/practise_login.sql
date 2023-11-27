-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2023 at 03:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practise_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `sfid` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `midname` varchar(200) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `bloodgroup` varchar(255) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  `age` bigint(20) DEFAULT NULL,
  `martialstatus` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `community` varchar(255) DEFAULT NULL,
  `caste` varchar(255) DEFAULT NULL,
  `mobcode` varchar(200) NOT NULL,
  `mobno` varchar(255) DEFAULT NULL,
  `instaid` varchar(255) DEFAULT NULL,
  `doorno` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `native` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `highestqualification` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `annualincome` bigint(20) DEFAULT NULL,
  `fathersname` varchar(255) DEFAULT NULL,
  `mothersname` varchar(255) DEFAULT NULL,
  `siblingno` bigint(20) DEFAULT NULL,
  `smoking` varchar(255) DEFAULT NULL,
  `hobbies` varchar(500) DEFAULT NULL,
  `dietarypref` varchar(255) DEFAULT NULL,
  `partneragerange` bigint(20) DEFAULT NULL,
  `partnerageend` bigint(20) DEFAULT NULL,
  `partnereduucation` varchar(255) DEFAULT NULL,
  `partnerjob` varchar(255) DEFAULT NULL,
  `partneranincome` bigint(20) DEFAULT NULL,
  `partnerincomeend` bigint(20) DEFAULT NULL,
  `otherpref` varchar(500) DEFAULT NULL,
  `horoscope` varchar(255) DEFAULT NULL,
  `abouturself` varchar(500) DEFAULT NULL,
  `photo` longtext NOT NULL,
  `photoType` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`sfid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `sfid` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
