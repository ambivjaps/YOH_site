-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 07:00 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

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
  `unique_id` int(5) NOT NULL DEFAULT 1,
  `cust_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_profile`
--

INSERT INTO `cust_profile` (`id`, `c_id`, `c_name`, `c_avatar`, `c_label`, `email`, `region`, `city`, `street`, `barangay`, `phone_no`, `zip_code`, `unit_no`, `date`, `address`, `login_id`, `unique_id`, `cust_status`) VALUES
(1, 7242156480, 'Nina De Guzman', 'assets/img/default/default_user.jpg', 'Home', 'ninadeguzman@yahoo.com', 'NCR', 'Quezon City', 'Tabayoc St.', 'Sienna', '09993093997', 1113, 18, '2023-03-11 22:58:09', '18-B Tabayoc St. Sta. Mesa Heights, Quezon City', 7242156480, 1, 0),
(2, 1087763698, 'Darwin Manalastas', 'assets/img/default/default_user.jpg', 'Home', 'darwin_2000@gmail.com', 'NCR', 'Mandaluyong City', 'Pioneer St.', 'Boni', '09323155312', 1010, 12, '2023-03-11 20:37:20', '12 Pioneer St., Boni Ave, Mandaluyong City', 1087763698, 1, 1),
(3, 4062959512, 'Rodrigo Villaramas', 'assets/img/default/default_user.jpg', 'Home', 'rod_villa2k@gmail.com', 'MIMAROPA', 'Gasan City', 'Mapayapa St.', 'Marikit', '09172238482', 1114, 20, '2023-03-11 22:49:35', '20 Mapayapa St., Gasan City, Marinduque', 4062959512, 1, 0),
(4, 4062959512, 'Rodrigo Villaramas', 'assets/img/default/default_user.jpg', 'Ancestral House', 'rod_villa2k@gmail.com', 'NCR', 'Pasig City', 'Pulang Buhangin St.', 'Manggahan', '09317712219', 1020, 18, '2023-03-12 22:06:35', '18-C Pulang Buhangin St., Pasig City', 4062959512, 1, 0),
(5, 4062959512, 'Rodrigo Villaramas', 'assets/img/default/default_user.jpg', 'Girlfriend\'s Condo', 'rod_villa2k@gmail.com', 'NCR', 'Quezon City', 'Misamis St.', 'Bago Bantay', '09272188536', 1112, 3510, '2023-03-12 22:06:31', '3510 East Tower, Misamis St., Quezon City', 4062959512, 1, 1),
(6, 7242156480, 'Nina De Guzman', 'assets/img/default/default_user.jpg', 'Condo', 'ninadeguzman@gmai.com', 'NCR', 'QUEZON CITY', 'Palali St.', 'Sienna', '+639478969123', 1114, 18, '2023-03-12 22:59:03', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 7242156480, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_db`
--

CREATE TABLE `inventory_db` (
  `id` bigint(20) NOT NULL,
  `ItemID` bigint(20) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `ItemImg` varchar(255) NOT NULL,
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
(1, 1001, 'Beginner Crochet Kit', 'assets/img/upload/inventory/1678474952_40830720640b7ec8d36e7_crochet kit.jpg', 'Basic Materials every crochet beginner needs\r\n\r\nThis Kit includes:\r\n- 2 crochet hooks (4.5 mm and 5mm)\r\n- 2 milk cotton yarn (50 grams each)\r\n- 2 darning needle\r\n- 2 stitch markers\r\n\r\nBONUS: youtube links to basic tutorials\r\n(random colors will be given, but send us a message if you want to pick your own colors)\r\n\r\nThis kit is perfect to use for practicing the new hobby.', 'Raw', 2, 200, 20, '2023-03-10 19:02:32'),
(2, 1002, 'Handmade Crochet (Ghibli Earrings) - Calcifer', 'assets/img/upload/inventory/1678472170_1393039690640b73ea7733a_ghibli earrings_calcifer.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 88, '2023-03-10 19:05:24'),
(3, 1003, 'Handmade Crochet (Ghibli Earrings) - Jiji', 'assets/img/upload/inventory/1678472389_1371896684640b74c52edbb_ghibli earrings_jiji.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 59, '2023-03-10 18:19:49'),
(4, 1004, 'Handmade Crochet (Ghibli Earrings) - Soot Sprites', 'assets/img/upload/inventory/1678472481_1083544921640b7521b9769_ghiblie earrings_soot sprite.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 33, '2023-03-10 19:04:39'),
(5, 1005, 'Handmade Crochet (Ghibli Earrings) - Mononoke', 'assets/img/upload/inventory/1678472576_2036050580640b758028c6b_ghibli earrings_princess mononoke.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 25, '2023-03-10 18:22:56'),
(6, 1006, 'Handmade Crochet (Ghibli Earrings) - No Face', 'assets/img/upload/inventory/1678472637_1206741740640b75bda8165_ghibli earrings_no face.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 42, '2023-03-10 18:23:57'),
(7, 1007, 'Boo Tao Crochet Plush (Kira x Quincy Collab)', 'assets/img/upload/inventory/1678472756_2114156154640b7634ecb80_boo tao plush.jpeg', 'This is a collaboration between y.o.h.plus and pawchi on Instagram. We wanted to offer affordable and cute items made by artists for Genshin lovers. Pawchi (Kira) made the design and Quincy (y.o.h.plus) brought it to reality. \r\n\r\nThis is a handmade Boo Tao plush for all the Hu tao lovers out there! For more inquiries don\'t hesitate to message us!\r\n(includes glitter sticker freebie)\r\n\r\nMaterial:\r\n-yarn (crocheted)\r\n\r\nSize:\r\n 11 inches x 8 inches', 'Finished', 1, 450, 100, '2023-03-10 18:25:56'),
(8, 1008, 'Crocheted Seventeen Carat Bong Strap - Basic', 'assets/img/upload/inventory/1678472871_1475583268640b76a704d38_carat bong holder_basic.jpeg', 'CARAT! \r\n\r\nThis accessory is used to hold your carat bongs! It is crocheted and tested that your carat bong will be secured in place during the concert! \r\n\r\nStrap length is 40 inches and is available in different colors \r\n\r\nPink, Purple, Mustard Yellow\r\n\r\nDon\'t hesitate to ask us for pictures especially if the color you want is pink :> \r\n\r\nStyles include: basic and flower\r\n\r\nStrap is the only one for sale, light stick not included.', 'Finished', 1, 250, 61, '2023-03-10 19:05:28'),
(9, 1009, 'Crocheted Seventeen Carat Bong Strap - Flower', 'assets/img/upload/inventory/1678472931_731173482640b76e3e5d2c_carat bong holder_flower.jpeg', 'CARAT! \r\n\r\nThis accessory is used to hold your carat bongs! It is crocheted and tested that your carat bong will be secured in place during the concert! \r\n\r\nStrap length is 40 inches and is available in different colors \r\n\r\nPink, Purple, Mustard Yellow\r\n\r\nDon\'t hesitate to ask us for pictures especially if the color you want is pink :> \r\n\r\nStyles include: basic and flower\r\n\r\nStrap is the only one for sale, light stick not included.', 'Finished', 1, 250, 43, '2023-03-10 19:05:03'),
(10, 1010, 'Genshin Impact Archon Gemmies Plush (Kira x Quincy Collab)', 'assets/img/upload/inventory/1678473092_697175962640b7784dcc11_gemmies.jpg', 'This is a collaboration between y.o.h.plus and pawchi on Instagram. We wanted to offer affordable and cute items made by artist for Genshin lovers. Pawchi (Kira) made the design and Quincy (y.o.h.plus) brought it to reality. For now only the archons and available, we\'re hoping to bring more Genshin characters soon. We hope you like these gemmies when you receive them.\r\n\r\nMaterial:\r\n-yarn (crocheted)\r\n\r\nSize:\r\n  -Handsize: 2.5 inches x 3 inches\r\n  -Keychains: coming soon', 'Finished', 1, 250, 37, '2023-03-10 18:31:32'),
(11, 1011, 'Childe Narwhal Crochet Plush (Kira x Quincy Collab)', 'assets/img/upload/inventory/1678477804_858552819640b89ec46093_default_inv.jpg', 'This is a collaboration between y.o.h.plus and pawchi on Instagram. We wanted to offer affordable and cute items made by artists for Genshin lovers. Pawchi (Kira) made the design and Quincy (y.o.h.plus) brought it to reality. \r\n\r\nThis is a handmade Childe Narwhal plush for all the Childelovers out there! For more inquiries don\'t hesitate to message us!\r\n(includes glitter sticker freebie)\r\n\r\nMaterial:\r\n-yarn (crocheted)\r\n\r\nSize:\r\n 6 inches x 8.5 inches', 'Finished', 1, 450, 99, '2023-03-10 19:50:48'),
(12, 1012, 'Happy Little Keychains - Orange', 'assets/img/upload/inventory/1678477819_1877358099640b89fb8c3a1_default_inv.jpg', 'These are a bunch of happy little keychains inspired by little everyday things. More are to come soon but have this nice little carrot and orange :> \r\n\r\nMaterial:\r\nYarn Crochet', 'Finished', 1, 250, 100, '2023-03-10 19:50:43'),
(13, 1013, 'Happy Little Keychains - Carrot', 'assets/img/upload/inventory/1678477826_555860640640b8a0296f58_default_inv.jpg', 'These are a bunch of happy little keychains inspired by little everyday things. More are to come soon but have this nice little carrot and orange :> \r\n\r\nMaterial:\r\nYarn Crochet', 'Finished', 1, 250, 100, '2023-03-10 19:50:37'),
(14, 1014, 'Blackpink Lightstick Strap - Black', 'assets/img/upload/inventory/1678473556_1008125315640b795487e43_blackpink lightstick holder_black.jpg', 'Calling all Blinks out there! \r\n\r\nThis was a highly requested Item, and we have made a lightstick holder for you guys!\r\n\r\nStrap is 40 inches long.', 'Finished', 1, 300, 10, '2023-03-10 19:05:07'),
(15, 1015, 'Blackpink Lightstick Strap - Chevron', 'assets/img/upload/inventory/1678473618_1774975424640b7992d0361_blackpink lightstick holder_chevron.jpg', 'Calling all Blinks out there! \r\n\r\nThis was a highly requested Item, and we have made a lightstick holder for you guys!\r\n\r\nStrap is 40 inches long.', 'Finished', 1, 300, 14, '2023-03-10 19:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `orders_db`
--

CREATE TABLE `orders_db` (
  `OrderID` bigint(20) NOT NULL,
  `ItemID` bigint(20) NOT NULL,
  `c_id` bigint(12) NOT NULL,
  `OrderQty` int(11) NOT NULL,
  `OrderType` varchar(255) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `OrderTotal` int(12) NOT NULL,
  `proof_img` varchar(255) NOT NULL,
  `p_mode` varchar(255) NOT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `courier_id` varchar(255) NOT NULL,
  `pay_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_db`
--

INSERT INTO `orders_db` (`OrderID`, `ItemID`, `c_id`, `OrderQty`, `OrderType`, `TypeID`, `OrderDate`, `OrderTotal`, `proof_img`, `p_mode`, `tracking_no`, `courier_id`, `pay_status`) VALUES
(1, 1007, 7242156480, 27, 'In Process', 1, '2023-03-13 05:38:05', 12150, 'assets/img/upload/payment/1678685885_1001996019640eb6bded555_Services-Financial-GInsure-App-Confirm-and-Pay-360x640-SS.png', 'GCash', '1010101010', 'XEND', 'Paid'),
(2, 1002, 4062959512, 5, 'In Process', 1, '2023-03-13 01:14:26', 750, 'None', 'GCash', '9349493939332', 'LBC', 'Unpaid'),
(3, 1006, 1087763698, 20, 'In Process', 1, '2023-03-13 01:22:27', 3000, 'None', 'Instapay', '', '', ''),
(6, 1001, 1087763698, 10, 'In Process', 1, '2023-03-13 01:22:30', 2000, 'None', 'Union Bank', '', '', ''),
(7, 1012, 7242156480, 20, 'Completed', 2, '2023-03-13 05:41:33', 5000, 'None', 'BPI', '3e923e8939', 'XEND', 'Paid'),
(8, 1009, 4062959512, 8, 'In Process', 1, '2023-03-13 01:22:38', 2000, 'None', 'BDO', '', '', ''),
(10, 1015, 7242156480, 1, 'Completed', 2, '2023-03-13 05:54:36', 300, '', '', '', '', '');

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
(1, 'Lia Maranan', 'admin_yoh@gmail.com', '$2y$10$fCdhA3A5h7CxPFESCubXl.Mr7nGRTStyI8w0LY1sXTxA9Qe063hSq', 'NCR', 'Quezon City', 'Mabilis St.', 'Masagana', 20, 1114, '09158433229', 3132667346, '2023-03-10 20:02:16', 'admin', '123 Block 1 Mabilis St., Quezon City', 1),
(2, 'Nina De Guzman', 'ninadeguzman@yahoo.com', '$2y$10$4XW/LEsGXoB4QQG/Udk87.0SuXiNd/j/3eFW7uOVdBfWM6rSbhqqy', 'NCR', 'Quezon City', 'Tabayoc St.', 'Sienna', 18, 1113, '09993093997', 7242156480, '2023-03-10 20:03:56', 'user', '18-B Tabayoc St. Sta. Mesa Heights, Quezon City', 1),
(3, 'Darwin Manalastas', 'darwin_2000@gmail.com', '$2y$10$ybvqzAyPWJ4/J2sc2sPu0OWo0fFwouZ3K0LvegjwQyeKtmT/8G0Fy', 'NCR', 'Mandaluyong City', 'Pioneer St.', 'Boni', 12, 1010, '09323155312', 1087763698, '2023-03-10 20:05:57', 'user', '12 Pioneer St., Boni Ave, Mandaluyong City', 1),
(4, 'Rodrigo Villaramas', 'rod_villa2k@gmail.com', '$2y$10$l69ahigJ5x.L.FjaKKyIOOZxecmBUNf..tQMKjzZlSY5Xc3XB5agG', 'MIMAROPA', 'Gasan City', 'Mapayapa St.', 'Marikit', 20, 1114, '09172238482', 4062959512, '2023-03-10 20:11:22', 'user', '20 Mapayapa St., Gasan City, Marinduque', 1);

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
(1, 'Welcome to Yarn Over Hook', 'assets/img/upload/slides/1678476949_1739719522640b869528615_slide1.jpg', 'Let\'s create with a smile!', 'Homepage.php', '2023-03-10 19:35:49'),
(2, 'Buy now!', 'assets/img/upload/slides/1678476965_1530631567640b86a51a386_slide2.jpg', 'Register on our website to order.', 'Registration.php', '2023-03-10 19:36:05'),
(3, 'Watch new videos.', 'assets/img/upload/slides/1678476992_1892085598640b86c0422a8_slide3.jpg', 'New video tutorials available.', 'Videos.php', '2023-03-10 19:36:32'),
(4, 'Custom work', 'assets/img/upload/slides/1678477028_794739955640b86e4c9082_slide4.jpg', 'For custom work, message us for inquiries.', 'https://www.facebook.com/y.o.h.plus', '2023-03-10 19:37:08'),
(5, 'Social media accounts', 'assets/img/upload/slides/1678477049_389322224640b86f92b552_slide5.jpg', 'Follow us on our official social media accounts.', 'https://yohplus.carrd.co/', '2023-03-10 19:37:29');

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
  ADD PRIMARY KEY (`OrderID`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inventory_db`
--
ALTER TABLE `inventory_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_db`
--
ALTER TABLE `orders_db`
  MODIFY `OrderID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `vid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
