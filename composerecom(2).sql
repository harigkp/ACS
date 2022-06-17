-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 07:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `composerecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'nike', 1, '2022-06-07 10:45:59', '2022-06-07 10:45:59'),
(2, 'Provogue', 'provogue', 1, '2022-06-07 10:47:09', '2022-06-07 10:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Cat1', 'cat1', 1, '2022-06-06 08:16:45', '2022-06-08 06:45:59'),
(2, 'Cat2', 'cat2', 1, '2022-06-07 11:07:04', '2022-06-07 11:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address` text COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `billing_address`, `total_amount`, `payment_status`, `payment_details`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hari', 'hari@gmail.com', '9818759530', 'B1/19 Ghaziabad UP', 470.00, 'pending', 'cash on delivery', '2022-06-06 13:02:13', '2022-06-06 13:02:13'),
(2, 1, 'Hari', 'hari@gmail.com', '9818759530', 'B1/19 Ghaziabad UP', 200.00, 'pending', 'cash on delivery', '2022-06-06 13:03:23', '2022-06-06 13:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `user_id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 2, 150.00, '2022-06-06 13:02:13', '2022-06-06 13:02:13'),
(2, 1, 1, 1, 1, 70.00, '2022-06-06 13:02:13', '2022-06-06 13:02:13'),
(3, 1, 2, 2, 1, 100.00, '2022-06-06 13:03:23', '2022-06-06 13:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `active_on_slider` tinyint(1) NOT NULL,
  `size` smallint(6) NOT NULL,
  `gender` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `create_by` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category_id`, `brand_id`, `slug`, `description`, `price`, `sale_price`, `image`, `active`, `active_on_slider`, `size`, `gender`, `created_at`, `create_by`, `updated_at`, `updated_by`) VALUES
(1, 'Sweatshirt', 2, 2, 'sweatshirt', 'Men Navy Blue Solid Sweatshirt', 100.00, 70.00, 'assets/images/products/product-1654516521.jpg', 1, 1, 2, 1, '2022-06-06 08:22:00', 0, '2022-06-09 09:50:32', 0),
(2, 'Sporty Jacket', 1, 1, 'sporty-jacket', 'Sporty Jacket', 200.00, 100.00, 'assets/images/products/product-1654516789.jpg', 1, 1, 3, 1, '2022-06-06 08:29:49', 0, '2022-06-09 09:23:08', 0),
(3, 'shoes', 2, 1, 'shoes', 'shoes', 300.00, 150.00, 'assets/images/products/product-1654516847.jpg', 1, 1, 3, 1, '2022-06-06 08:30:47', 0, '2022-06-09 09:23:21', 0),
(4, 'Solid Lightweight Leather Jacket', 1, 2, 'solid-lightweight-leather-jacket', 'Solid Lightweight Leather Jacket', 500.00, 150.00, 'assets/images/products/product-1654516937.jpg', 1, 1, 2, 2, '2022-06-06 08:32:17', 0, '2022-06-09 09:23:32', 0),
(5, 'Women Blue Solid Shirt Dress', 1, 2, 'women-blue-solid-shirt-dress', 'Women Blue Solid Shirt Dress', 300.00, 100.00, 'assets/images/products/product-1654517010.jpg', 1, 1, 3, 2, '2022-06-06 08:33:30', 0, '2022-06-09 09:23:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'assets/images/productgallery/gallery-fc6aa4a53a76ca838e93175e6ed31a20-1654516361.jpg', '2022-06-06 08:22:41', '2022-06-06 08:22:41'),
(2, 1, 'assets/images/productgallery/gallery-3f22de4bf934ac9e1c54fe1e8312476f-1654516521.jpg', '2022-06-06 08:25:21', '2022-06-06 08:25:21'),
(3, 2, 'assets/images/productgallery/gallery-1f1cfa5e4d3accb6eb15c9aba5a095fd-1654516789.jpg', '2022-06-06 08:29:49', '2022-06-06 08:29:49'),
(4, 3, 'assets/images/productgallery/gallery-b120bea464cf7e8f76b11f270c3c6543-1654516847.jpg', '2022-06-06 08:30:47', '2022-06-06 08:30:47'),
(5, 4, 'assets/images/productgallery/gallery-8a27fa54a27da68673f9d27554a60d2b-1654516937.jpg', '2022-06-06 08:32:17', '2022-06-06 08:32:17'),
(6, 5, 'assets/images/productgallery/gallery-a1ed6b7e537381f3b2ddbd3fa98850bf-1654517010.jpg', '2022-06-06 08:33:30', '2022-06-06 08:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `service_job`
--

CREATE TABLE `service_job` (
  `job_id` varchar(255) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `api_init` varchar(100) DEFAULT NULL,
  `source_ip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  `email_verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `active`, `email_verified_at`, `email_verification_token`, `admin`, `created_at`, `updated_at`) VALUES
(1, 'Hari', 'hari@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2022-06-06', '', 1, '2022-06-05 18:30:00', NULL),
(2, 'Hari', 'hari_geust@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, '', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_products_brands` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_products_brands` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_img` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
