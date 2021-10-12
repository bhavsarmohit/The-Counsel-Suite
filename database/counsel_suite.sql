-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 08:43 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counsel_suite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `current_status` varchar(100) NOT NULL,
  `last_login` varchar(100) NOT NULL,
  `profile_pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `current_status`, `last_login`, `profile_pic`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'false', '', 'https://picsum.photos/200');

-- --------------------------------------------------------

--
-- Table structure for table `contactus_data`
--

CREATE TABLE `contactus_data` (
  `userid` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobno` varchar(100) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `f_id` int(255) NOT NULL,
  `parent_catname` varchar(100) NOT NULL,
  `subcatid` varchar(100) NOT NULL,
  `sub_catname` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `f_description` varchar(100) NOT NULL,
  `f_adddate` varchar(100) NOT NULL,
  `f_userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `legal_categories`
--

CREATE TABLE `legal_categories` (
  `cat_id` int(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_parentcat` varchar(100) NOT NULL,
  `admin_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `legal_contracts`
--

CREATE TABLE `legal_contracts` (
  `c_id` int(255) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_description` varchar(255) NOT NULL,
  `c_category` varchar(100) NOT NULL,
  `c_parentcat` varchar(100) NOT NULL,
  `c_file` varchar(255) NOT NULL,
  `c_timestamp` varchar(100) NOT NULL,
  `c_adminid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_assests`
--

CREATE TABLE `marketing_assests` (
  `c_id` int(255) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_description` varchar(255) NOT NULL,
  `c_category` varchar(100) NOT NULL,
  `c_parentcat` varchar(100) NOT NULL,
  `c_file` varchar(255) NOT NULL,
  `c_timestamp` varchar(100) NOT NULL,
  `c_adminid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_categories`
--

CREATE TABLE `marketing_categories` (
  `cat_id` int(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_parentcat` varchar(100) NOT NULL,
  `admin_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(255) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_pass` varchar(100) NOT NULL,
  `u_registertimestamp` varchar(100) NOT NULL,
  `u_lastlogin` varchar(100) NOT NULL,
  `u_profilepic` varchar(100) NOT NULL,
  `u_loginstatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus_data`
--
ALTER TABLE `contactus_data`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `legal_categories`
--
ALTER TABLE `legal_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `legal_contracts`
--
ALTER TABLE `legal_contracts`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `marketing_assests`
--
ALTER TABLE `marketing_assests`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `marketing_categories`
--
ALTER TABLE `marketing_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contactus_data`
--
ALTER TABLE `contactus_data`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `f_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legal_categories`
--
ALTER TABLE `legal_categories`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legal_contracts`
--
ALTER TABLE `legal_contracts`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_assests`
--
ALTER TABLE `marketing_assests`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_categories`
--
ALTER TABLE `marketing_categories`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
