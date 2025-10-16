-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2025 at 09:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guesthouse_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `guest_designation` varchar(100) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL DEFAULT 'pending',
  `total_cost` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `guest_name`, `guest_designation`, `checkin_date`, `checkout_date`, `status`, `total_cost`) VALUES
(1, 6, 11, 'A SAHU', 'hr', '2025-10-15', '2025-10-17', 'approved', 0.00),
(2, 6, 6, 'iuhuihiuh', 'hr', '2025-10-18', '2025-10-19', 'rejected', 0.00),
(3, 6, 8, 'raj', 'hr', '2025-10-10', '2025-10-11', 'rejected', 0.00),
(4, 6, 10, 'A SAHU', 'hr', '2025-10-24', '2025-10-26', 'rejected', 2400.00),
(5, 6, 7, 'hj', 'fgjx', '2025-10-16', '2025-10-19', 'pending', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `guesthouses`
--

CREATE TABLE `guesthouses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guesthouses`
--

INSERT INTO `guesthouses` (`id`, `name`, `address`) VALUES
(13, 'VIP karishma guest house', 'Shankar Nagar(Raipur)');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `guesthouse_id` int(11) DEFAULT NULL,
  `room_id` varchar(50) NOT NULL,
  `status` enum('available','booked') DEFAULT 'available',
  `rate_per_day` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `guesthouse_id`, `room_id`, `status`, `rate_per_day`) VALUES
(1, 13, '101-A (Attached)', 'booked', 0.00),
(2, 13, '102-B (Attached)', '', 0.00),
(3, 13, '102-C (NON-Attached)', 'available', 0.00),
(4, 13, '103-D  (Attached)', 'available', 0.00),
(6, 13, '103-E (NON-Attached)', 'available', 0.00),
(7, 13, '103-F (NON-Attached)', 'booked', 0.00),
(8, 13, '601-G (Attached)', 'available', 0.00),
(9, 13, '601-H (Attached)', 'available', 1200.00),
(10, 13, '603-L (ATTACHED)', 'available', 1200.00),
(11, 13, '603-M (NON-ATTACHED)', 'booked', 1200.00),
(12, 13, '603-N (NON-ATTACHED)', 'available', 1200.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `department`, `role`) VALUES
(1, 'Admin User', 'admin@company.com', '$2y$10$XBniG8pAariTjF5DI5pGHOL/MTvLHBVy6o2jrcAZH76/DcKLK1DZe', 'Management', 'admin'),
(3, 'user1', 'user@gmail.com', '$2y$10$.z2J9SaBavqpyjJvUwLvZOE/1sO/QmuXUUnqZ9xsSFDLAZoHlbOe.', 'IT', 'user'),
(4, 'user2', 'user201@gmail.com', '$2y$10$ZXQP3Z4MbqUkxgtyafN5N.Z1l8W8ZlOVXvknM7cvoffipPa5OUo/e', 'sd', 'user'),
(6, 'shreya', 'shreyasahu0112@gmail.com', '$2y$10$XVwkEgZPJE8Y4myXffd/KOd5xEIvv1sE.yWeXzQ4tJSN2SBjR/qmS', 'IT', 'user'),
(8, 'ss', 'shreyasahuu01@gmail.com', '$2y$10$Fff0TFZZqZ2h6phR3VeH6uGhZuP1.PvsMA.fafohZYNxdD0DRL3ja', 'Management', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `guesthouses`
--
ALTER TABLE `guesthouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guesthouse_id` (`guesthouse_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guesthouses`
--
ALTER TABLE `guesthouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`guesthouse_id`) REFERENCES `guesthouses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2025 at 09:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guesthouse_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `guest_designation` varchar(100) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL DEFAULT 'pending',
  `total_cost` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `guest_name`, `guest_designation`, `checkin_date`, `checkout_date`, `status`, `total_cost`) VALUES
(1, 6, 11, 'A SAHU', 'hr', '2025-10-15', '2025-10-17', 'approved', 0.00),
(2, 6, 6, 'iuhuihiuh', 'hr', '2025-10-18', '2025-10-19', 'rejected', 0.00),
(3, 6, 8, 'raj', 'hr', '2025-10-10', '2025-10-11', 'rejected', 0.00),
(4, 6, 10, 'A SAHU', 'hr', '2025-10-24', '2025-10-26', 'rejected', 2400.00),
(5, 6, 7, 'hj', 'fgjx', '2025-10-16', '2025-10-19', 'pending', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `guesthouses`
--

CREATE TABLE `guesthouses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guesthouses`
--

INSERT INTO `guesthouses` (`id`, `name`, `address`) VALUES
(13, 'VIP karishma guest house', 'Shankar Nagar(Raipur)');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `guesthouse_id` int(11) DEFAULT NULL,
  `room_id` varchar(50) NOT NULL,
  `status` enum('available','booked') DEFAULT 'available',
  `rate_per_day` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `guesthouse_id`, `room_id`, `status`, `rate_per_day`) VALUES
(1, 13, '101-A (Attached)', 'booked', 0.00),
(2, 13, '102-B (Attached)', '', 0.00),
(3, 13, '102-C (NON-Attached)', 'available', 0.00),
(4, 13, '103-D  (Attached)', 'available', 0.00),
(6, 13, '103-E (NON-Attached)', 'available', 0.00),
(7, 13, '103-F (NON-Attached)', 'booked', 0.00),
(8, 13, '601-G (Attached)', 'available', 0.00),
(9, 13, '601-H (Attached)', 'available', 1200.00),
(10, 13, '603-L (ATTACHED)', 'available', 1200.00),
(11, 13, '603-M (NON-ATTACHED)', 'booked', 1200.00),
(12, 13, '603-N (NON-ATTACHED)', 'available', 1200.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `department`, `role`) VALUES
(1, 'Admin User', 'admin@company.com', '$2y$10$XBniG8pAariTjF5DI5pGHOL/MTvLHBVy6o2jrcAZH76/DcKLK1DZe', 'Management', 'admin'),
(3, 'user1', 'user@gmail.com', '$2y$10$.z2J9SaBavqpyjJvUwLvZOE/1sO/QmuXUUnqZ9xsSFDLAZoHlbOe.', 'IT', 'user'),
(4, 'user2', 'user201@gmail.com', '$2y$10$ZXQP3Z4MbqUkxgtyafN5N.Z1l8W8ZlOVXvknM7cvoffipPa5OUo/e', 'sd', 'user'),
(6, 'shreya', 'shreyasahu0112@gmail.com', '$2y$10$XVwkEgZPJE8Y4myXffd/KOd5xEIvv1sE.yWeXzQ4tJSN2SBjR/qmS', 'IT', 'user'),
(8, 'ss', 'shreyasahuu01@gmail.com', '$2y$10$Fff0TFZZqZ2h6phR3VeH6uGhZuP1.PvsMA.fafohZYNxdD0DRL3ja', 'Management', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `guesthouses`
--
ALTER TABLE `guesthouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guesthouse_id` (`guesthouse_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guesthouses`
--
ALTER TABLE `guesthouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`guesthouse_id`) REFERENCES `guesthouses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
