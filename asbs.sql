-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 06:43 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `transid` int(5) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `transid`, `total`, `date`) VALUES
(18, 3799, 220, '2020-11-06 17:19:00'),
(19, 1731, 220, '2020-11-06 17:19:53'),
(20, 5227, 100, '2020-11-06 17:26:03'),
(21, 7218, 120, '2020-11-06 17:26:35'),
(22, 8148, 220, '2020-11-06 20:41:10'),
(23, 7375, 100, '2020-11-06 22:02:23'),
(24, 7921, 220, '2020-11-10 21:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(50) NOT NULL,
  `transid` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `transid`, `name`, `phone`, `email`, `address`) VALUES
(11, 7218, 'AJIN JOSEPH', '8129988845', 'ajin249@gmail.com', 'KIZHAKKEKARA (H)\r\nNEDUMKANDAM P.O\r\nNEDUMKANDAM'),
(12, 8148, 'AJIN JOSEPH', '8129988845', 'ajin249@gmail.com', 'KIZHAKKEKARA (H)\r\nNEDUMKANDAM P.O\r\nNEDUMKANDAM'),
(13, 7921, 'nikhil', '7895230', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemname`, `price`, `stock`) VALUES
(6, 'Apple', 100, 1),
(7, 'Orange', 80, 1),
(8, 'Grapes', 50, 1),
(9, 'Banana', 50, 1),
(10, 'Mango', 120, 1),
(11, 'Pineapple', 60, 1),
(12, 'Strawberry', 150, 1),
(13, 'Avacado', 90, 1),
(14, 'Guava', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transid` int(5) NOT NULL,
  `item` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transid`, `item`, `amount`, `quantity`, `price`) VALUES
(60, 3799, 'Apple', 100, 1, 100),
(61, 3799, 'Mango', 120, 1, 120),
(62, 1731, 'Apple', 100, 1, 100),
(63, 1731, 'Mango', 120, 1, 120),
(64, 5227, 'Apple', 100, 1, 100),
(65, 7218, 'Mango', 120, 1, 120),
(66, 8148, 'Apple', 100, 1, 100),
(67, 8148, 'Mango', 120, 1, 120),
(77, 7375, 'Apple', 100, 1, 100),
(78, 7921, 'Apple', 100, 1, 100),
(79, 7921, 'Mango', 120, 1, 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `itemname` (`itemname`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
