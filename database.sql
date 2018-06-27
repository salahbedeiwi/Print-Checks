-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 09:54 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `print_checks`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_info`
--

CREATE TABLE `business_info` (
  `id` int(11) NOT NULL,
  `token_id` varchar(15) NOT NULL,
  `added_by` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `added_on` date NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_info`
--

INSERT INTO `business_info` (`id`, `token_id`, `added_by`, `email`, `logo`, `ip`, `added_on`, `active`) VALUES
(7, '4ry9SUqg7', '123456', 'bedei001@umn.edu', 'copyright hooks logo.png', '::1', '2017-09-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `buz_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `registered_on` date NOT NULL,
  `ip` varchar(20) NOT NULL,
  `rand_id` varchar(255) NOT NULL,
  `websiteName` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `apt_or_suite_buildNum` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `paid` varchar(20) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `buz_name`, `email`, `work_phone`, `cell_phone`, `pass`, `service_type`, `registered_on`, `ip`, `rand_id`, `websiteName`, `street`, `apt_or_suite_buildNum`, `city`, `state`, `zip`, `paid`, `active`) VALUES
(1, 'Salah Bedeiwi', 'Website and Software Solutions', 'bedei001@umn.edu', '6126441634', '6126441634', 'salah', 'owner', '2017-05-11', '1', '123456', 'http://www.salahbedeiwi.com', '361 81st Ave NE', '', 'Spring Lake Park', 'Mn', 55432, 'yes', 1),
(2, 'salah i bedeiwi', 'Hooks Fish And Chicken', 'hook@hook.com', '6126441634', '6126441634', 'hooks', 'Regular', '2017-05-16', '::1', 'NNwAdGS', 'http://www.hooksfishandchicken.com', '1 highgate dr #120', '23', 'Spring Lake Park', 'Mn', 55432, 'no', 0),
(3, 'salah i bedeiwi', 'Taf Taf Restauarants', 'hooks@hook.com', '6126441634', '6126441634', 'hooks', 'Regular', '2017-05-16', '::1', 'bsuUicn', 'http://www.hooksfishandchicken.com', '1 highgate dr #120', '23', 'Spring Lake Park', 'Mn', 55432, 'yes', 1),
(4, 'asdfas', 'Albasha Restaurant', 'sbedeiwi@gmail.com', 'sal1236541236', 'asfasdf2323aadw323-3132', 'hooks', 'Regular', '2017-05-16', '::1', 'MWpqpiQ', 'http://www.hooksfishandchicken.com', '361 81st Ave, 23', '2', 'Ewing', 'New York', 55304, '0', 0),
(5, 'salah i bedeiwi', 'Alqurashi Travel Agencies', 'scg@f.com', '6126441634', '6126441634sad', 'safsadf', 'Regular', '2017-05-16', '::1', 'uODrKRh', 'http://www.hooksfishandchicken.com', '15963 quince st NW', '1236', 'Spring Lake Park', 'Mn', 55432, 'yes', 1),
(6, 'salah i bedeiwi', 'Budget Marketing Solutions', 'sgj@scss.css', '6126441634', '6126441634', 'saf', 'Professional', '2017-05-16', '::1', '9ntle3s', 'http://www.hooksfishandchicken.com', '361 81st Ave, 23', '23', 'Spring Lake Park', 'Mn', 55432, 'yes', 1),
(7, 'salah i bedeiwi', 'Holy Land Buffet', 'sbedei001@umn.edu', '612 501 4314', '6126441634', 'asdfas', 'Regular', '2017-05-16', '::1', 'OWNki6D', 'http://www.salahbedeiwi.com', '361 81st Ave', 'Apt# 012', 'Spring Lake Park', 'Mn', 55432, 'yes', 1),
(8, 'Abdelhak Elkhoual', 'Bank of America', 'elkhoual1973@hotmail.com', '6126441634', '6126441634', 'abdelhak', 'Professional', '2017-05-16', '::1', 'T7jsNaU', 'http://www.hooksfishandchicken.com', '361 81st Ave', '120', 'Columbia Height', 'Mn', 55432, 'yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `create_check`
--

CREATE TABLE `create_check` (
  `id` int(11) NOT NULL,
  `rand_id` varchar(255) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `check_number` bigint(50) NOT NULL,
  `check_status` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `create_check`
--

INSERT INTO `create_check` (`id`, `rand_id`, `payee`, `memo`, `amount`, `check_number`, `check_status`, `bank_id`, `created_on`) VALUES
(1, '6736010', 'mohamed E.', 'This is for Mohamed E.', 150.52, 5004, 1, 2, '0000-00-00'),
(2, '5949922', 'salah Helal bedeiwi', '$956.46 for website services', 5873.25, 5000, 1, 3, '0000-00-00'),
(3, '5888646', 'Mostafa Abdelalziz ||', '#153256-255', 3550.36, 5000, 1, 1, '2018-06-23'),
(4, '8525249', 'Khalil Awad ||', '#59653-85968', 7798.5, 5001, 1, 1, '2018-06-23'),
(5, '8218792', 'Tamer Mohsin ||', '#123', 9856.35, 5001, 0, 4, '2018-06-23'),
(6, '2500032', 'Arrowhead Engineered Products Inc.', '#6598-152', 500.01, 5005, 0, 1, '2018-06-23'),
(7, '8040059', 'Karim Osman', 'Chicago Order #654-15248965', 32326.02, 5000, 0, 5, '2018-06-25'),
(8, '3669394', 'Chris Jardome', 'Testing Engineer Project #12-659874 Num. 325', 65832.25, 5001, 1, 5, '2018-06-26'),
(9, '3882904', 'Megahid Mosa', 'Course #125-12', 152, 5002, 1, 3, '2018-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `it_team`
--

CREATE TABLE `it_team` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `buz_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `registered_on` date NOT NULL,
  `ip` varchar(20) NOT NULL,
  `rand_id` varchar(255) NOT NULL,
  `websiteName` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `apt_or_suite_buildNum` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `paid` varchar(20) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `it_team`
--

INSERT INTO `it_team` (`id`, `name`, `buz_name`, `email`, `work_phone`, `cell_phone`, `pass`, `service_type`, `registered_on`, `ip`, `rand_id`, `websiteName`, `street`, `apt_or_suite_buildNum`, `city`, `state`, `zip`, `paid`, `active`) VALUES
(1, 'salah Helal bedeiwi', 'Website and Software Solutions', 'bedei001@umn.edu', '6126441634', '6126441634', 'salah', 'owner', '2017-05-10', '::1', '123456', 'http://www.salahbedeiwi.com', '361 81st ave ne', '15', 'spring lake park', 'mn', 55432, 'yes', 1),
(2, 'SALAH BEDEIWI', 'Khalid', 'salah.bedeiwi@arrowheadep.com', '6126441634', '6126441634', 'salah', 'admin', '2018-06-27', '::1', '0567682', 'http://hooksfishnchips.com/index.php?menu', '1234 somestreet test', '0', 'Spring Lake Park', 'Minnesota', 55432, 'yes', 0),
(3, 'SALAH BEDEIWI', 'Test', 'salah.bedeiwi@arrowheadep.com1', '6126441634', '6126441634', 'salah', 'admin', '2018-06-27', '::1', '0229692', 'http://hooksfishnchips.com/index.php?menu', '1234 somestreet test', '15', 'Spring Lake Park', 'Minnesota', 55432, 'yes', 0),
(4, 'Jordan S', 'J. Corp', 'bedei002@umn.edu', '6126441634', '6126441634', 'salah', 'owner', '2018-06-27', '::1', '8574357', 'http://hooksfishnchips.com/index.php?menu', '1234 somestreet test', '0', 'Spring Lake Park', 'Minnesota', 55432, 'yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `your_account`
--

CREATE TABLE `your_account` (
  `id` int(11) NOT NULL,
  `your_name` varchar(255) NOT NULL,
  `your_main_address` varchar(255) NOT NULL,
  `cityStateZip` varchar(255) NOT NULL,
  `your_phone_number` varchar(50) NOT NULL,
  `acct_type` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_main_strreet_address` varchar(255) NOT NULL,
  `bank_cityZipCode` varchar(255) NOT NULL,
  `acct_number` varchar(50) NOT NULL,
  `routing_number` varchar(50) NOT NULL,
  `bank_phone` varchar(255) NOT NULL,
  `active` int(10) NOT NULL,
  `check_number` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `your_account`
--

INSERT INTO `your_account` (`id`, `your_name`, `your_main_address`, `cityStateZip`, `your_phone_number`, `acct_type`, `bank_name`, `bank_main_strreet_address`, `bank_cityZipCode`, `acct_number`, `routing_number`, `bank_phone`, `active`, `check_number`) VALUES
(1, 'salah Helal bedeiwi', '361 81st ave ne', 'spring lake park', '6126441634', 'Saving', 'Bank Of America', '', '', '987654321', '09110900', '(952) 952-9529', 1, 5006),
(2, 'Abdelhak Elkhoual', '2300 w.market', 'Jasper, NJ 12345', '6125014314', 'Checking', 'Myrill Lynch', '', '', '987654321', '09000900', '6126441634', 1, 5002),
(3, 'Mohamed E.', '631 63th Ave Ne', 'Spring Lake Park, MN 55431', '6126441634', 'Saving', 'Wells Fargo!', '', '', '123456789', '09110900', '6126441634', 1, 5003),
(4, 'SALAH BEDEIWI', '1234 somestreet test', 'Spring Lake Park', '6126441634', 'Saving', 'TCF Bank', '', '', '987654321', '09110900', '6126441634', 1, 5001),
(5, 'Ahmed Elawady', '361 81st Ave NE', 'spring lake park, MN 55432', '612 644-1634', 'Credit Card', 'Wings Inc. ||', '385 37th Ave NE', 'Columbia Height, MN 55745', '5745183452', '4738152452', '(612) 547-6875', 1, 5002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_info`
--
ALTER TABLE `business_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_check`
--
ALTER TABLE `create_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_team`
--
ALTER TABLE `it_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `your_account`
--
ALTER TABLE `your_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_info`
--
ALTER TABLE `business_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `create_check`
--
ALTER TABLE `create_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `it_team`
--
ALTER TABLE `it_team`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `your_account`
--
ALTER TABLE `your_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
