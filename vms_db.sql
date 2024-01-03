-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 02:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms_db`
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
(17, 'jacob@gmail.com', 'jacob123', 'Jacob Salvador', 'Urdaneta City', '09178276542', '1700583418.jpeg', '2023-11-21 16:16:58'),
(18, 'stella@gmail.com', 'stella123', 'Stella Salvacion', 'Binalonan', '09098889898', '1700583710.jpg', '2023-11-21 16:21:50'),
(19, 'joseph@gmail.com', 'joseph123', 'Joseph Marco', 'Pozzurobio', '09098765432', '1700617653.webp', '2023-11-22 01:47:33'),
(20, 'ashleysumagaysay1602@gmail.com', 'sumagaysay1602116', 'ashley', 'urdaneta', '09167887654', '1701953229.jpg', '2023-12-07 12:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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

--
-- Dumping data for table `onservice`
--

INSERT INTO `onservice` (`id`, `clientId`, `vehicleId`, `adminId`, `totalPrice`, `serviceStatus`, `paymentStatus`, `dateStart`, `dateEnded`, `dateAdded`) VALUES
(15, 17, 14, 1, 4000, 'finished', 'paid', '2023-11-22 12:24 AM', '2023-11-22 12:24 AM', '2023-11-21 16:24:55'),
(16, 18, 15, 1, 5500, 'finished', 'paid', '2023-11-22 12:24 AM', '2023-11-22 12:24 AM', '2023-11-21 16:25:07'),
(17, 18, 15, 1, 1500, 'finished', 'paid', '2023-11-22 9:53 AM', '2023-11-22 9:53 AM', '2023-11-22 01:53:32'),
(18, 19, 16, 1, 1500, 'finished', 'paid', '2023-11-22 9:53 AM', '2023-11-22 9:53 AM', '2023-11-22 01:53:40');

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
(10, '1', 'A/C Compressor', '1700583195.jfif', 3000, 'visible', '2023-11-21 16:13:21'),
(11, '2', 'Engine Oil', '1700583224.jfif', 500, 'visible', '2023-11-21 16:13:48'),
(12, '1', 'Tires', '1700583245.jfif', 500, 'visible', '2023-11-21 16:14:09');

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

--
-- Dumping data for table `partsavail`
--

INSERT INTO `partsavail` (`id`, `partsId`, `onServiceId`, `dateAdded`) VALUES
(9, 11, 15, '2023-11-21 16:24:21'),
(10, 11, 15, '2023-11-21 16:24:21'),
(11, 10, 16, '2023-11-21 16:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `serviceavail`
--

INSERT INTO `serviceavail` (`id`, `serviceId`, `onServiceId`, `dateAdded`) VALUES
(13, 12, 15, '2023-11-21 16:24:21'),
(14, 9, 15, '2023-11-21 16:24:21'),
(15, 9, 16, '2023-11-21 16:24:34'),
(16, 11, 17, '2023-11-22 01:52:52'),
(17, 11, 18, '2023-11-22 01:53:03');

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

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `serviceDesc`, `price`, `imgPath`, `visible`, `dateAdded`) VALUES
(8, 'Tire Repair', 2000, '1700583043.jfif', 'visible', '2023-11-21 16:10:51'),
(9, 'A/C System Repair', 2500, '1700583073.jfif', 'visible', '2023-11-21 16:11:23'),
(10, 'Air Filter', 1000, '1700583100.jfif', 'visible', '2023-11-21 16:11:43'),
(11, 'Battery Replacement', 1500, '1700583120.jfif', 'visible', '2023-11-21 16:12:05'),
(12, 'Change Oil', 500, '1700583163.jfif', 'visible', '2023-11-21 16:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `vehicleType`, `make`, `model`, `variant`, `plateNo`, `year`, `clientId`, `vehicleStatus`, `date`) VALUES
(14, 'car', 'Toyota', 'Camry', 'LE', 'TCLE234', '2022', 17, 'visible', '2023-11-21 16:20:15'),
(15, 'car', 'Ford', 'Mustang', 'GT', 'FGT123', '2023', 18, 'visible', '2023-11-21 16:22:37'),
(16, 'car', 'Toyota', 'Camry', 'LE', 'LT78YJ', '2022', 19, 'visible', '2023-11-22 01:48:54');

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `onservice`
--
ALTER TABLE `onservice`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `partsavail`
--
ALTER TABLE `partsavail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serviceavail`
--
ALTER TABLE `serviceavail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `servicerequest`
--
ALTER TABLE `servicerequest`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
