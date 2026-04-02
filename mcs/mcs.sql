-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2026 at 08:30 PM
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
-- Database: `mcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `cadet_login`
--

CREATE TABLE `cadet_login` (
  `mobnumber` int(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer_enrollment`
--

CREATE TABLE `officer_enrollment` (
  `name` varchar(20) NOT NULL,
  `rank` varchar(10) NOT NULL,
  `officer_id` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `address` varchar(40) NOT NULL,
  `state` varchar(15) NOT NULL,
  `district` varchar(15) NOT NULL,
  `mobile` int(10) NOT NULL,
  `bloodgroup` varchar(4) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `police` varchar(15) NOT NULL,
  `qualification` varchar(10) NOT NULL,
  `institution` text NOT NULL,
  `idmark` varchar(40) NOT NULL,
  `aadhaar` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer_login`
--

CREATE TABLE `officer_login` (
  `mobileNumber` int(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer_register`
--

CREATE TABLE `officer_register` (
  `aadhaar` int(12) NOT NULL,
  `officerName` varchar(20) NOT NULL,
  `middleName` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `fatherName` varchar(20) NOT NULL,
  `motherName` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `mobileNumber` int(10) NOT NULL,
  `officerPassword` varchar(20) NOT NULL,
  `confirmOfficerPassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollment`
--

CREATE TABLE `student_enrollment` (
  `name` varchar(20) NOT NULL,
  `father` varchar(20) NOT NULL,
  `mother` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `address` varchar(40) NOT NULL,
  `state` varchar(15) NOT NULL,
  `district` varchar(15) NOT NULL,
  `mobile` int(10) NOT NULL,
  `bloodgroup` varchar(4) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `police` varchar(20) NOT NULL,
  `qualification` varchar(20) NOT NULL,
  `school` varchar(40) NOT NULL,
  `idmark` varchar(30) NOT NULL,
  `aadhaar` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_register`
--

CREATE TABLE `student_register` (
  `aadhar` int(12) NOT NULL,
  `cadetName` varchar(20) NOT NULL,
  `middleName` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `fatherName` varchar(20) NOT NULL,
  `motherName` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `cadetPassword` varchar(20) NOT NULL,
  `confirmPassword` varchar(20) NOT NULL,
  `mobnumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
