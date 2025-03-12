-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2024 at 01:31 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22155133_barangay433zone44`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `forwho` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `message`, `forwho`, `timestamp`) VALUES
(1, 12, 'Jeremie A. Albaña Requested The Certificate \'First Time Job Seeker\'.', 'admin', '2024-06-18 00:25:11'),
(2, 12, 'Jeremie A. Albaña Requested the Certificate \'Business Permit\'.', 'admin', '2024-06-18 00:39:30'),
(3, 12, 'Jeremie A. Albaña Requested the Certificate \'Certificate of Indigency\'.', 'admin', '2024-06-18 03:21:54'),
(4, 12, 'Your request for file id:  \'\', has been Accepted.', 'user', '2024-06-18 03:25:28'),
(5, 12, 'Your request for file id: 55 \'\', has been Accepted.', 'user', '2024-06-18 03:27:36'),
(6, 12, 'Your request for file id: 54 \'First Time Job Seeker\', has been Accepted.', 'user', '2024-06-18 03:29:10'),
(7, 12, 'Your request for \'Certificate of Indigency\' (id:56), has been Scheduled For Pickup.', 'user', '2024-06-18 03:36:42'),
(8, 12, 'Your request for \'Business Permit\' (id:55), has been Scheduled For Pickup.', 'user', '2024-06-18 04:11:33'),
(9, 12, 'Your request for \'First Time Job Seeker\' (id:54), has been Scheduled For Pickup.', 'user', '2024-06-18 04:15:51'),
(10, 12, 'Your request for \'Barangay Clearance\' (id:53), has been Denied.', 'user', '2024-06-18 04:18:22'),
(11, 12, 'You\'ve claimed your request for \'\', Succesfully.', 'user', '2024-06-18 04:29:12'),
(12, 12, 'User JEREMIE A. ALBAñA have claimed the request for \'\',  Succesfully.', 'admin', '2024-06-18 04:29:12'),
(13, 12, 'You\'ve claimed your request for \'\', Succesfully.', 'user', '2024-06-18 04:29:37'),
(14, 12, 'User JEREMIE A. ALBAñA have claimed the request for \'\',  Succesfully.', 'admin', '2024-06-18 04:29:37'),
(15, 12, 'You\'ve claimed your request for \'\', Succesfully.', 'user', '2024-06-18 04:31:45'),
(16, 12, 'User JEREMIE A. ALBAñA have claimed the request for \'\',  Succesfully.', 'admin', '2024-06-18 04:31:45'),
(17, 12, 'Jeremie A. Albaña Requested the Certificate \'First Time Job Seeker\'.', 'admin', '2024-07-11 16:51:21'),
(18, 12, 'Your request for \'First Time Job Seeker\', has been Accepted.', 'user', '2024-07-11 16:53:08'),
(19, 12, 'Your request for \'First Time Job Seeker\', has been Scheduled For Pickup.', 'user', '2024-07-11 16:53:17'),
(20, 12, 'You\'ve claimed your request for \'\', Succesfully.', 'user', '2024-07-11 04:53:24'),
(21, 12, 'User JEREMIE A. ALBAñA have claimed the request for \'\',  Succesfully.', 'admin', '2024-07-11 04:53:24'),
(22, 12, 'Your request for \'Barangay Clearance\', has been Accepted.', 'user', '2024-07-18 05:49:04'),
(23, 13, 'Zhannien Mhay P. Catubigan Requested the Certificate \'First Time Job Seeker\'.', 'admin', '2024-07-18 05:57:24'),
(24, 12, 'Your request for \'Barangay Clearance\', has been Denied.', 'user', '2024-07-18 06:09:56'),
(25, 13, 'Your request for \'First Time Job Seeker\', has been Accepted.', 'user', '2024-07-18 06:24:10'),
(26, 12, 'Your request for \'Barangay Clearance\', has been Accepted.', 'user', '2024-07-18 06:24:29'),
(27, 12, 'Your request for \'Barangay Clearance\', has been Scheduled For Pickup.', 'user', '2024-07-18 06:24:44'),
(28, 12, 'You\'ve claimed your request for \'Barangay Clearance\', Succesfully.', 'user', '2024-07-18 06:42:49'),
(29, 12, 'User Jeremie A. Albaña have claimed the request for \'Barangay Clearance\',  Succesfully.', 'admin', '2024-07-18 06:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `token`, `expires`, `created_at`) VALUES
(1, 'albana.jeremie.bscs@gmail.com', '5eb453476f2d4f34f686dd2ac8f5cbdf095c4faf4bf4a1e3deb6576df17a8521', 1716922770, '2024-05-28 18:29:31'),
(10, 'espiritu.ma.bscs@gmail.com', '87d48ca993154875899179244a5eb80ef84de51e2a68c8d103af45a3d3f6a485', 1717042925, '2024-05-30 03:52:05'),
(11, 'espiritu.ma.bscs@gmail.com', '668e4069306516819d50a3865b209d132e5931cfe6de02c9fad51ae5badc63a9', 1717042926, '2024-05-30 03:52:07'),
(12, 'espiritu.ma.bscs@gmail.com', 'ced57612ce153578dd5d97f07f19fb89d9074a21cf39adfe51dc6aca5e3eeaea', 1717042947, '2024-05-30 03:52:27'),
(14, 'albana.jeremie.bscs@gmail.com', 'aec1fe870280ab6696968c0ea5fdc6c208471a79a14871bf8dc5f648aa29afff', 1717122460, '2024-05-31 01:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `id` int(15) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`id`, `username`, `password`) VALUES
(1, 'admin123', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9'),
(3, 'admin', '$2y$10$UGigzr.4.w86M0zGlj4/CO/.kjz5axW0wgI2kaUo2P1rHRBo1SjHG');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(15) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `mid_name` varchar(225) NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(12) NOT NULL,
  `birthplace` varchar(225) NOT NULL,
  `sex` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `religion` varchar(225) NOT NULL,
  `address` longtext NOT NULL,
  `city` mediumtext NOT NULL,
  `zip` varchar(225) NOT NULL,
  `citizenship` varchar(225) NOT NULL,
  `contact` varchar(225) NOT NULL,
  `tel` varchar(225) DEFAULT NULL,
  `email` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `last_name`, `first_name`, `mid_name`, `suffix`, `birthdate`, `age`, `birthplace`, `sex`, `status`, `religion`, `address`, `city`, `zip`, `citizenship`, `contact`, `tel`, `email`, `username`, `password`) VALUES
(12, 'Albaña', 'Jeremie', 'A', '', '2001-03-22', 23, 'Manila', 'male', 'Single', 'Catholic', '26 General Tirona, Bagong 2375', 'Caloocan', '1400', 'Filipino', '09167828232', '', 'albana.jeremie.bscs@gmail.com', 'jems123', '$2y$10$n.Hu.TaNf39lDCZIR/ellOLtv7EHHejyVYuSSPLIHhEIGV.SGcf5e'),
(13, 'Catubigan', 'Zhannien Mhay', 'Padogdog', '', '2002-01-07', 22, 'Pasig City', 'female', 'Single', 'Born Again', 'Tawiran St', 'Manila', '1008', 'Filipino', '09339654127', '', 'zhanniencatubigan@gmail.com', 'zhannienmhay', '$2y$10$p8wS.D2gjdlRFHXj0YqisuYDH/r7FM4G4Ghj/jw4Dt0oHBazGEoZO');

-- --------------------------------------------------------

--
-- Table structure for table `user_activty`
--

CREATE TABLE `user_activty` (
  `id` int(15) NOT NULL,
  `email` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `suffix` varchar(225) DEFAULT NULL,
  `file_code` varchar(225) NOT NULL,
  `file_id` int(11) NOT NULL,
  `status` varchar(225) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `date_issued` timestamp NULL DEFAULT NULL,
  `date_denied` timestamp NULL DEFAULT NULL,
  `deny_reason` varchar(225) DEFAULT NULL,
  `reason` longtext NOT NULL,
  `address` longtext NOT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(20) NOT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `b_name` varchar(225) DEFAULT NULL,
  `notified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activty`
--

INSERT INTO `user_activty` (`id`, `email`, `name`, `suffix`, `file_code`, `file_id`, `status`, `timestamp`, `date_issued`, `date_denied`, `deny_reason`, `reason`, `address`, `birthdate`, `age`, `reference_number`, `b_name`, `notified`) VALUES
(12, 'albana.jeremie.bscs@gmail.com', 'Jeremie A. Albaña', '', 'Business Permit', 51, 'Completed', '2024-06-17 23:06:26', '2024-06-17 11:08:05', NULL, NULL, 'Business Permits', '26 General Tirona, Bagong 2375', '2001-03-22', 23, 'REF17186368381251', 'Poster Store', 0),
(12, 'albana.jeremie.bscs@gmail.com', 'Jeremie A. Albaña', '', 'Business Permit', 52, 'Completed', '2024-06-17 23:11:18', '2024-06-17 11:11:52', NULL, NULL, 'Business Permits', '26 General Tirona, Bagong 2375', '2001-03-22', 23, 'REF17186370971252', 'Planned St', 0),
(12, 'albana.jeremie.bscs@gmail.com', 'Jeremie A. Albaña', '', 'Barangay Clearance', 53, 'Completed', '2024-07-18 06:23:50', '2024-07-18 06:42:49', NULL, '', 'Utility Services Applications', '26 General Tirona, Bagong 2375', '2001-03-22', 23, 'REF17212550841253', '', 0),
(12, 'albana.jeremie.bscs@gmail.com', 'Jeremie A. Albaña', '', 'First Time Job Seeker', 54, 'Completed', '2024-06-18 00:25:11', '2024-06-18 04:29:37', NULL, NULL, 'Employment', '26 General Tirona, Bagong 2375', '2001-03-22', 23, 'REF17186553511254', '', 0),
(12, 'albana.jeremie.bscs@gmail.com', 'Jeremie A. Albaña', '', 'Business Permit', 55, 'Completed', '2024-06-18 00:39:30', '2024-06-18 04:29:12', NULL, NULL, 'Employment', '26 General Tirona, Bagong 2375', '2001-03-22', 23, 'REF17186550931255', 'Ps Store', 0),
(12, 'albana.jeremie.bscs@gmail.com', 'Jeremie A. Albaña', '', 'Certificate of Indigency', 56, 'Completed', '2024-06-18 03:21:54', '2024-06-18 04:31:45', NULL, NULL, 'Loan Applications', '26 General Tirona, Bagong 2375', '2001-03-22', 23, 'REF17186530021256', '', 0),
(12, 'albana.jeremie.bscs@gmail.com', 'Jeremie A. Albaña', '', 'First Time Job Seeker', 57, 'Completed', '2024-07-11 16:51:21', '2024-07-11 04:53:24', NULL, NULL, 'Business Permits', '26 General Tirona, Bagong 2375', '2001-03-22', 23, 'REF17206879971257', '', 0),
(13, 'zhanniencatubigan@gmail.com', 'Zhannien Mhay P. Catubigan', '', 'First Time Job Seeker', 58, 'In Process', '2024-07-18 05:57:24', NULL, NULL, NULL, 'Employment', 'Tawiran St', '2002-01-07', 22, NULL, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `user_activty`
--
ALTER TABLE `user_activty`
  ADD PRIMARY KEY (`file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_activty`
--
ALTER TABLE `user_activty`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
