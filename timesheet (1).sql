-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 12:04 PM
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
(10, 'Kevin', 'kevinkarish001@gmail.com', '100', '12345678'),
(11, 'Kevin_HR', 'kevinkarish983@gmail.com', '102', '12345678');

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
(10, 'b334', 'Molo'),
(14, 'b001', 'Ngong'),
(15, 'c100', 'Nairobi');

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
(9, '100', 'ICT'),
(10, '101', 'Procurement '),
(11, '102', 'HR'),
(12, '103', 'Finance'),
(13, '104', 'Security '),
(14, '105', 'Sales and marketing'),
(15, '106', 'Management'),
(16, '107', 'Data management');

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
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `fname`, `lname`, `email`, `approval`, `under_leave`, `department`, `phone`, `password`) VALUES
(33, 'Kevin', 'Kevin', 'Kariuki', 'kevinkarish983@gmail.com', 'Approved', 'No', '100', 746182038, '$2y$10$UwxmpnlFz9usyqcIL11EmOTVHe7eKddCgLza84y6YS1SFwxB04cxO');

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
(3, 33, '2024-02-01', '2024-02-10', '<p>visit my family</p>', 'Yes', '2024-02-01 08:03:01'),
(4, 33, '2024-02-10', '2024-02-17', '<p>skdncksjcn sciuhciu siuchsdiu&nbsp;</p>', 'No', '2024-02-01 10:30:28');

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
(10, 33, NULL, 33, NULL, NULL, '100', 'test message', 'Yes', 'Yes', '2024-02-05 07:26:40'),
(11, 33, 10, 10, 33, 10, '100', 'okay, how is you?', 'Yes', 'Yes', '2024-02-05 07:27:24'),
(12, 33, 10, 33, 10, 10, '100', 'alright', 'Yes', 'Yes', '2024-02-05 07:36:08'),
(13, 33, 10, 10, 33, 10, '100', 'okay', 'Yes', 'Yes', '2024-02-05 08:08:20'),
(14, 33, NULL, 33, NULL, NULL, '100', 'thank you', 'Yes', 'Yes', '2024-02-05 09:04:31');

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
  `file` longblob NOT NULL,
  `timeout` time NOT NULL DEFAULT current_timestamp(),
  `time_uploaded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `employee_id`, `date`, `time_in`, `place_of_work`, `remarks`, `picture`, `file`, `timeout`, `time_uploaded`) VALUES
(47, 33, '2024-01-29', '11:39:00', 'Molo', '<p>KSNCK VKS K N On vndk vndkhvodvnk dhvkdfh vodhvkdfh</p>', '1706452814Screenshot 2024-01-19 194110.png', '', '17:40:14', '2024-01-28 14:40:14');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `leave_request`
--
ALTER TABLE `leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
