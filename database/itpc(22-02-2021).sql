-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2021 at 09:44 AM
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
-- Database: `itpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `itpc_about`
--

CREATE TABLE `itpc_about` (
  `about_id` int(11) NOT NULL,
  `about_content` longtext NOT NULL,
  `about_header` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_about`
--

INSERT INTO `itpc_about` (`about_id`, `about_content`, `about_header`) VALUES
(1, '<p><strong>ITPC Barcelona</strong></p>\r\n<p>Indonesian Trade Promotion Center (ITPC) is a non-profit organization under the supervision of the directorate general for national export development.&nbsp;Both institution are part of global trade network abroad supervised by the Ministry of Trade of the Republic of Indonesia, with a common goal to enhance the export of Indonesian products thought the world. <br /><br />Facing the rapid growth of global economy, especially in a very competitive environment,&nbsp; ITPC provides services for Spanish business partners with facilitation to enhance two-way trade engagements and expected to bridge and connect potential traders between Indonesian and Spain.</p>\r\n<p><strong>Functions</strong></p>\r\n<ul>\r\n<li>Provide facility for Marketing of Indonesian export products and enhancement of the trade mission in the accredited countries</li>\r\n<li>Provide facility for Development of the business contacts and cooperation between Indonesian business council and the business communities in the accredited countries (business matching)</li>\r\n<li>Provide the business information and market opportunities in host countries and assist Indonesian business community about potential products in overseas markets</li>\r\n<li>Provide the information services on the potential export products to the foreign buyers</li>\r\n<li>Undertake the market analysis and improving business Intelligence and networking with business communities in host countries</li>\r\n<li>Disseminating information to the Spanish&nbsp; business communities;</li>\r\n<li>Prepare the work program and budgets as well as administrative and financial duties corresponding to the existing regulation</li>\r\n</ul>\r\n<p><strong>Functions</strong></p>\r\n<ul>\r\n<li>To boost the Indonesian non oil and gas export development to the Spain through market penetration, information, dissemination, trade inquiry services, expanding the business contacts between Indonesian exporters and Spanish importers, and active participation in various trade exhibition in Spain.</li>\r\n<li>To assist Indonesian companies in participating trade shows throughout the Spain.</li>\r\n<li>Promoting international trade by providing trade inquiry services to Indonesian companies and Spanish companies.</li>\r\n<li>Matchmaking assistance, arranging the meeting between Indonesian exporters and Spanish importers.</li>\r\n<li>Promoting Indonesian economic growth to enhance business contracts between Indonesian exporters and U.S. importers.</li>\r\n</ul>', 'Rectangle 47.png');

-- --------------------------------------------------------

--
-- Table structure for table `itpc_admin`
--

CREATE TABLE `itpc_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_role` int(1) NOT NULL DEFAULT 1,
  `create_date` datetime NOT NULL,
  `create_by` int(1) NOT NULL DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(1) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_admin`
--

INSERT INTO `itpc_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_role`, `create_date`, `create_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'ITPC administrator', 'admin@itpc.co.id', '32250170a0dca92d53ec9624f336ca24', 1, '2020-10-09 14:07:34', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_authentication`
--

CREATE TABLE `itpc_authentication` (
  `auth_id` int(11) NOT NULL,
  `auth_code` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_authentication`
--

INSERT INTO `itpc_authentication` (`auth_id`, `auth_code`, `user_id`, `post_date`) VALUES
(1, '$2y$10$HyvV73qC78J0ZBY2P3wkzuYxM3YDoYQByHlHUe.JLMAG2B5N3L3yW', 2, '2020-10-26 14:04:52'),
(2, '$2y$10$spmffnhPJgD9DDwPZ1swSONZdHo.aZI1Rrya5uTrZSqR1HT62JPmG', 1, '2020-11-04 09:39:05'),
(3, '$2y$10$yVCkPpwYn0DyhatC/e4m3uCIpKJRsmKw2Q7t8lMH4CaVVyYuLgtwi', 11, '2020-12-21 16:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `itpc_category`
--

CREATE TABLE `itpc_category` (
  `category_id` int(11) NOT NULL,
  `category_old_id` int(11) DEFAULT NULL,
  `category_title` varchar(300) NOT NULL,
  `category_slug` varchar(300) NOT NULL,
  `category_order` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(1) NOT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_category`
--

INSERT INTO `itpc_category` (`category_id`, `category_old_id`, `category_title`, `category_slug`, `category_order`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, NULL, 'Aluminum And Articles Thereof', 'aluminum-and-articles-thereof', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(2, NULL, 'Animal or Vegetable Fats, Oils , Waxes ', 'Animal or Vegetable Fats, Oils , Waxes ', 2, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(3, NULL, 'Automotives ', 'Automotives ', 3, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(4, NULL, 'Beauty, Make-up & Skin-care , Manicure preps ', 'Beauty, Make-up & Skin-care , Manicure preps ', 4, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(5, NULL, 'Ceramic Products ', 'Ceramic Products ', 5, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(6, NULL, 'Cereals ', 'Cereals ', 6, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(7, NULL, 'Chemical Products ', 'Chemical Products ', 7, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(8, NULL, 'Cocoa and Cocoa Products ', 'Cocoa and Cocoa Products ', 8, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(9, NULL, 'Coconut & Coconut Products ', 'Coconut & Coconut Products ', 9, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(10, NULL, 'Coffee, Tea, Mate, Spices, Herbs ', 'Coffee, Tea, Mate, Spices, Herbs ', 10, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(11, NULL, 'Copper and Articles Thereof ', 'Copper and Articles Thereof ', 11, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(12, NULL, 'Dairy Products ', 'Dairy Products ', 12, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(13, NULL, 'Electronics, Electrical Machinery ', 'Electronics, Electrical Machinery ', 13, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(14, NULL, 'Essential Oils ,Perfumery , Cosmetic ', 'Essential Oils ,Perfumery , Cosmetic ', 14, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(15, NULL, 'Fish, Crustaceans & Aquatic Invertebrates ', 'Fish, Crustaceans & Aquatic Invertebrates ', 15, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(16, NULL, 'Food and Beverages ', 'Food and Beverages ', 16, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(17, NULL, 'Footwear, Gaiters ', 'Footwear, Gaiters ', 17, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(18, NULL, 'Fruits and Vegetables ', 'Fruits and Vegetables ', 18, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(19, NULL, 'Furniture ', 'Furniture ', 19, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(20, NULL, 'Handycraft ', 'Handycraft ', 20, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(21, NULL, 'Houseware, Kitchenware , Tableware, Glassware ', 'Houseware, Kitchenware , Tableware, Glassware ', 21, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(22, NULL, 'Iron and Steel Articles ', 'Iron and Steel Articles ', 22, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(23, NULL, 'Jewellery ', 'Jewellery ', 23, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(24, NULL, 'Leather and Leather Products ', 'Leather and Leather Products ', 24, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(25, NULL, 'Medical Instruments ', 'Medical Instruments ', 25, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(26, NULL, 'Medicaments & Pharmaceutical Products ', 'Medicaments & Pharmaceutical Products ', 26, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(27, NULL, 'Milling Products, Malt , Starch, Wheat Gluten', 'Milling Products, Malt , Starch, Wheat Gluten', 27, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(28, NULL, 'Musical Instruments , Parts & Accesories ', 'Musical Instruments , Parts & Accesories ', 28, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(29, NULL, 'Others Products ', 'Others Products ', 29, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(30, NULL, 'Paper & Stationary ', 'Paper & Stationary ', 30, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(31, NULL, 'Plastic & Plastic Products ', 'Plastic & Plastic Products ', 31, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(32, NULL, 'Rubber and Article Thereof ', 'Rubber and Article Thereof ', 32, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(33, NULL, 'Salt, Sulfur, Earth & Stone, Cement ', 'Salt, Sulfur, Earth & Stone, Cement ', 33, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(34, NULL, 'Soap , Waxes , Polish , Candles , Dental Preps ', 'Soap , Waxes , Polish , Candles , Dental Preps ', 34, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(35, NULL, 'Sugars And Sugar Confectionary ', 'Sugars And Sugar Confectionary ', 35, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(36, NULL, 'Textile and Textile Products ', 'Textile and Textile Products ', 36, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(37, NULL, 'Toys, Games & Sports Equipments', 'Toys, Games & Sports Equipments', 37, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(38, NULL, 'Wood and Forest Products ', 'Wood and Forest Products ', 38, '0000-00-00 00:00:00', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_exporter`
--

CREATE TABLE `itpc_exporter` (
  `exporter_id` int(11) NOT NULL,
  `exporter_name` varchar(100) DEFAULT NULL,
  `exporter_slug` varchar(100) DEFAULT NULL,
  `exporter_logo` varchar(100) DEFAULT NULL,
  `exporter_address` text DEFAULT NULL,
  `exporter_phone` varchar(100) DEFAULT NULL,
  `exporter_office_phone` varchar(100) DEFAULT NULL,
  `exporter_fax` varchar(100) DEFAULT NULL,
  `exporter_email` varchar(100) DEFAULT NULL,
  `exporter_link` text DEFAULT NULL,
  `exporter_home` tinyint(1) NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL,
  `post_by` varchar(30) NOT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(1) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_exporter`
--

INSERT INTO `itpc_exporter` (`exporter_id`, `exporter_name`, `exporter_slug`, `exporter_logo`, `exporter_address`, `exporter_phone`, `exporter_office_phone`, `exporter_fax`, `exporter_email`, `exporter_link`, `exporter_home`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'tedihouse company 5', 'tedihouse_company_5', 'dummy-2.png', 'binus 25', '+6281316947759', NULL, NULL, 'dharma@tedihouse.com', NULL, 1, '2020-10-22 18:26:17', 'user', NULL, NULL, 1),
(2, 'INDAH SARI WINDU, PT', 'indah_sari_windu,-pt', '7377850cce189892331183a5a7cf6c6a.png', 'Jalan Sutomo Baru No.560, Gang Buntu, Medan Timur, Medan, Sumatera Utara 20231, Indonesia', '+62 61 4571224', '(+62)8176551485', '(+62)21-29007045', 'dharmomo04@gmail.com', 'http://www.isw.co.id', 0, '2020-10-22 18:26:48', 'user', NULL, NULL, 1),
(3, 'momo expoter test', 'momo_expoter_test', '-.png', 'jalan harun raya test', '+6281316947759', '+6221-123478', '+6221-123457', 'momotest@tedihouse.com', 'www.tediihouse.com', 0, '2020-12-11 06:38:10', 'user', '2020-12-13 10:06:26', 1, 2),
(4, 'momo expoter', 'momo_expoter', 'dummy-3.png', 'jalan harun raya', '+6281316947758', '+6221-123477', '+6221-123456', 'momoexpoter@tedihouse.com', 'www.google.com', 0, '2020-12-11 14:17:28', 'admin', '2020-12-13 14:47:41', 1, 1),
(5, 'tes', 'tes', 'dummy-2.png', 'tes', '', '', '', 'tes@gmail.com', '', 0, '2020-12-17 03:13:03', 'admin', NULL, NULL, 1),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dharmomo10@gmail.com', NULL, 0, '2020-12-21 07:36:41', 'user', NULL, NULL, 2),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dharmomo04@gmail.com', NULL, 0, '2020-12-21 12:44:41', 'user', NULL, NULL, 2),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dharmomo04@gmail.com', NULL, 0, '2020-12-21 12:51:05', 'user', NULL, NULL, 2),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dharmomo04@gmail.com', NULL, 0, '2020-12-21 13:40:32', 'user', NULL, NULL, 2),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dharmomo04@gmail.com', NULL, 0, '2020-12-21 13:48:15', 'user', NULL, NULL, 2),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dharmomo04@gmail.com', NULL, 0, '2020-12-21 13:49:57', 'user', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_exporter_category`
--

CREATE TABLE `itpc_exporter_category` (
  `ex_cat_id` int(11) NOT NULL,
  `exporter_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(1) NOT NULL DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(1) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_exporter_category`
--

INSERT INTO `itpc_exporter_category` (`ex_cat_id`, `exporter_id`, `category_id`, `subcategory_id`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 1, 1, 1, '2020-12-06 21:57:45', 1, NULL, NULL, 1),
(2, 2, 2, 10, '2020-12-06 21:57:45', 1, NULL, NULL, 1),
(3, 1, 1, 2, '2020-12-06 21:58:40', 1, NULL, NULL, 1),
(4, 2, 2, 11, '2020-12-06 21:58:40', 1, NULL, NULL, 1),
(5, 4, 16, 85, '2020-12-12 15:45:00', 1, '2020-12-13 07:01:22', 1, 2),
(6, 4, 17, 114, '2020-12-12 15:54:13', 1, '2020-12-13 07:46:37', 1, 2),
(7, 4, 15, 77, '2020-12-12 15:55:30', 1, '2020-12-13 07:46:54', 1, 2),
(8, 4, 2, 13, '2020-12-13 06:32:34', 1, '2020-12-13 07:47:14', 1, 2),
(9, 4, 4, 25, '2020-12-13 06:34:46', 1, '2020-12-13 07:47:22', 1, 2),
(10, 4, 13, 55, '2020-12-13 06:36:59', 1, '2020-12-13 07:58:17', 1, 2),
(11, 4, 4, 25, '2020-12-13 06:38:50', 1, '2020-12-13 08:18:57', 1, 2),
(12, 4, 19, 124, '2020-12-13 06:39:00', 1, '2020-12-13 08:39:08', 1, 2),
(13, 4, 12, 54, '2020-12-13 06:41:14', 1, NULL, NULL, 1),
(14, 4, 6, 27, '2020-12-13 06:43:14', 1, NULL, NULL, 1),
(15, 4, 10, 40, '2020-12-13 06:44:49', 1, NULL, NULL, 1),
(16, 4, 2, 18, '2020-12-13 07:40:21', 1, '2020-12-13 07:47:04', 1, 2),
(17, 4, 10, 42, '2020-12-13 08:39:16', 1, NULL, NULL, 1),
(18, 2, 1, 1, '2020-12-13 09:39:00', 1, NULL, NULL, 1),
(19, 11, 1, 3, '2020-12-21 16:25:18', 1, NULL, NULL, 1),
(20, 11, 2, 15, '2020-12-21 16:25:22', 1, NULL, NULL, 1),
(21, 121, 1, 1, '2020-12-21 17:55:48', 121, NULL, NULL, 1),
(22, 11, 1, 1, '2020-12-21 17:57:01', 11, NULL, NULL, 1),
(23, 11, 1, 1, '2020-12-21 18:00:25', 11, '2020-12-21 18:34:02', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_exporter_product`
--

CREATE TABLE `itpc_exporter_product` (
  `ex_pro_id` int(11) NOT NULL,
  `exporter_id` int(11) NOT NULL,
  `ex_pro_image` text DEFAULT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(1) NOT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_exporter_product`
--

INSERT INTO `itpc_exporter_product` (`ex_pro_id`, `exporter_id`, `ex_pro_image`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 11, '20201510145500-1-1.png', '2020-10-15 14:58:08', 1, NULL, NULL, 1),
(2, 11, '20201510145500-1-2.png', '2020-10-15 14:58:44', 1, NULL, NULL, 1),
(3, 11, '20201510145500-1-3.png', '2020-10-15 14:59:16', 1, NULL, NULL, 1),
(4, 11, '20201510145500-1-4.png', '2020-10-15 14:59:44', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_files_inquiry`
--

CREATE TABLE `itpc_files_inquiry` (
  `file_id` int(11) NOT NULL,
  `file_patch` text NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `file_device` varchar(10) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(11) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_files_inquiry`
--

INSERT INTO `itpc_files_inquiry` (`file_id`, `file_patch`, `inquiry_id`, `file_device`, `post_date`, `post_by`, `update_date`, `update_by`, `delete_date`, `delete_by`, `status`) VALUES
(2, '1-1613978178.PNG', 1, 'ios', '2021-02-22 08:16:18', 2, NULL, NULL, NULL, NULL, 1),
(3, 'inquiry-1613978547.jpg', 1, 'ios', '2021-02-22 08:26:39', 2, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_icon`
--

CREATE TABLE `itpc_icon` (
  `icon_id` int(11) NOT NULL,
  `icon_title` varchar(20) NOT NULL,
  `icon_image` varchar(20) NOT NULL,
  `icon_group` varchar(20) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(2) NOT NULL DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_icon`
--

INSERT INTO `itpc_icon` (`icon_id`, `icon_title`, `icon_image`, `icon_group`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'location', 'location.png', 'detail_exporter', '2020-10-19 17:34:28', 1, NULL, NULL, 1),
(2, 'phone', 'phone.png', 'detail_exporter', '2020-10-19 17:46:57', 1, NULL, NULL, 1),
(3, 'smartphone', 'smartphone.png', 'detail_exporter', '2020-10-19 17:47:46', 1, NULL, NULL, 1),
(4, 'fax', 'fax.png', 'detail_exporter', '2020-10-19 17:50:16', 1, NULL, NULL, 1),
(5, 'mail', 'mail.png', 'detail_exporter', '2020-10-19 17:51:18', 1, NULL, NULL, 1),
(6, 'website', 'website.png', 'detail_exporter', '2020-10-19 17:51:37', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_inbox`
--

CREATE TABLE `itpc_inbox` (
  `inbox_id` int(11) NOT NULL,
  `inbox_content` mediumtext DEFAULT NULL,
  `inbox_read` tinyint(1) NOT NULL DEFAULT 0,
  `inquiry_id` int(11) NOT NULL,
  `exporter_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(11) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_inbox`
--

INSERT INTO `itpc_inbox` (`inbox_id`, `inbox_content`, `inbox_read`, `inquiry_id`, `exporter_id`, `post_date`, `post_by`, `update_date`, `update_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'test inbox', 1, 1, 2, '2021-02-20 10:16:45', 1, '2021-02-21 18:07:29', NULL, NULL, NULL, 1),
(2, 'Test ke 2', 1, 1, 2, '2021-02-20 16:29:24', 1, '2021-02-21 18:07:29', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_indo_product`
--

CREATE TABLE `itpc_indo_product` (
  `indo_product_id` int(11) NOT NULL,
  `indo_product_title` varchar(100) NOT NULL,
  `indo_product_thumbnail` varchar(100) NOT NULL,
  `indo_product_file` varchar(100) NOT NULL,
  `indo_product_order` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(2) NOT NULL DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(2) DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_indo_product`
--

INSERT INTO `itpc_indo_product` (`indo_product_id`, `indo_product_title`, `indo_product_thumbnail`, `indo_product_file`, `indo_product_order`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'Textile & Clothing', '20201027195500.png', 'Textile-and-Clothing.pdf', 1, '2020-11-03 15:02:14', 1, NULL, NULL, 1),
(2, 'Sport Shoes', '202010271956.png', 'Sport-Shoes.pdf', 2, '2020-11-03 15:06:27', 1, NULL, NULL, 1),
(3, 'Plastic Houseware', '20201027195700.png', 'Plastic-Housewares.pdf', 3, '2020-11-03 15:10:38', 1, NULL, NULL, 1),
(4, 'Indonesian Rattan', '20201027195800.png', 'Indonesian-Rattan.pdf', 4, '2020-11-03 15:11:49', 1, NULL, NULL, 1),
(5, 'Indonesian Pearls', '20201027195900.png', 'Indonesian-Pearls.pdf', 1, '2020-11-03 15:16:49', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_inquiry`
--

CREATE TABLE `itpc_inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `exporter_id` int(11) NOT NULL,
  `inquiry_title` varchar(500) NOT NULL,
  `exporter_name` varchar(100) DEFAULT NULL,
  `exporter_address` text DEFAULT NULL,
  `progress` int(2) NOT NULL DEFAULT 25,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_detail` mediumtext DEFAULT NULL,
  `product_capacity` int(11) NOT NULL DEFAULT 0,
  `have_export` tinyint(1) NOT NULL DEFAULT 0,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(11) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `approved` enum('waiting','approved','reject') NOT NULL DEFAULT 'waiting',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itpc_log_inquiry`
--

CREATE TABLE `itpc_log_inquiry` (
  `log_id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `action` enum('submit','edit','add_file','delete_file','delete_inquiry','approved','reject') NOT NULL,
  `action_by` int(11) NOT NULL,
  `action_date` datetime NOT NULL,
  `action_role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itpc_news`
--

CREATE TABLE `itpc_news` (
  `news_id` int(11) NOT NULL,
  `news_slug` varchar(300) NOT NULL,
  `news_order` int(11) NOT NULL DEFAULT 1,
  `news_title` varchar(300) NOT NULL,
  `tag_id` int(5) DEFAULT NULL,
  `news_thumbnail_type` int(2) NOT NULL DEFAULT 1,
  `news_thumbnail` varchar(100) DEFAULT NULL,
  `news_header` varchar(100) DEFAULT NULL,
  `news_youtube` varchar(300) DEFAULT NULL,
  `news_content` longtext NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(2) NOT NULL DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_news`
--

INSERT INTO `itpc_news` (`news_id`, `news_slug`, `news_order`, `news_title`, `tag_id`, `news_thumbnail_type`, `news_thumbnail`, `news_header`, `news_youtube`, `news_content`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'itpc-barcelona-and-trade-attache-madrid-will-participate-alimentaria-2020', 1, 'NEW DATES: ITPC BARCELONA AND TRADE ATTACHE MADRID WILL PARTICIPATE ALIMENTARIA 2020', 1, 1, '20201008162230-thumbnail.jpg', '20201008162230-header.png', NULL, '<h1 class=\"article_heading entry_title check_slabtext\">NEW DATES: ITPC BARCELONA AND TRADE ATTACHE MADRID WILL PARTICIPATE ALIMENTARIA 2020</h1>\r\n<div class=\"clearboth\">&nbsp;</div>\r\n<div class=\"entry\">\r\n<p><strong>The International Food, Drinks and Food Service Trade Show:</strong></p>\r\n<p>Alimentaria is the landmark international event for all professionals in the food, drinks and food service industry and represents an unmissable date with innovation, the latest trends and the internationalisation of the sector. Alimentaria 2020 will be strengthening the unique values that set it apart: internationalisation, innovation, gastronomy, and sector specialisation. The show will also feature a highly attractive offering based on key markets for the food industry and their consumer trends.</p>\r\n<p><strong>Dates :&nbsp;From 14 to 17 September 2020</strong></p>\r\n<p><strong>Venue :</strong>&nbsp;Fira de Barcelona. Gran Via Exhibition Centre. Av. Joan Carles I, 64 08908 L&rsquo;Hospitalet de Llobregat</p>\r\n<p><strong>Indonesian Stand :</strong>&nbsp;<strong>P2 (International) Street F &ndash; Stand 700</strong></p>\r\n<p><strong>Opening hours :&nbsp;14 &ndash; 17 September 2020, Monday to wednesday: 10&nbsp; am to 7 pm | Thursday: 10 am to 6 pm (visitors) &ndash;&nbsp;9 am to 8 pm (exhibitor)</strong></p>\r\n<h1>ALIMENTARIA 2020 WILL DISPLAY THE LATEST TRENDS IN PRODUCTION AND CONSUMPTION AT THE ALIMENTARIA TRENDS SHOW</h1>\r\n<p><strong>Alimentaria, the International Food, Beverages and Food Service Trade Show, will include the new Alimentaria Trends space in its 2020 edition, a meeting point for new developments and innovation arising in the food industry. The trade show, which will occupy 4,500 m<sup>2</sup>&nbsp;and host the participation of around 400 exhibitors, will be organised around five themed areas: Fine Foods (gourmet products), Organic Foods (organic production), Free From (allergens free), Halal Foods (Halal production) and Functional Foods (functional).</strong></p>\r\n<p><strong>Premium products on the rise</strong></p>\r\n<p>The largest space within Alimentaria Trends is that of Fine Foods, which will bring together the largest selection of delicatessen food in an exhibition area covering 2,100 m<sup>2</sup>.</p>\r\n<p>To date, around 50 exhibiting companies have confirmed their participation in Fine Foods, coming mainly from France, Portugal, Italy, the USA and Belgium, including Eurovanille, Prisca, Balfeg&oacute;, Bras del Port, Unusual Trends, Delitast, Giuliano Tartufi, Luxury Spain and Delisur, among others.</p>\r\n<p><strong>The popularity of organic food is growing</strong></p>\r\n<p>As regards the Organic Foods space, it will bring together the largest representation of organic food and beverages, which will occupy more than 1,400 m<sup>2</sup>&nbsp;of exhibition space.</p>\r\n<p>The latest trends in the food sector point clearly and with increasing strength towards the importance of everything that is green, sustainable and ecological. According to The Green Revolution report, carried out by the innovation consultancy Lantern, in Spain, green flexitarian, vegetarian or vegan diets have grown by 27% in recent years and one in ten Spanish people follows one of these diets today, motivated by a concern for animals and sustainability. The organic sector has also increased its popularity for the same reasons. Spain is Europe&rsquo;s largest organic farming producer and has doubled its sales in the last five years.</p>\r\n<p><strong>Increase in halal products</strong></p>\r\n<p>Another of the rising trends seen in the food industry is that of halal products; these will be given visibility in the Halal Foods space, which will occupy 400 m<sup>2</sup>&nbsp;within Alimentaria Trends. The presence of products with Halal certification (allowed under Islamic law) has a good reception in the international market; therefore, Alimentaria 2020 will also offer cooking shows and the 3rd edition of the Halal Congress.</p>\r\n<p>At present, at Mercabarna (Barcelona&rsquo;s wholesalers&rsquo; market), 62% of the lamb and 56% of the beef come from animals are slaughtered according to the precepts of Islam. Forecasts indicate that the halal food and beverage sector will continue to grow without interruption around the world with 1.8 billion Muslims worldwide, a figure that will reach 2.2 billion by 2030. Of these, more than 60% are currently under 30 years of age.</p>\r\n<p>for more information please click link below :</p>\r\n<p><a href=\"https://www.alimentaria.com/en/\">https://www.alimentaria.com/en/</a></p>\r\n</div>', '2020-10-09 12:18:49', 1, NULL, NULL, 1),
(2, 'itpc-barcelona-embassy-of-the-republic-of-indonesia-in-spain-and-trade-attache-madrid-will-participate-bisutex-madrid-2019', 2, 'ITPC BARCELONA, EMBASSY OF THE REPUBLIC OF INDONESIA IN SPAIN AND TRADE ATTACHE MADRID WILL PARTICIPATE BISUTEX MADRID 2019', 2, 1, '20201009125300-thumbnail.png', '20201009125300-header.png', NULL, '<h1 class=\"article_heading entry_title check_slabtext\">ITPC BARCELONA, EMBASSY OF THE REPUBLIC OF INDONESIA IN SPAIN AND TRADE ATTACHE MADRID WILL PARTICIPATE BISUTEX MADRID 2019</h1>\r\n<div class=\"clearboth\">&nbsp;</div>\r\n<div class=\"entry\">\r\n<p>&nbsp;</p>\r\n<p>The high quality and design of the collections are the hallmarks of Bisutex, the International Fashion Jewellery and Accessories Fair, which reopens its doors at Hall 8 at Feria de Madrid to present the latest products and trends from 550 companies and brands. The event is marked by its growing international character, which this year brings together companies from 20 countries, as well as especially invited participants from France and Brazil.</p>\r\n<p>There will be a wide assortmnet of new products ranging from the latest fashion jewellery collections to fantasy watch lines, glasses, handbags, belts, hair ornaments, handkerchiefs, hats, trimmings, etc. As usual, the leather and &nbsp;travel goods sector is also well represented at the event.</p>\r\n<p>The show &nbsp;has space to promote and encourage young designers and brands. The Bisutex Minis have established themselves as a key point of reference for new creators seeking to position themselves in the market. During this years fair, 48 companies will take part presenting attractive proposals in costume jewellery, fashion accessories, sunglasses, bags, hats, shawls, and so on.</p>\r\n<p>The ARCHI area at Bisutex presents a selection of 15 national and international companies that stand out for the quality of their products. An innovative and influential offer of trends with participation from the leading brands in the medium-high segment of the fashion jewellery and accessories sector.</p>\r\n<p>The following sectors can be found: Fashion jewellery, sunglasses, handbags, belts, hair ornaments, handkerchiefs, hats, small leather goods, travel items, new collections of suitcases, handbags, fantasy watches and fashion accessories.</p>\r\n<p><strong>Dates :&nbsp;From 12th to 15th September 2019&nbsp;</strong></p>\r\n<p><strong>Venue :</strong>&nbsp;<strong>IFEMA madrid, Av. Parten&oacute;n, N&ordm; 5, 28042 Madrid</strong></p>\r\n<p><strong>Hall 4 : Stand 4A04</strong></p>\r\n<p><strong>Opening hours :&nbsp; PROFESSIONAL ONLY&nbsp;</strong><br /><strong>Schedule From 10 a.m to 19 p.m.&nbsp;</strong><br /><strong>Last day. From: 10 a.m to 18 p.m.</strong></p>\r\n<h3>SECTORS</h3>\r\n<ul>\r\n<li>Fashion jewellery</li>\r\n<li>Hair accesories</li>\r\n<li>Leather accesories</li>\r\n<li>Foulards</li>\r\n<li>Hats</li>\r\n<li>Watches</li>\r\n<li>Sun glasses</li>\r\n<li>Handbags</li>\r\n<li>Travel &iacute;tems</li>\r\n</ul>\r\n<p>For more information please click link below :&nbsp;<a href=\"https://www.ifema.es/en/bisutex\">https://www.ifema.es/en/bisutex</a></p>\r\n</div>', '2020-10-09 14:44:12', 1, NULL, NULL, 1),
(3, 'itpc-barcelona-embassy-of-the-republic-of-indonesia-in-spain-and-trade-attache-madrid-will-participate-bisutex-madrid-2019-tes', 3, 'ITPC BARCELONA, EMBASSY OF THE REPUBLIC OF INDONESIA IN SPAIN AND TRADE ATTACHE MADRID WILL PARTICIPATE BISUTEX MADRID 2019 TES', 3, 1, '20201009125300-thumbnail.png', '20201009125300-header.png', NULL, '<h1 class=\"article_heading entry_title check_slabtext\">ITPC BARCELONA, EMBASSY OF THE REPUBLIC OF INDONESIA IN SPAIN AND TRADE ATTACHE MADRID WILL PARTICIPATE BISUTEX MADRID 2019</h1>\r\n<div class=\"clearboth\">&nbsp;</div>\r\n<div class=\"entry\">\r\n<p>&nbsp;</p>\r\n<p>The high quality and design of the collections are the hallmarks of Bisutex, the International Fashion Jewellery and Accessories Fair, which reopens its doors at Hall 8 at Feria de Madrid to present the latest products and trends from 550 companies and brands. The event is marked by its growing international character, which this year brings together companies from 20 countries, as well as especially invited participants from France and Brazil.</p>\r\n<p>There will be a wide assortmnet of new products ranging from the latest fashion jewellery collections to fantasy watch lines, glasses, handbags, belts, hair ornaments, handkerchiefs, hats, trimmings, etc. As usual, the leather and &nbsp;travel goods sector is also well represented at the event.</p>\r\n<p>The show &nbsp;has space to promote and encourage young designers and brands. The Bisutex Minis have established themselves as a key point of reference for new creators seeking to position themselves in the market. During this years fair, 48 companies will take part presenting attractive proposals in costume jewellery, fashion accessories, sunglasses, bags, hats, shawls, and so on.</p>\r\n<p>The ARCHI area at Bisutex presents a selection of 15 national and international companies that stand out for the quality of their products. An innovative and influential offer of trends with participation from the leading brands in the medium-high segment of the fashion jewellery and accessories sector.</p>\r\n<p>The following sectors can be found: Fashion jewellery, sunglasses, handbags, belts, hair ornaments, handkerchiefs, hats, small leather goods, travel items, new collections of suitcases, handbags, fantasy watches and fashion accessories.</p>\r\n<p><strong>Dates :&nbsp;From 12th to 15th September 2019&nbsp;</strong></p>\r\n<p><strong>Venue :</strong>&nbsp;<strong>IFEMA madrid, Av. Parten&oacute;n, N&ordm; 5, 28042 Madrid</strong></p>\r\n<p><strong>Hall 4 : Stand 4A04</strong></p>\r\n<p><strong>Opening hours :&nbsp; PROFESSIONAL ONLY&nbsp;</strong><br /><strong>Schedule From 10 a.m to 19 p.m.&nbsp;</strong><br /><strong>Last day. From: 10 a.m to 18 p.m.</strong></p>\r\n<h3>SECTORS</h3>\r\n<ul>\r\n<li>Fashion jewellery</li>\r\n<li>Hair accesories</li>\r\n<li>Leather accesories</li>\r\n<li>Foulards</li>\r\n<li>Hats</li>\r\n<li>Watches</li>\r\n<li>Sun glasses</li>\r\n<li>Handbags</li>\r\n<li>Travel &iacute;tems</li>\r\n</ul>\r\n<p>For more information please click link below :&nbsp;<a href=\"https://www.ifema.es/en/bisutex\">https://www.ifema.es/en/bisutex</a></p>\r\n</div>', '2020-10-09 14:44:12', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_notif_inquiry`
--

CREATE TABLE `itpc_notif_inquiry` (
  `notif_id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `exporter_id` int(11) NOT NULL,
  `already_read` tinyint(1) NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL,
  `delete_date` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itpc_subcategory`
--

CREATE TABLE `itpc_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_old_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_title` varchar(300) NOT NULL,
  `subcategory_slug` varchar(300) NOT NULL,
  `subcategory_order` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(1) NOT NULL DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(1) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_subcategory`
--

INSERT INTO `itpc_subcategory` (`subcategory_id`, `subcategory_old_id`, `category_id`, `subcategory_title`, `subcategory_slug`, `subcategory_order`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 7601, 1, 'Aluminum, Unwrought', 'aluminum,-unwrought', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(2, 7602, 1, 'Aluminium waste and scrap', 'aluminium-waste-and-scrap', 2, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(3, 7603, 1, 'Aluminium powders and flakes', 'aluminium-powders-and-flakes', 3, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(4, 7604, 1, 'Aluminum Bars, Rods And Profiles', 'aluminum-bars,-rods-and-profiles', 4, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(5, 7605, 1, 'Aluminum Wire', 'aluminum-wire', 5, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(6, 7606, 1, 'Aluminum Plates, Sheets & Strip Over 0,2 mm Thick', 'aluminum-plates,-sheets-&-strip-over-0,2-mm-thick', 6, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(7, 7608, 1, 'Aluminium tubes and pipes', 'aluminium-tubes-and-pipes', 7, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(8, 7609, 1, 'Aluminum Tube Or Pipe Fittings', 'aluminum-tube-or-pipe-fittings', 8, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(9, 7610, 1, 'Aluminum Structures & Parts Of', 'aluminum-structures-&-parts-of', 9, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(10, 1504, 2, 'Fish Oil ', 'fish-oil ', 10, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(11, 1511, 2, 'Palm Oil and Its Fractions', 'palm-oil-and-its-fractions', 11, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(12, 1512, 2, 'Sunflower Oil', 'sunflower-oil', 12, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(13, 1513, 2, 'Coconut Oil', 'coconut-oil', 13, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(14, 1515, 2, 'Fixed Vegetable Fats ', 'fixed-vegetable-fats ', 14, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(15, 1516, 2, 'Animal or vegetable fats and oils and their fractions', 'animal-or-vegetable-fats-and-oils-and-their-fractions', 15, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(16, 1517, 2, 'Margarine ', 'margarine ', 16, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(17, 1518, 2, 'Cooking Oil ', 'cooking-oil ', 17, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(18, 1519, 2, 'Fatty Acid', 'fatty-acid', 18, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(19, 1520, 2, 'Glycerol', 'glycerol', 19, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(20, 1521, 2, 'Vegetable waxes ', 'vegetable-waxes ', 20, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(21, 8703, 3, 'Motor, cars, and other motor vehicles', 'motor,-cars,-and-other-motor-vehicles', 21, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(22, 8708, 3, 'Parts and accessories of the motor vehicles', 'parts-and-accessories-of-the-motor-vehicles', 22, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(23, 8711, 3, 'Motorcycles ', 'motorcycles ', 23, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(24, 8714, 3, 'Parts and accessories of motorcycles ', 'parts-and-accessories-of-motorcycles ', 24, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(25, 3304, 4, 'Beauty, make-up, skin care', 'beauty,-make-up,-skin-care', 25, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(26, 6907, 5, 'Unglazed Ceramic Flags & Paving, Hearth Tiles', 'unglazed-ceramic-flags-&-paving,-hearth-tiles', 26, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(27, 1006, 6, 'Rice', 'rice', 27, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(28, 2839, 7, 'Silicates ', 'silicates ', 28, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(29, 2922, 7, 'Oxygen-function amino-compounds.', 'oxygen-function-amino-compounds.', 29, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(30, 3802, 7, 'Activated Carbon', 'activated-carbon', 30, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(31, 3823, 7, 'Fat Acid, Acid Oil (Industrial)', 'fat-acid,-acid-oil-(industrial)', 31, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(32, 3826, 7, 'Biodiesel', 'biodiesel', 32, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(33, 1801, 8, 'Cocoa Beans ', 'cocoa-beans ', 33, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(34, 1802, 8, 'Cocoa Shells', 'cocoa-shells', 34, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(35, 1803, 8, 'Cocoa Paste', 'cocoa-paste', 35, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(36, 1804, 8, 'Cocoa Butter', 'cocoa-butter', 36, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(37, 1805, 8, 'Cocoa Powder ', 'cocoa-powder ', 37, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(38, 1806, 8, 'Chocolate and other food preparations containing cocoa', 'chocolate-and-other-food-preparations-containing-cocoa', 38, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(39, 801, 9, 'Coconut (Fresh or Dry) ', 'coconut-(fresh-or-dry)-', 39, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(40, 901, 10, 'Coffee ', 'coffee ', 40, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(41, 902, 10, 'Tea ', 'tea ', 41, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(42, 903, 10, 'Matè ', 'matè ', 42, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(43, 904, 10, 'Pepper ', 'pepper ', 43, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(44, 905, 10, 'Vanilla', 'vanilla', 44, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(45, 906, 10, 'Cinnamon ', 'cinnamon ', 45, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(46, 907, 10, 'Cloves ', 'cloves ', 46, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(47, 908, 10, 'Nutmeg', 'nutmeg', 47, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(48, 909, 10, 'Seeds of anise, badian, fennel, coriander, cumin or caraway ', 'seeds-of-anise,-badian,-fennel,-coriander,-cumin-or-caraway ', 48, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(49, 910, 10, '0910 Ginger, saffron, turmeric (curcuma), thyme, bay leaves, curry and other spices.', '0910-ginger,-saffron,-turmeric-(curcuma),-thyme,-bay-leaves,-curry-and-other-spices.', 49, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(50, 7403, 11, 'Refined Copper & Alloys (Unwrought)', 'refined-copper-&-alloys-(unwrought)', 50, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(51, 401, 12, 'Milk & Cream (Concentrated/Sweetened)', 'milk-&-cream-(concentrated/sweetened)', 51, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(52, 402, 12, 'Milk & Cream (Unconcentrated/Un Sweetened)', 'milk-&-cream-(unconcentrated/un-sweetened)', 52, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(53, 406, 12, 'Cheese and Curd', 'cheese-and-curd', 53, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(54, 409, 12, 'Honey ', 'honey ', 54, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(55, 8415, 13, 'Air conditioning machines', 'air-conditioning-machines', 55, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(56, 8418, 13, 'Refrigerators, freezers ', 'refrigerators,-freezers ', 56, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(57, 8438, 13, 'Food Machinery & Parts ', 'food-machinery-&-parts ', 57, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(58, 8443, 13, 'Printing machinery & Parts ', 'printing-machinery-&-parts ', 58, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(59, 8450, 13, 'Washing Machines', 'washing-machines', 59, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(60, 8501, 13, 'Electric motors and generators', 'electric-motors-and-generators', 60, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(61, 8502, 13, 'Electric generating sets and rotary converters', 'electric-generating-sets-and-rotary-converters', 61, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(62, 8503, 13, 'Electrical transformers, static converters', 'electrical-transformers,-static-converters', 62, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(63, 8504, 13, 'Primary cells and primary batteries ', 'primary-cells-and-primary-batteries ', 63, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(64, 8506, 13, 'Electric accumulators', 'electric-accumulators', 64, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(65, 8507, 13, 'Vacuum cleaners', 'vacuum-cleaners', 65, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(66, 8508, 13, 'Electro-mechanical domestic appliances', 'electro-mechanical-domestic-appliances', 66, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(67, 8509, 13, 'Shavers, hair clippers and hair-removing appliances', 'shavers,-hair-clippers-and-hair-removing-appliances', 67, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(68, 8510, 13, 'Electrical ignition or starting equipment', 'electrical-ignition-or-starting-equipment', 68, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(69, 8511, 13, 'Electric instantaneous or storage water heaters and immersion heaters', 'electric-instantaneous-or-storage-water-heaters-and-immersion-heaters', 69, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(70, 8516, 13, 'Telephone sets', 'telephone-sets', 70, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(71, 8517, 13, 'Microphones , loudspeakers, Audio Sets (1)', 'microphones-,-loudspeakers,-audio-sets (1)', 71, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(72, 8518, 13, 'Video recording or reproducing apparatus', 'video-recording-or-reproducing-apparatus', 72, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(73, 8521, 13, 'Monitors, Projectors & Receivers', 'monitors,-projectors-&-receivers', 73, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(74, 8541, 13, 'Diodes, transistors and similar semiconductor devices', 'diodes,-transistors-and-similar-semiconductor-devices', 74, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(75, 3301, 14, 'Essential oils', 'essential-oils', 75, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(76, 3302, 14, 'Perfumes and toilet waters.', 'perfumes-and-toilet-waters.', 76, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(77, 301, 15, 'Live fish', 'live-fish', 77, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(78, 302, 15, 'Fish, fresh or chilled', 'fish,-fresh-or-chilled', 78, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(79, 303, 15, 'Fish, frozen ', 'fish,-frozen ', 79, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(80, 304, 15, 'Fish fillets and other fish meat', 'fish-fillets-and-other-fish-meat', 80, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(81, 305, 15, 'Fish, dried, salted or in brine , smoked fish', 'fish,-dried,-salted-or-in-brine-,-smoked-fish', 81, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(82, 306, 15, 'Crustaceans ', 'crustaceans ', 82, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(83, 307, 15, 'Molluscs', 'molluscs', 83, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(84, 308, 15, 'Aquatic invertebrates other than crustaceans and molluscs, live, fresh, chilled, frozen, dried, salted or in brine ', 'aquatic-invertebrates-other-than-crustaceans-and-molluscs,-live,-fresh,-chilled,-frozen,-dried,-salted-or-in-brine ', 84, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(85, 1601, 16, 'Sausages ', 'sausages ', 85, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(86, 1602, 16, 'Prepared Or Preserved Meat', 'prepared-or-preserved-meat', 86, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(87, 1603, 16, 'Extracts Meat, Fish & Crustaceans', 'extracts-meat,-fish-&-crustaceans', 87, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(88, 1604, 16, 'Prepared or preserved fish', 'prepared-or-preserved-fish', 88, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(89, 1605, 16, 'Crustaceans, molluscs prepared or preserved (2)', 'crustaceans,-molluscs-prepared-or-preserved (2)', 89, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(90, 1901, 16, 'Food preparations of flour', 'food-preparations-of-flour', 90, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(91, 1902, 16, 'Pasta, Noodles ', 'pasta,-noodles ', 91, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(92, 1903, 16, 'Tapioca ', 'tapioca ', 92, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(93, 1904, 16, 'Cereal ', 'cereal ', 93, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(94, 1905, 16, 'Bread, pastry, cakes, biscuits', 'bread,-pastry,-cakes,-biscuits', 94, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(95, 1910, 16, 'Vegetables and Fruit Preserved (drained, glace or crystallised)', 'vegetables-and-fruit-preserved-(drained,-glace-or-crystallised)', 95, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(96, 2001, 16, 'Vegetables, fruit, nuts ', 'vegetables,-fruit,-nuts ', 96, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(97, 2002, 16, 'Tomatoes ', 'tomatoes ', 97, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(98, 2003, 16, 'Mushrooms and truffles', 'mushrooms-and-truffles', 98, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(99, 2004, 16, 'Other Vegetables', 'other-vegetables', 99, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(100, 2007, 16, 'Jams & fruit jellies', 'jams-&-fruit-jellies', 100, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(101, 2008, 16, 'Fruit, nuts etc prepared or preserved', 'fruit,-nuts-etc-prepared-or-preserved', 101, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(102, 2101, 16, 'Fruit & vegetable juices', 'fruit-&-vegetable-juices', 102, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(103, 2103, 16, 'Extracts, essences and concentrates', 'extracts,-essences-and-concentrates', 103, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(104, 2104, 16, 'Sauces ', 'sauces ', 104, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(105, 2105, 16, 'Soups & broths', 'soups-&-broths', 105, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(106, 2106, 16, 'Ice cream', 'ice-cream', 106, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(107, 2201, 16, 'Other Food Preparations ', 'other-food-preparations ', 107, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(108, 2202, 16, 'Natural or artificial mineral waters ', 'natural-or-artificial-mineral-waters ', 108, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(109, 2203, 16, 'Mineral & aerated waters (flavoured) ', 'mineral-&-aerated-waters-(flavoured) ', 109, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(110, 2204, 16, 'Beer', 'beer', 110, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(111, 2205, 16, 'Wine of fresh grapes,', 'wine-of-fresh-grapes,', 111, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(112, 2206, 16, 'Other fermented beverages', 'other-fermented-beverages', 112, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(113, 2209, 16, 'Vinegar', 'vinegar', 113, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(114, 6402, 17, 'Footwear (rubber or plastics)', 'footwear-(rubber-or-plastics)', 114, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(115, 6403, 17, 'Footwear (Leather)', 'footwear-(leather)', 115, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(116, 709, 18, 'Other vegetables ', 'other-vegetables ', 116, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(117, 714, 18, 'Cassava, Arrowroot & Sago Pith', 'cassava,-arrowroot-&-sago-pith', 117, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(118, 803, 18, 'Banana', 'banana', 118, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(119, 804, 18, 'Dates, Figs, Pineapples, Avocados ', 'dates,-figs,-pineapples,-avocados ', 119, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(120, 805, 18, 'Citrus Fruit ', 'citrus-fruit ', 120, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(121, 8302, 19, 'Hardware, Fixtures, Castors, Base Metal ', 'hardware,-fixtures,-castors,-base-metal ', 121, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(122, 8303, 19, 'Safes, Cash Or Deed Boxes , Base Metal ', 'safes,-cash-or-deed-boxes-,-base-metal ', 122, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(123, 8304, 19, 'Office And Desk Equip (Base Metal) ', 'office-and-desk-equip-(base-metal) ', 123, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(124, 9401, 19, 'Seats ', 'seats ', 124, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(125, 9402, 19, 'Medical Furniture ', 'medical-furniture ', 125, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(126, 9403, 19, 'Furniture (Wooden, Bamboo, Rattan, Plastic)', 'furniture-(wooden,-bamboo,-rattan,-plastic)', 126, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(127, 9403, 19, 'Other Furnitures & Parts ', 'other-furnitures-&-parts ', 127, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(128, 9404, 19, 'Matress ', 'matress ', 128, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(129, 9405, 19, 'Lamp & Lighting ', 'lamp-&-lighting ', 129, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(130, 9406, 19, 'Prefabricated Buildings', 'prefabricated-buildings', 130, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(131, 4402, 20, 'Marquetry, Jewel Case', 'marquetry,-jewel-case', 131, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(132, 3924, 21, 'Tableware, kitchenware (Plastic)', 'tableware,-kitchenware-(plastic)', 132, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(133, 4419, 21, 'Tableware and kitchenware (Wood)', 'tableware-and-kitchenware-(wood)', 133, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(134, 6918, 21, 'Tableware and kitchenware (Ceramic)', 'tableware-and-kitchenware-(ceramic)', 134, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(135, 7013, 21, 'Glassware For Table, Kitchen, Toilet', 'glassware-for-table,-kitchen,-toilet', 135, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(136, 9603, 21, 'Brooms, brushes', 'brooms,-brushes', 136, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(137, 7220, 22, 'Flat-rolled products of stainless steel', 'flat-rolled-products-of-stainless-steel', 137, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(138, 7301, 22, 'Sheet piling of iron or steel', 'sheet-piling-of-iron-or-steel', 138, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(139, 7113, 23, 'Jewellery and parts thereof ', 'jewellery-and-parts-thereof-', 139, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(140, 4115, 24, 'Composition leather ', 'composition-leather ', 140, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(141, 4201, 24, 'Saddlery and harness ', 'saddlery-and-harness ', 141, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(142, 4202, 24, 'Trunks, Bags , Suit-cases', 'trunks,-bags-,-suit-cases', 142, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(143, 4203, 24, 'Leather apparel and clothing', 'leather-apparel-and-clothing', 143, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(144, 4205, 24, 'Articles Of Leather', 'articles-of-leather', 144, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(145, 4303, 24, 'Articles & Apparel Of Furskin', 'articles-&-apparel-of-furskin', 145, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(146, 9018, 25, 'Instruments and appliances used in medical', 'instruments-and-appliances-used-in-medical', 146, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(147, 3002, 26, 'Vaccines', 'vaccines', 147, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(148, 3004, 26, 'Medicaments', 'medicaments', 148, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(149, 3005, 26, 'Wadding, bandages, plasters', 'wadding,-bandages,-plasters', 149, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(150, 3006, 26, 'Pharmaceutical goods', 'pharmaceutical-goods', 150, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(151, 1101, 27, 'Wheat', 'wheat', 151, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(152, 1102, 27, 'Cereal Flours', 'cereal-flours', 152, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(153, 1103, 27, 'Cereal Groats, Meal And Pellets', 'cereal-groats,-meal-and-pellets', 153, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(154, 1104, 27, 'Cereal Grains', 'cereal-grains', 154, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(155, 1105, 27, 'Flour, Meal Flakes, Granules & Pellets Of Potatoes', 'flour,-meal-flakes,-granules-&-pellets-of-potatoes', 155, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(156, 1107, 27, 'Malt', 'malt', 156, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(157, 1108, 27, 'Starches', 'starches', 157, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(158, 9209, 28, 'Parts Musical, Metronones, T Fork', 'parts-musical,-metronones,-t-fork', 158, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(159, 106, 29, 'Worms', 'worms', 159, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(160, 1207, 29, 'Oil Seeds & Oleaginous Fruits', 'oil-seeds-&-oleaginous-fruits', 160, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(161, 1212, 29, 'Locust Beans, Seaweed, S Beet & Cane ', 'locust-beans,-seaweed,-s-beet-&-cane ', 161, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(162, 1302, 29, 'Curcumin', 'curcumin', 162, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(163, 2306, 29, 'Oilcake From Veg Fats & Oils', 'oilcake-from-veg-fats-&-oils', 163, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(164, 2309, 29, 'Animal Feed', 'animal-feed', 164, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(165, 2701, 29, 'Coal, Briquettes ', 'coal,-briquettes ', 165, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(166, 3105, 29, 'Bio and Organic Fertilizer', 'bio-and-organic-fertilizer', 166, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(167, 9101, 29, 'Watches ', 'watches ', 167, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(168, 9601, 29, 'Worked ivory, bone', 'worked-ivory,-bone', 168, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(169, 48, 30, 'Paper & Paperboard , Articles', 'paper-&-paperboard-,-articles', 169, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(170, 4801, 30, 'Newsprint ', 'newsprint ', 170, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(171, 4802, 30, 'Uncoated paper and paperboard', 'uncoated-paper-and-paperboard', 171, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(172, 4803, 30, 'Toilet or facial tissue stock ', 'toilet-or-facial-tissue-stock ', 172, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(173, 4804, 30, 'Uncoated kraft paper and paperboard ', 'uncoated-kraft-paper-and-paperboard ', 173, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(174, 4809, 30, 'Carbon paper, self-copy paper ', 'carbon-paper,-self-copy-paper ', 174, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(175, 4813, 30, 'Cigarette paper ', 'cigarette-paper ', 175, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(176, 4814, 30, 'Wallpaper ', 'wallpaper ', 176, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(177, 4817, 30, 'Envelopes, letter cards, plain postcards ', 'envelopes,-letter-cards,-plain-postcards ', 177, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(178, 4818, 30, 'Toilet Paper, Towels', 'toilet-paper,-towels', 178, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(179, 4818, 30, 'Cartons, boxes, cases, bags', 'cartons,-boxes,-cases,-bags', 179, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(180, 3918, 31, 'Floor coverings of plastics ', 'floor-coverings-of-plastics ', 180, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(181, 3924, 31, 'Tableware & Other Household Articles ', 'tableware-&-other-household-articles ', 181, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(182, 3925, 31, 'Builders\' Ware Of Plastics ', 'builders\'-ware-of-plastics ', 182, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(183, 3926, 31, 'Articles Of Plastics', 'articles-of-plastics', 183, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(184, 4001, 32, 'Natural Rubber', 'natural-rubber', 184, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(185, 4002, 32, 'Synthetic Rubber', 'synthetic-rubber', 185, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(186, 4003, 32, 'Reclaim Rub In Primary Form/plates, Sheets/strip', 'reclaim-rub-in-primary-form/plates,-sheets/strip', 186, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(187, 4005, 32, 'Compounded Rubber (unvulcanized)', 'compounded-rubber-(unvulcanized)', 187, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(188, 4007, 32, 'Vulcanized Rubber', 'vulcanized-rubber', 188, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(189, 4008, 32, 'Plates, Sheets, Profile Shapes', 'plates,-sheets,-profile-shapes', 189, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(190, 4009, 32, 'Tubes, Pipes & Hoses Of Unhard Vulcanized Rubber', 'tubes,-pipes-&-hoses-of-unhard-vulcanized-rubber', 190, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(191, 4010, 32, 'Conveyor Or Transmiss Belts', 'conveyor-or-transmiss-belts', 191, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(192, 4011, 32, 'New Pneumatic Tires ', 'new-pneumatic-tires ', 192, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(193, 4013, 32, 'Inner Tubes For Tires ', 'inner-tubes-for-tires ', 193, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(194, 4015, 32, 'Articles of apparel and clothing accessories', 'articles-of-apparel-and-clothing-accessories', 194, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(195, 2501, 33, 'Salt', 'salt', 195, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(196, 2502, 33, 'Unroasted Iron Pyrites', 'unroasted-iron-pyrites', 196, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(197, 2503, 33, 'Sulfur', 'sulfur', 197, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(198, 2504, 33, 'Natural Graphite', 'natural-graphite', 198, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(199, 2505, 33, 'Natural Sands', 'natural-sands', 199, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(200, 2506, 33, 'Quartz', 'quartz', 200, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(201, 2508, 33, 'Clays, Andalusite, Kyanite, Mullite', 'clays,-andalusite,-kyanite,-mullite', 201, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(202, 2509, 33, 'Chalk', 'chalk', 202, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(203, 2523, 33, 'Cement ', 'cement ', 203, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(204, 2524, 33, 'Asbestos', 'asbestos', 204, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(205, 2530, 33, 'Mineral substances (others)', 'mineral-substances-(others)', 205, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(206, 3401, 34, 'Soaps', 'soaps', 206, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(207, 3404, 34, 'Waxes', 'waxes', 207, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(208, 3405, 34, 'Polish Cream', 'polish-cream', 208, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(209, 3406, 34, 'Candles', 'candles', 209, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(210, 1701, 35, 'Cane Or Beet Sugar (solid)', 'cane-or-beet-sugar-(solid)', 210, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(211, 1702, 35, 'Caramel, Chemical Pure Lactose', 'caramel,-chemical-pure-lactose', 211, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(212, 1703, 35, 'Molasses', 'molasses', 212, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(213, 1704, 35, 'Sugar Confection (incl White Chocolate)', 'sugar-confection-(incl-white-chocolate)', 213, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(214, 5006, 36, 'Silk yarn', 'silk-yarn', 214, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(215, 5007, 36, 'Woven fabrics of silk', 'woven-fabrics-of-silk', 215, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(216, 5202, 36, 'Cotton waste', 'cotton-waste', 216, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(217, 5305, 36, 'Coconut, Abaca, Ramie Fiber', 'coconut,-abaca,-ramie-fiber', 217, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(218, 5402, 36, 'Synthetic Filament Yarn', 'synthetic-filament-yarn', 218, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(219, 5509, 36, 'Yarn', 'yarn', 219, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(220, 5510, 36, 'Yarn', 'yarn', 220, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(221, 5701, 36, 'Carpets & Textile Floor Coverings', 'carpets-&-textile-floor-coverings', 221, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(222, 6101, 36, 'Men\'s or Boy\'s overcoats', 'men\'s-or-boy\'s-overcoats', 222, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(223, 6102, 36, 'Women’s or girls’ overcoats, car-coats, capes, cloaks, anoraks (including ski-jackets), wind-cheaters, wind-jackets and similar articles, knitted or crocheted', 'women’s-or-girls’-overcoats,-car-coats,-capes,-cloaks,-anoraks-(including-ski-jackets),-wind-cheaters,-wind-jackets-and-similar-articles,-knitted-or-crocheted', 223, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(224, 6115, 36, 'Panty hose, tights, stockings, socks', 'panty-hose,-tights,-stockings,-socks', 224, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(225, 6116, 36, 'Gloves', 'gloves', 225, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(226, 6204, 36, 'Women’s or girls’ suits, ensembles, jackets, blazers, dresses, skirts, divided skirts, trousers, bib and brace overalls, breeches and shorts', 'women’s-or-girls’-suits,-ensembles,-jackets,-blazers,-dresses,-skirts,-divided-skirts,-trousers,-bib-and-brace-overalls,-breeches-and-shorts', 226, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(227, 6206, 36, 'Women’s or girls’ blouses, shirts and shirt-blouses', 'women’s-or-girls’-blouses,-shirts-and-shirt-blouses', 227, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(228, 6303, 36, 'Curtains , Interior blinds', 'curtains-,-interior-blinds', 228, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(229, 6704, 36, 'Wigs, false beards, eyebrows and eyelashes', 'wigs,-false-beards,-eyebrows-and-eyelashes', 229, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(230, 9506, 37, 'Articles and equipment for general physical exercise', 'articles-and-equipment-for-general-physical-exercise', 230, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(231, 1401, 38, 'Bamboos, Rattans', 'bamboos,-rattans', 231, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(232, 4401, 38, 'Fuel Wood', 'fuel-wood', 232, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(233, 4402, 38, 'Charcoal (Wood, Shell, Nut)', 'charcoal-(wood,-shell,-nut)', 233, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(234, 4407, 38, 'Wood Sawn Or Chipped Length', 'wood-sawn-or-chipped-length', 234, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(235, 4408, 38, 'Veneer Sheets', 'veneer-sheets', 235, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(236, 4410, 38, 'Particle Board', 'particle-board', 236, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(237, 4412, 38, 'Plywood, Veneered Panels & Similar Laminated Wood', 'plywood,-veneered-panels-&-similar-laminated-wood', 237, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(238, 4421, 38, 'Other articles of wood', 'other-articles-of-wood', 238, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(239, 4701, 38, 'Mechanical Woodpulp', 'mechanical-woodpulp', 239, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(240, 4702, 38, 'Chemical Woodpulp', 'chemical-woodpulp', 240, '0000-00-00 00:00:00', 1, NULL, NULL, 1),
(241, NULL, 15, 'Albacore or longfinned tunas', 'Albacore_or_longfinned_tunas', 39, '2021-01-21 06:45:59', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_tag`
--

CREATE TABLE `itpc_tag` (
  `tag_id` int(11) NOT NULL,
  `tag_title` varchar(100) NOT NULL,
  `tag_slug` varchar(100) NOT NULL,
  `tag_order` varchar(11) NOT NULL DEFAULT '1',
  `post_date` datetime NOT NULL,
  `post_by` int(1) NOT NULL DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(1) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_tag`
--

INSERT INTO `itpc_tag` (`tag_id`, `tag_title`, `tag_slug`, `tag_order`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'Exhibition', 'exhibition', '1', '2020-10-08 14:44:01', 1, NULL, NULL, 1),
(2, 'Internasional Event', 'internasional_event', '2', '2020-10-08 14:46:23', 1, NULL, NULL, 1),
(3, 'Internasional Trade', 'internasional_trade', '3', '2020-10-08 14:47:38', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_useful`
--

CREATE TABLE `itpc_useful` (
  `useful_id` int(11) NOT NULL,
  `userful_title` varchar(100) NOT NULL,
  `useful_logo` varchar(100) NOT NULL,
  `useful_link` text DEFAULT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(2) DEFAULT 1,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_useful`
--

INSERT INTO `itpc_useful` (`useful_id`, `userful_title`, `useful_logo`, `useful_link`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'kemendag', 'logo-kemendag.png', 'https://www.kemendag.go.id/id', '2020-11-03 17:59:50', 1, NULL, NULL, 1),
(2, 'djpen kemendag', 'logo-dgned.png', 'http://djpen.kemendag.go.id/', '2020-11-03 18:01:10', 1, NULL, NULL, 1),
(3, 'kbri', 'logo-kbri.png', 'http://embajadaindonesia.es/', '2020-11-03 18:16:57', 1, NULL, NULL, 1),
(4, 'BKPM', 'logo-bkpm.png', 'http://www.bkpm.go.id/', '2020-11-03 18:18:21', 1, NULL, NULL, 1),
(5, 'Indonesia travel', 'logo-wonderful-indonesia.png', 'http://www.indonesia.travel/', '2020-11-03 18:18:57', 1, NULL, NULL, 1),
(6, 'Kemenlu', 'logo-kemenlu.png', 'http://www.kemlu.go.id/', '2020-11-03 18:19:41', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itpc_user`
--

CREATE TABLE `itpc_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `password_text` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `expoter_id` int(11) DEFAULT NULL,
  `post_date` datetime NOT NULL,
  `post_by` varchar(30) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(30) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_user`
--

INSERT INTO `itpc_user` (`user_id`, `username`, `password`, `password_text`, `email`, `expoter_id`, `post_date`, `post_by`, `delete_date`, `delete_by`, `status`) VALUES
(1, 'dharmomo05', '$2y$10$WTiCgz7vBUikUMizKDFiMOLpz/6l8FdBMoyQP6jRpXe7dq0N34pLK', 'pass1234', 'dharmomo05@gmail.com', 1, '2020-10-22 18:26:17', 'user', NULL, NULL, 1),
(2, 'dharmomo04', '$2y$10$wv6NkEq82guE88qWilAvpOMVCZPJhjdT87576BVIr/2l/9gK1tkym', 'pass1234', 'dharmomo07@gmail.com', 2, '2020-10-22 18:26:48', 'user', NULL, NULL, 1),
(3, 'momo3', '$2y$10$uMOpsh2dI78kkmj6M79kauw4G8WtuQxxnVPJe4pcmu8MXdB4zJRq.', 'momo-2020-12-11', 'momo3@tedihouse.com', 3, '2020-12-11 06:38:10', 'user', NULL, NULL, 2),
(4, 'momoexpoter', '$2y$10$ewuXpv.PVPYdx3YIoVRrmutHHYd9HcQUetWkj7250G.rEp9ifk2ei', 'momo-2020-12-11', 'momoexpoter@tedihouse.com', 4, '2020-12-11 14:17:28', 'admin', NULL, NULL, 2),
(5, 'tes', '$2y$10$cMJN3HUdfdOw1clSuGVfGeMoSo6k1S7XCx3710F/A5HjswCMpSpt2', 'tes-2020-12-17', 'tes@gmail.com', 5, '2020-12-17 03:13:03', 'admin', NULL, NULL, 2),
(6, 'dharmomo10', '$2y$10$2uuPzsccSuit3UkN5SoPMuB2XLHNYkDM55y.NhCJArRHwAkdBwRbW', 'pass12346', 'dharmomo10@gmail.com', 6, '2020-12-21 07:36:41', 'user', NULL, NULL, 2),
(7, 'dharmomo04', '$2y$10$6hOurufpmr/3aJTfhe1GOOJ1poi5SXfVySoz4WI/3C8u/JvmlY95a', 'pass1234', 'dharmomoXX4@gmail.com', 7, '2020-12-21 12:44:41', 'user', NULL, NULL, 2),
(8, 'dharmomo04', '$2y$10$lDit5yfMwjh6vgBaCDR8U.WxNLoYiwjxRltqF3m5jZl2twcNXnwT2', 'pass1234', 'dharmomo04555@gmail.com', 8, '2020-12-21 12:51:05', 'user', NULL, NULL, 2),
(9, 'dharmomo04', '$2y$10$W.5RY7e6XG9FpZMKl1ruHOCDUeGRhR/.6ISYC7MwSn3y.CYzpNlrq', 'pass1234', 'dharmomo123@gmail.com', 9, '2020-12-21 13:40:32', 'user', NULL, NULL, 2),
(10, 'dharmomo04', '$2y$10$Qn9zFSwTN2KUmr0tX0IjF.JkTtk7wO9rz0NZovaUVsHE401YRXKyO', 'pass1234', 'dharmomo90890@gmail.com', 10, '2020-12-21 13:48:15', 'user', NULL, NULL, 2),
(11, 'dharmomo04', '$2y$10$AxHvgJ30PfwnCYqde.h6Y.9dzG8RRXxysAI5WhBYTmpkUlxjrgV3C', 'pass1234', 'dharmomo04@gmail.com', 11, '2020-12-21 13:49:57', 'user', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itpc_about`
--
ALTER TABLE `itpc_about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `itpc_admin`
--
ALTER TABLE `itpc_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `itpc_authentication`
--
ALTER TABLE `itpc_authentication`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `itpc_category`
--
ALTER TABLE `itpc_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `itpc_exporter`
--
ALTER TABLE `itpc_exporter`
  ADD PRIMARY KEY (`exporter_id`);

--
-- Indexes for table `itpc_exporter_category`
--
ALTER TABLE `itpc_exporter_category`
  ADD PRIMARY KEY (`ex_cat_id`);

--
-- Indexes for table `itpc_exporter_product`
--
ALTER TABLE `itpc_exporter_product`
  ADD PRIMARY KEY (`ex_pro_id`);

--
-- Indexes for table `itpc_files_inquiry`
--
ALTER TABLE `itpc_files_inquiry`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `itpc_icon`
--
ALTER TABLE `itpc_icon`
  ADD PRIMARY KEY (`icon_id`);

--
-- Indexes for table `itpc_inbox`
--
ALTER TABLE `itpc_inbox`
  ADD PRIMARY KEY (`inbox_id`);

--
-- Indexes for table `itpc_indo_product`
--
ALTER TABLE `itpc_indo_product`
  ADD PRIMARY KEY (`indo_product_id`);

--
-- Indexes for table `itpc_inquiry`
--
ALTER TABLE `itpc_inquiry`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `itpc_log_inquiry`
--
ALTER TABLE `itpc_log_inquiry`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `itpc_news`
--
ALTER TABLE `itpc_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `itpc_notif_inquiry`
--
ALTER TABLE `itpc_notif_inquiry`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `itpc_subcategory`
--
ALTER TABLE `itpc_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `itpc_tag`
--
ALTER TABLE `itpc_tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `itpc_useful`
--
ALTER TABLE `itpc_useful`
  ADD PRIMARY KEY (`useful_id`);

--
-- Indexes for table `itpc_user`
--
ALTER TABLE `itpc_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itpc_about`
--
ALTER TABLE `itpc_about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itpc_admin`
--
ALTER TABLE `itpc_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itpc_authentication`
--
ALTER TABLE `itpc_authentication`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itpc_category`
--
ALTER TABLE `itpc_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `itpc_exporter_category`
--
ALTER TABLE `itpc_exporter_category`
  MODIFY `ex_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `itpc_exporter_product`
--
ALTER TABLE `itpc_exporter_product`
  MODIFY `ex_pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `itpc_files_inquiry`
--
ALTER TABLE `itpc_files_inquiry`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itpc_icon`
--
ALTER TABLE `itpc_icon`
  MODIFY `icon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `itpc_inbox`
--
ALTER TABLE `itpc_inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itpc_indo_product`
--
ALTER TABLE `itpc_indo_product`
  MODIFY `indo_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itpc_inquiry`
--
ALTER TABLE `itpc_inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itpc_log_inquiry`
--
ALTER TABLE `itpc_log_inquiry`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itpc_news`
--
ALTER TABLE `itpc_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itpc_notif_inquiry`
--
ALTER TABLE `itpc_notif_inquiry`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itpc_subcategory`
--
ALTER TABLE `itpc_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `itpc_tag`
--
ALTER TABLE `itpc_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itpc_useful`
--
ALTER TABLE `itpc_useful`
  MODIFY `useful_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `itpc_user`
--
ALTER TABLE `itpc_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
