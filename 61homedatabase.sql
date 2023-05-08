-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 01:50 AM
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
-- Database: `61homedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `username` char(6) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL,
  `shift_id` int(1) NOT NULL,
  `location_id` int(1) NOT NULL,
  `in_time` int(11) NOT NULL,
  `notes` varchar(120) NOT NULL,
  `image` varchar(50) NOT NULL,
  `lack_of` varchar(11) NOT NULL,
  `in_status` varchar(15) NOT NULL,
  `out_time` int(11) NOT NULL,
  `out_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `username`, `employee_id`, `department_id`, `shift_id`, `location_id`, `in_time`, `notes`, `image`, `lack_of`, `in_status`, `out_time`, `out_status`) VALUES
(67, 'emp004', 004, 'emp', 1, 1, 1677082853, '', '', 'Notes,image', 'Late', 1677082863, 'Over Time'),
(68, 'emp004', 004, 'emp', 1, 1, 1677170102, '', '', 'Notes,image', 'Late', 1677170105, 'Over Time');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` char(3) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
('emp', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `gender` char(1) CHARACTER SET utf8 NOT NULL,
  `image` varchar(128) CHARACTER SET utf8 NOT NULL,
  `birth_date` date NOT NULL,
  `hire_date` date NOT NULL,
  `shift_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `gender`, `image`, `birth_date`, `hire_date`, `shift_id`) VALUES
(004, 'สงกรานต์ บรรหาญ', 'andi@gmail.com', 'M', 'default.png', '1998-01-01', '2020-03-01', 1),
(025, 'Admin ', 'admin@admin.com', 'M', 'default.png', '0000-00-00', '0000-00-00', 0),
(028, 'จูเลียน รีเวีย', 'bent_za_a@hotmail.com', 'M', 'default.png', '2001-12-07', '2023-02-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(3) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `employee_id`, `department_id`) VALUES
(1, 004, 'emp'),
(2, 028, 'emp');

-- --------------------------------------------------------

--
-- Table structure for table `informations`
--

CREATE TABLE `informations` (
  `information_id` int(10) NOT NULL,
  `information_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `information_details` varchar(200) CHARACTER SET utf8 NOT NULL,
  `information_date` datetime NOT NULL,
  `information_img` varchar(100) CHARACTER SET utf8 NOT NULL,
  `information_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `informations`
--

INSERT INTO `informations` (`information_id`, `information_name`, `information_details`, `information_date`, `information_img`, `information_delete`) VALUES
(1, 'ประชาสัมพันธ์', 'ประชาสัมพันธ์ประชาสัมพันธ์ประชาสัมพันธ์', '2023-02-13 13:52:32', '', 1),
(2, 'ข่าวสาร', 'ข่าวสารข่าวสารประชาสัมพันธ์ประชาสัมพันธ์', '2023-02-13 13:58:31', '3421020310822_daniel-black-love-rng-02.jpg', 0),
(3, 'c', 'ข่าวสาร', '2023-02-26 00:46:32', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(1) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, '61 homecafe');

-- --------------------------------------------------------

--
-- Table structure for table `materialbuyers`
--

CREATE TABLE `materialbuyers` (
  `matbuy_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `matbuy_receipt_no` varchar(11) CHARACTER SET utf8 NOT NULL,
  `matbuy_date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `matbuy_status` varchar(50) CHARACTER SET utf8 NOT NULL,
  `matbuy_service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materialbuyers`
--

INSERT INTO `materialbuyers` (`matbuy_id`, `employee_id`, `user_id`, `matbuy_receipt_no`, `matbuy_date_added`, `matbuy_status`, `matbuy_service_id`) VALUES
(1, 16, 0, '1', '2023-02-18 16:16:53', 'ซื้อของเข้าร้านเรียบร้อยแล้ว', 0),
(9, 0, 0, '2', '2023-02-19 22:27:44', 'รอการซื้อของเข้าร้าน', 0),
(10, 0, 0, '10', '2023-02-19 22:29:16', 'รอการซื้อของเข้าร้าน', 0),
(11, 16, 0, '11', '2023-02-19 22:29:36', 'ซื้อของเข้าร้านเรียบร้อยแล้ว', 0),
(12, 16, 0, '12', '2023-02-19 22:30:29', 'ซื้อของเข้าร้านเรียบร้อยแล้ว', 0),
(13, 16, 0, '13', '2023-02-19 23:13:08', 'ซื้อของเข้าร้านเรียบร้อยแล้ว', 0);

-- --------------------------------------------------------

--
-- Table structure for table `materialbuyers_detail`
--

CREATE TABLE `materialbuyers_detail` (
  `matbuy_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `matbuy_detail_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materialbuyers_detail`
--

INSERT INTO `materialbuyers_detail` (`matbuy_id`, `material_id`, `matbuy_detail_quantity`) VALUES
(1, 6, 3),
(1, 7, 2),
(1, 8, 2),
(1, 18, 2),
(2, 6, 3),
(2, 7, 3),
(3, 6, 1),
(3, 7, 1),
(4, 6, 1),
(4, 7, 1),
(5, 18, 1),
(5, 19, 1),
(6, 6, 1),
(6, 7, 1),
(7, 7, 4),
(8, 6, 1),
(2, 6, 1),
(2, 7, 1),
(10, 6, 1),
(10, 7, 1),
(11, 21, 1),
(11, 22, 1),
(12, 21, 1),
(12, 22, 1),
(13, 6, 2),
(13, 27, 2),
(13, 26, 2);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(10) NOT NULL,
  `promotion_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `promotion_details` varchar(200) CHARACTER SET utf8 NOT NULL,
  `promotion_date` datetime NOT NULL,
  `promotion_img` varchar(100) CHARACTER SET utf8 NOT NULL,
  `promotion_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `promotion_name`, `promotion_details`, `promotion_date`, `promotion_img`, `promotion_delete`) VALUES
(21, 'ซื้อของแถมของ', 'ซื้อ1แถม3', '2023-02-13 00:11:28', '0213380024002_264630051_3057922011122331_7008239865783425907_n.png', 0),
(22, 'benz', 'benz', '2023-02-13 00:16:57', '0201200203326_317427611_3395320184072602_8632304811208424360_n.jpg', 0),
(23, 'test111111', 'testtesttest 11111111111 ', '2023-02-13 00:18:39', '', 1),
(24, 'test', 'testtesttest111111', '2023-02-13 00:56:39', '5206130023200_264630051_3057922011122331_7008239865783425907_n.png', 0),
(25, 'test', 'testtesttesttest', '2023-02-25 21:47:36', '', 1),
(26, 'หัวโล้น', 'ไอ่ชูหัวโล้น', '2023-02-25 21:48:37', '', 1),
(27, 'dsd', 'sdsd', '2023-02-25 21:53:34', '', 1),
(28, 'sdsd', 'sdsd', '2023-02-25 22:01:18', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salarys`
--

CREATE TABLE `salarys` (
  `salarys_id` int(10) NOT NULL,
  `salarys_month` decimal(8,2) NOT NULL,
  `salarys_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salarys`
--

INSERT INTO `salarys` (`salarys_id`, `salarys_month`, `salarys_delete`) VALUES
(1, '15000.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(1) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `start`, `end`) VALUES
(1, '10:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `employee_id` int(11) NOT NULL,
  `employee_username` varchar(100) NOT NULL,
  `employee_password` varchar(100) NOT NULL,
  `employee_title` varchar(10) NOT NULL,
  `employee_firstname` varchar(100) NOT NULL,
  `employee_surname` varchar(100) NOT NULL,
  `employee_tel` varchar(11) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_workdate` date NOT NULL,
  `employee_img` varchar(100) NOT NULL,
  `employee_position` varchar(20) NOT NULL,
  `employee_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`employee_id`, `employee_username`, `employee_password`, `employee_title`, `employee_firstname`, `employee_surname`, `employee_tel`, `employee_email`, `employee_workdate`, `employee_img`, `employee_position`, `employee_delete`) VALUES
(1, 'admin', '12345', 'นาย', 'สงกรานต์', 'บรรหาญ', '0837609998', 'benz@rmutl.ac.th', '2023-01-01', '3202200021341_104374440_2825555037678714_7529296112458620385_n.jpg', 'admin', 0),
(6, 'owner', '12345', 'นาย', 'สงกรานต์', 'บรรหาญ', '0875672637', 'owner@gmail.com', '2023-01-01', '5220050220341_2.jpg', 'เจ้าของร้าน', 0),
(16, 'employee', '12345', 'นาย', 'sd', 'sds', '0837609998', 'benz@rmutl.ac.th', '2023-01-03', '4022020125530_264630051_3057922011122331_7008239865783425907_n.png', 'พนักงาน', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_listmaterial_to_product`
--

CREATE TABLE `tb_listmaterial_to_product` (
  `listmaterial_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `listmaterial_quantity` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_listmaterial_to_product`
--

INSERT INTO `tb_listmaterial_to_product` (`listmaterial_id`, `product_id`, `material_id`, `listmaterial_quantity`) VALUES
(24, 13, 6, 300.00),
(26, 15, 6, 100.00),
(27, 15, 7, 1.00),
(28, 15, 8, 100.00),
(30, 18, 6, 11.00),
(66, 66, 7, 2.00),
(67, 66, 6, 1.00),
(71, 19, 7, 1.00),
(72, 19, 8, 100.00),
(75, 0, 6, 100.00),
(76, 0, 7, 2.00),
(77, 0, 10, 100.00),
(78, 0, 10, 100.00),
(79, 26, 10, 100.00),
(80, 27, 10, 100.00),
(81, 25, 10, 100.00),
(83, 20, 6, 100.00),
(84, 21, 6, 100.00),
(85, 22, 6, 100.00),
(86, 22, 7, 1.00),
(87, 23, 6, 100.00),
(88, 24, 6, 100.00),
(89, 74, 7, 1.00),
(90, 74, 6, 100.00),
(91, 74, 8, 100.00),
(92, 74, 10, 100.00),
(93, 80, 7, 1.00),
(94, 80, 8, 1.00),
(98, 84, 25, 1.00),
(99, 84, 27, 1.00),
(100, 83, 18, 1.00),
(101, 81, 18, 1.00),
(102, 81, 19, 1.00),
(104, 85, 21, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_material_list`
--

CREATE TABLE `tb_material_list` (
  `material_id` int(11) NOT NULL,
  `typematerial_id` int(2) NOT NULL,
  `material_name` varchar(100) NOT NULL,
  `material_date_created` datetime NOT NULL,
  `material_date_updated` datetime NOT NULL,
  `material_description` varchar(200) NOT NULL,
  `material_usedunit` varchar(20) NOT NULL,
  `material_buyunit` varchar(20) NOT NULL,
  `material_buyconversionused` double(8,2) DEFAULT NULL,
  `material_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_material_list`
--

INSERT INTO `tb_material_list` (`material_id`, `typematerial_id`, `material_name`, `material_date_created`, `material_date_updated`, `material_description`, `material_usedunit`, `material_buyunit`, `material_buyconversionused`, `material_delete`) VALUES
(18, 17, 'นมสด', '2023-01-08 16:17:45', '2023-01-08 16:20:11', 'นมสด', 'มิลลิลิตร', 'แกลลอน', 1000.00, 0),
(19, 16, 'นมข้น', '2023-01-08 16:18:37', '2023-01-08 16:20:06', 'นมข้น', 'มิลลิลิตร', 'ถุง', 1000.00, 0),
(20, 17, 'ครีมเทียม', '2023-01-08 16:19:25', '2023-01-08 16:20:02', 'ครีมเทียม', 'มิลลิลิตร', 'ถุง', 1000.00, 0),
(21, 18, 'ไข่ไก่', '2023-01-08 16:19:56', '2023-01-08 16:19:56', 'ไข่ไก่', 'ฟอง', 'แผง', 1000.00, 0),
(22, 18, 'น้ำตาล', '2023-01-08 16:20:56', '2023-01-08 16:20:56', 'น้ำตาล', 'กรัม', 'ถุง', 1000.00, 0),
(23, 18, 'แป้งสาลี', '2023-01-08 16:21:55', '2023-01-08 16:21:55', 'แป้งสาลี', 'กรัม', 'ถุง', 1000.00, 0),
(24, 16, 'เมล็ดกาแฟ', '2023-01-08 16:23:05', '2023-01-08 16:23:05', 'เมล็ดกาแฟ', 'กรัม', 'ถุง', 1000.00, 0),
(25, 16, 'ใบชา', '2023-01-08 16:24:41', '2023-01-08 16:24:41', 'ใบชา', 'กรัม', 'ถุง', 1000.00, 0),
(26, 19, 'ผงโกโก้', '2023-01-08 16:38:39', '2023-01-08 16:38:39', 'ผงโกโก้', 'กรัม', 'ถุง', 1000.00, 0),
(27, 16, 'ชาเขียว', '2023-01-08 16:40:12', '2023-01-08 16:40:12', 'ชาเขียว', 'กรัม', 'ถุง', 1000.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_material_stock_list`
--

CREATE TABLE `tb_material_stock_list` (
  `material_stock_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_stock_quantity` double(8,2) NOT NULL,
  `material_stock_remaining` double(8,2) NOT NULL,
  `material_stock_expiry_date` datetime NOT NULL,
  `material_stock_date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `material_stock_price` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_material_stock_list`
--

INSERT INTO `tb_material_stock_list` (`material_stock_id`, `material_id`, `material_stock_quantity`, `material_stock_remaining`, `material_stock_expiry_date`, `material_stock_date_added`, `material_stock_price`) VALUES
(33, 6, 100000.00, 99889.00, '2023-01-20 00:00:00', '2023-01-10 16:33:28', 100.00),
(34, 7, 100.00, 0.00, '2023-01-19 00:00:00', '2023-01-10 16:33:28', 100.00),
(35, 8, 100000.00, 99888.00, '2023-01-20 00:00:00', '2023-01-10 16:33:28', 100.00),
(36, 10, 100000.00, 100000.00, '2023-01-20 00:00:00', '2023-01-07 16:43:18', 100.00),
(37, 13, 100000.00, 100000.00, '2023-01-27 00:00:00', '2023-01-07 16:43:27', 100.00),
(38, 25, 100000.00, 99885.00, '2023-01-20 00:00:00', '2023-01-10 16:34:14', 100.00),
(39, 27, 100000.00, 99885.00, '2023-01-25 00:00:00', '2023-01-10 16:34:14', 100.00),
(40, 19, 100000.00, 100000.00, '2023-01-26 00:00:00', '2023-01-08 16:21:27', 100.00),
(41, 18, 100000.00, 99890.00, '2023-01-19 00:00:00', '2023-01-10 16:34:06', 100.00),
(42, 18, 1000.00, 983.00, '2023-03-17 00:00:00', '2023-02-23 17:02:11', 1.00),
(43, 19, 1000.00, 983.00, '2023-03-17 00:00:00', '2023-02-23 17:02:11', 1.00),
(44, 7, 30.00, 30.00, '2023-02-24 00:00:00', '2023-02-23 16:06:08', 1.00),
(45, 21, 1000.00, 1000.00, '2023-02-24 00:00:00', '2023-02-23 16:08:48', 1.00),
(46, 8, 1000.00, 1000.00, '2023-02-24 00:00:00', '2023-02-23 16:10:04', 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_receipt_no` varchar(11) NOT NULL,
  `order_total` double(8,2) NOT NULL,
  `order_discount` double(8,2) NOT NULL,
  `order_date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `order_expiration_date` datetime DEFAULT NULL,
  `order_status` varchar(50) NOT NULL,
  `order_service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `employee_id`, `user_id`, `order_receipt_no`, `order_total`, `order_discount`, `order_date_added`, `order_expiration_date`, `order_status`, `order_service_id`) VALUES
(1, 16, 13, '1', 100.00, 0.00, '2023-01-10 22:52:34', NULL, 'พนักงาน', 0),
(2, 16, 13, '2', 50.00, 0.00, '2023-01-10 22:52:45', NULL, 'พนักงาน', 0),
(81, 16, 13, '81', 20.00, 0.00, '2023-01-10 23:44:12', NULL, 'ได้รับอาหารแล้ว', 0),
(82, 16, 0, '82', 250.00, 0.00, '2023-02-08 22:45:43', NULL, 'พนักงาน', 0),
(83, 16, 0, '83', 50.00, 0.00, '2023-02-08 22:45:56', NULL, 'พนักงาน', 0),
(84, 16, 13, '84', 50.00, 0.00, '2023-02-08 23:10:36', NULL, 'ได้รับอาหารแล้ว', 0),
(85, 0, 13, '85', 100.00, 0.00, '2023-02-08 23:23:36', '2023-02-11 23:23:36', 'รอการชำระเงิน', 0),
(86, 16, 13, '86', 50.00, 0.00, '2023-02-08 23:25:08', NULL, 'ได้รับอาหารแล้ว', 0),
(87, 16, 13, '87', 50.00, 0.00, '2023-02-08 23:26:27', NULL, 'ได้รับอาหารแล้ว', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_orderdetail`
--

CREATE TABLE `tb_orderdetail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `orderdetail_quantity` int(11) NOT NULL,
  `orderdetail_price` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_orderdetail`
--

INSERT INTO `tb_orderdetail` (`order_id`, `product_id`, `orderdetail_quantity`, `orderdetail_price`) VALUES
(1, 83, 2, 40.00),
(67, 84, 2, 100.00),
(68, 83, 1, 20.00),
(69, 83, 1, 20.00),
(70, 83, 1, 20.00),
(1, 84, 2, 100.00),
(2, 84, 1, 50.00),
(3, 84, 1, 50.00),
(72, 84, 1, 50.00),
(3, 84, 1, 50.00),
(74, 84, 1, 50.00),
(3, 84, 1, 50.00),
(76, 84, 1, 50.00),
(3, 84, 1, 50.00),
(78, 84, 1, 50.00),
(3, 81, 1, 50.00),
(3, 82, 1, 20.00),
(80, 83, 1, 20.00),
(80, 84, 1, 50.00),
(81, 83, 1, 20.00),
(82, 81, 5, 250.00),
(83, 81, 1, 50.00),
(84, 81, 1, 50.00),
(85, 81, 2, 100.00),
(86, 81, 1, 50.00),
(87, 81, 1, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment_notification`
--

CREATE TABLE `tb_payment_notification` (
  `payment_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_name` varchar(100) NOT NULL,
  `payment_price` double(8,2) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_detail` varchar(100) NOT NULL,
  `payment_img` varchar(100) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_payment_notification`
--

INSERT INTO `tb_payment_notification` (`payment_id`, `employee_id`, `user_id`, `order_id`, `payment_name`, `payment_price`, `payment_date`, `payment_detail`, `payment_img`, `payment_status`, `payment_added`) VALUES
(32, 16, 13, 79, 'loso', 1000.00, '2023-01-19 23:34:00', '', '', 'อนุมัติการสั่งซื้อ', '2023-01-10 16:35:29'),
(33, 16, 13, 80, 'loso', 1000.00, '2023-01-26 23:35:00', '', '', 'อนุมัติการสั่งซื้อ', '2023-01-10 16:35:27'),
(34, 16, 13, 81, 'loso', 100.00, '2023-01-14 23:44:00', '', '', 'อนุมัติการสั่งซื้อ', '2023-01-10 16:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_list`
--

CREATE TABLE `tb_product_list` (
  `product_id` int(11) NOT NULL,
  `typeproduct_id` int(2) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(200) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_unit` varchar(20) NOT NULL,
  `product_status` varchar(20) NOT NULL,
  `product_date_created` datetime NOT NULL,
  `product_date_updated` datetime NOT NULL,
  `product_img` varchar(100) NOT NULL,
  `product_make` varchar(20) NOT NULL,
  `product_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product_list`
--

INSERT INTO `tb_product_list` (`product_id`, `typeproduct_id`, `product_name`, `product_description`, `product_price`, `product_unit`, `product_status`, `product_date_created`, `product_date_updated`, `product_img`, `product_make`, `product_delete`) VALUES
(81, 4, 'เอสเปรสโซ่', 'เอสเปรสโซ่ ', 50, 'แก้ว', 'เปิดขาย', '2023-01-08 16:30:20', '2023-01-08 22:49:07', '8302710202020_closeup-classic-fresh-espresso-served-dark-surface.jpg', 'ทำเอง', 0),
(82, 3, 'ขนมปังเนยอบกรอบ', 'ขนมปังเนยอบกรอบ ', 20, 'ถุง', 'เปิดขาย', '2023-01-08 16:31:46', '2023-01-08 22:48:59', '2223205900018_bake.jpg', 'รับมาขาย', 0),
(83, 3, 'บราวนี่', 'บราวนี่ ', 20, 'ชิ้น', 'เปิดขาย', '2023-01-08 16:36:42', '2023-01-08 22:48:50', '0000130582222_brownie.jpg', 'ทำเอง', 0),
(84, 4, 'ชาเขียว', 'ชาเขียว ', 50, 'แก้ว', 'เปิดขาย', '2023-01-08 16:39:21', '2023-01-08 22:48:35', '2002523080123_aasas.jpg', 'ทำเอง', 0),
(85, 3, 'sdsd', 'dsds  ', 1, 'ชิ้น', 'เปิดขาย', '2023-02-23 23:06:38', '2023-02-23 23:11:49', '2333023020822_Hanni-NewJeans.png', 'ทำเอง', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_stock_list`
--

CREATE TABLE `tb_product_stock_list` (
  `product_stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_stock_quantity` int(10) NOT NULL,
  `product_stock_remaining` int(10) NOT NULL,
  `product_stock_expiry_date` datetime NOT NULL,
  `product_stock_date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_stock_price` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product_stock_list`
--

INSERT INTO `tb_product_stock_list` (`product_stock_id`, `product_id`, `product_stock_quantity`, `product_stock_remaining`, `product_stock_expiry_date`, `product_stock_date_added`, `product_stock_price`) VALUES
(45, 33, 100, 79, '2023-01-13 00:00:00', '2022-10-04 14:14:31', 10.00),
(46, 35, 100, 100, '2023-01-19 00:00:00', '2022-10-04 13:57:40', 10.00),
(47, 37, 100, 99, '2023-01-02 00:00:00', '2022-09-04 13:59:11', 50.00),
(48, 47, 100, 100, '2023-01-04 00:00:00', '2022-07-04 14:18:03', 500.00),
(49, 48, 2, 2, '2023-01-04 00:00:00', '2023-01-06 16:10:28', 5.00),
(50, 48, 3, 3, '2023-01-06 00:00:00', '2023-01-07 16:15:28', 5.00),
(51, 48, 5, 5, '2023-01-04 00:00:00', '2023-01-07 16:15:42', 1.00),
(52, 48, 5, 5, '2023-01-04 00:00:00', '2023-01-07 16:19:58', 4.00),
(53, 48, 2, 2, '2023-01-20 00:00:00', '2023-01-07 16:33:32', 1.00),
(54, 49, 100, 99, '2023-01-25 00:00:00', '2023-01-07 16:36:20', 100.00),
(55, 48, 98, 97, '2023-01-19 00:00:00', '2023-01-07 16:36:28', 98.00),
(56, 51, 100, 100, '2023-01-19 00:00:00', '2023-01-07 16:36:36', 100.00),
(57, 52, 100, 100, '2023-01-27 00:00:00', '2023-01-07 16:36:42', 100.00),
(58, 80, 1, 1, '2023-01-28 00:00:00', '2023-01-07 16:56:55', 0.00),
(59, 81, 1, 0, '2023-02-01 00:00:00', '2023-01-08 15:57:53', 0.00),
(60, 82, 1, 0, '2023-01-31 00:00:00', '2023-01-08 15:58:02', 1.00),
(61, 84, 1, 0, '2023-01-31 00:00:00', '2023-01-08 15:59:47', 0.00),
(62, 81, 10, 0, '2023-01-25 00:00:00', '2023-01-08 16:20:32', 0.00),
(63, 82, 11, 0, '2023-01-18 00:00:00', '2023-01-08 16:20:42', 3.00),
(64, 84, 14, 0, '2023-01-25 00:00:00', '2023-01-08 16:20:58', 0.00),
(65, 83, 10, 0, '2023-01-18 00:00:00', '2023-01-08 16:21:57', 0.00),
(66, 81, 100, 99, '2023-01-18 00:00:00', '2023-01-10 16:33:28', 0.00),
(67, 82, 100, 99, '2023-01-30 00:00:00', '2023-01-10 16:33:53', 5.00),
(68, 83, 100, 98, '2023-01-23 00:00:00', '2023-01-10 16:34:06', 0.00),
(69, 84, 100, 99, '2023-01-31 00:00:00', '2023-01-10 16:34:14', 0.00),
(70, 81, 1, 0, '2023-03-17 00:00:00', '2023-02-08 15:12:32', 0.00),
(71, 81, 5, 0, '2023-02-23 00:00:00', '2023-02-08 15:12:44', 0.00),
(72, 81, 10, 5, '2023-02-24 00:00:00', '2023-02-08 16:09:44', 0.00),
(73, 82, 3, 3, '2023-02-24 00:00:00', '2023-02-22 16:37:01', 0.00),
(74, 81, 1, 1, '2023-02-28 00:00:00', '2023-02-23 17:02:11', 0.00),
(75, 82, 1, 1, '2023-02-27 00:00:00', '2023-02-23 17:02:17', 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_typematerial`
--

CREATE TABLE `tb_typematerial` (
  `typematerial_id` int(2) NOT NULL,
  `typematerial_name` varchar(100) NOT NULL,
  `typematerial_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_typematerial`
--

INSERT INTO `tb_typematerial` (`typematerial_id`, `typematerial_name`, `typematerial_delete`) VALUES
(16, 'สำหรับเครื่องดื่ม', 0),
(17, 'ผลิตภัณฑ์นม', 0),
(18, 'สำหรับเบเกอรี่', 0),
(19, 'อื่นๆ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_typeproduct`
--

CREATE TABLE `tb_typeproduct` (
  `typeproduct_id` int(2) NOT NULL,
  `typeproduct_name` varchar(100) NOT NULL,
  `typeproduct_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_typeproduct`
--

INSERT INTO `tb_typeproduct` (`typeproduct_id`, `typeproduct_name`, `typeproduct_delete`) VALUES
(3, 'เบเกอรี่', 0),
(4, 'เครื่องดื่ม', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_title` varchar(10) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_surname` varchar(100) NOT NULL,
  `user_tel` varchar(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_img` varchar(100) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `user_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_username`, `user_password`, `user_title`, `user_firstname`, `user_surname`, `user_tel`, `user_email`, `user_img`, `usertype_id`, `user_delete`) VALUES
(1, 'user', '12345', 'นาย', 'จูเลียน', 'loso', '0867648727', 'julen@gmail.com', '5283210300020_30245d836d24a5ea9995515f77362312.jpg', 1, 0),
(13, 'member', '12345', 'นาย', 'เบนซ์', 'loso', '0886453726', 'loso@gmail.com', '0002205023821_272072703_532547375062665_1298733303771086835_n.jpg', 1, 0),
(20, 'loso', '1234', 'นาย', 'loso', 'loso', '0876456276', 'test@hotmail.com', '0240220032152_317427611_3395320184072602_8632304811208424360_n.jpg', 1, 0),
(23, 'test', '12345', 'นาย', 'test1', 'test1', '0837609197', 'songkran_ba63@live.rmutl.ac.th', '2913000220131_262346097_4350868655022263_7232224310247802577_n.jpg', 1, 0),
(24, '', '', '', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_usertype`
--

CREATE TABLE `tb_usertype` (
  `usertype_id` int(2) NOT NULL,
  `usertype_name` varchar(100) NOT NULL,
  `usertype_discount` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_usertype`
--

INSERT INTO `tb_usertype` (`usertype_id`, `usertype_name`, `usertype_discount`) VALUES
(1, 'สมาชิก', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(6) NOT NULL,
  `password` varchar(128) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `employee_id`, `role_id`) VALUES
('admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', 025, 1),
('emp004', '$2y$10$Xw2NKoHNn6/t6o8L6pFuuuRrbJKV54CtN9//1CGY/rFKkj/XP.rnS', 004, 2),
('emp028', '$2y$10$cqbX3Dtnv/TqiVFhKq4SFOVwARLnVlSjl2cSaAl2xEaMi4uy0dzxS', 028, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(2) NOT NULL,
  `role_id` int(1) NOT NULL,
  `menu_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(2) NOT NULL,
  `menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Master'),
(3, 'Attendance'),
(4, 'Profile'),
(5, 'Report');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(1) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `user_submenu`
--

CREATE TABLE `user_submenu` (
  `id` int(2) NOT NULL,
  `menu_id` int(2) NOT NULL,
  `title` varchar(20) CHARACTER SET utf8 NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_submenu`
--

INSERT INTO `user_submenu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'ตำแหน่งงาน', 'master', 'fas fa-fw fa-building', 1),
(3, 2, 'เวลางาน', 'master/shift', 'fas fa-fw fa-exchange-alt', 1),
(4, 2, 'พนักงาน', 'master/employee', 'fas fa-fw fa-id-badge', 1),
(5, 2, 'Location', 'master/location', 'fas fa-fw fa-map-marker-alt', 1),
(6, 3, 'การเข้างาน', 'attendance', 'fas fa-fw fa-clipboard-list', 1),
(7, 3, 'Statistics', 'attendance/stats', 'fas fa-fw fa-chart-pie', 0),
(8, 4, 'โปรไฟล์', 'profile', 'fas fa-fw fa-id-card', 1),
(9, 2, 'Users', 'master/users', 'fas fa-fw fa-users', 1),
(11, 5, 'รายงาน', 'report', 'fas fa-fw fa-paste', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_department_ibfk_1` (`employee_id`),
  ADD KEY `employee_department_ibfk_2` (`department_id`);

--
-- Indexes for table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`information_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialbuyers`
--
ALTER TABLE `materialbuyers`
  ADD PRIMARY KEY (`matbuy_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `salarys`
--
ALTER TABLE `salarys`
  ADD PRIMARY KEY (`salarys_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tb_listmaterial_to_product`
--
ALTER TABLE `tb_listmaterial_to_product`
  ADD PRIMARY KEY (`listmaterial_id`);

--
-- Indexes for table `tb_material_list`
--
ALTER TABLE `tb_material_list`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `tb_material_stock_list`
--
ALTER TABLE `tb_material_stock_list`
  ADD PRIMARY KEY (`material_stock_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_payment_notification`
--
ALTER TABLE `tb_payment_notification`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tb_product_list`
--
ALTER TABLE `tb_product_list`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tb_product_stock_list`
--
ALTER TABLE `tb_product_stock_list`
  ADD PRIMARY KEY (`product_stock_id`);

--
-- Indexes for table `tb_typematerial`
--
ALTER TABLE `tb_typematerial`
  ADD PRIMARY KEY (`typematerial_id`);

--
-- Indexes for table `tb_typeproduct`
--
ALTER TABLE `tb_typeproduct`
  ADD PRIMARY KEY (`typeproduct_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tb_usertype`
--
ALTER TABLE `tb_usertype`
  ADD PRIMARY KEY (`usertype_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `informations`
--
ALTER TABLE `informations`
  MODIFY `information_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materialbuyers`
--
ALTER TABLE `materialbuyers`
  MODIFY `matbuy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `salarys`
--
ALTER TABLE `salarys`
  MODIFY `salarys_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_listmaterial_to_product`
--
ALTER TABLE `tb_listmaterial_to_product`
  MODIFY `listmaterial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tb_material_list`
--
ALTER TABLE `tb_material_list`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_material_stock_list`
--
ALTER TABLE `tb_material_stock_list`
  MODIFY `material_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tb_payment_notification`
--
ALTER TABLE `tb_payment_notification`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_product_list`
--
ALTER TABLE `tb_product_list`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_product_stock_list`
--
ALTER TABLE `tb_product_stock_list`
  MODIFY `product_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tb_typematerial`
--
ALTER TABLE `tb_typematerial`
  MODIFY `typematerial_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_typeproduct`
--
ALTER TABLE `tb_typeproduct`
  MODIFY `typeproduct_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_usertype`
--
ALTER TABLE `tb_usertype`
  MODIFY `usertype_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_submenu`
--
ALTER TABLE `user_submenu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_5` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD CONSTRAINT `employee_department_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_department_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_access`
--
ALTER TABLE `user_access`
  ADD CONSTRAINT `user_access_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD CONSTRAINT `user_submenu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
