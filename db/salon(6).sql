-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2020 at 07:51 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
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
-- Table structure for table `add_to_cart`
--

CREATE TABLE `add_to_cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_to_cart`
--

INSERT INTO `add_to_cart` (`id`, `item_id`, `item_name`, `item_price`, `item_quantity`, `customer_id`, `created_at`, `updated_at`, `status`) VALUES
(40, 2, 'Himalaya Neem Facial', 200.00, 3, 11, '2020-03-18 08:15:03', '2020-03-18 08:15:03', 0),
(41, 3, 'Ayur Facewash', 500.00, 1, 11, '2020-03-18 08:15:15', '2020-03-18 08:15:15', 0);

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
(3, 'Branch 1', 'Branch 1 address', '7566866565', 1, 1, '2019-12-16 06:54:33', '2019-12-16 06:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_code` varchar(255) DEFAULT NULL,
  `cust_type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `customer_image` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `other_contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(55) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `referral_hash_code` text NOT NULL,
  `referred_by` varchar(255) DEFAULT NULL,
  `reward_points` varchar(255) DEFAULT NULL,
  `reward_otp` int(11) DEFAULT NULL,
  `anniversary_date` date DEFAULT NULL,
  `rf_id` varchar(255) DEFAULT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL,
  `total_visit` int(11) NOT NULL,
  `total_revenue` float(10,2) NOT NULL,
  `total_reffer` int(11) DEFAULT NULL,
  `last_visit_date` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `customer_code`, `cust_type`, `name`, `customer_image`, `location`, `contact`, `other_contact`, `email`, `dob`, `gender`, `designation`, `referral_code`, `referral_hash_code`, `referred_by`, `reward_points`, `reward_otp`, `anniversary_date`, `rf_id`, `admin_id`, `remark`, `total_visit`, `total_revenue`, `total_reffer`, `last_visit_date`, `updated_at`, `created_at`, `customer_status`) VALUES
(16, 16, '753352', 'VIP', 'Rahul Saxena', '1595935643.png', 'Jabalpur', '9303333433', '9098333433', 'saxenarahul0101@gmail.com', '1970-01-01', 'Male', 'Developer', '16', 'c74d97b01eae257e44aa9d5bade97baf', '', '300', NULL, NULL, '16', 1, 'Test', 1, 0.00, 2, '2020-08-04', '2020-08-04 00:51:25', '2020-07-28 05:57:23', 1),
(17, 17, '965341', 'VIP', 'Rahul Saxena', NULL, 'Jabalpur', '9098333433', '9098333433', 'testxyz@gmail.com', '1970-01-01', 'Male', 'Developer', '17', '70efdf2ec9b086079795c442636b55fb', '16', '100', NULL, NULL, '17', 1, NULL, 0, 0.00, NULL, NULL, '2020-07-28 05:59:32', '2020-07-28 05:59:32', 1),
(18, 18, '834246', 'VIP', 'Jitendra Notnani', NULL, 'Jabalpur', '8085447788', '8085447788', 'testxyz2@gmail.com', '1970-01-01', 'Male', 'Developer', '18', '6f4922f45568161a8cdf4ad2299f6d23', '16', '100', NULL, NULL, '18', 1, NULL, 0, 0.00, NULL, NULL, '2020-07-28 06:01:49', '2020-07-28 06:01:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_package`
--

CREATE TABLE `customer_package` (
  `customer_package_id` int(1) NOT NULL,
  `customer_id` text NOT NULL,
  `member_in_package` int(11) DEFAULT NULL,
  `package_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_package`
--

INSERT INTO `customer_package` (`customer_package_id`, `customer_id`, `member_in_package`, `package_id`, `purchase_date`, `expire_date`, `updated_at`, `status`) VALUES
(1, '1', NULL, 0, '2020-03-06 06:12:24', '1970-01-01 00:00:00', '2020-03-06 07:41:08', 1),
(2, '1', NULL, 0, '2020-03-06 07:31:38', '1970-01-01 00:00:00', '2020-03-06 07:52:14', 1),
(3, '1', NULL, 0, '2020-03-06 07:41:54', '1970-01-01 00:00:00', '2020-03-06 07:54:12', 1),
(4, '1', NULL, 0, '2020-03-06 07:51:37', '1970-01-01 00:00:00', '2020-03-06 07:51:40', 1),
(5, '1', NULL, 0, '2020-03-06 07:52:23', '1970-01-01 00:00:00', '2020-03-06 07:52:25', 1),
(6, '1', NULL, 0, '2020-03-06 07:52:35', '1970-01-01 00:00:00', '2020-03-06 07:52:37', 1),
(7, '0', 1, 1, '2020-03-13 11:50:22', '2021-03-13 00:00:00', NULL, 1),
(8, '0', 1, 2, '2020-03-13 11:50:36', '2020-09-09 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_package_service`
--

CREATE TABLE `customer_package_service` (
  `package_service_id` int(11) NOT NULL,
  `customer_package_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `total_services` varchar(50) NOT NULL,
  `remaining_services` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_package_service`
--

INSERT INTO `customer_package_service` (`package_service_id`, `customer_package_id`, `service_id`, `total_services`, `remaining_services`, `status`) VALUES
(1, 1, 5, '3', '3', 1),
(2, 2, 1, '3', '3', 1),
(3, 3, 7, '3', '3', 1),
(4, 4, 6, '2', '2', 1),
(5, 5, 2, '2', '2', 1),
(6, 6, 4, '2', '2', 1),
(7, 7, 1, '12', '12', 1),
(8, 7, 2, '12', '12', 1),
(9, 7, 4, '12', '12', 1),
(10, 7, 5, '3', '3', 1),
(11, 7, 6, '1', '1', 1),
(12, 8, 1, '20', '20', 1),
(13, 8, 2, '20', '20', 1),
(14, 8, 4, '5', '5', 1),
(15, 8, 5, '10', '10', 1),
(16, 8, 6, '2', '2', 1),
(17, 8, 8, '2', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `remark` longtext DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `category_id`, `package_id`, `name`, `email`, `contact`, `address`, `remark`, `date`, `sid`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Test dev', 'testdev@salon.com', '7896541235', 'test address', 'test', '2020-01-11', 1, '2020-01-11 02:05:34', '2020-01-11 02:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_categories`
--

CREATE TABLE `enquiry_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `is_active` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry_categories`
--

INSERT INTO `enquiry_categories` (`id`, `category`, `admin_id`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'All boysw', 0, 1, NULL, '2019-12-24 08:05:02'),
(3, 'All Girls', 0, 1, NULL, '2019-12-24 13:34:23'),
(4, 'GROUP', 0, 1, NULL, '2019-12-24 13:34:23'),
(5, 'COUPLES', 0, 1, NULL, '2019-12-24 13:34:23'),
(6, 'CORPORATES', 0, 1, NULL, '2019-12-24 13:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `customer_id`, `rating`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'sdfsd', 1, '2020-02-01 06:53:56', '2020-02-01 06:53:56'),
(2, 1, 2, 'ddsfsd', 1, '2020-02-01 06:55:46', '2020-02-01 06:55:46'),
(3, 1, 2, 'sdfsd', 1, '2020-02-01 06:56:12', '2020-02-01 06:56:12'),
(4, 1, 2, 'sdfsd', 1, '2020-02-01 06:56:45', '2020-02-01 06:56:45'),
(5, 1, 2, 'sdfsd', 1, '2020-02-01 06:56:55', '2020-02-01 06:56:55'),
(6, 1, 2, 'sdfsd', 1, '2020-02-01 07:00:36', '2020-02-01 07:00:36'),
(7, 1, 2, 'sdfsd', 1, '2020-02-01 07:12:45', '2020-02-01 07:12:45'),
(8, 1, 2, 'sdfsd', 1, '2020-02-01 07:12:53', '2020-02-01 07:12:53'),
(9, 1, 3, 'sdsd', 1, '2020-02-01 12:27:13', '2020-02-01 12:27:13'),
(10, 1, 3, 'fdgfd', 1, '2020-02-01 12:27:50', '2020-02-01 12:27:50'),
(11, 1, 2, 'hdfh', 1, '2020-02-01 12:28:01', '2020-02-01 12:28:01'),
(12, 1, 3, 'sdds', 1, '2020-02-01 12:54:29', '2020-02-01 12:54:29'),
(13, 2, 3, 'fhd', 1, '2020-02-01 13:25:55', '2020-02-01 13:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

CREATE TABLE `firms` (
  `id` int(11) NOT NULL,
  `firm_name` text NOT NULL,
  `firm_location` text NOT NULL,
  `firm_number` text NOT NULL,
  `services` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `firms`
--

INSERT INTO `firms` (`id`, `firm_name`, `firm_location`, `firm_number`, `services`, `created_at`, `updated_at`, `status`) VALUES
(2, 'CV Salon', 'Jabalpur', '9303333433', '[\"1\",\"2\",\"4\"]', '2020-03-03 07:37:59', '2020-07-17 12:27:03', 1),
(3, 'Chinnie & Vinnie', 'Jabalpur', '9098333433', '[\"5\",\"6\",\"7\"]', '2020-03-06 05:23:05', '2020-03-09 12:53:44', 1),
(4, 'CV Parlour', 'Jabalpur', '9098333433', '[\"2\",\"4\",\"5\"]', '2020-03-06 05:34:21', '2020-07-17 12:47:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `cgst` float(10,2) NOT NULL,
  `sgst` float(10,2) NOT NULL,
  `payment_mode` varchar(55) NOT NULL,
  `total_discont_percent` float(10,2) NOT NULL,
  `total_discount_value` float(10,2) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `all_total` float(10,2) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `payable_amount` float(10,2) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `invoice_type` tinyint(1) NOT NULL COMMENT '1=by sms,2=with amount,3=without amount',
  `invoice_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `user_id`, `subtotal`, `cgst`, `sgst`, `payment_mode`, `total_discont_percent`, `total_discount_value`, `grand_total`, `all_total`, `paid_amount`, `payable_amount`, `remark`, `invoice_type`, `invoice_date`, `created_at`, `updated_at`, `payment_status`, `status`) VALUES
(1, 1, 580.00, 52.20, 52.20, 'Cash', 0.00, 0.00, 684.40, 684.40, 0.00, 684.40, 'Test', 0, '2020-07-14 00:00:00', '2020-07-14 13:17:13', '2020-07-14 13:17:13', 1, 1),
(2, 1, 386.00, 34.74, 34.74, 'Cash', 0.00, 0.00, 455.48, 455.48, 455.48, 0.00, 'Test', 1, '2020-07-16 00:00:00', '2020-07-16 13:17:39', '2020-07-16 13:17:39', 1, 1),
(3, 1, 386.00, 34.74, 34.74, 'Cash', 0.00, 0.00, 455.48, 455.48, 455.48, 0.00, 'Test', 1, '2020-07-16 00:00:00', '2020-07-16 13:23:11', '2020-07-16 13:23:11', 1, 1),
(4, 23, 6234.22, 561.08, 561.08, 'Cash', 15.00, 0.00, 7356.38, 7356.38, 7356.38, 0.00, 'Test', 2, '2020-07-16 00:00:00', '2020-07-16 13:38:52', '2020-07-16 13:38:52', 1, 1),
(5, 10, 2504.22, 225.38, 225.38, 'Cash', 10.00, 0.00, 2954.98, 2954.98, 2954.98, 0.00, 'Test', 2, '2020-07-28 00:00:00', '2020-07-28 08:02:12', '2020-07-28 08:02:12', 1, 1),
(6, 16, 1250.00, 112.50, 112.50, 'Cash', 0.00, 50.00, 1475.00, 1475.00, 1475.00, 0.00, 'Test', 1, '2020-08-04 00:00:00', '2020-08-04 06:21:25', '2020-08-04 06:21:25', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_package`
--

CREATE TABLE `invoice_package` (
  `invoice_package_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `cgst` float(10,2) NOT NULL,
  `sgst` float(10,2) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `package_status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_package`
--

INSERT INTO `invoice_package` (`invoice_package_id`, `invoice_id`, `package_id`, `price`, `discount`, `cgst`, `sgst`, `total_price`, `package_status`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1999.00, 22.00, 140.33, 140.33, 1839.88, 1, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(2, 5, 2, 1999.00, 22.00, 140.33, 140.33, 1839.88, 1, '2020-07-28 08:02:12', '2020-07-28 08:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_package_service`
--

CREATE TABLE `invoice_package_service` (
  `invoice_package_service_id` int(11) NOT NULL,
  `invoice_package_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `use_status` tinyint(1) NOT NULL COMMENT '1 = used,0=remaining',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_package_service`
--

INSERT INTO `invoice_package_service` (`invoice_package_service_id`, `invoice_package_id`, `service_id`, `quantity`, `total`, `use_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0.00, 1, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(2, 1, 2, 1, 0.00, 1, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(3, 1, 4, 1, 0.00, 1, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(4, 1, 5, 1, 0.00, 0, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(5, 1, 6, 1, 0.00, 0, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(6, 1, 8, 1, 0.00, 0, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(7, 2, 1, 1, 0.00, 1, '2020-07-28 08:02:12', '2020-07-28 08:02:12'),
(8, 2, 2, 1, 0.00, 1, '2020-07-28 08:02:12', '2020-07-28 08:02:12'),
(9, 2, 4, 1, 0.00, 1, '2020-07-28 08:02:12', '2020-07-28 08:02:12'),
(10, 2, 5, 1, 0.00, 0, '2020-07-28 08:02:12', '2020-07-28 08:02:12'),
(11, 2, 6, 1, 0.00, 0, '2020-07-28 08:02:12', '2020-07-28 08:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_product`
--

CREATE TABLE `invoice_product` (
  `invoice_product_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `cgst` float(10,2) NOT NULL,
  `sgst` float(10,2) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_product`
--

INSERT INTO `invoice_product` (`invoice_product_id`, `invoice_id`, `product_id`, `staff_id`, `quantity`, `price`, `discount`, `cgst`, `sgst`, `total_price`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 23, 1, 500.00, 20.00, 36.00, 36.00, 472.00, 1, '2020-07-14 13:17:13', '2020-07-14 13:17:13'),
(2, 2, 2, 23, 1, 200.00, 5.00, 17.10, 17.10, 224.20, 1, '2020-07-16 13:17:39', '2020-07-16 13:17:39'),
(3, 3, 2, 23, 1, 200.00, 5.00, 17.10, 17.10, 224.20, 1, '2020-07-16 13:23:11', '2020-07-16 13:23:11'),
(4, 4, 3, 23, 1, 500.00, 15.00, 38.25, 38.25, 501.50, 1, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(5, 5, 1, 20, 1, 950.00, 10.00, 76.95, 76.95, 1008.90, 1, '2020-07-28 08:02:12', '2020-07-28 08:02:12'),
(6, 6, 1, 23, 1, 950.00, 5.26, 81.00, 81.00, 1062.00, 1, '2020-08-04 06:21:25', '2020-08-04 06:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_remaining_amount`
--

CREATE TABLE `invoice_remaining_amount` (
  `invoice_remaining_amount_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `remaining_amount` float(10,2) NOT NULL,
  `payment_mode` varchar(55) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_remaining_amount`
--

INSERT INTO `invoice_remaining_amount` (`invoice_remaining_amount_id`, `invoice_id`, `user_id`, `paid_amount`, `remaining_amount`, `payment_mode`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 0.00, 684.40, 'NA', '2020-07-14 13:17:13', '2020-07-14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_service`
--

CREATE TABLE `invoice_service` (
  `invoice_service_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `cgst` float(10,2) NOT NULL,
  `sgst` float(10,2) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `service_status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_service`
--

INSERT INTO `invoice_service` (`invoice_service_id`, `invoice_id`, `service_id`, `staff_id`, `quantity`, `price`, `discount`, `cgst`, `sgst`, `total_price`, `service_status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 23, 1, 200.00, 10.00, 16.20, 16.20, 212.40, 1, '2020-07-14 13:17:13', '2020-07-14 13:17:13'),
(2, 2, 5, 23, 1, 200.00, 2.00, 17.64, 17.64, 231.28, 1, '2020-07-16 13:17:39', '2020-07-16 13:17:39'),
(3, 3, 5, 23, 1, 200.00, 2.00, 17.64, 17.64, 231.28, 1, '2020-07-16 13:23:11', '2020-07-16 13:23:11'),
(4, 4, 8, 20, 1, 5000.00, 15.00, 382.50, 382.50, 5015.00, 1, '2020-07-16 13:38:52', '2020-07-16 13:38:52'),
(5, 5, 11, 20, 1, 100.00, 10.00, 8.10, 8.10, 106.20, 1, '2020-07-28 08:02:12', '2020-07-28 08:02:12'),
(6, 6, 5, 23, 1, 200.00, 25.00, 13.50, 13.50, 177.00, 1, '2020-08-04 06:21:25', '2020-08-04 06:21:25'),
(7, 6, 9, 23, 1, 250.00, 20.00, 18.00, 18.00, 236.00, 1, '2020-08-04 06:21:25', '2020-08-04 06:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_staff_tip`
--

CREATE TABLE `invoice_staff_tip` (
  `staff_tip_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `tip_amount` float(10,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_transactions`
--

CREATE TABLE `invoice_transactions` (
  `invoice_transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_mode` text NOT NULL,
  `transaction_amount` float NOT NULL,
  `total_pay_amount` float(10,2) NOT NULL,
  `reward_point` int(11) DEFAULT NULL,
  `remaining_amount` float(10,2) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_transactions`
--

INSERT INTO `invoice_transactions` (`invoice_transaction_id`, `customer_id`, `payment_mode`, `transaction_amount`, `total_pay_amount`, `reward_point`, `remaining_amount`, `transaction_date`, `transaction_status`) VALUES
(1, 1, 'Cash', 1400, 1400.00, 0, 0.00, '2020-03-19 06:28:44', 0),
(2, 1, 'Cash', 200, 200.00, NULL, 0.00, '2020-07-13 13:04:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_trsansaction_details`
--

CREATE TABLE `invoice_trsansaction_details` (
  `invoice_trsansaction_detail_id` int(11) NOT NULL,
  `invoice_transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `date_of_service` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_trsansaction_details`
--

INSERT INTO `invoice_trsansaction_details` (`invoice_trsansaction_detail_id`, `invoice_transaction_id`, `product_id`, `quantity`, `price`, `date_of_service`, `status`) VALUES
(1, 1, 2, 2, 200.00, '2020-03-16 06:28:44', 1),
(2, 1, 3, 2, 500.00, '2020-03-19 06:28:44', 1),
(3, 2, 2, 1, 200.00, '2020-07-13 13:04:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `membership_title` varchar(255) NOT NULL,
  `membership_price` float(10,2) NOT NULL,
  `service_discount_type` tinyint(1) DEFAULT NULL COMMENT '1=Percent,2=Value',
  `service_discount` float(10,2) DEFAULT NULL,
  `product_discount_type` tinyint(1) DEFAULT NULL COMMENT '1=Percent,2=Value',
  `product_discount` float(10,2) DEFAULT NULL,
  `membership_validity` int(11) NOT NULL,
  `tax_applicable` tinyint(1) NOT NULL COMMENT '1=Yes,0=No',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=Active,0=Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `firm_id`, `membership_title`, `membership_price`, `service_discount_type`, `service_discount`, `product_discount_type`, `product_discount`, `membership_validity`, `tax_applicable`, `created_at`, `updated_at`, `status`) VALUES
(1, 3, 'Silver', 500.00, 1, 10.00, 1, 5.00, 30, 1, '2020-07-22 10:13:18', '2020-07-22 10:13:18', 1);

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
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_icon` text NOT NULL,
  `module_url` text NOT NULL,
  `module_order` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`, `module_icon`, `module_url`, `module_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', '<i class=\"fa fa-dashboard\"></i>', 'https://localhost/salon/home', 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00'),
(2, 'Quick Sale', '<i class=\"fa fa-money\"></i>', 'https://localhost/salon/quick_sale', 2, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00'),
(3, 'Customers', '<i class=\"fa fa-users\"></i>', 'https://localhost/salon/customers', 3, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00'),
(4, 'Firms', '<i class=\"fa fa-paper-plane\"></i>', 'https://localhost/salon/admin/firm', 4, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00'),
(5, 'Services', '<i class=\"fa fa-paper-plane\"></i>', 'https://localhost/salon/admin/services', 5, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00'),
(6, 'Products', '<i class=\"fa fa-paper-plane\"></i>', 'https://localhost/salon/admin/products', 6, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00'),
(7, 'Packages', '<i class=\"fa fa-paper-plane\"></i>', 'https://localhost/salon/admin/packages', 6, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00'),
(8, 'Membership', '<i class=\"fa fa-paper-plane\"></i>', 'https://localhost/salon/admin/membership', 6, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `module_action`
--

CREATE TABLE `module_action` (
  `module_action_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `enable_view` tinyint(1) NOT NULL,
  `enable_add` tinyint(1) NOT NULL,
  `enable_edit` tinyint(1) NOT NULL,
  `enable_delete` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module_action`
--

INSERT INTO `module_action` (`module_action_id`, `module_id`, `enable_view`, `enable_add`, `enable_edit`, `enable_delete`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(2, 2, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(3, 3, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(4, 4, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(5, 5, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(6, 6, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(7, 7, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(8, 8, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `package_services` text NOT NULL,
  `package_title` varchar(55) NOT NULL,
  `package_price` float NOT NULL,
  `special_price` float(10,2) DEFAULT NULL,
  `package_discount` int(11) DEFAULT NULL,
  `package_validity_type` tinyint(1) NOT NULL COMMENT '1=days,2=weeks,3=months,4=year',
  `package_duration` varchar(55) NOT NULL,
  `package_type` int(11) NOT NULL DEFAULT 0 COMMENT '1 = premium,2 = normal',
  `total_member` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `package_satus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `package_members`
--

CREATE TABLE `package_members` (
  `package_member_id` int(11) NOT NULL,
  `customer_package_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_members`
--

INSERT INTO `package_members` (`package_member_id`, `customer_package_id`, `customer_id`, `status`) VALUES
(1, 7, 1, 1),
(2, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `special_price` float(10,2) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `firm_id`, `product_name`, `product_price`, `special_price`, `product_quantity`, `created_at`, `updated_at`, `status`) VALUES
(1, 3, 'Herbal Hair Spa Cream', 950.00, NULL, 100, '2020-07-21 12:17:12', '2020-07-22 05:55:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `brand_icon` text NOT NULL,
  `brand_name` text NOT NULL,
  `brand_description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `service_id`, `brand_icon`, `brand_name`, `brand_description`, `created_at`, `updated_at`, `status`) VALUES
(1, 6, '1584355856.jpg', 'Himalaya', 'Best product', '2020-03-16 10:50:56', '2020-03-18 06:21:28', 1),
(3, 6, '1584430630.jpg', 'Garnier', 'khkfklskljl', '2020-03-17 07:37:10', '2020-03-18 06:21:20', 1),
(4, 6, '1584512104.jpg', 'Ayur', 'dgh', '2020-03-18 06:15:04', '2020-03-18 06:15:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotional_offer_sms`
--

CREATE TABLE `promotional_offer_sms` (
  `id` int(11) NOT NULL,
  `offer_title` text NOT NULL,
  `contact_number` text NOT NULL,
  `offer_sms` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `remaining_transaction_details`
--

CREATE TABLE `remaining_transaction_details` (
  `remaining_transaction_id` int(11) NOT NULL,
  `invoice_transaction_id` int(11) NOT NULL,
  `remaining_amount` float(10,2) NOT NULL,
  `due_date` datetime NOT NULL,
  `paid_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remaining_transaction_details`
--

INSERT INTO `remaining_transaction_details` (`remaining_transaction_id`, `invoice_transaction_id`, `remaining_amount`, `due_date`, `paid_date`, `status`) VALUES
(1, 2, 200.00, '2020-03-13 12:14:23', '2020-03-13 12:14:23', 0),
(2, 4, 4500.00, '2020-03-13 12:24:55', '2020-03-13 12:24:55', 0),
(3, 6, 1200.00, '2020-03-13 12:36:59', '2020-03-13 12:36:59', 0),
(4, 8, 600.00, '2020-03-16 00:00:00', '2020-03-16 05:21:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `remark` varchar(300) DEFAULT NULL,
  `status_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `is_del` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `c_id`, `remark`, `status_id`, `date`, `sid`, `is_del`, `created_at`, `updated_at`) VALUES
(1, 1, 'asdfsadf', 'Interested', '2020-01-11', 1, 0, '2020-01-11 01:23:07', '2020-01-11 01:23:07'),
(2, 1, 'I want to meet you', 'Interested', '2020-01-15', 1, 0, '2020-01-11 01:27:02', '2020-01-11 01:27:02'),
(3, 1, 'you have enrolled', 'Enrolled', '2020-01-11', 1, 0, '2020-01-11 01:27:33', '2020-01-11 01:27:33'),
(4, 1, 'He want to meet us', 'Interested', '2020-01-15', 1, 0, '2020-01-11 01:32:05', '2020-01-11 01:32:05'),
(5, 2, 'safsadf', 'Interested', '2020-01-11', 1, 0, '2020-01-11 01:50:18', '2020-01-11 01:50:18'),
(6, 3, 'ttt', 'Enrolled', '2020-01-11', 1, 0, '2020-01-11 01:57:32', '2020-01-11 01:57:32'),
(7, 1, 'test remark', 'Interested', '2020-01-15', 1, 0, '2020-01-11 02:07:25', '2020-01-11 02:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Admin', '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(2, 'Staff', '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permission`
--

CREATE TABLE `roles_permission` (
  `roles_permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `can_view` tinyint(1) NOT NULL,
  `can_add` tinyint(1) NOT NULL,
  `can_edit` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles_permission`
--

INSERT INTO `roles_permission` (`roles_permission_id`, `role_id`, `module_id`, `can_view`, `can_add`, `can_edit`, `can_delete`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(2, 1, 2, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(3, 1, 3, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(4, 1, 4, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(5, 1, 5, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(6, 1, 6, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(7, 1, 7, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1),
(8, 1, 8, 1, 1, 1, 1, '2020-08-05 00:00:00', '2020-08-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `staff` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `service_price` float(10,2) DEFAULT NULL,
  `special_price` float(10,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `group_id`, `admin_id`, `staff`, `service_icon`, `name`, `duration`, `service_price`, `special_price`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '[\"20\",\"23\",\"24\"]', '', 'Hair Cut', 30, NULL, NULL, NULL, 1, '2020-08-04 05:33:34', '2020-08-04 05:33:34'),
(2, 1, NULL, '[\"20\",\"23\",\"24\"]', '', 'Hair Colouring', 40, NULL, NULL, NULL, 1, '2020-08-04 05:34:54', '2020-08-04 05:34:54'),
(3, 5, NULL, '[\"20\",\"23\",\"24\"]', '', 'Normal wax', 30, NULL, NULL, NULL, 1, '2020-08-05 07:54:41', '2020-08-05 07:54:41'),
(4, 5, NULL, '[\"20\",\"24\"]', '', 'Oil wax', 40, NULL, NULL, NULL, 1, '2020-08-06 05:45:39', '2020-08-06 05:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `service_brands`
--

CREATE TABLE `service_brands` (
  `service_brand_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `service_price` float(10,2) NOT NULL,
  `special_price` float(10,2) NOT NULL,
  `service_duration` int(11) NOT NULL,
  `service_description` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `service_brand_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_brands`
--

INSERT INTO `service_brands` (`service_brand_id`, `service_id`, `brand_name`, `service_price`, `special_price`, `service_duration`, `service_description`, `created_at`, `updated_at`, `service_brand_status`) VALUES
(1, 1, 'Hair Cut', 120.00, 100.00, 0, 'Hair Cut', '2020-08-04 11:03:34', '2020-08-04 11:03:34', 1),
(2, 2, 'Garnier Colour', 200.00, 180.00, 0, 'Garnier Colour', '2020-08-04 11:04:54', '2020-08-04 11:04:54', 1),
(3, 2, 'Godreg Colour', 150.00, 120.00, 0, 'Godreg Colour', '2020-08-04 11:04:54', '2020-08-04 11:59:03', 1),
(6, 3, 'Full hand', 100.00, 80.00, 30, 'xffdg', '2020-08-05 13:24:41', '2020-08-06 11:18:37', 1),
(7, 3, 'Full leg', 200.00, 180.00, 50, 'dssd', '2020-08-05 13:24:41', '2020-08-06 11:18:37', 1),
(9, 4, 'Full hand', 300.00, 280.00, 40, 'sdf', '2020-08-06 11:15:39', '2020-08-06 11:15:39', 1),
(10, 4, 'Full leg', 450.00, 400.00, 50, 'dds', '2020-08-06 11:15:39', '2020-08-06 11:15:39', 1),
(11, 4, 'Under arms', 200.00, 150.00, 20, 'sffs', '2020-08-06 11:15:39', '2020-08-06 11:15:39', 1),
(12, 3, 'Under arms', 150.00, 100.00, 40, 'dffdg', '2020-08-06 11:36:27', '2020-08-06 11:36:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_group`
--

CREATE TABLE `service_group` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL COMMENT '0=main category',
  `group_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_group`
--

INSERT INTO `service_group` (`id`, `firm_id`, `parent_id`, `group_name`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 0, 'Hair Services', '2020-07-18 07:32:48', '2020-07-18 09:46:10', 1),
(2, 3, 0, 'Hair Removal', '2020-07-18 07:34:55', '2020-07-18 09:46:26', 1),
(3, 2, 0, 'Beauty Services', '2020-07-18 10:23:42', '2020-07-18 10:24:30', 1),
(4, 2, 1, 'Hair Cut', '2020-08-05 12:10:26', '2020-08-05 12:35:42', 1),
(5, 3, 2, 'Wax', '2020-08-05 13:22:45', '2020-08-05 13:22:45', 1),
(6, 2, 3, 'Facial', '2020-08-06 13:10:29', '2020-08-06 13:10:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_products`
--

CREATE TABLE `service_products` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `product_description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_products`
--

INSERT INTO `service_products` (`product_id`, `brand_id`, `service_id`, `product_name`, `price`, `product_description`, `create_date`, `status`) VALUES
(3, 4, 6, 'Ayur Facewash', 500.00, 'best', '2020-03-18 06:31:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_transaction`
--

CREATE TABLE `service_transaction` (
  `service_transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `transaction_amount` float(10,2) NOT NULL,
  `transaction_date` datetime(1) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sms_template`
--

CREATE TABLE `sms_template` (
  `id` int(11) NOT NULL,
  `template_name` varchar(55) NOT NULL,
  `template_message` text NOT NULL,
  `template_status` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_template`
--

INSERT INTO `sms_template` (`id`, `template_name`, `template_message`, `template_status`, `updated_at`, `created_at`) VALUES
(1, 'Registration', 'Thanks for Visiting CV salon we hope we served you well Please provide your valuable feedback .', 1, '2020-01-29 11:43:09', '2020-01-29 11:40:58'),
(2, 'Purchase', 'Purchase', 1, '2020-01-29 11:41:10', '2020-01-29 11:41:10'),
(3, '5 Star Feedback', 'Thanks for your valuable feedback, We are delightful to serve you . We Chinnie & Vinnie always promise to satisfy you our level best . Keep visiting.', 1, '2020-01-29 11:44:15', '2020-01-29 11:41:25'),
(4, '4 - 3 Star Feedback', 'We promise to gain 5 star from next time please describe what made us missed that star Thanks for your valuable feedback, We are delightful to serve you . We Chinnie & Vinnie always promise to satisfy you our level best . Keep visiting', 1, '2020-01-29 11:45:03', '2020-01-29 11:45:03'),
(5, '2 - 1 Star Feedback', 'Thanks for your valuable feedback , We are extremely very sorry for the issue , we will connect with you shortly regarding same We Chinnie & Vinnie always promise to satisfy you our level best we are sorry once again for the issue .', 1, '2020-01-29 11:45:32', '2020-01-29 11:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `transaction_amount` float(10,2) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `customer_id`, `package_id`, `payment_mode`, `transaction_amount`, `transaction_date`, `status`) VALUES
(1, 1, 1, 'Cash', 99.00, '2020-03-13 11:50:22', 1),
(2, 1, 2, 'Cash', 1999.00, '2020-03-13 11:50:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `transaction_history_id` int(11) NOT NULL,
  `invoice_transaction_id` int(11) NOT NULL,
  `pay_amount` float(10,2) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `remaining_amount` float(10,2) NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`transaction_history_id`, `invoice_transaction_id`, `pay_amount`, `paid_amount`, `remaining_amount`, `due_date`, `paid_date`, `status`) VALUES
(1, 1, 1400.00, 400.00, 1000.00, NULL, '2020-03-19 06:28:44', 1),
(2, 1, 1000.00, 400.00, 600.00, NULL, '2020-03-19 06:29:28', 1),
(3, 1, 600.00, 200.00, 400.00, NULL, '2020-03-19 06:30:02', 1),
(4, 1, 400.00, 400.00, 0.00, NULL, '2020-03-19 06:30:25', 1),
(5, 2, 200.00, 200.00, 0.00, NULL, '2020-07-13 13:04:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT 0 COMMENT 'roles',
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `register_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `branch_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`, `phone_no`, `image`, `status`, `register_by`) VALUES
(1, 0, 'admin', 'admin@gmail.com', NULL, '$2y$10$N17mZbEhrA2kl5iYGMPapOvSNT4lxJZiGaxtUCF3/mZf/COvBx/Ri', '0iBTSzqcmDZlHcMBoXo1ikR8eNvhwZNss6sDXx8MPBm8hNGpzDZmwBttiyww', '2019-06-01 00:38:28', '2019-08-23 05:31:04', 1, NULL, '', 1, ''),
(20, 3, 'Jeet', 'Jeet@gmail.com', NULL, '$2y$10$48aRg8/HFxq6XvJs7We0Ue4lRZ5x/kNOG.1wozx65d7jDgFaj0XYO', NULL, '2019-09-28 04:37:36', '2020-01-27 06:10:52', 0, '9876543210', '1580125252.png', 1, 'App'),
(23, 3, 'test', 'test@gmail.com', NULL, '$2y$10$N17mZbEhrA2kl5iYGMPapOvSNT4lxJZiGaxtUCF3/mZf/COvBx/Ri', NULL, '2019-09-28 14:55:09', '2020-01-27 06:26:17', 0, '42514251', '1580126177.png', 1, 'App'),
(24, 3, 'Sumit vyas', 'advrtu@gmail.com', NULL, '$2y$10$S1rAWtUqq.gxaG6IOkCWnuLTUAOLKSdNB2JECXuZNIw6IWRTPTYzu', NULL, '2019-09-30 19:37:43', '2020-01-27 06:11:58', 0, '7400774353', NULL, 1, 'App');

-- --------------------------------------------------------

--
-- Table structure for table `use_customer_package_services`
--

CREATE TABLE `use_customer_package_services` (
  `customer_package_service_id` int(11) NOT NULL,
  `package_member_id` int(11) NOT NULL,
  `package_service_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `use_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_package`
--
ALTER TABLE `customer_package`
  ADD PRIMARY KEY (`customer_package_id`);

--
-- Indexes for table `customer_package_service`
--
ALTER TABLE `customer_package_service`
  ADD PRIMARY KEY (`package_service_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_categories`
--
ALTER TABLE `enquiry_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_package`
--
ALTER TABLE `invoice_package`
  ADD PRIMARY KEY (`invoice_package_id`);

--
-- Indexes for table `invoice_package_service`
--
ALTER TABLE `invoice_package_service`
  ADD PRIMARY KEY (`invoice_package_service_id`);

--
-- Indexes for table `invoice_product`
--
ALTER TABLE `invoice_product`
  ADD PRIMARY KEY (`invoice_product_id`);

--
-- Indexes for table `invoice_remaining_amount`
--
ALTER TABLE `invoice_remaining_amount`
  ADD PRIMARY KEY (`invoice_remaining_amount_id`);

--
-- Indexes for table `invoice_service`
--
ALTER TABLE `invoice_service`
  ADD PRIMARY KEY (`invoice_service_id`);

--
-- Indexes for table `invoice_staff_tip`
--
ALTER TABLE `invoice_staff_tip`
  ADD PRIMARY KEY (`staff_tip_id`);

--
-- Indexes for table `invoice_transactions`
--
ALTER TABLE `invoice_transactions`
  ADD PRIMARY KEY (`invoice_transaction_id`);

--
-- Indexes for table `invoice_trsansaction_details`
--
ALTER TABLE `invoice_trsansaction_details`
  ADD PRIMARY KEY (`invoice_trsansaction_detail_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `module_action`
--
ALTER TABLE `module_action`
  ADD PRIMARY KEY (`module_action_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `package_members`
--
ALTER TABLE `package_members`
  ADD PRIMARY KEY (`package_member_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotional_offer_sms`
--
ALTER TABLE `promotional_offer_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remaining_transaction_details`
--
ALTER TABLE `remaining_transaction_details`
  ADD PRIMARY KEY (`remaining_transaction_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `roles_permission`
--
ALTER TABLE `roles_permission`
  ADD PRIMARY KEY (`roles_permission_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_brands`
--
ALTER TABLE `service_brands`
  ADD PRIMARY KEY (`service_brand_id`);

--
-- Indexes for table `service_group`
--
ALTER TABLE `service_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_products`
--
ALTER TABLE `service_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `service_transaction`
--
ALTER TABLE `service_transaction`
  ADD PRIMARY KEY (`service_transaction_id`);

--
-- Indexes for table `sms_template`
--
ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`transaction_history_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `use_customer_package_services`
--
ALTER TABLE `use_customer_package_services`
  ADD PRIMARY KEY (`customer_package_service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer_package`
--
ALTER TABLE `customer_package`
  MODIFY `customer_package_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_package_service`
--
ALTER TABLE `customer_package_service`
  MODIFY `package_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiry_categories`
--
ALTER TABLE `enquiry_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `firms`
--
ALTER TABLE `firms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_package`
--
ALTER TABLE `invoice_package`
  MODIFY `invoice_package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_package_service`
--
ALTER TABLE `invoice_package_service`
  MODIFY `invoice_package_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice_product`
--
ALTER TABLE `invoice_product`
  MODIFY `invoice_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_remaining_amount`
--
ALTER TABLE `invoice_remaining_amount`
  MODIFY `invoice_remaining_amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_service`
--
ALTER TABLE `invoice_service`
  MODIFY `invoice_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_staff_tip`
--
ALTER TABLE `invoice_staff_tip`
  MODIFY `staff_tip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_transactions`
--
ALTER TABLE `invoice_transactions`
  MODIFY `invoice_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_trsansaction_details`
--
ALTER TABLE `invoice_trsansaction_details`
  MODIFY `invoice_trsansaction_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module_action`
--
ALTER TABLE `module_action`
  MODIFY `module_action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_members`
--
ALTER TABLE `package_members`
  MODIFY `package_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promotional_offer_sms`
--
ALTER TABLE `promotional_offer_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remaining_transaction_details`
--
ALTER TABLE `remaining_transaction_details`
  MODIFY `remaining_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles_permission`
--
ALTER TABLE `roles_permission`
  MODIFY `roles_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_brands`
--
ALTER TABLE `service_brands`
  MODIFY `service_brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_group`
--
ALTER TABLE `service_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_products`
--
ALTER TABLE `service_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_transaction`
--
ALTER TABLE `service_transaction`
  MODIFY `service_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sms_template`
--
ALTER TABLE `sms_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `transaction_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `use_customer_package_services`
--
ALTER TABLE `use_customer_package_services`
  MODIFY `customer_package_service_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
