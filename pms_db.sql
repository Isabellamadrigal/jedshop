-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 08:11 PM
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
-- Database: `pms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userName` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `imgPath` text NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userName`, `password`, `name`, `imgPath`, `dateAdded`) VALUES
(1, 'admin', '1234', 'maya', 'default-user.png', '2023-11-19 08:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `clientId` int(32) NOT NULL,
  `vehicleId` int(32) NOT NULL,
  `vehicleProblem` text NOT NULL,
  `requestDate` text NOT NULL,
  `requestStatus` text NOT NULL,
  `remarks` text NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(32) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `contactNo` text NOT NULL,
  `imgPath` text NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `email`, `password`, `name`, `address`, `contactNo`, `imgPath`, `dateAdded`) VALUES
(9, 'jmvallejos1999@gmail.com', '1234', 'jeremiah castro', '185 ca-litang sta maria pang.', '09560951197', '1700507361.jpg', '2023-11-20 19:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `onservice`
--

CREATE TABLE `onservice` (
  `id` int(32) NOT NULL,
  `clientId` int(32) NOT NULL,
  `vehicleId` int(32) NOT NULL,
  `adminId` int(32) NOT NULL,
  `totalPrice` float NOT NULL,
  `serviceStatus` text NOT NULL,
  `paymentStatus` text NOT NULL,
  `dateStart` text NOT NULL,
  `dateEnded` text NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `itemDesc` text NOT NULL,
  `imgPath` text NOT NULL,
  `price` float NOT NULL,
  `visible` text NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `category`, `itemDesc`, `imgPath`, `price`, `visible`, `dateAdded`) VALUES
(6, 'Oil and Filters', 'Sana Oil 2L', 'oil2.jpg', 900, 'visible', '2023-11-20 13:27:18'),
(7, 'oil and filter', 'oil filter na yan insan ', 'filter1.jpg', 250, 'visible', '2023-11-20 12:57:37'),
(8, 'eee', 'Replace Suspension (set)sss', '1700507032.png', 344442, 'hidden', '2023-11-20 19:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `partsavail`
--

CREATE TABLE `partsavail` (
  `id` int(11) NOT NULL,
  `partsId` int(11) NOT NULL,
  `onServiceId` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `serviceavail`
--

CREATE TABLE `serviceavail` (
  `id` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `onServiceId` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servicerequest`
--

CREATE TABLE `servicerequest` (
  `id` int(32) NOT NULL,
  `serviceId` int(32) NOT NULL,
  `appointId` int(32) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(32) NOT NULL,
  `serviceDesc` text NOT NULL,
  `price` float NOT NULL,
  `imgPath` text NOT NULL,
  `visible` text NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(32) NOT NULL,
  `vehicleType` text NOT NULL,
  `make` text NOT NULL,
  `model` text NOT NULL,
  `variant` text NOT NULL,
  `plateNo` text NOT NULL,
  `year` text NOT NULL,
  `clientId` int(32) NOT NULL,
  `vehicleStatus` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onservice`
--
ALTER TABLE `onservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partsavail`
--
ALTER TABLE `partsavail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceavail`
--
ALTER TABLE `serviceavail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicerequest`
--
ALTER TABLE `servicerequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `onservice`
--
ALTER TABLE `onservice`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `partsavail`
--
ALTER TABLE `partsavail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `serviceavail`
--
ALTER TABLE `serviceavail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `servicerequest`
--
ALTER TABLE `servicerequest`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
