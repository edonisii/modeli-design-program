-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 07:59 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modelidesign`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_data`
--

CREATE TABLE `form_data` (
  `id` int(11) NOT NULL,
  `instagram_username` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `dress_model` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`id`, `instagram_username`, `full_name`, `country`, `address`, `phone_number`, `delivery_date`, `order_date`, `dress_model`, `postal_code`, `comment`, `image_path`) VALUES
(2, 'edonisbislimi', 'edonis bislimi', 'Belgjik', 'verban/viiti', '045884806', '2023-12-13', '2023-12-09', 'i gjat', '61000', 'test', 'uploads/cta-bg.webp'),
(3, 'berkan', 'berkan hoxh', 'Belgjik', 'verban/viiti', '6666', '2023-12-16', '2023-12-20', 'i shkurt', '6100', 'test', 'uploads/cta-bg.webp'),
(4, 'test', 'test', 'Belgjik', 'test', '88888', '8888-08-08', '8888-08-08', 'hhhhh', '88888', 'jjjj', NULL),
(5, 'test', 'test', 'Belgjik', 'ddddd', '99999', '9999-09-09', '9999-09-09', 'ddddd', '9999', 'dddd', 'uploads/unnamed.jpg'),
(6, 'test', 'test', 'Belgjik', 'test', '77777', '1111-11-11', '1111-11-11', 'eeee', '5555', 'gyyy', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_data`
--
ALTER TABLE `form_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_data`
--
ALTER TABLE `form_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
