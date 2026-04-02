-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2026 at 04:35 PM
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
-- Database: `mcs1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cadet_enrollment`
--

CREATE TABLE `cadet_enrollment` (
  `id` int(11) NOT NULL,
  `cadet_id` varchar(30) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `father` varchar(100) DEFAULT NULL,
  `mother` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `bloodgroup` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `police` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `idmark` varchar(100) DEFAULT NULL,
  `aadhaar` varchar(12) DEFAULT NULL,
  `aadhaarCard` varchar(255) DEFAULT NULL,
  `bankPassbook` varchar(255) DEFAULT NULL,
  `birthCert` varchar(255) DEFAULT NULL,
  `marksheet` varchar(255) DEFAULT NULL,
  `bondPaper` varchar(255) DEFAULT NULL,
  `declaration` varchar(255) DEFAULT NULL,
  `medicalCert` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cadet_enrollment`
--

INSERT INTO `cadet_enrollment` (`id`, `cadet_id`, `name`, `father`, `mother`, `dob`, `nationality`, `address`, `state`, `district`, `mobile`, `bloodgroup`, `gender`, `police`, `qualification`, `school`, `idmark`, `aadhaar`, `aadhaarCard`, `bankPassbook`, `birthCert`, `marksheet`, `bondPaper`, `declaration`, `medicalCert`, `photo`, `signature`) VALUES
(1, 'WB2026SDMCS777001', 'Sourjya Banerjee', 'hik', 'hiii', '2026-03-05', 'indian', '64b sikdarbagan Street', 'West Bengal', 'kolkata', '8240045894', 'o+', 'Male', 'shyampukur', 'MCA', 'hjkk', 'bbn', '678987656789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/1774852794_Adaptive Differential Privacy in Federated Learnin.docx', NULL),
(2, 'WB2026SDMCS777002', 'Sourjya Banerjee', 'hik', 'hiii', '2026-03-05', 'indian', '64b sikdarbagan Street', 'West Bengal', 'kolkata', '8240045894', 'o+', 'Male', 'shyampukur', 'MCA', 'hjkk', 'bbn', '678987656789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/1774852853_Adaptive Differential Privacy in Federated Learnin.docx', NULL),
(3, 'WB2026SDMCS777003', 'Sourjya Banerjee', 'hik', 'hiii', '2026-03-05', 'indian', '64b sikdarbagan Street', 'West Bengal', 'kolkata', '8240045894', 'o+', 'Male', 'shyampukur', 'MCA', 'hjkk', 'bbn', '678987656789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/1774852857_Adaptive Differential Privacy in Federated Learnin.docx', NULL),
(4, 'WB2026SDMCS777004', 'Sourjya Banerjee', 'hik', 'hiii', '2026-03-07', 'indian', '64b sikdarbagan Street', 'West Bengal', 'kolkata', '08240045894', 'o+', 'Male', 'shyampukur', 'MCA', 'hjkk', 'none', '896054324567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/1774852934_Adaptive Differential Privacy in Federated Learnin.docx', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `officer_enrollment`
--

CREATE TABLE `officer_enrollment` (
  `id` int(8) NOT NULL,
  `officer_id` text NOT NULL,
  `name` text NOT NULL,
  `rank` text NOT NULL,
  `registration_number` text NOT NULL,
  `dob` date NOT NULL,
  `nationality` text NOT NULL,
  `address` text NOT NULL,
  `state` text NOT NULL,
  `district` text NOT NULL,
  `mobile` text NOT NULL,
  `bloodgroup` text NOT NULL,
  `gender` text NOT NULL,
  `police_station` text NOT NULL,
  `qualification` text NOT NULL,
  `institution` text NOT NULL,
  `idmark` text NOT NULL,
  `aadhaar` text NOT NULL,
  `aadhaarCard` varchar(255) NOT NULL,
  `bankPassbook` varchar(255) NOT NULL,
  `birthCert` varchar(255) NOT NULL,
  `institutionCert` varchar(255) NOT NULL,
  `declaration` varchar(255) NOT NULL,
  `medicalCert` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officer_enrollment`
--

INSERT INTO `officer_enrollment` (`id`, `officer_id`, `name`, `rank`, `registration_number`, `dob`, `nationality`, `address`, `state`, `district`, `mobile`, `bloodgroup`, `gender`, `police_station`, `qualification`, `institution`, `idmark`, `aadhaar`, `aadhaarCard`, `bankPassbook`, `birthCert`, `institutionCert`, `declaration`, `medicalCert`, `photo`, `signature`) VALUES
(1, '6789off90000', 'Sourjya Banerjee', 'officer', '', '2026-03-05', 'indian', '64b sikdarbagan Street', 'West Bengal', 'kolkata', '8240045894', 'o+', 'Male', 'shyampukur', 'MCA', 'b.ppimt', 'none', '896054324567', 'uploads/1773040445_Admission_quality_analysis_2025_BCA.docx', 'uploads/1773040445_Admission_quality_analysis_2025_BCA.docx', 'uploads/1773040445_3_Admission_Quality_Analysis_2024_FIT_CSE(IOT)_Reg.docx', 'uploads/1773040445_Admission_quality_analysis_2025_BCA.docx', 'uploads/1773040445_Admission_quality_analysis_2025_BCA.docx', 'uploads/1773040445_Admission_quality_analysis_2025_BCA.docx', 'uploads/1773040445_Admission_quality_analysis_2025_BCA.docx', 'uploads/1773040445_Admission_quality_analysis_2025_BCA.docx'),
(2, '6789off90000', 'pritam', 'officer', '', '2026-03-05', 'indian', '64b sikdarbagan Street', 'West Bengal', 'kolkata', '8240045894', 'o+', 'Male', 'shyampukur', 'MCA', 'b.ppimt', 'none', '896054324567', 'uploads/1773154956_DBMS_Notes (2).pdf', 'uploads/1773154956_DBMS_Notes (2).pdf', 'uploads/1773154956_DBMS_Notes (2).pdf', 'uploads/1773154956_SQL Notes by Apna College (1).pdf', 'uploads/1773154956_SQL Notes by Apna College (1).pdf', 'uploads/1773154956_DBMS_Notes (2).pdf', 'uploads/1773154956_DBMS_Notes (2).pdf', 'uploads/1773154956_DBMS_Notes (2).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `officer_register`
--

CREATE TABLE `officer_register` (
  `id` int(8) NOT NULL,
  `aadhaar` text NOT NULL,
  `officerName` varchar(56) NOT NULL,
  `middleName` varchar(56) NOT NULL,
  `surname` varchar(56) NOT NULL,
  `fatherName` varchar(34) NOT NULL,
  `motherName` varchar(34) NOT NULL,
  `gender` varchar(19) NOT NULL,
  `dob` date NOT NULL,
  `mobileNumber` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officer_register`
--

INSERT INTO `officer_register` (`id`, `aadhaar`, `officerName`, `middleName`, `surname`, `fatherName`, `motherName`, `gender`, `dob`, `mobileNumber`, `password`) VALUES
(1, '678987656789', 'Sourjya', '', 'Banerjee', 'Hello', 'Hiii', 'male', '2026-03-07', '8240045894', '$2y$10$8Qe0qBD17OJHIJC379cBAOU9amaGJGJ4MXNiKk7LoEdVkhYy/9Ku.');

-- --------------------------------------------------------

--
-- Table structure for table `student_register`
--

CREATE TABLE `student_register` (
  `id` int(12) NOT NULL,
  `aadhaar` text NOT NULL,
  `cadetName` varchar(40) NOT NULL,
  `middleName` varchar(30) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `fatherName` varchar(40) NOT NULL,
  `motherName` varchar(40) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `mobile` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_register`
--

INSERT INTO `student_register` (`id`, `aadhaar`, `cadetName`, `middleName`, `surname`, `fatherName`, `motherName`, `gender`, `dob`, `mobile`, `password`) VALUES
(1, '896054324567', 'Susmit', '', 'Banerjee', 'Hello', 'Hiii', 'male', '2026-03-04', '8240045894', '$2y$10$rQMnFtzfab8laXVk/G8.6OyUZJfplGgwTssrPwXSTDkZLti/47eGG'),
(2, '896054324567', 'Sourjya', '', 'Banerjee', 'Hello', 'Hiii', 'male', '2026-03-05', '8240045894', '$2y$10$wpQlN0sFsNdPrZ9bhrYC2udHhCGYEKA8wSwkmQfv2/KHXngDZ830a'),
(3, '896054324567', 'Sourjya', '', 'Banerjee', 'Hello', 'Hiii', 'male', '2026-03-06', '8240045890', '$2y$10$4pj0A0jmTDVH8A5j2WXIAOfkp9k1r/F0nlpRnvLUmMg9NUyJ4QKxe'),
(4, '896054324567', 'Sourjya', '', 'Banerjee', 'Hello', 'Hiii', 'male', '2026-03-06', '8240045890', '$2y$10$qxzF5QcnxAu4.bMxaRF7hOoYGUAsso8PFHXzMjzR8h025sLzR2YtC'),
(5, '678987656789', 'Sourjya', '', 'Banerjee', 'Hello', 'Hiii', 'male', '2026-03-04', '9878787878', '$2y$10$gtc3Ia/vAIMSghtCUwMOvurVbnxMxJejXqQjoJG4gZ6b93OPB.ej6'),
(6, '678987656789', 'hjk', 'ghj', 'Banerjee', 'Hello', 'Hiii', 'male', '2026-03-05', '9000000900', '$2y$10$6yhRk11B/atNJ8hioP8HIeQqVf4sPFH4zANc2BfSthruJvlPEVdVq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadet_enrollment`
--
ALTER TABLE `cadet_enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer_enrollment`
--
ALTER TABLE `officer_enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer_register`
--
ALTER TABLE `officer_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_register`
--
ALTER TABLE `student_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadet_enrollment`
--
ALTER TABLE `cadet_enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `officer_enrollment`
--
ALTER TABLE `officer_enrollment`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `officer_register`
--
ALTER TABLE `officer_register`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_register`
--
ALTER TABLE `student_register`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
