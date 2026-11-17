-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2026 at 04:20 PM
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
-- Database: `nvtinews_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) DEFAULT 'Campus',
  `image_url` varchar(255) DEFAULT 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=600&q=80',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `category`, `image_url`, `created_at`) VALUES
(2, 'ANNUAL CONCERT 2026', 'This will be held on 10th December from 8 am', 'Entertainment', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7Zp54UJCw8W4m8PckkpXVyZPtDPB2zjMJjk4oBaa0SO8DMnoTQUjc1OzU&s=10', '2026-11-17 14:14:41'),
(3, 'OPEN DAY 2026', 'This will be held on 1st December from 8 am', 'Campus', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYULl8u9HFH4HfD6VwK-xzguR_D_pIU5_N8iAtRKfq6Q&s=10', '2026-11-17 14:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `event_updates`
--

CREATE TABLE `event_updates` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `news_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_updates`
--

INSERT INTO `event_updates` (`id`, `event_id`, `news_text`, `created_at`) VALUES
(1, 3, 'rehearsals are onward', '2026-11-17 15:06:57'),
(2, 2, 'Final rehearsal will be held on 5th Monday', '2026-11-17 15:12:36'),
(3, 3, 'All the students should perform', '2026-11-17 15:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(2, 'tashi', 'sfsdfgsdf@gmail.com', '$2y$10$j5ErATVI3YxHb1PUeOPvveRrMhlCo.yO4yu9kYHZvlvYr73C.PVhK', 'user'),
(5, 'admin', 'sfrgfhfsdhf@gmail.com', '$2y$10$4.hsWCKdoK/ruf02hSG8rungfQTLxvR26H/3p.VyigBIbIPsM9JWG', 'admin'),
(6, 'nadee', 'ghfghfkighfkhg@gmail.com', '$2y$10$/9VlsVG/nfQZrv9uVQwv3O0dFFu8Oy.AsjZjbdRAzJHVJhw4VNnDS', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_updates`
--
ALTER TABLE `event_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_updates`
--
ALTER TABLE `event_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_updates`
--
ALTER TABLE `event_updates`
  ADD CONSTRAINT `event_updates_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
