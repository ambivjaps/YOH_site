-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 11:08 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yoh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_db`
--

CREATE TABLE `admin_db` (
  `id` bigint(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `user_rank` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_db`
--

INSERT INTO `admin_db` (`id`, `admin_email`, `admin_pass`, `user_rank`) VALUES
(1, 'admin', '$2y$10$MqtvOXz4p2Rg4sT7ICeWgeTkEyO5biTtG9A6sxNX/hx', 'admin'),
(2, 'admin@admin.com', '12345678', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cust_profile`
--

CREATE TABLE `cust_profile` (
  `id` bigint(20) NOT NULL,
  `c_id` bigint(12) NOT NULL,
  `c_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `region` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `street` varchar(60) NOT NULL,
  `building` varchar(60) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `zip_code` int(12) NOT NULL,
  `unit_no` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_profile`
--

INSERT INTO `cust_profile` (`id`, `c_id`, `c_name`, `email`, `region`, `city`, `street`, `building`, `phone_no`, `zip_code`, `unit_no`, `date`, `address`) VALUES
(2, 1946032413, 'JJ CA', 'jjca@gmail.com', '4A', 'Antipolo City', 'Nightingale st.', 'NA', '09954490438', 1870, 21, '2023-02-20 22:05:15', '#3 Coco Street, ABS-CBN Village, Quezon City, NCR'),
(3, 9871989888, 'Juan Dela Cruz', 'juandelacruz@gmail.com', 'NCR', 'Quezon City', 'Coco Street', 'N/A', '09313456789', 520, 3, '2023-02-19 10:50:43', '#3 Coco Street, ABS-CBN Village, Quezon City, NCR'),
(4, 4097611313, 'Japs Sing', 'japsing@gmail.com', 'NCR', 'Manila', 'Sampaloc', 'NA', '09312345678', 432, 10, '2023-02-19 14:39:56', '#10 Sampaloc st., Manila, NCR'),
(5, 5596544577, 'Japs Sing', 'japsing@gmail.com', 'NCR', 'Manila', 'Sampaloc', 'NA', '09312345678', 432, 10, '2023-02-19 14:41:42', '#10 Sampaloc st., Manila, NCR');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_db`
--

CREATE TABLE `inventory_db` (
  `id` bigint(20) NOT NULL,
  `ItemID` bigint(20) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemImg` varchar(255) NOT NULL,
  `ItemDesc` text NOT NULL,
  `ItemType` varchar(255) NOT NULL,
  `ItemPrice` int(12) NOT NULL,
  `ItemQty` int(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_db`
--

INSERT INTO `inventory_db` (`id`, `ItemID`, `ItemName`, `ItemImg`, `ItemDesc`, `ItemType`, `ItemPrice`, `ItemQty`, `created_at`) VALUES
(1, 1001, 'Beginner Crochet Kit', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 200, 10, '2023-02-20 21:32:43'),
(2, 1002, 'Handmade Crochet II Ghibli Earrings', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 150, 2, '2023-02-20 18:38:20'),
(3, 1003, 'Boo Tao Crochet Plush (Quincy x Kira Collab)', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 450, 6, '2023-02-20 18:38:16'),
(4, 1004, 'Crocheted Seventeen Carat Bong Strap', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 250, 30, '2023-02-20 18:38:11'),
(5, 1005, 'Archon Gemmies Plush (Quincy X Kira Collab)', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 250, 100, '2023-02-20 18:38:14'),
(6, 1006, 'Happy Little Keychains', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 250, 5, '2023-02-20 18:38:56'),
(7, 1007, 'Blackpink Lightstick Strap', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 300, 20, '2023-02-20 18:39:47'),
(8, 1008, 'Busog Meal: Sisig', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 31, 5, '2023-02-20 18:41:37'),
(9, 1009, 'Busog Meal: Bopis', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 31, 12, '2023-02-20 18:41:35'),
(10, 1010, 'Busog Meal: Giniling', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 31, 22, '2023-02-20 18:41:33'),
(11, 1011, 'Hungarian Sausage', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 31, 10, '2023-02-20 18:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders_db`
--

CREATE TABLE `orders_db` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` bigint(20) NOT NULL,
  `cust_name` varchar(60) NOT NULL,
  `cust_email` varchar(60) DEFAULT NULL,
  `cust_pass` varchar(50) NOT NULL,
  `cust_reg` varchar(60) CHARACTER SET latin1 NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_st` text NOT NULL,
  `cust_bldg` varchar(50) NOT NULL,
  `cust_unit` int(11) NOT NULL,
  `cust_zip` int(10) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `cust_id` bigint(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_rank` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'user',
  `cust_address` varchar(60) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `cust_name`, `cust_email`, `cust_pass`, `cust_reg`, `cust_city`, `cust_st`, `cust_bldg`, `cust_unit`, `cust_zip`, `cust_phone`, `cust_id`, `date`, `user_rank`, `cust_address`, `status`) VALUES
(1, 'ako lang to', 'akolangtosapusomo@gmail.com', '1234', '4A', 'Antipolo', 'sa puso mo', '69', 1, 420, '09123456789', 3938456582, '2023-02-19 12:33:37', 'admin', '', 1),
(6, 'ano pagkain', 'angsarapngadobo@gmail.com', '$2y$10$AkymFSGjne3nanBrUcs9V.bnjGHQ6AN0TfEG8wqnoL0', 'NCR', 'Quezon City', 'adobo', '21', 12, 123, '09123456781', 9439603011, '2023-02-20 07:52:45', 'user', '', 1),
(10, 'Mang Jose', 'mangjose@gmail.com', '12345678', 'NCR', 'Marikina City', 'Mango', '12', 30, 789, '09213456789', 7360683599, '2023-02-19 12:33:46', '', '', 1),
(11, 'Joseph', 'ayokonasamundo@gmail.com', '123456', 'NCR', 'Marikina City', 'Kalamansi', 'N/A', 20, 2310, '09123456782', 3679169808, '2023-02-19 12:33:49', 'user', '', 1),
(13, 'Junathan', 'dunkitjunathan@gmail.com', '12345', 'NCR', 'Makati City', 'Dunkit', '69', 29, 1820, '09134567899', 7237157111, '2023-02-19 12:33:51', 'user', '29 Dunkit st. Dunkin Donuts Village', 1),
(14, 'JJ CA', 'yosefudesu@gmail.com', '$2y$10$FcC0IXcIgD.gRSnGw4CfKe1IysS6Op8yGfWbfkcJDvX', '4A', 'Antipolo City', 'Nightingale st.', 'NA', 21, 1870, '09954490438', 1946032413, '2023-02-20 07:56:27', 'user', '', 1),
(15, 'Juan Dela Cruz', 'juandelacruz@gmail.com', '12345678', 'NCR', 'Quezon City', 'Coco Street', 'N/A', 3, 520, '09313456789', 9871989888, '2023-02-19 12:33:54', 'user', '#3 Coco Street, ABS-CBN Village, Quezon City, NCR', 1),
(17, 'Japs Sing', 'japsing@gmail.com', '$2y$10$zCc55QAaw33vyWxxoNWW4.l47E3EZQgK2x6MPGHNkPw', 'NCR', 'Manila', 'Sampaloc', 'NA', 10, 432, '09312345678', 5596544577, '2023-02-19 14:41:42', 'user', '#10 Sampaloc st., Manila, NCR', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_db`
--
ALTER TABLE `admin_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cust_profile`
--
ALTER TABLE `cust_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_id` (`c_id`),
  ADD KEY `date` (`date`),
  ADD KEY `name` (`c_name`);

--
-- Indexes for table `inventory_db`
--
ALTER TABLE `inventory_db`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `orders_db`
--
ALTER TABLE `orders_db`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_date` (`order_date`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_email` (`cust_email`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_rank` (`user_rank`),
  ADD KEY `user_rank_2` (`user_rank`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cust_profile`
--
ALTER TABLE `cust_profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory_db`
--
ALTER TABLE `inventory_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders_db`
--
ALTER TABLE `orders_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
