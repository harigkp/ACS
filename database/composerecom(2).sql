-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 07:38 PM
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
  `billing_address_id` int(11) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `billing_address_id`, `total_amount`, `payment_status`, `payment_details`, `created_at`, `updated_at`) VALUES
(24, 2, 'Ram', 'hari_geust@gmail.com', '9818759530', 3, 15954.00, 'pending', 'cash on delivery', '2022-06-24 07:35:40', '2022-06-24 07:35:40'),
(25, 1, 'Hari', 'hari@gmail.com', '9818759530', 4, 16354.00, 'pending', 'cash on delivery', '2022-06-24 08:04:51', '2022-06-24 08:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
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
(32, 2, 24, 4, 2, 150.00, '2022-06-24 07:35:40', '2022-06-24 07:35:40'),
(33, 2, 24, 14, 2, 7777.00, '2022-06-24 07:35:40', '2022-06-24 07:35:40'),
(34, 1, 25, 4, 4, 150.00, '2022-06-24 08:04:52', '2022-06-24 08:04:52'),
(35, 1, 25, 5, 1, 100.00, '2022-06-24 08:04:52', '2022-06-24 08:04:52'),
(36, 1, 25, 14, 2, 7777.00, '2022-06-24 08:04:52', '2022-06-24 08:04:52');

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
  `size` smallint(6) NOT NULL COMMENT 'S->1,M->2,L->3,XL->4,XXL->5',
  `gender` smallint(6) NOT NULL COMMENT 'Men->1,Women->2',
  `created_at` timestamp NULL DEFAULT NULL,
  `create_by` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category_id`, `brand_id`, `slug`, `description`, `price`, `sale_price`, `image`, `active`, `active_on_slider`, `size`, `gender`, `created_at`, `create_by`, `updated_at`, `updated_by`) VALUES
(3, 'shoes', 2, 1, 'shoes', 'shoes', 300.00, 150.00, 'assets/images/products/product-1654516847.jpg', 1, 1, 3, 1, '2022-06-06 08:30:47', 0, '2022-06-09 09:23:21', 0),
(4, 'Solid Lightweight Leather Jacket', 1, 2, 'solid-lightweight-leather-jacket', 'Solid Lightweight Leather Jacket', 500.00, 150.00, 'assets/images/products/product-1654516937.jpg', 1, 1, 2, 2, '2022-06-06 08:32:17', 0, '2022-06-09 09:23:32', 0),
(5, 'Women Blue Solid Shirt Dress', 1, 2, 'women-blue-solid-shirt-dress', 'Women Blue Solid Shirt Dress', 300.00, 100.00, 'assets/images/products/product-1654517010.jpg', 1, 1, 3, 2, '2022-06-06 08:33:30', 0, '2022-06-09 09:23:45', 0),
(7, 'test product', 1, 1, 'test-product', 'test product  test product  test product  test product  test product  test product  test product  test product  ', 2000.00, 1500.00, 'assets/images/products/product-1655901498.jpg', 1, 1, 2, 2, '2022-06-22 09:08:18', 0, '2022-06-22 09:08:18', 0),
(8, 'Sweatshirt New', 1, 1, 'sweatshirt-new', 'Sweatshirt New', 300.00, 150.00, 'assets/images/products/product-1655901910.jpg', 1, 1, 3, 1, '2022-06-22 09:15:10', 0, '2022-06-22 09:15:10', 0),
(9, 'test Hari', 1, 1, 'test-hari', 'test Hari', 400.00, 200.00, 'assets/images/products/product-1655902136.jpg', 1, 1, 2, 2, '2022-06-22 09:18:56', 0, '2022-06-22 09:18:56', 0),
(12, 'Solid Lightweight Leather Jacket New', 2, 2, 'solid-lightweight-leather-jacket-new', 'Solid Lightweight Leather Jacket New', 3999.00, 456.00, 'assets/images/products/product-1655902302.jpg', 1, 1, 1, 2, '2022-06-22 09:21:42', 0, '2022-06-22 09:21:42', 0),
(14, 'Sporty Jacket New', 1, 1, 'sporty-jacket-new', 'csacvsa', 8888.00, 7777.00, 'assets/images/products/product-1655902421.jpg', 1, 1, 3, 1, '2022-06-22 09:23:41', 0, '2022-06-22 09:23:41', 0),
(17, 'Product1', 1, 1, 'product1', 'Product1 Product1 Product1  Product1', 100.00, 50.00, 'assets/images/products/product-1656070877.jpg', 1, 1, 1, 2, '2022-06-24 08:11:17', 0, '2022-06-24 08:11:17', 0),
(18, 'Saree', 2, 2, 'saree', 'Saree', 500.00, 200.00, 'assets/images/products/product-1656070918.jpg', 1, 1, 2, 2, '2022-06-24 08:11:59', 0, '2022-06-24 08:11:59', 0),
(19, 'T-Shirt', 1, 1, 't-shirt', 'T-Shirt  T-Shirt  T-Shirt  T-Shirt  T-Shirt  T-Shirt  T-Shirt  T-Shirt  ', 400.00, 200.00, 'assets/images/products/product-1656070972.jpg', 1, 1, 3, 2, '2022-06-24 08:12:52', 0, '2022-06-24 08:12:52', 0),
(25, 'Tops', 1, 1, 'tops', 'Tops', 600.00, 150.00, 'assets/images/products/product-1656071096.jpg', 1, 1, 4, 2, '2022-06-24 08:14:56', 0, '2022-06-24 08:14:56', 0),
(26, 'Tops2', 1, 1, 'tops2', 'Tops2', 300.00, 100.00, 'assets/images/products/product-1656071189.jpg', 1, 1, 3, 2, '2022-06-24 08:16:29', 0, '2022-06-24 08:16:29', 0),
(27, 'Suite', 1, 1, 'suite', 'Suite', 300.00, 100.00, 'assets/images/products/product-1656071229.jpg', 1, 1, 4, 2, '2022-06-24 08:17:09', 0, '2022-06-24 08:17:09', 0),
(28, 'Saree2', 1, 1, 'saree2', 'Saree2', 300.00, 100.00, 'assets/images/products/product-1656071289.jpg', 1, 1, 5, 2, '2022-06-24 08:18:10', 0, '2022-06-24 08:18:10', 0),
(29, 'Suit3', 1, 1, 'suit3', 'Suit3', 400.00, 100.00, 'assets/images/products/product-1656071351.jpg', 1, 1, 4, 2, '2022-06-24 08:19:11', 0, '2022-06-24 08:19:11', 0);

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
(4, 3, 'assets/images/productgallery/gallery-b120bea464cf7e8f76b11f270c3c6543-1654516847.jpg', '2022-06-06 08:30:47', '2022-06-06 08:30:47'),
(5, 4, 'assets/images/productgallery/gallery-8a27fa54a27da68673f9d27554a60d2b-1654516937.jpg', '2022-06-06 08:32:17', '2022-06-06 08:32:17'),
(8, 7, 'assets/images/productgallery/gallery-44e07f5655faaac09cf49b821dc1c8f3-1655901498.jpg', '2022-06-22 09:08:18', '2022-06-22 09:08:18'),
(9, 8, 'assets/images/productgallery/gallery-cff85d7b81f0c4889bcd313c67a6d448-1655901910.jpg', '2022-06-22 09:15:10', '2022-06-22 09:15:10'),
(10, 9, 'assets/images/productgallery/gallery-61e148aacc4cc14849209be1b05a5909-1655902136.jpg', '2022-06-22 09:18:56', '2022-06-22 09:18:56'),
(11, 12, 'assets/images/productgallery/gallery-dd1e9542de0eef969382525a926b7398-1655902302.jpg', '2022-06-22 09:21:42', '2022-06-22 09:21:42'),
(12, 14, 'assets/images/productgallery/gallery-1004930fcbf40e11a4da7384229b0751-1655902421.jpg', '2022-06-22 09:23:41', '2022-06-22 09:23:41'),
(15, 17, 'assets/images/productgallery/gallery-24ba18886c36d30122a5602fd76cd327-1656070877.jpg', '2022-06-24 08:11:17', '2022-06-24 08:11:17'),
(16, 18, 'assets/images/productgallery/gallery-e5fcd6cae564f39dbecc113eb7abdac2-1656070919.jpg', '2022-06-24 08:11:59', '2022-06-24 08:11:59'),
(17, 19, 'assets/images/productgallery/gallery-6a56da011da10d425eb97f86ae521970-1656070972.jpg', '2022-06-24 08:12:52', '2022-06-24 08:12:52'),
(18, 25, 'assets/images/productgallery/gallery-37fc085c74d4f9dd27c08aee59ada7b8-1656071096.jpg', '2022-06-24 08:14:56', '2022-06-24 08:14:56'),
(19, 26, 'assets/images/productgallery/gallery-c11a9eeee284a7ce213d0a7d92fdf4d2-1656071189.jpg', '2022-06-24 08:16:29', '2022-06-24 08:16:29'),
(20, 27, 'assets/images/productgallery/gallery-be659fad17164e45f7b817dd9559eda1-1656071229.jpg', '2022-06-24 08:17:09', '2022-06-24 08:17:09'),
(21, 28, 'assets/images/productgallery/gallery-67b45880d56bb203de73cc933575b323-1656071290.jpg', '2022-06-24 08:18:10', '2022-06-24 08:18:10'),
(22, 29, 'assets/images/productgallery/gallery-b59ec6a7080209bf23ad5cb11a500a82-1656071351.jpg', '2022-06-24 08:19:11', '2022-06-24 08:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `useraddresses`
--

CREATE TABLE `useraddresses` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraddresses`
--

INSERT INTO `useraddresses` (`id`, `user_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, 'B1/19 Ghaziabad UP', '2022-06-24 12:11:03', '2022-06-24 12:11:03'),
(2, 2, 'test test', '2022-06-24 12:11:25', '2022-06-24 12:11:25'),
(3, 2, 'gdsgfsfs fvsvs dvd', '2022-06-24 13:00:39', '2022-06-24 13:00:39'),
(4, 1, '123 RK Puram, New Delhi-110022', '2022-06-24 13:34:39', '2022-06-24 13:34:39');

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
(2, 'Ram', 'hari_geust@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2022-06-15', '', 0, '2022-06-14 18:30:00', NULL);

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
  ADD KEY `product_id_2` (`product_id`);

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
-- Indexes for table `useraddresses`
--
ALTER TABLE `useraddresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `useraddresses`
--
ALTER TABLE `useraddresses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `useraddresses`
--
ALTER TABLE `useraddresses`
  ADD CONSTRAINT `useraddresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
