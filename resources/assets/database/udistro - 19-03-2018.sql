-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2018 at 02:51 PM
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
(1, 58, 'mayank', 'pandey', '', 'mayankpandey@virtualemployee.com', '7896543210', NULL, NULL, '1', '2018-03-19 07:01:07', 58, '2018-03-19 07:01:07', NULL);

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
  `schedule_date` date DEFAULT NULL COMMENT 'Schedule email datetime',
  `authentication` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1','2','3') NOT NULL COMMENT 'Email Life Cycle: 0: Initial, 1: Send, 2: Read, 3: Expire',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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

-- --------------------------------------------------------

--
-- Table structure for table `agent_partners`
--

CREATE TABLE `agent_partners` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `partner_email` varchar(50) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agent_partner_digital_additional_service_type_requests`
--

CREATE TABLE `agent_partner_digital_additional_service_type_requests` (
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

-- --------------------------------------------------------

--
-- Table structure for table `agent_partner_digital_service_requests`
--

CREATE TABLE `agent_partner_digital_service_requests` (
  `id` int(10) NOT NULL,
  `agent_client_id` int(10) NOT NULL,
  `invitation_id` int(10) NOT NULL,
  `agent_partner_id` int(10) UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `agent_partner_digital_service_type_requests`
--

CREATE TABLE `agent_partner_digital_service_type_requests` (
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
(1, 1),
(1, 2),
(1, 10),
(2, 1),
(2, 2),
(2, 10),
(3, 1),
(3, 2),
(3, 10),
(5, 1),
(5, 2),
(5, 10),
(6, 1),
(6, 2),
(6, 10),
(7, 3),
(7, 7),
(7, 8),
(8, 3),
(8, 7),
(9, 3),
(9, 7),
(10, 3),
(10, 7),
(11, 3),
(11, 7),
(11, 8),
(12, 3),
(12, 7),
(12, 8),
(13, 3),
(13, 7),
(13, 8),
(14, 3),
(14, 7),
(15, 4),
(15, 9),
(18, 4),
(18, 9),
(19, 4),
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
(2, 'forward mail', 'sq58QxAvV2pDiVhmbPfe2F3RlUF4ftgBV7QHV0FE.png', 'forward mail', '1', '1', 'forward_mail', '2017-11-29 12:00:00', 1, '2018-03-05 11:48:14', NULL),
(3, 'Mailbox Keys', 'hwhWdDzzZmfEmuF6z6FR1gqBlsk898RCqWulnurv.png', 'Mailbox Keys', '1', '1', 'mailbox_keys', '2017-11-29 12:00:00', 1, '2018-03-05 11:48:25', NULL),
(4, 'Update Address', 'RrUt2N6S1OqhKBQGZ2xqVuDqB6ZKwfXQ8WWuqO1H.png', 'Update Address', '1', '1', 'update_address', '2017-11-29 12:00:00', 1, '2018-03-05 11:48:38', NULL),
(5, 'Connect Utilities', 'u3R40GftyQ54HLfB2QA9RnjBamZNTwXJUpEFym0I.png', 'Connect Utilities', '1', '1', 'connect_utilities', '2017-11-29 12:00:00', 1, '2018-03-05 11:48:46', NULL),
(6, 'Cable & Internet Service', 'jjmjguQ8RBZUPkXBb6QMRzO7RGpIzxDyxGXfq8Pi.png', 'Cable & Internet Service', '1', '1', 'cable_internet_services', '2017-11-29 12:00:00', 1, '2018-03-05 11:48:53', NULL),
(7, 'Home Cleaning Service', 'brD8BEvbWCvLWIFG7ycThwjCXnAb19eBTAR0dYNF.png', 'Home Cleaning Service', '1', '1', 'home_cleaning_services', '2017-11-29 12:00:00', 1, '2018-03-05 11:48:59', NULL),
(8, 'Moving Companies', 'xpEF7D0hE8xuPcmAo8dxeXRE5GpEq01vrX1XmV3K.png', 'Moving Companies', '1', '1', 'moving_companies', '2017-11-29 12:00:00', 1, '2018-03-05 11:49:07', NULL),
(9, 'Tech Concierge', '6G3Qfht9zFHTbib8x8Hqwd8pcIkXXnZhMVhyp1Bi.png', 'Tech Concierge', '1', '1', 'tech_concierge', '2017-11-29 12:00:00', 1, '2018-03-05 11:49:14', NULL),
(10, 'share announcement', '0DMqhQcEp6bF1TJ9vlDdtsFgXzEluEMnfYLyrZmK.png', 'share announcement', '1', '1', 'share_announcement', '2017-11-30 11:00:00', 1, '2018-03-05 11:49:19', NULL);

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
(1, 3, 1, 1, '1', '2018-03-05 12:50:47'),
(2, 21, 18, 1, '1', '2018-03-09 10:01:02'),
(3, 1, 1, 1, '1', '2018-03-12 13:22:20');

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
(2, 'max digital services', 4, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-03-19 06:09:48', 57, '2018-03-19 06:29:02', NULL),
(3, 'even real estate', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-03-19 06:13:12', 58, '2018-03-19 06:29:09', NULL);

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
(6, 'Utility Company', '0', '2017-12-12 11:00:00', 1, '2018-03-07 05:59:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_request_emails`
--

CREATE TABLE `company_request_emails` (
  `id` int(10) NOT NULL,
  `comapny_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `invitation_id` int(10) NOT NULL,
  `email_send_status` enum('0','1') NOT NULL COMMENT '0: Initial, 1 : Email sent',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_request_emails`
--

INSERT INTO `company_request_emails` (`id`, `comapny_id`, `client_id`, `invitation_id`, `email_send_status`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 3, '0', '2018-02-27 18:12:56', '2018-02-27 13:17:11'),
(2, 11, 1, 3, '0', '2018-02-27 18:15:06', '2018-02-27 12:45:06'),
(3, 7, 1, 3, '0', '2018-02-27 18:16:53', '2018-02-27 12:46:53'),
(4, 8, 1, 3, '0', '2018-02-27 18:16:53', '2018-02-27 12:46:53'),
(5, 9, 1, 3, '0', '2018-02-27 18:18:49', '2018-02-27 12:48:49'),
(6, 10, 1, 3, '0', '2018-03-12 13:58:02', '2018-03-12 08:28:02'),
(7, 10, 1, 3, '0', '2018-03-12 13:58:02', '2018-03-12 08:28:02'),
(8, 10, 1, 3, '0', '2018-03-12 13:58:02', '2018-03-12 08:28:02'),
(9, 10, 1, 3, '0', '2018-03-12 13:58:02', '2018-03-12 08:28:02'),
(10, 10, 1, 3, '0', '2018-03-12 13:58:03', '2018-03-12 08:28:03'),
(11, 10, 1, 3, '0', '2018-03-12 13:58:03', '2018-03-12 08:28:03'),
(12, 10, 1, 3, '0', '2018-03-12 14:00:59', '2018-03-12 08:30:59'),
(13, 10, 1, 3, '0', '2018-03-12 14:00:59', '2018-03-12 08:30:59'),
(14, 10, 1, 3, '0', '2018-03-12 14:00:59', '2018-03-12 08:30:59'),
(15, 10, 1, 3, '0', '2018-03-12 14:00:59', '2018-03-12 08:30:59'),
(16, 10, 1, 3, '0', '2018-03-12 14:00:59', '2018-03-12 08:30:59'),
(17, 10, 1, 3, '0', '2018-03-12 14:00:59', '2018-03-12 08:30:59'),
(18, 10, 1, 3, '0', '2018-03-12 14:15:33', '2018-03-12 08:45:33'),
(19, 1, 1, 1, '0', '2018-03-13 12:16:56', '2018-03-13 06:46:56'),
(20, 2, 1, 1, '0', '2018-03-13 12:25:25', '2018-03-13 06:55:25'),
(21, 3, 1, 1, '0', '2018-03-13 12:28:30', '2018-03-13 06:58:30'),
(22, 4, 1, 1, '0', '2018-03-13 12:31:51', '2018-03-13 07:01:51'),
(23, 1, 1, 1, '0', '2018-03-15 16:53:15', '2018-03-15 11:23:15'),
(24, 2, 1, 1, '0', '2018-03-15 16:54:02', '2018-03-15 11:24:02'),
(25, 3, 1, 1, '0', '2018-03-15 16:54:47', '2018-03-15 11:24:47'),
(26, 4, 1, 1, '0', '2018-03-15 16:55:45', '2018-03-15 11:25:45'),
(27, 1, 1, 1, '0', '2018-03-16 16:03:29', '2018-03-16 10:33:29'),
(28, 1, 1, 1, '0', '2018-03-16 17:40:51', '2018-03-16 12:10:51');

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
(2, 57),
(3, 58);

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
  `discount` float(10,2) DEFAULT NULL,
  `comment` text,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `email_sent_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=email not sent, 1=email sent',
  `company_response` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: No response yet, 1: response assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `template_content_to_send` longtext NOT NULL,
  `template_content_to_view` longtext NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `category_id`, `template_name`, `template_content_to_send`, `template_content_to_view`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'template 1', '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"min-width: 320px; font-size: 18px;\">\n							<tbody><tr>\n								<td align=\"center\" bgcolor=\"#eff3f8\" style=\"padding-bottom: 40px;\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_width_100\" width=\"100%\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\" data-original-title=\"\" title=\"\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin-top:20px;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table_editable\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id <b>est laborum.</b></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin:20px 0;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td align=\"center\" style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 800px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"min-width: 320px; font-size: 18px;\">\n							<tbody><tr>\n								<td align=\"center\" bgcolor=\"#eff3f8\" style=\"padding-bottom: 40px;\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_width_100\" width=\"100%\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\" data-original-title=\"\" title=\"\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin-top:20px;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table_editable\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id <b>est laborum.</b></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin:20px 0;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td align=\"center\" style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-19 17:12:52', 58, '2018-03-19 11:42:52', NULL);

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
  `discount` float(10,2) DEFAULT NULL,
  `comment` text,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `email_sent_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=email not sent, 1=email sent',
  `company_response` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: No response yet, 1: response assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 9, '2018-03-07 08:29:28', 1),
(2, 31, '2018-03-07 05:46:14', 2),
(3, 36, '2018-03-09 09:29:49', 0),
(4, 41, '2018-03-12 13:19:03', 1),
(5, 45, '2018-03-15 10:54:56', 2),
(6, 51, '2018-03-16 10:15:24', 0),
(7, 53, '2018-03-16 10:30:31', 0),
(8, 58, '2018-03-19 11:07:36', 1);

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
  `insurance_amount` float(10,2) DEFAULT NULL,
  `callback_option` enum('0','1') NOT NULL COMMENT '0: No, 1: Yes',
  `callback_time` enum('0','1','2') DEFAULT NULL COMMENT '0: Anytime, 1: Daytime, 2: Evening',
  `primary_no` varchar(20) DEFAULT NULL,
  `secondary_no` varchar(20) DEFAULT NULL,
  `moving_date` date NOT NULL,
  `additional_information` text NOT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `comment` text,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `email_sent_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=email not sent, 1=email sent',
  `company_response` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: No response yet, 1: response assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
('mayank1234@gmail.com', '$2y$10$O6M5XxDYSJgwePwMrJcY6.M7sc9XkwvVq0MB0ji6jbg.KLrfgXDYy', '2018-02-22 09:48:05'),
('mayank1234@gmail.com', '$2y$10$K88u50nggCgpnM/277nLruBjKs9obocC8y04fAPAnrLY62EorWBcy', '2018-02-22 09:48:20');

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
  `trial_plan` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_plans`
--

INSERT INTO `payment_plans` (`id`, `plan_type_id`, `plan_name`, `plan_charges`, `discount`, `validity_days`, `allowed_count`, `trial_plan`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'payment plan 1', '50.00', '5.00', 30, 100, '0', '1', '2017-11-10 08:38:00', 1, '2017-11-15 11:25:17', 1),
(2, 1, 'payment plan 2', '120.00', '10.00', 60, 200, '0', '1', '2017-11-10 08:38:35', 1, '2017-11-15 11:25:32', 1),
(3, 1, 'payment plan 3', '150.00', '10.00', 90, 500, '0', '1', '2017-11-15 09:45:37', 1, '2017-11-15 09:45:37', NULL),
(4, 2, 'Company Plan 1', '0.75', '0.00', 30, 20, '0', '1', '2017-12-19 07:43:37', 1, '2017-12-19 07:43:37', NULL),
(5, 2, 'Company Plan 2', '1.00', '0.00', 30, 50, '0', '1', '2017-12-19 11:51:15', 1, '2017-12-19 11:51:15', NULL),
(6, 2, 'Company Trial Plan', '0.00', '0.00', 60, 0, '1', '1', '2018-02-06 12:55:32', 1, '2018-03-06 12:42:39', 1),
(8, 1, 'agent trial plan', '0.00', '0.00', 60, 0, '1', '1', '2018-03-06 12:38:39', 1, '2018-03-06 12:42:20', 1);

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
(1, 6, 2, 2, '2018-03-19', '2018-05-18', 0, 0, '1', '2018-03-19 06:09:48'),
(2, 8, 1, 58, '2018-03-19', '2018-05-18', 0, 0, '0', '2018-03-19 06:29:32'),
(3, 8, 1, 58, '2018-03-19', '2018-05-18', 0, -1, '1', '2018-03-19 11:42:52');

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
-- Table structure for table `payment_transaction_details`
--

CREATE TABLE `payment_transaction_details` (
  `id` int(11) NOT NULL,
  `service_request_response_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `company_category_id` int(10) NOT NULL,
  `payment_against` varchar(100) DEFAULT NULL,
  `invoice_no` varchar(20) NOT NULL COMMENT 'invoice_no generated by our system on which we get the response from IPN',
  `address_city` varchar(50) DEFAULT NULL,
  `address_country` varchar(50) DEFAULT NULL,
  `address_country_code` varchar(50) DEFAULT NULL,
  `address_name` varchar(50) DEFAULT NULL,
  `address_state` varchar(50) DEFAULT NULL,
  `address_status` varchar(50) DEFAULT NULL,
  `address_street` varchar(200) DEFAULT NULL,
  `address_zip` varchar(10) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `ipn_track_id` varchar(20) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_number` varchar(20) DEFAULT NULL,
  `mc_currency` varchar(10) DEFAULT NULL,
  `mc_gross` decimal(10,2) DEFAULT NULL,
  `notify_version` varchar(10) DEFAULT NULL,
  `payer_email` varchar(100) DEFAULT NULL,
  `payer_id` varchar(20) DEFAULT NULL,
  `payer_status` varchar(20) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_gross` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `pending_reason` varchar(50) DEFAULT NULL,
  `protection_eligibility` varchar(20) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `receiver_email` varchar(100) DEFAULT NULL,
  `residence_country` varchar(10) DEFAULT NULL,
  `txn_id` varchar(20) NOT NULL,
  `transaction_subject` varchar(20) NOT NULL,
  `txn_type` varchar(20) NOT NULL,
  `verify_sign` varchar(50) NOT NULL,
  `company_payment_released` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0: Pending, 2: Requested, 1: Paid',
  `mover_payment_released` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: Not approved, 1: Approved',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-post', 'Create Posts', 'create new blog posts', '2018-02-17 09:02:53', '2018-02-17 09:02:53'),
(2, 'edit-user', 'Edit Users', 'edit existing users', '2018-02-17 09:14:51', '2018-02-17 09:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(2, 1, 'App\\User');

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
  `agency_type` enum('1','2') NOT NULL COMMENT '1: Provincial Agencies, 2: Provincial Utility',
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

INSERT INTO `provincial_agency_details` (`id`, `province_id`, `agency_type`, `agency_name`, `label1`, `label2`, `label3`, `label4`, `label5`, `label6`, `label7`, `label8`, `label9`, `label10`, `heading1`, `detail1`, `heading2`, `detail2`, `heading3`, `detail3`, `heading4`, `detail4`, `link`, `logo`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 9, '1', 'Health agency', 'Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5', 'Label 6', 'Label 7', 'Label 8', 'Label 9', 'Label 10', 'Heading 1', 'Detail 1', 'Heading 2', 'Detail 2', 'Heading 3', 'Detail 3', 'Heading 4', 'Detail 4', 'https://www.google.co.in/?gfe_rd=cr&dcr=0&ei=DiVXWvrNO9OL8Qek25SoAw', 'NKPYYP4C23UIWYXrBVdpVe7mGKlFWMsUwNL8pnkQ.jpg', '1', '2018-01-11 14:26:22', 1, '2018-01-11 08:56:22', NULL),
(2, 3, '1', 'Manitoba Health', 'Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5', 'Label 6', 'Label 7', 'Label 8', 'Label 9', 'Label 10', 'Heading 1', 'Detail 1', 'Heading 2', 'Detail 2', 'Heading 3', 'Detail 3', 'Heading 4', 'Detail 4', 'https://www.google.co.in/?gfe_rd=cr&dcr=0&ei=DiVXWvrNO9OL8Qek25SoAw', '5KnLwWMVfVOtw8lx7JyvXzuu1YfWgsGsmmyHrFC6.jpg', '1', '2018-01-11 14:34:20', 1, '2018-02-06 10:00:36', 23),
(3, 3, '2', 'Water Agency', 'label 1', 'label 2', 'label 3', 'label 4', 'label 5', 'label 6', 'label 7', 'label 8', 'label 9', 'label 10', 'heading 1', 'detail 1', 'heading 2', 'detail 2', 'heading 3', 'detail 3', 'heading 4', 'detail 4', 'https://www.google.co.in/', NULL, '1', '2018-02-06 16:08:57', 23, '2018-02-06 11:07:15', 23);

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
(16, 9, 1, 4, '1', '2018-01-23 11:32:44'),
(17, 10, 1, 6, '1', '2018-02-21 16:52:31'),
(18, 11, 1, 1, '1', '2018-02-21 17:06:55'),
(19, 9, 1, 1, '1', '2018-02-21 17:15:07'),
(20, 11, 1, 1, '1', '2018-02-21 17:21:45'),
(21, 10, 1, 6, '1', '2018-02-21 17:37:55'),
(22, 10, 1, 6, '1', '2018-02-21 17:37:55'),
(23, 11, 1, 1, '1', '2018-02-21 17:39:27'),
(24, 11, 1, 1, '1', '2018-02-22 18:15:16'),
(25, 11, 1, 1, '1', '2018-02-22 18:17:57'),
(26, 11, 1, 1, '1', '2018-02-22 18:19:01'),
(27, 11, 1, 1, '1', '2018-02-22 18:33:56'),
(28, 11, 1, 1, '1', '2018-02-22 18:36:47'),
(29, 11, 1, 1, '1', '2018-02-22 18:37:36'),
(30, 10, 1, 6, '1', '2018-02-22 19:25:33'),
(31, 10, 1, 6, '1', '2018-02-22 19:25:33'),
(32, 10, 1, 6, '1', '2018-02-22 19:26:53'),
(33, 10, 1, 6, '1', '2018-02-22 19:26:53'),
(34, 10, 1, 6, '1', '2018-02-22 19:28:28'),
(35, 10, 1, 6, '1', '2018-02-22 19:28:28'),
(36, 10, 1, 6, '1', '2018-02-22 19:42:32'),
(37, 10, 1, 6, '1', '2018-02-22 19:43:12'),
(38, 9, 1, 1, '1', '2018-02-23 10:46:21'),
(39, 10, 1, 6, '1', '2018-02-23 11:21:01'),
(40, 11, 1, 1, '1', '2018-02-23 11:37:58'),
(41, 9, 1, 1, '1', '2018-02-23 12:15:46'),
(42, 10, 1, 6, '1', '2018-02-23 14:13:45'),
(43, 10, 1, 6, '1', '2018-02-23 15:21:51'),
(44, 10, 1, 6, '1', '2018-02-23 15:54:22'),
(45, 10, 1, 6, '1', '2018-02-26 11:21:20'),
(46, 10, 1, 6, '1', '2018-02-26 12:04:29'),
(47, 11, 1, 1, '1', '2018-02-26 12:50:17'),
(48, 11, 1, 1, '1', '2018-02-26 12:55:52'),
(49, 10, 1, 6, '1', '2018-02-26 14:06:03'),
(50, 11, 1, 1, '1', '2018-02-26 14:06:52'),
(51, 9, 1, 1, '1', '2018-02-26 14:08:17'),
(52, 9, 1, 1, '1', '2018-02-26 14:41:34'),
(53, 9, 1, 1, '1', '2018-02-26 14:54:45'),
(54, 9, 1, 1, '1', '2018-02-26 15:06:50'),
(55, 11, 1, 1, '1', '2018-02-26 15:13:23'),
(56, 11, 1, 1, '1', '2018-02-26 15:37:26'),
(57, 10, 1, 6, '1', '2018-02-26 19:30:47'),
(58, 11, 1, 1, '1', '2018-02-26 19:32:52'),
(59, 10, 1, 6, '1', '2018-02-26 19:34:49'),
(60, 11, 1, 1, '1', '2018-02-26 19:36:48'),
(61, 9, 1, 1, '1', '2018-02-26 20:03:14'),
(62, 9, 1, 1, '1', '2018-02-27 10:05:40'),
(63, 10, 1, 6, '1', '2018-02-27 11:05:58'),
(64, 11, 1, 1, '1', '2018-02-27 11:14:54'),
(65, 9, 1, 1, '1', '2018-02-27 11:25:06'),
(66, 10, 1, 6, '1', '2018-02-27 11:29:17'),
(67, 11, 1, 1, '1', '2018-02-27 11:29:50'),
(68, 9, 1, 1, '1', '2018-02-27 11:31:15'),
(69, 11, 1, 1, '1', '2018-02-27 16:48:18'),
(70, 10, 1, 6, '1', '2018-02-27 18:07:38'),
(71, 10, 1, 6, '1', '2018-02-27 18:10:50'),
(72, 10, 1, 6, '1', '2018-02-27 18:12:56'),
(73, 11, 1, 1, '1', '2018-02-27 18:15:06'),
(74, 9, 1, 1, '1', '2018-02-27 18:18:49'),
(75, 10, 1, 6, '1', '2018-03-12 13:58:02'),
(76, 10, 1, 6, '1', '2018-03-12 13:58:02'),
(77, 10, 1, 6, '1', '2018-03-12 13:58:02'),
(78, 10, 1, 6, '1', '2018-03-12 13:58:02'),
(79, 10, 1, 6, '1', '2018-03-12 13:58:03'),
(80, 10, 1, 6, '1', '2018-03-12 13:58:03'),
(81, 10, 1, 6, '1', '2018-03-12 14:00:59'),
(82, 10, 1, 6, '1', '2018-03-12 14:00:59'),
(83, 10, 1, 6, '1', '2018-03-12 14:00:59'),
(84, 10, 1, 6, '1', '2018-03-12 14:00:59'),
(85, 10, 1, 6, '1', '2018-03-12 14:00:59'),
(86, 10, 1, 6, '1', '2018-03-12 14:00:59'),
(87, 10, 1, 6, '1', '2018-03-12 14:15:33'),
(88, 1, 1, 6, '1', '2018-03-15 16:53:15'),
(89, 2, 1, 6, '1', '2018-03-15 16:54:02'),
(90, 4, 1, 6, '1', '2018-03-15 16:55:45'),
(91, 1, 1, 6, '1', '2018-03-16 16:03:29'),
(92, 1, 1, 6, '1', '2018-03-16 17:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `mover_id` int(11) UNSIGNED NOT NULL,
  `service_request_response_id` int(10) NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Inactive, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `response_time_slots`
--

CREATE TABLE `response_time_slots` (
  `id` int(11) NOT NULL,
  `slot_title` varchar(50) NOT NULL,
  `slot_time` int(10) NOT NULL COMMENT 'In minutes',
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `response_time_slots`
--

INSERT INTO `response_time_slots` (`id`, `slot_title`, `slot_time`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'time slot 1', 180, '1', '2018-02-27 12:49:35', 1, '2018-02-27 09:19:43', NULL);

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
(2, 57, 'App\\User'),
(3, 58, 'App\\User');

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
(1, 1, 11, '1.50', '0.00', '2.40', '4.50', '0.00', '10.00', '33.90', '29.40', 'test', '2018-02-21 17:40:45', 24, '2018-02-21 12:10:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `share_announcement_emails`
--

CREATE TABLE `share_announcement_emails` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email_content` text NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Initial, 1: Send, 2: Denied',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_announcement_emails`
--

INSERT INTO `share_announcement_emails` (`id`, `email`, `email_content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mayankpandey49@gmail.com', '<table class=\"table\" style=\"text-align: center;\">\n		      			<tbody><tr>\n		      				<td>\n		      					<div contenteditable=\"true\">\n		      						The Mayank Pandey are moving!\n		      						<div class=\"announcement_message\">\n										<div class=\"hi_hello\">Hi friends</div>\n										<p>we are moving from South to North.</p>\n										<p>Stop by Saturday night for a housewarming party!</p>\n										<p>With love from</p>\n										<div class=\"announc_Client_name\">Mayank Pandey</div>\n									</div>\n		      					</div>\n		      				</td>\n		      			</tr>\n		      		</tbody></table>\n		      		<table class=\"table\">\n		      			<tbody><tr>\n		      				<td>\n		      					<div style=\"text-align: center;\">\n		      						<img src=\"http://localhost/udistro/public/images/company/Asdfgh.png\" height=\"60px\" width=\"60px\" alt=\"Udistro\">\n		      					</div>\n		      					<div class=\"company-Details\" style=\"text-align: center;\">\n		      						Abc Company\n		      					</div>\n		      					<div class=\"company-Details\" style=\"text-align: center;\">\n		      						, Quebec, Cap-Santé, RTR 301\n		      					</div>\n		      				</td>\n		      				<td>\n		      					<div style=\"text-align: center;\">\n		      					<img src=\"http://localhost/udistro/public/images/agents/bZg87BpIAf.jpg\" class=\"user-avtar\" alt=\"Udistro\" height=\"50px\" width=\"50px\">\n		      				</div>\n		      					<div class=\"client-Details\" style=\"text-align: center;\">\n		      						Mack Manon\n		      					</div>\n		      				</td>\n		      			</tr>\n		      		</tbody></table>', '0', '2018-03-05 14:32:56', '2018-03-05 09:02:56'),
(2, 'pandeyz@yahoo.in', '<table class=\"table\" style=\"text-align: center;\">\n		      			<tbody><tr>\n		      				<td>\n		      					<div contenteditable=\"true\">\n		      						The Mayank Pandey are moving!\n		      						<div class=\"announcement_message\">\n										<div class=\"hi_hello\">Hi friends</div>\n										<p>we are moving from South to North.</p>\n										<p>Stop by Saturday night for a housewarming party!</p>\n										<p>With love from</p>\n										<div class=\"announc_Client_name\">Mayank Pandey</div>\n									</div>\n		      					</div>\n		      				</td>\n		      			</tr>\n		      		</tbody></table>\n		      		<table class=\"table\">\n		      			<tbody><tr>\n		      				<td>\n		      					<div style=\"text-align: center;\">\n		      						<img src=\"http://localhost/udistro/public/images/company/Asdfgh.png\" height=\"60px\" width=\"60px\" alt=\"Udistro\">\n		      					</div>\n		      					<div class=\"company-Details\" style=\"text-align: center;\">\n		      						Abc Company\n		      					</div>\n		      					<div class=\"company-Details\" style=\"text-align: center;\">\n		      						, Quebec, Cap-Santé, RTR 301\n		      					</div>\n		      				</td>\n		      				<td>\n		      					<div style=\"text-align: center;\">\n		      					<img src=\"http://localhost/udistro/public/images/agents/bZg87BpIAf.jpg\" class=\"user-avtar\" alt=\"Udistro\" height=\"50px\" width=\"50px\">\n		      				</div>\n		      					<div class=\"client-Details\" style=\"text-align: center;\">\n		      						Mack Manon\n		      					</div>\n		      				</td>\n		      			</tr>\n		      		</tbody></table>', '0', '2018-03-05 14:32:56', '2018-03-05 09:02:56');

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
  `discount` float(10,2) DEFAULT NULL,
  `comment` text,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `email_sent_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=email not sent, 1=email sent',
  `company_response` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: No response yet, 1: response assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'admin@udistro.com', NULL, 'admin', '', '', NULL, NULL, NULL, NULL, NULL, '$2y$10$M.pFE2TlBClEjdmbNBmDN.oPPJ/g02EywCQ3K8xC2HINUOebrdRam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1reGn6p5FxSrEJYiRYK4wjPEbalFBEl3Vj6vdui4zVZh9wb17DwbbeQ7VUQI', '2018-03-19 18:59:03', '1', NULL, 0, NULL, NULL, NULL, '2017-10-26 06:30:00', 0, '2018-03-19 13:29:03', 0),
(57, 'mayankpandey@virtualemployee.com', 'manager', 'max', 'rick', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, '$2y$10$eVAXuSW0Y80AWntx7UwO9eYKih0ulrVpb34yheY2cCi6zeJDIDzJu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, NULL, '2018-03-19 06:09:48', NULL, '2018-03-19 06:30:12', 1),
(58, 'even@gmail.com', 'manager', 'even', 'rock', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, '$2y$10$eRzh73u/3Zk5R3/5C8XJPeuWSwGweA4fSyfmqH95O.xX7hSIo.6LO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nLIXGEgmIDC1dj9HUOYJXLD2pUS4Zr2DUG2gjIbiOvMszvzVHPl0y5MzQecs', '2018-03-19 16:37:36', '1', NULL, 0, NULL, NULL, NULL, '2018-03-19 06:13:12', NULL, '2018-03-19 11:07:36', 1);

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
-- Indexes for table `agent_partners`
--
ALTER TABLE `agent_partners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `agent_partner_digital_additional_service_type_requests`
--
ALTER TABLE `agent_partner_digital_additional_service_type_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_partner_digital_service_requests`
--
ALTER TABLE `agent_partner_digital_service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_partner_digital_service_type_requests`
--
ALTER TABLE `agent_partner_digital_service_type_requests`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `company_request_emails`
--
ALTER TABLE `company_request_emails`
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
-- Indexes for table `payment_transaction_details`
--
ALTER TABLE `payment_transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

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
  ADD KEY `fk_agent_id` (`company_id`),
  ADD KEY `fk_user_id` (`mover_id`);

--
-- Indexes for table `response_time_slots`
--
ALTER TABLE `response_time_slots`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `share_announcement_emails`
--
ALTER TABLE `share_announcement_emails`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `agent_client_invites`
--
ALTER TABLE `agent_client_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_client_moving_from_addresses`
--
ALTER TABLE `agent_client_moving_from_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_client_moving_to_addresses`
--
ALTER TABLE `agent_client_moving_to_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_client_ratings`
--
ALTER TABLE `agent_client_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_partners`
--
ALTER TABLE `agent_partners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_partner_digital_additional_service_type_requests`
--
ALTER TABLE `agent_partner_digital_additional_service_type_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_partner_digital_service_requests`
--
ALTER TABLE `agent_partner_digital_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_partner_digital_service_type_requests`
--
ALTER TABLE `agent_partner_digital_service_type_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_activity_lists`
--
ALTER TABLE `client_activity_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `client_activity_logs`
--
ALTER TABLE `client_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `company_categories`
--
ALTER TABLE `company_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `company_request_emails`
--
ALTER TABLE `company_request_emails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `digital_service_requests`
--
ALTER TABLE `digital_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `digital_service_types`
--
ALTER TABLE `digital_service_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `digital_service_type_requests`
--
ALTER TABLE `digital_service_type_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_lists`
--
ALTER TABLE `email_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `home_cleaning_other_places`
--
ALTER TABLE `home_cleaning_other_places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `home_cleaning_other_place_service_requests`
--
ALTER TABLE `home_cleaning_other_place_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `home_cleaning_service_requests`
--
ALTER TABLE `home_cleaning_service_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `home_cleaning_steaming_services`
--
ALTER TABLE `home_cleaning_steaming_services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `home_cleaning_steaming_service_requests`
--
ALTER TABLE `home_cleaning_steaming_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hookup_services`
--
ALTER TABLE `hookup_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `moving_item_service_requests`
--
ALTER TABLE `moving_item_service_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `moving_other_item_services`
--
ALTER TABLE `moving_other_item_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `moving_other_item_service_requests`
--
ALTER TABLE `moving_other_item_service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `moving_transportations`
--
ALTER TABLE `moving_transportations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `moving_transportation_type_requests`
--
ALTER TABLE `moving_transportation_type_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_plans`
--
ALTER TABLE `payment_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment_plan_subscriptions`
--
ALTER TABLE `payment_plan_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payment_plan_types`
--
ALTER TABLE `payment_plan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_transaction_details`
--
ALTER TABLE `payment_transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `provincial_agency_details`
--
ALTER TABLE `provincial_agency_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quotation_logs`
--
ALTER TABLE `quotation_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `response_time_slots`
--
ALTER TABLE `response_time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `service_request_responses`
--
ALTER TABLE `service_request_responses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `share_announcement_emails`
--
ALTER TABLE `share_announcement_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tech_concierge_other_details`
--
ALTER TABLE `tech_concierge_other_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tech_concierge_other_detail_service_requests`
--
ALTER TABLE `tech_concierge_other_detail_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tech_concierge_places`
--
ALTER TABLE `tech_concierge_places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tech_concierge_place_service_requests`
--
ALTER TABLE `tech_concierge_place_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tech_concierge_service_requests`
--
ALTER TABLE `tech_concierge_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
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
  ADD CONSTRAINT `fk_agent_id` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`mover_id`) REFERENCES `users` (`id`);

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
