-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 05:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_items`
--

CREATE TABLE `auction_items` (
  `A_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `initial_bid` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `category` enum('Electronics','Clothing','Kitchen Items','Furniture','Others') DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auction_items`
--

INSERT INTO `auction_items` (`A_id`, `seller_id`, `name`, `image`, `initial_bid`, `email`, `details`, `approved`, `start_date`, `end_date`, `category`, `feedback`) VALUES
(6, 0, 'test', '../Upload/Account_recommendation.jpg', 100.00, 'user@gmail.com', 'testi test test test test', 1, '2024-07-29', '2024-07-30', NULL, NULL),
(12, 3, 'name', '../Upload/pen_holder.jpg', 20.00, 'user@gmail.com', 'AAAAAAAAAAAAAAAAAAAA', 1, '2024-07-30', '2024-07-31', 'Clothing', NULL),
(14, 3, 'Bike', '../Upload/Bike.jpg', 2000.00, 'user@gmail.com', 'this is limited edition bike,,,,,,,, test test test test test test test test test test test test test test test test test test test test test test', 1, '2024-07-30', '2024-07-31', 'Electronics', NULL),
(15, 6, 'Cycle', '../Upload/Cycle.jpg', 33.00, 'suman@gmail.com', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. At debitis accusantium neque tempore dolor aperiam tempora. Error repellendus laborum necessitatibus, eius nobis nemo corrupti consectetur ex veniam sunt molestiae quod iste eligendi delectus distinction quae magni.', 1, '2024-08-03', '2024-08-09', 'Electronics', NULL),
(18, 6, 'Jacket', '../Upload/jacket.jpg', 10.00, 'suman@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut veritatis dicta alias totam error vel eius voluptatum numquam velit nostrum excepturi adipisci harum earum perspiciatis accusantium in, culpa quo? Assumenda?', 1, '2024-08-05', '2024-08-05', 'Clothing', NULL),
(19, 6, 'Bed', '../Upload/bed.png', 10.00, 'suman@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut veritatis dicta alias totam error vel eius voluptatum numquam velit nostrum excepturi adipisci harum earum perspiciatis accusantium in, culpa quo? Assumenda?', 1, '2024-08-05', '2024-08-05', 'Furniture', NULL),
(20, 6, 'TV', '../Upload/tv.jpg', 10.00, 'suman@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut veritatis dicta alias totam error vel eius voluptatum numquam velit nostrum excepturi adipisci harum earum perspiciatis accusantium in, culpa quo? Assumenda?', 1, '2024-08-05', '2024-08-05', 'Electronics', NULL),
(21, 6, 'Chess Board', '../Upload/chess.jpg', 10.00, 'suman@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut veritatis dicta alias totam error vel eius voluptatum numquam velit nostrum excepturi adipisci harum earum perspiciatis accusantium in, culpa quo? Assumenda?', 1, '2024-08-05', '2024-08-05', 'Others', NULL),
(22, 6, 'Copy', '../Upload/copy.jpeg', 10.00, 'suman@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut veritatis dicta alias totam error vel eius voluptatum numquam velit nostrum excepturi adipisci harum earum perspiciatis accusantium in, culpa quo? Assumenda?', 1, '2024-08-05', '2024-08-05', 'Others', NULL),
(24, 6, 'Shirt', '../Upload/shirt.jpg', 10.00, 'suman@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut veritatis dicta alias totam error vel eius voluptatum numquam velit nostrum excepturi adipisci harum earum perspiciatis accusantium in, culpa quo? Assumenda?', 1, '2024-08-05', '2024-08-05', 'Clothing', NULL),
(25, 6, 'Table', '../Upload/table.jpg', 20.00, 'suman@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut veritatis dicta alias totam error vel eius voluptatum numquam velit nostrum excepturi adipisci harum earum perspiciatis accusantium in, culpa quo? Assumenda?', 1, '2024-08-03', '2024-08-05', 'Furniture', 'gagaga'),
(28, 3, 'Demo', '../Upload/sofa.jpeg', 205.00, 'user@gmail.com', 'test test test test test esttsaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 1, '2024-08-05', '2024-08-06', 'Furniture', ''),
(33, 3, 'rrrrrrrrrrr', '../Upload/sofa.jpeg', 111.00, 'user@gmail.com', 'ttttttttttttttttttttttttttttttttttt', 1, '2024-09-22', '2024-09-24', 'Furniture', ''),
(34, 3, 'ppppppppppp', '../Upload/window.jpeg', 321.00, 'user@gmail.com', 'tttttttttttttttttttttrrrrrrrrrrr', 1, '2024-09-22', '2024-09-26', 'Kitchen Items', 'done'),
(35, 0, 'abdderp', '../Upload/oven.jpeg', 100.00, 'admin@gmail.com', 'ddddddddddddddddddddddddddddddddddddddddddd', 1, '2024-09-22', '2024-09-27', 'Electronics', 'approved'),
(36, 3, 'desk', '../Upload/bed.png', 20.00, 'user@gmail.com', 'dreskk is goodddd', 1, '2024-09-24', '2024-09-27', 'Furniture', 'la theek xa'),
(37, 3, 'windowwww', '../Upload/window.jpeg', 20.00, 'user@gmail.com', 'window is goodddd', 1, '2024-09-24', '2024-09-26', 'Furniture', 'accepted'),
(38, 3, 'abcd', '../Upload/plate.jpg', 111.00, 'user@gmail.com', 'lorem ipson demollllllllll', 1, '2024-09-25', '2024-09-30', 'Electronics', ''),
(39, 3, 'demo 1', '../Upload/oven.jpeg', 20.00, 'user@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt dolore porro ipsum nam maxime nesciunt eaque modi, quas a vitae velit quia ut numquam blanditiis placeat id at molestias. Repellat dolorem odit ipsum rerum non laborum? Iste laudantium distinctio quisquam aut voluptas obcaecati! Quas, quibusdam sunt? Fugit commodi eaque sequi?', 1, '2024-09-29', '2024-10-01', 'Electronics', ''),
(40, 3, 'demo 2', '../Upload/tv.jpg', 20.00, 'user@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt dolore porro ipsum nam maxime nesciunt eaque modi, quas a vitae velit quia ut numquam blanditiis placeat id at molestias. Repellat dolorem odit ipsum rerum non laborum? Iste laudantium distinctio quisquam aut voluptas obcaecati! Quas, quibusdam sunt? Fugit commodi eaque sequi?', 1, '2024-09-29', '2024-10-10', 'Electronics', ''),
(41, 3, 'demo 3', '../Upload/bed.png', 20.00, 'user@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt dolore porro ipsum nam maxime nesciunt eaque modi, quas a vitae velit quia ut numquam blanditiis placeat id at molestias. Repellat dolorem odit ipsum rerum non laborum? Iste laudantium distinctio quisquam aut voluptas obcaecati! Quas, quibusdam sunt? Fugit commodi eaque sequi?', 1, '2024-09-29', '2024-10-10', 'Furniture', ''),
(42, 3, 'demo 4', '../Upload/cap.jpg', 20.00, 'user@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt dolore porro ipsum nam maxime nesciunt eaque modi, quas a vitae velit quia ut numquam blanditiis placeat id at molestias. Repellat dolorem odit ipsum rerum non laborum? Iste laudantium distinctio quisquam aut voluptas obcaecati! Quas, quibusdam sunt? Fugit commodi eaque sequi?', 1, '2024-09-29', '2024-10-10', 'Others', ''),
(43, 3, 'demo 5', '../Upload/vest.jpg', 20.00, 'user@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt dolore porro ipsum nam maxime nesciunt eaque modi, quas a vitae velit quia ut numquam blanditiis placeat id at molestias. Repellat dolorem odit ipsum rerum non laborum? Iste laudantium distinctio quisquam aut voluptas obcaecati! Quas, quibusdam sunt? Fugit commodi eaque sequi?', 1, '2024-09-29', '2024-09-29', 'Clothing', 'approved'),
(44, 8, 'demo 6', '../Upload/dresty use case.jpg', 20.00, 'user2@gmail.com', 'demo 6', 1, '2024-10-02', '2024-10-03', 'Electronics', 'demo'),
(45, 8, 'demo 7', '../Upload/cap.jpg', 20.00, 'user2@gmail.com', 'demo 7', 1, '2024-10-02', '2024-10-03', 'Clothing', 'demo\r\n'),
(46, 3, 'testing 1', '../Upload/shirt.jpg', 30.00, 'user@gmail.com', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi in ullam cum et recusandae inventore dolores minus quis dolor. Fuga! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius dicta repellendus quod totam cum deserunt, alias ea dolore neque, aut nemo quas!', 1, '2024-10-05', '2024-10-08', 'Clothing', 'approved'),
(47, 3, 'testing 2', '../Upload/laptop.jpg', 30.00, 'user@gmail.com', 'lorem lorem demo demo mdeosfoa foufocw ro;ytrr owro QEOR QP\'R CGEIUWEGRI TR', 1, '2024-10-05', '2024-10-09', 'Electronics', 'Demo'),
(48, 3, 'demo demo', '../Upload/copy.jpeg', 500.00, 'user@gmail.com', 'demo demo demo d xger egrxg9xtw49t', 1, '2024-10-06', '2024-10-09', 'Furniture', 'demo'),
(49, 3, 'demo demo', '../Upload/copy.jpeg', 500.00, 'user@gmail.com', 'demo demo demo d xger egrxg9xtw49t', 0, '2024-10-06', '2024-10-09', 'Furniture', 'jj'),
(50, 7, 'testing 2', '../Upload/Untitled design.png', 30.00, 'user1@gmail.com', 'demo', 1, '2024-10-18', '2024-10-22', 'Electronics', 'demo'),
(51, 0, 'testing', '../Upload/cooler.png', 30.00, 'admin@gmail.com', 'demo', 1, '2024-10-18', '2024-10-30', 'Clothing', 'demo'),
(52, 0, 'testing6', '../Upload/plate.jpg', 30.00, 'admin@gmail.com', 'demo', 1, '2024-10-18', '2024-10-30', 'Clothing', 'demo'),
(53, 0, 'testing0', '../Upload/Cycle.jpg', 30.00, 'admin@gmail.com', 'demo', 1, '2024-10-18', '2024-10-30', 'Electronics', 'demo'),
(54, 0, 'testin', '../Upload/spoon.jpeg', 30.00, 'admin@gmail.com', 'demo', 1, '2024-10-18', '2024-10-30', 'Electronics', 'demo'),
(55, 7, 'demo demo demo', '../Upload/jacket.jpg', 333.00, 'user1@gmail.com', 'this is demo demo demo this is demo', 1, '2024-10-28', '2024-10-31', 'Clothing', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `bid_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `bid_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `user_id`, `item_id`, `bid_amount`, `created_at`) VALUES
(1, NULL, 39, 23.00, '2024-09-29 06:45:17'),
(2, NULL, 39, 26.00, '2024-09-29 06:45:41'),
(3, NULL, 39, 28.00, '2024-09-29 06:54:05'),
(4, NULL, 39, 30.00, '2024-09-29 06:55:07'),
(5, NULL, 39, 31.00, '2024-09-29 07:01:32'),
(6, NULL, 40, 22.00, '2024-09-29 07:05:57'),
(7, NULL, 40, 45.00, '2024-09-29 07:07:05'),
(8, NULL, 43, 21.00, '2024-09-29 15:42:08'),
(9, NULL, 43, 27.00, '2024-09-29 15:57:19'),
(10, NULL, 40, 47.00, '2024-09-29 16:02:26'),
(11, NULL, 41, 23.00, '2024-09-29 16:02:36'),
(12, NULL, 39, 37.00, '2024-09-29 16:11:29'),
(13, NULL, 39, 39.00, '2024-09-29 16:11:34'),
(14, NULL, 43, 30.00, '2024-09-29 16:22:28'),
(15, NULL, 39, 41.00, '2024-09-29 16:40:55'),
(16, NULL, 39, 43.00, '2024-09-29 16:52:19'),
(17, NULL, 39, 46.00, '2024-09-29 16:52:51'),
(18, NULL, 39, 48.00, '2024-09-29 16:53:14'),
(19, NULL, 39, 50.00, '2024-09-29 16:53:39'),
(20, NULL, 39, 51.00, '2024-09-29 16:56:40'),
(21, NULL, 39, 53.00, '2024-09-29 16:57:01'),
(22, NULL, 44, 24.00, '2024-10-02 06:49:55'),
(23, NULL, 45, 27.00, '2024-10-02 07:06:01'),
(24, NULL, 45, 29.00, '2024-10-02 07:06:12'),
(25, NULL, 44, 30.00, '2024-10-03 06:15:20'),
(26, NULL, 45, 30.00, '2024-10-03 06:23:48'),
(27, NULL, 45, 34.00, '2024-10-03 06:24:16'),
(28, NULL, 44, 31.00, '2024-10-03 06:24:37'),
(29, NULL, 44, 37.00, '2024-10-03 06:24:46'),
(30, NULL, 44, 38.00, '2024-10-03 06:31:10'),
(31, NULL, 44, 39.00, '2024-10-03 06:32:13'),
(32, NULL, 45, 35.00, '2024-10-03 06:32:24'),
(33, NULL, 45, 39.00, '2024-10-03 06:32:34'),
(34, NULL, 42, 22.00, '2024-10-05 07:16:44'),
(35, NULL, 40, 49.00, '2024-10-05 07:45:45'),
(36, NULL, 40, 55.00, '2024-10-05 07:45:55'),
(37, NULL, 40, 56.00, '2024-10-05 14:19:53'),
(38, NULL, 42, 24.00, '2024-10-05 14:20:02'),
(39, NULL, 42, 26.00, '2024-10-05 14:21:37'),
(40, NULL, 46, 37.00, '2024-10-05 16:24:05'),
(41, NULL, 46, 39.00, '2024-10-05 16:24:38'),
(42, NULL, 46, 42.00, '2024-10-05 16:34:33'),
(43, NULL, 46, 44.00, '2024-10-05 16:45:42'),
(44, NULL, 46, 46.00, '2024-10-05 16:46:12'),
(45, NULL, 41, 24.00, '2024-10-06 03:11:28'),
(46, NULL, 48, 502.00, '2024-10-06 03:34:59'),
(47, NULL, 55, 346.00, '2024-10-28 13:10:31'),
(48, NULL, 55, 348.00, '2024-10-28 13:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `item_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 6, 3, 'hlooooooooooo', '2024-08-03 13:00:25'),
(2, 12, 6, 'this is demo', '2024-08-03 13:03:14'),
(3, 6, 6, 'this is suman rai', '2024-08-03 13:03:37'),
(4, 15, 6, 'hlooooooooo', '2024-08-03 13:21:49'),
(5, 6, 6, 'hlo my name is ....', '2024-08-03 13:57:23'),
(6, 14, 3, 'hello  kjbxajkbxkjabxjkabxajbxajbjabcjabcjaasbncsJ,BCSCVCSMVC SMCV SMCS', '2024-08-04 09:50:50'),
(7, 14, 3, 'HI', '2024-08-04 09:51:02'),
(8, 14, 3, 'K XA', '2024-08-04 09:51:11'),
(9, 14, 3, 'bike ksto xa', '2024-08-04 09:51:21'),
(10, 14, 3, 'majale chALXA', '2024-08-04 09:51:32'),
(11, 14, 3, 'HELLO', '2024-08-04 09:51:40'),
(12, 33, 3, 'isnt 111 high price?', '2024-09-22 09:42:13'),
(13, 36, 3, 'k xa khabar', '2024-09-24 06:16:34'),
(14, 36, 7, 'this is also demo', '2024-09-26 16:11:01'),
(15, 39, 0, 'this is demo', '2024-09-29 06:17:08'),
(16, 39, 0, 'hhh', '2024-09-29 06:20:23'),
(17, 39, 0, 'demo', '2024-09-29 06:29:08'),
(18, 43, 7, 'hello', '2024-09-29 15:57:25'),
(19, 39, 8, 'demooooooo', '2024-09-29 16:11:45'),
(20, 44, 3, 'babbabababaa', '2024-10-02 06:54:10'),
(21, 45, 0, 'demo', '2024-10-02 07:05:54'),
(22, 46, 7, 'demo demo', '2024-10-05 16:24:12'),
(23, 55, 7, 'this is good items', '2024-10-28 13:10:43'),
(24, 55, 8, 'helo testing', '2024-10-28 13:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `N_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`N_id`, `user_id`, `item_id`, `message`, `feedback`, `created_at`) VALUES
(71, 7, 55, 'Your item has been approved.', 'approve', '2024-10-28 13:10:06'),
(72, 7, 55, 'New bid placed on your item: demo demo demo for Rs. 346', NULL, '2024-10-28 13:10:31'),
(73, 7, 55, 'New bid placed on your item: demo demo demo for Rs. 348', NULL, '2024-10-28 13:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `Phone` bigint(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `agreed_to_terms` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `name`, `Phone`, `Email`, `Password`, `role`, `agreed_to_terms`) VALUES
(0, 'user2', 9804042123, 'admin@gmail.com', '$2y$10$kGUxgcFLu4O.9kjE8IyKWuZIyypBTkkLHTKloCTD9eg0tFLD8w6b2', 'admin', 1),
(2, 'Test', 9804042100, 'test@gmail.cm', '$2y$10$keOKW6XTJKCtpVWUPRkCN.z9AHBwQ5UHw0kaWl/tE0Vwh.6EVjH5K', 'user', 0),
(3, 'User', 9804042222, 'user@gmail.com', '$2y$10$c71psERUplfZNqiWSTgjBOwFNK4qLFGSFX.R7S0wkGnmUeSoz3/uG', 'user', 0),
(4, 'Test1', 11, 'test1@gmail.com', '$2y$10$385izveqcg4NufQygnhI..6e0aE4GBMrL8cX6zbg4NqgUkmHDfTA2', 'user', 0),
(5, 'Gaurav Bimali', 9804042123, 'gauravbimali2060@gmail.com', '$2y$10$03oVFCGpALn54wDqPU4H5u1ip.Taowh9wOO3KnSnd/GsU6gvGezxa', 'user', 1),
(6, 'Suman Rai', 1111111117, 'suman@gmail.com', '$2y$10$Nh1j2buDFl.3yQgGSVf6.O7g9eVr88AAs7YjsBi/joaLNUWm10.6m', 'user', 1),
(7, 'user1', 9804042122, 'user1@gmail.com', '$2y$10$k043tPEN6xCpS2ViTCxH/uP2.8BdzAv4lDHJV3l2Cj.VlRbGu39lm', 'user', 1),
(8, 'user2', 9804042123, 'user2@gmail.com', '$2y$10$zCqBro6jo7rcEVhJy8nJpeDxJeLxly7Mqx1iQ.BF9AwH.17uhSc/i', 'user', 1),
(9, 'user3', 9804042124, 'user3@gmail.com', '$2y$10$64iSTwoxf4MqS1xj6Qtn8etTIxGGzEN5Nt7SAvROMbyzEHnoSA93q', 'user', 1),
(10, 'user4', 9804042104, 'user4@gmail.com', '$2y$10$JbyIuY8.L3ymLbTqcWx66ObLS98uCbi5BbneA09JzMj/05E3V0VX6', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction_items`
--
ALTER TABLE `auction_items`
  ADD PRIMARY KEY (`A_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`N_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notifications_fk` (`item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction_items`
--
ALTER TABLE `auction_items`
  MODIFY `A_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `N_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction_items`
--
ALTER TABLE `auction_items`
  ADD CONSTRAINT `auction_items_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `user` (`ID`);

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `auction_items` (`A_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `auction_items` (`A_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_fk` FOREIGN KEY (`item_id`) REFERENCES `auction_items` (`A_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
