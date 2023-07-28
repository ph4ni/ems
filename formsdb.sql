-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2023 at 05:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `activation_code`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com', ''),
(2, 'sai', '$2y$10$1J7zRQCM6hdhSpl8.dVTMObxYvVFwfLOz0SG4G7ceAla1V/ji4/Re', 'sai@sai.com', ''),
(3, 'phani', '$2y$10$wCE72XrWocC0w3tjXaYuM.gyZ0SrkYc.Wb5kdbsXlvmP9O8SbzKjC', 'phani@xaple.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `Annualday`
--

CREATE TABLE `Annualday` (
  `id` int(6) UNSIGNED NOT NULL,
  `Name` text DEFAULT NULL,
  `roll` int(11) DEFAULT NULL,
  `att` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Annualday`
--

INSERT INTO `Annualday` (`id`, `Name`, `roll`, `att`) VALUES
(1, 'Phanindra', 203233, 0),
(2, 'Hari Krishna', 38, 0),
(3, 'raghu', 787, 1),
(4, 'ashok', 4545, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Annualday_att`
--

CREATE TABLE `Annualday_att` (
  `id` int(6) NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `PHP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Annualday_att`
--

INSERT INTO `Annualday_att` (`id`, `sid`, `PHP`) VALUES
(1, NULL, 1),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Annualday_sessions`
--

CREATE TABLE `Annualday_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Annualday_sessions`
--

INSERT INTO `Annualday_sessions` (`sid`, `sname`, `sday`, `stimestart`, `stimeend`) VALUES
(1, 'Ritchie Lab', '2023-04-21', '09:30:00', '10:30:00'),
(2, 'Knuth Lab', '2023-04-27', '04:40:00', '06:40:00'),
(3, 'Abacus Lab', '2023-04-12', '09:02:00', '10:30:00'),
(4, 'Blender', '2023-04-27', '23:00:00', '11:30:00'),
(5, 'WordPress', '2023-04-05', '10:30:00', '11:30:00'),
(6, 'PHP', '2023-04-11', '10:30:00', '11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `Annual_day_registration_form`
--

CREATE TABLE `Annual_day_registration_form` (
  `id` int(6) UNSIGNED NOT NULL,
  `Name` text DEFAULT NULL,
  `Year` text DEFAULT NULL,
  `Branch` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Annual_day_registration_form`
--

INSERT INTO `Annual_day_registration_form` (`id`, `Name`, `Year`, `Branch`) VALUES
(1, 'Phanindra', '3', 'IT'),
(2, 'profit', '2023', 'IT'),
(3, 'phani', '4', 'it');

-- --------------------------------------------------------

--
-- Table structure for table `Annual_day_registration_form_att`
--

CREATE TABLE `Annual_day_registration_form_att` (
  `id` int(6) NOT NULL,
  `Dance` int(11) NOT NULL DEFAULT 0,
  `Singing` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Annual_day_registration_form_att`
--

INSERT INTO `Annual_day_registration_form_att` (`id`, `Dance`, `Singing`) VALUES
(1, 1, 0),
(2, 0, 0),
(3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Annual_day_registration_form_sessions`
--

CREATE TABLE `Annual_day_registration_form_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Annual_day_registration_form_sessions`
--

INSERT INTO `Annual_day_registration_form_sessions` (`sid`, `sname`, `sday`, `stimestart`, `stimeend`) VALUES
(1, 'Dance', '2023-04-28', '10:00:00', '12:00:00'),
(2, 'Singing', '2023-04-26', '09:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `balaswecha`
--

CREATE TABLE `balaswecha` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cert` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balaswecha`
--

INSERT INTO `balaswecha` (`id`, `name`, `class`, `date`, `cert`) VALUES
(1, 'person2', '5', '2023-05-24', 0),
(2, 'person5', '5', '2023-05-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `balaswecha_att`
--

CREATE TABLE `balaswecha_att` (
  `id` int(6) NOT NULL,
  `first` int(11) NOT NULL DEFAULT 0,
  `second` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balaswecha_att`
--

INSERT INTO `balaswecha_att` (`id`, `first`, `second`) VALUES
(1, 1, 0),
(2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `balaswecha_sessions`
--

CREATE TABLE `balaswecha_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balaswecha_sessions`
--

INSERT INTO `balaswecha_sessions` (`sid`, `sname`, `sday`, `stimestart`, `stimeend`) VALUES
(1, 'first', '2023-05-18', '12:00:00', '13:00:00'),
(2, 'second', '2023-05-18', '04:00:00', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events_table`
--

CREATE TABLE `events_table` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `form_name` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_table`
--

INSERT INTO `events_table` (`event_id`, `event_name`, `form_name`, `duration`, `start_date`, `end_date`) VALUES
(54, 'Manas Tarang', 'Annual_day_registration_form', 4, '2023-04-28', '2023-04-29'),
(46, 'kushal pet show', 'kushal_pet_show_form', 3, '2023-04-25', '2023-04-28'),
(59, 'Placement Drive', 'Registration_form', 2, '2023-07-27', '2023-07-29'),
(56, 'Holi Party', 'Holi_Party_Registration', 3, '2023-05-16', '2023-05-25'),
(48, 'Annual day culturals', 'culturals_form', 1, '2023-04-28', '2023-04-29'),
(57, 'Balaswecha', 'balaswecha', 7, '2023-05-24', '2023-05-26'),
(40, 'Annual Day', 'Annualday', 1, '2023-04-23', '2023-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `Freedom_Fest_registration`
--

CREATE TABLE `Freedom_Fest_registration` (
  `id` int(6) UNSIGNED NOT NULL,
  `Name` text DEFAULT NULL,
  `Year` text DEFAULT NULL,
  `College` text DEFAULT NULL,
  `att` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Freedom_Fest_registration`
--

INSERT INTO `Freedom_Fest_registration` (`id`, `Name`, `Year`, `College`, `att`) VALUES
(1, 'M.V.N Harshitha', '2', 'MVGR', 1),
(2, 'Phani', '4', 'MVGR', 0),
(3, 'Divya', '2', 'MVGR', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Freedom_Fest_registration_att`
--

CREATE TABLE `Freedom_Fest_registration_att` (
  `id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Freedom_Fest_registration_att`
--

INSERT INTO `Freedom_Fest_registration_att` (`id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `Freedom_Fest_registration_sessions`
--

CREATE TABLE `Freedom_Fest_registration_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Holi_Party_Registration`
--

CREATE TABLE `Holi_Party_Registration` (
  `id` int(6) UNSIGNED NOT NULL,
  `Name` text DEFAULT NULL,
  `Age` text DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `College` text DEFAULT NULL,
  `cert` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Holi_Party_Registration`
--

INSERT INTO `Holi_Party_Registration` (`id`, `Name`, `Age`, `DoB`, `College`, `cert`) VALUES
(1, 'Phanindra', '21', '2023-05-18', 'MVGR', 0),
(2, 'Hari Krishna', '25', '2023-05-11', 'MVGR', 0),
(3, 'Vinay', '24', '2023-05-09', 'MVGR', 0),
(4, 'Bharat', '25', '2023-05-27', 'MVGR', 0),
(5, 'Pavani', '26', '2021-04-11', 'AU', 0),
(6, 'Harshitha', '28', '2011-01-11', 'JNTUK', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Holi_Party_Registration_att`
--

CREATE TABLE `Holi_Party_Registration_att` (
  `id` int(6) NOT NULL,
  `Rangoli` int(11) NOT NULL DEFAULT 0,
  `Dinner` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Holi_Party_Registration_att`
--

INSERT INTO `Holi_Party_Registration_att` (`id`, `Rangoli`, `Dinner`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 1, 0),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Holi_Party_Registration_sessions`
--

CREATE TABLE `Holi_Party_Registration_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Holi_Party_Registration_sessions`
--

INSERT INTO `Holi_Party_Registration_sessions` (`sid`, `sname`, `sday`, `stimestart`, `stimeend`) VALUES
(1, 'Rangoli', '2023-05-22', '09:00:00', '10:00:00'),
(2, 'Rain_dance`', '2023-05-17', '07:00:00', '08:00:00'),
(3, 'Dinner', '2023-05-23', '10:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kushal_pet_show_form`
--

CREATE TABLE `kushal_pet_show_form` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `pet_type` text DEFAULT NULL,
  `petname` text DEFAULT NULL,
  `att` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kushal_pet_show_form`
--

INSERT INTO `kushal_pet_show_form` (`id`, `name`, `pet_type`, `petname`, `att`) VALUES
(1, 'kushal', '9999999999', 'dog', 0),
(2, 'harshita', '123', 'cat', 1),
(3, 'kushalraju', '44', 'snoopy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kushal_pet_show_form_att`
--

CREATE TABLE `kushal_pet_show_form_att` (
  `id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kushal_pet_show_form_att`
--

INSERT INTO `kushal_pet_show_form_att` (`id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `kushal_pet_show_form_sessions`
--

CREATE TABLE `kushal_pet_show_form_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pls_work`
--

CREATE TABLE `pls_work` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `cert` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pls_work_att`
--

CREATE TABLE `pls_work_att` (
  `id` int(6) NOT NULL,
  `first` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pls_work_sessions`
--

CREATE TABLE `pls_work_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pls_work_sessions`
--

INSERT INTO `pls_work_sessions` (`sid`, `sname`, `sday`, `stimestart`, `stimeend`) VALUES
(1, 'first', '2023-04-26', '10:30:00', '20:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `Registration_form`
--

CREATE TABLE `Registration_form` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `year` text DEFAULT NULL,
  `cert` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Registration_form`
--

INSERT INTO `Registration_form` (`id`, `name`, `dob`, `year`, `cert`) VALUES
(1, 'Sai Phanindra', '2013-07-18', '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Registration_form_att`
--

CREATE TABLE `Registration_form_att` (
  `id` int(6) NOT NULL,
  `Assessment_test` int(11) NOT NULL DEFAULT 0,
  `second` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Registration_form_att`
--

INSERT INTO `Registration_form_att` (`id`, `Assessment_test`, `second`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Registration_form_sessions`
--

CREATE TABLE `Registration_form_sessions` (
  `sid` int(6) UNSIGNED NOT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `sday` date DEFAULT NULL,
  `stimestart` time DEFAULT NULL,
  `stimeend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Registration_form_sessions`
--

INSERT INTO `Registration_form_sessions` (`sid`, `sname`, `sday`, `stimestart`, `stimeend`) VALUES
(1, 'Assessment_test', '2023-07-28', '09:10:00', '10:10:00'),
(2, 'second', '2023-07-27', '03:30:00', '04:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Annualday`
--
ALTER TABLE `Annualday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Annualday_att`
--
ALTER TABLE `Annualday_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Annualday_sessions`
--
ALTER TABLE `Annualday_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `Annual_day_registration_form`
--
ALTER TABLE `Annual_day_registration_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Annual_day_registration_form_att`
--
ALTER TABLE `Annual_day_registration_form_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Annual_day_registration_form_sessions`
--
ALTER TABLE `Annual_day_registration_form_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `balaswecha`
--
ALTER TABLE `balaswecha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balaswecha_att`
--
ALTER TABLE `balaswecha_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balaswecha_sessions`
--
ALTER TABLE `balaswecha_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `events_table`
--
ALTER TABLE `events_table`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `Freedom_Fest_registration`
--
ALTER TABLE `Freedom_Fest_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Freedom_Fest_registration_att`
--
ALTER TABLE `Freedom_Fest_registration_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Freedom_Fest_registration_sessions`
--
ALTER TABLE `Freedom_Fest_registration_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `Holi_Party_Registration`
--
ALTER TABLE `Holi_Party_Registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Holi_Party_Registration_att`
--
ALTER TABLE `Holi_Party_Registration_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Holi_Party_Registration_sessions`
--
ALTER TABLE `Holi_Party_Registration_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `kushal_pet_show_form`
--
ALTER TABLE `kushal_pet_show_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kushal_pet_show_form_att`
--
ALTER TABLE `kushal_pet_show_form_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kushal_pet_show_form_sessions`
--
ALTER TABLE `kushal_pet_show_form_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `pls_work`
--
ALTER TABLE `pls_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pls_work_att`
--
ALTER TABLE `pls_work_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pls_work_sessions`
--
ALTER TABLE `pls_work_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `Registration_form`
--
ALTER TABLE `Registration_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Registration_form_att`
--
ALTER TABLE `Registration_form_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Registration_form_sessions`
--
ALTER TABLE `Registration_form_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Annualday`
--
ALTER TABLE `Annualday`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Annualday_sessions`
--
ALTER TABLE `Annualday_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Annual_day_registration_form`
--
ALTER TABLE `Annual_day_registration_form`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Annual_day_registration_form_sessions`
--
ALTER TABLE `Annual_day_registration_form_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `balaswecha`
--
ALTER TABLE `balaswecha`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `balaswecha_sessions`
--
ALTER TABLE `balaswecha_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events_table`
--
ALTER TABLE `events_table`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `Freedom_Fest_registration`
--
ALTER TABLE `Freedom_Fest_registration`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Freedom_Fest_registration_sessions`
--
ALTER TABLE `Freedom_Fest_registration_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Holi_Party_Registration`
--
ALTER TABLE `Holi_Party_Registration`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Holi_Party_Registration_sessions`
--
ALTER TABLE `Holi_Party_Registration_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kushal_pet_show_form`
--
ALTER TABLE `kushal_pet_show_form`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kushal_pet_show_form_sessions`
--
ALTER TABLE `kushal_pet_show_form_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pls_work`
--
ALTER TABLE `pls_work`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pls_work_sessions`
--
ALTER TABLE `pls_work_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Registration_form`
--
ALTER TABLE `Registration_form`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Registration_form_sessions`
--
ALTER TABLE `Registration_form_sessions`
  MODIFY `sid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
