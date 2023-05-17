-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 11:16 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `melksinvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cname` varchar(40) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` varchar(40) NOT NULL,
  `amount` varchar(40) NOT NULL,
  `tamount` varchar(60) NOT NULL,
  `order_no` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `cname`, `item`, `quantity`, `amount`, `tamount`, `order_no`, `phone`, `date`) VALUES
(1, 9, 'Zita', 'abacha', '2', '400', '800', 'MELKS-146700', '08159043899', '2023-05-14 17:15:06'),
(2, 9, 'Mr. Chinedu Okafor', 'Comfortable sets of chair', '1', '250000', '250000', 'MELKS-141000', '08159043899', '2023-05-14 17:25:45'),
(3, 9, 'sister onyinye', 'Sharwama', '1', '2000', '2000', 'MELKS-149100', '2222222222', '2023-05-14 18:01:34'),
(4, 9, 'sister onyinye', 'Bags of fufu', '3', '490000', '150,000', 'MELKS-136200', '33333333333', '2023-05-14 19:35:40'),
(5, 10, 'Tochukwu', 'Ice', '800', '43', '86', 'MELKS-149700', '00000000000', '2023-05-15 07:31:33'),
(6, 10, 'Nelo', 'Yaga', '2', '200', '400', 'MELKS-140100', '678999999', '2023-05-15 07:35:12'),
(7, 10, 'Finished', 'Yaga', '2', '200', '400', 'MELKS-141300', '39948858', '2023-05-15 07:36:18'),
(8, 10, 'Drip Xchange', 'Web Development', '1', '40000', '40000', 'MELKS-138000', '08023466799', '2023-05-15 07:45:40'),
(9, 8, 'Mr. Emmanuel Oli', 'Single Sofa', '2', '120,000', '240,000', 'MELKS-150000', '07033144612', '2023-05-16 11:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `date` varchar(60) NOT NULL,
  `active` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `date`, `active`) VALUES
(3, 'Phunsuk Wangudhu', 'phentai@hotmail.com', '$2y$10$FGs6tOJxvU9NyD8fgWx3n.HH1osX09u0dBOdc1vr9HMP/ghvJLvEm', '2023-05-10 03:12:42', NULL),
(4, 'Nelo Zita', 'zitaonyima@gmail.com', '$2y$10$20IIqvGNfb2yj6SedEX2hOj1ipEaPbwrlozXcsmQUXfX4qWjObZP2', '2023-05-10 12:12:01', NULL),
(8, 'walter Obinabo', 'wallyobinabo@gmail.com', '$2y$10$dwn1lxytYxj9yrK5L5n8Pu31X5U77ViWsBtPt0C2tvSOxgDw2NAVe', '2023-05-10 17:29:15', NULL),
(9, 'Wally Nwa', 'walterobinabo@gmail.com', '$2y$10$p50C82emv56MTI13h4YWE./EU1xWdD1w8mIvBXSfiGJ3LhStKyhRy', '2023-05-10 17:33:03', NULL),
(10, 'Drip Xchange', 'drip@gmail.com', '$2y$10$YNQ.1TQP8Eo9hLwIpD0c0.lolt7d/3pHZxRHmhzg0A8aFyT0lpg4G', '2023-05-11 15:40:30', NULL),
(11, 'Wally O\\\'brian', 'walterobinabo@hotmail.com', '$2y$10$L9u.gM4oL5C/JrgEXuILxeElQMc62WR/UwDNVND33yGyJROSUaTq.', '2023-05-17 03:41:58', NULL),
(12, 'Wally West', 'obinabowalter@gmail.com', '$2y$10$pFHG1IjYdABzmc/my64heu7qYBSFhZ.QoTyaVuoK0p1khxANrWYWS', '2023-05-17 10:47:32', '06a448d9de5786defd640ab78eef2fbb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
