-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2019 at 02:26 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `phone`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(3, 'Branch 1', 'Branch 1 address', '7566866565', 1, 1, '2019-12-16 06:54:33', '2019-12-16 06:54:33'),
(4, 'Branch 2', 'Branch 2 Address', '7869548965', 1, 1, '2019-12-16 06:57:57', '2019-12-16 06:57:57');

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
(1, '2019_09_07_101941_create_hotels_table', 1),
(2, '2019_09_07_105744_create_hotel_services_table', 2),
(3, '2019_09_07_110621_create_hotel_rooms_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `admin_id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Service 1', 'This is service 1', 1, '2019-12-16 08:03:05', '2019-12-16 08:10:48'),
(2, 1, 'Service 2', 'This is service 2', 1, '2019-12-16 08:05:55', '2019-12-16 08:10:36'),
(3, 1, 'service 3', 'This is service 3-4', 1, '2019-12-16 08:06:34', '2019-12-16 08:06:51');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `register_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`, `phone_no`, `image`, `status`, `register_by`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$p4lzOqTpSF0G05l/V81lj.igyz79lG0rQkxAMyLquGVrCQelXTPLS', 'sVjQt6BVXiSiCcWKESmTWNyV1lFONnNCJbotDeAoTf6wbfQqqM7TJOZV4BkN', '2019-06-01 00:38:28', '2019-08-23 05:31:04', 1, NULL, '', 1, ''),
(20, 'Jeet', 'Jeet@gmail.com', NULL, '$2y$10$48aRg8/HFxq6XvJs7We0Ue4lRZ5x/kNOG.1wozx65d7jDgFaj0XYO', NULL, '2019-09-28 04:37:36', '2019-09-28 04:37:36', 0, '9876543210', NULL, 1, 'App'),
(23, 'test', 'test@gmail.com', NULL, '$2y$10$thltqKDgznjCyY3m6x4B3On4AG5/0qTFTrY9RCKX77SdLL8r8m4W6', NULL, '2019-09-28 14:55:09', '2019-09-28 14:55:09', 0, '42514251', NULL, 1, 'App'),
(24, 'Sumit vyas', 'advrtu@gmail.com', NULL, '$2y$10$S1rAWtUqq.gxaG6IOkCWnuLTUAOLKSdNB2JECXuZNIw6IWRTPTYzu', NULL, '2019-09-30 19:37:43', '2019-09-30 19:37:43', 0, '7400774353', NULL, 1, 'App'),
(26, 'Archit xyz', 'Archit52@gmail.com', NULL, '$2y$10$N1W2sO9iHSlk5BmmMFdWv.I1jDXFv1aOOf2/ofz81m1V8rf4u5.S6', NULL, '2019-10-04 05:57:36', '2019-10-04 05:57:36', 0, '8770054651', NULL, 1, 'App');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
