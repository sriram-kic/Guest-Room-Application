-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 06:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `property_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `owner_id`, `room_number`, `checkin_date`, `checkout_date`, `adults`, `children`, `property_name`, `customer_name`, `customer_email`, `customer_phone`, `booking_date`, `status`) VALUES
(2, 8, 7, '1', '2023-12-16', '2023-12-28', 2, 2, 'NK', 'mani', 'mani@gmail.com', '97904015558', '2023-12-17 00:45:58', 'Booked'),
(3, 5, 6, '21', '2023-12-22', '2023-12-29', 1, 3, 'MKCE', 'Albin', 'aa@gmail.com', '123456789', '2023-12-17 00:49:07', 'Booked'),
(4, 8, 6, '21', '2023-12-22', '2023-12-21', 1, 2, 'MKCE', 'narain', 'nk@gmail.com', '123456789', '2023-12-17 09:16:14', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `num_of_beds` int(11) NOT NULL,
  `floor_size_sqft` int(11) NOT NULL,
  `min_booking_period` int(11) NOT NULL,
  `max_booking_period` int(11) NOT NULL,
  `rent_per_day` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `additional_details` text NOT NULL,
  `photo_paths` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `user_id`, `property_name`, `room_number`, `room_type`, `num_of_beds`, `floor_size_sqft`, `min_booking_period`, `max_booking_period`, `rent_per_day`, `address`, `city`, `country`, `contact_name`, `contact_email`, `contact_phone`, `amenities`, `additional_details`, `photo_paths`, `status`) VALUES
(19, 7, 'NK', '1', 'single', 1, 65, 1, 14, 100, 'asdflkjas', 'adffsa', 'safadsa', 'mani', 'mani@gmail.com', '123456', 'wifi,ac', '', '../uploads/OIP.jpg,../uploads/R.jpg', 'Booked'),
(21, 6, 'MKCE', '21', 'single', 6, 100, 1, 30, 100, 'asdflkjas', 'Karur', 'India', 'kantha', 'kantha@gmail.com', '123456', 'wifi,ac', '', '../uploads/R.jpg', 'Booked'),
(22, 6, 'MKCE', '21', 'single', 6, 100, 1, 30, 100, 'asdflkjas', 'Karur', 'India', 'kantha', 'kantha@gmail.com', '123456', 'wifi,ac', 'ddsafsafas', '../uploads/OIP.jpg,../uploads/R.jpg', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `contact` int(15) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pass`, `contact`, `role`) VALUES
(5, 'abc@gmail.com', '123', 123, 'CUSTOMER'),
(6, 'tamil@gmail.com', '123', 9846555, 'OWNER'),
(7, 'surusri8@gmail.com', '123', 123456789, 'OWNER'),
(8, 'newc@gmail.com', '123', 65689898, 'CUSTOMER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `owner_id` FOREIGN KEY (`owner_id`) REFERENCES `rooms` (`user_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
