-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307:3307
-- Generation Time: Jul 25, 2026 at 04:59 PM
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
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_booked` tinyint(1) DEFAULT 0,
  `status` varchar(20) DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `doctor_id`, `patient_id`, `specialty`, `date`, `start_time`, `end_time`, `is_booked`, `status`) VALUES
(1, 2, NULL, 'عام', '2026-07-21', '18:49:00', '18:50:00', 0, 'available'),
(2, 2, 10, 'عام', '2026-07-21', '18:49:00', '18:50:00', 1, 'upcoming'),
(3, 3, NULL, 'عام', '2026-07-21', '21:41:00', '21:42:00', 0, 'available'),
(4, 2, NULL, NULL, '2026-07-21', '21:50:00', '21:51:00', 0, 'available'),
(5, 3, NULL, NULL, '2026-07-21', '13:48:00', '14:49:00', 0, 'available'),
(6, 3, NULL, NULL, '2026-07-21', '13:48:00', '14:49:00', 0, 'available'),
(7, 3, NULL, NULL, '2026-07-21', '13:52:00', '14:54:00', 0, 'available'),
(8, 3, NULL, NULL, '2026-07-21', '13:52:00', '14:54:00', 0, 'available'),
(9, 2, NULL, NULL, '2026-07-22', '13:53:00', '15:54:00', 0, 'available'),
(10, 2, 10, NULL, '2026-07-22', '13:53:00', '15:54:00', 1, 'completed'),
(11, 3, 10, NULL, '2026-07-21', '22:59:00', '23:59:00', 1, 'upcoming'),
(13, 2, NULL, NULL, '2026-07-22', '16:32:00', '19:32:00', 0, 'available'),
(14, 2, NULL, NULL, '2026-07-22', '16:32:00', '19:32:00', 0, 'available'),
(15, 2, NULL, NULL, '2026-07-22', '16:32:00', '19:32:00', 0, 'available'),
(16, 2, 10, NULL, '2026-07-22', '19:37:00', '20:37:00', 1, 'upcoming'),
(17, 2, 10, NULL, '2026-07-22', '19:37:00', '20:37:00', 1, 'completed'),
(18, 2, 10, NULL, '2026-07-23', '19:17:00', '20:17:00', 1, 'completed'),
(19, 3, 1151, NULL, '2026-07-24', '18:17:00', '19:20:00', 1, 'completed'),
(20, 3, NULL, NULL, '2026-07-30', '17:30:00', '19:20:00', 0, 'available'),
(21, 2, NULL, NULL, '2026-07-31', '09:00:00', '10:20:00', 0, 'available'),
(22, 3, NULL, NULL, '2026-07-31', '13:00:00', '15:59:00', 0, 'available'),
(23, 3, NULL, NULL, '2026-07-31', '13:00:00', '15:59:00', 0, 'available'),
(24, 2, NULL, NULL, '2026-07-30', '14:00:00', '17:00:00', 0, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USERID` int(11) NOT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `IMAGE` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USERID`, `First_Name`, `Last_Name`, `EMAIL`, `PHONE`, `password`, `role`, `IMAGE`) VALUES
(1, 'Admin', 'System', 'admin@clinic.com', '0590000000', '$2y$10$XXqWjxaFoZZk0PDhRPAWq.iqwFkvigNoXdJ8hPAWbXXSxU/IAX8da', 'admin', 'default.png'),
(2, 'أحمد', 'العام', 'docgeneral@clinic.com', '0591111111', '$2y$10$XXqWjxaFoZZk0PDhRPAWq.iqwFkvigNoXdJ8hPAWbXXSxU/IAX8da', 'doctor', 'default.png'),
(3, 'سارة', 'الأطفال', 'docpediatric@clinic.com', '0592222222', '$2y$10$XXqWjxaFoZZk0PDhRPAWq.iqwFkvigNoXdJ8hPAWbXXSxU/IAX8da', 'doctor', 'default.png'),
(10, 'asmaa', 'as', 'asmaa@gmail.com', '000000', '$2y$10$9rUTA80PukhZsnF18SjG.eGj7O8Ceck/niWc1ynAAvVbLIxl.0W4.', 'user', 'default.png'),
(1151, 'sama', 'suliman', 'sama@gmail.com', '253336', '$2y$10$bu8Gfhsz9PRm4l/7wS0MredvvUVlyNrLWnqogbONXb/wk/hRwPnce', 'user', 'default.png'),
(1158, 'nada', 'suliman', 'nada@gmail.com', '253336', '$2y$10$OmPieT.LSYUPws./adp3FegPXIcYkVppvvWBoUFNlNLKNcOSCFt/W', 'user', 'default.png'),
(1301, 'أحمد', 'العام', 'doc.general@clinic.com', '0591111111', '$2y$10$df2YkIrr12vsPrPJi9PiT.sUIoGNcnLFOHEbG8G4hN/10/M01epqO', 'doctor', 'default.png'),
(1302, 'سارة', 'الأطفال', 'doc.pediatric@clinic.com', '0592222222', '$2y$10$df2YkIrr12vsPrPJi9PiT.sUIoGNcnLFOHEbG8G4hN/10/M01epqO', 'doctor', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1321;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD CONSTRAINT `time_slots_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`USERID`) ON DELETE CASCADE,
  ADD CONSTRAINT `time_slots_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `users` (`USERID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
