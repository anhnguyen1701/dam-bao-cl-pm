-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 09:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lap_trinh_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(3) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `product_size`, `product_quantity`) VALUES
(127, 8, 2, 'm', 3),
(129, 3, 3, 'l', 2),
(130, 3, 3, 'm', 1),
(131, 3, 1, 'l', 1),
(132, 3, 1, 'm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `total` double NOT NULL,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `datetime`, `status`, `total`, `name`, `city`, `address`, `phone`, `note`) VALUES
(16, 3, '2021-11-17 20:44:32', 2, 11493000, 'Tung', 'TP. Hồ Chí Minh', 'xxx', 12345, 'xxxxxxxxxx'),
(17, 3, '2021-11-17 20:49:29', 0, 8495000, 'Tung', 'Hà Nội', 'Ahaha', 123, 'xxxxx'),
(18, 3, '2021-11-17 20:50:45', 0, 8495000, 'aaaa', 'Hà Nội', 'aaaaaaa', 123456, 'xxxxxxxxxxxxxxx'),
(19, 3, '2021-11-17 20:52:03', 2, 8495000, 'Nguyen Thanh', 'Hà Nội', 'sâfa', 123124321, 'xxxxx'),
(20, 3, '2021-11-17 21:15:35', 0, 5097000, 'zzzzzzz', 'Hà Nội', 'ádfghjk', 123456789, 'asnm,a'),
(21, 3, '2021-11-18 09:31:48', 0, 5097000, 'Nguyễn Thanh Tùng', 'Hà Nội', 'Nguyễn Văn Trỗi', 849279678, 'ghi chú'),
(22, 9, '2022-03-22 15:13:39', 0, 6796000, 'Anh', 'Hà Nội', 'Lý Cao Tông', 2147483647, '123'),
(23, 9, '2022-03-22 15:14:02', 0, 0, 'Anh', 'Hà Nội', 'Lý Cao Tông', 2147483647, '123');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(3) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_size`, `product_quantity`) VALUES
(5, 16, 3, 'l', 2),
(6, 16, 1, 'l', 1),
(7, 16, 2, 'm', 2),
(8, 16, 2, 'l', 1),
(9, 16, 2, 's', 1),
(12, 17, 1, 'l', 1),
(13, 17, 1, 'm', 1),
(14, 17, 2, 'm', 1),
(15, 17, 2, 'l', 1),
(16, 17, 2, 's', 1),
(19, 18, 1, 'l', 1),
(20, 18, 1, 'm', 1),
(21, 18, 2, 'm', 1),
(22, 18, 2, 'l', 1),
(23, 18, 2, 's', 1),
(26, 19, 1, 'l', 1),
(27, 19, 1, 'm', 1),
(28, 19, 2, 'm', 1),
(29, 19, 2, 'l', 1),
(30, 19, 2, 's', 1),
(33, 20, 2, 'l', 1),
(34, 20, 2, 'm', 1),
(35, 20, 2, 's', 1),
(36, 21, 2, 'l', 1),
(37, 21, 1, 'm', 1),
(38, 21, 1, 'l', 1),
(39, 22, 2, 'm', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `quantity_s` int(11) NOT NULL DEFAULT 100,
  `quantity_m` int(11) NOT NULL DEFAULT 100,
  `quantity_l` int(11) NOT NULL DEFAULT 100,
  `img1` text NOT NULL,
  `img2` text NOT NULL,
  `img3` text NOT NULL,
  `img4` text NOT NULL,
  `img5` text NOT NULL,
  `img6` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `gender`, `category`, `price`, `quantity_s`, `quantity_m`, `quantity_l`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`) VALUES
(1, 'Áo sơ mi khoác ngoài kẻ ca rô lót lông cừu nhân tạo', 'Nam', 'Áo khoác dáng sơ mi', 1699000, 100, 100, 100, 'https://static.zara.net/photos///2021/I/0/2/p/8416/300/401/2/w/750/8416300401_1_1_1.jpg?ts=1636456488196', 'https://static.zara.net/photos///2021/I/0/2/p/8416/300/401/2/w/750/8416300401_2_2_1.jpg?ts=1636456486824', 'https://static.zara.net/photos///2021/I/0/2/p/8416/300/401/2/w/750/8416300401_2_3_1.jpg?ts=1636456488046', 'https://static.zara.net/photos///2021/I/0/2/p/8416/300/401/2/w/750/8416300401_6_1_1.jpg?ts=1636375048495', 'https://static.zara.net/photos///2021/I/0/2/p/8416/300/401/2/w/750/8416300401_6_2_1.jpg?ts=1636375035583', 'https://static.zara.net/photos///2021/I/0/2/p/8416/300/401/2/w/750/8416300401_6_3_1.jpg?ts=1636375037016'),
(2, 'Áo khoác bomber chần bông', 'Nam', 'Puffers', 1699000, 100, 100, 100, 'https://static.zara.net/photos///2021/I/0/2/p/4302/301/505/2/w/750/4302301505_1_1_1.jpg?ts=1631088260079', 'https://static.zara.net/photos///2021/I/0/2/p/4302/301/505/2/w/750/4302301505_2_1_1.jpg?ts=1631088252950', 'https://static.zara.net/photos///2021/I/0/2/p/4302/301/505/2/w/750/4302301505_2_2_1.jpg?ts=1631088263878', 'https://static.zara.net/photos///2021/I/0/2/p/4302/301/505/2/w/750/4302301505_6_1_1.jpg?ts=1630940728339', 'https://static.zara.net/photos///2021/I/0/2/p/4302/301/505/2/w/750/4302301505_6_2_1.jpg?ts=1630940735113', 'https://static.zara.net/photos///2021/I/0/2/p/4302/301/505/2/w/750/4302301505_6_3_1.jpg?ts=1630940892881'),
(3, 'Áo len pha sợi dệt vặn thừng', 'Nam', 'Áo len', 1499000, 100, 100, 100, 'https://static.zara.net/photos///2021/I/0/1/p/2632/323/712/13/w/750/2632323712_1_1_1.jpg?ts=1636461336268', 'https://static.zara.net/photos///2021/I/0/1/p/2632/323/712/13/w/750/2632323712_2_1_1.jpg?ts=1636461335382', 'https://static.zara.net/photos///2021/I/0/1/p/2632/323/712/13/w/750/2632323712_2_2_1.jpg?ts=1636461337097', 'https://static.zara.net/photos///2021/I/0/1/p/2632/323/712/13/w/750/2632323712_2_6_1.jpg?ts=1636461340188', 'https://static.zara.net/photos///2021/I/0/2/p/2632/323/712/2/w/750/2632323712_6_1_1.jpg?ts=1635240761506', 'https://static.zara.net/photos///2021/I/0/2/p/2632/323/712/2/w/750/2632323712_6_3_1.jpg?ts=1635241061105');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `lastName`, `firstName`, `city`, `address`, `phone`, `role`) VALUES
(3, 'tung@gmail.com', 'tung', '', 'Tung', 'Hà Nội', 'đéo nói', 123456789, 'user'),
(8, 'bach@gmail.com', 'bach', 'Bach', 'Nguyen', 'Hà Nội', 'VN', 123456789, 'user'),
(9, 'nguyenlamanh1701@gmail.com', '123456', 'Anh', 'Nguyễn Lâm', 'Hà Nội', 'Lý Cao Tông', 2147483647, 'user'),
(10, 'admin', 'admin', 'admin', 'admin', '', '', 0, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
