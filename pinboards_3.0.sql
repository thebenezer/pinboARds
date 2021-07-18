-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2021 at 12:12 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinboards`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `uid` varchar(20) NOT NULL,
  `badge_name` varchar(30) NOT NULL,
  `date_earned` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pinboards`
--

CREATE TABLE `pinboards` (
  `pid` varchar(50) NOT NULL,
  `uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinboards`
--

INSERT INTO `pinboards` (`pid`, `uid`) VALUES
('bob1', 'bob'),
('bob2', 'bob');

-- --------------------------------------------------------

--
-- Table structure for table `pinboard_details`
--

CREATE TABLE `pinboard_details` (
  `num` int(11) NOT NULL,
  `pid` varchar(50) DEFAULT NULL,
  `type` int(11) DEFAULT 1,
  `board_data` varchar(256) DEFAULT NULL,
  `access` int(11) DEFAULT 1,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `boardstatus` varchar(15) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinboard_details`
--

INSERT INTO `pinboard_details` (`num`, `pid`, `type`, `board_data`, `access`, `latitude`, `longitude`, `boardstatus`) VALUES
(19, 'bob1', 1, NULL, 1, 999, 999, 'active'),
(20, 'bob2', 1, NULL, 1, 999, 999, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `email`, `pwd`) VALUES
('bob', 'bob@gmail.com', '$2y$10$Vz/5C1WkA6k7dhn8cil90OdTXEAH0Alu9ZV/twpwIROQwEgcqHZcq');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `uid` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `join_date` date DEFAULT current_timestamp(),
  `address` varchar(50) DEFAULT NULL,
  `phno` varchar(13) DEFAULT NULL,
  `age` int(3) DEFAULT 0,
  `profilepic` varchar(100) NOT NULL DEFAULT 'profilepic.png',
  `backpic` varchar(100) DEFAULT 'back_pic.jpg',
  `about` mediumtext NOT NULL DEFAULT '\'Hi there! I\'m new to pinboARds.\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`uid`, `name`, `join_date`, `address`, `phno`, `age`, `profilepic`, `backpic`, `about`) VALUES
('bob', 'bobby', '2021-07-12', '', '9880819910', 22, 'bob_prof.jpg', 'bob_back.jpg', 'Avid traveller.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`uid`,`badge_name`);

--
-- Indexes for table `pinboards`
--
ALTER TABLE `pinboards`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `pinboard_details`
--
ALTER TABLE `pinboard_details`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pinboard_details`
--
ALTER TABLE `pinboard_details`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badges`
--
ALTER TABLE `badges`
  ADD CONSTRAINT `badges_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `pinboards`
--
ALTER TABLE `pinboards`
  ADD CONSTRAINT `pinboards_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
