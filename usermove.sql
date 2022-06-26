-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 27, 2022 at 12:01 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermove`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `ip` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `time_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_end` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`ip`, `email`, `time_start`, `time_end`) VALUES
('::1', 'undefined', '2022-06-26 20:56:32', '2022-06-26 21:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `created_date`) VALUES
(11, 'user2@test.com', 'John', 'Nowman', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 19:12:23'),
(12, 'user2@test.com', '21312321', '32121323', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 19:13:57'),
(13, 'user2@test.com', '21312321', '32121323', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 19:14:12'),
(14, 'checkmaks7@gmail.com', '21312321', '31312312', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 19:15:37'),
(15, 'checkmaks7@gmail.com', '21312321', '31312312', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 19:16:54'),
(16, 'checkmaks7@gmail.com', 'John', 'Nowman', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 19:21:17'),
(17, 'checkmaks71@gmail.com', 'afsasfsaf', 'Nowman', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 19:29:19'),
(18, 'user1@test.com', 'John', 'afssaffsa', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 20:07:21'),
(19, 'user12@test.com', 'John', 'Nowman', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-24 21:33:53'),
(20, '123123@gmail.com', '21312321', 'Nowman', 'adda0b334260c9190fdf1c1eb3b85a0d', '2022-06-26 19:57:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`ip`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
