-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 01:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmhc`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `typeofapp` varchar(255) NOT NULL,
  `timeofapp` varchar(255) NOT NULL,
  `dateofapp` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `dateofreq` varchar(255) NOT NULL,
  `now` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `reference`, `fullname`, `suffix`, `age`, `gender`, `contact`, `email`, `address`, `barangay`, `typeofapp`, `timeofapp`, `dateofapp`, `status`, `dateofreq`, `now`) VALUES
(1, 'TPJAUWYD', 'Ethan Cruz Mendoza ', 'None ', '4 years old ', 'Male ', '09924366639 ', 'wasda0939@gmail.com ', '231 ', 'Makina', '    •General consultation check-up  ', '2:00PM to 3:00PM', '2022-11-14', 'Pending', '22-11-10', ''),
(3, '02HLIXK8', 'Hazel Indicio Cadano ', 'None ', '24 years old ', 'Female ', '09636429193 ', 'hazelcadano01@gmail.com ', '925 ', 'Poblacion1', '•Dental      ', '4:00PM to 5:00PM', '2022-11-15', 'Pending', '22-11-10', ''),
(4, 'BSPIUI73', 'Roel Delos Santos Cristobal ', 'None ', '22 years old ', 'Male ', '09757167365 ', 'rdcristobal016@gmail.com ', '545 ', 'Poblacion1', '     •Medical Certificate ', '1:00PM to 2:00PM', '2022-11-14', 'Pending', '22-11-10', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg` varchar(10000) NOT NULL,
  `dateofmsg` varchar(255) NOT NULL,
  `anony` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `fullname`, `email`, `msg`, `dateofmsg`, `anony`) VALUES
(1, '*****', '*****', 'anonymous', '10/12/22', 'on'),
(2, 'Madamba Prinz Gerard Martija ', 'wasda0939@gmail.com', 'not anonymous', '10/13/22', ''),
(3, 'Cristobal Roel Delos Santos ', 'rdcristobal016@gmail.com', 'hi this is not anonymous', '10/26/22', ''),
(5, '*****', '*****', 'surely this is anonymous', '10/26/22', 'on'),
(6, '*****', '*****', 'hi its me anonymous', '11/04/22', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `suffix` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `verifycode` varchar(255) NOT NULL,
  `verified` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `user_id`, `lastname`, `firstname`, `middlename`, `suffix`, `gender`, `dob`, `age`, `contact`, `email`, `address`, `barangay`, `img`, `password`, `confirmpassword`, `usertype`, `verifycode`, `verified`) VALUES
(1, 587218, 'Admin', 'Admin', 'Admin', 'None', 'Male', '1980-04-23', '42 years old', '09319594014', 'baletemho01@gmail.com', '123', 'Poblacion2', 'logo.png', '7a0209d4344eee757265e0d655a9ca2d', '7a0209d4344eee757265e0d655a9ca2d', 'admin', 'ec16198a85ddfcab965a9dc3f6da389a', '1'),
(2, 248096, 'Cristobal', 'Roel', 'Delos Santos', 'None', 'Male', '2000-04-16', '22 years old', '09757167365', 'rdcristobal016@gmail.com', '545', 'Poblacion1', '3_roel.jpg', '27fb9f8216bec9924b3d01500851ab60', '7a0209d4344eee757265e0d655a9ca2d', 'user', '2e72c9b6521d46e955e6fe1fd3078d34', '1'),
(3, 991432, 'Cadano', 'Hazel', 'Indicio', 'None', 'Female', '1998-07-09', '24 years old', '09636429193', 'hazelcadano01@gmail.com', '925', 'Poblacion1', 'IMG_20221009_084613_393.jpg', '7a0209d4344eee757265e0d655a9ca2d', '7a0209d4344eee757265e0d655a9ca2d', 'user', '1c8f6fe3733285a6b897dec31083a2f3', '1'),
(4, 818952, 'Mendoza', 'Ethan', 'Cruz', 'None', 'Male', '2018-04-27', '4 years old', '09924366639', 'wasda0939@gmail.com', '231', 'Makina', 'avat.png', '7a0209d4344eee757265e0d655a9ca2d', '7a0209d4344eee757265e0d655a9ca2d', 'user', 'fbd06b01b4576774b1e0f029109e9c12', '1'),
(5, 479418, 'qwe', 'qwe', 'qwe', 'None', 'Male', '2022-10-30', '1 week old', '09523543564', 'sample@gmail.com', 'd', 'Sampalocan', 'avat.png', '7a0209d4344eee757265e0d655a9ca2d', '7a0209d4344eee757265e0d655a9ca2d', 'user', 'c0b56377760ebd9154c9fef273de39ed', '0');

-- --------------------------------------------------------

--
-- Table structure for table `resetpass`
--

CREATE TABLE `resetpass` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resetpass`
--
ALTER TABLE `resetpass`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resetpass`
--
ALTER TABLE `resetpass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
