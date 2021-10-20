-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2021 at 05:37 PM
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
(1, 'sumit', 'admin@gmail.com', 'admin', 'false', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_parentcat` varchar(100) NOT NULL,
  `admin_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_parentcat`, `admin_id`) VALUES
(6, 'Test Cat61', 'legal', '1'),
(7, 'Test Cat 7', 'legal', '1'),
(10, 'Marketing 1', 'marketing', '1'),
(11, 'Marketing 2', 'marketing', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contactus_data`
--

CREATE TABLE `contactus_data` (
  `userid` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobno` varchar(100) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus_data`
--

INSERT INTO `contactus_data` (`userid`, `name`, `email`, `mobno`, `msg`, `timestamp`) VALUES
('7', 'Sumit', 'k@gmail.com', '7768037116', 'dffs', '20/10/21 17:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `f_id` int(255) NOT NULL,
  `parent_catname` varchar(100) NOT NULL,
  `subcatid` varchar(100) NOT NULL,
  `sub_catname` varchar(100) NOT NULL,
  `c_id` varchar(255) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `f_description` varchar(100) NOT NULL,
  `f_file` varchar(255) NOT NULL,
  `f_adddate` varchar(100) NOT NULL,
  `f_userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`f_id`, `parent_catname`, `subcatid`, `sub_catname`, `c_id`, `f_name`, `f_description`, `f_file`, `f_adddate`, `f_userid`) VALUES
(4, 'legal', '6', 'Test Cat61', '59', 'Confidentiality Policy', 'new file lorem ispum', 'Confidentiality Policy.docx', '20/10/2021', '7'),
(7, 'marketing', '10', 'Marketing 1', '2', 'Marketing 1', 'This is marketing 1', 'Marketing 1.docx', '20/10/2021', '7');

-- --------------------------------------------------------

--
-- Table structure for table `legal_contracts`
--

CREATE TABLE `legal_contracts` (
  `c_id` int(255) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_description` varchar(255) NOT NULL,
  `c_catid` varchar(100) NOT NULL,
  `c_category` varchar(100) NOT NULL,
  `c_parentcat` varchar(100) NOT NULL,
  `c_file` varchar(255) NOT NULL,
  `c_timestamp` varchar(100) NOT NULL,
  `c_adminid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `legal_contracts`
--

INSERT INTO `legal_contracts` (`c_id`, `c_name`, `c_description`, `c_catid`, `c_category`, `c_parentcat`, `c_file`, `c_timestamp`, `c_adminid`) VALUES
(55, 'Conference-template-A', 'this is desc', '7', 'Test Cat 7', 'legal', '18U456_Report.docx', '2021/10/18 05:52:54', '1'),
(56, 'stcl report', 'ngng', '4', 'Test Cat3', 'legal', 'stcl report.docx', '2021/10/18 05:53:02', '1'),
(58, 'file1', 'ngng', '6', 'Test Cat61', 'legal', 'file1.docx', '2021/10/18 08:38:08', '1'),
(59, 'Confidentiality Policy', 'new file lorem ispum', '6', 'Test Cat61', 'legal', 'Confidentiality Policy.docx', '2021/10/20 09:39:08', '1');

-- --------------------------------------------------------

--
-- Table structure for table `legal_downloads`
--

CREATE TABLE `legal_downloads` (
  `date` varchar(255) NOT NULL,
  `downloads` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `legal_downloads`
--

INSERT INTO `legal_downloads` (`date`, `downloads`) VALUES
('20/10/2021', '4');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_assests`
--

CREATE TABLE `marketing_assests` (
  `c_id` int(255) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_description` varchar(255) NOT NULL,
  `c_catid` varchar(100) NOT NULL,
  `c_category` varchar(100) NOT NULL,
  `c_parentcat` varchar(100) NOT NULL,
  `c_file` varchar(255) NOT NULL,
  `c_timestamp` varchar(100) NOT NULL,
  `c_adminid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marketing_assests`
--

INSERT INTO `marketing_assests` (`c_id`, `c_name`, `c_description`, `c_catid`, `c_category`, `c_parentcat`, `c_file`, `c_timestamp`, `c_adminid`) VALUES
(2, 'Marketing 1', 'This is marketing 1', '10', 'Marketing 1', 'marketing', 'Marketing 1.docx', '2021/10/20 13:35:37', '1'),
(3, 'Marketing 2', 'This is marketing 2', '11', 'Marketing 2', 'marketing', 'Marketing 2.docx', '2021/10/20 13:35:59', '1');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_downloads`
--

CREATE TABLE `marketing_downloads` (
  `date` varchar(255) NOT NULL,
  `downloads` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marketing_downloads`
--

INSERT INTO `marketing_downloads` (`date`, `downloads`) VALUES
('20/10/2021', '4');

-- --------------------------------------------------------

--
-- Table structure for table `total_downloads`
--

CREATE TABLE `total_downloads` (
  `date` varchar(255) NOT NULL,
  `downloads` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_downloads`
--

INSERT INTO `total_downloads` (`date`, `downloads`) VALUES
('20/10/2021', '10');

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
  `u_loginstatus` varchar(100) NOT NULL,
  `legal_downloads` varchar(100) NOT NULL,
  `marketing_downloads` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_pass`, `u_registertimestamp`, `u_lastlogin`, `u_profilepic`, `u_loginstatus`, `legal_downloads`, `marketing_downloads`) VALUES
(7, 'Sumit', 'k@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2021-10-20', '20/10/21 15:33:35', 'boy.png', 'active', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `f_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `legal_contracts`
--
ALTER TABLE `legal_contracts`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `marketing_assests`
--
ALTER TABLE `marketing_assests`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
