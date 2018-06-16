-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2018 at 04:57 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acc_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `ap_check_all`
--

CREATE TABLE `ap_check_all` (
  `payment_id` int(11) NOT NULL,
  `po_header_id` varchar(255) NOT NULL,
  `payment_number` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ap_supplier_all`
--

CREATE TABLE `ap_supplier_all` (
  `party_id` int(20) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_site` varchar(255) DEFAULT NULL,
  `supplier_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `tax` float NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `ledger_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_supplier_all`
--

INSERT INTO `ap_supplier_all` (`party_id`, `supplier_name`, `supplier_site`, `supplier_type`, `status`, `tax`, `created_date`, `created_by`, `last_update_date`, `last_update_by`, `ledger_id`) VALUES
(2, 'cba', 'jakarta', 'impor', 'Active', 0.2, '2018-03-22', 'admin', NULL, NULL, '123');

-- --------------------------------------------------------

--
-- Table structure for table `ar_check_all`
--

CREATE TABLE `ar_check_all` (
  `payment_id` int(11) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `payment_number` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `last_update_by` varchar(255) NOT NULL,
  `last_update_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ar_check_all`
--

INSERT INTO `ar_check_all` (`payment_id`, `invoice_id`, `payment_number`, `payment_date`, `payment_type`, `payment_amount`, `created_by`, `created_date`, `last_update_by`, `last_update_date`) VALUES
(271, '20180602091854', 'Dari Toko', '2018-06-02', 'Cash', 200000, 'ben', '2018-06-02', 'ben', '2018-06-02'),
(272, '20180602091917', 'Dari Toko', '2018-06-02', 'Cash', 100000, 'yoha', '2018-06-02', 'yoha', '2018-06-02'),
(273, '20180602100005', 'Dari Toko', '2018-06-02', 'Debit/Credit', 200000, 'yoha', '2018-06-02', 'yoha', '2018-06-02'),
(274, '20180616134116', 'Dari Toko', '2018-06-16', 'Cash', 200000, 'nov', '2018-06-16', 'nov', '2018-06-16'),
(275, '20180616134321', 'Dari Toko', '2018-06-16', 'Cash', 100000, 'asd', '2018-06-16', 'asd', '2018-06-16'),
(276, '20180616135107', 'Dari Toko', '2018-06-16', 'Cash', 100000, 'asd', '2018-06-16', 'asd', '2018-06-16'),
(277, '20180616135520', 'Dari Toko', '2018-06-16', 'Cash', 100000, 'asd', '2018-06-16', 'asd', '2018-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `cogs`
--

CREATE TABLE `cogs` (
  `item_cost_id` int(255) NOT NULL,
  `item_cost` int(16) DEFAULT NULL,
  `periode` date DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `inventory_item_id` varchar(255) DEFAULT NULL,
  `ledger_id` varchar(255) NOT NULL,
  `sales_price` int(20) NOT NULL,
  `outlet_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cogs`
--

INSERT INTO `cogs` (`item_cost_id`, `item_cost`, `periode`, `last_update_date`, `last_update_by`, `created_date`, `created_by`, `type`, `inventory_item_id`, `ledger_id`, `sales_price`, `outlet_id`) VALUES
(1, 45000, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '27', '123', 0, '1'),
(2, 55000, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '36', '123', 0, '1'),
(3, 34000, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '37', '123', 0, '1'),
(4, 1, '2018-04-16', '2018-04-16', 'ben', '2018-04-16', 'ben', 'Manual', '36', '123', 1, '1'),
(5, 1, '2018-04-16', '2018-04-16', 'ben', '2018-04-16', 'ben', 'Manual', '27', '123', 2, '1'),
(6, 1, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '45', '123', 2, '1'),
(7, 1, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 2, '1'),
(8, 2, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 2, '1'),
(9, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '37', '123', 15000, '1'),
(10, 0, '2018-04-04', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 0, '1'),
(11, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '38', '123', 15000, '1'),
(12, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '36', '123', 15000, '1'),
(13, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 15000, '1'),
(14, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '45', '123', 15000, '1'),
(15, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(16, 123, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(17, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(18, 1, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(19, 2, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(20, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 2, '1'),
(21, 1500, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1, '1'),
(22, 1, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(23, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1, '1'),
(24, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1, '1'),
(25, 1500, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 2, '1'),
(26, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 2, '1'),
(27, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1, '1'),
(28, 2, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(29, 2, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0, '1'),
(30, 1000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1500, '1'),
(31, 20000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 25000, '1'),
(32, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 25000, '1'),
(33, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 20000, '1'),
(34, 12500, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 15000, '1'),
(35, 0, '1970-01-01', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '', '123', 0, '1'),
(36, 0, '1970-01-01', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '', '123', 0, '1'),
(37, 0, '1970-01-01', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '', '123', 0, '1'),
(38, 10000, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 10000, '1'),
(39, 15000, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 15000, '1'),
(40, 123, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 123, '1'),
(41, 123, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 123, '1'),
(42, 111, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 111, '1'),
(43, 123, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '36', '123', 123, '1'),
(44, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '36', '123', 15000, '1'),
(45, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '36', '123', 15000, '1'),
(46, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '27', '123', 15000, '1'),
(47, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '37', '123', 15000, '1'),
(48, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '45', '123', 15000, '1'),
(49, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '38', '123', 15000, '1'),
(50, 11000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '27', '123', 15000, '1'),
(51, 12000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '37', '123', 15000, '1'),
(52, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '27', '123', 17000, '1'),
(53, 10000, '2018-05-13', '2018-05-13', 'ben', '2018-05-13', 'ben', 'Manual', '68', '123', 15000, '1'),
(54, 10000, '2018-05-14', '2018-05-14', '123', '2018-05-14', '123', 'Manual', '92', '05141141', 15000, '1'),
(55, 10000, '2018-05-16', '2018-05-16', 'ben', '2018-05-16', 'ben', 'Manual', '27', '123', 10000, '1'),
(56, 10000, '2018-05-16', '2018-05-16', 'ben', '2018-05-16', 'ben', 'Manual', '27', '123', 20000, '1'),
(57, 0, '2018-05-16', '2018-05-16', 'ben', '2018-05-16', 'ben', 'Manual', '40', '123', 20000, '1'),
(58, 5000, '2018-05-19', '2018-05-19', 'ben', '2018-05-19', 'ben', 'Manual', '27', '123', 20000, '1'),
(59, 7500, '2018-05-19', '2018-05-19', 'ben', '2018-05-19', 'ben', 'Manual', '27', '123', 10000, '1'),
(60, 10000, '2018-05-19', '2018-05-19', 'ben', '2018-05-19', 'ben', 'Manual', '70', '123', 5000, '1'),
(61, 5000, '2018-05-25', '2018-05-25', 'ben', '2018-05-25', 'ben', 'Manual', '47', '123', 10000, '1'),
(62, 10, '2018-05-25', '2018-05-25', 'ben', '2018-05-25', 'ben', 'Manual', '48', '123', 10, '1'),
(63, 50000, '2018-06-16', '2018-06-16', 'asd', '2018-06-16', 'asd', 'Manual', '72', '123', 100000, '8');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `outlet_id` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `ledger_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`name`, `role`, `email`, `outlet_id`, `employee_id`, `created_by`, `last_update_by`, `created_date`, `last_update_date`, `password`, `ledger_id`) VALUES
('ben', 'Admin\r\n', 'ben@aa', '1', 12, NULL, NULL, '2018-04-12', NULL, '7815696ecbf1c96e6894b779456d330e', '123'),
('yoha', 'Staff', 'bernard.thoven@gmail.com', '8', 27, NULL, NULL, '2018-05-29', NULL, '7815696ecbf1c96e6894b779456d330e', '123'),
('asd', 'Admin', 'asd@asd', '8', 28, NULL, NULL, '2018-06-16', NULL, '7815696ecbf1c96e6894b779456d330e', '123'),
('nov', 'Admin', 'noviani.sumarto94@gmail.com', '1', 29, NULL, NULL, '2018-06-16', NULL, '7815696ecbf1c96e6894b779456d330e', '123'),
('asdasd', 'Admin', 'asdasdd@asds', '10', 30, NULL, NULL, '2018-06-16', NULL, '7815696ecbf1c96e6894b779456d330e', '06160350'),
('asd1', 'Admin', 'asdasdd@asdaa', '11', 31, NULL, NULL, '2018-06-16', NULL, '7815696ecbf1c96e6894b779456d330e', '06160341');

-- --------------------------------------------------------

--
-- Table structure for table `fmd_recipe_header`
--

CREATE TABLE `fmd_recipe_header` (
  `recipe_id` varchar(20) NOT NULL,
  `recipe_name` varchar(255) NOT NULL,
  `ledger_id` varchar(20) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `outlet_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fmd_recipe_header`
--

INSERT INTO `fmd_recipe_header` (`recipe_id`, `recipe_name`, `ledger_id`, `created_by`, `created_date`, `last_update_by`, `last_update_date`, `outlet_id`) VALUES
('R04150604', 'a', '123', 'ben', '2018-04-15', 'ben', '2018-04-15', ''),
('R04150617', 'aa', '123', 'ben', '2018-04-15', 'ben', '2018-04-15', ''),
('R04150621', 'a2', '123', 'ben', '2018-04-15', 'ben', '2018-04-15', ''),
('R04150644', 'a1', '123', 'ben', '2018-04-15', 'ben', '2018-04-15', ''),
('R04150645', 'aab', '123', 'ben', '2018-04-15', 'ben', '2018-04-15', ''),
('R04150649', 'ben', '123', 'ben', '2018-04-15', 'ben', '2018-04-15', ''),
('R04160345', 'Makaroni', '123', 'ben', '2018-04-16', 'ben', '2018-04-16', '');

-- --------------------------------------------------------

--
-- Table structure for table `fmd_recipe_line`
--

CREATE TABLE `fmd_recipe_line` (
  `recipe_line_id` int(20) NOT NULL,
  `recipe_id` varchar(20) NOT NULL,
  `inventory_item_id` varchar(255) NOT NULL,
  `qty` int(20) NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fmd_recipe_line`
--

INSERT INTO `fmd_recipe_line` (`recipe_line_id`, `recipe_id`, `inventory_item_id`, `qty`, `created_date`, `created_by`, `last_update_by`, `last_update_date`) VALUES
(53, 'R04150604', 'Mario Bros', 1, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(54, 'R04150617', 'Starwars', 2, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(55, 'R04150617', 'Mario Bros', 1, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(56, 'R04150645', 'Nike', 123, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(57, 'R04150645', 'Captain America', 2, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(58, 'R04150645', 'Mario Bros', 1, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(59, 'R04150649', '36', 1, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(60, 'R04150649', '27', 1, '2018-04-15', 'ben', 'ben', '2018-04-15'),
(61, 'R04160345', '2', 1, '2018-04-16', 'ben', 'ben', '2018-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `sales_price` int(11) DEFAULT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `cogs` int(20) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `ledger_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `outlet_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_code`, `description`, `qty`, `sales_price`, `min`, `max`, `cogs`, `created_by`, `last_update_by`, `created_date`, `last_update_date`, `ledger_id`, `status`, `category`, `outlet_id`) VALUES
(27, 'RMT-0000002', 'Mario Bros', 1, 10000, 0, 10, 7500, NULL, 'ben', NULL, '0000-00-00', '123', 'Inactive', 'uncategorized', '1'),
(36, 'RMT-0000003', 'Eye case', 0, 15000, 0, 10, 10000, NULL, 'ben', NULL, '2018-04-24', '123', 'Inactive', 'uncategorized', '1'),
(37, 'RMT-0000004', 'Blue Ceramic', 0, 15000, 0, 10, 12000, NULL, 'ben', NULL, '2018-05-15', '123', 'Inactive', 'uncategorized', '1'),
(38, 'RMT-0000005', 'Pink Flower', 0, 15000, 0, 10, 10000, NULL, 'ben', NULL, '2018-04-24', '123', 'Inactive', 'uncategorized', '1'),
(39, 'RMT-0000006', 'Pineapple Case', 0, 100000, 0, 10, 50000, NULL, '', NULL, NULL, '123', 'Inactive', 'uncategorized', '1'),
(40, 'RMT-0000007', 'Black Flower', 3, 20000, 0, 10, 0, NULL, 'ben', NULL, '2018-05-19', '123', 'Inactive', 'uncategorized', '1'),
(41, 'RMT-0000008', 'Flower case', 0, 100000, 0, 10, 50000, NULL, '', NULL, NULL, '123', 'Inactive', 'uncategorized', '1'),
(42, 'RMT-0000009', 'Pug Case', 8, 100000, 0, 10, 50000, NULL, 'nov', NULL, '2018-06-16', '123', 'Active', 'uncategorized', '1'),
(43, 'RMT-0000010', 'Simpsons', 0, 100000, 0, 10, 50000, NULL, 'ben', NULL, '2018-05-25', '123', 'Active', 'uncategorized', '1'),
(44, 'RMT-0000011', 'Captain America', 0, 100000, 0, 10, 50000, NULL, '', NULL, NULL, '123', 'Inactive', 'uncategorized', '1'),
(45, 'RMT-0000012', 'Nike', 0, 15000, 0, 10, 10000, NULL, 'ben', NULL, '2018-04-24', '123', 'Inactive', 'uncategorized', '1'),
(46, 'RMT-0000013', 'Starwars', 0, 100000, 0, 10, 50000, NULL, '', NULL, NULL, '1233', 'Active', 'uncategorized', '1'),
(47, 'asdfghj', 'asdfgnm', 100, 10000, 1, 1, 5000, 'ben', 'ben', '2018-05-25', '0000-00-00', '123', 'Active', 'uncategorized', '1'),
(48, 'asdasdasd', 'asdasd', 36, 10, 1, 1, 10, 'ben', 'ben', '2018-05-25', '2018-05-25', '123', 'Active', 'uncategorized', '1'),
(49, 'A1', 'AYAMGORENG1', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(50, 'A2', 'AYAMGORENG2', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(51, 'A3', 'AYAMGORENG3', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(52, 'A4', 'AYAMGORENG4', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(53, 'A5', 'AYAMGORENG5', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(54, 'A6', 'AYAMGORENG6', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(55, 'A7', 'AYAMGORENG7', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(56, 'A8', 'AYAMGORENG8', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(57, 'A9', 'AYAMGORENG9', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(58, 'A10', 'AYAMGORENG10', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(59, 'A11', 'AYAMGORENG11', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(60, 'A12', 'AYAMGORENG12', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(61, 'A13', 'AYAMGORENG13', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(62, 'A14', 'AYAMGORENG14', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(63, 'A15', 'AYAMGORENG15', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(64, 'A16', 'AYAMGORENG16', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(65, 'A17', 'AYAMGORENG17', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(66, 'A18', 'AYAMGORENG18', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(67, 'A19', 'AYAMGORENG19', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(68, 'A20', 'AYAMGORENG20', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(69, 'A21', 'AYAMGORENG21', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(70, 'A22', 'AYAMGORENG22', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(71, 'A23', 'AYAMGORENG23', 1, 10000, 1, 10, 5000, 'yoha', 'yoha', '2018-05-25', '2018-05-25', '05251103', 'Active', 'Active', '1'),
(72, 'RMT-00000001', 'Laptop', 107, 100000, 1, 999, 50000, 'asd', 'asd', '2018-06-16', '2018-06-16', '123', 'Active', 'uncategorized', '8');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `unit_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `invoice_line_id` int(11) NOT NULL,
  `invoice_id` varchar(15) NOT NULL,
  `month` varchar(20) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `ledger_id` varchar(255) NOT NULL,
  `inventory_item_id` varchar(255) NOT NULL,
  `tax_code` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `cogs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`unit_price`, `qty`, `date`, `invoice_line_id`, `invoice_id`, `month`, `payment_method`, `last_update_by`, `last_update_date`, `created_by`, `created_date`, `ledger_id`, `inventory_item_id`, `tax_code`, `tax_amount`, `cogs`) VALUES
(100000, 2, '2018-06-02 00:00:00', 1333, '20180602091854', 'June', NULL, 'ben', '2018-06-02', 'ben', '2018-06-02', '123', '42', 0, 0, 50000),
(100000, 1, '2018-06-02 00:00:00', 1334, '20180602091917', 'June', NULL, 'yoha', '2018-06-02', 'yoha', '2018-06-02', '123', '42', 0, 0, 50000),
(100000, 2, '2018-06-02 00:00:00', 1335, '20180602100005', 'June', NULL, 'yoha', '2018-06-02', 'yoha', '2018-06-02', '123', '42', 0, 0, 50000),
(100000, 2, '2018-06-16 00:00:00', 1336, '20180616134116', 'June', NULL, 'nov', '2018-06-16', 'nov', '2018-06-16', '123', '42', 0, 0, 50000),
(100000, 1, '2018-06-16 00:00:00', 1337, '20180616134321', 'June', NULL, 'asd', '2018-06-16', 'asd', '2018-06-16', '123', '72', 0, 0, 50000),
(100000, 1, '2018-06-16 00:00:00', 1338, '20180616135107', 'June', NULL, 'asd', '2018-06-16', 'asd', '2018-06-16', '123', '72', 0, 0, 50000),
(100000, 1, '2018-06-16 00:00:00', 1339, '20180616135520', 'June', NULL, 'asd', '2018-06-16', 'asd', '2018-06-16', '123', '72', 0, 0, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_header`
--

CREATE TABLE `invoice_header` (
  `invoice_id` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `ledger_id` varchar(255) NOT NULL,
  `discount_amount` int(11) DEFAULT NULL,
  `refund_status` varchar(5) DEFAULT NULL,
  `outstanding_status` varchar(5) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `amount_due_remaining` int(11) DEFAULT NULL,
  `tax_code` float NOT NULL,
  `outlet_id` varchar(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_header`
--

INSERT INTO `invoice_header` (`invoice_id`, `invoice_number`, `invoice_date`, `due_date`, `ledger_id`, `discount_amount`, `refund_status`, `outstanding_status`, `created_by`, `created_date`, `last_update_by`, `last_update_date`, `payment_method`, `customer_name`, `amount_due_remaining`, `tax_code`, `outlet_id`, `description`) VALUES
('20180602091854', '091854', '2018-06-02', '2018-06-02', '123', 0, 'No', 'Paid', 'ben', '2018-06-02', 'ben', '2018-06-02', 'Cash', '', 0, 0, '1', NULL),
('20180602091917', '091917', '2018-06-02', '2018-06-02', '123', 0, 'No', 'Paid', 'yoha', '2018-06-02', 'yoha', '2018-06-02', 'Cash', '', 0, 0, '8', NULL),
('20180602100005', '100005', '2018-06-02', '2018-06-02', '123', 0, 'No', 'Paid', 'yoha', '2018-06-02', 'yoha', '2018-06-02', 'Debit/Credit', '', 0, 0, '8', NULL),
('20180616134116', '134116', '2018-06-16', '2018-06-16', '123', 0, 'No', 'Paid', 'nov', '2018-06-16', 'nov', '2018-06-16', 'Cash', '', 0, 0, '1', ''),
('20180616134321', '134321', '2018-06-16', '2018-06-16', '123', 0, 'Yes', 'Paid', 'asd', '2018-06-16', 'asd', '2018-06-16', 'Cash', '', 0, 0, '8', ''),
('20180616135107', '135107', '2018-06-16', '2018-06-16', '123', 0, 'Yes', 'Paid', 'asd', '2018-06-16', 'asd', '2018-06-16', 'Cash', '', 0, 0, '8', ''),
('20180616135520', '135520', '2018-06-16', '2018-06-16', '123', 0, 'Yes', 'Paid', 'asd', '2018-06-16', 'asd', '2018-06-16', 'Cash', '', 0, 0, '8', '');

-- --------------------------------------------------------

--
-- Table structure for table `material_transaction`
--

CREATE TABLE `material_transaction` (
  `transaction_id` int(255) NOT NULL,
  `inventory_item_id` int(20) NOT NULL,
  `ledger_id` varchar(255) NOT NULL,
  `qty` int(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(255) NOT NULL,
  `outlet_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_transaction`
--

INSERT INTO `material_transaction` (`transaction_id`, `inventory_item_id`, `ledger_id`, `qty`, `description`, `created_by`, `created_date`, `last_update_by`, `last_update_date`, `transaction_date`, `type`, `outlet_id`) VALUES
(467, 43, '123', 1, '', 'ben', '2018-05-21', 'ben', '0000-00-00', '2018-05-28 14:45:48', 'Adjustment', '1'),
(468, 42, '123', -1, NULL, 'ben', '2018-05-21', 'ben', '2018-05-21', '2018-05-28 14:45:48', 'Penjualan', '1'),
(469, 43, '123', -1, NULL, 'ben', '2018-05-21', 'ben', '2018-05-21', '2018-05-28 14:45:48', 'Penjualan', '1'),
(470, 42, '123', -1, NULL, 'ben', '2018-05-21', 'ben', '2018-05-21', '2018-05-28 14:45:48', 'Penjualan', '1'),
(471, 42, '123', -1, NULL, 'ben', '2018-05-21', 'ben', '2018-05-21', '2018-05-28 14:45:48', 'Penjualan', '1'),
(472, 47, '123', 100, '', 'ben', '2018-05-25', 'ben', '0000-00-00', '2018-05-28 14:45:48', 'Adjustment', '1'),
(473, 47, '123', -1, NULL, 'ben', '2018-05-25', 'ben', '2018-05-25', '2018-05-28 14:45:48', 'Penjualan', '1'),
(474, 27, '123', 1, '', 'ben', '2018-05-25', 'ben', '0000-00-00', '2018-05-28 14:45:48', 'Adjustment', '1'),
(475, 47, '123', 1, '', 'ben', '2018-05-25', 'ben', '0000-00-00', '2018-05-28 14:45:48', 'Adjustment', '1'),
(476, 48, '123', 20, '', 'ben', '2018-05-25', 'ben', '0000-00-00', '2018-05-28 14:45:48', 'Adjustment', '1'),
(477, 48, '123', -4, NULL, 'ben', '2018-05-25', 'ben', '2018-05-25', '2018-05-28 14:45:48', 'Penjualan', '1'),
(478, 42, '123', -1, NULL, 'ben', '2018-05-25', 'ben', '2018-05-25', '2018-05-28 14:45:48', 'Penjualan', '1'),
(479, 42, '123', 1, 'Refund Invoice:112940', 'ben', '2018-05-25', 'ben', '2018-05-25', '2018-05-28 14:45:48', 'Refund', '1'),
(480, 42, '123', -5, NULL, 'ben', '2018-05-28', 'ben', '2018-05-28', '2018-05-28 14:45:48', 'Penjualan', '1'),
(481, 42, '123', -1, NULL, 'ben', '2018-05-28', 'ben', '2018-05-28', '2018-05-28 14:45:48', 'Penjualan', '1'),
(482, 42, '123', -1, NULL, 'ben', '2018-05-28', 'ben', '2018-05-28', '2018-05-28 14:45:48', 'Penjualan', '1'),
(483, 42, '123', -1, NULL, 'ben', '2018-05-28', 'ben', '2018-05-28', '2018-05-28 14:45:48', 'Penjualan', '1'),
(484, 42, '123', -1, NULL, 'ben', '2018-05-28', 'ben', '2018-05-28', '2018-05-28 14:45:48', 'Penjualan', '1'),
(485, 42, '123', -1, NULL, 'yoha', '2018-05-29', 'yoha', '2018-05-29', '2018-05-28 17:00:00', 'Penjualan', '8'),
(486, 42, '123', -2, NULL, 'ben', '2018-05-29', 'ben', '2018-05-29', '2018-05-28 17:00:00', 'Penjualan', '1'),
(487, 42, '123', -1, NULL, 'ben', '2018-05-29', 'ben', '2018-05-29', '2018-05-28 17:00:00', 'Penjualan', '1'),
(488, 42, '123', -1, NULL, 'yoha', '2018-05-29', 'yoha', '2018-05-29', '2018-05-28 17:00:00', 'Penjualan', '8'),
(489, 42, '123', -1, NULL, 'yoha', '2018-05-29', 'yoha', '2018-05-29', '2018-05-28 17:00:00', 'Penjualan', '8'),
(490, 42, '123', -2, NULL, 'ben', '2018-06-02', 'ben', '2018-06-02', '2018-06-01 17:00:00', 'Penjualan', ''),
(491, 42, '123', -2, NULL, 'ben', '2018-06-02', 'ben', '2018-06-02', '2018-06-01 17:00:00', 'Penjualan', '1'),
(492, 42, '123', -1, NULL, 'yoha', '2018-06-02', 'yoha', '2018-06-02', '2018-06-01 17:00:00', 'Penjualan', '8'),
(493, 42, '123', -2, NULL, 'yoha', '2018-06-02', 'yoha', '2018-06-02', '2018-06-01 17:00:00', 'Penjualan', '8'),
(494, 42, '123', -2, NULL, 'nov', '2018-06-16', 'nov', '2018-06-16', '2018-06-15 17:00:00', 'Penjualan', '1'),
(495, 72, '123', -1, NULL, 'asd', '2018-06-16', 'asd', '2018-06-16', '2018-06-15 17:00:00', 'Penjualan', '8'),
(496, 72, '123', 10, '', 'asd', '2018-06-16', 'asd', '0000-00-00', '2018-06-15 17:00:00', 'Adjustment', '8'),
(497, 72, '123', 1, '', 'asd', '2018-06-16', 'asd', '0000-00-00', '2018-06-15 17:00:00', 'Adjustment', '8'),
(498, 72, '123', 1, 'Refund Invoice:134321', 'asd', '2018-06-16', 'asd', '2018-06-16', '2018-06-15 17:00:00', 'Refund', ''),
(499, 72, '123', -1, NULL, 'asd', '2018-06-16', 'asd', '2018-06-16', '2018-06-15 17:00:00', 'Penjualan', '8'),
(500, 72, '123', 1, 'Refund Invoice:135107', 'asd', '2018-06-16', 'asd', '2018-06-16', '2018-06-15 17:00:00', 'Refund', ''),
(501, 72, '123', -1, NULL, 'asd', '2018-06-16', 'asd', '2018-06-16', '2018-06-15 17:00:00', 'Penjualan', '8'),
(502, 72, '123', 1, 'Refund Invoice:135520', 'asd', '2018-06-16', 'asd', '2018-06-16', '2018-06-15 17:00:00', 'Refund', '');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `outlet_id` int(11) NOT NULL,
  `postal_code` int(255) DEFAULT NULL,
  `date_founded` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `ledger_id` varchar(255) NOT NULL,
  `billing_status` varchar(255) NOT NULL,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`name`, `address`, `phone`, `city`, `province`, `outlet_id`, `postal_code`, `date_founded`, `email`, `last_update_by`, `created_by`, `created_date`, `last_update_date`, `status`, `ledger_id`, `billing_status`, `expiration_date`) VALUES
('CaseNation.ID', 'Tangerang', '089636053432', 'Tangerang', 'Tangerang', 1, 0, '0000-00-00', NULL, '', NULL, NULL, NULL, 'Active', '123', '', '0000-00-00'),
('Keprabon', 'tangerang', '0000', 'tangerang', 'tangerang', 8, 15117, '0000-00-00', 'noviani.sumarto94@gmail.com', 'ben', 'ben', '2018-05-29', '2018-05-29', 'Active', '123', '', '0000-00-00'),
('asdasdasd', 'Undefined', 'Undefined', 'Undefined', 'Undefined', 10, 0, '2018-06-16', 'Undefined', 'asdasd', 'asdasd', '2018-06-16', '2018-06-16', 'Active', '06160350', 'Trial', '2018-06-16'),
('asdasdasd', 'Undefined', 'Undefined', 'Undefined', 'Undefined', 11, 0, '2018-06-16', 'Undefined', 'asd1', 'asd1', '2018-06-16', '2018-06-16', 'Active', '06160341', 'Trial', '2018-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `po_header_all`
--

CREATE TABLE `po_header_all` (
  `po_header_id` varchar(255) NOT NULL,
  `po_date` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `ship_to` varchar(255) NOT NULL,
  `outlets` varchar(255) NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `po_description` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `ledger_id` varchar(255) NOT NULL,
  `amount_due_remaining` int(11) NOT NULL,
  `outlet_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po_line_all`
--

CREATE TABLE `po_line_all` (
  `po_line_id` int(20) NOT NULL,
  `po_header_id` varchar(255) NOT NULL,
  `uom` varchar(5) DEFAULT NULL,
  `qty` int(20) NOT NULL,
  `price` int(20) NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `inventory_item_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ap_check_all`
--
ALTER TABLE `ap_check_all`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `ap_supplier_all`
--
ALTER TABLE `ap_supplier_all`
  ADD PRIMARY KEY (`party_id`);

--
-- Indexes for table `ar_check_all`
--
ALTER TABLE `ar_check_all`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `cogs`
--
ALTER TABLE `cogs`
  ADD PRIMARY KEY (`item_cost_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `fmd_recipe_header`
--
ALTER TABLE `fmd_recipe_header`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `fmd_recipe_line`
--
ALTER TABLE `fmd_recipe_line`
  ADD PRIMARY KEY (`recipe_line_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_line_id`);

--
-- Indexes for table `invoice_header`
--
ALTER TABLE `invoice_header`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `material_transaction`
--
ALTER TABLE `material_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`outlet_id`);

--
-- Indexes for table `po_header_all`
--
ALTER TABLE `po_header_all`
  ADD PRIMARY KEY (`po_header_id`);

--
-- Indexes for table `po_line_all`
--
ALTER TABLE `po_line_all`
  ADD PRIMARY KEY (`po_line_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ap_check_all`
--
ALTER TABLE `ap_check_all`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ap_supplier_all`
--
ALTER TABLE `ap_supplier_all`
  MODIFY `party_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ar_check_all`
--
ALTER TABLE `ar_check_all`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `cogs`
--
ALTER TABLE `cogs`
  MODIFY `item_cost_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `fmd_recipe_line`
--
ALTER TABLE `fmd_recipe_line`
  MODIFY `recipe_line_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1340;

--
-- AUTO_INCREMENT for table `material_transaction`
--
ALTER TABLE `material_transaction`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `outlet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `po_line_all`
--
ALTER TABLE `po_line_all`
  MODIFY `po_line_id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
