-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2018 at 12:54 PM
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
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
