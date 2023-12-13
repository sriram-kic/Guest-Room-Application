-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 05:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name_number` varchar(100) NOT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `num_of_beds` int(11) DEFAULT NULL,
  `floor_size_sqft` int(11) DEFAULT NULL,
  `min_booking_period` int(11) DEFAULT NULL,
  `max_booking_period` int(11) DEFAULT NULL,
  `rent_per_day` decimal(10,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `amenities` varchar(255) DEFAULT NULL,
  `additional_details` text DEFAULT NULL,
  `photo_paths` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name_number`, `room_type`, `num_of_beds`, `floor_size_sqft`, `min_booking_period`, `max_booking_period`, `rent_per_day`, `address`, `city`, `country`, `contact_name`, `contact_email`, `contact_phone`, `amenities`, `additional_details`, `photo_paths`) VALUES
(10, 'Hai & 12', 'single', 1, 123, 1, 15, 100.00, 'ds', 'Tiruchirappalli', 'India', 'Nithish G', 'gknithish05@gmail.com', '07904538994', 'Wifi, Parking, Air Conditioning', 'asdfasdfsad', 'uploads/1324832.png'),
(11, 'Hai & 12', 'single', 1, 123, 1, 15, 100.00, 'ds', 'Tiruchirappalli', 'India', 'Nithish G', 'gknithish05@gmail.com', '07904538994', 'Wifi, Parking, Air Conditioning', 'sadfasd', 'uploads/1324832.png'),
(12, 'Hai & 12', 'single', 1, 123, 1, 15, 100.00, 'ds', 'Tiruchirappalli', 'India', 'Nithish G', 'gknithish05@gmail.com', '07904538994', 'Parking, TV', 'asdfas', 'uploads/1324832.png,uploads/NITHISH IDs photo.jpg,uploads/SKILLRACK SQL certificate.png'),
(13, 'Hai & 12', 'single', 1, 123, 1, 15, 100.00, 'ds', 'Tiruchirappalli', 'India', 'Nithish G', 'gknithish05@gmail.com', '7904538994', 'Wifi, Parking, Air Conditioning', 'dsfsafa', 'uploads/1324832.png,uploads/NITHISH IDs photo.jpg,uploads/SKILLRACK SQL certificate.png');

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
(6, 'tamil@gmail.com', '123', 9846555, 'OWNER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
