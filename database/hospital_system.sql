-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 01:02 AM
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
-- Database: `hospital_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Confirmed','Completed','Cancelled','No-Show') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `reason`, `status`, `created_at`) VALUES
(1, 1, 2, '2026-05-19', '15:20:00', 'General Checkup', 'Pending', '2026-05-17 07:20:34'),
(2, 1, 2, '2026-05-19', '15:20:00', 'General Checkup', 'Pending', '2026-05-17 07:20:58'),
(3, 1, 2, '2026-05-20', '15:27:00', 'General Checkup', 'Pending', '2026-05-17 07:23:17'),
(4, 1, 3, '2026-05-20', '16:30:00', 'General Checkup', 'Pending', '2026-05-17 07:26:10'),
(5, 1, 3, '2026-05-27', '04:08:00', 'General Checkup', 'Pending', '2026-05-17 19:06:01'),
(6, 1, 3, '2026-05-27', '04:08:00', 'General Checkup', 'Pending', '2026-05-17 19:06:13'),
(8, 6, 2, '2026-05-11', '15:28:00', NULL, 'Cancelled', '2026-05-17 19:26:23'),
(9, 6, 3, '2026-05-27', '16:55:00', NULL, 'Cancelled', '2026-05-17 19:52:29'),
(10, 6, 3, '2026-05-20', '17:56:00', NULL, 'Cancelled', '2026-05-17 19:54:03'),
(11, 6, 3, '2026-05-20', '16:00:00', NULL, 'Cancelled', '2026-05-17 19:56:59'),
(12, 6, 2, '2026-05-26', '17:34:00', NULL, 'Cancelled', '2026-05-17 20:31:06'),
(13, 6, 2, '2026-05-27', '20:40:00', NULL, 'Cancelled', '2026-05-17 20:35:43'),
(15, 7, 2, '2026-05-27', '12:00:00', NULL, 'Cancelled', '2026-05-17 21:33:59'),
(16, 7, 2, '2026-05-27', '11:00:00', NULL, 'Cancelled', '2026-05-17 21:36:06'),
(17, 8, 2, '2026-05-20', '10:00:00', NULL, 'Cancelled', '2026-05-17 21:52:23'),
(18, 8, 2, '2026-05-19', '12:00:00', NULL, 'Cancelled', '2026-05-17 22:16:29'),
(19, 8, 3, '2026-05-20', '04:00:00', NULL, 'Pending', '2026-05-17 22:16:47'),
(20, 8, 3, '2026-05-20', '12:00:00', NULL, 'Pending', '2026-05-17 22:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `specialization_id` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `consultation_fee` decimal(10,2) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `available_days` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `specialization_id`, `bio`, `consultation_fee`, `photo_path`, `available_days`, `created_at`) VALUES
(2, 4, 3, 'Dr.Anto - General Physician', 500.00, NULL, 'Monday,Tuesday,Wednesday', '2026-05-17 06:50:01'),
(3, 4, 1, 'Dr.Anto - General Physician', 500.00, NULL, 'Tuesday,Wednesday', '2026-05-17 06:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`) VALUES
(1, 'General'),
(2, 'Cardiology'),
(3, 'Dentist'),
(4, 'Dentist');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` enum('patient','doctor','admin') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `age` int(3) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `dob`, `blood_group`, `phone`, `is_active`, `created_at`, `age`, `gender`) VALUES
(1, '', '', '', NULL, NULL, NULL, NULL, 1, '2026-05-16 18:40:43', NULL, NULL),
(4, 'tasrif023', 'tasrif@gmail.com', '$2y$10$5HJfuWngplPpSIw0G3pJPe3JOo/vAIPfXipat.CseKrwLd/kIpy4a', NULL, NULL, NULL, NULL, 1, '2026-05-16 20:37:07', NULL, NULL),
(6, 'Bura', 'bura@gmail.com', '$2y$10$U6jJy9ESYiE1l9dHANLNR.0d5EFH7FN8TXVYseTCzbOvxy7ZxJOYe', NULL, NULL, 'B+', '01641805190', 1, '2026-05-17 19:00:18', 23, 'Male'),
(7, 'Bura', 'b@gmail.com', '$2y$10$IydMzOWzuPZvGEHn0ABLU.36Yajw30E4VRbJ6CjuqEdlVvouUgBX6', 'patient', '0000-00-00', 'A+', '01641805190', 1, '2026-05-17 21:06:56', NULL, NULL),
(8, 'T', 't@gmail.com', '$2y$10$z6y9UPKpIk6hvheBxFu3BudnuVYL.zxdnkRUcvTCq.yOTeHfbwFbG', 'patient', '2026-05-21', 'A+', '01641805190', 1, '2026-05-17 21:51:55', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `specialization_id` (`specialization_id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
