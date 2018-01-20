-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2018 at 11:34 AM
-- Server version: 10.2.11-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `i_id` int(11) NOT NULL,
  `v_first_name` varchar(150) NOT NULL,
  `v_last_name` varchar(150) NOT NULL,
  `v_username` varchar(255) NOT NULL,
  `v_email` varchar(255) NOT NULL,
  `v_phone` varchar(255) DEFAULT NULL,
  `e_user_role` enum('admin','user') NOT NULL DEFAULT 'user',
  `v_password` varchar(2000) NOT NULL DEFAULT '''OPEN''',
  `v_profile_img` varchar(255) NOT NULL DEFAULT 'profile.png',
  `e_status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `v_activation_token` varchar(255) DEFAULT NULL,
  `t_facebook_id` text DEFAULT NULL,
  `t_twitter_id` text DEFAULT NULL,
  `dt_created` datetime DEFAULT '0000-00-00 00:00:00',
  `dt_updated` datetime DEFAULT '0000-00-00 00:00:00',
  `v_ip` varchar(255) DEFAULT '0.0.0.0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Users Table for all users';

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`i_id`, `v_first_name`, `v_last_name`, `v_username`, `v_email`, `v_phone`, `e_user_role`, `v_password`, `v_profile_img`, `e_status`, `v_activation_token`, `t_facebook_id`, `t_twitter_id`, `dt_created`, `dt_updated`, `v_ip`) VALUES
(1, 'System', 'Admin', 'admin', 'admin@dental.com', '999888777', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'profile.png', 'Active', NULL, NULL, NULL, '2018-01-03 00:00:00', '2018-01-03 00:00:00', '0.0.0.0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`i_id`),
  ADD UNIQUE KEY `v_email` (`v_email`),
  ADD UNIQUE KEY `v_username` (`v_username`),
  ADD UNIQUE KEY `v_phone` (`v_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
