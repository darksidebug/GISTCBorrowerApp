-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 03:29 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borrower`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id` int(11) NOT NULL,
  `transact_type` varchar(50) NOT NULL,
  `borrower_id` varchar(50) NOT NULL,
  `approval_u_id` varchar(50) NOT NULL,
  `approval_u_position` varchar(50) NOT NULL,
  `time_approval` varchar(50) NOT NULL,
  `set_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `transact_type` varchar(50) NOT NULL,
  `ID_num` varchar(10) NOT NULL,
  `date_borrowed` varchar(50) NOT NULL,
  `date_to_returned` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `model_num` varchar(50) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `date_returned` varchar(50) DEFAULT NULL,
  `auth_by_uid` varchar(50) NOT NULL,
  `auth_by_pass` varchar(50) NOT NULL,
  `action_taken` varchar(50) NOT NULL,
  `set_onOff_history` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register_borrower`
--

CREATE TABLE `register_borrower` (
  `id` int(11) NOT NULL,
  `ID_num` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `contact` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_pass` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `name`, `email_pass`, `position`) VALUES
(2, 'nobeginmasob@gmail.com', 'Nobegin Masob', '0df62a5a6fd6631b3132b2024ede1e59', 'Admin'),
(13, '300', 'Jovil Bermoy', '9c5c6c5d26e79bfe1cb780a34428abcf', 'Clerk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_key` (`ID_num`);

--
-- Indexes for table `register_borrower`
--
ALTER TABLE `register_borrower`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_num` (`ID_num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `register_borrower`
--
ALTER TABLE `register_borrower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval`
--
ALTER TABLE `approval`
  ADD CONSTRAINT `borrowId_key` FOREIGN KEY (`id`) REFERENCES `borrow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`ID_num`) REFERENCES `register_borrower` (`ID_num`),
  ADD CONSTRAINT `f_key` FOREIGN KEY (`ID_num`) REFERENCES `register_borrower` (`ID_num`),
  ADD CONSTRAINT `fkey` FOREIGN KEY (`ID_num`) REFERENCES `register_borrower` (`ID_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
