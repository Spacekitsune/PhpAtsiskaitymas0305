-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 09:42 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `a_id` int(11) NOT NULL,
  `a_title` varchar(256) COLLATE utf8_lithuanian_ci NOT NULL,
  `a_text` text COLLATE utf8_lithuanian_ci NOT NULL,
  `a_author` varchar(256) COLLATE utf8_lithuanian_ci NOT NULL,
  `a_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`a_id`, `a_title`, `a_text`, `a_author`, `a_date`) VALUES
(1, '50 great summer recipes', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Admin', '2017-11-03 12:23:11'),
(2, 'Another webdew tutorial', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Kuki', '2017-11-25 12:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `cart_userid`
--

CREATE TABLE `cart_userid` (
  `user_id` int(11) NOT NULL,
  `item` varchar(24) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `cart_userid`
--

INSERT INTO `cart_userid` (`user_id`, `item`) VALUES
(6, 'Bandeles'),
(6, 'Kepta vista'),
(6, 'Cementas'),
(6, 'Saldyta pica'),
(6, 'Saldyti koldunai');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(24) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`) VALUES
(1, 'slides'),
(2, 'Dviratis'),
(3, 'Saldyta pica'),
(4, 'Saldyti koldunai'),
(5, 'Bandeles'),
(6, 'Kepta vista'),
(7, 'Cementas'),
(8, 'Vinys');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `user_id` int(11) DEFAULT NULL,
  `average` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`user_id`, `average`) VALUES
(6, 3),
(6, 3),
(6, 5),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` tinytext COLLATE utf8_lithuanian_ci NOT NULL,
  `emailUsers` tinytext COLLATE utf8_lithuanian_ci NOT NULL,
  `pwdUsers` longtext COLLATE utf8_lithuanian_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`, `surname`) VALUES
(1, 'user1', 'user1@mail.com', '$2y$10$iMPtIdYSO66cGZzCBhmMpOqMubuFrK5J6xhEL6HYgeEJ6nST7l1Uq', 'user surname'),
(4, 'user2', 'user2@mail.com', '$2y$10$TXs3R9fZLpnY8ZqM3Ga12ei2pf1DOQhCUQpJHWaXBTJ0UitxKeW36', 'user surname'),
(5, 'user3', 'user3@mail.com', '$2y$10$SKXO78yf0q6aErGAAFSvkekUWi.6Y9i4BGrgmAEMU07YUMXaDxiWq', 'user surname'),
(6, 'kuki', 'kuki@mail.lt', '$2y$10$7iUXoyJbXmm6lKuqCty91uQtKiD8fMV8WSikWoTudja/EY5yBlxje', 'user surname'),
(7, 'Kuki2', 'kuki2@mail.lt', '$2y$10$5Vmz211fksYHQw3YkaYY1uuxxaOLNYDxpR.A/Mu5CQtuUOOGkOFTW', 'user surname');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`idUsers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
