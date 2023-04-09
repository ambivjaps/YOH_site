-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 07:11 PM
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
(1002, 'Handmade Crochet (Ghibli Earrings) - Calcifer', 'assets/img/upload/inventory/1678472170_1393039690640b73ea7733a_ghibli earrings_calcifer.jpg', 'Handmade Hook earrings inspired by Ghibli movies\r\n\r\nHook: Silver\r\nCharacters: handmade\r\n\r\nDesign is by: y.o.h.plus', 'Raw', 2, 150, 55, '2023-04-01 03:48:55'),
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_db`
--
ALTER TABLE `inventory_db`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_db`
--
ALTER TABLE `inventory_db`
  MODIFY `ItemID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
