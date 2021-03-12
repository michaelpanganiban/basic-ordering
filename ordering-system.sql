-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 06:37 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ordering-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_configurations`
--

CREATE TABLE `delivery_configurations` (
  `config_id` int(11) NOT NULL,
  `location_name` varchar(150) NOT NULL,
  `delivery_amount` float NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_configurations`
--

INSERT INTO `delivery_configurations` (`config_id`, `location_name`, `delivery_amount`, `created_by`, `created_at`) VALUES
(1, 'Manila', 200, 1, '2021-03-11 12:06:55'),
(2, 'Bicol', 500, 1, '2021-03-11 12:08:20'),
(3, 'Pasay', 25, 1, '2021-03-11 12:08:45'),
(4, 'Las Pinas', 55, 1, '2021-03-11 12:10:35'),
(5, 'Cagayan', 200, 1, '2021-03-11 12:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `discount_configuration`
--

CREATE TABLE `discount_configuration` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(250) NOT NULL,
  `percentage` double NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount_configuration`
--

INSERT INTO `discount_configuration` (`discount_id`, `discount_name`, `percentage`, `created_by`, `created_at`) VALUES
(1, 'PWD', 20, 1, '2021-03-11 13:40:36'),
(2, 'Senior', 20, 1, '2021-03-11 13:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_11_014539_create_delivery_configurations_table', 0),
(5, '2021_03_11_014539_create_discount_configuration_table', 0),
(6, '2021_03_11_014539_create_failed_jobs_table', 0),
(7, '2021_03_11_014539_create_order_line_table', 0),
(8, '2021_03_11_014539_create_orders_table', 0),
(9, '2021_03_11_014539_create_password_resets_table', 0),
(10, '2021_03_11_014539_create_products_table', 0),
(11, '2021_03_11_014539_create_users_table', 0),
(12, '2021_03_11_014541_add_foreign_keys_to_order_line_table', 0),
(13, '2021_03_11_014541_add_foreign_keys_to_orders_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `sub_total` double NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `deliver_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `created_by` bigint(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `sub_total`, `delivery_id`, `deliver_amount`, `total_amount`, `created_by`, `created_at`) VALUES
(17, 'John Michael Panganiban', 1498.84, 2, 500, 998.84, 1, '2021-03-12 11:34:41'),
(18, 'John Michael Panganiban', 3199.36, 1, 200, 2999.36, 1, '2021-03-12 12:00:41'),
(20, 'Jane Doe', 699, 1, 200, 499, 2, '2021-03-12 12:41:30'),
(23, 'Jane Doe', 699, 1, 200, 499, 2, '2021-03-12 12:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `line_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `amount` double NOT NULL,
  `product_total_amount` double NOT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `discount_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`line_id`, `order_id`, `product_id`, `quantity`, `amount`, `product_total_amount`, `discount_id`, `discount_amount`) VALUES
(5, 17, 1, 1, 699, 699, 0, 0),
(6, 17, 2, 1, 799.84, 799.84, 0, 0),
(7, 18, 2, 5, 3999.2000000000003, 3199.36, 2, 20),
(8, 20, 1, 1, 699, 699, 0, 0),
(9, 23, 1, 1, 699, 699, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(125) NOT NULL,
  `price` float NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `created_by`, `created_at`) VALUES
(1, 'Elenor & Parks', 699, 1, '2021-03-11 14:04:02'),
(2, 'Sad Girls', 799.84, 1, '2021-03-11 14:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'john michael panganiban', 'johnmichaelpanganiban.its@gmail.com', NULL, '$2y$10$NpaPkdYojNCs.0b1V3qWq.6UjrXfXQRdJt.ghNwpPfkC3DhDL485q', NULL, '2021-03-10 16:56:41', '2021-03-10 16:56:41'),
(2, 'janedoe', 'janedoe@gmail.com', NULL, '$2y$10$JFUUVGbt7nC8Tjl2y9FL1e2J1tISAh.KhqP/ExxaxFrLfb/NCKwvG', NULL, '2021-03-11 20:28:35', '2021-03-11 20:28:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_configurations`
--
ALTER TABLE `delivery_configurations`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `discount_configuration`
--
ALTER TABLE `discount_configuration`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_delivery_id` (`delivery_id`),
  ADD KEY `fk_created_by` (`created_by`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`line_id`),
  ADD KEY `fk_order_id` (`order_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

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
-- AUTO_INCREMENT for table `delivery_configurations`
--
ALTER TABLE `delivery_configurations`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discount_configuration`
--
ALTER TABLE `discount_configuration`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delivery_id` FOREIGN KEY (`delivery_id`) REFERENCES `delivery_configurations` (`config_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
