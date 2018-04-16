-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2018 at 12:36 PM
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

--
-- Dumping data for table `ap_check_all`
--

INSERT INTO `ap_check_all` (`payment_id`, `po_header_id`, `payment_number`, `payment_date`, `payment_type`, `payment_amount`, `created_by`, `created_date`, `last_update_by`, `last_update_date`) VALUES
(1, '20180312222216', 'a', '0000-00-00', 'c', 0, NULL, NULL, NULL, NULL),
(2, '20180312222216', 'asd', '2018-03-22', 'Cash', 11, NULL, NULL, NULL, NULL);

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
  `last_update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_supplier_all`
--

INSERT INTO `ap_supplier_all` (`party_id`, `supplier_name`, `supplier_site`, `supplier_type`, `status`, `tax`, `created_date`, `created_by`, `last_update_date`, `last_update_by`) VALUES
(1, 'aa', 'a', 'a', 'Active', 1, NULL, NULL, '2018-03-22', 'admin'),
(2, 'cba', 'jakarta', 'impor', 'Active', 2, '2018-03-22', 'admin', NULL, NULL),
(3, 'bbbbbb', 'aaaa', 'aaa', 'Active', 1, '2018-03-22', 'admin', '2018-03-22', 'admin'),
(4, 'bbbbbb', 'aaaa', 'aaa', 'Active', 1, '2018-03-22', 'admin', '2018-03-22', 'admin'),
(5, 'bbbbbb', 'aaaa', 'aaa', 'Active', 1, '2018-03-22', 'admin', '2018-03-22', 'admin');

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
(3, 34000, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '', '', 0);

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
  `unit_price` int(11) DEFAULT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `hpp` int(20) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `ledger_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_code`, `description`, `qty`, `unit_price`, `min`, `max`, `hpp`, `created_by`, `last_update_by`, `created_date`, `last_update_date`, `ledger_id`) VALUES
(27, 'RMT-0000002', 'Mario Bros', 6, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(36, 'RMT-0000003', 'Eye case', 46, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(37, 'RMT-0000004', 'Blue Ceramic', 31, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(38, 'RMT-0000005', 'Pink Flower', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(39, 'RMT-0000006', 'Pineapple Case', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(40, 'RMT-0000007', 'Black Flower', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(41, 'RMT-0000008', 'Flower case', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(42, 'RMT-0000009', 'Pug Case', 38, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(43, 'RMT-0000010', 'Simpsons', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(44, 'RMT-0000011', 'Captain America', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(45, 'RMT-0000012', 'Nike', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '123'),
(46, 'RMT-0000013', 'Starwars', 0, 100000, 3, 10, 50000, NULL, '', NULL, NULL, '1233');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `description` varchar(255) NOT NULL,
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
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`description`, `unit_price`, `qty`, `date`, `invoice_line_id`, `invoice_id`, `month`, `payment_method`, `last_update_by`, `last_update_date`, `created_by`, `created_date`) VALUES
('Mario Bros', 100000, 123, '2017-08-14 00:00:00', 1, '1', 'August', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 32, '2017-09-07 00:00:00', 2, '2', 'September', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 52, '2017-11-20 00:00:00', 3, '3', 'November', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 41, '2017-12-20 00:00:00', 4, '4', 'December', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 94, '2018-01-20 00:00:00', 7, '7', 'January', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 8, '2018-02-05 21:14:41', 958, '20180205211441', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:08:25', 959, '20180206090825', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:14:05', 960, '20180206091405', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:14:56', 961, '20180206091456', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:17:09', 962, '20180206091709', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:21:03', 963, '20180206092103', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:22:04', 964, '20180206092204', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Eye case', 100000, 1, '2018-02-06 09:22:04', 965, '20180206092204', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:23:31', 966, '20180206092331', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:24:34', 967, '20180206092434', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Eye case', 100000, 3, '2018-02-06 09:25:44', 968, '20180206092544', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 3, '2018-02-06 09:29:01', 969, '20180206092901', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:29:55', 970, '20180206092955', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Eye case', 100000, 3, '2018-02-06 09:29:55', 971, '20180206092955', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-06 09:31:22', 972, '20180206093122', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Eye case', 100000, 6, '2018-02-06 09:31:22', 973, '20180206093122', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 3, '2018-02-06 13:13:02', 974, '20180206131302', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Eye case', 100000, 1, '2018-02-06 13:13:02', 975, '20180206131302', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 2, '2018-02-06 22:09:16', 976, '20180206220916', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Eye case', 100000, 1, '2018-02-06 22:09:16', 977, '20180206220916', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Blue Ceramic', 100000, 2, '2018-02-06 22:09:16', 978, '20180206220916', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 6, '2018-02-06 22:31:35', 979, '20180206223135', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Eye case', 100000, 1, '2018-02-06 22:31:35', 980, '20180206223135', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Blue Ceramic', 100000, 1, '2018-02-06 22:31:35', 981, '20180206223135', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-08 19:50:34', 982, '20180208195034', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Pug Case', 100000, 2, '2018-02-08 20:55:24', 983, '20180208205524', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 25, '2018-02-08 21:46:34', 984, '20180208214634', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Eye case', 100000, 2, '2018-02-08 21:46:52', 985, '20180208214652', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 20, '2018-02-08 21:47:07', 986, '20180208214707', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Eye case', 100000, 1, '2018-02-09 15:50:44', 987, '20180209155044', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-12 21:03:40', 988, '20180212210340', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 2, '2018-02-12 21:23:27', 989, '20180212212327', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-14 18:15:10', 990, '20180214181510', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Eye case', 100000, 1, '2018-02-14 18:15:22', 991, '20180214181522', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-14 18:18:58', 992, '20180214181858', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL),
('Eye case', 100000, 1, '2018-02-15 23:25:55', 993, '20180215232555', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-16 11:45:10', 994, '20180216114510', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 1, '2018-02-19 17:12:36', 995, '20180219171236', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Eye case', 100000, 2, '2018-02-19 20:03:03', 996, '20180219200303', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Blue Ceramic', 100000, 4, '2018-02-19 20:03:03', 997, '20180219200303', 'February', 'Cash', NULL, NULL, NULL, NULL),
('Mario Bros', 100000, 2, '2018-02-20 15:18:25', 998, '20180220151825', 'February', 'Debit/Credit', NULL, NULL, NULL, NULL);

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
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_header_all`
--

INSERT INTO `po_header_all` (`po_header_id`, `po_date`, `supplier`, `ship_to`, `outlets`, `created_date`, `created_by`, `last_update_by`, `last_update_date`, `po_description`, `due_date`, `status`) VALUES
('20180312221913', '0000-00-00', 'tokopedia', 'tangerang', 'Toko kue Martin', '2018-03-12', NULL, NULL, NULL, 'xcfvg', '0000-00-00', 'Open'),
('20180312222216', '0000-00-00', 'tokopedia', 'tangerang', 'CaseNation.ID', '2018-03-12', NULL, NULL, NULL, 'asd', '0000-00-00', 'Open'),
('20180414174847', '2018-04-14', '', 'ss', 'Toko kue Martin', '2018-04-14', 'ben', 'ben', '2018-04-14', 'asdasd', '2018-04-14', 'Open'),
('20180415180539', '2018-04-15', '', 'a', 'Toko kue Martin', '2018-04-15', 'ben', 'ben', '2018-04-15', 'a', '2018-04-15', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `po_line_all`
--

CREATE TABLE `po_line_all` (
  `po_line_id` int(20) NOT NULL,
  `po_header_id` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `uom` varchar(5) NOT NULL,
  `qty` int(20) NOT NULL,
  `price` int(20) NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_line_all`
--

INSERT INTO `po_line_all` (`po_line_id`, `po_header_id`, `item_code`, `uom`, `qty`, `price`, `created_date`, `created_by`, `last_update_date`, `last_update_by`, `description`) VALUES
(9, '20180312221913', 'RMT-0000002', 'asd', 1, 15000000, NULL, NULL, NULL, NULL, 'laptop'),
(10, '20180312222216', 'rmt-000001', 'asd', 2, 100000, NULL, NULL, NULL, NULL, 'laptop'),
(11, '20180414174847', 'RMT-0000002', 'RMT-0', 1, 50000, '2018-04-14', 'ben', '2018-04-14', 'ben', 'RMT-0000002'),
(12, '20180415180539', 'a', 'a', 1, 1, '2018-04-15', 'ben', '2018-04-15', 'ben', 'asdasd s');

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ap_supplier_all`
--
ALTER TABLE `ap_supplier_all`
  MODIFY `party_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cogs`
--
ALTER TABLE `cogs`
  MODIFY `item_cost_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `invoice_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=999;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `outlet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `po_line_all`
--
ALTER TABLE `po_line_all`
  MODIFY `po_line_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;