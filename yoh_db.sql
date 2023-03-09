-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 07:42 PM
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
  `c_avatar` varchar(255) NOT NULL,
  `c_label` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `region` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `street` varchar(60) NOT NULL,
  `barangay` varchar(60) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `zip_code` int(12) NOT NULL,
  `unit_no` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(150) NOT NULL,
  `login_id` bigint(12) NOT NULL,
  `unique_id` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_profile`
--

INSERT INTO `cust_profile` (`id`, `c_id`, `c_name`, `c_avatar`, `c_label`, `email`, `region`, `city`, `street`, `barangay`, `phone_no`, `zip_code`, `unit_no`, `date`, `address`, `login_id`, `unique_id`) VALUES
(2, 4859670294, 'James Anthony Sing', 'assets/img/avatars/nopicinv.png', 'Home', 'singjaps@gmail.com', 'NCR', 'Quezon City', 'Palali St.', 'Sienna', '+639478969123', 1114, 18, '2023-03-09 18:41:09', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 4859670294, 3),
(3, 4859670294, 'Juan Dela Cruz', 'assets/img/avatars/nopicinv.png', 'Condo', 'juandelacruz@gmail.com', 'NCR', 'Quezon City', 'Sigarilyas Street', 'N/A', '09313456789', 520, 3, '2023-03-09 18:40:18', '#3 Coco Street, ABS-CBN Village, Quezon City, NCR', 4859670294, 2),
(4, 4097611313, 'Japs Sing', 'assets/img/avatars/nopicinv.png', 'Home', 'japsing@gmail.com', 'NCR', 'Manila', 'Sampaloc', 'NA', '09312345678', 432, 10, '2023-03-09 18:40:22', '#10 Sampaloc st., Manila, NCR', 4097611313, 1),
(5, 5596544577, 'Japs Sing', 'assets/img/avatars/nopicinv.png', 'Home', 'japsing@gmail.com', 'NCR', 'Manila', 'Sampaloc', 'NA', '09312345678', 432, 10, '2023-03-09 18:40:24', '#10 Sampaloc st., Manila, NCR', 5596544577, 1),
(6, 1325256067, 'James Sing', 'assets/img/avatars/nopicinv.png', 'Home', 'singjaps@gmail.com', 'QUEZON CITY', 'QUEZON CITY', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon ', '1', '+639478969123', 1114, 20, '2023-03-09 18:40:26', '', 1325256067, 1),
(7, 8257935405, 'Engelbert Macadangdang', 'assets/img/avatars/nopicinv.png', 'Home', 'engelbird@gmail.com', 'IV', 'QC', '12', '12', '09158433229', 1114, 1, '2023-03-09 18:40:29', '', 8257935405, 1),
(8, 1182724839, 'James Sing', 'assets/img/avatars/nopicinv.png', 'Home', 'bagongako@gmail.com', 'QUEZON CITY', 'QUEZON CITY', '1', '1', '+639478969123', 1114, 20, '2023-03-09 18:40:32', '', 1182724839, 1),
(9, 4859670294, 'Juan Dela Totoy', 'assets/img/avatars/nopicinv.png', 'Bahay', 'juandelatotoy@gmail.com', 'IV', 'Quezon City', 'Kamias', '100', '09158433229', 1114, 20, '2023-03-09 18:40:38', '#3 Kamias Street, ABS-CBN Village, Quezon City, NCR', 4859670294, 1),
(13, 5739793288, 'John D. Baptist', 'assets/img/avatars/nopicinv.png', 'Tita\'s Home', 'johndbaptist@gmail.com', 'NCR', 'Mandaluyong City', 'Apostles', 'Brgy. Ginebra', '09123456782', 7, 12, '2023-03-09 18:40:48', '', 5739793288, 1),
(16, 4859670294, 'James Anthony Sing', 'assets/img/avatars/nopicinv.png', 'Penthouse', 'singjaps@gmail.com', 'NCR', 'Quezon City', 'Palali St.', 'Sienna', '+639478969123', 1114, 18, '2023-03-09 18:41:02', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 4859670294, 3),
(17, 4859670294, 'James Anthony Sing', 'assets/img/avatars/nopicinv.png', 'Tito\'s Home', 'singjaps@gmail.com', 'NCR', 'Quezon City', 'Palali St.', 'Sienna', '+639478969123', 1114, 18, '2023-03-09 18:41:58', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 4859670294, 3),
(18, 4859670294, 'James Anthony Sing', 'assets/img/avatars/nopicinv.png', 'Friend\'s Home', 'singjaps@gmail.com', 'NCR', 'Quezon City', 'Palali St.', 'Sienna', '+639478969123', 1114, 18, '2023-03-09 18:42:07', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 4859670294, 3),
(19, 4859670294, 'James Anthony Sing', 'assets/img/avatars/nopicinv.png', 'Bahay ng Iba', 'singjaps@gmail.com', 'NCR', 'Quezon City', 'Palali St.', 'Sienna', '+639478969123', 1114, 18, '2023-03-09 18:42:38', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 4859670294, 3),
(20, 4859670294, 'James Anthony Sing', 'assets/img/avatars/nopicinv.png', 'Basta', 'singjaps@gmail.com', 'NCR', 'Quezon City', 'Palali St.', 'Sienna', '+639478969123', 1114, 18, '2023-03-09 18:42:41', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 4859670294, 3),
(21, 4859670294, 'Totoy Brown', 'assets/img/avatars/nopic1.jpg', 'Hindi ko na to bahay', 'yosefudesu@gmail.com', 'NCR', 'Marikina', 'Kamias', '456', '12345678910', 424, 23, '2023-03-09 18:42:44', '123 St brgy 456', 4859670294, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_db`
--

CREATE TABLE `inventory_db` (
  `id` bigint(20) NOT NULL,
  `ItemID` bigint(20) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemImg` varchar(255) NOT NULL DEFAULT 'assets/img/avatars/nopicinv.png',
  `ItemDesc` text NOT NULL,
  `ItemType` varchar(255) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `ItemPrice` int(12) NOT NULL,
  `ItemQty` int(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_db`
--

INSERT INTO `inventory_db` (`id`, `ItemID`, `ItemName`, `ItemImg`, `ItemDesc`, `ItemType`, `TypeID`, `ItemPrice`, `ItemQty`, `created_at`) VALUES
(1, 1001, 'Beginner Crochet Kit', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 1, 200, 10, '2023-03-05 20:31:09'),
(2, 1002, 'Handmade Crochet II Ghibli Earrings', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 1, 150, 2, '2023-03-05 20:31:13'),
(3, 1003, 'Boo Tao Crochet Plush (Quincy x Kira Collab)', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 1, 450, 6, '2023-03-05 20:31:17'),
(4, 1004, 'Crocheted Seventeen Carat Bong Strap', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 1, 250, 30, '2023-03-05 20:31:20'),
(5, 1005, 'Archon Gemmies Plush (Quincy X Kira Collab)', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 1, 250, 100, '2023-03-05 20:31:23'),
(6, 1006, 'Happy Little Keychains', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 1, 250, 5, '2023-03-05 20:31:26'),
(7, 1007, 'Blackpink Lightstick Strap', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Finished', 1, 300, 20, '2023-03-05 20:31:28'),
(8, 1008, 'Busog Meal: Sisig', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 2, 31, 5, '2023-03-05 20:31:33'),
(9, 1009, 'Busog Meal: Bopis', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 2, 31, 12, '2023-03-05 20:31:35'),
(10, 1010, 'Busog Meal: Giniling', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 2, 31, 22, '2023-03-05 20:31:37'),
(11, 1011, 'Hungarian Sausage', 'assets/img/avatars/nopicinv.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Raw', 2, 31, 10, '2023-03-05 20:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `orders_db`
--

CREATE TABLE `orders_db` (
  `id` bigint(20) NOT NULL,
  `OrderID` bigint(20) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemImg` varchar(255) NOT NULL,
  `OrderType` varchar(255) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `c_id` bigint(20) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ItemPrice` int(12) NOT NULL,
  `proof_img` varchar(255) NOT NULL,
  `p_mode` varchar(50) NOT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `courier_id` varchar(50) NOT NULL,
  `pay_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_db`
--

INSERT INTO `orders_db` (`id`, `OrderID`, `ItemName`, `ItemImg`, `OrderType`, `TypeID`, `c_id`, `ItemID`, `order_qty`, `order_date`, `ItemPrice`, `proof_img`, `p_mode`, `tracking_no`, `courier_id`, `pay_status`) VALUES
(1, 101, 'Neobong 40cm', 'assets/img/avatars/nopicinv.png', 'Completed', 1, 5739793288, 1001, 10, '2023-03-09 18:12:06', 10000, '', '', '', '', ''),
(2, 102, '10cm Chibi Doll', 'assets/img/avatars/nopicinv.png', 'Ongoing', 2, 4859670294, 25, 3, '2023-03-09 18:12:23', 5000, '', '', '', '', 'Full Payment');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` bigint(20) NOT NULL,
  `cust_name` varchar(60) NOT NULL,
  `cust_email` varchar(60) DEFAULT NULL,
  `cust_pass` varchar(255) NOT NULL,
  `cust_reg` varchar(60) CHARACTER SET latin1 NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_st` text NOT NULL,
  `cust_brgy` varchar(50) NOT NULL,
  `cust_unit` int(11) NOT NULL,
  `cust_zip` int(10) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `login_id` bigint(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_rank` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'user',
  `cust_address` varchar(60) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `cust_name`, `cust_email`, `cust_pass`, `cust_reg`, `cust_city`, `cust_st`, `cust_brgy`, `cust_unit`, `cust_zip`, `cust_phone`, `login_id`, `date`, `user_rank`, `cust_address`, `status`) VALUES
(1, 'ako lang to', 'akolangtosapusomo@gmail.com', '$2y$10$IJDFg2f96WTA2NrY3f/c8.WkiNf1Mm7DO06.lcVpUWHGlJczgUTJi', '4A', 'Antipolo', 'sa puso mo', '69', 1, 420, '09123456789', 3938456582, '2023-03-01 23:04:09', 'admin', '', 1),
(6, 'ano pagkain', 'angsarapngadobo@gmail.com', '$2y$10$IJDFg2f96WTA2NrY3f/c8.WkiNf1Mm7DO06.lcVpUWHGlJczgUTJi', 'NCR', 'Quezon City', 'adobo', '21', 12, 123, '09123456781', 9439603011, '2023-03-01 23:04:05', 'user', '', 1),
(10, 'Mang Jose', 'mangjose@gmail.com', '12345678', 'NCR', 'Marikina City', 'Mango', '12', 30, 789, '09213456789', 7360683599, '2023-02-19 12:33:46', '', '', 1),
(11, 'Joseph', 'ayokonasamundo@gmail.com', '123456', 'NCR', 'Marikina City', 'Kalamansi', 'N/A', 20, 2310, '09123456782', 3679169808, '2023-02-19 12:33:49', 'user', '', 1),
(13, 'Junathan', 'dunkitjunathan@gmail.com', '12345', 'NCR', 'Makati City', 'Dunkit', '69', 29, 1820, '09134567899', 7237157111, '2023-02-19 12:33:51', 'user', '29 Dunkit st. Dunkin Donuts Village', 1),
(14, 'JJ CA', 'yosefudesu@gmail.com', '$2y$10$NfFVbfiMreyjBJGQpMCh.u.DU8HVszzijcELhiV.//TNGEZNVek7a', '4A', 'Antipolo City', 'Nightingale st.', 'NA', 21, 1870, '09954490438', 1946032413, '2023-03-03 14:41:57', 'user', '', 1),
(15, 'Juan Dela Cruz', 'juandelacruz@gmail.com', '12345678', 'NCR', 'Quezon City', 'Coco Street', 'N/A', 3, 520, '09313456789', 9871989888, '2023-02-19 12:33:54', 'user', '#3 Coco Street, ABS-CBN Village, Quezon City, NCR', 1),
(17, 'Japs Sing', 'japsing@gmail.com', '$2y$10$zCc55QAaw33vyWxxoNWW4.l47E3EZQgK2x6MPGHNkPw', 'NCR', 'Manila', 'Sampaloc', 'NA', 10, 432, '09312345678', 5596544577, '2023-02-19 14:41:42', 'user', '#10 Sampaloc st., Manila, NCR', 1),
(20, 'James Sing', 'bagongako@gmail.com', '$2y$10$dRNU/ItfxBSoHBtWq6xyT.WxFwsUAU.y/muvfqtvgYQrwOu7r2Gt2', 'QUEZON CITY', 'QUEZON CITY', '1', '1', 20, 1114, '+639478969123', 1182724839, '2023-03-01 19:00:44', 'user', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon ', 1),
(27, 'John D. Baptist', 'johndbaptist@gmail.com', '$2y$10$xrgQLVZ1m4MTZN9.gUmECuV0l4mA2i4JRr09xuZOfR2yj19r0y0/G', 'NCR', 'Mandaluyong City', 'Apostles', 'Brgy. Ginebra', 12, 7, '09123456782', 5739793288, '2023-03-04 13:31:48', 'user', '#12 Apostles Street, Brgy. Ginebra, Mandaluyong City        ', 1),
(28, 'Juan Dela Totoy', 'juandelatotoy@gmail.com', '$2y$10$IJDFg2f96WTA2NrY3f/c8.WkiNf1Mm7DO06.lcVpUWHGlJczgUTJi', 'NCR', 'Quezon City', '20', '100', 20, 1114, '09158433229', 4859670294, '2023-03-04 13:40:45', 'user', '#3 Coco Street, ABS-CBN Village, Quezon City, NCR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_title` varchar(255) NOT NULL,
  `slide_img` varchar(255) NOT NULL,
  `slide_desc` varchar(255) NOT NULL,
  `slide_link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_title`, `slide_img`, `slide_desc`, `slide_link`, `created_at`) VALUES
(1, 'Welcome to Yarn Over Hook', 'assets/img/slide/slide1.jpg', 'Let\'s create with a smile!', 'Homepage.php', '2023-03-01 21:28:48'),
(2, 'Buy now!', 'assets/img/slide/slide2.jpg', 'Register on our website to order.', 'Registration.php', '2023-03-01 21:33:53'),
(3, 'Watch new videos.', 'assets/img/slide/slide3.jpg', 'New video tutorials available.', 'https://www.youtube.com/channel/UCSxg8KwMRQxEk8v5vjpXKcg', '2023-03-01 21:33:48'),
(4, 'Custom work', 'assets/img/slide/slide4.jpg', 'We also do custom work! Message us for inquiries.', 'https://www.facebook.com/y.o.h.plus', '2023-03-01 21:32:47'),
(5, 'Social media accounts', 'assets/img/slide/slide5.jpg', 'Follow us on our official social media accounts.', 'https://yohplus.carrd.co/', '2023-03-01 21:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `vid_id` int(11) NOT NULL,
  `vid_title` varchar(255) NOT NULL,
  `vid_desc` varchar(255) NOT NULL,
  `vid_cat` varchar(255) NOT NULL,
  `vid_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`vid_id`, `vid_title`, `vid_desc`, `vid_cat`, `vid_url`, `created_at`) VALUES
(1, 'D.I.Y. Soot Sprites - A Quarantine Project', 'Haiu! I made an easy Ghibli themed crafting activity for you guys to do while staying at home!', 'Crochet Tutorial', 'TMgnlpC1B5g', '2023-03-01 21:52:09'),
(2, 'DIY Cardigan (for beginners)', 'A step by step tutorial on how to make your very own cardigan! Enjoy!\r\n', 'Crochet Tutorial', 'rXNQHIjam7E', '2023-03-01 21:52:05'),
(3, 'Pepe the Frog', 'This is a quick run-through on how I created this amigurumi!', 'Crochet with Me', 'F3gm-I1921I', '2023-03-01 22:01:49'),
(4, 'crochet, plants, food, journal✨', 'Short vlog on the crafts that I did for a week.', 'Craft Vlog', 'hUhAzT6uSB0', '2023-03-01 22:01:46'),
(5, 'Paint with Me 🎨', 'I present you all with another craft vlog/paint with me video.', 'Craft Vlog', '3pd1WPRuvhE', '2023-03-01 22:01:44'),
(6, '5 Tips and Hacks for Crocheters 🧶', 'The tips and hacks in the video are my top 5 favorites that I have been using every time I crochet.', 'Crochet Tutorial', 'Bvhch9VbE2g', '2023-03-01 21:57:13'),
(7, 'Spicing outfits 🔥 (with a cardigan I made)', 'With nothing else to do at home, I decided why not use the cardigan I made previously to spice up my looks.', 'Craft Vlog', '4I2Dh0JR1ak', '2023-03-01 21:55:54'),
(8, 'Work & Crochet with me 🌸', 'Uploaded another craft vlog!! Crochet with me commissions and also do other work UwU', 'Craft Vlog', 'LBGj5fGi4rk', '2023-03-01 22:01:41'),
(9, 'Filipino Food\n', 'Crocheted Filipino food and decided to share facts about them.', 'Crochet with Me', 'VMgHkcJllxU', '2023-03-01 22:01:17'),
(10, 'Commissions (Haikyuu!!)', 'Come with me to make my first commissions of 2021 (Haikyuu characters).', 'Crochet with Me', 'NoGPAf8kam4', '2023-03-01 22:01:20'),
(11, 'Commissions pt.2 (Mo Dao Zu Shi)', 'Have you guys watched this film? I\'m still getting into it OwO, but I\'m glad how these commission turned out.', 'Crochet with Me', '497i5KaKZO8', '2023-03-01 22:01:22'),
(12, 'Crocheting Commissions & Packaging (´꒳`)♡', 'Mabuhay! Welcome to the first ever studio vlog \\(★ω★)/', 'Studio Vlog', 'gvF6ORAIqmY', '2023-03-01 22:01:35'),
(13, 'Taylor Swift Cardigan (❤ω❤)\n', 'I am back with another crochet with me video and I hope you guys enjoyed whether you are a swiftie or not (/▿＼ )', 'Crochet with Me', 'XLq29O4-ux4', '2023-03-01 22:01:32'),
(14, 'Howl\'s Coat by reclamare.ph on IG', 'I pattern tested reclamare.ph\'s Howl Coat!', 'Crochet with Me', 'f-9muZGTFnk', '2023-03-01 22:01:29'),
(15, 'Howl & Sophie 💖', 'I hope you like this video of me making Howl & Sophie (°◡°♡)', 'Crochet with Me', '3gUbLEG6bmw', '2023-03-01 22:02:47'),
(16, 'Crocheting, Packing, and Cleaning Crochet Plush 🍃', 'Really enjoyed crocheting with you all and arranging the orders! And of course cleaning my plush.', 'Studio Vlog', 'xh5iW-ZHlcc', '2023-03-01 22:03:17'),
(17, 'Chonky Duck (Otori-Sama from Spirited away) + announcement', 'I hope you like this one and is excited about the announcement I just said!', 'Crochet with Me', 'dmkanGFlcSY', '2023-03-01 22:04:06'),
(18, 'I crocheted berets to feel cute (and bc I have to) 🤠', 'I hope you liked how I crocheted these berets for my client they turned out so adorable.\r\n', 'Crochet with Me', 'fpKVbA6nvfg', '2023-03-01 22:05:02'),
(19, 'I don\'t play Genshin Impact but I crocheted Jumpty Dumpty 🐰', 'I hope you like this video of me crocheting Jumpty Dumpty!', 'Crochet with Me', 'SOwvR5LveMg', '2023-03-01 22:05:52'),
(20, 'Things I\'ve made/crocheted over the years (not all of them tho)\r\n', 'Crocheting is a big part of me and I\'m really glad that it helps people be happy.', 'Crochet with Me', 'XngEmjx1Sj4', '2023-03-01 22:07:05'),
(21, '🦴 I Made a Doggo out of Fluffy Yarn 🦴', 'I really enjoyed crocheting this dog using fluffy yarn. I hope to see you guys make something out of fluffy yarn as well :) ', 'Crochet with Me', 'ibQtmU1X0DM', '2023-03-01 22:07:47'),
(22, 'A Bulky Cardigan', 'This was a cardigan that I made last year, and it\'s one of my favorite articles of clothing so far! ', 'Crochet with Me', 'pboqaL-DyjY', '2023-03-01 22:08:30'),
(23, 'How to Slip Knot and Chain', 'This is Lesson 1 which are your foundations in crochet (slip knot and chain).', 'Crochet Basics', 'Xak0yEAU3X8', '2023-03-01 22:09:06'),
(24, 'I crocheted flowers for my friends 💐(and why you should too!)\r\n', 'I hope you guys liked this video of me crocheting flowers :3', 'Crochet with Me', '1cS53So2vOQ', '2023-03-01 22:09:45'),
(25, 'How to Single Crochet', 'This is Lesson 2: How to single crochet!', 'Crochet Basics', 'Q5Rt8uA_VE8', '2023-03-01 22:13:15'),
(26, 'How to Half Double Crochet 🧶', 'This is Lesson 3: How to half double crochet!', 'Crochet Basics', 'zVksu5i5xIY', '2023-03-01 22:11:03'),
(27, 'How to Double Crochet', 'This is Lesson 4: How to double crochet!', 'Crochet Basics', '7-4fDI8AMw8', '2023-03-01 22:12:43'),
(28, 'Crochet Egg Beret 🍳', 'This is one of my very first detailed tutorials in this channel and I hope you guys like it!', 'Crochet Tutorial', '0M-8MK86pYI', '2023-03-01 22:18:09'),
(29, 'How to crochet a Magic Circle\r\n', 'If you have been wondering how to start a crochet circle, then this is the video for you! ', 'Crochet Basics', 'Ixhg8oUw1HE', '2023-03-01 22:13:53'),
(30, 'Crochet Pillow\n', 'Another tutorial video. This time, I will teach you how to make a crochet pillow.', 'Crochet Tutorial', 'XRUr6bf9weM', '2023-03-01 22:17:52'),
(31, 'How to crochet Boo Tao', 'This project is perfect for crochet beginners as it uses the basic stitches and techniques!', 'Crochet Tutorial', 'e9of07fxTV8', '2023-03-01 22:19:17'),
(32, 'Making a Doll from scratch🍳', 'I am back with another egg-citing crochet with me video! I made this cute doll based on an egg.', 'Crochet Tutorial', 'mr9dzRfSIeg', '2023-03-01 22:19:10');

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
  ADD KEY `order_id` (`OrderID`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_email` (`cust_email`),
  ADD KEY `cust_id` (`login_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_rank` (`user_rank`),
  ADD KEY `user_rank_2` (`user_rank`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`vid_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cust_profile`
--
ALTER TABLE `cust_profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `inventory_db`
--
ALTER TABLE `inventory_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders_db`
--
ALTER TABLE `orders_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `vid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
