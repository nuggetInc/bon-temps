-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2022 at 07:19 AM
-- Server version: 10.9.3-MariaDB
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bon_temps`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phonenumber` varchar(16) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `archived`) VALUES
(1, 'dish1', 0),
(2, 'dish2', 0),
(3, 'dish3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dishingredients`
--

CREATE TABLE `dishingredients` (
  `dish_id` int(10) UNSIGNED NOT NULL,
  `ingredient_id` int(10) UNSIGNED NOT NULL,
  `amount` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `amount` float UNSIGNED NOT NULL,
  `unit` varchar(8) NOT NULL,
  `price` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `menudishes`
--

CREATE TABLE `menudishes` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `dish_id` int(10) UNSIGNED NOT NULL,
  `price` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `menudishes`
--

INSERT INTO `menudishes` (`menu_id`, `dish_id`, `price`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(2, 1, 0),
(2, 2, 0),
(2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `date`) VALUES
(1, 'menu1', '2022-09-27'),
(2, 'menu2', '2022-09-28'),
(3, 'menu3', '2022-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `reservationdishes`
--

CREATE TABLE `reservationdishes` (
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `dish_id` int(10) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `type` enum('customer','employee') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`) VALUES
(1, 'cas', '$2y$10$zTkrjirZO15lgVybyMSiIuPdrlhgP27MgXgjM/kbA75RtmqAZuUoG', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archived` (`archived`);

--
-- Indexes for table `dishingredients`
--
ALTER TABLE `dishingredients`
  ADD PRIMARY KEY (`dish_id`,`ingredient_id`),
  ADD KEY `dish_id` (`dish_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menudishes`
--
ALTER TABLE `menudishes`
  ADD PRIMARY KEY (`menu_id`,`dish_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `menudishes_ibfk_1` (`dish_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `reservationdishes`
--
ALTER TABLE `reservationdishes`
  ADD PRIMARY KEY (`reservation_id`,`dish_id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `dish_id` (`dish_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dishingredients`
--
ALTER TABLE `dishingredients`
  ADD CONSTRAINT `dishingredients_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`),
  ADD CONSTRAINT `dishingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`);

--
-- Constraints for table `menudishes`
--
ALTER TABLE `menudishes`
  ADD CONSTRAINT `menudishes_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menudishes_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
