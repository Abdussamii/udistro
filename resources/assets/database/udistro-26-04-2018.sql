-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2018 at 02:39 PM
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
  `possession_date` date NOT NULL,
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

INSERT INTO `agent_clients` (`id`, `agent_id`, `fname`, `lname`, `oname`, `email`, `contact_number`, `possession_date`, `moving_from_id`, `moving_to_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 58, 'mayank', 'pandey', '', 'mayankpandey@virtualemployee.com', '8518067700', '2018-03-28', NULL, NULL, '1', '2018-03-21 11:13:41', 58, '2018-03-28 10:56:14', NULL),
(2, 58, 'max', 'pandeyz', '', 'mayankpandey49@gmail.com', '8518067710', '2018-03-28', NULL, NULL, '1', '2018-03-21 11:14:12', 58, '2018-03-28 10:56:07', NULL),
(3, 58, 'mike', 'tin', NULL, 'miketin@gmail.com', '7896541230', '2018-05-31', NULL, NULL, '1', '2018-03-22 12:34:12', NULL, '2018-03-28 10:56:51', NULL),
(4, 58, 'ajit', 'singh', '', 'ajit12@gmail.com', '9876543210', '2018-04-30', NULL, NULL, '1', '2018-03-28 10:23:23', 58, '2018-04-10 07:27:45', 58);

-- --------------------------------------------------------

--
-- Table structure for table `agent_client_invites`
--

CREATE TABLE `agent_client_invites` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL,
  `message_content` longtext NOT NULL,
  `email_url` text,
  `schedule_status` enum('0','1') NOT NULL COMMENT '0: Send Immediately, 1: Schedule it for later',
  `schedule_date` date DEFAULT NULL COMMENT 'Schedule email datetime',
  `authentication` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1','2','3') NOT NULL COMMENT 'Email Life Cycle: 0: Initial, 1: Send, 2: Read, 3: Expire',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `agent_client_invites`
--

INSERT INTO `agent_client_invites` (`id`, `agent_id`, `client_id`, `email_template_id`, `message_content`, `email_url`, `schedule_status`, `schedule_date`, `authentication`, `status`, `created_at`, `created_by`, `updated_at`) VALUES
(1, 58, 1, 1, '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"min-width: 320px; font-size: 18px;\">\n							<tbody><tr>\n								<td align=\"center\" bgcolor=\"#eff3f8\" style=\"padding-bottom: 40px;\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_width_100\" width=\"100%\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin-top:20px;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table_editable\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear Mayank,\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin:20px 0;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td align=\"center\" style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\">\n											<a id=\"get_started_link\" href=\"http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=MQ==&invitation_id=MQ==\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 800px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', 'http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=MQ==&invitation_id=MQ==', '0', NULL, '1', '1', '2018-03-21 17:13:40', 58, '2018-03-26 07:10:28'),
(2, 58, 2, 1, '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"min-width: 320px; font-size: 18px;\">\n							<tbody><tr>\n								<td align=\"center\" bgcolor=\"#eff3f8\" style=\"padding-bottom: 40px;\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_width_100\" width=\"100%\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin-top:20px;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table_editable\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear Max,\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin:20px 0;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td align=\"center\" style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\">\n											<a id=\"get_started_link\" href=\"http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=Mg==&invitation_id=Mg==\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 800px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', 'http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=Mg==&invitation_id=Mg==', '0', NULL, '1', '0', '2018-03-21 17:14:42', 58, '2018-04-03 06:52:09'),
(3, 58, 3, 1, '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"min-width: 320px; font-size: 18px;\">\n							<tbody><tr>\n								<td align=\"center\" bgcolor=\"#eff3f8\" style=\"padding-bottom: 40px;\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_width_100\" width=\"100%\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin-top:20px;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table_editable\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear Mike,\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin:20px 0;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td align=\"center\" style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\">\n											<a id=\"get_started_link\" href=\"http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=Mw==&invitation_id=Mw==\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 800px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', 'http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=Mw==&invitation_id=Mw==', '0', NULL, '1', '0', '2018-03-22 18:07:38', 58, '2018-04-25 05:28:52'),
(4, 58, 1, 8, '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/8gvwG1Lm10GIPro2jBj1.png\" style=\"max-width: 200px; max-height: 200px;\"><br></div>\n													</td>\n													\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear Mayank,\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=MQ==&invitation_id=NA==\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 200px; max-height: 200px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', 'http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=MQ==&invitation_id=NA==', '0', NULL, '0', '0', '2018-04-12 19:24:51', 58, '2018-04-12 13:54:51');
INSERT INTO `agent_client_invites` (`id`, `agent_id`, `client_id`, `email_template_id`, `message_content`, `email_url`, `schedule_status`, `schedule_date`, `authentication`, `status`, `created_at`, `created_by`, `updated_at`) VALUES
(5, 58, 1, 10, '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/NCYd27TSD8uboheQJXYx.jpg\" style=\"max-width: 150px; max-height: 150px;\"><br></div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear Mayank,\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		This is Even, your real estate agent. I know moving is tough. So I am happy to share uDistro with you. This application will help you to move everything you want to move including your mail and utility services. \n																		Just click the get started button to claim your invitation and begin checking things of your recommended moving lists.\n																		Plus this is completely free. It is part of my contribution to your move.\n																	</div>\n																</td>\n																<!-- <td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td> -->\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<!-- <tr>\n													<td>\n														<table>\n															<tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</table>\n													</td>\n												</tr> -->  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=MQ==&invitation_id=NQ==\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 150px; max-height: 150px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', 'http://localhost/udistro/public/movers/authenticate?agent_id=NTg=&client_id=MQ==&invitation_id=NQ==', '0', NULL, '0', '0', '2018-04-26 16:43:51', 58, '2018-04-26 11:13:51');

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
  `moving_from_house_type` varchar(20) DEFAULT NULL,
  `moving_from_floor` varchar(20) DEFAULT NULL,
  `moving_from_bedroom_count` varchar(20) DEFAULT NULL,
  `moving_from_property_type` varchar(20) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `agent_client_moving_from_addresses`
--

INSERT INTO `agent_client_moving_from_addresses` (`id`, `agent_client_id`, `address1`, `address2`, `province_id`, `city_id`, `postal_code`, `country_id`, `moving_from_house_type`, `moving_from_floor`, `moving_from_bedroom_count`, `moving_from_property_type`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, '53-125 Sekura Cres', '', 9, 103, 'N1R 8B4', 1, 'house', '1', '1', 'own', '1', '2018-03-21 16:47:36', 58, '2018-04-16 13:50:11', 58),
(2, 2, '83-1605 Summit Dr', '', 2, 37, 'V2E 2A5', 1, 'house', '1', '1', 'own', '1', '2018-03-21 16:48:15', 58, '2018-04-03 06:52:10', 58),
(3, 3, '45-45 Montcalm Dr', '', 9, 111, 'L9C 4B2', 1, 'house', '1', '1', 'own', '1', '2018-03-22 18:04:12', 58, '2018-04-25 05:28:52', 58);

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
  `moving_to_house_type` varchar(20) DEFAULT NULL,
  `moving_to_floor` varchar(20) DEFAULT NULL,
  `moving_to_bedroom_count` varchar(20) DEFAULT NULL,
  `moving_to_property_type` varchar(20) DEFAULT NULL,
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

INSERT INTO `agent_client_moving_to_addresses` (`id`, `agent_client_id`, `address1`, `address2`, `province_id`, `city_id`, `postal_code`, `country_id`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `moving_date`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, 'apartment/flat', '2', '2', 'rent', '2018-03-31', '1', '2018-03-21 16:47:36', 58, '2018-04-16 13:50:50', NULL),
(2, 2, '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, 'apartment/flat', '2', '2', 'rent', '2018-03-31', '1', '2018-03-21 16:48:15', 58, '2018-04-03 06:52:10', NULL),
(3, 3, '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, 'apartment/flat', '2', '2', 'rent', '2018-04-06', '1', '2018-03-22 18:04:12', 58, '2018-04-25 05:28:52', NULL);

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
(1, 1, 58, 1, 5, 'Hi Even Rock,I appreciate your work and want to say thank you.', '0', '2018-04-16 18:50:56');

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
  `availability_date1` date NOT NULL,
  `availability_time1` varchar(20) NOT NULL,
  `availability_date2` date NOT NULL,
  `availability_time2` varchar(20) NOT NULL,
  `availability_date3` date NOT NULL,
  `availability_time3` varchar(20) NOT NULL,
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
(7, 5),
(7, 7),
(7, 8),
(8, 3),
(8, 5),
(8, 7),
(9, 3),
(9, 5),
(9, 7),
(10, 3),
(10, 5),
(10, 7),
(11, 3),
(11, 5),
(11, 7),
(11, 8),
(12, 3),
(12, 5),
(12, 7),
(12, 8),
(13, 3),
(13, 5),
(13, 7),
(13, 8),
(14, 3),
(14, 5),
(14, 7),
(15, 6),
(15, 9),
(18, 6),
(18, 9),
(19, 6),
(19, 9),
(20, 4),
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
(388, 13, 'whitehorse', '1', '2017-11-22 19:00:00', 1, '2017-11-22 12:53:26', NULL),
(389, 3, 'West St Paul', '1', '2018-03-27 00:00:00', 1, '2018-03-27 08:27:04', NULL),
(390, 3, 'Oak Bluff', '1', '2018-03-27 00:00:00', 1, '2018-03-27 08:48:51', NULL),
(391, 3, 'Beausejour', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(392, 3, 'Altona', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(393, 3, 'Swan River', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(394, 3, 'Virden', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(395, 3, 'Narol', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(396, 3, 'Cartier', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(397, 3, 'Oak Bluff', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(398, 3, 'Headingley East', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(399, 3, 'Ste Anne', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(400, 3, 'Brandon North', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(401, 3, 'MacGregor', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(402, 3, 'Neepawa', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(403, 3, 'Killarney', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(404, 3, 'East St Paul', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(405, 3, 'St Francois Xavier', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(406, 3, 'Winkler', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(407, 3, 'Thompson', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(408, 3, 'Selkirk', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(409, 3, 'St Adolphe', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(410, 3, 'Morden', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(411, 3, 'Dauphin', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(412, 3, 'Steinbach', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(413, 3, 'The Pas', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(414, 3, 'Portage la Prairie', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(415, 3, 'Flin Flon', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(416, 3, 'Lorette', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(417, 3, 'Norway House', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(418, 3, 'Lockport', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(419, 3, 'Stonewall', '1', '2018-03-27 00:00:00', 1, '2018-03-27 09:08:31', NULL),
(420, 1, 'Airdrie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(421, 1, 'Athabasca', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(422, 1, 'Banff', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(423, 1, 'Barrhead', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(424, 1, 'Beaumont', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(425, 1, 'Blackfalds', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(426, 1, 'Bonnyville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(427, 1, 'Brooks', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(428, 1, 'Calgary', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(429, 1, 'Camrose', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(430, 1, 'Canmore', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(431, 1, 'Cardston', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(432, 1, 'Chestermere', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(433, 1, 'Claresholm', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(434, 1, 'Coaldale', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(435, 1, 'Cochrane', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(436, 1, 'Cold Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(437, 1, 'Devon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(438, 1, 'Drayton Valley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(439, 1, 'Drumheller', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(440, 1, 'Edmonton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(441, 1, 'Edson', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(442, 1, 'Fitzgerald', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(443, 1, 'Fort Chipewyan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(444, 1, 'Fort McMurray', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(445, 1, 'Fort Saskatchewan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(446, 1, 'Grande Prairie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(447, 1, 'High Level', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(448, 1, 'High River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(449, 1, 'Hinton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(450, 1, 'Innisfail', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(451, 1, 'Jasper', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(452, 1, 'Lacombe', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(453, 1, 'Leduc', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(454, 1, 'Lethbridge', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(455, 1, 'Lloydminster', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(456, 1, 'Medicine Hat', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(457, 1, 'Morinville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(458, 1, 'Okotoks', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(459, 1, 'Olds', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(460, 1, 'Peace River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(461, 1, 'Ponoka', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(462, 1, 'Red Deer', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(463, 1, 'Redwood Meadows', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(464, 1, 'Rocky Mountain House', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(465, 1, 'Rocky View', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(466, 1, 'Sherwood Park', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(467, 1, 'Slave Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(468, 1, 'Spruce Grove', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(469, 1, 'St. Albert', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(470, 1, 'St. Paul', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(471, 1, 'Stettler', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(472, 1, 'Stony Plain', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(473, 1, 'Strathmore', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(474, 1, 'Sundre', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(475, 1, 'Sylvan Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(476, 1, 'Taber', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(477, 1, 'Tofield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(478, 1, 'Vegreville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(479, 1, 'Vermilion', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(480, 1, 'Wainwright', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(481, 1, 'Westlock', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(482, 1, 'Wetaskiwin', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(483, 1, 'Whitecourt', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:38:16', NULL),
(484, 2, 'Abbotsford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(485, 2, '100 Mile House', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(486, 2, 'Agassiz', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(487, 2, 'Alexis Creek', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(488, 2, 'Atlin', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(489, 2, 'Burnaby', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(490, 2, 'Campbell River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(491, 2, 'Castlegar', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(492, 2, 'Cedar', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(493, 2, 'Central Saanich', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(494, 2, 'Chemainus', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(495, 2, 'Chilliwack', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(496, 2, 'Comox', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(497, 2, 'Coquitlam', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(498, 2, 'Courtenay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(499, 2, 'Cranbrook', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(500, 2, 'Dawson Creek', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(501, 2, 'Delta', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(502, 2, 'Duncan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(503, 2, 'Esquimalt', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(504, 2, 'Fernie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(505, 2, 'Fort Nelson', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(506, 2, 'Fort St. John', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(507, 2, 'Gold River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(508, 2, 'Golden', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(509, 2, 'Highlands', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(510, 2, 'Hope', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(511, 2, 'Kamloops', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(512, 2, 'Kelowna', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(513, 2, 'Kimberley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(514, 2, 'Kitimat', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(515, 2, 'Ladysmith', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(516, 2, 'Langley City', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(517, 2, 'Maple Ridge', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(518, 2, 'Merritt', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(519, 2, 'Metchosin', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(520, 2, 'Mission', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(521, 2, 'Nanaimo', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(522, 2, 'Nelson', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(523, 2, 'New Westminster', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(524, 2, 'North Vancouver', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(525, 2, 'Oak Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(526, 2, 'Parksville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(527, 2, 'Penticton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(528, 2, 'Pitt Meadows', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(529, 2, 'Port Alberni', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(530, 2, 'Port Coquitlam', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(531, 2, 'Port Edward', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(532, 2, 'Port Moody', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(533, 2, 'Powell River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(534, 2, 'Prince George', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(535, 2, 'Prince Rupert', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(536, 2, 'Qualicum Beach', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(537, 2, 'Queen Charlotte City', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(538, 2, 'Quesnel', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(539, 2, 'Revelstoke', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(540, 2, 'Richmond', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(541, 2, 'Rossland', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(542, 2, 'Saanich', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(543, 2, 'Salmon Arm', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(544, 2, 'Saltspring Island', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(545, 2, 'Sidney', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(546, 2, 'Smithers', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(547, 2, 'Sooke', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(548, 2, 'Sooke', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(549, 2, 'Squamish', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(550, 2, 'Summerland', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(551, 2, 'Surrey', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(552, 2, 'Terrace', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(553, 2, 'Trail', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(554, 2, 'Vancouver', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(555, 2, 'Vernon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(556, 2, 'Victoria', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(557, 2, 'West Vancouver', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(558, 2, 'Westbank', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(559, 2, 'Whistler', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(560, 2, 'White Rock', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(561, 2, 'Williams Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(562, 2, 'Winfield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:03', NULL),
(563, 3, 'Altona', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(564, 3, 'Beausejour', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(565, 3, 'Brandon North', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(566, 3, 'Cartier', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(567, 3, 'Dauphin', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(568, 3, 'East St. Paul', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(569, 3, 'Flin Flon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(570, 3, 'Headingley East', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(571, 3, 'Killarney', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(572, 3, 'Lockport', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(573, 3, 'Lorette', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(574, 3, 'MacGregor', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(575, 3, 'Morden', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(576, 3, 'Narol', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(577, 3, 'Neepawa', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(578, 3, 'Norway House', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(579, 3, 'Oak Bluff', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(580, 3, 'Portage la Prairie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(581, 3, 'Selkirk', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(582, 3, 'St. Adolphe', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(583, 3, 'St. Francois Xavier', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(584, 3, 'Ste. Anne', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(585, 3, 'Steinbach', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(586, 3, 'Stonewall', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(587, 3, 'Swan River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(588, 3, 'The Pas', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(589, 3, 'Thompson', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(590, 3, 'Virden', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(591, 3, 'West St. Paul', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(592, 3, 'Winkler', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(593, 3, 'Winnipeg', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:40:58', NULL),
(594, 4, 'Allardville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(595, 4, 'Apohaqui', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(596, 4, 'Baie-Sainte-Anne', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(597, 4, 'Baker Brook', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(598, 4, 'Balmoral', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(599, 4, 'Bass River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(600, 4, 'Bath', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(601, 4, 'Bathurst', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(602, 4, 'Bayfield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(603, 4, 'Belledune', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(604, 4, 'Beresford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(605, 4, 'Blackville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL);
INSERT INTO `cities` (`id`, `province_id`, `name`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(606, 4, 'Boiestown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(607, 4, 'Bouctouche', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(608, 4, 'Brantville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(609, 4, 'Burtts Corner', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(610, 4, 'Campbellton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(611, 4, 'Campobello Island', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(612, 4, 'Canterbury', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(613, 4, 'Cap-Pelé', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(614, 4, 'Caraquet', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(615, 4, 'Centreville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(616, 4, 'Cocagne', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(617, 4, 'Coverdale', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(618, 4, 'Dalhousie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(619, 4, 'Debec', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(620, 4, 'Deer Island', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(621, 4, 'Dieppe Moncton East', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(622, 4, 'Doaktown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(623, 4, 'Dorchester', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(624, 4, 'Durham Bridge', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(625, 4, 'Edmundston', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(626, 4, 'Florenceville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(627, 4, 'Fredericton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(628, 4, 'Gagetown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(629, 4, 'Grand Bay-Westfield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(630, 4, 'Grand Falls', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(631, 4, 'Grand Manan Island', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(632, 4, 'Grande-Anse', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(633, 4, 'Hampton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(634, 4, 'Hartland', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(635, 4, 'Harvey', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(636, 4, 'Hillsborough', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(637, 4, 'Inkerman', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(638, 4, 'Kedgwick', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(639, 4, 'Kingsclear', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(640, 4, 'Kingston', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(641, 4, 'Lakeville Shediac Bridge', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(642, 4, 'Lamèque', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(643, 4, 'Lepreau', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(644, 4, 'McAdam', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(645, 4, 'Millville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(646, 4, 'Minto', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(647, 4, 'Miramichi North', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(648, 4, 'Moncton Central', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(649, 4, 'Moores Mills', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(650, 4, 'Nackawic', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(651, 4, 'Neguac', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(652, 4, 'Norton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(653, 4, 'Oromocto', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(654, 4, 'Paquetville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(655, 4, 'Pennfield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(656, 4, 'Perth-Andover', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(657, 4, 'Petitcodiac', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(658, 4, 'Petit-Rocher', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(659, 4, 'Plaster Rock', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(660, 4, 'Quispamsis', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(661, 4, 'Red Bank', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(662, 4, 'Richibucto', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(663, 4, 'Riverview', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(664, 4, 'Rogersville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(665, 4, 'Rothesay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(666, 4, 'Sackville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(667, 4, 'Saint John Central', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(668, 4, 'Saint-Antoine', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(669, 4, 'Saint-Basile', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(670, 4, 'Saint-Isidore', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(671, 4, 'Saint-Jacques', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(672, 4, 'Saint-Leonard', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(673, 4, 'Saint-Quentin', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(674, 4, 'Salisbury', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(675, 4, 'Shediac', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(676, 4, 'Shippagan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(677, 4, 'Smiths Creek', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(678, 4, 'St. Andrews', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(679, 4, 'St. George', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(680, 4, 'St. Martins', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(681, 4, 'St. Stephen', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(682, 4, 'Stanley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(683, 4, 'St-Louis-de-Kent', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(684, 4, 'Sussex', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(685, 4, 'Tracadie-Sheila', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(686, 4, 'Woodstock', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(687, 4, 'Youngs Cove', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:41:52', NULL),
(688, 5, 'Argentia', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(689, 5, 'Bishops Falls', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(690, 5, 'Bonavista', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(691, 5, 'Carbonear', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(692, 5, 'Channel-Port aux Basques', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(693, 5, 'Churchill Falls', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(694, 5, 'Clarenville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(695, 5, 'Conception Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(696, 5, 'Corner Brook', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(697, 5, 'Deer Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(698, 5, 'Ferryland', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(699, 5, 'Gander', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(700, 5, 'Goulds', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(701, 5, 'Grand Falls', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(702, 5, 'Happy Valley-Goose Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(703, 5, 'Labrador City', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(704, 5, 'Lark Harbour', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(705, 5, 'Lewisporte', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(706, 5, 'Manuels', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(707, 5, 'Marys Harbour', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(708, 5, 'Marystown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(709, 5, 'Mount Pearl', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(710, 5, 'Paradise', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(711, 5, 'Portugal Cove-St. Philips', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(712, 5, 'Rogersville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(713, 5, 'Rothesay Quispamsis', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(714, 5, 'Sackville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(715, 5, 'Saint John Central', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(716, 5, 'Saint-Antoine', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(717, 5, 'Saint-Basile', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(718, 5, 'Saint-Isidore', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(719, 5, 'Saint-Jacques', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(720, 5, 'Saint-Leonard', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(721, 5, 'Saint-Quentin', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(722, 5, 'Salisbury', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(723, 5, 'Shediac', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(724, 5, 'Shippagan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(725, 5, 'Smiths Creek', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(726, 5, 'Springdale', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(727, 5, 'St. Andrews', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(728, 5, 'St. George', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(729, 5, 'St. Georges', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(730, 5, 'St. Johns', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(731, 5, 'St. Martins', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(732, 5, 'St. Stephen', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(733, 5, 'Stanley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(734, 5, 'Stephenville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(735, 5, 'St-Louis-de-Kent', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(736, 5, 'Sussex', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(737, 5, 'Torbay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(738, 5, 'Tracadie-Sheila', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(739, 5, 'Windsor', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(740, 5, 'Woodstock', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(741, 5, 'Youngs Cove', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:04', NULL),
(742, 6, 'Fort Simpson', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:52', NULL),
(743, 6, 'Yellowknife', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:52', NULL),
(744, 6, 'Inuvik', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:52', NULL),
(745, 6, 'Sachs Harbour', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:45:52', NULL),
(746, 7, 'Alder Point', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(747, 7, 'Amherst', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(748, 7, 'Antigonish', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(749, 7, 'Baddeck', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(750, 7, 'Bedford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(751, 7, 'Big Bras dOr', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(752, 7, 'Bridgewater', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(753, 7, 'Christmas Island', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(754, 7, 'Coldbrook', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(755, 7, 'Dartmouth', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(756, 7, 'Digby', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(757, 7, 'Dingwall', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(758, 7, 'Dominion', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(759, 7, 'East Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(760, 7, 'Eastern Passage', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(761, 7, 'Enfield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(762, 7, 'Eskasoni', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(763, 7, 'Fourchu', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(764, 7, 'Glace Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(765, 7, 'Halifax', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(766, 7, 'Harrietsfield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(767, 7, 'Havre Boucher', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(768, 7, 'Iona', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(769, 7, 'Kentville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(770, 7, 'Kingston', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(771, 7, 'Lakeside', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(772, 7, 'Lantz', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(773, 7, 'Loch Lomond', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(774, 7, 'Louisbourg', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(775, 7, 'Lower Sackville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(776, 7, 'Lunenburg', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(777, 7, 'Marion Bridge', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(778, 7, 'Middleton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(779, 7, 'New Germany', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(780, 7, 'New Glasgow', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(781, 7, 'New Waterford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(782, 7, 'North Sydney', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(783, 7, 'Pictou', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(784, 7, 'Port Hawkesbury', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(785, 7, 'Port Morien', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(786, 7, 'Porters Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(787, 7, 'Reserve Mines', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(788, 7, 'River Hébert', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(789, 7, 'Shelburne', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(790, 7, 'Shubenacadie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(791, 7, 'Springhill', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(792, 7, 'Sydney', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(793, 7, 'Tantallon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(794, 7, 'Truro', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(795, 7, 'Waverley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(796, 7, 'Weymouth', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(797, 7, 'Wolfville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(798, 7, 'Yarmouth', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:46:40', NULL),
(799, 8, 'Arctic Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(800, 8, 'Arviat', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(801, 8, 'Baker Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(802, 8, 'Cambridge Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(803, 8, 'Cape Dorset', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(804, 8, 'Chesterfield Inlet', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(805, 8, 'Clyde River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(806, 8, 'Coral Harbour', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(807, 8, 'Gjoa Haven', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(808, 8, 'Grise Fiord', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(809, 8, 'Hall Beach', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(810, 8, 'Igloolik', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(811, 8, 'Iqaluit', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(812, 8, 'Kimmirut', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(813, 8, 'Kugaaruk', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(814, 8, 'Kugluktuk', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(815, 8, 'Naujaat', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(816, 8, 'Pangnirtung', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(817, 8, 'Pond Inlet', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(818, 8, 'Qikiqtarjuaq', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(819, 8, 'Rankin Inlet', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(820, 8, 'Resolute', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(821, 8, 'Sanikiluaq', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(822, 8, 'Taloyoak', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(823, 8, 'Whale Cove', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:47:25', NULL),
(824, 9, 'Ajax', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(825, 9, 'Alexandria', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(826, 9, 'Alfred', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(827, 9, 'Angus', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(828, 9, 'Aurora', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(829, 9, 'Barrie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(830, 9, 'Belleville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(831, 9, 'Bobcaygeon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(832, 9, 'Bolton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(833, 9, 'Bowmanville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(834, 9, 'Brampton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(835, 9, 'Brockville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(836, 9, 'Burlington', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(837, 9, 'Caledon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(838, 9, 'Caledonia', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(839, 9, 'Campbellville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(840, 9, 'Coldwater', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(841, 9, 'Concord', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(842, 9, 'Cornwall', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(843, 9, 'Cumberland', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(844, 9, 'Deep River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(845, 9, 'Downtown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(846, 9, 'Elizabethtown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(847, 9, 'Fallingbrook', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(848, 9, 'Fonthill', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(849, 9, 'Fort Erie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(850, 9, 'Georgetown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(851, 9, 'Gloucester', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(852, 9, 'Gormley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(853, 9, 'Grimsby', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(854, 9, 'Hamilton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(855, 9, 'Inverary', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(856, 9, 'Kanata', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(857, 9, 'Kemptville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(858, 9, 'King City', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(859, 9, 'Kingston', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(860, 9, 'Kleinburg', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(861, 9, 'Manotick', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(862, 9, 'Maple', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(863, 9, 'Markham', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(864, 9, 'Mississauga', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(865, 9, 'Nepean', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(866, 9, 'Newmarket', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(867, 9, 'Oakville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(868, 9, 'Orillia', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(869, 9, 'Oro', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(870, 9, 'Orono', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(871, 9, 'Oshawa', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(872, 9, 'Ottawa', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(873, 9, 'Owen Sound', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(874, 9, 'Pembroke', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(875, 9, 'Peterborough', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(876, 9, 'Pickering', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(877, 9, 'Picton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(878, 9, 'Port Colborne', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(879, 9, 'Port Hope', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(880, 9, 'Prescott', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(881, 9, 'Queensville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(882, 9, 'Richmond Hill', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(883, 9, 'Russell', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(884, 9, 'Shelburne', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(885, 9, 'St. Catharines', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(886, 9, 'Stittsville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(887, 9, 'Stouffville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(888, 9, 'Sunderland', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(889, 9, 'Sutton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(890, 9, 'Thornhill', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(891, 9, 'Trenton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(892, 9, 'Waterdown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(893, 9, 'Waterdown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(894, 9, 'Welland', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(895, 9, 'Westminster Abbey', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(896, 9, 'Woodbridge', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:48:11', NULL),
(897, 10, 'Abrams Village', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(898, 10, 'Afton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(899, 10, 'Alberton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(900, 10, 'Alexandra', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(901, 10, 'Annandale-Little Pond-Howe Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(902, 10, 'Bedeque and Area', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(903, 10, 'Belfast', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(904, 10, 'Bonshaw', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(905, 10, 'Borden-Carleton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(906, 10, 'Brackley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(907, 10, 'Breadalbane', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(908, 10, 'Brudenell', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(909, 10, 'Cardigan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(910, 10, 'Central Kings', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(911, 10, 'Charlottetown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(912, 10, 'Clyde River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(913, 10, 'Cornwall', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(914, 10, 'Crapaud', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(915, 10, 'Darlington', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(916, 10, 'Eastern Kings', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(917, 10, 'Ellerslie-Bideford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(918, 10, 'Georgetown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(919, 10, 'Grand Tracadie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(920, 10, 'Greenmount-Montrose', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(921, 10, 'Hampshire', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(922, 10, 'Hazelbrook', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(923, 10, 'Hunter River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(924, 10, 'Kensington', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(925, 10, 'Kingston', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(926, 10, 'Kinkora', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(927, 10, 'Lady Slipper', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(928, 10, 'Linkletter', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(929, 10, 'Lorne Valley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(930, 10, 'Lot 11 and Area', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(931, 10, 'Lower Montague', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(932, 10, 'Malpeque Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(933, 10, 'Meadowbank', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(934, 10, 'Miltonvale Park', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(935, 10, 'Miminegash', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(936, 10, 'Miscouche', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(937, 10, 'Montague', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(938, 10, 'Morell', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(939, 10, 'Mount Stewart', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(940, 10, 'Murray Harbour', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(941, 10, 'Murray River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(942, 10, 'New Haven-Riverdale', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(943, 10, 'North Rustico', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(944, 10, 'North Rustico', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(945, 10, 'North Shore', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(946, 10, 'North Wiltshire', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(947, 10, 'Northport', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(948, 10, 'OLeary', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(949, 10, 'Pleasant Grove', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(950, 10, 'Sherbrooke', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(951, 10, 'Souris', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(952, 10, 'Souris West', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(953, 10, 'St. Felix', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(954, 10, 'St. Louis', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(955, 10, 'St. Nicholas', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(956, 10, 'St. Peters Bay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(957, 10, 'Stratford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(958, 10, 'Summerside', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(959, 10, 'Tignish', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(960, 10, 'Tignish Shore', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(961, 10, 'Tyne Valley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(962, 10, 'Union Road', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(963, 10, 'Valleyfield', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(964, 10, 'Victoria', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(965, 10, 'Warren Grove', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(966, 10, 'Wellington', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(967, 10, 'West River', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(968, 10, 'York', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:49:20', NULL),
(969, 11, 'Ahuntsic', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(970, 11, 'Akwesasne', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(971, 11, 'Alma', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(972, 11, 'Alouette', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(973, 11, 'Anjou', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(974, 11, 'Auteuil', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(975, 11, 'Baie-Comeau', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(976, 11, 'Baie-Trinité', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(977, 11, 'Beauport', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(978, 11, 'Cap-aux-Meules', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(979, 11, 'Cap-de-la-Madeleine', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(980, 11, 'Cartierville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(981, 11, 'Causapscal', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(982, 11, 'Centre-Sud', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(983, 11, 'Chambord', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(984, 11, 'Charlesbourg', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(985, 11, 'Chicoutimi', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(986, 11, 'Chomedey', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(987, 11, 'Côte-des-Neiges', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(988, 11, 'Côte-Saint-Luc', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(989, 11, 'Daveluyville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(990, 11, 'Disraeli', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(991, 11, 'Dolbeau-Mistassini', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(992, 11, 'Dollard-Des-Ormeaux', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(993, 11, 'Dorval', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(994, 11, 'Duvernay', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(995, 11, 'Fabreville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(996, 11, 'Forestville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(997, 11, 'Gaspé', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(998, 11, 'Grande-Vallée', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(999, 11, 'Grand-Mère', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1000, 11, 'Griffintown', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1001, 11, 'Hébertville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1002, 11, 'Jean-Talon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1003, 11, 'Jonquière', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1004, 11, 'La Pocatière', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1005, 11, 'Lac-Beauport', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1006, 11, 'Lachine ', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1007, 11, 'LAncienne-Lorette', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1008, 11, 'LaSalle', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1009, 11, 'Laterrière', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1010, 11, 'Laval-des-Rapides', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1011, 11, 'Laval-sur-le-Lac', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1012, 11, 'Les Îles-De-La-Madeleine', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1013, 11, 'Lévis', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1014, 11, 'LÎle-Bizard', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1015, 11, 'LÎle-Des-Soeurs', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1016, 11, 'LÎle-Dorval', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1017, 11, 'Mercier', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1018, 11, 'Métabetchouan-Lac-a-la-Croix', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1019, 11, 'Mont-Joli', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1020, 11, 'Montreal', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1021, 11, 'Mount Royal', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1022, 11, 'Nantes', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1023, 11, 'New Richmond', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1024, 11, 'Notre-Dame-de-GrÔce', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1025, 11, 'Outremont', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1026, 11, 'Parent', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1027, 11, 'Petite-Patrie', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1028, 11, 'Plateau Mont-Royal', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1029, 11, 'Pont-Viau', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1030, 11, 'Quebec City', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1031, 11, 'Rimouski', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1032, 11, 'Rivière-Des-Prairies', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1033, 11, 'Rivière-du-Loup', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1034, 11, 'Rosemont', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1035, 11, 'Sainte-Anne-De-Bellevue', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1036, 11, 'Sainte-Anne-Des-Monts', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1037, 11, 'Sainte-Catherine-de-la-Jacques-Cartier', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1038, 11, 'Sainte-Dorothée', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1039, 11, 'Sainte-Foy Northeast', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1040, 11, 'Sainte-Foy Southeast', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1041, 11, 'Sainte-Foy West', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1042, 11, 'Sainte-Geneviève', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1043, 11, 'Sainte-Luce', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1044, 11, 'Saint-Émile', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1045, 11, 'Sainte-Rose', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1046, 11, 'Saint-Etienne-De-Lauzon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1047, 11, 'Saint-Félicien', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1048, 11, 'Saint-Franþois', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1049, 11, 'Saint-Georges', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1050, 11, 'Saint-Jean-Chrysostome', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1051, 11, 'Saint-Joseph-De-Beauce', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1052, 11, 'Saint-Laurent', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1053, 11, 'Saint-Léonard', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1054, 11, 'Saint-Michel', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1055, 11, 'Saint-Prosper-De-Dorchester', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1056, 11, 'Saint-Redempteur', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1057, 11, 'Saint-Valère', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1058, 11, 'Saint-Vincent-de-Paul', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1059, 11, 'Santa Claus', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1060, 11, 'Schefferville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1061, 11, 'Sept-Îles', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1062, 11, 'Shawinigan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1063, 11, 'Stoneham-et-Tewkesbury', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1064, 11, 'Trois-Pistoles', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1065, 11, 'Trois-Rivières', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1066, 11, 'Val-Bélair', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1067, 11, 'Verdun', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1068, 11, 'Victoriaville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1069, 11, 'Ville Émard', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1070, 11, 'Villeray', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1071, 11, 'Vimont', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1072, 11, 'Warwick', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1073, 11, 'Westmount East', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:51:09', NULL),
(1074, 12, 'Assiniboia', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1075, 12, 'Battleford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1076, 12, 'Buena Vista', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1077, 12, 'Carlyle', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1078, 12, 'Creighton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1079, 12, 'Estevan', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1080, 12, 'Fort QuAppelle', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1081, 12, 'Humboldt', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1082, 12, 'Kindersley', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1083, 12, 'La Ronge', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1084, 12, 'Lloydminster', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1085, 12, 'Maple Creek', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1086, 12, 'Meadow Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1087, 12, 'Melfort', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1088, 12, 'Melville', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1089, 12, 'Moose Jaw', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1090, 12, 'North Battleford', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1091, 12, 'Prince Albert', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1092, 12, 'Regina', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1093, 12, 'Rm Of Sherwood', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1094, 12, 'Saskatoon', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1095, 12, 'Swift Current', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1096, 12, 'Ville Émard', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1097, 12, 'Villeray', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1098, 12, 'Vimont', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1099, 12, 'Warwick', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1100, 12, 'Westmount', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1101, 12, 'Weyburn', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1102, 12, 'Yorkton', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:02', NULL),
(1103, 13, 'Watson Lake', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:48', NULL),
(1104, 13, 'Dawson City', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:48', NULL),
(1105, 13, 'Whitehorse', '1', '2018-03-29 00:00:00', 1, '2018-03-29 05:52:48', NULL);

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
(1, 3, 3, 3, '0', '2018-03-23 16:14:14'),
(2, 3, 3, 10, '0', '2018-03-23 16:15:25');

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
  `tooltip_data` varchar(250) DEFAULT NULL,
  `tooltip_position` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To hold the activities list to be performed by the client' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `client_activity_lists`
--

INSERT INTO `client_activity_lists` (`id`, `activity`, `image_name`, `description`, `status`, `listing_event`, `activity_class`, `tooltip_data`, `tooltip_position`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'login', NULL, 'login', '1', '0', NULL, NULL, NULL, '2017-11-29 12:00:00', 1, '2017-11-29 07:06:23', NULL),
(2, 'forward mail', 'sq58QxAvV2pDiVhmbPfe2F3RlUF4ftgBV7QHV0FE.png', 'forward mail', '1', '1', 'forward_mail', 'This tool helps you get the peace of mind you deserve. Knowing you are not going to miss any important mail anymore.', 'top', '2017-11-29 12:00:00', 1, '2018-04-05 13:56:14', NULL),
(3, 'Mailbox Keys', 'hwhWdDzzZmfEmuF6z6FR1gqBlsk898RCqWulnurv.png', 'Mailbox Keys', '1', '1', 'mailbox_keys', 'This tool delivers a notice card at your doorstep. You can use the notice card to confirm the location and compartment number of your community mailbox.', 'top', '2017-11-29 12:00:00', 1, '2018-04-05 14:02:18', NULL),
(4, 'Update Address', 'RrUt2N6S1OqhKBQGZ2xqVuDqB6ZKwfXQ8WWuqO1H.png', 'Update Address', '1', '1', 'update_address', 'This tool allows you to updates your new address with infrequent mailers such as Canada Revenue Agency, Provincial Agencies, and License renewals', 'top', '2017-11-29 12:00:00', 1, '2018-04-05 14:06:09', NULL),
(5, 'Connect Utilities', 'u3R40GftyQ54HLfB2QA9RnjBamZNTwXJUpEFym0I.png', 'Connect Utilities', '1', '1', 'connect_utilities', 'This tool allows you to set up your electricity and natural gas accounts, get the city to deliver recycle carts at the new address before you move in.', 'top', '2017-11-29 12:00:00', 1, '2018-04-12 13:22:39', NULL),
(6, 'Cable & Internet Service', 'jjmjguQ8RBZUPkXBb6QMRzO7RGpIzxDyxGXfq8Pi.png', 'Cable & Internet Service', '0', '1', 'cable_internet_services', 'This tool allows you to set up your cable and internet service accounts, get the local cable company to install your cable and internet the very day you move in.', 'top', '2017-11-29 12:00:00', 1, '2018-04-13 09:38:43', NULL),
(7, 'Home Cleaning Service', 'brD8BEvbWCvLWIFG7ycThwjCXnAb19eBTAR0dYNF.png', 'Home Cleaning Service', '1', '1', 'home_cleaning_services', 'This tool allows you to hire a home cleaning service provider. Get a local cleaning company to clean your old address as soon as you move out.', 'top', '2017-11-29 12:00:00', 1, '2018-04-05 14:11:59', NULL),
(8, 'Moving Companies', 'xpEF7D0hE8xuPcmAo8dxeXRE5GpEq01vrX1XmV3K.png', 'Moving Companies', '1', '1', 'moving_companies', 'This tool allows you to hire a professional moving company to help you move. Get a local moving company to move your stuff over to your new home.', 'top', '2017-11-29 12:00:00', 1, '2018-04-05 14:13:49', NULL),
(9, 'Tech Concierge', '6G3Qfht9zFHTbib8x8Hqwd8pcIkXXnZhMVhyp1Bi.png', 'Tech Concierge', '1', '1', 'tech_concierge', 'This tool helps you do the installation works at your home. Hire a competent repair person, an installer to install all the appliances you bought.', 'top', '2017-11-29 12:00:00', 1, '2018-04-05 14:17:16', NULL),
(10, 'share announcement', '0DMqhQcEp6bF1TJ9vlDdtsFgXzEluEMnfYLyrZmK.png', 'share announcement', '1', '1', 'share_announcement', 'When it comes to happiness, our nearest and dearest really matters. Use this tool to share the news of your new home with friends and families. Not forgetting to drop a thank you note to your agents as well.', 'top', '2017-11-30 11:00:00', 1, '2018-04-05 14:35:52', NULL),
(11, 'Special Offer', 'gg6DI3mUIajKxp7iNGEwbgGD0FxgiZhUQnITjRzj.png', 'Special Offer', '1', '1', 'special_offer', 'Special Offer', 'top', '2018-04-13 05:22:43', 1, '2018-04-16 13:16:52', 1);

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
(1, 1, 1, 1, '1', '2018-04-25 11:30:15'),
(2, 1, 1, 2, '1', '2018-04-25 11:30:35'),
(3, 3, 3, 1, '1', '2018-04-26 11:44:18'),
(4, 3, 3, 2, '1', '2018-04-26 11:44:45');

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
  `profile` text COLLATE utf8mb4_unicode_ci COMMENT 'company related information',
  `guarantee_policy` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `companies` (`id`, `company_name`, `company_category_id`, `email`, `contact_number`, `fax`, `website`, `profile`, `guarantee_policy`, `address1`, `address2`, `province_id`, `city_id`, `postal_code`, `country_id`, `target_area`, `working_globally`, `availability_mode`, `facebook`, `google_plus`, `instagram`, `linkedin`, `skype`, `twitter`, `image`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'max digital services', 4, NULL, NULL, NULL, NULL, NULL, NULL, '63 Lark Ridge Way', NULL, 3, 80, 'R3Y 0V1', 1, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-01-01 06:09:48', 57, '2018-04-17 05:33:12', 57),
(3, 'even real estate', 1, NULL, NULL, NULL, NULL, NULL, NULL, '63 Lark Ridge Way', NULL, 3, 71, 'R3Y 0V1', 1, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 'YvuxPZb2Nz.png', '1', '2018-01-01 06:09:48', 58, '2018-04-17 05:33:17', 58),
(4, 'abu home cleaning services', 2, 'abuhome@gmail.com', '123456789', '', '', 'profile', '1', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, NULL, '1', '1', '', '', '', '', '', '', NULL, '1', '2018-01-01 06:09:48', 1, '2018-04-17 05:33:19', 59),
(5, 'rishabh moving company', 3, NULL, NULL, NULL, NULL, NULL, NULL, '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-01-01 06:09:48', 1, '2018-04-17 05:33:22', 60),
(6, 'alex tech concierge services', 5, 'alexclean@gmail.com', '123456789', '12345678', 'www.alexclean.com', 'my profile', '1', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2018-01-01 06:09:48', 1, '2018-04-17 05:33:24', 61);

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
(4, 'Internet & Cable Service provider', '0', '2017-12-12 11:00:00', 1, '2018-04-16 10:52:12', NULL),
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
(3, 58),
(4, 59),
(5, 60),
(6, 61);

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
  `availability_date1` date NOT NULL,
  `availability_time1` varchar(20) NOT NULL,
  `availability_date2` date NOT NULL,
  `availability_time2` varchar(20) NOT NULL,
  `availability_date3` date NOT NULL,
  `availability_time3` varchar(20) NOT NULL,
  `additional_information` text,
  `discount` float(10,2) DEFAULT NULL,
  `comment` text,
  `date_of_working` varchar(50) DEFAULT NULL COMMENT 'Working date selected by company',
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
(1, 1, 'template 1', '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"min-width: 320px; font-size: 18px;\">\n							<tbody><tr>\n								<td align=\"center\" bgcolor=\"#eff3f8\" style=\"padding-bottom: 40px;\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_width_100\" width=\"100%\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin-top:20px;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table_editable\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin:20px 0;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td align=\"center\" style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 800px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"min-width: 320px; font-size: 18px;\">\n							<tbody><tr>\n								<td align=\"center\" bgcolor=\"#eff3f8\" style=\"padding-bottom: 40px;\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_width_100\" width=\"100%\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin-top:20px;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table_editable\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"margin:20px 0;\">\n												<tbody><tr>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td align=\"center\" style=\"width: 33%; padding-left: 20px; padding-right: 20px;\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td align=\"center\" style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tbody><tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-21 17:11:33', 58, '2018-03-21 11:41:33', NULL),
(2, 1, 'test template 2', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/tNz6eRL1DzK2u25C9B9H.jpg\" style=\"max-width: 800px;\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 800px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 800px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/tNz6eRL1DzK2u25C9B9H.jpg\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-27 11:29:22', 58, '2018-03-27 05:59:22', NULL);
INSERT INTO `email_templates` (`id`, `category_id`, `template_name`, `template_content_to_send`, `template_content_to_view`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 1, 'test template 3', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/irphVZNI1ZApfhTBI7z4.jpg\" style=\"max-width: 250px; max-height: 250px;\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 250px; max-height: 250px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 250px; max-height: 250px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 250px; max-height: 250px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 250px; max-height: 250px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 250px; max-height: 250px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/irphVZNI1ZApfhTBI7z4.jpg\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-27 11:32:13', 58, '2018-03-27 06:02:13', NULL),
(4, 1, 'test template 4', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\" style=\"max-width: 350px; max-height: 350px;\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-27 11:33:22', 58, '2018-03-27 06:03:22', NULL);
INSERT INTO `email_templates` (`id`, `category_id`, `template_name`, `template_content_to_send`, `template_content_to_view`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(5, 1, 'test template 5', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\" style=\"max-width: 350px; max-height: 350px;\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-27 11:34:05', 58, '2018-03-27 06:04:05', NULL),
(6, 1, 'test template 6', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\" style=\"max-width: 350px; max-height: 350px;\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\"><br></div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-27 11:34:56', 58, '2018-03-27 06:04:56', NULL);
INSERT INTO `email_templates` (`id`, `category_id`, `template_name`, `template_content_to_send`, `template_content_to_view`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(7, 1, 'test template 7', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\" style=\"max-width: 350px; max-height: 350px;\"><br></div>\n																</td>\n																\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" style=\"max-width: 350px; max-height: 350px;\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"padding-bottom: 40px;\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click editable-unsaved\" style=\"text-align: justify; background-color: rgba(0, 0, 0, 0);\" data-original-title=\"\" title=\"\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/YsIHTeNsbBtjRAbOjFX6.jpg\"><br></div>\n																</td>\n																\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n							</tbody></table><table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Address\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Website\n										</div>\n									</td>\n									<td style=\"padding:20px 0; width: 33%;\" align=\"center\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable editable-click\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table width=\"80%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n								<tbody><tr>\n									<td colspan=\"3\" style=\"border-top:1px solid #d9d9d9;\" align=\"center\">\n										<span class=\"editable editable-click\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td style=\"font-size: 12px; line-height: 22px; padding:20px 0;\" valign=\"middle\" align=\"center\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\">\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable editable-click\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\">\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</tbody></table>', '1', '2018-03-27 11:35:31', 58, '2018-03-27 06:05:31', NULL),
(8, 1, 'test template 8', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/8gvwG1Lm10GIPro2jBj1.png\" style=\"max-width: 200px; max-height: 200px;\"><br></div>\n													</td>\n													\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 200px; max-height: 200px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/8gvwG1Lm10GIPro2jBj1.png\"><br></div>\n													</td>\n													\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', '1', '2018-04-12 19:23:47', 58, '2018-04-12 13:53:47', NULL);
INSERT INTO `email_templates` (`id`, `category_id`, `template_name`, `template_content_to_send`, `template_content_to_view`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(9, 1, 'template 2', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/C3XYLUoZsa0yjLBchxff.jpg\" style=\"max-width: 200px; max-height: 200px;\"></div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																\n																\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 200px; max-height: 200px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/C3XYLUoZsa0yjLBchxff.jpg\"></div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<tr>\n													<td>\n														<table>\n															<tbody><tr>\n																\n																\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', '1', '2018-04-13 12:46:15', 58, '2018-04-13 07:16:15', NULL),
(10, 1, 'template 10', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/NCYd27TSD8uboheQJXYx.jpg\" style=\"max-width: 150px; max-height: 150px;\"><br></div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px;\">\n																	<span style=\"float: right;\"></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		This is Even, your real estate agent. I know moving is tough. So I am happy to share uDistro with you. This application will help you to move everything you want to move including your mail and utility services. \n																		Just click the get started button to claim your invitation and begin checking things of your recommended moving lists.\n																		Plus this is completely free. It is part of my contribution to your move.\n																	</div>\n																</td>\n																<!-- <td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td> -->\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<!-- <tr>\n													<td>\n														<table>\n															<tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</table>\n													</td>\n												</tr> -->  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"></span>\n														<div class=\"editable editable-click\">\n															\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: table-cell;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\" style=\"max-width: 150px; max-height: 150px;\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', '<table style=\"min-width: 320px; font-size: 18px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n							<tbody><tr>\n								<td style=\"\" bgcolor=\"#eff3f8\" align=\"center\">\n\n								<!--[if gte mso 10]>\n								<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n								<tr><td>\n								<![endif]-->\n\n								<table class=\"table_width_100\" style=\"max-width: 680px; min-width: 300px;\" id=\"table_email_template_container\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n									<tbody><tr>\n										<td align=\"center\">\n											<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n											<span style=\"height: 80px; line-height: 80px; font-size: 20px; text-align: center;\" id=\"table_header\" class=\"editable editable-click\">Email Template</span>\n										</td>\n									</tr>\n									<tr>\n										<td bgcolor=\"#fbfcfd\">\n											<table style=\"margin-top:20px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click editable-unsaved\" data-original-title=\"\" title=\"\" style=\"background-color: rgba(0, 0, 0, 0);\"><img alt=\"\" src=\"http://localhost/udistro/public/images/email_template/NCYd27TSD8uboheQJXYx.jpg\"><br></div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>\n											<table id=\"table_editable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td>\n														<table>\n															<tbody><tr>\n																<td style=\"padding-top: 20px; padding-left: 20px;\">\n																	Dear [firstname],\n																</td>\n															</tr>\n														</tbody></table>\n														<table>\n															<tbody><tr>\n																<td style=\"padding:20px;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable editable-click\" style=\"text-align: justify;\">\n																		This is Even, your real estate agent. I know moving is tough. So I am happy to share uDistro with you. This application will help you to move everything you want to move including your mail and utility services. \n																		Just click the get started button to claim your invitation and begin checking things of your recommended moving lists.\n																		Plus this is completely free. It is part of my contribution to your move.\n																	</div>\n																</td>\n																<!-- <td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td> -->\n															</tr>\n														</tbody></table>\n													</td>\n												</tr>\n\n												<!-- <tr>\n													<td>\n														<table>\n															<tr>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n																<td style=\"padding:20px; width: 50%;\">\n																	<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n																	<div class=\"editable\" style=\"text-align: justify;\">\n																		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n																		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n																		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n																		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n																		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n																		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n																	</div>\n																</td>\n															</tr>\n														</table>\n													</td>\n												</tr> -->  					\n											</tbody></table>\n											<table style=\"margin:20px 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n												<tbody><tr>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n													<td style=\"width: 33%; padding-left: 20px; padding-right: 20px;\" align=\"center\">\n														<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n														<div class=\"editable editable-click\">\n															<img src=\"http://localhost/udistro/public/images/dummy_image.png\" class=\"logo_images\" image-type=\"dummy\" alt=\"\" style=\"max-width: 100%;\">\n														</div>\n													</td>\n												</tr>\n											</tbody></table>		\n										</td>\n									</tr>\n									<tr>\n										<td style=\"padding-top: 20px; display: none;\" id=\"get_started_link_container\" align=\"center\">\n											<a id=\"get_started_link\" href=\"https://www.udistro.ca/\">\n												<img src=\"http://localhost/udistro/public/images/email_template/wH5yJUTpN1LE6Fbl9aZ2.jpg\">\n											</a>\n										</td>\n									</tr>\n								</tbody></table>\n								<!--[if gte mso 10]>\n								</td></tr>\n								</table>\n								<![endif]-->\n\n								</td>\n							</tr>\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Address\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Website\n										</div>\n									</td>\n									<td align=\"center\" style=\"padding:20px 0; width: 33%;\">\n										<span style=\"float: right;\"><a href=\"javascript:void(0);\" class=\"remove_editable\">X</a></span>\n										<div class=\"editable\">\n											Phone Number\n										</div>\n									</td>\n								</tr>\n							</table> -->\n\n							<!-- <table width=\"80%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n								<tr>\n									<td colspan=\"3\" align=\"center\" style=\"border-top:1px solid #d9d9d9;\">\n										<span class=\"editable\">Connect with us</span>\n									</td>\n								</tr>\n								<tr>\n									<td align=\"center\" valign=\"middle\" style=\"font-size: 12px; line-height: 22px; padding:20px 0;\">\n										<div>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/facebook-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/twitter-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/linkedin-icon.png\" alt=\"|\" />\n											</a>\n											<a href=\"javascript:void(0);\" target=\"_blank\" class=\"editable\" style=\"display: inline-block; padding: 5px;\">\n												<img src=\"http://localhost/udistro/public/images/instagram-icon.png\" alt=\"|\" />\n											</a>\n										</div>\n									</td>\n								</tr>                                        \n							</table> -->\n						</tbody></table>', '1', '2018-04-16 11:58:35', 58, '2018-04-16 06:28:35', NULL);

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
(2, 'Birthday', 0, '2018-03-21 08:30:23', '2018-03-21 08:30:23'),
(3, 'Notices', 0, '2018-03-21 08:31:09', '2018-03-21 08:31:09'),
(4, 'Promotion', 0, '2018-03-21 08:31:09', '2018-03-21 08:31:09'),
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
(1, 1, 1, 1, '10.00', '1.00', '1', '2018-04-23 14:24:25', 1, '2018-04-23 09:14:29', NULL);

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
(11, 'laundry', '1', '2018-01-08 11:00:00', 1, '2018-01-08 06:28:53', NULL),
(12, 'whole house', '1', '2018-04-25 15:00:00', 1, '2018-04-25 11:42:10', NULL);

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
(1, 1, 1, '10.00', '1.00', '1', '2018-04-23 14:24:25', 1, '2018-04-23 09:14:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cleaning_service_requests`
--

CREATE TABLE `home_cleaning_service_requests` (
  `id` int(11) NOT NULL,
  `agent_client_id` int(10) NOT NULL,
  `invitation_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `move_out_cleaning` enum('0','1') DEFAULT NULL,
  `moving_from_house_type` varchar(20) NOT NULL,
  `moving_from_floor` varchar(20) NOT NULL,
  `moving_from_bedroom_count` varchar(20) NOT NULL,
  `moving_from_property_type` varchar(20) NOT NULL,
  `move_in_cleaning` enum('0','1') DEFAULT NULL,
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
  `elevator_availability` enum('0','1') DEFAULT NULL,
  `primary_no` varchar(20) NOT NULL,
  `secondary_no` varchar(20) NOT NULL,
  `availability_date1` date NOT NULL,
  `availability_time1` varchar(20) NOT NULL,
  `availability_date2` date DEFAULT NULL,
  `availability_time2` varchar(20) DEFAULT NULL,
  `availability_date3` date DEFAULT NULL,
  `availability_time3` varchar(20) DEFAULT NULL,
  `additional_information` text NOT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `comment` text,
  `date_of_working` varchar(50) DEFAULT NULL COMMENT 'Working date selected by company',
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `email_sent_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=email not sent, 1=email sent',
  `company_response` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: No response yet, 1: response assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_cleaning_service_requests`
--

INSERT INTO `home_cleaning_service_requests` (`id`, `agent_client_id`, `invitation_id`, `company_id`, `move_out_cleaning`, `moving_from_house_type`, `moving_from_floor`, `moving_from_bedroom_count`, `moving_from_property_type`, `move_in_cleaning`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `home_condition`, `home_cleaning_level`, `home_cleaning_area`, `home_cleaning_people_count`, `home_cleaning_pet_count`, `home_cleaning_bathroom_count`, `cleaning_behind_refrigerator_and_stove`, `baseboard_to_be_washed`, `elevator_availability`, `primary_no`, `secondary_no`, `availability_date1`, `availability_time1`, `availability_date2`, `availability_time2`, `availability_date3`, `availability_time3`, `additional_information`, `discount`, `comment`, `date_of_working`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `email_sent_status`, `company_response`) VALUES
(1, 1, 1, 4, NULL, 'house', '1', '1', 'own', NULL, 'apartment/flat', '2', '2', 'rent', 'dirty', '1', '0-600', '1', '0', '1', '1', '1', '1', '', '', '2018-04-30', '08:00AM to 07:00PM', NULL, NULL, NULL, NULL, 'test', 10.00, 'test', '2018-04-30 08:00AM to 07:00PM', '1', '2018-04-23 14:24:25', 1, '2018-04-23 09:14:29', NULL, '0', '1');

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
(1, 1, 1, '10.00', '1.00', '1', '2018-04-23 14:24:25', 1, '2018-04-23 09:14:29', NULL);

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
(1, 58, '2018-04-26 11:10:29', 1);

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
-- Table structure for table `mover_utility_action_logs`
--

CREATE TABLE `mover_utility_action_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `utility_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `invitation_id` int(10) UNSIGNED NOT NULL,
  `action_status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0 = no action, 1 = disconnected, 2 = connected, 3 = transfered',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `mover_utility_action_logs`
--

INSERT INTO `mover_utility_action_logs` (`id`, `utility_id`, `client_id`, `invitation_id`, `action_status`, `created_at`) VALUES
(2, 1, 1, 1, '3', '2018-04-23 06:27:48');

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
(2, 'Kitchen & Dining Room', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(3, 'Bedroom(s) & Nursery', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(4, 'Appliances & Electronics', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL),
(5, 'Others', '1', '2017-12-22 10:00:00', 1, '2017-12-22 08:54:03', NULL);

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
(48, 3, 'Car Seat', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(49, 3, 'Change Table', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(50, 3, 'Crib', '70 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(51, 3, 'High Chair', '35 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(52, 3, 'Large Toys', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(53, 3, 'Play Pen', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(54, 3, 'Stroller', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(55, 2, 'Bakers Rack', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(56, 2, 'Chair(s)', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(57, 2, 'Ironing Board', '10 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(58, 2, 'Kitchen Cupboard', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(59, 2, 'Microwave', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(60, 2, 'Stool(s)', '15 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(61, 2, 'Table - 4 or less', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(62, 2, 'Table - 5-6', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(63, 2, 'T.V. Tables', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(64, 4, 'Water Cooler', '75 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(65, 4, 'Dehumidifier / Humidifier', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(66, 4, 'Air Conditioner', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(67, 4, 'Freezer - 10 or less', '225 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(68, 4, 'Freezer - 11-15', '300 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(69, 4, 'Freezer - 16 + over', '400 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(70, 4, 'Microwave Stand', '70 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(71, 4, 'Range', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(72, 4, 'Refrigerator - 6 or less', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(73, 4, 'Refrigerator - 7-10', '225 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(74, 4, 'Refrigerator - 11 + over', '325 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(75, 4, 'Sewing Machine - Cabinet', '90 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(76, 4, 'Sewing Machine - Portable', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(77, 4, 'Dishwasher', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(78, 4, 'Dehumidifier / Humidifier', '200 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(79, 4, 'Washing Machine', '175 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(80, 4, 'Dryer', '175 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(81, 4, 'Entertainment Centre', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(82, 4, 'Computer System', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(83, 4, 'Speaker(s) (ea)', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(84, 4, 'Stereo Component (ea)', '25 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(85, 4, 'Stereo Stand', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(86, 4, 'T.V. Lg Screen', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(87, 4, 'T.V. Flat Screen', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(88, 4, 'T.V. Stand', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(89, 4, 'CD Rack', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(90, 5, 'BBQ', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(91, 5, 'Chair(s) - Lawn (ea)', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(92, 5, 'Lawn Mower', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(93, 5, 'Ladder - Step', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(94, 5, 'Snow Blower', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(95, 5, 'Trash Cans', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(96, 5, 'Bicycle', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(97, 5, 'Treadmill', '225 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(98, 5, 'Exercise Bike', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(99, 5, 'Exercise Machine', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(100, 5, 'Filing Cabinet - 2 Drawer', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(101, 5, 'Filing Cabinet - 4 Drawer', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(102, 5, 'Hamper', '15 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(103, 4, 'Heater - Gas/Electric', '20 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(104, 4, 'Fan', '15 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(105, 5, 'Suitcase(s)', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(106, 5, 'Patio Table / 6 Chairs / Umbrella', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(107, 5, 'Patio Bench', '80 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(108, 5, 'Power Tool (floor model)', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(109, 5, 'Wood Shelf', '45 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(110, 5, 'Shelves - Metal', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(111, 5, 'Tool Chest - Large', '90 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(112, 5, 'Tool Chest - Small', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(113, 5, 'Trunk - Large', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(114, 5, 'Trunk - Small', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(115, 5, 'Air Hockey Table', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(116, 5, 'Fuseball Table', '100 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(117, 5, 'Lawn Ornaments', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(118, 5, 'Utility / Gun Cabinet', '125 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(119, 5, 'Work Bench', '150 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(120, 5, 'Bathroom Toilet Cabinet', '50 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(121, 5, 'Garden Hose - Tool Bundle', '35 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(122, 5, 'Pool Table', '400 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(123, 5, 'Mops / Pails / Brooms', '5 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(124, 5, 'Vacuum Cleaner', '25 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(125, 5, 'Boxes', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(126, 5, 'Pictures / Mirrors (small)', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(127, 5, 'Pictures / Mirrors (large)', '40 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(128, 5, 'Plastic Stacker Drawers', '30 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(129, 5, 'Totes / Rubbermaid Containers', '45 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL),
(130, 5, 'Wardrobe Boxes', '60 LBS', '1', '2017-12-15 13:00:00', 1, '2017-12-15 06:45:56', NULL);

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
(1, 1, 1, 1, 1, '10.00', '2018-04-23 16:37:01', 1, '2018-04-23 11:08:06', 60);

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
  `date_of_working` varchar(50) DEFAULT NULL COMMENT 'Working date selected by company',
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `email_sent_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=email not sent, 1=email sent',
  `company_response` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: No response yet, 1: response assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `moving_item_service_requests`
--

INSERT INTO `moving_item_service_requests` (`id`, `agent_client_id`, `invitation_id`, `mover_company_id`, `moving_from_house_type`, `moving_from_floor`, `moving_from_bedroom_count`, `moving_from_property_type`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `transportation_vehicle_type`, `insurance`, `insurance_amount`, `callback_option`, `callback_time`, `primary_no`, `secondary_no`, `moving_date`, `additional_information`, `discount`, `comment`, `date_of_working`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `email_sent_status`, `company_response`) VALUES
(1, 1, 1, 5, 'house', '1', '1', 'own', 'apartment/flat', '2', '2', 'rent', 'pickup', '0', NULL, '', NULL, NULL, NULL, '2018-04-30', 'test', 5.00, 'test', '04-30-2018', '1', '2018-04-23 16:37:01', 1, '2018-04-23 11:08:06', NULL, '0', '1');

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
(1, 1, 1, NULL, NULL, NULL, '2018-04-23 16:37:01', 1, '2018-04-23 11:07:01', NULL),
(2, 2, 1, NULL, NULL, NULL, '2018-04-23 16:37:01', 1, '2018-04-23 11:07:01', NULL),
(3, 3, 1, NULL, NULL, NULL, '2018-04-23 16:37:01', 1, '2018-04-23 11:07:01', NULL),
(4, 4, 1, NULL, NULL, NULL, '2018-04-23 16:37:01', 1, '2018-04-23 11:07:01', NULL),
(5, 5, 1, NULL, NULL, NULL, '2018-04-23 16:37:01', 1, '2018-04-23 11:07:01', NULL);

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
(1, 1, 1, '10.00', '1.00', '2018-04-23 16:37:01', 1, '2018-04-23 11:08:06', 60);

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
('mayankpandey@virtualemployee.com', '$2y$10$XNrDKG.IMayKUZiv99N5Au8tL67y1SfTNcInP0FlohKZWyJyKMEr.', '2018-03-30 12:07:51'),
('mayankpandey@virtualemployee.com', '$2y$10$uJcKjILQ.38IpOsgfYXnbe2rLPwoKVZdCpedPEWgV3tTWkuoEB3q.', '2018-03-30 12:08:15');

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
(3, 8, 1, 58, '2018-03-19', '2018-05-18', 0, -11, '1', '2018-04-16 06:28:35'),
(4, 6, 2, 2, '2018-03-20', '2018-05-19', 0, 0, '1', '2018-03-20 10:23:28'),
(5, 6, 2, 4, '2018-03-23', '2018-05-22', 0, 0, '1', '2018-03-23 09:59:42'),
(6, 6, 2, 5, '2018-03-26', '2018-05-25', 0, -15, '1', '2018-04-23 11:07:01'),
(7, 6, 2, 6, '2018-03-26', '2018-05-25', 0, 0, '1', '2018-03-26 11:15:09');

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
  `payment_interact_txn_id` varchar(20) DEFAULT NULL COMMENT 'Interact payment transaction id',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_transaction_details`
--

INSERT INTO `payment_transaction_details` (`id`, `service_request_response_id`, `company_id`, `company_category_id`, `payment_against`, `invoice_no`, `address_city`, `address_country`, `address_country_code`, `address_name`, `address_state`, `address_status`, `address_street`, `address_zip`, `first_name`, `last_name`, `ipn_track_id`, `item_name`, `item_number`, `mc_currency`, `mc_gross`, `notify_version`, `payer_email`, `payer_id`, `payer_status`, `payment_date`, `payment_gross`, `payment_status`, `payment_type`, `pending_reason`, `protection_eligibility`, `quantity`, `receiver_email`, `residence_country`, `txn_id`, `transaction_subject`, `txn_type`, `verify_sign`, `company_payment_released`, `mover_payment_released`, `payment_interact_txn_id`, `created_at`, `updated_at`) VALUES
(24, 1, 4, 2, 'Home Cleaning Service', '69927673', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Completed', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '1', '1', '654321', '2018-04-23 14:45:04', '2018-04-23 10:41:03');

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
  `agency_type` enum('1','2') NOT NULL COMMENT '1: Provincial Agencies, 2: Federal Agencies',
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
  `do_it_on_line_label` varchar(50) DEFAULT NULL,
  `get_started_label` varchar(50) DEFAULT NULL,
  `direct_link` enum('0','1') NOT NULL COMMENT '0 means not direct link',
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `provincial_agency_details`
--

INSERT INTO `provincial_agency_details` (`id`, `province_id`, `agency_type`, `agency_name`, `label1`, `label2`, `label3`, `label4`, `label5`, `label6`, `label7`, `label8`, `label9`, `label10`, `heading1`, `detail1`, `heading2`, `detail2`, `heading3`, `detail3`, `heading4`, `detail4`, `link`, `logo`, `do_it_on_line_label`, `get_started_label`, `direct_link`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 9, '1', 'Health agency', 'Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5', 'Label 6', 'Label 7', 'Label 8', 'Label 9', 'Label 10', 'Heading 1', 'Detail 1', 'Heading 2', 'Detail 2', 'Heading 3', 'Detail 3', 'Heading 4', 'Detail 4', 'https://www.google.co.in/?gfe_rd=cr&dcr=0&ei=DiVXWvrNO9OL8Qek25SoAw', NULL, 'Do it online', 'Get started', '1', '1', '2018-01-11 14:26:22', 1, '2018-03-21 09:40:48', 1),
(2, 3, '1', 'Manitoba Health', 'Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5', 'Label 6', 'Label 7', 'Label 8', 'Label 9', 'Label 10', 'Heading 1', 'Detail 1', 'Heading 2', 'Detail 2', 'Heading 3', 'Detail 3', 'Heading 4', 'Detail 4', 'https://www.google.co.in/?gfe_rd=cr&dcr=0&ei=DiVXWvrNO9OL8Qek25SoAw', NULL, 'Do it line', 'Get started', '1', '1', '2018-01-11 14:34:20', 1, '2018-03-21 09:40:00', 1),
(3, 0, '2', 'Water Agency', 'label 1', 'label 2', 'label 3', 'label 4', NULL, NULL, NULL, NULL, NULL, NULL, 'heading 1', 'detail 1', 'heading 2', 'detail 2', 'heading 3', 'detail 3', 'heading 4', 'detail 4', 'https://www.google.co.in', NULL, 'Do it online', 'Get started', '0', '1', '2018-02-06 16:08:57', 23, '2018-04-23 08:29:23', 1),
(4, 0, '1', 'ageny 1', 'label 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2018-04-26 17:51:08', 1, '2018-04-26 12:21:08', NULL);

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
(92, 1, 1, 6, '1', '2018-03-16 17:40:51'),
(93, 2, 1, 6, '1', '2018-03-26 16:55:20'),
(94, 4, 1, 6, '1', '2018-03-26 16:56:18'),
(95, 6, 1, 6, '1', '2018-03-26 16:57:59'),
(96, 6, 1, 6, '1', '2018-03-26 17:49:53'),
(97, 6, 1, 6, '1', '2018-03-26 17:55:22'),
(98, 6, 1, 6, '1', '2018-03-26 17:56:46'),
(99, 2, 2, 6, '1', '2018-04-03 15:16:01'),
(100, 4, 2, 6, '1', '2018-04-03 16:46:54'),
(101, 6, 2, 6, '1', '2018-04-03 17:17:13'),
(102, 4, 2, 6, '1', '2018-04-04 14:56:38'),
(103, 4, 2, 6, '1', '2018-04-04 15:13:24'),
(104, 4, 2, 6, '1', '2018-04-04 18:12:26'),
(105, 4, 2, 6, '1', '2018-04-05 15:06:15'),
(106, 2, 2, 6, '1', '2018-04-05 15:50:56'),
(107, 4, 2, 6, '1', '2018-04-05 15:52:26'),
(108, 6, 2, 6, '1', '2018-04-05 15:54:49'),
(109, 6, 2, 6, '1', '2018-04-05 18:02:20'),
(110, 6, 2, 6, '1', '2018-04-05 18:46:50'),
(111, 6, 2, 6, '1', '2018-04-05 18:49:11'),
(112, 2, 1, 6, '1', '2018-04-06 14:08:11'),
(113, 4, 1, 6, '1', '2018-04-06 14:08:48'),
(114, 6, 1, 6, '1', '2018-04-06 14:09:39'),
(115, 6, 1, 6, '1', '2018-04-10 13:56:35'),
(116, 4, 1, 6, '1', '2018-04-10 14:00:16'),
(117, 6, 1, 6, '1', '2018-04-10 14:14:49'),
(118, 4, 1, 6, '1', '2018-04-10 14:19:58'),
(119, 4, 1, 6, '1', '2018-04-16 19:04:05'),
(120, 6, 1, 6, '1', '2018-04-16 19:04:54'),
(121, 4, 1, 6, '1', '2018-04-17 10:58:17'),
(122, 4, 1, 6, '1', '2018-04-17 10:58:36'),
(123, 4, 1, 6, '1', '2018-04-17 10:59:31'),
(124, 4, 1, 6, '1', '2018-04-17 11:01:55'),
(125, 4, 1, 6, '1', '2018-04-17 11:03:33'),
(126, 4, 1, 6, '1', '2018-04-17 11:05:00'),
(127, 6, 1, 6, '1', '2018-04-17 11:11:02'),
(128, 4, 1, 6, '1', '2018-04-17 12:16:11'),
(129, 6, 1, 6, '1', '2018-04-17 12:16:57'),
(130, 4, 1, 6, '1', '2018-04-18 11:51:21'),
(131, 6, 1, 6, '1', '2018-04-18 11:54:40'),
(132, 4, 1, 6, '1', '2018-04-23 14:24:25'),
(133, 6, 1, 6, '1', '2018-04-23 16:40:50');

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

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `company_id`, `mover_id`, `service_request_response_id`, `rating`, `comments`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 2, 5, NULL, '1', '2018-04-19 12:00:21', '2018-04-19 12:00:21');

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
(3, 58, 'App\\User'),
(2, 59, 'App\\User'),
(2, 60, 'App\\User'),
(2, 61, 'App\\User');

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
(1, 'pandeyz@yahoo.in', '<table><tr>\n	      				<td style=\"padding:10px; width: 200px;\">\n	      					<img src=\"http://localhost/udistro/public/images/house_sold.png\" height=\"200\" width=\"250\" alt=\"udistro\">\n\n	      					<table style=\"text-align: center; width: 100%;\">\n	      						<tbody><tr>\n	      							<td>\n	      								<h4 style=\"margin-bottom: 10px;\">Special Thanks to Agent<br> Even Rock</h4>\n	      							</td>\n	      						</tr>\n	      					</tbody></table>\n	      					<table align=\"center\" style=\"text-align: center; width: 60%;\">\n	      						<tbody><tr class=\"ratingstar\">\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"></a></td>\n	      						</tr>\n	      					</tbody></table>\n	      					<table style=\"text-align: center; width: 100%; margin:15px 0 0;\">\n	      						<!-- <tr>\n	      							<td>( 5 Rating )</td>\n	      						</tr> -->\n	      					</table>\n	      				</td>\n	      				<td style=\"padding: 10px; vertical-align: top;\">\n	      					<table style=\"text-align: center; background: #f3f9fc; width:100%; line-height: 33px;\">\n	      						<tbody><tr class=\"content_editable\">\n	      							<td><h2>The Mayank Pandey\'s are moving!</h2></td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Hi friends</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>we are moving to 63 Lark Ridge Way, Manitoba</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Stop by Saturday night for a housewarming party!</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>With love from</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Mayank Pandey</td>\n	      						</tr>\n	      						<tr>\n	      							<td>\n	      								<table style=\"width: 100%; border-top:1px solid #dceaf1;\">\n	      									<tbody><tr>\n	      										<td style=\"text-align: left; font-size: 14px; padding: 0px 10px; width: 50%; border-right:1px solid #dceaf1;\">\n	      											<table>\n	      												<tbody><tr>\n	      													<td>\n	      														<img src=\"http://localhost/udistro/public/images/company/YvuxPZb2Nz.png\" height=\"60px\" width=\"60px\" alt=\"Udistro\">\n	      													</td>\n	      													<td style=\"padding: 15px;\">\n	      														Even Real Estate\n	      														, Manitoba, Dauphin, R3Y 0V1\n	      													</td>\n	      												</tr>\n	      											</tbody></table>\n	      										</td>\n	      										<td style=\"width: 50%; text-align: left; padding-left: 10px;\">\n	      											<span>\n	      												<img src=\"http://localhost/udistro/public/images/agents/PHKPTXDRnW.jpg\" class=\"user-avtar\" alt=\"Udistro\" height=\"50px\" width=\"50px\">\n	      											</span>\n	      											<span>Even Rock</span>\n	      										</td>\n	      									</tr>\n	      								</tbody></table>\n	      							</td>\n	      						</tr>\n	      					</tbody></table>\n	      				</td>\n	      			</tr></table>', '0', '2018-04-23 12:42:09', '2018-04-23 07:12:09'),
(2, 'pandeyz@yahoo.in', '<table><tr>\n	      				<td style=\"padding:10px; width: 200px;\">\n	      					<img src=\"http://localhost/udistro/public/images/house_sold.png\" height=\"200\" width=\"250\" alt=\"udistro\">\n\n	      					<table style=\"text-align: center; width: 100%;\">\n	      						<tbody><tr>\n	      							<td>\n	      								<h4 style=\"margin-bottom: 10px;\">Special Thanks to Agent<br> Even Rock</h4>\n	      							</td>\n	      						</tr>\n	      					</tbody></table>\n	      					<table align=\"center\" style=\"text-align: center; width: 60%;\">\n	      						<tbody><tr class=\"ratingstar\">\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"></a></td>\n	      						</tr>\n	      					</tbody></table>\n	      					<table style=\"text-align: center; width: 100%; margin:15px 0 0;\">\n	      						<!-- <tr>\n	      							<td>( 5 Rating )</td>\n	      						</tr> -->\n	      					</table>\n	      				</td>\n	      				<td style=\"padding: 10px; vertical-align: top;\">\n	      					<table style=\"text-align: center; background: #f3f9fc; width:100%; line-height: 33px;\">\n	      						<tbody><tr class=\"content_editable\">\n	      							<td><h2>The Mayank Pandey\'s are moving!</h2></td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Hi friends</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>we are moving to 63 Lark Ridge Way, Manitoba</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Stop by Saturday night for a housewarming party!</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>With love from</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Mayank Pandey</td>\n	      						</tr>\n	      						<tr>\n	      							<td>\n	      								<table style=\"width: 100%; border-top:1px solid #dceaf1;\">\n	      									<tbody><tr>\n	      										<td style=\"text-align: left; font-size: 14px; padding: 0px 10px; width: 50%; border-right:1px solid #dceaf1;\">\n	      											<table>\n	      												<tbody><tr>\n	      													<td>\n	      														<img src=\"http://localhost/udistro/public/images/company/YvuxPZb2Nz.png\" height=\"60px\" width=\"60px\" alt=\"Udistro\">\n	      													</td>\n	      													<td style=\"padding: 15px;\">\n	      														Even Real Estate\n	      														, Manitoba, Dauphin, R3Y 0V1\n	      													</td>\n	      												</tr>\n	      											</tbody></table>\n	      										</td>\n	      										<td style=\"width: 50%; text-align: left; padding-left: 10px;\">\n	      											<span>\n	      												<img src=\"http://localhost/udistro/public/images/agents/PHKPTXDRnW.jpg\" class=\"user-avtar\" alt=\"Udistro\" height=\"50px\" width=\"50px\">\n	      											</span>\n	      											<span>Even Rock</span>\n	      										</td>\n	      									</tr>\n	      								</tbody></table>\n	      							</td>\n	      						</tr>\n	      					</tbody></table>\n	      				</td>\n	      			</tr></table>', '0', '2018-04-23 12:42:50', '2018-04-23 07:12:50'),
(3, 'pandeyz@yahoo.in', '<table><tr>\n	      				<td style=\"padding:10px; width: 200px;\">\n	      					<img src=\"http://localhost/udistro/public/images/house_sold.png\" height=\"200\" width=\"250\" alt=\"udistro\">\n\n	      					<table style=\"text-align: center; width: 100%;\">\n	      						<tbody><tr>\n	      							<td>\n	      								<h4 style=\"margin-bottom: 10px;\">Special Thanks to Agent<br> Even Rock</h4>\n	      							</td>\n	      						</tr>\n	      					</tbody></table>\n	      					<table align=\"center\" style=\"text-align: center; width: 60%;\">\n	      						<tbody><tr class=\"ratingstar\">\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"><img src=\"http://localhost/udistro/public/images/star.png\"></a></td>\n	      							<td style=\"\"><a style=\"color: #dbdbdb;\" href=\"javascript:void(0);\"></a></td>\n	      						</tr>\n	      					</tbody></table>\n	      					<table style=\"text-align: center; width: 100%; margin:15px 0 0;\">\n	      						<!-- <tr>\n	      							<td>( 5 Rating )</td>\n	      						</tr> -->\n	      					</table>\n	      				</td>\n	      				<td style=\"padding: 10px; vertical-align: top;\">\n	      					<table style=\"text-align: center; background: #f3f9fc; width:100%; line-height: 33px;\">\n	      						<tbody><tr class=\"content_editable\">\n	      							<td><h2>The Mayank Pandey\'s are moving!</h2></td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Hi friends</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>we are moving to 63 Lark Ridge Way, Manitoba</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Stop by Saturday night for a housewarming party!</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>With love from</td>\n	      						</tr>\n	      						<tr class=\"content_editable\">\n	      							<td>Mayank Pandey</td>\n	      						</tr>\n	      						<tr>\n	      							<td>\n	      								<table style=\"width: 100%; border-top:1px solid #dceaf1;\">\n	      									<tbody><tr>\n	      										<td style=\"text-align: left; font-size: 14px; padding: 0px 10px; width: 50%; border-right:1px solid #dceaf1;\">\n	      											<table>\n	      												<tbody><tr>\n	      													<td>\n	      														<img src=\"http://localhost/udistro/public/images/company/YvuxPZb2Nz.png\" height=\"60px\" width=\"60px\" alt=\"Udistro\">\n	      													</td>\n	      													<td style=\"padding: 15px;\">\n	      														Even Real Estate\n	      														, Manitoba, Dauphin, R3Y 0V1\n	      													</td>\n	      												</tr>\n	      											</tbody></table>\n	      										</td>\n	      										<td style=\"width: 50%; text-align: left; padding-left: 10px;\">\n	      											<span>\n	      												<img src=\"http://localhost/udistro/public/images/agents/PHKPTXDRnW.jpg\" class=\"user-avtar\" alt=\"Udistro\" height=\"50px\" width=\"50px\">\n	      											</span>\n	      											<span>Even Rock</span>\n	      										</td>\n	      									</tr>\n	      								</tbody></table>\n	      							</td>\n	      						</tr>\n	      					</tbody></table>\n	      				</td>\n	      			</tr></table>', '0', '2018-04-23 12:47:50', '2018-04-23 07:17:50');

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
(1, 1, 3, 1, '50.00', '2018-04-23 16:40:50', 1, '2018-04-23 11:12:04', 61);

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
(1, 1, 1, NULL, NULL, '2018-04-23 16:40:50', 1, '2018-04-23 11:10:50', NULL),
(2, 1, 2, NULL, NULL, '2018-04-23 16:40:50', 1, '2018-04-23 11:10:50', NULL);

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
(1, 1, 3, NULL, NULL, '2018-04-23 16:40:50', 1, '2018-04-23 11:10:50', NULL);

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
  `availability_time1` varchar(50) DEFAULT NULL,
  `availability_date2` date DEFAULT NULL,
  `availability_time2` varchar(50) DEFAULT NULL,
  `availability_date3` date DEFAULT NULL,
  `availability_time3` varchar(50) DEFAULT NULL,
  `additional_information` text NOT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `comment` text,
  `date_of_working` varchar(50) DEFAULT NULL COMMENT 'Working date selected by company',
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `email_sent_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=email not sent, 1=email sent',
  `company_response` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: No response yet, 1: response assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_concierge_service_requests`
--

INSERT INTO `tech_concierge_service_requests` (`id`, `agent_client_id`, `invitation_id`, `company_id`, `moving_to_house_type`, `moving_to_floor`, `moving_to_bedroom_count`, `moving_to_property_type`, `primary_no`, `secondary_no`, `availability_date1`, `availability_time1`, `availability_date2`, `availability_time2`, `availability_date3`, `availability_time3`, `additional_information`, `discount`, `comment`, `date_of_working`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `email_sent_status`, `company_response`) VALUES
(1, 1, 1, 6, 'apartment/flat', '2', '2', 'rent', '', '', '2018-04-30', '08:00AM to 07:00PM', NULL, NULL, NULL, NULL, 'test', 10.00, 'test', '2018-04-30 08:00AM to 07:00PM', '1', '2018-04-23 16:40:50', 1, '2018-04-23 11:12:04', NULL, '0', '1');

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
(1, 'admin@udistro.com', NULL, 'admin', '', '', NULL, NULL, NULL, NULL, NULL, '$2y$10$M.pFE2TlBClEjdmbNBmDN.oPPJ/g02EywCQ3K8xC2HINUOebrdRam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'W707hblG6eNQcGkFWKJw3Ya9h1AMHrz7MO1fupfZrrA2qPHBDasY9p1eDjEp', '2018-04-26 17:47:26', '1', NULL, 0, NULL, NULL, NULL, '2017-10-26 06:30:00', 0, '2018-04-26 12:17:26', 0),
(57, 'mayankpandey@virtualemployee.com', 'manager', 'max', 'rick', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, '$2y$10$ZxN7gFUYIbusfQ8QJP0lNO0R7z0qJKY9SoE60oKQT3KIycZ4Qj0fy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bN52JuTAtqqsXNFSCZdsyE1DBSo3pER4YI9QWYTYTwC4j3BkoyUiUClzXFhi', '2018-04-16 19:05:29', '1', NULL, 0, NULL, NULL, NULL, '2018-03-19 06:09:48', NULL, '2018-04-16 13:35:29', 1),
(58, 'invitation@udistro.ca', 'manager', 'even', 'rock', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, '$2y$10$eRzh73u/3Zk5R3/5C8XJPeuWSwGweA4fSyfmqH95O.xX7hSIo.6LO', '', '', '', '', '', '', '', 'PHKPTXDRnW.jpg', 'MmMrGHlm1Wz3ZmS0ZIJNEzIPYUoiz9StI2sauj92u1gE6sqRhghfhbUZO1Yc', '2018-04-26 16:40:29', '1', 'even rock', 1, '123456789', '', '', '2018-03-19 06:13:12', NULL, '2018-04-26 11:10:29', 58),
(59, 'abdussamiisunusi@gmail.com', NULL, 'abu', 'farhan', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, '$2y$10$EzAEHAMKCmpRJGNkmd.VE.QsR4986UIX.P4qtVXxXPazM5QXQ97bC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gihiJLj22LQ0g70gbEOHhTfFQD6Vu9TkPpHC218lRCotAPygeuG1irEeaIwh', '2018-04-25 18:57:25', '1', NULL, 0, NULL, NULL, NULL, '2018-03-23 10:01:12', 1, '2018-04-25 13:27:25', NULL),
(60, 'rishabh@gmail.com', NULL, 'rishabh', 'singh', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, '$2y$10$ryMQ8HgXwZSqbIwMlWRIUeB73iLlXpC7IiLMyyTO5lrI/yA2XwwNS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e0oVAG1w9YevmKYbQcb5v8gKDI96nfEK5AvQfq4B9wzFfkLirGhQuKXQ0IEa', '2018-04-26 17:16:06', '1', NULL, 0, NULL, NULL, NULL, '2018-03-26 11:16:09', 1, '2018-04-26 11:46:06', NULL),
(61, 'alex@gmail.com', NULL, 'alex', 'den', '63 Lark Ridge Way', '', 3, 79, 'R3Y 0V1', 1, '$2y$10$vOnVN662TaQtn6csK3YKGuy2i1NIJU5/feajkWjR5rnOqOjYspc76', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'laIYrxUlwKsU5Muaybi7C9tzwXMEtTyjMIdANCgvlLJZlv9HfjJwGONHJRs5', '2018-04-23 16:40:57', '1', NULL, 0, NULL, NULL, NULL, '2018-03-26 11:16:40', 1, '2018-04-23 11:10:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
--

CREATE TABLE `utilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `utility_name` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilities`
--

INSERT INTO `utilities` (`id`, `utility_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electricity', '1', '2018-04-10 11:09:37', '2018-04-10 11:09:37'),
(2, 'Water', '1', '2018-04-10 11:09:53', '2018-04-10 11:09:53'),
(3, 'Digital', '1', '2018-04-10 11:10:21', '2018-04-10 11:10:21'),
(4, 'Recycle Carts', '1', '2018-04-10 11:46:00', '2018-04-10 11:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `utility_companies`
--

CREATE TABLE `utility_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `utility_id` int(10) UNSIGNED NOT NULL,
  `utility_company_name` varchar(100) NOT NULL,
  `province_id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_companies`
--

INSERT INTO `utility_companies` (`id`, `utility_id`, `utility_company_name`, `province_id`, `phone_number`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Manitoba Hydro', 3, '2048076739', 'https://www.hydro.mb.ca/custmoves/main.jsf', '1', '2018-04-13 10:37:24', '2018-04-12 12:09:51'),
(5, 2, 'City of Winnipeg', 3, '2048076739', 'https://myutilitybill.winnipeg.ca/UtilityPortal/#/moving', '1', '2018-04-13 10:37:24', '2018-04-12 12:09:51'),
(6, 3, 'Shaw Communications', 3, '2048076739', 'https://www.shaw.ca/moving/#/', '1', '2018-04-13 10:37:24', '2018-04-12 12:09:51'),
(7, 3, 'CommStream', 3, '2048076739', 'http://www.commstream.net/residential/', '1', '2018-04-13 10:37:24', '2018-04-12 12:09:51'),
(8, 3, 'Rainy Day Internet', 3, '2048076739', 'https://www.udistro.ca/', '1', '2018-04-13 10:37:24', '2018-04-10 11:31:24'),
(9, 3, 'Voyageur Internet Inc.', 3, '2048076739', 'https://www.udistro.ca/', '1', '2018-04-13 10:37:24', '2018-04-10 11:31:52'),
(10, 3, 'BellMTS', 3, '2048076739', 'https://www.bellmts.ca/residential/move-my-services', '1', '2018-04-13 10:37:24', '2018-04-12 12:09:51'),
(11, 4, 'City of Winnipeg', 3, '2048076739', 'https://myutilitybill.winnipeg.ca/UtilityPortal/#/moving', '1', '2018-04-13 10:37:24', '2018-04-12 12:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `utility_company_services`
--

CREATE TABLE `utility_company_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `utility_company_service_name` varchar(100) NOT NULL,
  `utility_company_id` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_company_services`
--

INSERT INTO `utility_company_services` (`id`, `utility_company_service_name`, `utility_company_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electricity', 1, '1', '2018-04-10 11:39:46', '2018-04-10 11:39:46'),
(2, 'Natural Gas', 1, '1', '2018-04-10 11:40:07', '2018-04-10 11:40:07'),
(3, 'Solar', 1, '1', '2018-04-10 11:43:24', '2018-04-10 11:43:24'),
(5, 'Water', 5, '1', '2018-04-10 11:46:55', '2018-04-10 11:46:55'),
(6, 'Waste', 5, '1', '2018-04-10 11:47:08', '2018-04-10 11:47:08'),
(7, 'Internet', 6, '1', '2018-04-10 11:47:50', '2018-04-10 11:47:50'),
(8, 'Cable', 6, '1', '2018-04-10 11:48:01', '2018-04-10 11:48:01'),
(9, 'Home Phone', 6, '1', '2018-04-10 11:48:15', '2018-04-10 11:48:15'),
(10, 'Cable', 7, '1', '2018-04-10 11:48:57', '2018-04-10 11:48:57'),
(11, 'Internet', 7, '1', '2018-04-10 11:49:21', '2018-04-10 11:49:21'),
(12, 'Internet', 8, '1', '2018-04-10 11:49:34', '2018-04-10 11:49:34'),
(13, 'Internet', 10, '1', '2018-04-10 11:50:12', '2018-04-10 11:50:12'),
(14, 'Cable', 10, '1', '2018-04-10 11:50:23', '2018-04-10 11:50:23'),
(15, 'Home Phone', 10, '1', '2018-04-10 11:50:34', '2018-04-10 11:50:34'),
(16, 'Mobile Phone', 10, '1', '2018-04-10 11:50:44', '2018-04-10 11:50:44'),
(17, 'Internet', 9, '1', '2018-04-10 11:51:52', '2018-04-10 11:51:52'),
(18, 'Garbage Bin', 11, '1', '2018-04-10 12:23:05', '2018-04-10 12:23:05'),
(19, 'Recycle Bin', 11, '1', '2018-04-10 12:23:20', '2018-04-10 12:23:20');

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
-- Indexes for table `mover_utility_action_logs`
--
ALTER TABLE `mover_utility_action_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utility_id` (`utility_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `invitation_id` (`invitation_id`);

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
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utility_companies`
--
ALTER TABLE `utility_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utility_id` (`utility_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `utility_company_services`
--
ALTER TABLE `utility_company_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utility_company_id` (`utility_company_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `agent_client_invites`
--
ALTER TABLE `agent_client_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `agent_client_moving_from_addresses`
--
ALTER TABLE `agent_client_moving_from_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `agent_client_moving_to_addresses`
--
ALTER TABLE `agent_client_moving_to_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `agent_client_ratings`
--
ALTER TABLE `agent_client_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1106;
--
-- AUTO_INCREMENT for table `client_activity_feedbacks`
--
ALTER TABLE `client_activity_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client_activity_lists`
--
ALTER TABLE `client_activity_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `client_activity_logs`
--
ALTER TABLE `client_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `company_categories`
--
ALTER TABLE `company_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `company_request_emails`
--
ALTER TABLE `company_request_emails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `home_cleaning_other_places`
--
ALTER TABLE `home_cleaning_other_places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `home_cleaning_other_place_service_requests`
--
ALTER TABLE `home_cleaning_other_place_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `mover_utility_action_logs`
--
ALTER TABLE `mover_utility_action_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `moving_item_categories`
--
ALTER TABLE `moving_item_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment_plan_subscriptions`
--
ALTER TABLE `payment_plan_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `payment_plan_types`
--
ALTER TABLE `payment_plan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_transaction_details`
--
ALTER TABLE `payment_transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `quotation_logs`
--
ALTER TABLE `quotation_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tech_concierge_other_details`
--
ALTER TABLE `tech_concierge_other_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tech_concierge_other_detail_service_requests`
--
ALTER TABLE `tech_concierge_other_detail_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tech_concierge_places`
--
ALTER TABLE `tech_concierge_places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tech_concierge_place_service_requests`
--
ALTER TABLE `tech_concierge_place_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tech_concierge_service_requests`
--
ALTER TABLE `tech_concierge_service_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `utility_companies`
--
ALTER TABLE `utility_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `utility_company_services`
--
ALTER TABLE `utility_company_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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

--
-- Constraints for table `utility_companies`
--
ALTER TABLE `utility_companies`
  ADD CONSTRAINT `utility_companies_ibfk_1` FOREIGN KEY (`utility_id`) REFERENCES `utilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utility_company_services`
--
ALTER TABLE `utility_company_services`
  ADD CONSTRAINT `utility_company_services_ibfk_1` FOREIGN KEY (`utility_company_id`) REFERENCES `utility_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
