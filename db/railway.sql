-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2022 at 06:39 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railway`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ticket_id` varchar(255) NOT NULL,
  `train_id` varchar(40) NOT NULL,
  `username` varchar(255) NOT NULL,
  `src` varchar(40) NOT NULL,
  `des` varchar(40) NOT NULL,
  `departure_date` date NOT NULL,
  `passenger_name` varchar(255) NOT NULL,
  `no_of_tickets` int(4) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `train_id` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `date` date NOT NULL,
  `ticket_booked` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `train_id` varchar(40) NOT NULL,
  `train_name` varchar(40) NOT NULL,
  `src` varchar(40) NOT NULL,
  `des` varchar(40) NOT NULL,
  `seats` int(4) NOT NULL,
  `fare` int(7) NOT NULL,
  `day` set('Mon','Tue','Wed','Thu','Fri','Sat','Sun') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`train_id`, `train_name`, `src`, `des`, `seats`, `fare`, `day`) VALUES
('ISM101', 'Amber Express', 'Amber', 'NLHC', 50, 10, 'Mon,Tue'),
('ISM102', 'Jasper Express', 'Jasper', 'NLHC', 50, 5, 'Mon,Tue,Fri'),
('ISM103', 'Rosaline Express', 'Rosaline', 'NLHC', 50, 20, 'Tue,Sat,Sun'),
('ISM104', 'Emerald Express', 'Emerald', 'NLHC', 50, 5, 'Tue,Wed,Thu'),
('ISM105', 'Ruby Express', 'Amber', 'Ruby', 25, 25, 'Fri,Sat,Sun'),
('ISM106', 'Diamond Express', 'Diamond', 'NLHC', 50, 15, 'Mon,Tue,Thu,Sun'),
('ISM107', 'Library Express', 'Library', 'NLHC', 50, 20, 'Mon,Wed,Sun');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `age` int(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `gender`, `age`, `email`, `password`, `role`) VALUES
('Admin', 'Male', 18, 'moliy58236@dmtubes.com', '$2y$10$e9pMEMJJbEDOpkhUTPoJQ.IcAkTYwYwjK4Kkw3F0xwHNIIMPsWgle', '1'),
('User', 'Male', 19, 'user@user.com', '$2y$10$b/up6t1BJq2RM6bZUm1V7uGvqjGgBeHCdRbIvflF5jcMwWHQRs6UC', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD KEY `train_id` (`train_id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`train_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
