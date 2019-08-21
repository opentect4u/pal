-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2019 at 02:01 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysore`
--

-- --------------------------------------------------------

--
-- Table structure for table `md_departments`
--

CREATE TABLE `md_departments` (
  `sl_no` int(11) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `emp_code` varchar(20) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_departments`
--

INSERT INTO `md_departments` (`sl_no`, `dept_name`, `emp_code`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'House Keeping Dept', 'sss', NULL, NULL, NULL, NULL),
(2, 'Therapy Dept', 'sss', NULL, NULL, NULL, NULL),
(3, 'Medical Dept', 'sss', NULL, NULL, NULL, NULL),
(4, 'Maintenance Dept', 'sss', NULL, NULL, NULL, NULL),
(5, 'Pharmacy Dept', 'sss', NULL, NULL, NULL, NULL),
(6, 'IT Department', 'sss', NULL, NULL, 'Pritam Maity', '2018-12-21 04:30:27'),
(7, 'Stores Dept', 'sss', NULL, NULL, NULL, NULL),
(8, 'Civil Department', '', 'Pritam Maity', '2018-12-21 04:31:04', NULL, NULL),
(9, 'ME Department', '', 'Pritam Maity', '2018-12-21 04:33:26', 'Pritam Maity', '2018-12-21 04:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `md_employee`
--

CREATE TABLE `md_employee` (
  `emp_code` varchar(25) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `phn_no` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `emp_catg` char(1) NOT NULL,
  `joining_date` date DEFAULT NULL,
  `emp_type` varchar(2) NOT NULL,
  `emp_status` char(1) NOT NULL DEFAULT 'A',
  `termination_date` date DEFAULT NULL,
  `img_path` text,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_employee`
--

INSERT INTO `md_employee` (`emp_code`, `emp_name`, `phn_no`, `email`, `designation`, `department`, `emp_catg`, `joining_date`, `emp_type`, `emp_status`, `termination_date`, `img_path`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('sss', 'Pritam Maity', '2147483647', 'h@g.com', 'Software Engineer', 1, 'C', '2030-11-01', 'HR', 'A', NULL, 'assets/images/users/IMG-20180425-WA3.jpg', 'Synergic Softek', '2018-11-29 11:30:12', 'Pritam Maity', '2019-01-28 01:33:04'),
('116', 'Subhankar Bhowmik', '2147483647', 'sub.co@m', 'Software Technical', 1, 'C', '2018-11-02', 'H', 'I', NULL, 'assets/images/users/suvhankar.jpg', 'Synergic Softek', '2018-11-29 11:23:28', 'Sunil Samanta', '2018-12-20 04:39:28'),
('raj', 'Rajdip Mondal', '2147483647', 'raj@gmail.com', 'SS', 1, 'C', '2018-12-05', 'E', 'A', NULL, 'assets/images/users/profile.png', 'CONFED', '2018-12-01 02:07:11', 'Sunil Samanta', '2018-12-20 04:39:58'),
('sunil', 'Sunil Samanta', '9735', 's.g@com', 'SA', 3, 'C', '2018-12-05', 'H', 'A', NULL, 'assets/images/users/profile.png', 'CONFED', '2018-12-01 02:20:04', 'Pritam Maity', '2018-12-03 05:46:53'),
('103', 'Arunangshu Pal', '9735327356', 'gitang@g.com', 'Software Engineer', 1, 'P', '2018-12-20', 'E', 'A', NULL, 'assets/images/users/PC.jpg', 'Sunil Samanta', '2018-12-20 04:54:12', NULL, NULL),
('32', 'Tanmoy Mondal', '9732', 't@g.com', 'Sr Software Engineer', 6, 'C', '2018-12-03', 'H', 'A', NULL, 'assets/images/users/profile.png', 'Pritam Maity', '2018-12-20 06:51:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_manager`
--

CREATE TABLE `md_manager` (
  `id` int(11) NOT NULL,
  `manage_by` varchar(20) NOT NULL,
  `managed_emp` varchar(20) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_manager`
--

INSERT INTO `md_manager` (`id`, `manage_by`, `managed_emp`, `modified_by`, `modified_dt`) VALUES
(1, 'sss', '103', 'Pritam Maity', '2018-12-27 05:03:50'),
(2, 'sss', 'raj', 'Pritam Maity', '2018-12-27 05:03:50'),
(3, 'sss', '116', 'Pritam Maity', '2018-12-27 05:03:50'),
(6, '116', 'raj', 'Pritam Maity', '2018-12-28 10:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `md_parameters`
--

CREATE TABLE `md_parameters` (
  `sl_no` int(11) NOT NULL,
  `param_desc` varchar(100) NOT NULL,
  `param_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_parameters`
--

INSERT INTO `md_parameters` (`sl_no`, `param_desc`, `param_value`) VALUES
(1, 'Name of Client', 'Indus Valley Ayurvedic Centre (IVAC)'),
(2, 'Address', 'Lalithadripura, Mysore - 570 028, Karnataka. INDIA.'),
(3, 'Leave Start Month', '1'),
(4, 'Leave End Month', '12'),
(5, 'Max EL Limit of Leave Apply In a Year', '5'),
(6, 'Minimum EL Limit', '2'),
(7, 'Difference of days between current date and submission date', '7'),
(8, 'EL For Probationary period', '10'),
(9, 'EL For Confirmed Employee', '12'),
(10, 'ML For Probationary Period', '12'),
(11, 'ML For Confirmed Employee', '12'),
(12, 'Maximum EL Exceed Limit', '30');

-- --------------------------------------------------------

--
-- Table structure for table `md_users`
--

CREATE TABLE `md_users` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_status` char(1) NOT NULL DEFAULT 'A',
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_users`
--

INSERT INTO `md_users` (`user_id`, `password`, `user_name`, `user_status`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('103', '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy', 'Arunangshu Pal', 'A', 'Sunil Samanta', '2018-12-20 04:54:12', NULL, NULL),
('116', '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy', 'CONFED', 'A', 'sss', '2018-09-27 00:00:00', NULL, NULL),
('32', '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy', 'Tanmoy Mondal', 'A', 'Pritam Maity', '2018-12-20 06:51:13', NULL, NULL),
('raj', '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy', 'Rajdip Mondal', 'A', NULL, NULL, NULL, NULL),
('sss', '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy', 'Pritam Maity', 'A', 'Tanmy', '2018-08-20 00:00:00', NULL, NULL),
('sunil', '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy', 'Sunil Samanta', 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `td_audit_trail`
--

CREATE TABLE `td_audit_trail` (
  `sl_no` int(5) UNSIGNED NOT NULL,
  `login_dt` datetime DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `terminal_name` varchar(50) DEFAULT NULL,
  `logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_audit_trail`
--

INSERT INTO `td_audit_trail` (`sl_no`, `login_dt`, `user_id`, `terminal_name`, `logout`) VALUES
(1, '2018-12-27 03:12:14', 'sss', '127.0.0.1', '2018-12-27 03:12:31'),
(2, '2018-12-27 03:12:38', 'raj', '127.0.0.1', '2018-12-27 04:12:52'),
(3, '2018-12-27 03:12:30', '116', '::1', '2018-12-27 04:12:29'),
(4, '2018-12-27 04:12:37', 'sss', '::1', '2018-12-27 05:12:04'),
(5, '2018-12-27 04:12:55', '116', '127.0.0.1', '2018-12-27 07:12:09'),
(6, '2018-12-27 05:12:07', 'sss', '::1', '2018-12-27 06:12:46'),
(7, '2018-12-27 06:12:55', '116', '::1', '2018-12-27 06:12:42'),
(8, '2018-12-27 06:12:46', 'sss', '::1', '2018-12-27 06:12:10'),
(9, '2018-12-27 06:12:13', '116', '::1', '2018-12-27 07:12:04'),
(10, '2018-12-27 07:12:14', 'raj', '127.0.0.1', '2018-12-27 07:12:53'),
(11, '2018-12-27 07:12:00', '116', '127.0.0.1', '2018-12-27 07:12:25'),
(12, '2018-12-27 07:12:09', 'sss', '::1', NULL),
(13, '2018-12-27 07:12:32', 'raj', '127.0.0.1', '2018-12-27 07:12:55'),
(14, '2018-12-27 07:12:59', '116', '127.0.0.1', NULL),
(15, '2018-12-28 10:12:08', 'sss', '::1', '2018-12-28 10:12:46'),
(16, '2018-12-28 10:12:56', 'raj', '127.0.0.1', '2018-12-28 10:12:48'),
(17, '2018-12-28 10:12:50', '116', '::1', '2018-12-28 10:12:43'),
(18, '2018-12-28 10:12:47', 'sss', '::1', '2018-12-28 10:12:20'),
(19, '2018-12-28 10:12:24', '116', '::1', '2018-12-28 10:12:42'),
(20, '2018-12-28 10:12:49', 'sss', '::1', '2018-12-28 11:12:20'),
(21, '2018-12-28 10:12:51', '116', '127.0.0.1', NULL),
(22, '2018-12-28 03:12:43', 'sss', '::1', '2018-12-28 03:12:19'),
(23, '2018-12-28 03:12:47', 'sss', '::1', NULL),
(24, '2019-01-04 10:01:02', 'sss', '::1', '2019-01-04 10:01:12'),
(25, '2019-01-04 10:01:18', '103', '::1', '2019-01-04 10:01:29'),
(26, '2019-01-04 10:01:33', 'raj', '::1', '2019-01-04 10:01:37'),
(27, '2019-01-04 10:01:40', '103', '::1', NULL),
(28, '2019-01-28 12:01:16', 'sss', '::1', '2019-01-28 03:01:53'),
(29, '2019-01-28 03:01:58', 'sss', '::1', '2019-01-28 05:01:30'),
(30, '2019-01-28 05:01:12', 'raj', '::1', '2019-01-28 06:01:25'),
(31, '2019-01-29 10:01:01', 'sss', '::1', '2019-01-29 11:01:17'),
(32, '2019-01-29 11:01:23', 'raj', '::1', '2019-01-29 11:01:38'),
(33, '2019-01-29 11:01:52', '116', '::1', '2019-01-29 12:01:30'),
(34, '2019-01-29 11:01:47', 'raj', '127.0.0.1', '2019-01-29 12:01:56'),
(35, '2019-01-29 12:01:35', 'sss', '::1', '2019-01-29 12:01:05'),
(36, '2019-01-29 12:01:15', '116', '::1', '2019-01-29 12:01:26'),
(37, '2019-01-29 12:01:01', 'sss', '127.0.0.1', '2019-01-29 12:01:00'),
(38, '2019-01-29 12:01:52', 'sss', '::1', '2019-01-29 12:01:43'),
(39, '2019-01-29 12:01:47', '116', '::1', '2019-01-29 12:01:21'),
(40, '2019-01-29 12:01:22', 'sss', '::1', '2019-01-29 12:01:45'),
(41, '2019-01-29 12:01:50', '116', '::1', '2019-01-29 12:01:58'),
(42, '2019-01-29 12:01:09', 'raj', '::1', '2019-01-29 01:01:38'),
(43, '2019-01-29 01:01:43', 'raj', '::1', '2019-01-29 01:01:19'),
(44, '2019-01-29 01:01:23', 'sss', '::1', '2019-01-29 01:01:21'),
(45, '2019-01-29 01:01:35', 'raj', '::1', '2019-01-29 01:01:48'),
(46, '2019-01-29 01:01:11', 'raj', '127.0.0.1', '2019-01-29 01:01:26'),
(47, '2019-01-29 01:01:30', '116', '127.0.0.1', '2019-01-29 01:01:51'),
(48, '2019-01-29 01:01:53', 'sss', '::1', '2019-01-29 01:01:13'),
(49, '2019-01-29 01:01:18', 'raj', '::1', '2019-01-29 01:01:44'),
(50, '2019-01-29 01:01:57', 'raj', '127.0.0.1', '2019-01-29 01:01:22'),
(51, '2019-01-29 01:01:28', '116', '127.0.0.1', '2019-01-29 01:01:47'),
(52, '2019-01-29 01:01:52', 'SSS', '127.0.0.1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `td_comp_apply`
--

CREATE TABLE `td_comp_apply` (
  `trans_cd` bigint(20) NOT NULL,
  `trans_dt` date NOT NULL,
  `emp_code` varchar(50) NOT NULL,
  `department` tinyint(4) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `from_dt` date NOT NULL,
  `to_dt` date NOT NULL,
  `remarks` text NOT NULL,
  `amount` int(11) NOT NULL,
  `recommendation_status` tinyint(1) NOT NULL DEFAULT '0',
  `recommend_by` varchar(50) DEFAULT NULL,
  `recommend_dt` datetime DEFAULT NULL,
  `recommend_remarks` text,
  `approval_status` tinyint(4) NOT NULL DEFAULT '0',
  `approved_by` varchar(50) NOT NULL,
  `approval_dt` datetime NOT NULL,
  `approve_remarks` text,
  `rejection_status` int(11) NOT NULL DEFAULT '0',
  `rejection_remarks` text NOT NULL,
  `rejected_by` varchar(50) NOT NULL,
  `rejected_dt` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_comp_apply`
--

INSERT INTO `td_comp_apply` (`trans_cd`, `trans_dt`, `emp_code`, `department`, `reason`, `from_dt`, `to_dt`, `remarks`, `amount`, `recommendation_status`, `recommend_by`, `recommend_dt`, `recommend_remarks`, `approval_status`, `approved_by`, `approval_dt`, `approve_remarks`, `rejection_status`, `rejection_remarks`, `rejected_by`, `rejected_dt`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(20181, '2018-12-27', 'raj', 1, 'Week Off', '2018-11-13', '2018-11-13', 'Need', 1, 1, 'CONFED', '2018-12-27 04:07:55', 'OK', 1, 'Pritam Maity', '2018-12-27 04:17:50', 'OK', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2018-12-27 03:50:03', '', '0000-00-00 00:00:00'),
(20182, '2018-12-27', 'raj', 1, 'Week Off', '2018-11-25', '2018-11-25', 'rt', 1, 1, 'CONFED', '2018-12-27 04:48:05', 'OK', 1, 'Pritam Maity', '2018-12-27 07:14:12', 'OK', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2018-12-27 04:47:49', '', '0000-00-00 00:00:00'),
(20183, '2018-12-27', 'raj', 1, 'Week Off', '2018-12-01', '2018-12-01', 'RE', 1, 1, 'CONFED', '2018-12-27 07:12:51', 'OK', 1, 'Pritam Maity', '2018-12-27 07:13:10', 'OK', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2018-12-27 07:11:53', '', '0000-00-00 00:00:00'),
(20184, '2019-01-29', 'raj', 1, 'Week Off', '2018-12-22', '2018-12-23', 'OK', 2, 1, 'CONFED', '2019-01-29 01:54:45', 'OK', 1, 'Pritam Maity', '2019-01-29 01:55:02', 'OK', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2019-01-29 01:54:20', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `td_comp_dates`
--

CREATE TABLE `td_comp_dates` (
  `trans_cd` bigint(20) NOT NULL,
  `emp_code` varchar(50) NOT NULL,
  `comp_dt` date NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'U'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_comp_dates`
--

INSERT INTO `td_comp_dates` (`trans_cd`, `emp_code`, `comp_dt`, `status`) VALUES
(20181, 'raj', '2018-11-13', 'A'),
(20183, 'raj', '2018-12-01', 'A'),
(20182, 'raj', '2018-11-25', 'A'),
(20184, 'raj', '2018-12-22', 'A'),
(20184, 'raj', '2018-12-23', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `td_leaves_trans`
--

CREATE TABLE `td_leaves_trans` (
  `trans_cd` bigint(20) NOT NULL,
  `trans_dt` date NOT NULL,
  `emp_code` varchar(50) NOT NULL,
  `department` tinyint(4) NOT NULL,
  `leave_type` char(1) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `from_dt` date NOT NULL,
  `to_dt` date NOT NULL,
  `remarks` text NOT NULL,
  `amount` int(11) NOT NULL,
  `recommendation_status` tinyint(1) NOT NULL DEFAULT '0',
  `recommend_by` varchar(50) DEFAULT NULL,
  `recommend_dt` datetime DEFAULT NULL,
  `recommend_remarks` text,
  `approval_status` tinyint(4) NOT NULL DEFAULT '0',
  `approved_by` varchar(50) NOT NULL,
  `approval_dt` datetime NOT NULL,
  `approve_remarks` text,
  `rejection_status` int(11) NOT NULL DEFAULT '0',
  `rejection_remarks` text NOT NULL,
  `rejected_by` varchar(50) NOT NULL,
  `rejected_dt` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_leaves_trans`
--

INSERT INTO `td_leaves_trans` (`trans_cd`, `trans_dt`, `emp_code`, `department`, `leave_type`, `reason`, `from_dt`, `to_dt`, `remarks`, `amount`, `recommendation_status`, `recommend_by`, `recommend_dt`, `recommend_remarks`, `approval_status`, `approved_by`, `approval_dt`, `approve_remarks`, `rejection_status`, `rejection_remarks`, `rejected_by`, `rejected_dt`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(20181, '2018-12-27', 'raj', 1, 'E', 'Family and Medical Leave', '2019-01-23', '2019-01-25', 'Remarks', 3, 1, 'CONFED', '2018-12-27 03:42:39', 'OK', 1, 'Pritam Maity', '2018-12-27 04:14:17', 'OK', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2018-12-27 03:06:27', 'Rajdip Mondal', '2018-12-27 03:10:15'),
(20182, '2018-12-27', 'raj', 1, 'C', 'Personal leave', '2019-02-12', '2019-02-12', 'Need', 1, 0, NULL, NULL, NULL, 0, '', '0000-00-00 00:00:00', NULL, 1, 'NO', 'CONFED', '2018-12-27 03:42:20', 'Rajdip Mondal', '2018-12-27 03:41:42', '', '0000-00-00 00:00:00'),
(20183, '2018-12-27', 'raj', 1, 'M', 'Personal leave', '2018-12-03', '2018-12-04', 'Re', 2, 1, 'CONFED', '2018-12-27 07:07:22', 'OK', 1, 'Pritam Maity', '2018-12-27 07:08:34', 'OK', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2018-12-27 07:06:51', '', '0000-00-00 00:00:00'),
(20184, '2018-12-28', 'raj', 1, 'E', 'Personal leave', '2019-01-30', '2019-02-01', 'Remarks', 3, 1, 'CONFED', '2018-12-28 11:04:24', 'OK', 1, 'Pritam Maity', '2018-12-28 11:06:39', 'OK', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2018-12-28 10:46:41', '', '0000-00-00 00:00:00'),
(20194, '2019-01-29', '116', 1, 'E', 'Family and Medical Leave', '2019-02-27', '2019-03-01', 'OK', 3, 1, 'CONFED', '2019-01-29 12:12:13', 'HOD', 1, 'Pritam Maity', '2019-01-29 12:33:30', 'OK', 0, '', '', '0000-00-00 00:00:00', 'CONFED', '2019-01-29 12:12:13', 'CONFED', '2019-01-29 12:12:22'),
(20191, '2019-01-28', 'raj', 1, 'E', 'Family and Medical Leave', '2019-03-04', '2019-03-05', 'sdfsddf', 2, 1, 'CONFED', '2019-01-29 01:50:44', 'OK', 1, 'Pritam Maity', '2019-01-29 01:53:11', 'ok', 0, '', '', '0000-00-00 00:00:00', 'Rajdip Mondal', '2019-01-28 05:49:16', '', '0000-00-00 00:00:00'),
(20193, '2019-01-29', 'raj', 1, 'E', 'Family and Medical Leave', '2019-02-27', '2019-02-28', 'OK', 2, 1, 'CONFED', '2019-01-29 12:03:19', 'ok', 0, '', '0000-00-00 00:00:00', NULL, 1, 'Not Ok', 'Pritam Maity', '2019-01-29 01:48:39', 'Rajdip Mondal', '2019-01-29 11:50:08', '', '0000-00-00 00:00:00'),
(20195, '2019-01-29', 'sss', 1, 'E', 'Family and Medical Leave', '2019-02-27', '2019-03-01', 'OK', 3, 0, NULL, NULL, NULL, 0, '', '0000-00-00 00:00:00', NULL, 0, '', '', '0000-00-00 00:00:00', 'Pritam Maity', '2019-01-29 12:32:38', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `td_leave_balance`
--

CREATE TABLE `td_leave_balance` (
  `balance_dt` date NOT NULL,
  `trans_cd` bigint(20) NOT NULL,
  `emp_code` varchar(50) NOT NULL,
  `ml_in` int(11) NOT NULL DEFAULT '0',
  `el_in` int(11) NOT NULL DEFAULT '0',
  `comp_off_in` int(11) NOT NULL DEFAULT '0',
  `ml_out` int(11) NOT NULL DEFAULT '0',
  `el_out` int(11) NOT NULL DEFAULT '0',
  `comp_off_out` int(11) NOT NULL DEFAULT '0',
  `ml_bal` int(11) DEFAULT NULL,
  `el_bal` int(11) DEFAULT NULL,
  `comp_off_bal` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_leave_balance`
--

INSERT INTO `td_leave_balance` (`balance_dt`, `trans_cd`, `emp_code`, `ml_in`, `el_in`, `comp_off_in`, `ml_out`, `el_out`, `comp_off_out`, `ml_bal`, `el_bal`, `comp_off_bal`) VALUES
('2018-12-16', 201834, '116', 0, 0, 0, 0, 0, 0, 10, 10, 10),
('2018-12-16', 20182, 'raj', 0, 0, 0, 0, 0, 0, 10, 10, 10),
('2018-01-01', 201849, 'sss', 0, 0, 0, 0, 0, 0, 10, 10, 10),
('2019-01-29', 20194, '116', 0, 0, 0, 0, 3, 0, 10, 7, 10),
('2018-01-05', 20180, '103', 0, 0, 0, 0, 0, 0, 0, 0, 1),
('2018-01-04', 20180, '103', 0, 0, 0, 0, 0, 0, 0, 0, 0),
('2018-12-28', 20184, 'raj', 0, 0, 0, 0, 3, 0, 8, 4, 11),
('2018-12-27', 20181, 'raj', 0, 0, 1, 2, 3, 0, 8, 7, 11),
('2019-01-29', 20191, 'raj', 0, 0, 2, 0, 2, 0, 8, 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `td_leave_dates`
--

CREATE TABLE `td_leave_dates` (
  `trans_cd` bigint(20) NOT NULL,
  `emp_code` varchar(50) NOT NULL,
  `leave_dt` date NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'U'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_leave_dates`
--

INSERT INTO `td_leave_dates` (`trans_cd`, `emp_code`, `leave_dt`, `status`) VALUES
(20181, 'raj', '2019-01-25', 'A'),
(20181, 'raj', '2019-01-24', 'A'),
(20181, 'raj', '2019-01-23', 'A'),
(20184, 'raj', '2019-01-30', 'A'),
(20183, 'raj', '2018-12-04', 'A'),
(20183, 'raj', '2018-12-03', 'A'),
(20184, 'raj', '2019-01-31', 'A'),
(20184, 'raj', '2019-02-01', 'A'),
(20195, 'sss', '2019-03-01', 'U'),
(20191, 'raj', '2019-03-05', 'A'),
(20191, 'raj', '2019-03-04', 'A'),
(20195, 'sss', '2019-02-28', 'U'),
(20195, 'sss', '2019-02-27', 'U'),
(20194, '116', '2019-03-01', 'A'),
(20194, '116', '2019-02-27', 'A'),
(20194, '116', '2019-02-28', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `md_departments`
--
ALTER TABLE `md_departments`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_employee`
--
ALTER TABLE `md_employee`
  ADD PRIMARY KEY (`emp_code`);

--
-- Indexes for table `md_manager`
--
ALTER TABLE `md_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_parameters`
--
ALTER TABLE `md_parameters`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_users`
--
ALTER TABLE `md_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `td_audit_trail`
--
ALTER TABLE `td_audit_trail`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `td_comp_apply`
--
ALTER TABLE `td_comp_apply`
  ADD PRIMARY KEY (`trans_cd`);

--
-- Indexes for table `td_comp_dates`
--
ALTER TABLE `td_comp_dates`
  ADD PRIMARY KEY (`trans_cd`,`comp_dt`) USING BTREE;

--
-- Indexes for table `td_leaves_trans`
--
ALTER TABLE `td_leaves_trans`
  ADD PRIMARY KEY (`trans_cd`);

--
-- Indexes for table `td_leave_balance`
--
ALTER TABLE `td_leave_balance`
  ADD PRIMARY KEY (`balance_dt`,`emp_code`,`trans_cd`) USING BTREE;

--
-- Indexes for table `td_leave_dates`
--
ALTER TABLE `td_leave_dates`
  ADD PRIMARY KEY (`trans_cd`,`leave_dt`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `md_departments`
--
ALTER TABLE `md_departments`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `md_manager`
--
ALTER TABLE `md_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `md_parameters`
--
ALTER TABLE `md_parameters`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `td_audit_trail`
--
ALTER TABLE `td_audit_trail`
  MODIFY `sl_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
