-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 04:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.22

--
-- Table structure for table `tbl_currencies`
--
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `tbl_currencies` (
  `id` int(11) NOT NULL,
  `currency` varchar(250) NOT NULL,
  `sign` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `default_status` int(11) NOT NULL DEFAULT '0',
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_currencies`
--
ALTER TABLE `tbl_currencies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_currencies`
--
ALTER TABLE `tbl_currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Dumping data for table `tbl_currencies`
--

INSERT INTO `tbl_currencies` (`id`, `currency`, `sign`, `status`, `default_status`, `rate`) VALUES
(1, 'USD', '$', 1, 1, 0),
(2, 'EUR', '€', 1, 0, NULL),
(3, 'INR', '₹', 1, 0, NULL);



--
-- AUTO_INCREMENT for table `tbl_platforms`
--
ALTER TABLE `tbl_settings`
ADD `google_api_key` text NOT NULL,
ADD `active_domain_screenshots` int(11) NOT NULL DEFAULT '0',
ADD `active_app_verification` int(11) NOT NULL DEFAULT '1',
ADD `footer_credits` int(11) NOT NULL COMMENT '1=on,0=off';
--
-- Table structure for table `tbl_platforms`
--

--
-- Dumping data for table `tbl_platforms`
--

INSERT INTO `tbl_platforms` (`id`, `platform`, `name`, `type`, `icon`, `version`, `radio`, `description`, `status`, `updated`) VALUES
(5, 'app', 'Apps', 'listing', 'app.svg', 'v2.0', 'Sell-Apps', 'You are selling an Established or Starter App for mobile or tablet.', 1, '2020-06-04 10:51:18');

-- --------------------------------------------------------


--
-- AUTO_INCREMENT for table `tbl_platforms`
--
ALTER TABLE `tbl_listings`
ADD `app_market` varchar(250) NOT NULL,
ADD `app_url` text NOT NULL,
ADD `monthly_downloads` int(11) NOT NULL,
ADD `screenshot` varchar(250) DEFAULT NULL;
--
-- Table structure for table `tbl_platforms`
--