-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 02:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
  `user_rank` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cust_profile`
--

INSERT INTO `cust_profile` (`id`, `c_id`, `c_name`, `email`, `region`, `city`, `street`, `building`, `phone_no`, `zip_code`, `unit_no`, `date`) VALUES
(2, 1946032413, 'JJ CA', 'jjca@gmail.com', '4A', 'Antipolo City', 'Nightingale st.', 'NA', '09954490438', 1870, 21, '2023-02-12 10:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_db`
--

CREATE TABLE `inventory_db` (
  `id` bigint(20) NOT NULL,
  `ItemID` bigint(20) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemQuantity` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_db`
--

CREATE TABLE `orders_db` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` bigint(20) NOT NULL,
  `cust_name` varchar(60) NOT NULL,
  `cust_email` varchar(60) NOT NULL,
  `cust_pass` varchar(50) NOT NULL,
  `cust_reg` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_st` text NOT NULL,
  `cust_bldg` varchar(50) NOT NULL,
  `cust_unit` int(11) NOT NULL,
  `cust_zip` int(10) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `cust_id` bigint(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_rank` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'user',
  `cust_address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `cust_name`, `cust_email`, `cust_pass`, `cust_reg`, `cust_city`, `cust_st`, `cust_bldg`, `cust_unit`, `cust_zip`, `cust_phone`, `cust_id`, `date`, `user_rank`, `cust_address`) VALUES
(1, 'ako lang to', 'akolangtosapusomo@gmail.com', '1234', '4A', 'Antipolo', 'sa puso mo', '69', 1, 420, '09123456789', 3938456582, '2023-02-07 12:20:10', 'admin', ''),
(6, 'ano pagkain', 'angsarapngadobo@gmail.com', '12345', 'NCR', 'Quezon City', 'adobo', '21', 12, 123, '09123456781', 9439603011, '2023-02-07 12:20:14', 'user', ''),
(10, 'Mang Jose', 'mangjose@gmail.com', '12345678', 'NCR', 'Marikina City', 'Mango', '12', 30, 789, '09213456789', 7360683599, '2023-02-12 12:06:27', '', ''),
(11, 'Joseph', 'ayokonasamundo@gmail.com', '123456', 'NCR', 'Marikina City', 'Kalamansi', 'N/A', 20, 2310, '09123456782', 3679169808, '2023-02-07 13:08:28', 'user', ''),
(13, 'Junathan', 'dunkitjunathan@gmail.com', '12345', 'NCR', 'Makati City', 'Dunkit', '69', 29, 1820, '09134567899', 7237157111, '2023-02-09 15:50:14', 'user', '29 Dunkit st. Dunkin Donuts Village'),
(14, 'JJ CA', 'jjca@gmail.com', '1234', '4A', 'Antipolo City', 'Nightingale st.', 'NA', 21, 1870, '09954490438', 1946032413, '2023-02-12 10:58:10', 'user', '');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_db`
--
ALTER TABLE `inventory_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_db`
--
ALTER TABLE `orders_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
