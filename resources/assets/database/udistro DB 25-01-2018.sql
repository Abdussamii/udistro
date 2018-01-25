-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2018 at 02:51 PM
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
  `lname` varchar(50) DEFAULT NULL,
  `oname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `moving_from_id` int(10) UNSIGNED DEFAULT NULL,
  `moving_to_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `agent_clients`
--

INSERT INTO `agent_clients` (`id`, `agent_id`, `fname`, `lname`, `oname`, `email`, `contact_number`, `moving_from_id`, `moving_to_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 9, 'david', 'clare', '', 'david12@gmail.com', '9876543220', NULL, NULL, '1', '2017-11-16 13:03:17', 9, '2018-01-25 06:44:46', 9),
(2, 9, 'Mark', 'lin', '', 'mark12@gmail.com', '9638527415', NULL, NULL, '1', '2017-11-17 06:49:39', 9, '2018-01-25 06:44:50', 9),
(6, 1000, 'heric', 'sun', NULL, 'heric@gmail.com', '963258741', NULL, NULL, '1', '2018-01-03 13:55:50', NULL, '2018-01-03 13:55:50', NULL),
(7, 1000, 'gahh', 'jackman', NULL, 'gahh@gmail.com', '9632587410', NULL, NULL, '1', '2018-01-03 14:14:19', NULL, '2018-01-03 14:14:19', NULL),
(9, 1000, 'ahen', 'doke', NULL, 'ahendoke@gmail.com', '123456', NULL, NULL, '1', '2018-01-04 06:23:18', NULL, '2018-01-04 06:23:18', NULL),
(11, 1000, 'ramy', 'cil', NULL, 'ramy@gmail.com', '85214796330', NULL, NULL, '1', '2018-01-04 06:40:27', NULL, '2018-01-04 06:40:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agent_client_invites`
--

CREATE TABLE `agent_client_invites` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL,
  `message_content` text NOT NULL,
  `email_url` text,
  `schedule_status` enum('0','1') NOT NULL COMMENT '0: Send Immediately, 1: Schedule it for later',
  `schedule_datetime` date DEFAULT NULL COMMENT 'Schedule email datetime',
  `status` enum('0','1','2') NOT NULL COMMENT 'Email Life Cycle: 0: Send, 1: Read, 2: Expire',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `agent_client_invites`
--

INSERT INTO `agent_client_invites` (`id`, `agent_id`, `client_id`, `email_template_id`, `message_content`, `email_url`, `schedule_status`, `schedule_datetime`, `status`, `created_at`, `created_by`, `updated_at`) VALUES
(3, 9, 1, 1, 'Hello David Clare Sone,\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'http://localhost/udistro/public/movers/authenticate?agent_id=OQ==&client_id=MQ==&invitation_id=Mw==', '0', NULL, '0', '2017-12-07 17:48:48', 9, '2017-12-07 12:18:48'),
(4, 9, 2, 1, 'Hello Mark Lin,\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'http://localhost/udistro/public/movers/authenticate?agent_id=OQ==&client_id=Mg==&invitation_id=NA==', '0', NULL, '0', '2017-12-07 17:48:53', 9, '2017-12-07 12:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `agent_client_moving_from_addresses`
--

CREATE TABLE `agent_client_moving_from_addresses` (
  `id` int(11) NOT NULL,
  `agent_client_id` int(11) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `province_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `agent_client_moving_from_addresses`
--

INSERT INTO `agent_client_moving_from_addresses` (`id`, `agent_client_id`, `address1`, `address2`, `province_id`, `city_id`, `postal_code`, `country_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, '126-6 Meridian Pl', '', 9, 367, 'K2G 6L9', 1, '1', '2017-11-27 12:26:01', 9, '2017-12-21 06:57:23', 9),
(3, 1, '502-2945 Pembina Hwy', '', 9, 367, 'K2G 6L9', 1, '1', '2017-11-27 15:45:58', 9, '2018-01-05 10:53:05', 9),
(7, 6, '423-181 Janefield Ave', '', 9, 109, 'N1G 1V2', 1, '1', '2018-01-03 19:25:50', 1000, '2018-01-03 13:55:50', NULL),
(8, 7, '4-46350 Cessna Dr', '', 2, 24, 'V2P 7W3', 1, '1', '2018-01-03 19:44:19', 1000, '2018-01-03 14:14:19', NULL),
(9, 9, '1236-3779 Sexsmith Rd', '', 2, 59, 'V6X 3Z9', 1, '1', '2018-01-04 11:53:18', 1000, '2018-01-04 06:23:18', NULL),
(10, 11, '1236-3779 Sexsmith Rd', '', 2, 59, 'V6X 3Z9', 1, '1', '2018-01-04 12:10:27', 1000, '2018-01-04 06:40:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agent_client_moving_to_addresses`
--

CREATE TABLE `agent_client_moving_to_addresses` (
  `id` int(11) NOT NULL,
  `agent_client_id` int(11) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `province_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL,
  `moving_date` date NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `agent_client_moving_to_addresses`
--

INSERT INTO `agent_client_moving_to_addresses` (`id`, `agent_client_id`, `address1`, `address2`, `province_id`, `city_id`, `postal_code`, `country_id`, `moving_date`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, '125-350 Columbia St W', '', 9, 367, 'N2L 6P3', 1, '2017-11-30', '1', '2017-11-27 12:26:01', 9, '2018-01-11 11:39:45', 9),
(3, 1, '63 lark ridge way', '', 9, 367, 'N2L 6P3', 1, '2017-11-28', '1', '2017-11-27 15:45:58', 9, '2018-01-11 11:39:47', 9),
(7, 6, '365-201 Southridge Dr', '', 1, 109, 'T1S 2E1', 1, '0000-00-00', '1', '2018-01-03 19:25:50', 1000, '2018-01-03 13:57:38', NULL),
(8, 7, '635-550 Mornington Ave', '', 9, 116, 'N5Y 3E7', 1, '2018-01-31', '1', '2018-01-03 19:44:19', 1000, '2018-01-03 14:14:19', NULL),
(9, 9, '569-215 Fairview Dr SE', '', 1, 3, 'T2H 1B7', 1, '2018-01-20', '1', '2018-01-04 11:53:18', 1000, '2018-01-04 06:23:18', NULL),
(10, 11, '569-215 Fairview Dr SE', '', 1, 3, 'T2H 1B7', 1, '2018-01-19', '1', '2018-01-04 12:10:27', 1000, '2018-01-04 06:40:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agent_client_ratings`
--

CREATE TABLE `agent_client_ratings` (
  `id` int(11) NOT NULL,
  `invitation_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rating` float DEFAULT NULL,
  `comment` text,
  `helpful` enum('0','1') NOT NULL COMMENT '0: No, 1: Yes',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent_client_ratings`
--

INSERT INTO `agent_client_ratings` (`id`, `invitation_id`, `agent_id`, `client_id`, `rating`, `comment`, `helpful`, `created_at`) VALUES
(1, 3, 24, 1, 4, 'Hi Mack Manon,I appreciate you work and want to say thank you.', '0', '2018-01-24 12:21:22'),
(2, 3, 24, 1, 3, 'Hi Mack Manon,I appreciate you work and want to say thank you.', '1', '2018-01-24 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category_services`
--

CREATE TABLE `category_services` (
  `id` int(10) NOT NULL,
  `company_category_id` int(11) NOT NULL,
  `service` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category_services`
--

INSERT INTO `category_services` (`id`, `company_category_id`, `service`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 4, 'TV', 'TV', '1', '2017-12-13 16:00:00', 1, '2018-01-05 07:23:32', NULL),
(2, 4, 'Internet', 'Internet', '1', '2017-12-13 16:00:00', 1, '2017-12-13 11:01:12', NULL),
(3, 4, 'Phone', 'Phone', '1', '2017-12-13 16:00:00', 1, '2017-12-13 11:01:12', NULL),
(5, 4, 'Fax', 'Fax', '1', '2017-12-13 16:00:00', 1, '2017-12-13 11:01:12', NULL),
(6, 4, 'Security system', 'Security system', '1', '2017-12-13 16:00:00', 1, '2018-01-05 07:24:15', NULL),
(7, 3, 'Truck Renters', 'Truck Renters', '1', '2017-12-13 17:00:00', 1, '2017-12-13 11:03:41', NULL),
(8, 3, 'Boxing service', 'Boxing service', '1', '2017-12-13 17:00:00', 1, '2017-12-13 11:03:41', NULL),
(9, 3, 'Assembling service', 'Assembling service', '1', '2017-12-13 17:00:00', 1, '2017-12-13 11:03:41', NULL),
(10, 3, 'Disassembling service', 'Disassembling service', '1', '2017-12-13 17:00:00', 1, '2017-12-13 11:03:41', NULL),
(11, 3, 'Shuttle Service', 'Packing service', '1', '2017-12-13 17:00:00', 1, '2017-12-21 11:24:05', NULL),
(12, 3, 'Transport service', 'Transport service', '1', '2017-12-13 17:00:00', 1, '2017-12-13 11:03:41', NULL),
(13, 3, 'Storage Service', 'Storage Service', '1', '2017-12-13 17:00:00', 1, '2017-12-13 11:03:41', NULL),
(14, 3, 'Packing Service', 'Packing Service', '1', '2017-12-21 15:00:00', 1, '2017-12-21 10:39:29', NULL),
(15, 5, 'Installer', 'Installer', '1', '2018-01-02 12:00:00', 1, '2018-01-02 07:06:26', NULL),
(16, 5, 'Lawn care', 'Lawn care', '0', '2018-01-02 12:00:00', 1, '2018-01-02 07:16:34', NULL),
(18, 5, 'Plumbing', 'Plumbing', '1', '2018-01-02 12:00:00', 1, '2018-01-02 07:11:01', NULL),
(19, 5, 'Painting', 'Painting', '1', '2018-01-02 12:00:00', 1, '2018-01-02 07:33:36', NULL),
(20, 2, 'cleaning', 'cleaning', '1', '2018-01-08 18:00:00', 1, '2018-01-08 13:43:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_service_company`
--

CREATE TABLE `category_service_company` (
  `category_service_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_service_company`
--

INSERT INTO `category_service_company` (`category_service_id`, `company_id`) VALUES
(1, 10),
(2, 10),
(3, 10),
(5, 10),
(6, 10),
(7, 7),
(7, 8),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(11, 8),
(12, 7),
(12, 8),
(13, 7),
(13, 8),
(14, 7),
(15, 9),
(18, 9),
(19, 9),
(20, 11);

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
(1, 1, 'Airdrie', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(2, 1, 'Brooks', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(3, 1, 'Calgary', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(4, 1, 'Camrose', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(5, 1, 'Chestermere', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(6, 1, 'Cold Lake', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(7, 1, 'Edmonton', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(8, 1, 'Fort Saskatchewan', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(9, 1, 'Grande Prairie', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(10, 1, 'Lacombe', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(11, 1, 'Leduc', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(12, 1, 'Lethbridge', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(13, 1, 'Lloydminster', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(14, 1, 'Medicine Hat', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(15, 1, 'Red Deer', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(16, 1, 'Spruce Grove', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(17, 1, 'St. Albert', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(18, 1, 'Wetaskiwin', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:14:22', NULL),
(19, 2, 'Abbotsford', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(20, 2, 'Armstrong', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(21, 2, 'Burnaby', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(22, 2, 'Campbell River', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(23, 2, 'Castlegar', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(24, 2, 'Chilliwack', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(25, 2, 'Colwood', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(26, 2, 'Coquitlam', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(27, 2, 'Courtenay', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(28, 2, 'Cranbrook', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(29, 2, 'Dawson Creek', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(30, 2, 'Delta', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(31, 2, 'Duncan', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(32, 2, 'Enderby', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(33, 2, 'Fernie', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(34, 2, 'Fort St. John', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(35, 2, 'Grand Forks', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(36, 2, 'Greenwood', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(37, 2, 'Kamloops', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(38, 2, 'Kelowna', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(39, 2, 'Kimberley', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(40, 2, 'Langford', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(41, 2, 'Langley', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(42, 2, 'Maple Ridge', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(43, 2, 'Merritt', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(44, 2, 'Nanaimo', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(45, 2, 'Nelson', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(46, 2, 'New Westminster', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(47, 2, 'North Vancouver', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(48, 2, 'Parksville', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(49, 2, 'Penticton', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(50, 2, 'Pitt Meadows', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(51, 2, 'Port Alberni', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(52, 2, 'Port Coquitlam', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(53, 2, 'Port Moody', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(54, 2, 'Powell River', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(55, 2, 'Prince George', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(56, 2, 'Prince Rupert', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(57, 2, 'Quesnel', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(58, 2, 'Revelstoke', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(59, 2, 'Richmond', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(60, 2, 'Rossland', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(61, 2, 'Salmon Arm', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(62, 2, 'Terrace', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(63, 2, 'Trail', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(64, 2, 'Vancouver', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(65, 2, 'Vernon', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(66, 2, 'Victoria', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(67, 2, 'West Kelowna', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(68, 2, 'White Rock', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(69, 2, 'Williams Lake', '1', '2017-11-22 15:42:00', 1, '2017-11-22 10:20:48', NULL),
(70, 3, 'Brandon', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(71, 3, 'Dauphin', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(72, 3, 'Flin Flon', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(73, 3, 'Morden', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(74, 3, 'Portage la Prairie', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(75, 3, 'Selkirk', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(76, 3, 'Steinbach', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(77, 3, 'Thompson', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(78, 3, 'Winkler', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(79, 3, 'Winnipeg', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:22:55', NULL),
(80, 4, 'Bathurst', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(81, 4, 'Campbellton', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(82, 4, 'Dieppe', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(83, 4, 'Edmundston', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(84, 4, 'Fredericton', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(85, 4, 'Miramichi', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(86, 4, 'Moncton', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(87, 4, 'Saint John', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:48:58', NULL),
(88, 5, 'Corner Brook', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:56:31', NULL),
(89, 5, 'Mount Pearl', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:56:31', NULL),
(90, 5, 'St. John\'s', '1', '2017-11-22 15:55:00', 1, '2017-11-22 10:56:31', NULL),
(91, 6, 'Yellowknife', '1', '2017-11-22 16:30:00', 1, '2017-11-22 10:58:19', NULL),
(92, 7, 'Halifax', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:00:41', NULL),
(93, 7, 'Sydney', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:00:41', NULL),
(94, 7, 'Dartmouth', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:00:41', NULL),
(95, 8, 'Iqaluit', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:01:28', NULL),
(96, 9, 'Barrie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(97, 9, 'Belleville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(98, 9, 'Brampton', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(99, 9, 'Brant', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(100, 9, 'Brantford', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(101, 9, 'Brockville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(102, 9, 'Burlington', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(103, 9, 'Cambridge', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(104, 9, 'Clarence-Rockland', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(105, 9, 'Cornwall', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(106, 9, 'Dryden', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(107, 9, 'Elliot Lake', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(108, 9, 'Greater Sudbury', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(109, 9, 'Guelph', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(110, 9, 'Haldimand County', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(111, 9, 'Hamilton', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(112, 9, 'Kawartha Lakes', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(113, 9, 'Kenora', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(114, 9, 'Kingston', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(115, 9, 'Kitchener', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(116, 9, 'London', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(117, 9, 'Markham', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(118, 9, 'Mississauga', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(119, 9, 'Niagara Falls', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(120, 9, 'Norfolk County', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(121, 9, 'North Bay', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(122, 9, 'Orillia', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(123, 9, 'Oshawa', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(124, 9, 'Ottawa', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(125, 9, 'Owen Sound', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(126, 9, 'Pembroke', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(127, 9, 'Peterborough', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(128, 9, 'Pickering', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(129, 9, 'Port Colborne', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(130, 9, 'Prince Edward County', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(131, 9, 'Quinte West', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(132, 9, 'Sarnia', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(133, 9, 'Sault Ste. Marie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(134, 9, 'St. Catharines', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(135, 9, 'St. Thomas', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(136, 9, 'Stratford', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(137, 9, 'Temiskaming Shores', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(138, 9, 'Thorold', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(139, 9, 'Thunder Bay', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(140, 9, 'Timmins', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(141, 9, 'Toronto', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(142, 9, 'Vaughan', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(143, 9, 'Waterloo', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(144, 9, 'Welland', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(145, 9, 'Windsor', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(146, 9, 'Woodstock', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:08:33', NULL),
(147, 10, 'Charlottetown', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:09:18', NULL),
(148, 10, 'Summerside', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:09:18', NULL),
(150, 11, 'Acton Vale', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(151, 11, 'Alma', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(152, 11, 'Amos', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(153, 11, 'Amqui', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(154, 11, 'Asbestos', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(155, 11, 'Baie-Comeau', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(156, 11, 'Baie-D\'Urfé', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(157, 11, 'Baie-Saint-Paul', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(158, 11, 'Barkmere', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(159, 11, 'Beaconsfield', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(160, 11, 'Beauceville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(161, 11, 'Beauharnois', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(162, 11, 'Beaupré', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(163, 11, 'Bécancour', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(164, 11, 'Bedford', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(165, 11, 'Belleterre', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(166, 11, 'Beloeil', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(167, 11, 'Berthierville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(168, 11, 'Blainville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(169, 11, 'Boisbriand', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(170, 11, 'Bois-des-Filion', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(171, 11, 'Bonaventure', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(172, 11, 'Boucherville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(173, 11, 'Brome Lake', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(174, 11, 'Bromont', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(175, 11, 'Brossard', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(176, 11, 'Brownsburg-Chatham', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:42:55', NULL),
(177, 11, 'Candiac', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(178, 11, 'Cap-Chat', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(179, 11, 'Cap-Santé', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(180, 11, 'Carignan', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(181, 11, 'Carleton-sur-Mer', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(182, 11, 'Causapscal', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(183, 11, 'Chambly', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(184, 11, 'Chandler', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(185, 11, 'Chapais', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(186, 11, 'Charlemagne', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(187, 11, 'Châteauguay', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(188, 11, 'Château-Richer', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(189, 11, 'Chibougamau', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(190, 11, 'Clermont', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(191, 11, 'Coaticook', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(192, 11, 'Contrecoeur', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(193, 11, 'Cookshire-Eaton', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(194, 11, 'Côte Saint-Luc', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(195, 11, 'Coteau-du-Lac', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(196, 11, 'Cowansville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:19', NULL),
(197, 11, 'Danville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(198, 11, 'Daveluyville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(199, 11, 'Dégelis', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(200, 11, 'Delson', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(201, 11, 'Desbiens', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(202, 11, 'Deux-Montagnes', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(203, 11, 'Disraeli', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(204, 11, 'Dolbeau-Mistassini', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(205, 11, 'Dollard-des-Ormeaux', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(206, 11, 'Donnacona', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(207, 11, 'Dorval', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:43:57', NULL),
(208, 11, 'Drummondville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(209, 11, 'Duparquet', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(210, 11, 'East Angus', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(211, 11, 'Estérel', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(212, 11, 'Farnham', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(213, 11, 'Fermont', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(214, 11, 'Forestville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(215, 11, 'Fossambault-sur-le-Lac', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(216, 11, 'Gaspé', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(217, 11, 'Gatineau', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(218, 11, 'Gracefield', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(219, 11, 'Granby', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(220, 11, 'Grande-Rivière', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(221, 11, 'Hampstead', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(222, 11, 'Hudson', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(223, 11, 'Huntingdon', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(224, 11, 'Joliette', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(225, 11, 'Kingsey Falls', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(226, 11, 'Kirkland', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:26', NULL),
(227, 11, 'La Malbaie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(228, 11, 'La Pocatière', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(229, 11, 'La Prairie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(230, 11, 'La Sarre', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(231, 11, 'La Tuque', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(232, 11, 'Lac-Delage', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(233, 11, 'Lachute', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(234, 11, 'Lac-Mégantic', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(235, 11, 'Lac-Saint-Joseph', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(236, 11, 'Lac-Sergent', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(237, 11, 'L\'Ancienne-Lorette', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(238, 11, 'L\'Assomption', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(239, 11, 'Laval', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(240, 11, 'Lavaltrie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(241, 11, 'Lebel-sur-Quévillon', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(242, 11, 'L\'Épiphanie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(243, 11, 'Léry', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(244, 11, 'Lévis', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(245, 11, 'L\'Île-Cadieux', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(246, 11, 'L\'Île-Dorval', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(247, 11, 'L\'Île-Perrot', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(248, 11, 'Longueuil', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(249, 11, 'Lorraine', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(250, 11, 'Louiseville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:44:48', NULL),
(251, 11, 'Macamic', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(252, 11, 'Magog', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(253, 11, 'Malartic', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(254, 11, 'Maniwaki', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(255, 11, 'Marieville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(256, 11, 'Mascouche', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(257, 11, 'Matagami', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(258, 11, 'Matane', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(259, 11, 'Mercier', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(260, 11, 'Métabetchouan–Lac-à-la-Croix', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(261, 11, 'Métis-sur-Mer', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(262, 11, 'Mirabel', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(263, 11, 'Mont-Joli', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(264, 11, 'Mont-Laurier', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(265, 11, 'Montmagny', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(266, 11, 'Montreal', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(267, 11, 'Montreal West', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(268, 11, 'Montréal-Est', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(269, 11, 'Mont-Saint-Hilaire', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(270, 11, 'Mont-Tremblant', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(271, 11, 'Mount Royal', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(272, 11, 'Murdochville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(273, 11, 'Neuville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(274, 11, 'New Richmond', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(275, 11, 'Nicolet', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(276, 11, 'Normandin', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(277, 11, 'Notre-Dame-de-l\'Île-Perrot', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(278, 11, 'Notre-Dame-des-Prairies', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:03', NULL),
(279, 11, 'Otterburn Park', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(280, 11, 'Paspébiac', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(281, 11, 'Percé', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(282, 11, 'Pincourt', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(283, 11, 'Plessisville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(284, 11, 'Pohénégamook', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(285, 11, 'Pointe-Claire', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(286, 11, 'Pont-Rouge', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(287, 11, 'Port-Cartier', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(288, 11, 'Portneuf', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(289, 11, 'Prévost', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(290, 11, 'Princeville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(291, 11, 'Québec', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(292, 11, 'Repentigny', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(293, 11, 'Richelieu', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(294, 11, 'Richmond', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(295, 11, 'Rimouski', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(296, 11, 'Rivière-du-Loup', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(297, 11, 'Rivière-Rouge', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(298, 11, 'Roberval', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(299, 11, 'Rosemère', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(300, 11, 'Rouyn-Noranda', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(301, 11, 'Saguenay', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(302, 11, 'Saint-Augustin-de-Desmaures', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(303, 11, 'Saint-Basile', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(304, 11, 'Saint-Basile-le-Grand', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(305, 11, 'Saint-Bruno-de-Montarville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(306, 11, 'Saint-Césaire', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(307, 11, 'Saint-Colomban', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(308, 11, 'Saint-Constant', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(309, 11, 'Sainte-Adèle', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(310, 11, 'Sainte-Agathe-des-Monts', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(311, 11, 'Sainte-Anne-de-Beaupré', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(312, 11, 'Sainte-Anne-de-Bellevue', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(313, 11, 'Sainte-Anne-des-Monts', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(314, 11, 'Sainte-Anne-des-Plaines', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(315, 11, 'Sainte-Catherine', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(316, 11, 'Sainte-Catherine-de-la-Jacques-Cartier', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(317, 11, 'Sainte-Julie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(318, 11, 'Sainte-Marguerite-du-Lac-Masson', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(319, 11, 'Sainte-Marie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(320, 11, 'Sainte-Marthe-sur-le-Lac', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(321, 11, 'Sainte-Thérèse', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(322, 11, 'Saint-Eustache', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(323, 11, 'Saint-Félicien', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(324, 11, 'Saint-Gabriel', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(325, 11, 'Saint-Georges', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(326, 11, 'Saint-Hyacinthe', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(327, 11, 'Saint-Jean-sur-Richelieu', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(328, 11, 'Saint-Jérôme', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(329, 11, 'Saint-Joseph-de-Beauce', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(330, 11, 'Saint-Joseph-de-Sorel', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(331, 11, 'Saint-Lambert', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(332, 11, 'Saint-Lazare', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(333, 11, 'Saint-Lin-Laurentides', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(334, 11, 'Saint-Marc-des-Carrières', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(335, 11, 'Saint-Ours', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(336, 11, 'Saint-Pamphile', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(337, 11, 'Saint-Pascal', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(338, 11, 'Saint-Pie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(339, 11, 'Saint-Raymond', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(340, 11, 'Saint-Rémi', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(341, 11, 'Saint-Sauveur', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(342, 11, 'Saint-Tite', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(343, 11, 'Salaberry-de-Valleyfield', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(344, 11, 'Schefferville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(345, 11, 'Scotstown', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(346, 11, 'Senneterre', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(347, 11, 'Sept-Îles', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(348, 11, 'Shawinigan', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(349, 11, 'Sherbrooke', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(350, 11, 'Sorel-Tracy', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(351, 11, 'Stanstead', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(352, 11, 'Sutton', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(353, 11, 'Témiscaming', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(354, 11, 'Témiscouata-sur-le-Lac', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(355, 11, 'Terrebonne', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(356, 11, 'Thetford Mines', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(357, 11, 'Thurso', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(358, 11, 'Trois-Pistoles', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(359, 11, 'Trois-Rivières', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(360, 11, 'Valcourt', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(361, 11, 'Val-d\'Or', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(362, 11, 'Varennes', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(363, 11, 'Vaudreuil-Dorion', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(364, 11, 'Victoriaville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(365, 11, 'Ville-Marie', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(366, 11, 'Warwick', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(367, 11, 'Waterloo', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(368, 11, 'Waterville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(369, 11, 'Westmount', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(370, 11, 'Windsor', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:46:29', NULL),
(371, 12, 'Estevan', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(372, 12, 'Flin FlonFlin Flon', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(373, 12, 'Humboldt', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(374, 12, 'LloydminsterLloydminster', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(375, 12, 'Martensville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(376, 12, 'Meadow Lake', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(377, 12, 'Melfort', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(378, 12, 'Melville', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(379, 12, 'Moose Jaw', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(380, 12, 'North Battleford', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(381, 12, 'Prince Albert', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(382, 12, 'Regina', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(383, 12, 'Saskatoon', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(384, 12, 'Swift Current', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(385, 12, 'Warman', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(386, 12, 'Weyburn', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(387, 12, 'Yorkton', '1', '2017-11-22 16:30:00', 1, '2017-11-22 11:49:08', NULL),
(388, 13, 'whitehorse', '1', '2017-11-22 19:00:00', 1, '2017-11-22 12:53:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_activity_feedbacks`
--

CREATE TABLE `client_activity_feedbacks` (
  `id` int(11) NOT NULL,
  `invitation_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `feedback` enum('0','1') NOT NULL COMMENT '0: Not helpful, 1: Helpful',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To capture the client feedback on every activity' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `client_activity_feedbacks`
--

INSERT INTO `client_activity_feedbacks` (`id`, `invitation_id`, `client_id`, `activity_id`, `feedback`, `created_at`) VALUES
(1, 3, 1, 4, '1', '2018-01-24 12:20:41'),
(2, 3, 1, 2, '1', '2018-01-23 11:19:54'),
(3, 3, 1, 3, '1', '2018-01-24 12:20:37'),
(4, 3, 1, 6, '1', '2018-01-24 12:21:12'),
(5, 3, 1, 7, '1', '2018-01-24 12:21:16'),
(6, 3, 1, 5, '1', '2018-01-24 12:21:08'),
(7, 3, 1, 8, '1', '2018-01-24 12:20:48'),
(8, 3, 1, 9, '1', '2018-01-24 12:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `client_activity_lists`
--

CREATE TABLE `client_activity_lists` (
  `id` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `image_name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `listing_event` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0: No, 1: Yes; Only listing events will be shown in listing',
  `activity_class` varchar(50) DEFAULT NULL COMMENT 'Used to put the js event listener into the code',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To hold the activities list to be performed by the client' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `client_activity_lists`
--

INSERT INTO `client_activity_lists` (`id`, `activity`, `image_name`, `description`, `status`, `listing_event`, `activity_class`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'login', NULL, 'login', '1', '0', NULL, '2017-11-29 12:00:00', 1, '2017-11-29 07:06:23', NULL),
(2, 'forward mail', 'forward_email.png', 'forward mail', '1', '1', 'forward_mail', '2017-11-29 12:00:00', 1, '2017-12-01 13:45:41', NULL),
(3, 'Mailbox Keys', 'update_address.png', 'Mailbox Keys', '1', '1', 'mailbox_keys', '2017-11-29 12:00:00', 1, '2017-12-04 12:41:34', NULL),
(4, 'Update Address', 'update_address.png', 'Update Address', '1', '1', 'update_address', '2017-11-29 12:00:00', 1, '2017-12-04 12:39:33', NULL),
(5, 'Connect Utilities', 'connect_utilities.png', 'Connect Utilities', '1', '1', 'connect_utilities', '2017-11-29 12:00:00', 1, '2017-12-04 12:37:26', NULL),
(6, 'Cable & Internet Service', NULL, 'Cable & Internet Service', '1', '1', 'cable_internet_services', '2017-11-29 12:00:00', 1, '2017-12-04 12:41:50', NULL),
(7, 'Home Cleaning Service', 'hire_mover.png', 'Home Cleaning Service', '1', '1', 'home_cleaning_services', '2017-11-29 12:00:00', 1, '2017-12-04 12:42:03', NULL),
(8, 'Moving Companies', 'home_services.png', 'Moving Companies', '1', '1', 'moving_companies', '2017-11-29 12:00:00', 1, '2017-12-04 12:42:16', NULL),
(9, 'Tech Concierge', NULL, 'Tech Concierge', '1', '1', 'tech_concierge', '2017-11-29 12:00:00', 1, '2017-12-04 12:42:32', NULL),
(10, 'share announcement', 'share_announcement.png', 'share announcement', '1', '1', 'share_announcement', '2017-11-30 11:00:00', 1, '2017-11-30 06:50:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_activity_logs`
--

CREATE TABLE `client_activity_logs` (
  `id` int(11) NOT NULL,
  `invitation_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `action` enum('0','1') NOT NULL COMMENT '0: discard, 1: done',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To hold the activities performed by clients  ';

--
-- Dumping data for table `client_activity_logs`
--

INSERT INTO `client_activity_logs` (`id`, `invitation_id`, `client_id`, `activity_id`, `action`, `updated_at`) VALUES
(1, 3, 1, 1, '1', '2018-01-24 11:01:37');

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
(4, 'about us', 'aboutus', '1', '2017-11-24 07:20:45', 1, '2017-11-17 09:21:36', NULL);

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
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_navigation_cms_navigation_category`
--

INSERT INTO `cms_navigation_cms_navigation_category` (`cms_navigation_category_id`, `cms_navigation_id`, `status`) VALUES
(1, 4, '0');

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
  `company_category_id` int(10) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `province_id` int(10) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `target_area` int(11) DEFAULT NULL COMMENT 'Radius in which company is working in KM',
  `working_globally` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Local Company, 1: Global Company',
  `availability_mode` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'If available can receive the quotations, otherwise not',
  `facebook` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_plus` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_category_id`, `email`, `contact_number`, `fax`, `website`, `address1`, `address2`, `province_id`, `city_id`, `postal_code`, `country_id`, `target_area`, `working_globally`, `availability_mode`, `facebook`, `google_plus`, `instagram`, `linkedin`, `skype`, `twitter`, `image`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 'abc company', 2, '', '', '', '', 'Sea side, 122 street', NULL, 11, 179, 'RTR 301', 1, NULL, '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'Asdfgh.png', '1', '2017-11-15 07:45:30', 1, '2017-12-01 06:24:15', 1),
(5, 'Trans movers', 1, '', '', '', '', NULL, NULL, 2, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-12-12 09:02:11', 18, '2017-12-20 11:59:21', NULL),
(6, 'aman electrical works', 1, '', '', '', '', NULL, NULL, 6, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-12-12 09:04:31', 19, '2017-12-20 11:59:25', NULL),
(7, 'united packers and movers', 3, 'works@united.com', '9876543210', '6549876', 'http://unitedpackers.com', '124-350 Columbia St W', '', 9, 367, 'N2L 6P3', 1, NULL, '1', '1', 'https://www.facebook.com/', 'https://www.googleplus/', 'https://www.instagram.com/', 'https://www.linkedin.com/', 'https://www.skype.com/', 'https://www.twitter.com/', '3aAtlo0HGs.jpg', '1', '2017-12-12 09:08:53', 20, '2017-12-22 05:11:31', 20),
(8, 'Alex Movers', 3, NULL, NULL, NULL, NULL, '1-550 Lisgar St', '', 9, 124, 'K1R 5H5', 1, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-12-20 12:11:46', 21, '2017-12-20 13:22:34', 21),
(9, 'Alex tech solutions', 5, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-01-02 06:27:14', 22, '2018-01-02 07:33:56', 22),
(10, 'reck digital services', 4, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-01-05 07:20:50', 23, '2018-01-05 07:24:53', 23),
(11, 'tom home cleaning services', 2, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-01-08 14:07:16', 24, '2018-01-08 14:08:53', 24);

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
(1, 'Real Estate Company', '1', '2017-12-12 11:00:00', 1, '2017-12-12 07:25:08', NULL),
(2, 'Home Cleaning Service Company', '1', '2017-12-12 11:00:00', 1, '2018-01-08 09:47:04', NULL),
(3, 'Moving Company', '1', '2017-12-12 11:00:00', 1, '2017-12-12 06:53:52', NULL),
(4, 'Internet & Cable Service provider', '1', '2017-12-12 11:00:00', 1, '2017-12-12 06:53:52', NULL),
(5, 'Tech Concierge', '1', '2017-12-12 11:00:00', 1, '2017-12-12 06:53:52', NULL),
(6, 'Utility Company', '1', '2017-12-12 11:00:00', 1, '2017-12-12 06:53:52', NULL);

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
(1, 9),
(2, 6),
(2, 8),
(3, 9),
(5, 18),
(6, 19),
(7, 20),
(8, 21),
(9, 22),
(10, 23),
(11, 24);

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
-- Table structure for table `digital_additional_services`
--

CREATE TABLE `digital_additional_services` (
  `id` int(11) NOT NULL,
  `additional_service` varchar(200) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `digital_additional_services`
--

INSERT INTO `digital_additional_services` (`id`, `additional_service`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'I would like to buy my equipment', '1', '2018-01-04 18:25:00', 1, '2018-01-04 12:56:33', NULL),
(2, 'I would like a special offer or promotion', '1', '2018-01-04 18:25:00', 1, '2018-01-04 12:56:33', NULL),
(3, 'I like to book a tech today', '1', '2018-01-04 18:25:00', 1, '2018-01-04 12:56:33', NULL),
(4, 'I like to get special promotion emails', '1', '2018-01-04 18:25:00', 1, '2018-01-04 12:56:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `digital_additional_service_type_requests`
--

CREATE TABLE `digital_additional_service_type_requests` (
  `id` int(10) NOT NULL,
  `digital_service_request_id` int(10) NOT NULL,
  `digital_additional_service_type_id` int(10) NOT NULL,
  `service_hours` tinyint(4) DEFAULT NULL,
  `amount` tinyint(4) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `digital_additional_service_type_requests`
--

INSERT INTO `digital_additional_service_type_requests` (`id`, `digital_service_request_id`, `digital_additional_service_type_id`, `service_hours`, `amount`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, NULL, NULL, '1', '2018-01-23 11:24:08', 1, '2018-01-23 05:54:08', NULL),
(2, 1, 2, NULL, NULL, '1', '2018-01-23 11:24:08', 1, '2018-01-23 05:54:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `digital_service_requests`
--

CREATE TABLE `digital_service_requests` (
  `id` int(10) NOT NULL,
  `agent_client_id` int(10) NOT NULL,
  `invitation_id` int(10) NOT NULL,
  `digital_service_company_id` int(10) NOT NULL,
  `moving_from_house_type` varchar(20) NOT NULL,
  `moving_from_floor` varchar(20) NOT NULL,
  `moving_from_bedroom_count` varchar(20) NOT NULL,
  `moving_from_property_type` varchar(20) NOT NULL,
  `moving_to_house_type` varchar(20) NOT NULL,
  `moving_to_floor` varchar(20) NOT NULL,
  `moving_to_bedroom_count` varchar(20) NOT NULL,
  `moving_to_property_type` varchar(20) NOT NULL,
  `have_cable_internet_already` enum('0','1') DEFAULT NULL COMMENT '0: No, 1: Yes',
  `employment_status` enum('0','1','2') DEFAULT NULL COMMENT '0: Unemployed, 1: Employed, 2: Self Employed',
  `want_to_receive_electronic_bill` enum('0','1') DEFAULT NULL COMMENT '0: No, 1: Yes',
  `want_to_contract_plan` enum('0','1') DEFAULT NULL COMMENT '0: No, 1: Yes',
  `want_to_setup_preauthorise_payment` enum('0','1') DEFAULT NULL COMMENT '0: No, 1: Yes',
  `callback_option` enum('0','1') DEFAULT NULL COMMENT '0: No, 1: Yes',
  `callback_time` enum('0','1','2') DEFAULT NULL COMMENT '0: Anytime, 1: Daytime, 2: Evening',
  `primary_no` varchar(20) DEFAULT NULL,
  `secondary_no` varchar(20) DEFAULT NULL,
  `additional_information` text,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `digital_service_requests`
--

INSERT INTO `digital_service_requests` (`id`, `agent_client_id`, `invitation_id`, `digital_service_company_id`, `moving_from_house_type`, `moving_from_floor`, `moving_from_bedroom_count`, `moving_from_property_type`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `have_cable_internet_already`, `employment_status`, `want_to_receive_electronic_bill`, `want_to_contract_plan`, `want_to_setup_preauthorise_payment`, `callback_option`, `callback_time`, `primary_no`, `secondary_no`, `additional_information`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 3, 10, 'house', '1', '1', 'own', 'apartment/flat', '2', '2', 'rent', '1', '1', '1', '1', '1', '1', '0', '9632587410', '9876543210', 'testing purpose', '1', '2018-01-23 11:24:07', 1, '2018-01-23 05:54:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `digital_service_types`
--

CREATE TABLE `digital_service_types` (
  `id` int(10) NOT NULL,
  `service` varchar(50) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `digital_service_types`
--

INSERT INTO `digital_service_types` (`id`, `service`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'TV', '1', '2018-01-04 15:00:00', 1, '2018-01-04 09:39:52', NULL),
(2, 'Internet', '1', '2018-01-04 15:00:00', 1, '2018-01-04 09:39:52', NULL),
(3, 'Phone', '1', '2018-01-04 15:00:00', 1, '2018-01-04 09:39:52', NULL),
(4, 'Fax', '1', '2018-01-04 15:00:00', 1, '2018-01-04 09:39:52', NULL),
(5, 'Security system	', '1', '2018-01-04 15:00:00', 1, '2018-01-04 11:54:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `digital_service_type_requests`
--

CREATE TABLE `digital_service_type_requests` (
  `id` int(10) NOT NULL,
  `digital_service_request_id` int(10) NOT NULL,
  `digital_service_type_id` int(10) NOT NULL,
  `service_hours` tinyint(4) DEFAULT NULL,
  `amount` tinyint(4) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `digital_service_type_requests`
--

INSERT INTO `digital_service_type_requests` (`id`, `digital_service_request_id`, `digital_service_type_id`, `service_hours`, `amount`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, 100, '1', '2018-01-23 11:24:08', 1, '2018-01-23 06:26:04', 23),
(2, 1, 2, 1, 100, '1', '2018-01-23 11:24:08', 1, '2018-01-23 06:26:04', 23),
(3, 1, 4, 1, 100, '1', '2018-01-23 11:24:08', 1, '2018-01-23 06:26:04', 23);

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
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `template_name` varchar(50) NOT NULL,
  `template_content` text NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `category_id`, `template_name`, `template_content`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 0, 'template 1', '<table style=\"text-align: center;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 100%; text-align: justify;\">[content]</td>\r\n</tr>\r\n</tbody>\r\n</table>', '1', '2017-11-22 15:06:35', 1, '2017-11-28 09:57:07', 9),
(2, 0, 'template 2', '<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ff0066;\" align=\"center\" valign=\"top\" bgcolor=\"#ff0066;\">\r\n<table border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #000000;\" align=\"left\" valign=\"top\" bgcolor=\"#000000\" width=\"20\">&nbsp;</td>\r\n<td style=\"background-color: #000000; color: #7b7b7b; font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" align=\"center\" valign=\"top\" bgcolor=\"#000000\"><br /> <br /> <br />\r\n<div style=\"color: #ff0066; font-family: Georgia, Times New Roman, Times, serif; font-size: 24px;\">COMPANY NAME<br /> cordially invites you to attend</div>\r\n<div style=\"color: #ff0066; font-family: Georgia, Times New Roman, Times, serif; font-size: 24px;\"><img src=\"data:image/gif;base64,R0lGODlhdQCjAOYAAPz8/AMDA/n5+QYGBgkJCfb29vDw8O3t7QwMDBISEo2NjVpaWjw8PA8PD0tLSxsbG+rq6paWlszMzJOTk/Pz8xgYGM/Pz29vb3h4eLe3txUVFTY2Nh4eHjAwMIeHh8bGxrS0tK6uri0tLdvb21dXV+Hh4cPDwyQkJHJycioqKsnJyd7e3uTk5GZmZtXV1Tk5OaWlpU5OTqioqCcnJ5+fn6KioiEhIYSEhEVFRcDAwFFRUUJCQr29vUhISJmZmXt7e2BgYLGxsYGBgdLS0ufn52xsbJycnNjY2F1dXbq6uj8/PzMzM2lpaVRUVGNjY5CQkKurq3V1dX5+foqKiv///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNC4yLjItYzA2MyA1My4zNTI2MjQsIDIwMDgvMDcvMzAtMTg6MTI6MTggICAgICAgICI+CiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiCiAgICB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iCiAgICB4bWxuczp4bXBSaWdodHM9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9yaWdodHMvIgogICAgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIgogICAgeG1sbnM6SXB0YzR4bXBDb3JlPSJodHRwOi8vaXB0Yy5vcmcvc3RkL0lwdGM0eG1wQ29yZS8xLjAveG1sbnMvIgogICB4bXBSaWdodHM6TWFya2VkPSJGYWxzZSIKICAgeG1wUmlnaHRzOldlYlN0YXRlbWVudD0iIgogICBwaG90b3Nob3A6QXV0aG9yc1Bvc2l0aW9uPSIiPgogICA8ZGM6cmlnaHRzPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICA8L3JkZjpBbHQ+CiAgIDwvZGM6cmlnaHRzPgogICA8ZGM6Y3JlYXRvcj4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkvPgogICAgPC9yZGY6U2VxPgogICA8L2RjOmNyZWF0b3I+CiAgIDxkYzp0aXRsZT4KICAgIDxyZGY6QWx0PgogICAgIDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCIvPgogICAgPC9yZGY6QWx0PgogICA8L2RjOnRpdGxlPgogICA8eG1wUmlnaHRzOlVzYWdlVGVybXM+CiAgICA8cmRmOkFsdD4KICAgICA8cmRmOmxpIHhtbDpsYW5nPSJ4LWRlZmF1bHQiLz4KICAgIDwvcmRmOkFsdD4KICAgPC94bXBSaWdodHM6VXNhZ2VUZXJtcz4KICAgPElwdGM0eG1wQ29yZTpDcmVhdG9yQ29udGFjdEluZm8KICAgIElwdGM0eG1wQ29yZTpDaUFkckV4dGFkcj0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyQ2l0eT0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyUmVnaW9uPSIiCiAgICBJcHRjNHhtcENvcmU6Q2lBZHJQY29kZT0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyQ3RyeT0iIgogICAgSXB0YzR4bXBDb3JlOkNpVGVsV29yaz0iIgogICAgSXB0YzR4bXBDb3JlOkNpRW1haWxXb3JrPSIiCiAgICBJcHRjNHhtcENvcmU6Q2lVcmxXb3JrPSIiLz4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg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\" alt=\"\" width=\"117\" height=\"163\" /></div>\r\n<br /> <br />\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"middle\"><img src=\"images/divider.gif\" alt=\"\" width=\"544\" height=\"5\" /></td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\" valign=\"middle\" height=\"65\">\r\n<div style=\"color: #ffffff; font-size: 28px; font-family: Arial, Helvetica, sans-serif;\">ANNUAL COMPANY EVENT</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\" valign=\"middle\"><img src=\"images/divider.gif\" alt=\"\" width=\"544\" height=\"5\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<br /> <br />\r\n<div style=\"color: #7b7b7b; font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n[Content]<br /> </td>\r\n<td style=\"background-color: #000000;\" align=\"left\" valign=\"top\" bgcolor=\"#000000\" width=\"20\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '1', '2017-11-23 15:38:34', 1, '2017-12-20 06:32:44', 9),
(3, 1, 'template 3', '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<!-- PARENT DIV -->\r\n<div style=\"box-shadow: 0px 5px 5px #ccc; margin: 0 auto; width: 650px;\"><!-- MAIN TABLE -->\r\n<table border=\"0\" width=\"650\" align=\"center\">\r\n<tbody>\r\n<tr style=\"text-align: center;\">\r\n<td><img src=\"banner.jpg\" alt=\"\" /></td>\r\n</tr>\r\n</tbody>\r\n<tbody>\r\n<tr align=\"center\">\r\n<td><img src=\"data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjgxNzhGMzgyRUZCMzExRTdCMkQ1RjRERTNEQzAwOTIyIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjgxNzhGMzgzRUZCMzExRTdCMkQ1RjRERTNEQzAwOTIyIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODE3OEYzODBFRkIzMTFFN0IyRDVGNERFM0RDMDA5MjIiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6ODE3OEYzODFFRkIzMTFFN0IyRDVGNERFM0RDMDA5MjIiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYG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\" alt=\"\" width=\"648\" height=\"197\" /></td>\r\n</tr>\r\n</tbody>\r\n<tbody>\r\n<tr><!-- CONTENT TABLE - 1 --></tr>\r\n</tbody>\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: justify; font-size: 16px; padding: 0px 20px;\">&nbsp;[TEMPLATE_CONTENT]</td>\r\n</tr>\r\n</tbody>\r\n<!-- CONTENT TABLE - 1 END -->\r\n<tbody>\r\n<tr><!-- CONTENT TABLE - 2 --></tr>\r\n</tbody>\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: justify; font-size: 16px; padding: 0px 20px;\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n<!-- CONTENT TABLE - 2 END -->\r\n<tbody>\r\n<tr><!-- BUTTON --></tr>\r\n</tbody>\r\n<!-- BUTTON END --></table>\r\n<!-- MAIN TABLE END --></div>', '1', '2018-01-05 14:27:35', 1, '2018-01-05 08:58:19', 1);
INSERT INTO `email_templates` (`id`, `category_id`, `template_name`, `template_content`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(4, 1, 'template 4', '<p><img src=\"data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjgxNzhGMzgyRUZCMzExRTdCMkQ1RjRERTNEQzAwOTIyIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjgxNzhGMzgzRUZCMzExRTdCMkQ1RjRERTNEQzAwOTIyIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODE3OEYzODBFRkIzMTFFN0IyRDVGNERFM0RDMDA5MjIiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6ODE3OEYzODFFRkIzMTFFN0IyRDVGNERFM0RDMDA5MjIiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYG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\" alt=\"\" width=\"648\" height=\"197\" /></p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '1', '2018-01-05 17:15:22', 1, '2018-01-05 11:45:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_template_categories`
--

CREATE TABLE `email_template_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template_categories`
--

INSERT INTO `email_template_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Invite', 1, '2018-01-03 03:35:07', '2018-01-03 03:35:07'),
(2, 'Birthday', 1, '2018-01-03 03:35:07', '2018-01-03 03:35:07'),
(3, 'Notices', 1, '2018-01-03 03:35:42', '2018-01-03 03:35:42'),
(4, 'Promotion', 1, '2018-01-03 03:35:42', '2018-01-03 03:35:42'),
(5, 'Special Greeting', 1, '2018-01-03 03:35:50', '2018-01-03 03:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `email_template_user`
--

CREATE TABLE `email_template_user` (
  `user_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `email_template_user`
--

INSERT INTO `email_template_user` (`user_id`, `email_template_id`) VALUES
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forgot_passwords`
--

CREATE TABLE `forgot_passwords` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `hash` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=>request, 1=>success',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_additional_services`
--

CREATE TABLE `home_cleaning_additional_services` (
  `id` int(11) NOT NULL,
  `additional_service` text NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_cleaning_additional_services`
--

INSERT INTO `home_cleaning_additional_services` (`id`, `additional_service`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Oven inside cleaned?', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:53:35', NULL),
(2, 'Fridge inside cleaned?', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:53:35', NULL),
(3, 'How many balconies would you like to have swept?', '1', '2018-01-08 12:00:00', 1, '2018-01-12 09:41:52', NULL),
(4, 'How many windows (interior) would you like to have washed?', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:53:35', NULL),
(5, 'How many windows (exterior) would you like to have washed?', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:53:35', NULL),
(6, 'Would you like wet wiping blinds? How many?', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:53:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_additional_service_requests`
--

CREATE TABLE `home_cleaning_additional_service_requests` (
  `id` int(10) NOT NULL,
  `service_request_id` int(10) NOT NULL,
  `additional_request_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `hour_to_complete` decimal(10,2) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_cleaning_additional_service_requests`
--

INSERT INTO `home_cleaning_additional_service_requests` (`id`, `service_request_id`, `additional_request_id`, `quantity`, `amount`, `hour_to_complete`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(2, 1, 2, 1, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(3, 1, 3, 1, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(4, 1, 4, 1, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_other_places`
--

CREATE TABLE `home_cleaning_other_places` (
  `id` int(10) NOT NULL,
  `other_places` varchar(50) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_cleaning_other_places`
--

INSERT INTO `home_cleaning_other_places` (`id`, `other_places`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'kitchen', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(2, 'living room', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(3, 'dining room', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(4, 'stair case', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(5, 'office room', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(6, 'hall way', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(7, 'interior', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(8, 'staircase', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(9, 'recreation room', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(10, 'den', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(11, 'laundry', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_other_place_service_requests`
--

CREATE TABLE `home_cleaning_other_place_service_requests` (
  `id` int(10) NOT NULL,
  `service_request_id` int(10) NOT NULL,
  `other_place_id` int(10) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `hour_to_complete` decimal(10,2) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_cleaning_other_place_service_requests`
--

INSERT INTO `home_cleaning_other_place_service_requests` (`id`, `service_request_id`, `other_place_id`, `amount`, `hour_to_complete`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(2, 1, 3, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(3, 1, 5, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(4, 1, 7, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(5, 1, 9, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(6, 1, 11, '50.00', '1.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_service_requests`
--

CREATE TABLE `home_cleaning_service_requests` (
  `id` int(11) NOT NULL,
  `agent_client_id` int(10) NOT NULL,
  `invitation_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `move_out_cleaning` enum('0','1') NOT NULL,
  `moving_from_house_type` varchar(20) NOT NULL,
  `moving_from_floor` varchar(20) NOT NULL,
  `moving_from_bedroom_count` varchar(20) NOT NULL,
  `moving_from_property_type` varchar(20) NOT NULL,
  `move_in_cleaning` enum('0','1') NOT NULL,
  `moving_to_house_type` varchar(20) NOT NULL,
  `moving_to_floor` varchar(20) NOT NULL,
  `moving_to_bedroom_count` varchar(20) NOT NULL,
  `moving_to_property_type` varchar(20) NOT NULL,
  `home_condition` varchar(20) NOT NULL,
  `home_cleaning_level` varchar(20) NOT NULL,
  `home_cleaning_area` varchar(20) NOT NULL,
  `home_cleaning_people_count` varchar(20) NOT NULL,
  `home_cleaning_pet_count` varchar(20) NOT NULL,
  `home_cleaning_bathroom_count` varchar(20) NOT NULL,
  `cleaning_behind_refrigerator_and_stove` enum('0','1') NOT NULL,
  `baseboard_to_be_washed` enum('0','1') NOT NULL,
  `primary_no` varchar(20) NOT NULL,
  `secondary_no` varchar(20) NOT NULL,
  `additional_information` text NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_cleaning_service_requests`
--

INSERT INTO `home_cleaning_service_requests` (`id`, `agent_client_id`, `invitation_id`, `company_id`, `move_out_cleaning`, `moving_from_house_type`, `moving_from_floor`, `moving_from_bedroom_count`, `moving_from_property_type`, `move_in_cleaning`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `home_condition`, `home_cleaning_level`, `home_cleaning_area`, `home_cleaning_people_count`, `home_cleaning_pet_count`, `home_cleaning_bathroom_count`, `cleaning_behind_refrigerator_and_stove`, `baseboard_to_be_washed`, `primary_no`, `secondary_no`, `additional_information`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 3, 11, '1', 'house', '1', '1', 'own', '1', 'apartment/flat', '2', '2', 'rent', 'dirty', '1', '0-600', '1', '1', '1', '1', '1', '963258741', '9632587410', 'testing purpose', '1', '2018-01-23 11:29:17', 1, '2018-01-23 05:59:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_steaming_services`
--

CREATE TABLE `home_cleaning_steaming_services` (
  `id` int(10) NOT NULL,
  `steaming_service_for` varchar(50) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_cleaning_steaming_services`
--

INSERT INTO `home_cleaning_steaming_services` (`id`, `steaming_service_for`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'rooms', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:23:28', NULL),
(2, 'stair case', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:23:28', NULL),
(3, 'hall way', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:23:28', NULL),
(4, 'living room', '1', '2018-01-08 12:00:00', 1, '2018-01-08 06:23:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_steaming_service_requests`
--

CREATE TABLE `home_cleaning_steaming_service_requests` (
  `id` int(10) NOT NULL,
  `service_request_id` int(10) NOT NULL,
  `steaming_service_id` int(10) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `hour_to_complete` decimal(10,2) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `home_cleaning_steaming_service_requests`
--

INSERT INTO `home_cleaning_steaming_service_requests` (`id`, `service_request_id`, `steaming_service_id`, `amount`, `hour_to_complete`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, '1.00', '50.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(2, 1, 3, '1.00', '50.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL),
(3, 1, 4, '1.00', '50.00', '1', '2018-01-23 11:29:17', 1, '2018-01-23 06:47:30', NULL);

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
(1, 9, '2018-01-25 11:48:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL COMMENT 'Agent id to associate the message with the agent',
  `message` text NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `agent_id`, `message`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 9, 'Hello [User Name],\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', '2017-11-20 12:00:00', 9, '2017-11-27 06:38:11', 9);

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
-- Table structure for table `moving_item_categories`
--

CREATE TABLE `moving_item_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moving_item_categories`
--

INSERT INTO `moving_item_categories` (`id`, `item_name`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Living Room', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(2, 'Dining Room', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(3, 'Bedroom(s)', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(4, 'Nursery', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(5, 'Kitchen', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(6, 'Appliances', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(7, 'Electronics', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(8, 'Patio', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(9, 'Miscellaneous', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(10, 'Containers', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moving_item_details`
--

CREATE TABLE `moving_item_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `moving_item_category_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_weight` varchar(50) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_item_details`
--

INSERT INTO `moving_item_details` (`id`, `moving_item_category_id`, `item_name`, `item_weight`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Piano', '600 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(2, 1, 'Bookcase', '120 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(3, 1, 'Bookshelf', '70 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(4, 1, 'Small Bookshelf', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(5, 1, 'Chair - Arm', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(6, 1, 'Chair - Overstuffed', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(7, 1, 'Chair - Rocker', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(8, 1, 'Aquarium', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(9, 1, 'Desk + Chair (sm)', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(10, 1, 'Desk + Chair (lg)', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(11, 1, 'Fireplace Equipment', '35 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(12, 1, 'Fireplace', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(13, 1, 'Lamp - Floor', '15 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(14, 1, 'Footstool', '35 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(15, 1, 'Mirror', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(16, 1, 'Clock - Grandfather', '160 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(17, 1, 'Rug or Pad (sm)', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(18, 1, 'Rug or Pad (lg)', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(19, 1, 'Sofa - Loveseat', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(20, 1, 'Sofa - 3 Cushion', '250 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(21, 1, 'Sofa - Hidabed', '300 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(22, 1, 'Tables - Sofa', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(23, 1, 'Tables - End', '35 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(24, 1, 'Tables - Coffee', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(25, 2, 'Buffet', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(26, 2, 'Cabinet - China 1 pc', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(27, 2, 'Cabinet - Corner', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(28, 2, 'Chair - Arm', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(29, 2, 'Chair - Straight', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(30, 2, 'Hutch (top)', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(31, 2, 'Server / Tea Cart', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(32, 2, 'Table - Dining', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(33, 2, 'Table - Extension', '175 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(34, 3, 'King Bed', '400 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(35, 3, 'Captain Bed', '400 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(36, 3, 'Queen Bed', '350 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(37, 3, 'Double Bed', '325 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(38, 3, 'Single Bed', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(39, 3, 'Water Bed', '350 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(40, 3, 'Dresser - Single - Vanity', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(41, 3, 'Dresser - Double - Mirror', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(42, 3, 'Dresser - Triple - Mirror', '250 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(43, 3, 'Cedar Chest', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(44, 3, 'Armoire / Highboy', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(45, 3, 'Night Table', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(46, 3, 'Wardrobe (sm)', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(47, 3, 'Wardrobe (lg)', '300 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(48, 4, 'Car Seat', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(49, 4, 'Change Table', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(50, 4, 'Crib', '70 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(51, 4, 'High Chair', '35 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(52, 4, 'Large Toys', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(53, 4, 'Play Pen', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(54, 4, 'Stroller', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(55, 5, 'Bakers Rack', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(56, 5, 'Chair(s)', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(57, 5, 'Ironing Board', '10 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(58, 5, 'Kitchen Cupboard', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(59, 5, 'Microwave', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(60, 5, 'Stool(s)', '15 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(61, 5, 'Table - 4 or less', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(62, 5, 'Table - 5-6', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(63, 5, 'T.V. Tables', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(64, 6, 'Water Cooler', '75 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(65, 6, 'Dehumidifier / Humidifier', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(66, 6, 'Air Conditioner', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(67, 6, 'Freezer - 10 or less', '225 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(68, 6, 'Freezer - 11-15', '300 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(69, 6, 'Freezer - 16 + over', '400 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(70, 6, 'Microwave Stand', '70 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(71, 6, 'Range', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(72, 6, 'Refrigerator - 6 or less', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(73, 6, 'Refrigerator - 7-10', '225 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(74, 6, 'Refrigerator - 11 + over', '325 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(75, 6, 'Sewing Machine - Cabinet', '90 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(76, 6, 'Sewing Machine - Portable', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(77, 6, 'Dishwasher', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(78, 6, 'Dehumidifier / Humidifier', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(79, 6, 'Washing Machine', '175 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(80, 6, 'Dryer', '175 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(81, 7, 'Entertainment Centre', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(82, 7, 'Computer System', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(83, 7, 'Speaker(s) (ea)', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(84, 7, 'Stereo Component (ea)', '25 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(85, 7, 'Stereo Stand', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(86, 7, 'T.V. Lg Screen', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(87, 7, 'T.V. Flat Screen', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(88, 7, 'T.V. Stand', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(89, 7, 'CD Rack', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(90, 8, 'BBQ', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(91, 8, 'Chair(s) - Lawn (ea)', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(92, 8, 'Lawn Mower', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(93, 8, 'Ladder - Step', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(94, 8, 'Snow Blower', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(95, 9, 'Trash Cans', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(96, 9, 'Bicycle', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(97, 9, 'Treadmill', '225 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(98, 9, 'Exercise Bike', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(99, 9, 'Exercise Machine', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(100, 9, 'Filing Cabinet - 2 Drawer', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(101, 9, 'Filing Cabinet - 4 Drawer', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(102, 9, 'Hamper', '15 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(103, 9, 'Heater - Gas/Electric', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(104, 9, 'Fan', '15 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(105, 9, 'Suitcase(s)', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(106, 9, 'Patio Table / 6 Chairs / Umbrella', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(107, 9, 'Patio Bench', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(108, 9, 'Power Tool (floor model)', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(109, 9, 'Wood Shelf', '45 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(110, 9, 'Shelves - Metal', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(111, 9, 'Tool Chest - Large', '90 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(112, 9, 'Tool Chest - Small', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(113, 9, 'Trunk - Large', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(114, 9, 'Trunk - Small', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(115, 9, 'Air Hockey Table', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(116, 9, 'Fuseball Table', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(117, 9, 'Lawn Ornaments', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(118, 9, 'Utility / Gun Cabinet', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(119, 9, 'Work Bench', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(120, 9, 'Bathroom Toilet Cabinet', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(121, 9, 'Garden Hose - Tool Bundle', '35 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(122, 9, 'Pool Table', '400 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(123, 9, 'Mops / Pails / Brooms', '5 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(124, 9, 'Vacuum Cleaner', '25 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(125, 10, 'Boxes', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(126, 10, 'Pictures / Mirrors (small)', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(127, 10, 'Pictures / Mirrors (large)', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(128, 10, 'Plastic Stacker Drawers', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(129, 10, 'Totes / Rubbermaid Containers', '45 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(130, 10, 'Wardrobe Boxes', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moving_item_detail_service_requests`
--

CREATE TABLE `moving_item_detail_service_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `moving_items_service_id` int(10) UNSIGNED NOT NULL,
  `moving_items_details_id` int(10) UNSIGNED NOT NULL,
  `move_hours` tinyint(4) UNSIGNED DEFAULT NULL,
  `quantity` tinyint(3) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_item_detail_service_requests`
--

INSERT INTO `moving_item_detail_service_requests` (`id`, `moving_items_service_id`, `moving_items_details_id`, `move_hours`, `quantity`, `amount`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, 1, '100.00', '2018-01-23 11:36:39', 1, '2018-01-23 07:15:34', 20);

-- --------------------------------------------------------

--
-- Table structure for table `moving_item_service_requests`
--

CREATE TABLE `moving_item_service_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_client_id` int(10) UNSIGNED NOT NULL,
  `invitation_id` int(10) NOT NULL,
  `mover_company_id` int(10) UNSIGNED DEFAULT NULL,
  `moving_from_house_type` varchar(20) NOT NULL,
  `moving_from_floor` varchar(20) NOT NULL,
  `moving_from_bedroom_count` varchar(20) NOT NULL,
  `moving_from_property_type` varchar(20) NOT NULL,
  `moving_to_house_type` varchar(20) NOT NULL,
  `moving_to_floor` varchar(20) NOT NULL,
  `moving_to_bedroom_count` varchar(20) NOT NULL,
  `moving_to_property_type` varchar(20) NOT NULL,
  `transportation_vehicle_type` varchar(20) DEFAULT NULL,
  `insurance` enum('0','1') DEFAULT NULL,
  `callback_option` enum('0','1') NOT NULL COMMENT '0: No, 1: Yes',
  `callback_time` enum('0','1','2') DEFAULT NULL COMMENT '0: Anytime, 1: Daytime, 2: Evening',
  `primary_no` varchar(20) DEFAULT NULL,
  `secondary_no` varchar(20) DEFAULT NULL,
  `moving_date` date NOT NULL,
  `additional_information` text NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_item_service_requests`
--

INSERT INTO `moving_item_service_requests` (`id`, `agent_client_id`, `invitation_id`, `mover_company_id`, `moving_from_house_type`, `moving_from_floor`, `moving_from_bedroom_count`, `moving_from_property_type`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `transportation_vehicle_type`, `insurance`, `callback_option`, `callback_time`, `primary_no`, `secondary_no`, `moving_date`, `additional_information`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 3, 7, 'house', '1', '1', 'own', 'apartment/flat', '2', '2', 'rent', 'pickup', '1', '1', '0', '9876543210', '9632587410', '2018-01-31', 'testing purpose', '1', '2018-01-23 11:36:39', 1, '2018-01-23 06:06:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moving_other_item_services`
--

CREATE TABLE `moving_other_item_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(10) NOT NULL,
  `other_moving_items_services_details` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_other_item_services`
--

INSERT INTO `moving_other_item_services` (`id`, `type`, `other_moving_items_services_details`) VALUES
(1, 1, 'I have all items already in boxes and locked?'),
(2, 1, 'You need to move stuff from the basement?'),
(3, 1, 'You need to move stuff from the garage?'),
(4, 1, 'You need to move play structure from the nursery?'),
(5, 1, 'You need to move children swing set?'),
(6, 2, 'I need packaging services?'),
(7, 2, 'I need packaging boxes?'),
(8, 2, 'I need to disassemble and re-assemble items?'),
(9, 2, 'I need storage service?'),
(10, 2, 'Any packing issue in the house?');

-- --------------------------------------------------------

--
-- Table structure for table `moving_other_item_service_requests`
--

CREATE TABLE `moving_other_item_service_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `other_moving_items_services_id` int(10) UNSIGNED NOT NULL,
  `moving_items_service_id` bigint(20) UNSIGNED NOT NULL,
  `work_hour` tinyint(4) DEFAULT NULL,
  `quantity` tinyint(4) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_other_item_service_requests`
--

INSERT INTO `moving_other_item_service_requests` (`id`, `other_moving_items_services_id`, `moving_items_service_id`, `work_hour`, `quantity`, `amount`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, NULL, NULL, NULL, '2018-01-23 11:36:39', 1, '2018-01-23 06:06:39', NULL),
(2, 2, 1, NULL, NULL, NULL, '2018-01-23 11:36:39', 1, '2018-01-23 06:06:39', NULL),
(3, 3, 1, NULL, NULL, NULL, '2018-01-23 11:36:39', 1, '2018-01-23 06:06:39', NULL),
(4, 4, 1, NULL, NULL, NULL, '2018-01-23 11:36:39', 1, '2018-01-23 06:06:39', NULL),
(5, 5, 1, NULL, NULL, NULL, '2018-01-23 11:36:39', 1, '2018-01-23 06:06:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moving_transportations`
--

CREATE TABLE `moving_transportations` (
  `id` int(10) UNSIGNED NOT NULL,
  `transportation_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_transportations`
--

INSERT INTO `moving_transportations` (`id`, `transportation_type`) VALUES
(1, 'Transportation Vehicle');

-- --------------------------------------------------------

--
-- Table structure for table `moving_transportation_type_requests`
--

CREATE TABLE `moving_transportation_type_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `transportation_id` int(10) UNSIGNED NOT NULL,
  `moving_items_services_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `hour_to_complete` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_transportation_type_requests`
--

INSERT INTO `moving_transportation_type_requests` (`id`, `transportation_id`, `moving_items_services_id`, `amount`, `hour_to_complete`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, '100.00', '1.00', '2018-01-23 11:36:39', 1, '2018-01-23 07:15:34', 20);

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
  `allowed_count` int(11) NOT NULL COMMENT 'No of emails / quotation percentage allowed in the package',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_plans`
--

INSERT INTO `payment_plans` (`id`, `plan_type_id`, `plan_name`, `plan_charges`, `discount`, `validity_days`, `allowed_count`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'payment plan 1', '50.00', '5.00', 30, 100, '1', '2017-11-10 08:38:00', 1, '2017-11-15 11:25:17', 1),
(2, 1, 'payment plan 2', '120.00', '10.00', 60, 200, '1', '2017-11-10 08:38:35', 1, '2017-11-15 11:25:32', 1),
(3, 1, 'payment plan 3', '150.00', '10.00', 90, 500, '1', '2017-11-15 09:45:37', 1, '2017-11-15 09:45:37', NULL),
(4, 2, 'Company Plan 1', '0.75', '0.00', 30, 20, '1', '2017-12-19 07:43:37', 1, '2017-12-19 07:43:37', NULL),
(5, 2, 'Company Plan 2', '1.00', '0.00', 30, 50, '1', '2017-12-19 11:51:15', 1, '2017-12-19 11:51:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan_subscriptions`
--

CREATE TABLE `payment_plan_subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `plan_type_id` int(10) UNSIGNED NOT NULL,
  `subscriber_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `quota` int(10) NOT NULL COMMENT 'email / quotation qouta count',
  `remaining_qouta` int(10) NOT NULL COMMENT 'remaining email / quotation count',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_plan_subscriptions`
--

INSERT INTO `payment_plan_subscriptions` (`id`, `plan_id`, `plan_type_id`, `subscriber_id`, `start_date`, `end_date`, `quota`, `remaining_qouta`, `status`, `updated_at`) VALUES
(1, 4, 2, 7, '2017-12-20', '2017-12-27', 10, 5, '0', '2018-01-22 11:12:59'),
(2, 5, 2, 8, '2017-12-20', '2018-01-19', 10, -1, '1', '2018-01-18 08:54:49'),
(3, 4, 2, 9, '2018-01-02', '2018-02-01', 0, 0, '1', '2018-01-02 07:41:53'),
(4, 4, 2, 10, '2018-01-05', '2018-02-04', 0, 0, '1', '2018-01-05 07:28:06'),
(5, 4, 2, 11, '2018-01-08', '2018-02-07', 0, 0, '1', '2018-01-08 14:09:29'),
(6, 4, 2, 7, '2018-01-22', '2018-02-21', 0, -6, '1', '2018-01-23 06:06:39');

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
(1, 'agent', 'Payment plan for agents attached with real estate companies', '1', '2017-12-19 07:14:34', 1, '2017-12-19 07:14:34', NULL),
(2, 'company', 'Payment plan for companies other than real estate', '1', '2017-12-19 07:13:58', 1, '2017-12-19 07:13:58', NULL);

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
  `abbreviation` varchar(10) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `pst` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `gst` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `hst` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `service_charge` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `country_id`, `name`, `abbreviation`, `image`, `pst`, `gst`, `hst`, `service_charge`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Alberta', 'AB', 'alberta.jpg', '0.0000', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 12:06:57', 1, '2017-11-08 09:33:25', NULL),
(2, 1, 'British Columbia', 'BC', 'british_columbia.jpg', '7.0000', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 11:59:53', 1, '2017-11-08 09:33:25', NULL),
(3, 1, 'Manitoba', 'MB', 'manitoba.jpg', '8.0000', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 12:01:25', 1, '2017-11-08 09:33:25', NULL),
(4, 1, 'New Brunswick', 'NB', 'new_brunswick.jpg', '0.0000', '5.0000', '10.0000', '15.0000', '1', '2018-01-12 12:03:29', 1, '2017-11-08 09:33:25', NULL),
(5, 1, 'Newfoundland and Labrador', 'NL', 'newfoundland_labrador.jpg', '0.0000', '5.0000', '10.0000', '15.0000', '1', '2018-01-12 12:04:41', 1, '2017-11-08 09:33:25', NULL),
(6, 1, 'Northwest Territories', 'NT', 'northwest_territories.jpg', '0.0000', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 12:05:27', 1, '2017-11-08 09:33:25', NULL),
(7, 1, 'Nova Scotia', 'NS', 'nova_scotia.jpg', '0.0000', '5.0000', '10.0000', '15.0000', '1', '2018-01-12 12:03:48', 1, '2017-11-08 09:33:25', NULL),
(8, 1, 'Nunavut', 'NU', 'nunavut.jpg', '0.0000', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 12:05:41', 1, '2017-11-08 09:33:25', NULL),
(9, 1, 'Ontario', 'ON', 'ontario.jpg', '0.0000', '5.0000', '8.0000', '15.0000', '1', '2018-01-16 09:55:32', 1, '2017-11-08 09:33:25', NULL),
(10, 1, 'Prince Edward Island', 'PE', 'prince_edward_island.jpg', '0.0000', '5.0000', '10.0000', '15.0000', '1', '2018-01-12 12:04:06', 1, '2017-11-08 09:33:25', NULL),
(11, 1, 'Quebec', 'QC', 'quebec.jpg', '9.9750', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 12:02:59', 1, '2017-11-08 09:33:25', NULL),
(12, 1, 'Saskatchewan', 'SK', 'saskatchewan.jpg', '6.0000', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 12:00:59', 1, '2017-11-08 09:33:25', NULL),
(13, 1, 'Yukon', 'YT', 'yukon.jpg', '0.0000', '5.0000', '0.0000', '15.0000', '1', '2018-01-12 12:05:05', 1, '2017-11-08 09:33:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provincial_agency_details`
--

CREATE TABLE `provincial_agency_details` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `agency_name` varchar(100) NOT NULL,
  `label1` varchar(250) DEFAULT NULL,
  `label2` varchar(250) DEFAULT NULL,
  `label3` varchar(250) DEFAULT NULL,
  `label4` varchar(250) DEFAULT NULL,
  `label5` varchar(250) DEFAULT NULL,
  `label6` varchar(250) DEFAULT NULL,
  `label7` varchar(250) DEFAULT NULL,
  `label8` varchar(250) DEFAULT NULL,
  `label9` varchar(250) DEFAULT NULL,
  `label10` varchar(250) DEFAULT NULL,
  `heading1` varchar(200) DEFAULT NULL,
  `detail1` varchar(200) DEFAULT NULL,
  `heading2` varchar(200) DEFAULT NULL,
  `detail2` varchar(200) DEFAULT NULL,
  `heading3` varchar(200) DEFAULT NULL,
  `detail3` varchar(200) DEFAULT NULL,
  `heading4` varchar(200) DEFAULT NULL,
  `detail4` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `provincial_agency_details`
--

INSERT INTO `provincial_agency_details` (`id`, `province_id`, `agency_name`, `label1`, `label2`, `label3`, `label4`, `label5`, `label6`, `label7`, `label8`, `label9`, `label10`, `heading1`, `detail1`, `heading2`, `detail2`, `heading3`, `detail3`, `heading4`, `detail4`, `link`, `logo`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 9, 'Health agency', 'Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5', 'Label 6', 'Label 7', 'Label 8', 'Label 9', 'Label 10', 'Heading 1', 'Detail 1', 'Heading 2', 'Detail 2', 'Heading 3', 'Detail 3', 'Heading 4', 'Detail 4', 'https://www.google.co.in/?gfe_rd=cr&dcr=0&ei=DiVXWvrNO9OL8Qek25SoAw', 'NKPYYP4C23UIWYXrBVdpVe7mGKlFWMsUwNL8pnkQ.jpg', '1', '2018-01-11 14:26:22', 1, '2018-01-11 08:56:22', NULL),
(2, 9, 'Safety agency', 'Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5', 'Label 6', 'Label 7', 'Label 8', 'Label 9', 'Label 10', 'Heading 1', 'Detail 1', 'Heading 2', 'Detail 2', 'Heading 3', 'Detail 3', 'Heading 4', 'Detail 4', 'https://www.google.co.in/?gfe_rd=cr&dcr=0&ei=DiVXWvrNO9OL8Qek25SoAw', NULL, '1', '2018-01-11 14:34:20', 1, '2018-01-11 10:26:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_logs`
--

CREATE TABLE `quotation_logs` (
  `id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `payment_plan_id` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To maintain the quotations count for each company month wise';

--
-- Dumping data for table `quotation_logs`
--

INSERT INTO `quotation_logs` (`id`, `company_id`, `client_id`, `payment_plan_id`, `status`, `created_at`) VALUES
(1, 9, 1, 4, '1', '2018-01-02 18:54:29'),
(2, 9, 1, 4, '1', '2018-01-02 19:36:53'),
(3, 9, 1, 4, '1', '2018-01-02 19:39:06'),
(4, 10, 1, 4, '1', '2018-01-05 15:00:21'),
(5, 10, 1, 4, '1', '2018-01-05 15:01:32'),
(6, 10, 1, 4, '1', '2018-01-05 15:02:46'),
(7, 10, 1, 4, '1', '2018-01-05 15:03:48'),
(8, 10, 1, 4, '1', '2018-01-05 15:04:56'),
(9, 10, 1, 4, '1', '2018-01-05 15:05:23'),
(10, 10, 1, 4, '1', '2018-01-05 16:11:53'),
(11, 11, 1, 4, '1', '2018-01-09 10:57:06'),
(12, 11, 1, 4, '1', '2018-01-09 10:59:02'),
(13, 10, 1, 4, '1', '2018-01-15 12:42:06'),
(14, 10, 1, 4, '1', '2018-01-23 11:24:08'),
(15, 11, 1, 4, '1', '2018-01-23 11:29:17'),
(16, 9, 1, 4, '1', '2018-01-23 11:32:44');

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
(2, 'company_representative', 'company representative', 'User is allowed to add and manage agent associated with a company', '2017-11-13 06:37:41', '2017-11-13 06:37:41'),
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
(2, 15, 'App\\User'),
(2, 18, 'App\\User'),
(2, 19, 'App\\User'),
(2, 20, 'App\\User'),
(2, 21, 'App\\User'),
(2, 22, 'App\\User'),
(2, 23, 'App\\User'),
(2, 24, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `service_request_responses`
--

CREATE TABLE `service_request_responses` (
  `id` int(10) NOT NULL,
  `request_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `gst_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `hst_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pst_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `service_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `insurance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL,
  `total_remittance` decimal(10,2) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_request_responses`
--

INSERT INTO `service_request_responses` (`id`, `request_id`, `company_id`, `gst_amount`, `hst_amount`, `pst_amount`, `service_charge`, `insurance`, `discount`, `total_amount`, `total_remittance`, `comment`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 10, '14.50', '23.20', '0.00', '43.50', '0.00', '10.00', '327.70', '284.20', 'testing purpose', '2018-01-23 11:56:04', 23, '2018-01-23 06:26:04', NULL),
(2, 1, 11, '30.00', '48.00', '0.00', '90.00', '0.00', '50.00', '678.00', '588.00', 'testing purpose', '2018-01-23 12:17:30', 24, '2018-01-23 06:47:30', NULL),
(3, 1, 9, '7.50', '12.00', '0.00', '22.50', '0.00', '50.00', '169.50', '147.00', 'testing purpose', '2018-01-23 12:36:10', 22, '2018-01-23 07:06:10', NULL),
(4, 1, 7, '10.00', '16.00', '0.00', '30.00', '20.00', '20.00', '226.00', '196.00', 'testing purpose', '2018-01-23 12:45:34', 20, '2018-01-23 07:15:34', NULL);

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
-- Table structure for table `street_types`
--

CREATE TABLE `street_types` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `street_types`
--

INSERT INTO `street_types` (`id`, `type`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Boulevad', '1', '2017-11-23 12:00:00', 1, '2017-11-23 06:27:17', NULL),
(2, 'Drive', '1', '2017-11-23 12:00:00', 1, '2017-11-23 06:27:17', NULL),
(3, 'Highway', '1', '2017-11-23 12:00:00', 1, '2017-11-23 06:27:17', NULL),
(4, 'Road', '1', '2017-11-23 12:00:00', 1, '2017-11-23 06:27:17', NULL),
(5, 'Street', '1', '2017-11-23 12:00:00', 1, '2017-11-23 06:27:17', NULL),
(6, 'Way', '1', '2017-11-23 12:00:00', 1, '2017-11-23 06:27:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_concierge_appliances`
--

CREATE TABLE `tech_concierge_appliances` (
  `id` int(10) NOT NULL,
  `appliances` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_concierge_appliances`
--

INSERT INTO `tech_concierge_appliances` (`id`, `appliances`) VALUES
(1, 'fridge'),
(2, 'oven / otr'),
(3, 'dish washer'),
(4, 'washer & dryer'),
(5, 'tv'),
(6, 'home theatre'),
(7, 'security system');

-- --------------------------------------------------------

--
-- Table structure for table `tech_concierge_appliances_service_requests`
--

CREATE TABLE `tech_concierge_appliances_service_requests` (
  `id` int(10) NOT NULL,
  `service_request_id` int(10) NOT NULL,
  `appliance_id` int(10) NOT NULL,
  `service_hours` int(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_concierge_appliances_service_requests`
--

INSERT INTO `tech_concierge_appliances_service_requests` (`id`, `service_request_id`, `appliance_id`, `service_hours`, `amount`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 3, 1, '50.00', '2018-01-23 11:32:44', 1, '2018-01-23 07:06:10', 22),
(2, 1, 6, 1, '50.00', '2018-01-23 11:32:44', 1, '2018-01-23 07:06:10', 22),
(3, 1, 7, 1, '50.00', '2018-01-23 11:32:44', 1, '2018-01-23 07:06:10', 22),
(4, 1, 4, 1, '50.00', '2018-01-23 11:32:44', 1, '2018-01-23 07:06:10', 22);

-- --------------------------------------------------------

--
-- Table structure for table `tech_concierge_other_details`
--

CREATE TABLE `tech_concierge_other_details` (
  `id` int(10) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_concierge_other_details`
--

INSERT INTO `tech_concierge_other_details` (`id`, `details`) VALUES
(1, 'Do you have water connection ready for fridge?'),
(2, 'Do you have water connection ready for dish washer?'),
(3, 'Do you have water connection ready for laundry?'),
(4, 'Do you have to mount TV on brackets?'),
(5, 'Do you have to bore hole for over the range oven?'),
(6, 'Do you have installations kit for laundry machines?'),
(7, 'Do you have all installation pipe ready for fridge?'),
(8, 'Are all the appliances moved in and ready for installations?');

-- --------------------------------------------------------

--
-- Table structure for table `tech_concierge_other_detail_service_requests`
--

CREATE TABLE `tech_concierge_other_detail_service_requests` (
  `id` int(10) NOT NULL,
  `service_request_id` int(10) NOT NULL,
  `other_detail_id` int(10) NOT NULL,
  `service_hours` int(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tech_concierge_other_detail_service_requests`
--

INSERT INTO `tech_concierge_other_detail_service_requests` (`id`, `service_request_id`, `other_detail_id`, `service_hours`, `amount`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(2, 1, 2, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(3, 1, 3, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(4, 1, 4, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(5, 1, 5, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(6, 1, 6, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(7, 1, 7, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(8, 1, 8, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_concierge_places`
--

CREATE TABLE `tech_concierge_places` (
  `id` int(10) NOT NULL,
  `places` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_concierge_places`
--

INSERT INTO `tech_concierge_places` (`id`, `places`) VALUES
(1, 'living room'),
(2, 'bed room(s)'),
(3, 'basement'),
(4, 'kitchen'),
(5, 'office room'),
(6, 'recreation room');

-- --------------------------------------------------------

--
-- Table structure for table `tech_concierge_place_service_requests`
--

CREATE TABLE `tech_concierge_place_service_requests` (
  `id` int(10) NOT NULL,
  `service_request_id` int(10) NOT NULL,
  `place_id` int(10) NOT NULL,
  `service_hours` int(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tech_concierge_place_service_requests`
--

INSERT INTO `tech_concierge_place_service_requests` (`id`, `service_request_id`, `place_id`, `service_hours`, `amount`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 3, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(2, 1, 4, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(3, 1, 1, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL),
(4, 1, 5, NULL, NULL, '2018-01-23 11:32:44', 1, '2018-01-23 06:02:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_concierge_service_requests`
--

CREATE TABLE `tech_concierge_service_requests` (
  `id` int(10) NOT NULL,
  `agent_client_id` int(10) NOT NULL,
  `invitation_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `moving_to_house_type` varchar(20) NOT NULL,
  `moving_to_floor` varchar(20) NOT NULL,
  `moving_to_bedroom_count` varchar(20) NOT NULL,
  `moving_to_property_type` varchar(20) NOT NULL,
  `primary_no` varchar(20) NOT NULL,
  `secondary_no` varchar(20) NOT NULL,
  `availability_date1` date DEFAULT NULL,
  `availability_time_from1` varchar(10) DEFAULT NULL,
  `availability_time_upto1` varchar(10) DEFAULT NULL,
  `availability_date2` date DEFAULT NULL,
  `availability_time_from2` varchar(10) DEFAULT NULL,
  `availability_time_upto2` varchar(10) DEFAULT NULL,
  `availability_date3` date DEFAULT NULL,
  `availability_time_from3` varchar(10) DEFAULT NULL,
  `availability_time_upto3` varchar(10) DEFAULT NULL,
  `additional_information` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_concierge_service_requests`
--

INSERT INTO `tech_concierge_service_requests` (`id`, `agent_client_id`, `invitation_id`, `company_id`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `primary_no`, `secondary_no`, `availability_date1`, `availability_time_from1`, `availability_time_upto1`, `availability_date2`, `availability_time_from2`, `availability_time_upto2`, `availability_date3`, `availability_time_from3`, `availability_time_upto3`, `additional_information`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 3, 9, 'house', '1', '1', 'own', '963258741', '987654122', '2018-01-31', '08:00AM to', '08:00AM to', '2018-01-30', '08:00AM to', '08:00AM to', '2018-01-29', '12:00PM to', '12:00PM to', 'testing purpose', '1', '2018-01-23 00:00:00', 1, '2018-01-23 06:02:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'designation of company representative',
  `fname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `postalcode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gplus` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL COMMENT 'To manage the last login datetime of user',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `business_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>others, 1=>male, 2=>female',
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `designation`, `fname`, `lname`, `address1`, `address2`, `province_id`, `city_id`, `postalcode`, `country_id`, `password`, `twitter`, `linkedin`, `skype`, `facebook`, `gplus`, `instagram`, `website`, `image`, `remember_token`, `last_login`, `status`, `business_name`, `gender`, `phone_number`, `extension_number`, `fax`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'admin@udistro.com', NULL, 'admin', '', '', NULL, NULL, NULL, NULL, NULL, '$2y$10$M.pFE2TlBClEjdmbNBmDN.oPPJ/g02EywCQ3K8xC2HINUOebrdRam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zFdswo7mm8Pjwc2U1C9W7KLiiygSyOk1Fu7IOjgwkcxGVTuWrpRlUaTwz6Qu', '2018-01-25 19:16:26', '1', NULL, 0, NULL, NULL, NULL, '2017-10-26 06:30:00', 0, '2018-01-25 13:46:26', 0),
(4, 'mayank1234@gmail.com', NULL, 'mayank', 'pandey', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$kPFKoPPrVrJ0Kr6dphAbOerT64uyfe4XOlWeMDeJheO8Fc5sDnLee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, NULL, '2017-11-14 06:12:10', 1, '2017-11-14 10:04:04', 1),
(6, 'aman123@gmail.com', NULL, 'aman', 'kumar', 'address 1', NULL, 9, 9, '1', NULL, '$2y$10$kPFKoPPrVrJ0Kr6dphAbOerT64uyfe4XOlWeMDeJheO8Fc5sDnLee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, NULL, '2017-11-14 13:41:43', 1, '2017-11-14 13:41:43', NULL),
(8, 'john123@gmail.com', NULL, 'john', 'andrew', 'address 1', NULL, 9, 9, '1', NULL, '$2y$10$kPFKoPPrVrJ0Kr6dphAbOerT64uyfe4XOlWeMDeJheO8Fc5sDnLee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, NULL, '2017-11-14 13:45:50', 1, '2017-11-14 13:45:50', NULL),
(9, 'mack123@gmail.com', NULL, 'mack', 'manon', 'Sea side, 121 street', NULL, 2, 2, '123 456', 1, '$2y$10$M.pFE2TlBClEjdmbNBmDN.oPPJ/g02EywCQ3K8xC2HINUOebrdRam', 'https://twitter.com/login', 'https://linkedin.com/login', 'https://facebook.com/login', NULL, NULL, NULL, 'https://mywebsite.com/login', 'bZg87BpIAf.jpg', 'Xky8XsGQbnZ9OQx5HSVTQb8XXX8XcjzUWpkq18NUncdawZMchRDP6BdtAMdT', '2018-01-25 17:18:13', '1', NULL, 0, NULL, NULL, NULL, '2017-11-15 06:18:37', 1, '2018-01-25 11:48:13', 9),
(10, 'august123@gmail.com', NULL, 'jane', 'august', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$mk.FfZel31y1paHksWeT1evNFNGRo.hhlvF7ddGxh8VCCUetBs2qa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, NULL, '2017-11-15 07:13:35', 1, '2017-11-15 07:13:35', NULL),
(13, 'jane123@gmail.com', NULL, 'jane', 'august', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$xS5b7p/yhGfcgPMUAHV4AeZXdG/KaMq87QCEfjqzkj47zrSuGyT9y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, NULL, '2017-11-15 07:37:20', 1, '2017-11-15 07:37:20', NULL),
(15, 'rown_123@gmail.com', NULL, 'rown', 'cloney', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$GXCf9X5dQXIKfVRT8cI0KeTJXuJM8NV2tmwb.U68ixl1JWj0Jysci', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, NULL, '2017-11-15 07:45:30', 1, '2017-11-15 09:00:40', 1),
(18, 'ajitsingh12@gmail.com', NULL, 'ajit', 'singh', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$4XfeD95eiq7ujTymWxAGaO9yWtIYVTxVXz45dkxzZQAabTbJYYxv6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cSsagsduU6ozjBsZ6WHJ1x7T9kP6mxYUXCYdBGzqc0YOHUGJZDu56bRxINxk', '2017-12-20 17:29:56', '1', NULL, 0, NULL, NULL, NULL, '2017-12-12 09:02:11', NULL, '2017-12-20 11:59:56', NULL),
(19, 'amankum45@gmail.com', NULL, 'aman', 'kumar', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$KkTRZ/5N0rgfLq7KEpJY6ecfmlmmQFaHDHLtowgKvVh6DoM4bDzV6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8wJnOhtUaYSZCal1nvT7chcsOFC2yb4YuzZ6XnakKf6gqTkOKbYMUQWiquca', '2017-12-20 17:29:29', '1', NULL, 0, NULL, NULL, NULL, '2017-12-12 09:04:31', NULL, '2017-12-20 11:59:29', NULL),
(20, 'rishabhkumar45@gmail.com', 'manager', 'rishabh', 'kumar', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Z1LEiFtCujpSq6vq9l7zXe7MIEEZXpkEyiUEn.LAaH9HImDyFGlNS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kLcEXx7ry0MuDQxQOFw7FFfk6SLYgnyCfRhdKX10boFrxvFrciwDOIKCIOCI', '2018-01-23 12:45:00', '1', NULL, 0, NULL, NULL, NULL, '2017-12-12 09:08:53', NULL, '2018-01-23 07:15:00', NULL),
(21, 'alex123@gmail.com', 'manager', 'alex', 'udy', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Z1LEiFtCujpSq6vq9l7zXe7MIEEZXpkEyiUEn.LAaH9HImDyFGlNS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5MsxemtyF2bjcenxzA2TyclEsSrs22OLRwOp3i1DmJ2aX9yGBTUn3JMW4WEZ', '2018-01-22 16:04:00', '1', NULL, 0, NULL, NULL, NULL, '2017-12-20 12:11:46', NULL, '2018-01-22 10:34:00', NULL),
(22, 'alexbill@gmail.com', 'manager', 'alex', 'bill', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$fxDBq/O0854r8ZeUVDZN2uTrcdgwj1CTshsk/.PVbvuN/4tiZ9wNe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jc0ydOhkAWkeXXTZ4qwKtcaqzF0ZJ6FqJBRRNfhenHxDRIEKXGjYGcoYZayM', '2018-01-23 12:35:37', '1', NULL, 0, NULL, NULL, NULL, '2018-01-02 06:27:14', NULL, '2018-01-23 07:05:37', NULL),
(23, 'reck@gmail.com', 'manager', 'reck', 'divy', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$2DLmo8tywjky0VqLGmPG6e.q3Dgs6rdWxJcviEodymEHe96t0laH2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'E6wOfiRI6dTxdphWitAGROn0lUXIAcon5untJaMQjmgCWeSbgKvwYqz56DyR', '2018-01-25 16:42:05', '1', NULL, 0, NULL, NULL, NULL, '2018-01-05 07:20:50', NULL, '2018-01-25 11:12:05', NULL),
(24, 'tom12@gmail.com', 'manager', 'tom', 'kin', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$wKv4sA1nmU49MSaJjs9XxessQ0IGnJrG1vd.ImkoCtwQpafFzl13W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hla1QPAELvyZc8RwptuZS4cMdixlXV9h8yqJD5uLGXenJQJGmFJCPqT6XFT5', '2018-01-23 12:16:50', '1', NULL, 0, NULL, NULL, NULL, '2018-01-08 14:07:16', NULL, '2018-01-23 06:46:50', NULL);

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
(2, 2, 'def company', 1, 2, 2, 'address 2', '1', '2017-11-09 17:05:08', 1, '2017-12-06 13:22:00', 1),
(3, 2, 'ghi company', 1, 7, 7, 'test address', '1', '2017-11-17 16:22:16', 9, '2017-12-06 13:22:08', NULL);

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
-- Indexes for table `agent_client_invites`
--
ALTER TABLE `agent_client_invites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_id` (`agent_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `agent_client_moving_from_addresses`
--
ALTER TABLE `agent_client_moving_from_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_client_id` (`agent_client_id`);

--
-- Indexes for table `agent_client_moving_to_addresses`
--
ALTER TABLE `agent_client_moving_to_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_client_id` (`agent_client_id`);

--
-- Indexes for table `agent_client_ratings`
--
ALTER TABLE `agent_client_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_id` (`agent_id`,`client_id`),
  ADD KEY `invitation_id` (`invitation_id`,`agent_id`,`client_id`);

--
-- Indexes for table `category_services`
--
ALTER TABLE `category_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_service_company`
--
ALTER TABLE `category_service_company`
  ADD KEY `category_service_id` (`category_service_id`,`company_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_activity_feedbacks`
--
ALTER TABLE `client_activity_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_activity_lists`
--
ALTER TABLE `client_activity_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_activity_logs`
--
ALTER TABLE `client_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitation_id` (`invitation_id`,`client_id`,`activity_id`);

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
-- Indexes for table `digital_additional_services`
--
ALTER TABLE `digital_additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `digital_additional_service_type_requests`
--
ALTER TABLE `digital_additional_service_type_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `digital_service_requests`
--
ALTER TABLE `digital_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `digital_service_types`
--
ALTER TABLE `digital_service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `digital_service_type_requests`
--
ALTER TABLE `digital_service_type_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_lists`
--
ALTER TABLE `email_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template_categories`
--
ALTER TABLE `email_template_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template_user`
--
ALTER TABLE `email_template_user`
  ADD KEY `agent_id` (`user_id`,`email_template_id`);

--
-- Indexes for table `forgot_passwords`
--
ALTER TABLE `forgot_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cleaning_additional_services`
--
ALTER TABLE `home_cleaning_additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cleaning_additional_service_requests`
--
ALTER TABLE `home_cleaning_additional_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cleaning_other_places`
--
ALTER TABLE `home_cleaning_other_places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cleaning_other_place_service_requests`
--
ALTER TABLE `home_cleaning_other_place_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cleaning_service_requests`
--
ALTER TABLE `home_cleaning_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cleaning_steaming_services`
--
ALTER TABLE `home_cleaning_steaming_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cleaning_steaming_service_requests`
--
ALTER TABLE `home_cleaning_steaming_service_requests`
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
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moving_item_categories`
--
ALTER TABLE `moving_item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moving_item_details`
--
ALTER TABLE `moving_item_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moving_items_category_id` (`moving_item_category_id`),
  ADD KEY `moving_items_category_id_2` (`moving_item_category_id`);

--
-- Indexes for table `moving_item_detail_service_requests`
--
ALTER TABLE `moving_item_detail_service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_client_id` (`moving_items_service_id`),
  ADD KEY `moving_items_details_id` (`moving_items_details_id`),
  ADD KEY `special_instruction_service_id` (`moving_items_service_id`),
  ADD KEY `moving_items_details_id_2` (`moving_items_details_id`);

--
-- Indexes for table `moving_item_service_requests`
--
ALTER TABLE `moving_item_service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_client_id` (`agent_client_id`),
  ADD KEY `mover_company_id` (`mover_company_id`);

--
-- Indexes for table `moving_other_item_services`
--
ALTER TABLE `moving_other_item_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moving_other_item_service_requests`
--
ALTER TABLE `moving_other_item_service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `other_moving_items_services_id` (`other_moving_items_services_id`),
  ADD KEY `special_instruction_service_id` (`moving_items_service_id`);

--
-- Indexes for table `moving_transportations`
--
ALTER TABLE `moving_transportations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moving_transportation_type_requests`
--
ALTER TABLE `moving_transportation_type_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transportation_id` (`transportation_id`),
  ADD KEY `moving_items_services_id` (`moving_items_services_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_plan_id` (`plan_id`);

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
-- Indexes for table `provincial_agency_details`
--
ALTER TABLE `provincial_agency_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_logs`
--
ALTER TABLE `quotation_logs`
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
-- Indexes for table `service_request_responses`
--
ALTER TABLE `service_request_responses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `street_types`
--
ALTER TABLE `street_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_concierge_appliances`
--
ALTER TABLE `tech_concierge_appliances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_concierge_appliances_service_requests`
--
ALTER TABLE `tech_concierge_appliances_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_concierge_other_details`
--
ALTER TABLE `tech_concierge_other_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_concierge_other_detail_service_requests`
--
ALTER TABLE `tech_concierge_other_detail_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_concierge_places`
--
ALTER TABLE `tech_concierge_places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_concierge_place_service_requests`
--
ALTER TABLE `tech_concierge_place_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_concierge_service_requests`
--
ALTER TABLE `tech_concierge_service_requests`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `agent_client_invites`
--
ALTER TABLE `agent_client_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `agent_client_moving_from_addresses`
--
ALTER TABLE `agent_client_moving_from_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `agent_client_moving_to_addresses`
--
ALTER TABLE `agent_client_moving_to_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `agent_client_ratings`
--
ALTER TABLE `agent_client_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category_services`
--
ALTER TABLE `category_services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;
--
-- AUTO_INCREMENT for table `client_activity_feedbacks`
--
ALTER TABLE `client_activity_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `client_activity_lists`
--
ALTER TABLE `client_activity_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `client_activity_logs`
--
ALTER TABLE `client_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `company_categories`
--
ALTER TABLE `company_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `digital_additional_services`
--
ALTER TABLE `digital_additional_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `digital_additional_service_type_requests`
--
ALTER TABLE `digital_additional_service_type_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `digital_service_requests`
--
ALTER TABLE `digital_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `digital_service_types`
--
ALTER TABLE `digital_service_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `digital_service_type_requests`
--
ALTER TABLE `digital_service_type_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `email_lists`
--
ALTER TABLE `email_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `email_template_categories`
--
ALTER TABLE `email_template_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `forgot_passwords`
--
ALTER TABLE `forgot_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `home_cleaning_additional_services`
--
ALTER TABLE `home_cleaning_additional_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `home_cleaning_additional_service_requests`
--
ALTER TABLE `home_cleaning_additional_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `home_cleaning_other_places`
--
ALTER TABLE `home_cleaning_other_places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `home_cleaning_other_place_service_requests`
--
ALTER TABLE `home_cleaning_other_place_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `home_cleaning_service_requests`
--
ALTER TABLE `home_cleaning_service_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `home_cleaning_steaming_services`
--
ALTER TABLE `home_cleaning_steaming_services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `home_cleaning_steaming_service_requests`
--
ALTER TABLE `home_cleaning_steaming_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hookup_services`
--
ALTER TABLE `hookup_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `moving_item_categories`
--
ALTER TABLE `moving_item_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `moving_item_details`
--
ALTER TABLE `moving_item_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `moving_item_detail_service_requests`
--
ALTER TABLE `moving_item_detail_service_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `moving_item_service_requests`
--
ALTER TABLE `moving_item_service_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `moving_other_item_services`
--
ALTER TABLE `moving_other_item_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `moving_other_item_service_requests`
--
ALTER TABLE `moving_other_item_service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `moving_transportations`
--
ALTER TABLE `moving_transportations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `moving_transportation_type_requests`
--
ALTER TABLE `moving_transportation_type_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_plans`
--
ALTER TABLE `payment_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payment_plan_subscriptions`
--
ALTER TABLE `payment_plan_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payment_plan_types`
--
ALTER TABLE `payment_plan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `provincial_agency_details`
--
ALTER TABLE `provincial_agency_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `quotation_logs`
--
ALTER TABLE `quotation_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
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
-- AUTO_INCREMENT for table `service_request_responses`
--
ALTER TABLE `service_request_responses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- AUTO_INCREMENT for table `street_types`
--
ALTER TABLE `street_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tech_concierge_appliances`
--
ALTER TABLE `tech_concierge_appliances`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tech_concierge_appliances_service_requests`
--
ALTER TABLE `tech_concierge_appliances_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tech_concierge_other_details`
--
ALTER TABLE `tech_concierge_other_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tech_concierge_other_detail_service_requests`
--
ALTER TABLE `tech_concierge_other_detail_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tech_concierge_places`
--
ALTER TABLE `tech_concierge_places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tech_concierge_place_service_requests`
--
ALTER TABLE `tech_concierge_place_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tech_concierge_service_requests`
--
ALTER TABLE `tech_concierge_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
-- Constraints for table `moving_item_details`
--
ALTER TABLE `moving_item_details`
  ADD CONSTRAINT `moving_item_details_ibfk_1` FOREIGN KEY (`moving_item_category_id`) REFERENCES `moving_item_categories` (`id`);

--
-- Constraints for table `payment_plan_subscriptions`
--
ALTER TABLE `payment_plan_subscriptions`
  ADD CONSTRAINT `fk_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `payment_plans` (`id`);

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
