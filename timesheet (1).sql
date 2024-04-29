-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 05:26 PM
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
  `level` int(1) NOT NULL DEFAULT 2,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `department`, `level`, `password`) VALUES
(14, 'Manuu', 'testing@gmail.com', '1', 1, '12121212'),
(15, 'Manuu', 'emmanuelngeno23@gmail.com', '4', 2, '11111111'),
(16, 'Emmanuel', '18670@student.embuni.ac.ke', '6', 2, '22222222'),
(17, '18670', 'mannukip19@gmail.com', '2', 2, '33333333'),
(18, 'Emman', 'qwerty@gmail.com', '1', 2, '00000000'),
(19, 'Emman', '18670@gmail.com', '3', 2, '00000000');

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
(20, '5', 'Bagik'),
(21, '0719191921', 'Emmanuel');

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
(23, '1', 'Physical Science'),
(24, '2', 'Biological Sciences'),
(25, '3', 'Mathematics & Statistics'),
(26, '4', 'Computing and Information Technology'),
(27, '5', 'Water Resource Management'),
(28, '6', 'Agricultural Economics and Extension'),
(29, '7', 'Education'),
(30, '8', 'Humanities'),
(31, '9', 'Business Studies'),
(32, '10', 'Economics '),
(33, '11', 'Commercial Law'),
(34, '12', 'Community Health');

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
(35, 'Emmanuel', 'Emmanuel', 'Ngeno', 'emmanuelngeno23@gmail.com', 'Approved', 'No', '1', 719191921, '2024-04-12 08:24:38', '$2y$10$1jpzZb5RLzWt3qwLu35ioe1pBFcXq4X/ICT2FmF4WTexXCK5thFRe'),
(36, 'Silas', 'Ngeno', 'Kipsang', 'ngenosilas96@gmail.com', 'Approved', 'No', '2', 701574737, '2024-03-01 10:02:20', '$2y$10$0xn0XhDIoWn.9//QnVPGH.vtd5BXVimSw41dWOgBg5qIuRePS0mlu'),
(37, 'b135/18674/2020', 'Robert', 'Yegon', '18670@student.embuni.ac.ke', 'Approved', 'No', '6', 703879056, '2024-03-08 17:54:33', '$2y$10$gEAatjWKe8mFZqGt6kpa3.Uw.PBuAs03l7jgdryu5lp.quVXeb3Va');

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
(6, 35, '2024-02-06', '2024-02-14', '<p>This is just to confirm if you can allow me to leave because am done with the attachment&nbsp;</p>', 'Yes', '2024-02-05 16:44:54'),
(8, 36, '2024-02-10', '2024-02-22', '<p>Am almost done with my attachment. Days I was given by the Organization is almost collapsing&nbsp;</p>', 'Yes', '2024-02-08 11:16:51'),
(9, 35, '2024-02-11', '2024-02-18', '<p>My attachment is now ending this week</p>', 'No', '2024-02-11 13:28:10'),
(10, 35, '2024-02-11', '2024-02-18', '<p>Kindly approve my leave</p>', 'Yes', '2024-02-11 13:29:09'),
(11, 37, '2024-03-06', '2024-03-09', '<p>am done now</p>', 'No', '2024-02-27 10:23:19'),
(12, 35, '2024-03-08', '2024-03-12', '<p>We are done with our work now</p>', 'Yes', '2024-03-07 21:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `link` varchar(250) NOT NULL,
  `note` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `user_id`, `department`, `date`, `time`, `link`, `note`, `date_created`) VALUES
(10, 15, '4', '2024-03-07', '23:52:00', 'https://meet.google.com/xiy-mmpp-qyw', 'Kindly I will need to see your area', '2024-03-07 20:53:08'),
(11, 15, '4', '2024-03-08', '00:12:00', 'www.ac.ke', 'Who is online', '2024-03-07 21:13:08');

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
(37, 35, NULL, 35, NULL, NULL, '4', 'I need to see you now sir', 'Yes', 'Yes', '2024-03-08 09:23:36'),
(43, 35, 15, 15, 35, 37, '4', 'alright', 'Yes', 'Yes', '2024-03-08 09:38:08'),
(44, 35, 15, 35, 15, 37, '4', 'where are you now sir?\n', 'Yes', 'Yes', '2024-03-08 09:38:44'),
(45, 35, 15, 15, 35, 37, '4', 'My office...', 'Yes', 'Yes', '2024-03-08 15:45:37');

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
  `time_uploaded` timestamp NOT NULL DEFAULT current_timestamp(),
  `approve` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `employee_id`, `date`, `time_in`, `place_of_work`, `remarks`, `picture`, `file`, `timeout`, `time_uploaded`, `approve`) VALUES
(61, 35, '2024-02-06', '16:19:00', 'KSG', '<p>Here we are at the moment...</p>', '1707225629Screenshot_20240204-210423.png', NULL, '16:20:29', '2024-02-06 13:20:29', NULL),
(62, 35, '2024-02-08', '11:30:00', 'Kayole', '<p>We are almost done with the sem 2. We did the project as part of our learning.&nbsp;</p>', '1707389016remo.png', NULL, '13:43:36', '2024-02-08 10:43:36', NULL),
(65, 35, '2024-02-09', '10:34:00', 'Embu college ', '<p>We are really testing the project.</p>', '', NULL, '14:34:17', '2024-02-09 11:34:17', NULL),
(66, 35, '2024-02-11', '12:19:00', 'University of Embu', '<p>I\'m always on the site to make sure that my work is on the right track</p>', '', NULL, '16:20:48', '2024-02-11 13:20:48', NULL),
(67, 35, '2024-02-27', '13:50:00', 'University of Embu', '<p>I was sent to see Dr. Ngeno</p>', '1709028752545.png', NULL, '13:12:32', '2024-02-27 10:12:32', NULL),
(73, 37, '2024-03-07', '20:54:00', 'Embu college ', '<p>It was nice to have build this system with my dear friend.</p>', '', NULL, '20:58:14', '2024-03-08 17:58:14', 1),
(75, 37, '2024-03-08', '21:02:00', 'Kayole', '<p>I was tracking the students I was assign to by the project coordinator.</p>', '1709920997Manu.jpg', NULL, '21:03:17', '2024-03-08 18:03:17', NULL),
(76, 35, '2024-03-16', '10:57:00', 'Kayole', '<p>Testing the time of submission, Kindly be adhare to the rules and requlations of the school time and dates</p>', '', NULL, '14:58:24', '2024-03-15 11:58:24', 0),
(78, 35, '2024-03-29', '15:08:00', 'Embu college ', '<p>I liked the system to used by the university</p>', '', NULL, '15:09:19', '2024-03-29 12:09:19', NULL),
(79, 35, '2024-04-01', '14:48:00', 'Emmanuel', '<p>I was testing the number of student in a certain field. It is working as i needed. Am now free to work on the next stage. Thank you Sir!</p>', '1711972241florian-olivo-4hbJ-eymZ1o-unsplash.jpg', NULL, '14:50:41', '2024-04-01 11:50:41', NULL),
(82, 35, '2024-04-02', '14:32:00', 'KSG', '<p>Almost done...</p>', '', NULL, '14:32:29', '2024-04-08 11:32:29', 0),
(84, 35, '2024-04-10', '16:33:00', 'KSG', '<p>Delete the Task</p>', '', NULL, '16:34:13', '2024-04-11 13:34:13', 0),
(85, 35, '2024-04-09', '16:52:00', 'Bagik', '<p>Now good?</p>\r\n<p>&nbsp;</p>', '', NULL, '16:52:49', '2024-04-11 13:52:49', 0),
(87, 35, '2024-04-10', '22:13:00', 'Emmanuel', '<p>Still testing the system.</p>', '1712862865logos.png', NULL, '22:14:25', '2024-04-11 19:14:25', 1),
(99, 35, '2024-04-13', '16:36:00', '', '<p>Assuming we have not submit todays work, i can submit tomorrows work and can be take as late submission</p>', '', NULL, '16:36:36', '2024-04-12 13:36:36', 1);

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
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `leave_request`
--
ALTER TABLE `leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
