-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2018 at 04:47 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Dumping data for table `ap_check_all`
--

INSERT INTO `ap_check_all` (`payment_id`, `po_header_id`, `payment_number`, `payment_date`, `payment_type`, `payment_amount`, `created_by`, `created_date`, `last_update_by`, `last_update_date`) VALUES
(1, '20180312222216', 'a', '0000-00-00', 'c', 0, NULL, NULL, NULL, NULL),
(2, '20180312222216', 'asd', '2018-03-22', 'Cash', 11, NULL, NULL, NULL, NULL),
(3, '20180414174847', '123', '2018-04-21', 'Cash', 50000, 'ben', '2018-04-21', 'ben', '2018-04-21'),
(4, '', '123', '2018-04-22', 'Cash', 100, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(5, '', '12', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(6, '', '123', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(7, '', '123', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(8, '', '1', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(9, '', '1', '2018-04-22', 'Cash', 123, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(10, '', '1', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(11, '', '1', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(12, '20180312222216', 'k', '2018-04-22', 'Cash', 9, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(13, '20180312222216', 'j', '2018-04-22', 'Cash', 10, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(14, '20180312222216', 'u', '2018-04-22', 'Cash', 10, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(15, '20180312222216', 'asdasd', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22'),
(16, '20180312222216', 'asd', '2018-04-22', 'Cash', 1, 'ben', '2018-04-22', 'ben', '2018-04-22');

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
  `tax` int(20) NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `ledger_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_supplier_all`
--

INSERT INTO `ap_supplier_all` (`party_id`, `supplier_name`, `supplier_site`, `supplier_type`, `status`, `tax`, `created_date`, `created_by`, `last_update_date`, `last_update_by`, `ledger_id`) VALUES
(1, 'aa', 'a', 'a', 'Active', 1, NULL, NULL, '2018-03-22', 'admin', '123'),
(2, 'cba', 'jakarta', 'impor', 'Active', 2, '2018-03-22', 'admin', NULL, NULL, '123'),
(3, 'bbbbbb', 'aaaa', 'aaa', 'Active', 1, '2018-03-22', 'admin', '2018-03-22', 'admin', '123'),
(4, 'bbbbbb', 'aaaa', 'aaa', 'Active', 1, '2018-03-22', 'admin', '2018-03-22', 'admin', '123'),
(5, 'bbbbbb', 'aaaa', 'aaa', 'Active', 1, '2018-03-22', 'admin', '2018-03-22', 'admin', '123');

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
(30, '20180423165114', 'Dari Toko', '2018-04-23', 'Cash', 49500, 'ben', '2018-04-23', 'ben', '2018-04-23'),
(31, '20180423170429', 'Dari Toko', '2018-04-23', 'Cash', 18700, 'ben', '2018-04-23', 'ben', '2018-04-23'),
(32, '20180423192509', 'Dari Toko', '2018-04-23', 'Cash', 18700, 'ben', '2018-04-23', 'ben', '2018-04-23'),
(33, '20180423192641', 'Dari Toko', '2018-04-23', 'Cash', 18700, 'ben', '2018-04-23', 'ben', '2018-04-23'),
(34, '20180423192854', 'Dari Toko', '2018-04-23', 'Cash', 35200, 'ben', '2018-04-23', 'ben', '2018-04-23'),
(35, '20180423192907', 'Dari Toko', '2018-04-23', 'Cash', 56100, 'ben', '2018-04-23', 'ben', '2018-04-23');

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
  `sales_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cogs`
--

INSERT INTO `cogs` (`item_cost_id`, `item_cost`, `periode`, `last_update_date`, `last_update_by`, `created_date`, `created_by`, `type`, `inventory_item_id`, `ledger_id`, `sales_price`) VALUES
(1, 45000, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '27', '123', 0),
(2, 55000, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '36', '123', 0),
(3, 34000, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '37', '123', 0),
(4, 1, '2018-04-16', '2018-04-16', 'ben', '2018-04-16', 'ben', 'Manual', '36', '123', 1),
(5, 1, '2018-04-16', '2018-04-16', 'ben', '2018-04-16', 'ben', 'Manual', '27', '123', 2),
(6, 1, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '45', '123', 2),
(7, 1, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 2),
(8, 2, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 2),
(9, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '37', '123', 15000),
(10, 0, '2018-04-04', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 0),
(11, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '38', '123', 15000),
(12, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '36', '123', 15000),
(13, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '27', '123', 15000),
(14, 10000, '2018-04-17', '2018-04-17', 'ben', '2018-04-17', 'ben', 'Manual', '45', '123', 15000),
(15, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(16, 123, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(17, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(18, 1, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(19, 2, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(20, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 2),
(21, 1500, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1),
(22, 1, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(23, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1),
(24, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1),
(25, 1500, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 2),
(26, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 2),
(27, 0, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1),
(28, 2, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(29, 2, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 0),
(30, 1000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 1500),
(31, 20000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 25000),
(32, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 25000),
(33, 15000, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 20000),
(34, 12500, '2018-04-18', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '27', '123', 15000),
(35, 0, '1970-01-01', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '', '123', 0),
(36, 0, '1970-01-01', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '', '123', 0),
(37, 0, '1970-01-01', '2018-04-18', 'ben', '2018-04-18', 'ben', 'Manual', '', '123', 0),
(38, 10000, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 10000),
(39, 15000, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 15000),
(40, 123, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 123),
(41, 123, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 123),
(42, 111, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '27', '123', 111),
(43, 123, '2018-04-19', '2018-04-19', 'ben', '2018-04-19', 'ben', 'Manual', '36', '123', 123),
(44, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '36', '123', 15000),
(45, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '36', '123', 15000),
(46, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '27', '123', 15000),
(47, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '37', '123', 15000),
(48, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '45', '123', 15000),
(49, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '38', '123', 15000),
(50, 11000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '27', '123', 15000),
(51, 12000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '37', '123', 15000),
(52, 10000, '2018-04-23', '2018-04-23', 'ben', '2018-04-23', 'ben', 'Manual', '27', '123', 17000);

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
('admin', 'Admin', 'martinganteng@gmail.com', 'CaseNation.ID', 3, '0', NULL, NULL, NULL, '5f4dcc3b5aa765d61d8327deb882cf99', ''),
('asd', 'Admin', 'admin@asd', 'Amoxilin', 5, NULL, NULL, '2018-04-09', NULL, '7815696ecbf1c96e6894b779456d330e', ''),
('bernard123', 'Admin', 'bernad@ayam', 'keprabon', 6, NULL, NULL, '2018-04-09', NULL, '7815696ecbf1c96e6894b779456d330e', ''),
('ayam', 'Admin', 'asayam@makanan', 'CaseNation.ID', 9, NULL, NULL, '2018-04-11', NULL, '7815696ecbf1c96e6894b779456d330e', '123'),
('ben', 'Staff', 'ben@aa', 'CaseNation.ID', 12, NULL, NULL, '2018-04-12', NULL, '7815696ecbf1c96e6894b779456d330e', '123');

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
  `last_update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fmd_recipe_header`
--

INSERT INTO `fmd_recipe_header` (`recipe_id`, `recipe_name`, `ledger_id`, `created_by`, `created_date`, `last_update_by`, `last_update_date`) VALUES
('R04150604', 'a', '123', 'ben', '2018-04-15', 'ben', '2018-04-15'),
('R04150617', 'aa', '123', 'ben', '2018-04-15', 'ben', '2018-04-15'),
('R04150621', 'a2', '123', 'ben', '2018-04-15', 'ben', '2018-04-15'),
('R04150644', 'a1', '123', 'ben', '2018-04-15', 'ben', '2018-04-15'),
('R04150645', 'aab', '123', 'ben', '2018-04-15', 'ben', '2018-04-15'),
('R04150649', 'ben', '123', 'ben', '2018-04-15', 'ben', '2018-04-15'),
('R04160345', 'Makaroni', '123', 'ben', '2018-04-16', 'ben', '2018-04-16');

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
  `qty` int(11) NOT NULL,
  `sales_price` int(11) DEFAULT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `cogs` int(20) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `ledger_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_code`, `description`, `qty`, `sales_price`, `min`, `max`, `cogs`, `created_by`, `last_update_by`, `created_date`, `last_update_date`, `ledger_id`) VALUES
(27, 'RMT-0000002', 'Mario Bros', 10, 17000, 3, 10, 10000, NULL, 'ben', NULL, '0000-00-00', '123'),
(36, 'RMT-0000003', 'Eye case', 10, 15000, 3, 10, 10000, NULL, 'ben', NULL, '0000-00-00', '123'),
(37, 'RMT-0000004', 'Blue Ceramic', 98, 15000, 3, 10, 12000, NULL, 'ben', NULL, '2018-04-23', '123'),
(38, 'RMT-0000005', 'Pink Flower', 48, 15000, 3, 10, 10000, NULL, 'ben', NULL, '2018-04-23', '123'),
(39, 'RMT-0000006', 'Pineapple Case', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(40, 'RMT-0000007', 'Black Flower', 3, 100000, 3, 10, 50000, NULL, 'ben', NULL, '0000-00-00', '123'),
(41, 'RMT-0000008', 'Flower case', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(42, 'RMT-0000009', 'Pug Case', 38, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(43, 'RMT-0000010', 'Simpsons', 1, 100000, 3, 10, 50000, NULL, 'ben', NULL, '0000-00-00', '123'),
(44, 'RMT-0000011', 'Captain America', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(45, 'RMT-0000012', 'Nike', 43, 15000, 3, 10, 10000, NULL, 'ben', NULL, '2018-04-23', '123'),
(46, 'RMT-0000013', 'Starwars', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '1233');

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
(15000, 1, '2018-04-23 16:51:14', 1041, '20180423165114', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '36', 0.1, 1500, 10000),
(15000, 1, '2018-04-23 16:51:14', 1042, '20180423165114', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '45', 0.1, 1500, 10000),
(15000, 1, '2018-04-23 16:51:14', 1043, '20180423165114', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '27', 0.1, 1500, 11000),
(17000, 1, '2018-04-23 17:04:29', 1044, '20180423170429', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '27', 0.1, 1700, 10000),
(17000, 1, '2018-04-23 19:25:09', 1045, '20180423192509', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '27', 0.1, 1700, 10000),
(17000, 1, '2018-04-23 19:26:41', 1046, '20180423192641', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '27', 0.1, 1700, 10000),
(15000, 1, '2018-04-23 19:28:54', 1047, '20180423192854', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '36', 0.1, 1500, 10000),
(17000, 1, '2018-04-23 19:28:54', 1048, '20180423192854', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '27', 0.1, 1700, 10000),
(17000, 3, '2018-04-23 19:29:07', 1049, '20180423192907', 'April', NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '123', '27', 0.1, 5100, 10000);

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
  `amount_due_remaining` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_header`
--

INSERT INTO `invoice_header` (`invoice_id`, `invoice_number`, `invoice_date`, `due_date`, `ledger_id`, `discount_amount`, `refund_status`, `outstanding_status`, `created_by`, `created_date`, `last_update_by`, `last_update_date`, `payment_method`, `customer_name`, `amount_due_remaining`) VALUES
('20180423165114', '20180423165114', '2018-04-23', '2018-04-23', '123', 0, 'Yes', 'Paid', 'ben', '2018-04-23', 'ben', '2018-04-23', 'Cash', 'Yohanes', 0),
('20180423170429', '20180423170429', '2018-04-23', '2018-04-23', '123', 0, 'Yes', 'Paid', 'ben', '2018-04-23', 'ben', '2018-04-23', 'Cash', 'Yohanes', 0),
('20180423192509', '20180423192509', '2018-04-23', '2018-04-23', '123', 0, 'Yes', 'Paid', 'ben', '2018-04-23', 'ben', '2018-04-23', 'Cash', 'Yohanes', 0),
('20180423192641', '20180423192641', '2018-04-23', '2018-04-23', '123', 0, 'Yes', 'Paid', 'ben', '2018-04-23', 'ben', '2018-04-23', 'Cash', 'Yohanes', 0),
('20180423192854', '20180423192854', '2018-04-23', '2018-04-23', '123', 0, 'Yes', 'Paid', 'ben', '2018-04-23', 'ben', '2018-04-23', 'Cash', 'Yohanes', 0),
('20180423192907', '20180423192907', '2018-04-23', '2018-04-23', '123', 0, 'Yes', 'Paid', 'ben', '2018-04-23', 'ben', '2018-04-23', 'Cash', 'Yohanes', 0);

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
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_transaction`
--

INSERT INTO `material_transaction` (`transaction_id`, `inventory_item_id`, `ledger_id`, `qty`, `description`, `created_by`, `created_date`, `last_update_by`, `last_update_date`, `transaction_date`, `type`) VALUES
(101, 27, '123', 10, '', 'ben', '2018-04-23', 'ben', '0000-00-00', '2018-04-22 17:00:00', 'Adjustment'),
(102, 36, '123', 10, '', 'ben', '2018-04-23', 'ben', '0000-00-00', '2018-04-22 17:00:00', 'Adjustment'),
(103, 36, '123', -1, NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '2018-04-22 17:00:00', 'Penjualan'),
(104, 27, '123', -1, NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '2018-04-22 17:00:00', 'Penjualan'),
(105, 36, '123', 1, 'Refund Invoice:20180423192854', 'ben', '2018-04-23', 'ben', '2018-04-23', '0000-00-00 00:00:00', 'Refund'),
(106, 27, '123', 1, 'Refund Invoice:20180423192854', 'ben', '2018-04-23', 'ben', '2018-04-23', '0000-00-00 00:00:00', 'Refund'),
(107, 27, '123', -3, NULL, 'ben', '2018-04-23', 'ben', '2018-04-23', '2018-04-22 17:00:00', 'Penjualan'),
(108, 27, '123', 3, 'Refund Invoice:20180423192907', 'ben', '2018-04-23', 'ben', '2018-04-23', '0000-00-00 00:00:00', 'Refund');

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
  `ledger_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`name`, `address`, `phone`, `city`, `province`, `outlet_id`, `postal_code`, `date_founded`, `email`, `last_update_by`, `created_by`, `created_date`, `last_update_date`, `status`, `ledger_id`) VALUES
('CaseNation.ID', 'Tangerang', '089636053432', 'Tangerang', 'Tangerang', 1, 0, '0000-00-00', NULL, '', NULL, NULL, NULL, 'Active', '123'),
('Toko kue Martin', 'Cimone', '0808080808', 'Banten', 'Tangerang', 2, 15810, '0000-00-00', 'martinganteng@gmail.com', '', NULL, NULL, NULL, 'Active', ''),
('keprabon', 'Undefined', 'Undefined', 'Undefined', 'Undefined', 3, 0, '2018-04-09', 'Undefined', NULL, NULL, NULL, NULL, 'Active', '123'),
('keprabon', 'Undefined', 'Undefined', 'Undefined', 'Undefined', 4, 0, '2018-04-10', 'Undefined', 'qwe', 'qwe', '2018-04-10', '2018-04-10', 'Active', '123');

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
  `ledger_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_header_all`
--

INSERT INTO `po_header_all` (`po_header_id`, `po_date`, `supplier`, `ship_to`, `outlets`, `created_date`, `created_by`, `last_update_by`, `last_update_date`, `po_description`, `due_date`, `status`, `ledger_id`) VALUES
('20180312221913', '0000-00-00', 'tokopedia', 'tangerang', 'Toko kue Martin', '2018-03-12', NULL, NULL, NULL, 'xcfvg', '0000-00-00', 'Open', '123'),
('20180312222216', '0000-00-00', 'tokopedia', 'tangerang', 'CaseNation.ID', '2018-03-12', NULL, NULL, NULL, 'asd', '0000-00-00', 'Open', '123'),
('20180414174847', '2018-04-14', '', 'ss', 'Toko kue Martin', '2018-04-14', 'ben', 'ben', '2018-04-14', 'asdasd', '2018-04-14', 'Open', '123'),
('20180415180539', '2018-04-15', '', 'a', 'Toko kue Martin', '2018-04-15', 'ben', 'ben', '2018-04-15', 'a', '2018-04-15', 'Open', '123'),
('20180416234106', '2018-04-16', 'aa', 'a', 'CaseNation.ID', '2018-04-16', 'ben', 'ben', '2018-04-16', 'a', '2018-04-16', 'Open', '123');

-- --------------------------------------------------------

--
-- Table structure for table `po_line_all`
--

CREATE TABLE `po_line_all` (
  `po_line_id` int(20) NOT NULL,
  `po_header_id` varchar(255) NOT NULL,
  `uom` varchar(5) NOT NULL,
  `qty` int(20) NOT NULL,
  `price` int(20) NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `inventory_item_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_line_all`
--

INSERT INTO `po_line_all` (`po_line_id`, `po_header_id`, `uom`, `qty`, `price`, `created_date`, `created_by`, `last_update_date`, `last_update_by`, `inventory_item_id`) VALUES
(9, '20180312221913', 'asd', 1, 15000000, NULL, NULL, NULL, NULL, '27'),
(10, '20180312222216', 'asd', 2, 100000, NULL, NULL, NULL, NULL, '27'),
(11, '20180414174847', 'RMT-0', 1, 50000, '2018-04-14', 'ben', '2018-04-14', 'ben', '27'),
(12, '20180415180539', 'a', 1, 1, '2018-04-15', 'ben', '2018-04-15', 'ben', '27'),
(13, '20180416234106', 'a', 1, 1, '2018-04-16', 'ben', '2018-04-16', 'ben', '27');

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ap_supplier_all`
--
ALTER TABLE `ap_supplier_all`
  MODIFY `party_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ar_check_all`
--
ALTER TABLE `ar_check_all`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `cogs`
--
ALTER TABLE `cogs`
  MODIFY `item_cost_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `fmd_recipe_line`
--
ALTER TABLE `fmd_recipe_line`
  MODIFY `recipe_line_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1050;
--
-- AUTO_INCREMENT for table `material_transaction`
--
ALTER TABLE `material_transaction`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `outlet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `po_line_all`
--
ALTER TABLE `po_line_all`
  MODIFY `po_line_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
