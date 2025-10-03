-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2025 at 02:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assets_db`
--
CREATE DATABASE IF NOT EXISTS `assets_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `assets_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','subadmin','employee') NOT NULL DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`) VALUES
(2, 'admin', 'admin123', 'admin'),
(3, 'sub_admin', 'subadmin123', 'subadmin'),
(4, 'employee', 'emppass123', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `approval_requests`
--

CREATE TABLE `approval_requests` (
  `id` int(11) NOT NULL,
  `request_type` varchar(50) DEFAULT NULL,
  `target_id` int(11) DEFAULT NULL,
  `request_data` text DEFAULT NULL,
  `requested_by` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approval_requests`
--

INSERT INTO `approval_requests` (`id`, `request_type`, `target_id`, `request_data`, `requested_by`, `status`, `approved_by`, `approved_at`, `created_at`) VALUES
(38, 'update', 5162, '{\"id\":\"5162\",\"user_name\":\"JYyyyy00\",\"designation\":\"\",\"department\":\"F\",\"employee_id\":\"3539\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"change_reason\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_Type\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_Type\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"\",\"po_number\":\"\",\"vendor_name\":\"reyesrty\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-08-14 07:10:46\",\"status\":\"active\"}', 0, 'approved', 0, '2025-09-03 06:46:47', '2025-09-03 04:36:53'),
(39, 'update', 4910, '{\"id\":\"4910\",\"user_name\":\"SHAM \",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"change_reason\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_Type\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_Type\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\"}', 0, 'approved', 0, '2025-09-03 08:47:00', '2025-09-03 06:12:45'),
(40, 'update', 4910, '{\"id\":\"4910\",\"user_name\":\"SHAM s\",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"change_reason\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_Type\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_Type\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\"}', 0, 'approved', 0, '2025-09-03 08:46:58', '2025-09-03 06:46:10'),
(41, 'update', 4910, '{\"id\":\"4910\",\"user_name\":\"SHAM si\",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"change_reason\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_Type\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_Type\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\"}', 0, 'approved', 0, '2025-09-03 09:34:01', '2025-09-03 07:33:24'),
(42, 'update', 6588, '{\"id\":\"6588\",\"user_name\":\"JNNFg\",\"designation\":\"EGD\",\"department\":\"DGDSGSD\",\"employee_id\":\"53234\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"change_reason\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_Type\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_Type\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-12 17:42:06\",\"status\":\"active\"}', 0, 'rejected', 0, '2025-09-12 17:52:53', '2025-09-12 15:51:50'),
(43, 'update', 6588, '{\"id\":\"6588\",\"user_name\":\"JNN\",\"designation\":\"\",\"department\":\"\",\"employee_id\":\"34\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"change_reason\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_Type\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_Type\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-12 17:42:06\",\"status\":\"active\"}', 0, 'pending', NULL, NULL, '2025-09-14 11:41:29'),
(44, 'update', 6588, '{\"id\":\"6588\",\"user_name\":\"JNN\",\"designation\":\"\",\"department\":\"\",\"employee_id\":\"34\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"change_reason\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_Type\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_Type\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"\",\"po_number\":\"\",\"vendor_name\":\"jij\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-12 17:42:06\",\"status\":\"active\"}', 0, 'pending', NULL, NULL, '2025-09-14 12:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `seq_id` int(255) UNSIGNED NOT NULL,
  `id` varchar(20) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `sub_location` varchar(100) DEFAULT NULL,
  `mac_id` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `network_type` enum('Static','DHCP') DEFAULT 'DHCP',
  `device_type` enum('desktop','laptop','Printer','Monitor') NOT NULL,
  `pc_name` varchar(100) DEFAULT NULL,
  `cpu_make` varchar(100) DEFAULT NULL,
  `cpu_model` varchar(100) DEFAULT NULL,
  `cpu_serial_number` varchar(100) DEFAULT NULL,
  `Processor` varchar(100) DEFAULT NULL,
  `Gen` varchar(100) DEFAULT NULL,
  `RAM` varchar(100) DEFAULT NULL,
  `bit` varchar(100) DEFAULT NULL,
  `os` varchar(100) DEFAULT NULL,
  `HDD` varchar(100) DEFAULT NULL,
  `SDD` varchar(100) DEFAULT NULL,
  `monitor_make` varchar(100) DEFAULT NULL,
  `monitor_model` varchar(100) DEFAULT NULL,
  `monitor_serial_number` varchar(100) DEFAULT NULL,
  `printer_scanner_Type` enum('Static','DHCP') DEFAULT 'DHCP',
  `printer_scanner_make` varchar(100) DEFAULT NULL,
  `printer_scanner_model` varchar(100) DEFAULT NULL,
  `printer_scanner_serial_number` varchar(100) DEFAULT NULL,
  `keyboard_make` varchar(100) DEFAULT NULL,
  `keyboard_model` varchar(100) DEFAULT NULL,
  `keyboard_serial_number` varchar(100) DEFAULT NULL,
  `mouse_make` varchar(100) DEFAULT NULL,
  `mouse_model` varchar(100) DEFAULT NULL,
  `mouse_serial_number` varchar(100) DEFAULT NULL,
  `laptop_adaptor_serial_number` varchar(100) DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `po_number` varchar(100) DEFAULT NULL,
  `vendor_name` varchar(100) DEFAULT NULL,
  `warranty_status` varchar(100) DEFAULT NULL,
  `AMC` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Assigned',
  `assets_uuid` char(36) DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`seq_id`, `id`, `user_name`, `designation`, `department`, `employee_id`, `email_id`, `mobile_number`, `location`, `sub_location`, `mac_id`, `ip_address`, `network_type`, `device_type`, `pc_name`, `cpu_make`, `cpu_model`, `cpu_serial_number`, `Processor`, `Gen`, `RAM`, `bit`, `os`, `HDD`, `SDD`, `monitor_make`, `monitor_model`, `monitor_serial_number`, `printer_scanner_Type`, `printer_scanner_make`, `printer_scanner_model`, `printer_scanner_serial_number`, `keyboard_make`, `keyboard_model`, `keyboard_serial_number`, `mouse_make`, `mouse_model`, `mouse_serial_number`, `laptop_adaptor_serial_number`, `date_of_issue`, `po_number`, `vendor_name`, `warranty_status`, `AMC`, `created_at`, `status`, `assets_uuid`) VALUES
(45, '4910', 'SHAM si', 'engineer', 'it', '4785', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-02-12', '', '', '', '', '2025-09-03 02:22:22', 'active', '1e6b12aa-8e09-11f0-9d9d-6451062a39d2');

-- --------------------------------------------------------

--
-- Table structure for table `asset_assignments`
--

CREATE TABLE `asset_assignments` (
  `id` int(11) NOT NULL,
  `asset_id` varchar(50) NOT NULL,
  `assigned_to` varchar(100) NOT NULL,
  `assigned_date` datetime DEFAULT current_timestamp(),
  `returned_date` datetime DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_assignments`
--

INSERT INTO `asset_assignments` (`id`, `asset_id`, `assigned_to`, `assigned_date`, `returned_date`, `remark`, `status`) VALUES
(72, '4910', 'sahuu', '2025-09-04 11:01:32', '2025-09-04 11:02:17', '', 'Returned'),
(78, '6588', '53234', '2025-09-12 21:13:11', '2025-09-14 17:10:45', '', 'Returned'),
(79, '6588', 'jnn', '2025-09-14 17:10:45', NULL, '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

CREATE TABLE `asset_categories` (
  `name` varchar(255) NOT NULL,
  `type` varchar(200) NOT NULL,
  `Asset` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`name`, `type`, `Asset`) VALUES
('cpu', 'asset', 100),
('cpu', 'asset', 100);

-- --------------------------------------------------------

--
-- Table structure for table `asset_logs`
--

CREATE TABLE `asset_logs` (
  `id` bigint(20) NOT NULL,
  `asset_id` bigint(20) NOT NULL,
  `action_type` varchar(30) NOT NULL,
  `old_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_data`)),
  `new_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_data`)),
  `changed_by` varchar(100) NOT NULL,
  `change_reason` text DEFAULT NULL,
  `changed_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_logs`
--

INSERT INTO `asset_logs` (`id`, `asset_id`, `action_type`, `old_data`, `new_data`, `changed_by`, `change_reason`, `changed_on`, `created_at`) VALUES
(22, 5162, 'Updated', '{\"seq_id\":33,\"id\":\"5162\",\"user_name\":\"JYyyyy00\",\"designation\":\"\",\"department\":\"F\",\"employee_id\":\"3539\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"reyesrty\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-08-14 07:10:46\",\"status\":\"active\"}', '{\"seq_id\":33,\"id\":\"5162\",\"user_name\":\"JYyyyy0\",\"designation\":\"\",\"department\":\"F\",\"employee_id\":\"3539\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"reyesrty\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-08-14 07:10:46\",\"status\":\"active\"}', 'admin', '', '2025-09-03 07:20:03', '2025-09-03 07:20:03'),
(24, 4910, 'Updated', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM ss\",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\"}', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM s\",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\"}', 'admin', '', '2025-09-03 07:32:31', '2025-09-03 07:32:31'),
(25, 4910, 'Updated', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM si\",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\",\"assets_uuid\":\"1e6b12aa-8e09-11f0-9d9d-6451062a39d2\"}', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM si\",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"2025-02-12\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\",\"assets_uuid\":\"1e6b12aa-8e09-11f0-9d9d-6451062a39d2\"}', 'admin', '', '2025-09-12 15:18:47', '2025-09-12 15:18:47'),
(26, 6588, 'Updated', '{\"seq_id\":50,\"id\":\"6588\",\"user_name\":\"JNNF\",\"designation\":\"EGD\",\"department\":\"DGDSGSD\",\"employee_id\":\"53234\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-12 17:42:06\",\"status\":\"Assigned\",\"assets_uuid\":\"098c50b7-8fef-11f0-b0db-68f728b602d1\"}', '{\"seq_id\":50,\"id\":\"6588\",\"user_name\":\"JNNF\",\"designation\":\"EGD\",\"department\":\"DGDSGSD\",\"employee_id\":\"5323\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-12 17:42:06\",\"status\":\"active\",\"assets_uuid\":\"098c50b7-8fef-11f0-b0db-68f728b602d1\"}', 'admin', '', '2025-09-12 15:54:48', '2025-09-12 15:54:48'),
(27, 4910, 'Updated', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM si\",\"designation\":\"gj\",\"department\":\"hu\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"2025-02-12\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\",\"assets_uuid\":\"1e6b12aa-8e09-11f0-9d9d-6451062a39d2\"}', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM si\",\"designation\":\"gj\",\"department\":\"it\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"2025-02-12\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\",\"assets_uuid\":\"1e6b12aa-8e09-11f0-9d9d-6451062a39d2\"}', 'admin', '', '2025-09-14 07:10:31', '2025-09-14 07:10:31'),
(28, 4910, 'Updated', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM si\",\"designation\":\"gj\",\"department\":\"it\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"2025-02-12\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\",\"assets_uuid\":\"1e6b12aa-8e09-11f0-9d9d-6451062a39d2\"}', '{\"seq_id\":45,\"id\":\"4910\",\"user_name\":\"SHAM si\",\"designation\":\"engineer\",\"department\":\"it\",\"employee_id\":\"4785\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"2025-02-12\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-03 07:52:22\",\"status\":\"active\",\"assets_uuid\":\"1e6b12aa-8e09-11f0-9d9d-6451062a39d2\"}', 'admin', '', '2025-09-14 07:10:56', '2025-09-14 07:10:56'),
(29, 6588, 'Updated', '{\"seq_id\":50,\"id\":\"6588\",\"user_name\":\"JNNF\",\"designation\":\"EGD\",\"department\":\"DGDSGSD\",\"employee_id\":\"5323\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-12 17:42:06\",\"status\":\"active\",\"assets_uuid\":\"098c50b7-8fef-11f0-b0db-68f728b602d1\"}', '{\"seq_id\":50,\"id\":\"6588\",\"user_name\":\"JNNF\",\"designation\":\"mod\",\"department\":\"hr\",\"employee_id\":\"5323\",\"email_id\":\"\",\"mobile_number\":\"\",\"location\":\"\",\"sub_location\":\"\",\"mac_id\":\"\",\"ip_address\":\"\",\"network_type\":\"\",\"device_type\":\"\",\"pc_name\":\"\",\"cpu_make\":\"\",\"cpu_model\":\"\",\"cpu_serial_number\":\"\",\"Processor\":\"\",\"Gen\":\"\",\"RAM\":\"\",\"bit\":\"\",\"os\":\"\",\"HDD\":\"\",\"SDD\":\"\",\"monitor_make\":\"\",\"monitor_model\":\"\",\"monitor_serial_number\":\"\",\"printer_scanner_Type\":\"\",\"printer_scanner_make\":\"\",\"printer_scanner_model\":\"\",\"printer_scanner_serial_number\":\"\",\"keyboard_make\":\"\",\"keyboard_model\":\"\",\"keyboard_serial_number\":\"\",\"mouse_make\":\"\",\"mouse_model\":\"\",\"mouse_serial_number\":\"\",\"laptop_adaptor_serial_number\":\"\",\"date_of_issue\":\"0000-00-00\",\"po_number\":\"\",\"vendor_name\":\"\",\"warranty_status\":\"\",\"AMC\":\"\",\"created_at\":\"2025-09-12 17:42:06\",\"status\":\"active\",\"assets_uuid\":\"098c50b7-8fef-11f0-b0db-68f728b602d1\"}', 'admin', '', '2025-09-14 07:11:29', '2025-09-14 07:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `#` int(50) NOT NULL,
  `company` varchar(200) NOT NULL,
  `Asset` int(255) NOT NULL,
  `Assigned` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`#`, `company`, `Asset`, `Assigned`) VALUES
(32, 'sd', 56, 76),
(33, 'hvhjjhgb', 86, 44),
(35, 'seml', 414, 76);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_requests`
--
ALTER TABLE `approval_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`seq_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `assets_uuid` (`assets_uuid`);

--
-- Indexes for table `asset_assignments`
--
ALTER TABLE `asset_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_logs`
--
ALTER TABLE `asset_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_asset_logs_changed_on` (`changed_on`),
  ADD KEY `idx_asset_logs_asset_id` (`asset_id`),
  ADD KEY `idx_asset_logs_changed_by` (`changed_by`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`#`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `approval_requests`
--
ALTER TABLE `approval_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `seq_id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `asset_assignments`
--
ALTER TABLE `asset_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `asset_logs`
--
ALTER TABLE `asset_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `#` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Database: `gallery_project`
--
CREATE DATABASE IF NOT EXISTS `gallery_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gallery_project`;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Database: `guesthouse_db`
--
CREATE DATABASE IF NOT EXISTS `guesthouse_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `guesthouse_db`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `guest_name` varchar(100) DEFAULT NULL,
  `guest_designation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `checkin_date`, `checkout_date`, `status`, `guest_name`, `guest_designation`) VALUES
(5, 3, 1, '2025-09-01', '2025-09-25', 'rejected', NULL, NULL),
(6, 3, 1, '2025-09-25', '2025-09-30', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guesthouses`
--

CREATE TABLE `guesthouses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guesthouses`
--

INSERT INTO `guesthouses` (`id`, `name`, `address`) VALUES
(1, 'HOUSE-1', 'Siltara'),
(12, 'HOUSE-2', 'Shankar Nagar(Raipur)');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `guesthouse_id` int(11) DEFAULT NULL,
  `room_id` varchar(50) NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `guesthouse_id`, `room_id`, `status`) VALUES
(1, 1, '101', 'available'),
(4, 12, 'R-101', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `department`, `role`) VALUES
(1, 'Admin User', 'admin@company.com', '$2y$10$XBniG8pAariTjF5DI5pGHOL/MTvLHBVy6o2jrcAZH76/DcKLK1DZe', 'Management', 'admin'),
(3, 'user1', 'user@gmail.com', '$2y$10$.z2J9SaBavqpyjJvUwLvZOE/1sO/QmuXUUnqZ9xsSFDLAZoHlbOe.', 'IT', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `guesthouses`
--
ALTER TABLE `guesthouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guesthouse_id` (`guesthouse_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guesthouses`
--
ALTER TABLE `guesthouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`guesthouse_id`) REFERENCES `guesthouses` (`id`) ON DELETE CASCADE;
--
-- Database: `hms`
--
CREATE DATABASE IF NOT EXISTS `hms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hms`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', 'Test@12345', '04-03-2024 11:42:05 AM');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(1, 'ENT', 1, 1, 500, '2024-05-30', '9:15 AM', '2024-05-15 03:42:11', 1, 1, NULL),
(2, 'Endocrinologists', 2, 2, 800, '2024-05-31', '2:45 PM', '2024-05-16 09:08:54', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'ENT', 'Anuj kumar', 'A 123 XYZ Apartment Raj Nagar Ext Ghaziabad', '500', 142536250, 'anujk123@test.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-10 18:16:52', '2024-05-14 09:26:17'),
(2, 'Endocrinologists', 'Charu Dua', 'X 1212 ABC Apartment Laxmi Nagar New Delhi ', '800', 1231231230, 'charudua12@test.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-11 01:06:41', '2024-05-14 09:26:28'),
(4, 'Pediatrics', 'Priyanka Sinha', 'A 123 Xyz Aparmtnent Ghaziabad', '700', 74561235, 'p12@t.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:12:23', NULL),
(5, 'Orthopedics', 'Vipin Tayagi', 'Yasho Hospital New Delhi', '1200', 95214563210, 'vpint123@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:13:11', NULL),
(6, 'Internal Medicine', 'Dr Romil', 'Max Hospital Vaishali  GZB', '1500', 8563214751, 'drromil12@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:14:11', NULL),
(7, 'Obstetrics and Gynecology', 'Bhavya rathore', 'Shop 12 Indira Puram Ghaziabad', '800', 745621330, 'bhawya12@tt.com', 'f925916e2754e5e03f75dd58a5733251', '2024-05-16 09:15:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'anujk123@test.com', 0x3a3a3100000000000000000000000000, '2024-05-16 05:19:33', NULL, 1),
(2, 1, 'anujk123@test.com', 0x3a3a3100000000000000000000000000, '2024-05-16 09:01:03', '16-05-2024 02:37:32 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(1, 'Orthopedics', '2024-04-09 18:09:46', '2024-05-14 09:26:47'),
(2, 'Internal Medicine', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(3, 'Obstetrics and Gynecology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(4, 'Dermatology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(5, 'Pediatrics', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(6, 'Radiology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(7, 'General Surgery', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(8, 'Ophthalmology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(9, 'Anesthesia', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(10, 'Pathology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(11, 'ENT', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(12, 'Dental Care', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(13, 'Dermatologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(14, 'Endocrinologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(15, 'Neurologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'Anuj kumar', 'anujk30@test.com', 1425362514, 'This is for testing purposes.   This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.', '2024-04-20 16:52:03', NULL, '2024-05-14 09:27:15', NULL),
(2, 'Anuj kumar', 'ak@gmail.com', 1111122233, 'This is for testing', '2024-04-23 13:13:41', 'Contact the patient', '2024-04-27 13:13:57', 1),
(3, 'shreya ssahu', 'shreyasahu0112@gmail.com', 9770724026, 'hi', '2024-12-21 01:12:13', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(1, 2, '80/120', '110', '85', '97', 'Dolo,\r\nLevocit 5mg', '2024-05-16 09:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp(),
  `OpenningTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `OpenningTime`) VALUES
(1, 'aboutus', 'About Us', '<ul style=\"padding: 0px; margin-right: 0px; margin-bottom: 1.313em; margin-left: 1.655em;\" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" center;=\"\" background-color:=\"\" rgb(255,=\"\" 246,=\"\" 246);\"=\"\"><li style=\"text-align: left;\"><font color=\"#000000\">The Hospital Management System (HMS) is designed for Any Hospital to replace their existing manual, paper based system. The new system is to control the following information; patient information, room availability, staff and operating room schedules, and patient invoices. These services are to be provided in an efficient, cost effective manner, with the goal of reducing the time and resources currently required for such tasks.</font></li><li style=\"text-align: left;\"><font color=\"#000000\">A significant part of the operation of any hospital involves the acquisition, management and timely retrieval of great volumes of information. This information typically involves; patient personal information and medical history, staff information, room and ward scheduling, staff scheduling, operating theater scheduling and various facilities waiting lists. All of this information must be managed in an efficient and cost wise fashion so that an institution\'s resources may be effectively utilized HMS will automate the management of the hospital making it more efficient and error free. It aims at standardizing data, consolidating data ensuring data integrity and reducing inconsistencies.&nbsp;</font></li></ul>', NULL, NULL, '2020-05-20 07:21:52', NULL),
(2, 'contactus', 'Contact Details', 'D-204, Hole Town South West, Delhi-110096,India', 'info@gmail.com', 1122334455, '2020-05-20 07:24:07', '9 am To 8 Pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, 1, 'Rahul Singyh', 452463210, 'rahul12@gmail.com', 'male', 'NA', 32, 'Fever, Cold', '2024-05-16 05:23:35', NULL),
(2, 1, 'Amit', 4545454545, 'amitk@gmail.com', 'male', 'NA', 45, 'Fever', '2024-05-16 09:01:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-05-15 03:41:48', NULL, 1),
(2, 2, 'amitk@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-16 09:08:06', '16-05-2024 02:41:06 PM', 1),
(3, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-19 14:00:25', NULL, 1),
(4, NULL, 'anujk123@test.com', 0x3a3a3100000000000000000000000000, '2024-12-20 11:04:08', NULL, 0),
(5, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-20 11:04:49', NULL, 1),
(6, NULL, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-20 11:26:39', NULL, 0),
(7, NULL, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-20 11:29:16', NULL, 0),
(8, NULL, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-20 11:29:30', NULL, 0),
(9, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-20 11:30:17', NULL, 1),
(10, NULL, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-21 01:10:15', NULL, 0),
(11, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-21 01:10:38', '21-12-2024 06:41:10 AM', 1),
(12, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-21 05:17:43', '21-12-2024 10:49:11 AM', 1),
(13, NULL, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-21 05:42:03', NULL, 0),
(14, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-12-21 05:42:46', '21-12-2024 11:14:19 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(1, 'shreya sahu', 'A 123 ABC Apartment GZB 201017', 'Raipur', 'female', 'johndoe12@test.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-20 12:13:56', '2024-12-19 14:01:39'),
(2, 'Amit kumar', 'new Delhi india', 'New Delhi', 'male', 'amitk@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-21 13:15:32', '2024-05-14 09:28:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Database: `myblog`
--
CREATE DATABASE IF NOT EXISTS `myblog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `myblog`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `admname` varchar(30) NOT NULL,
  `admemail` varchar(30) NOT NULL,
  `admpassword` varchar(50) NOT NULL,
  `admcontact` bigint(12) NOT NULL,
  `admaddress` text NOT NULL,
  `admpic` varchar(120) NOT NULL,
  `admdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `admname`, `admemail`, `admpassword`, `admcontact`, `admaddress`, `admpic`, `admdate`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin@123', 7974872734, 'raipur shankar nagar', '', '2024-12-20 08:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blogid` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,  
  `blogdate` date NOT NULL,
  `author` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `blogupload` varchar(255) NOT NULL,
  `bdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogid`, `title`, `blogdate`, `author`, `description`, `blogupload`, `bdate`) VALUES
(10, 'What initials Should Ranbir Alia’s Daughter Have?', '2022-11-08', 'RWORKS Technology', '<p><strong><em>We did a small analysis of Alia-Ranbir&#39;s daughter&#39;s natal chart and got some exciting information to share. By the end of this article, you will discover the best initial that would suit the kid.</em></strong></p>\r\n\r\n<p>Let&#39;s have a look at the analysis that we have made. Alia Ranbir&#39;s new bundle of joy has Capricorn ascendant kundali, where Saturn is in the Ascendant. Moon and Jupiter are in 3rd house with Pisces. Rahu is placed in the fourth house with Aries. Mars is in the 6th house with Gemini. Sun, Mercury, Venus, and Ketu are in conjunction with Libra in the tenth house.</p>\r\n\r\n<p>She was born in Budh Maha Dasha and Mangal Antar Dasha, which started on 6th October 2022 and will last till 2023. Do you have these two dashas in your kundali?</p>\r\n\r\n<p>The little angel is blessed to be extremely lucky as she took birth on one of the most promising Hindu calendar combinations. The tithi reads out as Shukla Paksha of the holy month of Kartik Trayodashi Tithi in Revati Nakshatra with Vajra&nbsp;<a href=\"https://www.astroyogi.com/yoga\" target=\"_blank\">Yoga</a>. This combination is considered highly auspicious and leads the native to success.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'alia.jpg', '2022-11-08 16:52:58'),
(11, '\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\" \"There is no one who loves pain itself, who seeks aft', '2024-09-15', 'rays', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"2\">&nbsp;</td>\r\n			<td rowspan=\"2\">\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>paragraphs</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>words</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>bytes</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>lists</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n			<td>&nbsp;</td>\r\n			<td>Start with &#39;Lorem<br />\r\n			ipsum dolor sit amet...&#39;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'ganesh.jpg', '2024-09-15 05:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactid` int(11) NOT NULL,
  `contactname` varchar(30) NOT NULL,
  `contactemail` varchar(30) NOT NULL,
  `contactnumber` bigint(12) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `contactmessage` text NOT NULL,
  `contactdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactid`, `contactname`, `contactemail`, `contactnumber`, `subject`, `contactmessage`, `contactdate`) VALUES
(1, 'rakesh', 'info@rworkstechnology.com', 7896541230, '', '4s4', '2022-08-04 03:04:47'),
(3, 'rakesh', 'rakesh@gmail.com', 0, 'hii', 'hello', '2022-10-29 06:54:41'),
(5, 'rakhi', 'rakhi@gmail.com', 0, 'hii you are testing me', 'i have testing this api', '2024-09-10 13:05:11'),
(7, 'rakhi', 'rakhi@gmail.com', 0, 'hii you are testing me', 'i have testing this api', '2024-09-15 07:01:52'),
(8, 'sanjeev', 'sanjeev@gmail.com', 0, 'hii i am sanju', 'i have testing this api', '2024-09-15 07:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `galleryid` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `galleryupload` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`galleryid`, `title`, `galleryupload`, `date`) VALUES
(4, 'vvvv', 'slides1.jpeg', '2022-10-20 11:01:36'),
(6, 'gallery-image-3', 'ja.jpg', '2024-09-11 06:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `sliderid` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slider_upload` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`sliderid`, `title`, `slider_upload`, `date`) VALUES
(1, 'RWORKS TECHNOLOGY', 'slides1.jpeg', '2022-10-29 04:55:48'),
(3, 'RWORKS TECHNOLOGY', 'slide11.jpg', '2022-10-29 04:51:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactid`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`galleryid`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`sliderid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `galleryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `sliderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Database: `mydatabase`
--
CREATE DATABASE IF NOT EXISTS `mydatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mydatabase`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"guesthouse_db\",\"table\":\"bookings\"},{\"db\":\"guesthouse_db\",\"table\":\"rooms\"},{\"db\":\"guesthouse_db\",\"table\":\"guesthouses\"},{\"db\":\"guesthouse_db\",\"table\":\"users\"},{\"db\":\"assets_db\",\"table\":\"asset_assignments\"},{\"db\":\"assets_db\",\"table\":\"dashboard\"},{\"db\":\"assets_db\",\"table\":\"asset_logs\"},{\"db\":\"assets_db\",\"table\":\"approval_requests\"},{\"db\":\"assets_db\",\"table\":\"assets\"},{\"db\":\"assets_db\",\"table\":\"admins\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-10-02 12:57:59', '{\"Console\\/Mode\":\"collapse\",\"NavigationWidth\":200}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `user_database`
--
CREATE DATABASE IF NOT EXISTS `user_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `user_database`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
