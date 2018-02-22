-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2017 at 02:55 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udistro`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_clients`
--

CREATE TABLE `agent_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `oname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `moving_from_id` int(10) UNSIGNED DEFAULT NULL,
  `moving_to_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `agent_clients`
--

INSERT INTO `agent_clients` (`id`, `agent_id`, `fname`, `lname`, `oname`, `email`, `contact_number`, `moving_from_id`, `moving_to_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 9, 'david', 'sone', 'clare', 'david12@gmail.com', '9876543220', NULL, NULL, '1', '2017-11-16 13:03:17', 9, '2017-11-17 06:48:24', 9),
(2, 9, 'Mark', 'down', 'lin', 'mark12@gmail.com', '9638527415', NULL, NULL, '1', '2017-11-17 06:49:39', 9, '2017-11-17 06:49:53', 9);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `province_id`, `name`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'city 1', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(2, 2, 'city 2', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(3, 3, 'city 3', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(4, 4, 'city 4', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(5, 5, 'city 5', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(6, 6, 'city 6', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(7, 7, 'city 7', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(8, 8, 'city 8', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(9, 9, 'city 9', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(10, 10, 'city 10', '1', '2017-11-09 17:00:00', 1, '2017-11-09 10:47:54', NULL),
(11, 1, 'city 11', '1', '2017-11-13 11:11:49', 1, '2017-11-13 06:12:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_navigations`
--

CREATE TABLE `cms_navigations` (
  `id` int(11) NOT NULL,
  `navigation_text` varchar(100) NOT NULL,
  `navigation_url` varchar(100) NOT NULL COMMENT 'It contains route after the project ''/''',
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_navigations`
--

INSERT INTO `cms_navigations` (`id`, `navigation_text`, `navigation_url`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(4, 'about', 'about', '1', '2017-11-17 09:21:36', 1, '2017-11-17 09:21:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_navigation_categories`
--

CREATE TABLE `cms_navigation_categories` (
  `id` int(11) NOT NULL,
  `navigation_type_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '	0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_navigation_categories`
--

INSERT INTO `cms_navigation_categories` (`id`, `navigation_type_id`, `category`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, 'company', '1', '2017-11-17 09:16:18', 1, '2017-11-17 09:16:18', NULL),
(2, 2, 'important links', '1', '2017-11-17 09:16:32', 1, '2017-11-17 09:16:32', NULL),
(3, 2, 'follow us', '1', '2017-11-17 09:16:41', 1, '2017-11-17 09:16:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_navigation_cms_navigation_category`
--

CREATE TABLE `cms_navigation_cms_navigation_category` (
  `cms_navigation_category_id` int(11) NOT NULL,
  `cms_navigation_id` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_navigation_cms_navigation_category`
--

INSERT INTO `cms_navigation_cms_navigation_category` (`cms_navigation_category_id`, `cms_navigation_id`, `status`) VALUES
(1, 4, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cms_navigation_types`
--

CREATE TABLE `cms_navigation_types` (
  `id` int(11) NOT NULL,
  `type` enum('top','bottom') NOT NULL,
  `status` enum('0','1','2') DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_navigation_types`
--

INSERT INTO `cms_navigation_types` (`id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'top', '1', '2017-11-01 06:48:03', '2017-11-01 06:47:26'),
(2, 'bottom', '1', '2017-11-01 06:48:08', '2017-11-01 06:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `navigation_id` int(11) NOT NULL COMMENT 'Id of the navigation',
  `page_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `navigation_id`, `page_name`, `page_content`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'about us', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>\n<p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>\n<p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>\n<p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p>\n<p>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p>\n<p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '1', '2017-11-07 06:49:05', 1, '2017-11-07 06:49:05', NULL),
(2, 2, 'terms of use', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Done</p>', '1', '2017-11-07 07:46:53', 1, '2017-11-07 09:18:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_category_id` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_category_id`, `address`, `province_id`, `city_id`, `postal_code`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'abc company', 1, '123 street', 3, 3, 'RTR 301', '1', '2017-11-15 07:45:30', 1, '2017-11-15 08:52:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_categories`
--

CREATE TABLE `company_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `company_categories`
--

INSERT INTO `company_categories` (`id`, `category`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'company category 1', '1', '2017-11-10 11:37:31', 1, '2017-11-13 06:53:23', 1),
(2, 'company category 2', '1', '2017-11-13 12:23:36', 1, '2017-11-13 06:53:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_user`
--

CREATE TABLE `company_user` (
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table to map the agent to the company';

--
-- Dumping data for table `company_user`
--

INSERT INTO `company_user` (`company_id`, `user_id`) VALUES
(1, 15),
(2, 6),
(2, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `email_lists`
--

CREATE TABLE `email_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hookup_services`
--

CREATE TABLE `hookup_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `province_id` int(10) UNSIGNED NOT NULL,
  `utility_service_id` int(10) UNSIGNED NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `user_id`, `last_login`, `count`) VALUES
(1, 9, '2017-11-17 11:02:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2017_10_26_091430_laratrust_setup_tables', 2),
(7, '2017_10_26_093103_add_status_to_user', 3),
(8, '2017_10_26_093516_add_last_login_to_user', 3),
(9, '2017_10_26_094721_create_company_details_table', 4),
(10, '2017_10_26_094740_create_cms_contents_table', 5),
(11, '2017_10_26_094752_create_email_lists_table', 5),
(12, '2017_10_26_094802_create_invitations_table', 5),
(13, '2017_10_26_094815_create_ratings_table', 6),
(14, '2017_10_26_094830_create_payment_plans_table', 6),
(15, '2017_10_26_101611_create_payment_plan_subscriptions_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@udistro.com', '$2y$10$ktYLPDt1Zq8SJIcrPWcsJuw86Jy14tTj9fP3VejqbQUwZgXqKiwzO', '2017-10-27 01:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `payment_plans`
--

CREATE TABLE `payment_plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_type_id` int(11) NOT NULL,
  `plan_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_charges` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `validity_days` int(11) NOT NULL COMMENT 'Validity in number of days',
  `number_of_emails` int(11) NOT NULL COMMENT 'No of emails allowed in the package',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_plans`
--

INSERT INTO `payment_plans` (`id`, `plan_type_id`, `plan_name`, `plan_charges`, `discount`, `validity_days`, `number_of_emails`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'payment plan 1', '50.00', '5.00', 30, 100, '1', '2017-11-10 08:38:00', 1, '2017-11-15 11:25:17', 1),
(2, 1, 'payment plan 2', '120.00', '10.00', 60, 200, '1', '2017-11-10 08:38:35', 1, '2017-11-15 11:25:32', 1),
(3, 1, 'payment plan 3', '150.00', '10.00', 90, 500, '1', '2017-11-15 09:45:37', 1, '2017-11-15 09:45:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan_subscriptions`
--

CREATE TABLE `payment_plan_subscriptions` (
  `plan_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan_types`
--

CREATE TABLE `payment_plan_types` (
  `id` int(11) NOT NULL,
  `plan_type` varchar(50) NOT NULL,
  `plan_type_desc` text NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_plan_types`
--

INSERT INTO `payment_plan_types` (`id`, `plan_type`, `plan_type_desc`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Agent', 'Payment plan for agents only', '1', '2017-11-15 09:25:27', 1, '2017-11-15 09:25:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `country_id`, `name`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Alberta', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(2, 1, 'British Columbia', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(3, 1, 'Manitoba', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(4, 1, 'New Brunswick', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(5, 1, 'Newfoundland and Labrador', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(6, 1, 'Northwest Territories', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(7, 1, 'Nova Scotia', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(8, 1, 'Nunavut', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(9, 1, 'Ontario', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(10, 1, 'Prince Edward Island', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(11, 1, 'Quebec', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(12, 1, 'Saskatchewan', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL),
(13, 1, 'Yukon', '1', '2017-11-08 09:33:51', 0, '2017-11-08 09:33:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2017-10-30 05:14:47', '2017-10-30 05:14:47'),
(2, 'company representative', 'company representative', 'User is allowed to add and manage agent associated with a company', '2017-11-13 06:37:41', '2017-11-13 06:37:41'),
(3, 'agent', 'agent', 'Agent associated with a company', '2017-11-13 06:39:35', '2017-11-13 06:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\User'),
(2, 4, 'App\\User'),
(3, 6, 'App\\User'),
(3, 8, 'App\\User'),
(3, 9, 'App\\User'),
(2, 10, 'App\\User'),
(2, 13, 'App\\User'),
(2, 15, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `social_sharings`
--

CREATE TABLE `social_sharings` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rating_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `social_sharing_platforms`
--

CREATE TABLE `social_sharing_platforms` (
  `id` int(11) NOT NULL,
  `platform_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `postalcode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL COMMENT 'To manage the last login datetime of user',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fname`, `lname`, `address`, `province_id`, `city_id`, `postalcode`, `password`, `remember_token`, `last_login`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'admin@udistro.com', 'admin', '', '', NULL, NULL, NULL, '$2y$10$M.pFE2TlBClEjdmbNBmDN.oPPJ/g02EywCQ3K8xC2HINUOebrdRam', '9pYaUVhwnOQ7nEkedAP2pARiCiYdQRnEJ4CaowlviL23xKsi75ROQcnZEDXp', '2017-11-17 14:45:17', '1', '2017-10-26 06:30:00', 0, '2017-11-17 09:15:17', 0),
(4, 'mayank1234@gmail.com', 'mayank', 'pandey', NULL, NULL, NULL, NULL, '$2y$10$kPFKoPPrVrJ0Kr6dphAbOerT64uyfe4XOlWeMDeJheO8Fc5sDnLee', NULL, NULL, '1', '2017-11-14 06:12:10', 1, '2017-11-14 10:04:04', 1),
(6, 'aman123@gmail.com', 'aman', 'kumar', 'address 1', 9, 9, '1', '$2y$10$kPFKoPPrVrJ0Kr6dphAbOerT64uyfe4XOlWeMDeJheO8Fc5sDnLee', NULL, NULL, '1', '2017-11-14 13:41:43', 1, '2017-11-14 13:41:43', NULL),
(8, 'john123@gmail.com', 'john', 'andrew', 'address 1', 9, 9, '1', '$2y$10$kPFKoPPrVrJ0Kr6dphAbOerT64uyfe4XOlWeMDeJheO8Fc5sDnLee', NULL, NULL, '1', '2017-11-14 13:45:50', 1, '2017-11-14 13:45:50', NULL),
(9, 'mack123@gmail.com', 'mack', 'manon', 'address', 2, 2, '123 456', '$2y$10$M.pFE2TlBClEjdmbNBmDN.oPPJ/g02EywCQ3K8xC2HINUOebrdRam', 'tESQYPnuXalWrQF5g7KEocR7GkZAWT8zTW6X8WWVlE4QRq4RoI2y4NEbm2Ds', '2017-11-17 16:32:08', '1', '2017-11-15 06:18:37', 1, '2017-11-17 11:02:08', 1),
(10, 'august123@gmail.com', 'jane', 'august', NULL, NULL, NULL, NULL, '$2y$10$mk.FfZel31y1paHksWeT1evNFNGRo.hhlvF7ddGxh8VCCUetBs2qa', NULL, NULL, '1', '2017-11-15 07:13:35', 1, '2017-11-15 07:13:35', NULL),
(13, 'jane123@gmail.com', 'jane', 'august', NULL, NULL, NULL, NULL, '$2y$10$xS5b7p/yhGfcgPMUAHV4AeZXdG/KaMq87QCEfjqzkj47zrSuGyT9y', NULL, NULL, '1', '2017-11-15 07:37:20', 1, '2017-11-15 07:37:20', NULL),
(15, 'rown_123@gmail.com', 'rown', 'cloney', NULL, NULL, NULL, NULL, '$2y$10$GXCf9X5dQXIKfVRT8cI0KeTJXuJM8NV2tmwb.U68ixl1JWj0Jysci', NULL, NULL, '1', '2017-11-15 07:45:30', 1, '2017-11-15 09:00:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utility_services`
--

CREATE TABLE `utility_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `utility_service_category_id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utility_service_categories`
--

CREATE TABLE `utility_service_categories` (
  `id` int(11) NOT NULL,
  `category_type` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_service_categories`
--

INSERT INTO `utility_service_categories` (`id`, `category_type`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Utility Service', 'Utility Service', '1', '2017-11-07 13:54:10', 1, '2017-11-08 11:36:08', NULL),
(2, 'Digital Service', 'Digital Service', '1', '2017-11-08 10:39:45', 1, '2017-11-08 10:39:45', NULL),
(3, 'Home Service', 'Home Service', '1', '2017-11-08 11:30:00', 1, '2017-11-08 11:37:22', NULL),
(4, 'Moving Service', 'Moving Service', '1', '2017-11-08 11:30:00', 1, '2017-11-08 11:38:52', NULL),
(5, 'Insurance Service', 'Insurance Service', '1', '2017-11-08 11:30:00', 1, '2017-11-08 11:38:58', NULL),
(6, 'Tech Squad', 'Tech Squad', '1', '2017-11-08 11:30:00', 1, '2017-11-08 11:39:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `utility_service_providers`
--

CREATE TABLE `utility_service_providers` (
  `id` int(11) NOT NULL,
  `utility_service_category_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_service_providers`
--

INSERT INTO `utility_service_providers` (`id`, `utility_service_category_id`, `company_name`, `country_id`, `province_id`, `city_id`, `address`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, 'abc company', 1, 1, 1, 'Address 1', '1', '2017-11-09 16:42:43', 1, '2017-11-09 11:12:43', NULL),
(2, 2, 'abc company', 1, 2, 2, 'address 2', '1', '2017-11-09 17:05:08', 1, '2017-11-09 12:45:06', 1),
(3, 2, 'abc', 1, 7, 7, 'test address', '1', '2017-11-17 16:22:16', 9, '2017-11-17 10:52:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `utility_service_provider_utility_service_type`
--

CREATE TABLE `utility_service_provider_utility_service_type` (
  `utility_service_provider_id` int(11) NOT NULL,
  `utility_service_type_id` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1: Active, 2: Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_service_provider_utility_service_type`
--

INSERT INTO `utility_service_provider_utility_service_type` (`utility_service_provider_id`, `utility_service_type_id`, `status`) VALUES
(1, 1, '1'),
(1, 4, '1'),
(2, 2, '1'),
(3, 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `utility_service_types`
--

CREATE TABLE `utility_service_types` (
  `id` int(11) NOT NULL,
  `utility_service_category_id` int(11) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_service_types`
--

INSERT INTO `utility_service_types` (`id`, `utility_service_category_id`, `service_type`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, 'cable', '1', '2017-11-08 13:29:27', 1, '2017-11-08 13:29:27', NULL),
(2, 2, 'Telephone', '1', '2017-11-08 13:35:03', 1, '2017-11-08 13:35:03', NULL),
(3, 2, 'Internet', '1', '2017-11-08 13:35:11', 1, '2017-11-08 13:35:11', NULL),
(4, 2, 'Fax', '1', '2017-11-09 06:08:23', 1, '2017-11-09 06:08:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_clients`
--
ALTER TABLE `agent_clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_no` (`contact_number`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_navigations`
--
ALTER TABLE `cms_navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_navigation_categories`
--
ALTER TABLE `cms_navigation_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_navigation_cms_navigation_category`
--
ALTER TABLE `cms_navigation_cms_navigation_category`
  ADD PRIMARY KEY (`cms_navigation_category_id`,`cms_navigation_id`);

--
-- Indexes for table `cms_navigation_types`
--
ALTER TABLE `cms_navigation_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_categories`
--
ALTER TABLE `company_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_user`
--
ALTER TABLE `company_user`
  ADD PRIMARY KEY (`company_id`,`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_lists`
--
ALTER TABLE `email_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hookup_services`
--
ALTER TABLE `hookup_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `utility_service_id` (`utility_service_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `province_id_2` (`province_id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_plans`
--
ALTER TABLE `payment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_plan_subscriptions`
--
ALTER TABLE `payment_plan_subscriptions`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `fk_user_subscription_id` (`user_id`);

--
-- Indexes for table `payment_plan_types`
--
ALTER TABLE `payment_plan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agent_id` (`agent_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `social_sharings`
--
ALTER TABLE `social_sharings`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `fk_social_user_id` (`user_id`);

--
-- Indexes for table `social_sharing_platforms`
--
ALTER TABLE `social_sharing_platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `utility_services`
--
ALTER TABLE `utility_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name` (`company_name`),
  ADD KEY `utility_service_category_id` (`utility_service_category_id`);

--
-- Indexes for table `utility_service_categories`
--
ALTER TABLE `utility_service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utility_service_providers`
--
ALTER TABLE `utility_service_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utility_service_types`
--
ALTER TABLE `utility_service_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_clients`
--
ALTER TABLE `agent_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cms_navigations`
--
ALTER TABLE `cms_navigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cms_navigation_categories`
--
ALTER TABLE `cms_navigation_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cms_navigation_types`
--
ALTER TABLE `cms_navigation_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_categories`
--
ALTER TABLE `company_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_lists`
--
ALTER TABLE `email_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hookup_services`
--
ALTER TABLE `hookup_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `payment_plans`
--
ALTER TABLE `payment_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payment_plan_types`
--
ALTER TABLE `payment_plan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `social_sharings`
--
ALTER TABLE `social_sharings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_sharing_platforms`
--
ALTER TABLE `social_sharing_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `utility_services`
--
ALTER TABLE `utility_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utility_service_categories`
--
ALTER TABLE `utility_service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `utility_service_providers`
--
ALTER TABLE `utility_service_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `utility_service_types`
--
ALTER TABLE `utility_service_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_plan_subscriptions`
--
ALTER TABLE `payment_plan_subscriptions`
  ADD CONSTRAINT `fk_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `payment_plans` (`id`),
  ADD CONSTRAINT `fk_user_subscription_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `fk_rule_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_sharings`
--
ALTER TABLE `social_sharings`
  ADD CONSTRAINT `fk_social_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
