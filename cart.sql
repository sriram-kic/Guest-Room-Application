-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 07:37 AM
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
(5, 10, 9, '2A', '2023-12-17', '2023-12-20', 1, 2, 'VKN Guest', 'John', 'john@gmail.com', '12345678', '2023-12-17 11:50:17', 'Booked'),
(6, 13, 12, '27A', '2023-12-18', '2023-12-22', 2, 1, 'Icehotel', 'Narain', 'narain@gmail.ccom', '9856236524', '2023-12-17 12:05:16', 'Booked');

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
(23, 9, 'MKCE', '21', 'single', 6, 100, 1, 30, 100, '24, Main Road', 'Karur', 'India', 'kantha', 'kantha@gmail.com', '123456', 'wifi,ac, parking', 'TV', '../uploads/OIP.jpg,../uploads/R.jpg', 'Available'),
(24, 9, 'VKN Guest', '2A', 'single', 1, 150, 1, 15, 500, '15, North Street', 'Karur', 'India', 'Mohan', 'mohan@gmail.com', '6589526521', 'wifi,ac, parking', 'sdfsad', '../uploads/OIP.jpg,../uploads/R.jpg', 'Booked'),
(25, 9, 'Maharaja Residency', '5B', 'double', 2, 250, 1, 25, 100, '8, Cross Street', 'Karur', 'India', 'Muthu', 'muthu@gmail.com', '656158788', 'wifi,ac, parking', 'tv, extra bed available', '../uploads/OIP.jpg,../uploads/R.jpg', 'Available'),
(26, 12, 'Icehotel', '27A', 'single', 2, 110, 1, 10, 800, '8, South Street', 'Karur', 'India', 'peter', 'peter@gmail.com', '656565', 'wifi,ac, parking', '', '../uploads/kama1.jpg,../uploads/OIP (1).jpg', 'Booked'),
(27, 12, 'Sugar loft aparment', '13D', 'single', 2, 80, 1, 18, 600, '8, East car', 'Karur', 'India', 'mani', 'mani@gmail.com', '656895622', 'wifi,ac, parking', 'tv', '../uploads/kama1.jpg,../uploads/6209818.jpg', 'Available'),
(28, 12, 'Arctic SnowHotel & Glass Igloos', '23F', 'double', 3, 250, 1, 21, 1200, '8, North car', 'Karur', 'India', 'mani', 'mani@gmail.com', '6568968', 'wifi,ac, parking', 'tv', '../uploads/kama1.jpg,../uploads/OIP (1).jpg,../uploads/6209818.jpg', 'Available');

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
(9, 'testhouse@gmail.com', 'Hai@12345', 2147483647, 'OWNER'),
(10, 'testcus@gmail.com', 'cus@12345', 985624546, 'CUSTOMER'),
(12, 'testow@gmail.com', 'ow@2345', 56686587, 'OWNER'),
(13, 'cus@gmail.com', 'cus@123', 98526523, 'CUSTOMER');

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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
