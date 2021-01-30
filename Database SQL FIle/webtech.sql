-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 01:40 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtech`
--
CREATE DATABASE IF NOT EXISTS `webtech` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webtech`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hiredate` date NOT NULL,
  `resignDate` date DEFAULT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `password`, `phone`, `email`, `hiredate`, `resignDate`, `address`) VALUES
(17, 'admin', 'admin', '$2y$10$JbHYE0LsE0gWtnQXM3Xx5O9IwfgOkAkONR6SaV5/XCxYvGmnp8gDu', '00000000000', 'admin@admin.com', '2020-09-22', NULL, 'admin'),
(18, 'chisty', 'Chisty , Muzammel Hossain', '$2y$10$qM/iprkA2ikLQZxMuHGtBuA9k9pX1nQGbp4VDyacSdK96m1cCBd4u', '01478956875', 'chistyz10@gmail.com', '2020-09-22', NULL, 'Dhaka'),
(19, 'nibras', 'Nibras Khan', '$2y$10$rfi.cR13VTo2cb.1NvhnheksBb9sxfEGLoKj.N1FGk87MPIG7D58.', '01578794986', 'khan.nibras@gmail.com', '2020-09-22', NULL, 'Chittagong'),
(20, 'imran', 'Umar Faruque Imran', '$2y$10$v4BKq8h3ZKiMb34M8SruBe7YPd0AmhFwn01AlQdIiR/wiNHBgVqN6', '01744198979', 'ufimran@gmail.com', '2020-09-22', NULL, 'Dhaka'),
(21, 'tausif', 'Tausiful Bari', '$2y$10$16fjwVxdxuaDeXhtIF9qAeBIk8ZzZ1ILdxzUU1p7F9yWG5nBk3wnS', '01457845698', 'bari.tausiful@gmail.com', '2020-09-22', NULL, 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(5) NOT NULL,
  `dateTime` datetime NOT NULL,
  `appointment_query` text NOT NULL,
  `patientId` int(5) NOT NULL,
  `doctorId` int(5) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `dateTime`, `appointment_query`, `patientId`, `doctorId`, `status`) VALUES
(27, '2020-09-23 16:38:00', 'I am sick', 32, 14, 5),
(28, '2020-09-23 16:38:00', 'Very Vey Sick.', 31, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `Address` text NOT NULL,
  `hireDate` date NOT NULL,
  `resignDate` date DEFAULT NULL,
  `visitingHour` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Speciality` varchar(50) NOT NULL,
  `Details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `username`, `Name`, `password`, `phone`, `Address`, `hireDate`, `resignDate`, `visitingHour`, `email`, `Speciality`, `Details`) VALUES
(12, 'jahangirDoc', 'Dr. Mohammad Jahangir Talukder', '$2y$10$mdMCEiPJz07CxRxKw8tXWu9.Oyb94sjmFee48NtY0bvFHXQKxoeqi', '01998524666', 'Plot 15, Road 71, Gulshan, Dhaka 1212, Bangladesh', '2020-09-22', NULL, '00:00-02:00', 'jahangir@docmail.com', 'Internal Medicine', 'MBBS(Ctg), MRCP(UK), MRCP (Edin)'),
(13, 'saha', 'Prof. Dr. R. K. Saha', '$2y$10$HdKalBHZh3ON0wrr5rFoI.Qhto6DHpOE7IF80q8Ie0ZYcJOOk8DBm', '01711245746', 'Uttara', '2020-09-22', NULL, '16:00-17:00', 'saha@docmail.com', 'Professor Of Medicine', 'Ex Principal and Professor and Head Dept of Medicine, Sher-E-Bangla Medical College, Barisal and Uttara Women\'s Medical College Hospital, Dhaka'),
(14, 'reza', 'Dr. Abu Reza Mohammad Nooruzzaman', '$2y$10$32boA/Ny9X3CX4VI4HoOIuz6ciNuHKtqK8Xs6eEb8EvvRM0yzv5R.', '01981423334', '18/F West Panthapath, Dhaka - 1205, Bangladesh.', '2020-09-22', NULL, '16:00-18:00', 'drnzaman@squarehospital.com', 'Internal Medicine', 'MBBS, FCPS');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `dateOfBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `username`, `Name`, `password`, `phone`, `email`, `address`, `dateOfBirth`) VALUES
(31, 'karim', 'Abdul Karim', '$2y$10$i9JaaP.jtY.SBIJoSFTjhOIIjd2tWg6.MB06dwYykjTOJBpaFIH2K', '01457845691', 'sadsa@gmail.com', 'Dhaka', '1997-09-02'),
(32, 'fardit', 'Fardit Ahmed Shawkot', '$2y$10$itS6.e.MPe2E8Rlt4xn2fe9RjU1kI24TQxnB4fyRee9jUwEhr6uWq', '01234567847', 'fardit@gmail.com', 'Banasree,Dhaka', '1998-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(5) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Query` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateTime` datetime NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`id`, `Name`, `Query`, `email`, `dateTime`, `status`) VALUES
(19, 'Imran', 'I am very Sick Please Give me a Solution.', 'imran@gmail.com', '2020-09-22 03:48:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `hiredate` date NOT NULL,
  `resignDate` date DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `username`, `Name`, `password`, `address`, `phone`, `hiredate`, `resignDate`, `email`) VALUES
(3, 'sunny', 'Money Sunny ', '$2y$10$M/fhcP0P0fvBUaGB05dBwedArK9Vj4CKOIPFfe/fDF5HI58ZuuPGy', 'Dhaka', '01254635872', '2020-09-22', NULL, 'sunny@gmail.com'),
(4, 'Faruk', 'Md. Faruk', '$2y$10$5t7ngxHthBiUobA/LLp29uw6ojzZKGKECYOcpXnhxIT0VknvEgSbW', 'Barishal', '01254635835', '2020-09-22', NULL, 'faruk@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
