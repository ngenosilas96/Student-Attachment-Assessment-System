-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 11:28 AM
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
-- Database: `timesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(8) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `department`, `password`) VALUES
(12, 'Emmanuel', 'emmanuelngeno23@gmail.com', '001', '31713171'),
(13, 'Manuu', '18670@student.embuni.ac.ke', '002', '11111111');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `branch_number` varchar(50) NOT NULL,
  `branch_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_number`, `branch_name`) VALUES
(16, '1', 'University of Embu'),
(17, '2', 'Embu college '),
(18, '3', 'KSG'),
(19, '4', 'Kayole'),
(20, '5', 'Bagik');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_number` varchar(100) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_number`, `department_name`) VALUES
(17, '001', 'ICT'),
(18, '002', 'Procurement'),
(19, '003', 'Finance'),
(20, '004', 'SESS'),
(21, '005', 'Economics'),
(22, '006', 'Education');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `approval` text NOT NULL,
  `under_leave` text NOT NULL,
  `department` text NOT NULL,
  `phone` int(10) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `fname`, `lname`, `email`, `approval`, `under_leave`, `department`, `phone`, `last_login`, `password`) VALUES
(35, 'Emmanuel', 'Emmanuel', 'Ngeno', 'emmanuelngeno23@gmail.com', 'Approved', 'No', '001', 719191921, '2024-02-09 09:33:02', '$2y$10$1jpzZb5RLzWt3qwLu35ioe1pBFcXq4X/ICT2FmF4WTexXCK5thFRe'),
(36, 'Collo', 'Collins ', 'Kiplangat', '27383@student.embuni.ac.ke', 'Approved', 'Yes', '002', 701574737, '2024-02-08 11:01:44', '$2y$10$0xn0XhDIoWn.9//QnVPGH.vtd5BXVimSw41dWOgBg5qIuRePS0mlu');

-- --------------------------------------------------------

--
-- Table structure for table `leave_request`
--

CREATE TABLE `leave_request` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_when` date NOT NULL,
  `reason` text NOT NULL,
  `accepted` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_request`
--

INSERT INTO `leave_request` (`id`, `employee_id`, `from_date`, `to_when`, `reason`, `accepted`, `date`) VALUES
(5, 34, '2024-02-05', '2024-02-08', '<p>We are now done&nbsp; with the attachment you can allow me to quite</p>', 'Yes', '2024-02-05 14:43:11'),
(6, 35, '2024-02-06', '2024-02-14', '<p>This is just to confirm if you can allow me to leave because am done with the attachment&nbsp;</p>', 'Yes', '2024-02-05 16:44:54'),
(7, 35, '2024-02-06', '2024-02-07', '<p>We are now heading to the completion of the attachement session, I\'m now ready to quit the company.</p>', 'Yes', '2024-02-06 13:26:12'),
(8, 36, '2024-02-10', '2024-02-22', '<p>Am almost done with my attachment. Days I was given by the Organization is almost collapsing&nbsp;</p>', 'Yes', '2024-02-08 11:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(20) NOT NULL,
  `employee_id` int(20) DEFAULT NULL,
  `admin_id` int(20) DEFAULT NULL,
  `message_from` int(20) DEFAULT NULL,
  `message_to` int(20) DEFAULT NULL,
  `parent_message_id` int(20) DEFAULT NULL,
  `department` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `message_read` varchar(5) NOT NULL,
  `admin_read` varchar(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `employee_id`, `admin_id`, `message_from`, `message_to`, `parent_message_id`, `department`, `content`, `message_read`, `admin_read`, `date`) VALUES
(16, 35, NULL, 35, NULL, NULL, '1', 'hey there', 'Yes', 'Yes', '2024-02-05 13:05:01'),
(17, 35, 12, 12, 35, 16, '1', 'hi, how is you', 'Yes', 'Yes', '2024-02-05 13:05:46'),
(18, 35, 12, 35, 12, 16, '1', 'Awesome, When are you coming to assess me?', 'Yes', 'Yes', '2024-02-05 15:18:23'),
(19, 35, 12, 35, 12, 16, '1', 'were here all right\n', 'Yes', 'Yes', '2024-02-05 17:43:12'),
(20, 35, 12, 12, 35, 16, '1', 'We are checking you,,\n', 'Yes', 'Yes', '2024-02-05 17:47:40'),
(22, 35, NULL, 35, NULL, NULL, '1', 'Am coming to hold a meeting in ABH by 10am, Keep on working with the task we had.', 'Yes', 'Yes', '2024-02-06 13:23:02'),
(23, 35, 12, 12, 35, 22, '1', 'Okay sir, am gonna keep bushing...', 'Yes', 'Yes', '2024-02-06 13:24:04'),
(24, 35, 12, 35, 12, 22, '1', 'we are there with you\n', 'Yes', 'Yes', '2024-02-08 10:53:00'),
(25, 35, 12, 12, 35, 22, '1', 'Ok am much pleased with your company ', 'Yes', 'Yes', '2024-02-08 10:53:43'),
(26, 35, NULL, 35, NULL, NULL, '1', 'When are we going to watch our firm', 'Yes', 'Yes', '2024-02-08 10:54:53'),
(27, 36, NULL, 36, NULL, NULL, '2', 'I have summitted my KRA file', 'Yes', 'Yes', '2024-02-08 11:05:47'),
(28, 36, 13, 13, 36, 27, '2', 'Ok let me check', 'Yes', 'Yes', '2024-02-08 11:06:38'),
(31, 36, 13, 36, 13, 27, '2', 'Why did you send me many reply of the same characters', 'Yes', 'Yes', '2024-02-08 11:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `place_of_work` text NOT NULL,
  `remarks` longtext NOT NULL,
  `picture` text NOT NULL,
  `file` longblob DEFAULT NULL,
  `timeout` time NOT NULL DEFAULT current_timestamp(),
  `time_uploaded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `employee_id`, `date`, `time_in`, `place_of_work`, `remarks`, `picture`, `file`, `timeout`, `time_uploaded`) VALUES
(61, 35, '2024-02-06', '16:19:00', 'KSG', '<p>Here we are at the moment...</p>', '1707225629Screenshot_20240204-210423.png', NULL, '16:20:29', '2024-02-06 13:20:29'),
(62, 35, '2024-02-08', '11:30:00', 'Kayole', '<p>We are almost done with the sem 2. We did the project as part of our learning.&nbsp;</p>', '1707389016remo.png', NULL, '13:43:36', '2024-02-08 10:43:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `leave_request`
--
ALTER TABLE `leave_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `leave_request`
--
ALTER TABLE `leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
