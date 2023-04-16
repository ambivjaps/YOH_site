-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 06:20 PM
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
-- Table structure for table `cust_profile`
--

CREATE TABLE `cust_profile` (
  `id` bigint(20) NOT NULL,
  `c_id` bigint(12) NOT NULL,
  `c_name` varchar(60) NOT NULL,
  `c_label` varchar(255) NOT NULL,
  `region` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `zip_code` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(150) NOT NULL,
  `login_id` bigint(12) NOT NULL,
  `unique_id` int(5) NOT NULL DEFAULT 1,
  `cust_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_profile`
--

INSERT INTO `cust_profile` (`id`, `c_id`, `c_name`, `c_label`, `region`, `city`, `phone_no`, `zip_code`, `date`, `address`, `login_id`, `unique_id`, `cust_status`) VALUES
(1, 7242156480, 'Nina De Guzman', 'Home', 'NCR', 'Quezon City', '09993093997', 1113, '2023-04-16 13:58:30', '18-B Tabayoc St. Sta. Mesa Heights, Quezon City', 7242156480, 1, 1),
(2, 1087763698, 'Darwin Manalastas', 'Home', 'NCR', 'Mandaluyong City', '09323155312', 1010, '2023-03-22 10:25:39', '12 Pioneer St., Boni Ave, Mandaluyong City', 1087763698, 1, 1),
(4, 4062959512, 'Rodrigo Villaramas', 'Ancestral House', 'NCR', 'Pasig City', '09317712219', 1020, '2023-03-28 15:55:24', '18-C Pulang Buhangin St., Pasig City', 4062959512, 1, 0),
(5, 4062959512, 'Rodrigo Villaramas', 'Girlfriend\'s Condo', 'NCR', 'Quezon City', '09272188536', 1112, '2023-03-28 15:56:44', '3510 East Tower, Misamis St., Quezon City', 4062959512, 1, 1),
(6, 7242156480, 'Nina De Guzman', 'Condo', 'NCR', 'QUEZON CITY', '+639478969123', 1114, '2023-03-28 15:56:11', '18-D Palali St., Sta. Mesa Heights, Barangay Sienna, Quezon City', 7242156480, 1, 0),
(10, 9943549504, 'Alfonso Garcia', 'Home', 'NCR', 'Mandaluyong City', '09123456789', 8, '2023-03-31 12:33:18', '#7 Apostles Street, Brgy. Ginebra, Mandaluyong City, NCR', 9943549504, 1, 1),
(11, 43391045177, 'Engelbert Macadangdang', 'Home', 'NCR', 'Quezon City', '09158433229', 122, '2023-04-16 16:20:26', '18-D Palali St. Sta. Mesa Heights, Quezon City', 43391045177, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_db`
--

CREATE TABLE `inventory_db` (
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

INSERT INTO `inventory_db` (`ItemID`, `ItemName`, `ItemImg`, `ItemDesc`, `ItemType`, `TypeID`, `ItemPrice`, `ItemQty`, `created_at`) VALUES
(1001, 'Beginner Crochet Kit', 'assets/img/upload/inventory/1678474952_40830720640b7ec8d36e7_crochet kit.jpg', 'Basic Materials every crochet beginner needs\r\n\r\nThis Kit includes:\r\n- 2 crochet hooks (4.5 mm and 5mm)\r\n- 2 milk cotton yarn (50 grams each)\r\n- 2 darning needle\r\n- 2 stitch markers\r\n\r\nBONUS: youtube links to basic tutorials\r\n(random colors will be given, but send us a message if you want to pick your own colors)\r\n\r\nThis kit is perfect to use for practicing the new hobby.', 'Raw', 2, 200, 11, '2023-04-01 03:48:55'),
(1002, 'Handmade Crochet (Ghibli Earrings) - Calcifer', 'assets/img/upload/inventory/1681582082_1132859020643ae8026d6d9_1678472170_1393039690640b73ea7733a_ghibli_earrings_calcifer.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Raw', 2, 150, 55, '2023-04-16 14:43:23'),
(1003, 'Handmade Crochet (Ghibli Earrings) - Jiji', 'assets/img/upload/inventory/1678472389_1371896684640b74c52edbb_ghibli earrings_jiji.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 49, '2023-03-28 18:21:07'),
(1004, 'Handmade Crochet (Ghibli Earrings) - Soot Sprites', 'assets/img/upload/inventory/1678472481_1083544921640b7521b9769_ghiblie earrings_soot sprite.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 20, '2023-03-30 07:31:53'),
(1005, 'Handmade Crochet (Ghibli Earrings) - Mononoke', 'assets/img/upload/inventory/1678472576_2036050580640b758028c6b_ghibli earrings_princess mononoke.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 25, '2023-03-10 18:22:56'),
(1006, 'Handmade Crochet (Ghibli Earrings) - No Face', 'assets/img/upload/inventory/1678472637_1206741740640b75bda8165_ghibli earrings_no face.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Finished', 1, 150, 42, '2023-03-10 18:23:57'),
(1007, 'Boo Tao Crochet Plush (Kira x Quincy Collab)', 'assets/img/upload/inventory/1678472756_2114156154640b7634ecb80_boo tao plush.jpeg', 'This is a collaboration between y.o.h.plus and pawchi on Instagram. We wanted to offer affordable and cute items made by artists for Genshin lovers. Pawchi (Kira) made the design and Quincy (y.o.h.plus) brought it to reality. \r\n\r\nThis is a handmade Boo Tao plush for all the Hu tao lovers out there! For more inquiries don\'t hesitate to message us!\r\n(includes glitter sticker freebie)\r\n\r\nMaterial:\r\n-yarn (crocheted)\r\n\r\nSize:\r\n 11 inches x 8 inches', 'Finished', 1, 450, 83, '2023-03-26 13:19:17'),
(1008, 'Crocheted Seventeen Carat Bong Strap - Basic', 'assets/img/upload/inventory/1678472871_1475583268640b76a704d38_carat bong holder_basic.jpeg', 'CARAT! \r\n\r\nThis accessory is used to hold your carat bongs! It is crocheted and tested that your carat bong will be secured in place during the concert! \r\n\r\nStrap length is 40 inches and is available in different colors \r\n\r\nPink, Purple, Mustard Yellow\r\n\r\nDon\'t hesitate to ask us for pictures especially if the color you want is pink :> \r\n\r\nStyles include: basic and flower\r\n\r\nStrap is the only one for sale, light stick not included.', 'Finished', 1, 250, 61, '2023-03-10 19:05:28'),
(1009, 'Crocheted Seventeen Carat Bong Strap - Flower', 'assets/img/upload/inventory/1678472931_731173482640b76e3e5d2c_carat bong holder_flower.jpeg', 'CARAT! \r\n\r\nThis accessory is used to hold your carat bongs! It is crocheted and tested that your carat bong will be secured in place during the concert! \r\n\r\nStrap length is 40 inches and is available in different colors \r\n\r\nPink, Purple, Mustard Yellow\r\n\r\nDon\'t hesitate to ask us for pictures especially if the color you want is pink :> \r\n\r\nStyles include: basic and flower\r\n\r\nStrap is the only one for sale, light stick not included.', 'Finished', 1, 250, 62, '2023-03-26 13:19:37'),
(1010, 'Genshin Impact Archon Gemmies Plush (Kira x Quincy Collab)', 'assets/img/upload/inventory/1678473092_697175962640b7784dcc11_gemmies.jpg', 'This is a collaboration between y.o.h.plus and pawchi on Instagram. We wanted to offer affordable and cute items made by artist for Genshin lovers. Pawchi (Kira) made the design and Quincy (y.o.h.plus) brought it to reality. For now only the archons and available, we\'re hoping to bring more Genshin characters soon. We hope you like these gemmies when you receive them.\r\n\r\nMaterial:\r\n-yarn (crocheted)\r\n\r\nSize:\r\n  -Handsize: 2.5 inches x 3 inches\r\n  -Keychains: coming soon', 'Finished', 1, 250, 37, '2023-03-10 18:31:32'),
(1011, 'Childe Narwhal Crochet Plush (Kira x Quincy Collab)', 'assets/img/upload/inventory/1680015350_13535949026422fff6e8b08_338396841_910530146861855_6549493773285344790_n.png', 'This is a collaboration between y.o.h.plus and pawchi on Instagram. We wanted to offer affordable and cute items made by artists for Genshin lovers. Pawchi (Kira) made the design and Quincy (y.o.h.plus) brought it to reality. \r\n\r\nThis is a handmade Childe Narwhal plush for all the Childelovers out there! For more inquiries don\'t hesitate to message us!\r\n(includes glitter sticker freebie)\r\n\r\nMaterial:\r\n-yarn (crocheted)\r\n\r\nSize:\r\n 6 inches x 8.5 inches', 'Finished', 1, 450, 99, '2023-03-28 14:55:50'),
(1012, 'Happy Little Keychains - Orange', 'assets/img/upload/inventory/1678477819_1877358099640b89fb8c3a1_default_inv.jpg', 'These are a bunch of happy little keychains inspired by little everyday things. More are to come soon but have this nice little carrot and orange :> \r\n\r\nMaterial:\r\nYarn Crochet', 'Finished', 1, 250, 100, '2023-03-10 19:50:43'),
(1013, 'Happy Little Keychains - Carrot', 'assets/img/upload/inventory/1678477826_555860640640b8a0296f58_default_inv.jpg', 'These are a bunch of happy little keychains inspired by little everyday things. More are to come soon but have this nice little carrot and orange :> \r\n\r\nMaterial:\r\nYarn Crochet', 'Finished', 1, 250, 100, '2023-03-10 19:50:37'),
(1014, 'Blackpink Lightstick Strap - Black', 'assets/img/upload/inventory/1678473556_1008125315640b795487e43_blackpink lightstick holder_black.jpg', 'Calling all Blinks out there! \r\n\r\nThis was a highly requested Item, and we have made a lightstick holder for you guys!\r\n\r\nStrap is 40 inches long.', 'Finished', 1, 300, 10, '2023-03-10 19:05:07'),
(1015, 'Blackpink Lightstick Strap - Chevron', 'assets/img/upload/inventory/1678473618_1774975424640b7992d0361_blackpink lightstick holder_chevron.jpg', 'Calling all Blinks out there! \r\n\r\nThis was a highly requested Item, and we have made a lightstick holder for you guys!\r\n\r\nStrap is 40 inches long.', 'Finished', 1, 300, 14, '2023-03-10 19:05:14'),
(1016, 'Chonky Otori Sama', 'assets/img/upload/inventory/1679814616_709284961641fefd8a59be_chonky otori sama.jpg', 'A chonky duck friend inspired by the infamous duck from spirited away! \r\n\r\nHeight 9\"\r\nWidth 8\"\r\n', 'Finished', 1, 1500, 1, '2023-03-28 14:46:15'),
(1017, 'Egg Beret', 'assets/img/upload/inventory/1679814673_1864746821641ff011b18e0_egg beret .jpeg', 'Eggtastic Quirky Beret\r\n\r\nRadius of beret is 10\"\r\n', 'Finished', 1, 950, 5, '2023-03-28 14:46:56'),
(1018, 'Mochi Family', 'assets/img/upload/inventory/1679814697_130860885641ff029315f4_mochi family.jpg', 'This mochi is inspired by the plush in the anime wotakoi; love is hard for an otaku and I was reincarnated as a slime. Use this as your desk friend or even a stress ball when needed. ', 'Finished', 1, 350, 100, '2023-03-28 14:48:06'),
(1019, 'Potchi Pillow', 'assets/img/upload/inventory/1679814727_1120092999641ff047489c1_potchi pillow.jpg', 'We\'re bringing back your childhood fave in the form of a pillow. This is a perfect cuddle buddy or a pillow for a quick nap. \r\n\r\nHeight 6\" \r\nwidth 8\"\r\n', 'Finished', 1, 1200, 19, '2023-04-01 03:48:55'),
(1020, 'Rainbow Sweater', 'assets/img/upload/inventory/1679814749_1926548014641ff05d7d71d_rainbow sweater.jpeg', 'A rainbow sweater with bell shaped sleeves in size medium', 'Finished', 1, 2500, 30, '2023-03-28 18:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders_db`
--

CREATE TABLE `orders_db` (
  `OrderID` bigint(20) NOT NULL,
  `ItemID` bigint(20) NOT NULL,
  `c_id` bigint(12) NOT NULL,
  `cust_status` int(11) NOT NULL DEFAULT 1,
  `OrderQty` int(11) NOT NULL,
  `OrderType` varchar(255) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PaymentDue` date DEFAULT NULL,
  `OrderTotal` int(12) NOT NULL,
  `proof_img` varchar(255) NOT NULL,
  `p_mode` varchar(255) NOT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `courier_id` varchar(255) NOT NULL,
  `pay_status` varchar(255) NOT NULL,
  `MaterialUsed` varchar(150) NOT NULL,
  `MaterialQty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_db`
--

INSERT INTO `orders_db` (`OrderID`, `ItemID`, `c_id`, `cust_status`, `OrderQty`, `OrderType`, `TypeID`, `OrderDate`, `PaymentDue`, `OrderTotal`, `proof_img`, `p_mode`, `tracking_no`, `courier_id`, `pay_status`, `MaterialUsed`, `MaterialQty`) VALUES
(2, 1002, 4062959512, 1, 15, 'On-Going', 1, '2023-04-01 02:45:45', '2023-03-31', 2250, '', 'GCash', '9349493939332', 'Lalamove (Same day delivery)', 'Installment', 'Handmade Crochet (Ghibli Earrings) - Calcifer', 1),
(3, 1006, 1087763698, 1, 20, 'On-Going', 1, '2023-04-01 03:29:25', '2023-04-03', 3000, 'assets/img/upload/payment/1680319765_6263468126427a515dd88a_proof of payment.jpg', 'BDO', '12312331231233', 'Fifth Express', 'Installment', 'Beginner Crochet Kit', 1),
(6, 1001, 1087763698, 1, 10, 'On-Going', 1, '2023-04-01 03:31:02', '2023-04-02', 2000, '', 'BDO', '123412341234', 'Lalamove (Same day delivery)', 'Installment', 'Beginner Crochet Kit', 1),
(7, 1012, 7242156480, 1, 20, 'Completed', 2, '2023-03-30 06:14:43', '2023-04-06', 5000, 'assets/img/upload/payment/1678685885_1001996019640eb6bded555_Services-Financial-GInsure-App-Confirm-and-Pay-360x640-SS.png', 'PayPal', '3e923e8939', 'Lalamove (Same day delivery)', 'Full Payment', 'Beginner Crochet Kit', 1),
(8, 1009, 4062959512, 1, 8, 'Completed', 2, '2023-04-01 02:45:16', '2023-04-05', 2000, 'assets/img/upload/payment/1678685885_1001996019640eb6bded555_Services-Financial-GInsure-App-Confirm-and-Pay-360x640-SS.png', 'BDO', '5261162734', 'Flash Express', 'Full Payment', 'Beginner Crochet Kit', 1),
(13, 1012, 9943549504, 1, 1, 'On-Going', 1, '2023-04-01 02:46:15', '2023-04-10', 250, 'assets/img/upload/payment/1678685885_1001996019640eb6bded555_Services-Financial-GInsure-App-Confirm-and-Pay-360x640-SS.png', '', '30028281111', 'J&T Express', 'Full Payment', 'Beginner Crochet Kit', 1),
(15, 1001, 1915372254, 1, 20, 'On-Going', 1, '2023-04-01 02:46:18', '2023-04-07', 4000, 'assets/img/upload/payment/1678685885_1001996019640eb6bded555_Services-Financial-GInsure-App-Confirm-and-Pay-360x640-SS.png', '', '', '', 'Full Payment', 'Beginner Crochet Kit', 1),
(26, 1004, 1087763698, 1, 1, 'On-Going', 1, '2023-04-01 02:43:19', '2023-04-01', 150, '', 'Paypal', '82384728364', 'Lalamove (Same day delivery)', 'Installment', 'Beginner Crochet Kit', 2),
(30, 1019, 43391045177, 1, 1, 'On-Going', 1, '2023-04-01 03:48:55', '2023-04-01', 1200, '', '', '', '', '', 'Beginner Crochet Kit', 2);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` bigint(20) NOT NULL,
  `cust_name` varchar(60) NOT NULL,
  `cust_avatar` varchar(255) NOT NULL,
  `cust_email` varchar(60) DEFAULT NULL,
  `cust_pass` varchar(255) NOT NULL,
  `cust_reg` varchar(60) CHARACTER SET latin1 NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_zip` int(10) NOT NULL,
  `cust_ig` varchar(255) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `login_id` bigint(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_rank` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'user',
  `cust_address` varchar(160) NOT NULL,
  `cust_status` int(11) NOT NULL,
  `login_attempt` int(11) NOT NULL,
  `otp` int(11) NOT NULL,
  `verify_token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `cust_name`, `cust_avatar`, `cust_email`, `cust_pass`, `cust_reg`, `cust_city`, `cust_zip`, `cust_ig`, `cust_phone`, `login_id`, `date`, `user_rank`, `cust_address`, `cust_status`, `login_attempt`, `otp`, `verify_token`) VALUES
(1, 'Lia Maranan', 'assets/img/upload/avatars/1680265710_19208876046426d1ee478c6_admin.jpg', 'yarnoverhook.official@gmail.com', '$2y$10$yPW21R3XYBb7MuOXOuCycuduHLRF8ZNm1AGjxNxYmGq03DgxNnYSC', 'NCR', 'Quezon City', 1114, '', '09158433229', 3132667346, '2023-04-16 14:26:53', 'admin', '123 Block 1 Mabilis St., Quezon City', 1, 0, 415175, ''),
(2, 'Nina De Guzman', 'assets/img/upload/avatars/1680265287_13797944096426d047b607f_nina.jpg', 'ninadguzman.2k23@gmail.com', '$2y$10$YBqMhFAfFcju7X69tb0k3eNQ87jYK4Pxyf2fq4o.LYt7V.GbrDpP6', 'NCR', 'Quezon City', 1113, '@ninadg02', '09993093997', 7242156480, '2023-04-08 16:26:55', 'user', '18-B Tabayoc St. Sta. Mesa Heights, Quezon City', 1, 0, 0, ''),
(3, 'Darwin Manalastas', 'assets/img/upload/avatars/1680265332_16822325056426d074e4041_darwin.jpg', 'darwin.manalastas334@gmail.com', '$2y$10$YBqMhFAfFcju7X69tb0k3eNQ87jYK4Pxyf2fq4o.LYt7V.GbrDpP6', 'NCR', 'Mandaluyong City', 1010, '@hellodarwin', '09323155312', 1087763698, '2023-04-08 15:37:11', 'user', '12 Pioneer St., Boni Ave, Mandaluyong City', 1, 0, 0, ''),
(4, 'Rodrigo Villaramas', 'assets/img/upload/avatars/1680265350_7647666746426d086a3e5a_rodrigo.jpg', 'rodrigo.villaramas@gmail.com', '$2y$10$YBqMhFAfFcju7X69tb0k3eNQ87jYK4Pxyf2fq4o.LYt7V.GbrDpP6', 'MIMAROPA', 'Gasan City', 1114, '@rodrigo.villa2k', '09172238482', 4062959512, '2023-04-08 15:36:57', 'user', '20 Mapayapa St., Gasan City, Marinduque', 1, 0, 0, ''),
(5, 'Alfonso Garcia', 'assets/img/upload/avatars/1680265372_3896775336426d09cc9361_alfonso.jpg', 'yosefudesu@gmail.com', '$2y$10$NuafZZ31VDzsEgylQweMGOIzN/yu2A0.M.RJrTTNyXyHOLr/XemvO', 'NCR', 'Mandaluyong City', 8, '@alfonso_garcia', '09123456789', 9943549504, '2023-04-08 15:36:50', 'user', '#7 Apostles Street, Brgy. Ginebra, Mandaluyong City, NCR', 1, 0, 259390, '647792668265253058896188158055'),
(6, 'Engelbert Macadangdang', 'assets/img/upload/avatars/1680318372_209672437464279fa4457ae_default_user.jpg', 'ambivjaps@gmail.com', '$2y$10$/N03KNy6v/rpD4gQ4OSXcuk/Ndf8gyHS//6tgWUWNWuc8hntl4vHO', 'NCR', 'Quezon City', 122, '@engelbert123', '09158433229', 43391045177, '2023-04-16 16:20:04', 'user', '18-D Palali St. Sta. Mesa Heights, Quezon City', 1, 0, 601397, '');

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
  ADD PRIMARY KEY (`ItemID`),
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory_db`
--
ALTER TABLE `inventory_db`
  MODIFY `ItemID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;

--
-- AUTO_INCREMENT for table `orders_db`
--
ALTER TABLE `orders_db`
  MODIFY `OrderID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `vid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
