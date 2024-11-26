-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 11:48 AM
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
-- Database: `pandapatan_yasser`
--

-- --------------------------------------------------------

--
-- Table structure for table `yjp_users`
--

CREATE TABLE `yjp_users` (
  `id` int(11) NOT NULL,
  `yjp_last_name` varchar(255) NOT NULL,
  `yjp_first_name` varchar(255) NOT NULL,
  `yjp_email` varchar(255) NOT NULL,
  `yjp_gender` enum('Male','Female','Other') NOT NULL,
  `yjp_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yjp_users`
--

INSERT INTO `yjp_users` (`id`, `yjp_last_name`, `yjp_first_name`, `yjp_email`, `yjp_gender`, `yjp_address`) VALUES
(32, 'does', 'qwe', 'jd@gmail.com', 'Male', 'qqq'),
(33, 'mmmmm', 'mmmm', 'mmmmmmm@gmail.com', 'Male', 'mmmmmmmmm'),
(34, 'carpio', 'janrey', 'johnraycarpio1404@gmail.com', 'Male', 'zzzzzzzzzzzz'),
(35, 'cxcxcxc', 'cxcxc', 'xcxcxc@gmail.com', 'Male', 'mmmmmmmm'),
(36, 'Pandapatan', 'Yasser', 'yasserpandapatan@gmail.com', 'Male', 'cccccccccc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `yjp_users`
--
ALTER TABLE `yjp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yjp_email` (`yjp_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `yjp_users`
--
ALTER TABLE `yjp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
