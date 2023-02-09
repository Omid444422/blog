-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2022 at 10:07 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_description` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `create_time` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `image_src` text NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ID`, `article_title`, `article_description`, `status`, `create_time`, `views`, `image_src`, `image_alt`, `creator`) VALUES
(2, 'امیدچیست ', 'lthis is test \r\n wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh lorwm wgvth rsh ', 1, '2', 48, 'lorwm wgvth rsh ', 'lorwm wgvth rsh ', 2),
(3, 'this is test ', 'rfwgrthfnmj\r\n\r\nferd,knmbnvbvf\r\n\r\nfsecs\r\nwgvsvd\r\nfvesd', 1, '1', 0, 'uuhhl', '1', 2),
(13, 'third post', 'third post', 1, 'Û²Û°:ÛµÛ°:Û´Ûµ ,Û±Û´Û°Û±/Û¶/Û³Û±', 0, '1663868028.png', '1663868028.png', 14);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `error_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `role_name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'writter');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` int(3) NOT NULL,
  `create_time` varchar(255) DEFAULT NULL,
  `last_login` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `Edited_by` int(11) DEFAULT NULL,
  `creator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Email`, `Password`, `Role`, `create_time`, `last_login`, `status`, `Edited_by`, `creator`) VALUES
(2, 'Omid', 'terminatordfeas@gmail.com', '12', 12, 'Û°Û¸:Û±Ûµ:ÛµÛ´ ,Û±Û´Û°Û±/Û¶/Û²Û·', 'Û²Û±:Û°Û¶:Û°Û³ ,Û±Û´Û°Û±/Û¶/Û³Û±', 0, NULL, ''),
(6, 'mamad ali', 'qfegfvdf@gmail.com', '12', 6, 'Û±Ûµ:Û°Û´:Û´Ûµ ,Û±Û´Û°Û±/Û¶/Û²Û·', NULL, 0, 0, ''),
(7, 'gholi', '1234@test.com', '12', 1, 'Û±Ûµ:Û°Ûµ:Û±Û· ,Û±Û´Û°Û±/Û¶/Û²Û·', NULL, 0, 0, ''),
(8, 'mamad', 'test@gmail.com', '123', 1, 'Û±Û±:Û²Û¶:Û²Û± ,Û±Û´Û°Û±/Û¶/Û³Û°', NULL, 0, NULL, ''),
(9, 'jafar', 'infesvsd@gmail.com', '1234', 1, 'Û±Û±:Û²Û·:Û²Û³ ,Û±Û´Û°Û±/Û¶/Û³Û°', NULL, 0, NULL, 'system'),
(10, 'AHMAD', 'ahmad@gmail.com', '12345', 1, 'Û±Û³:Û°Û¹:Û±Û¸ ,Û±Û´Û°Û±/Û¶/Û³Û°', NULL, 0, NULL, '2'),
(11, 'mohamad', 'mamad@gmail.com', '123456', 1, 'Û±Û³:Û±Û±:Û°Û² ,Û±Û´Û°Û±/Û¶/Û³Û°', NULL, 0, NULL, '2'),
(12, 'kobra', 'kobra@gmail.com', '12346', 1, 'Û±Û³:Û±Û±:Û´Û¸ ,Û±Û´Û°Û±/Û¶/Û³Û°', NULL, 0, NULL, '2'),
(13, 'rqfdgrvdf', 'wegrevdf@gmail.com', '1233r4fe', 1, 'Û±Û³:Û±Û²:Û±Û± ,Û±Û´Û°Û±/Û¶/Û³Û°', NULL, 0, NULL, '2'),
(14, 'Mohammad Mahdi', 'easygamacdsmerdcfsdcsd@gmail.com', '1234', 6, 'Û²Û²:ÛµÛ·:Û²Û´ ,Û±Û´Û°Û±/Û¶/Û³Û°', 'Û²Û±:Û°Û·:Û²Û² ,Û±Û´Û°Û±/Û¶/Û³Û±', 1, 0, '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
