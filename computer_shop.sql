-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 04:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computer_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `brand`, `category`, `image_url`) VALUES
(1, 'Laptop Dell XPS 13', 'The Dell XPS 13 is a premium laptop with a sleek design and powerful performance.', 1299.99, 'Dell', 'Laptop', 'img1.jpg'),
(2, 'Desktop PC HP Pavilion', 'The HP Pavilion is a versatile desktop PC suitable for both work and entertainment.', 899.99, 'HP', 'Desktop', 'img2.png'),
(3, 'Gaming Laptop ASUS ROG Strix', 'The ASUS ROG Strix is a high-performance gaming laptop with advanced graphics and cooling systems.', 1599.99, 'ASUS', 'Gaming Laptop', 'img3.jpeg'),
(4, 'Monitor LG UltraWide', 'The LG UltraWide monitor offers a wide display with crisp visuals, perfect for multitasking.', 499.99, 'LG', 'Monitor', 'img4.jpeg'),
(5, 'Laptop gaming MSI Vector GP77 HX 13VG 043VN', 'Description of Product 1', 19.99, NULL, NULL, 'img5.jpeg'),
(6, 'Laptop MSI Modern 15 B7M 099VN', 'Description of Product 2', 29.99, NULL, NULL, 'img6.jpeg'),
(7, 'Laptop gaming ASUS TUF Gaming A15 FA507NU LP034W', 'Description of Product 3', 39.99, NULL, NULL, 'img7.png'),
(8, 'Laptop Lenovo V14 G4 IAH 83FR000UVN', 'Description of Product 4', 49.99, NULL, NULL, 'img8.jpeg'),
(9, 'Laptop LG Gram 2023 14Z90R GAH53A5', 'Description of Product 5', 59.99, NULL, NULL, 'img9.jpeg'),
(10, 'Laptop Dell Inspiron 15 N3530 I3U085W11BLU', 'Description of Product 6', 69.99, NULL, NULL, 'img10.png'),
(11, 'Laptop gaming ASUS ROG Strix G16 G614JU N3135W', 'Description of Product 7', 79.99, NULL, NULL, 'img11.png'),
(12, 'Laptop gaming ASUS TUF Gaming F15 FX507ZC4 HN099W', 'Description of Product 8', 89.99, NULL, NULL, 'img12.jpg'),
(13, 'Laptop Lenovo ThinkPad E14 21E300E3VN', 'Description of Product 9', 99.99, NULL, NULL, 'img13.jpeg'),
(14, 'Laptop Lenovo Yoga Slim 7 14ACN6 82N7008VVN', 'Description of Product 10', 109.99, NULL, NULL, 'img14.jpg'),
(15, 'Laptop Acer Aspire 7 A715 76 53PJ', 'Description of Product 11', 119.99, NULL, NULL, 'img15.png'),
(16, 'Laptop Gaming Gigabyte AORUS 15 XE4 73VNB14GH', 'Description of Product 12', 129.99, NULL, NULL, 'img16.jpg'),
(17, 'Laptop gaming Gigabyte G5 MF E2VN333SH', 'Description of Product 13', 139.99, NULL, NULL, 'img17.png'),
(18, 'Laptop Lenovo Yoga Slim 7 Pro 14IHU5 O 82NH00BDVN', 'Description of Product 14', 149.99, NULL, NULL, 'img18.jpg'),
(19, 'Laptop LG Gram 2022 14Z90R GAH53A5', 'Description of Product 15', 159.99, NULL, NULL, 'img19.jpeg'),
(20, 'Laptop Asus ExpertBook B1400CEAE BV3186W', 'Description of Product 16', 169.99, NULL, NULL, 'img20.jpeg'),
(21, 'Laptop Dell Vostro 3510 7T2YC2', 'Description of Product 17', 179.99, NULL, NULL, 'img21.png'),
(22, 'Laptop gaming HP Victus 16 s0077AX 8C5N6PA', 'Description of Product 18', 189.99, NULL, NULL, 'img22.jpg'),
(23, 'Laptop Lenovo V14 G4 IAH 83FR000UVN', 'Description of Product 19', 199.99, NULL, NULL, 'img23.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
