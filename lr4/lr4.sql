-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2025 at 05:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lr4`
--

-- --------------------------------------------------------

--
-- Table structure for table `enterprises`
--

CREATE TABLE `enterprises` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `annual_output_rub` decimal(18,2) DEFAULT NULL,
  `facade_image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprises`
--

INSERT INTO `enterprises` (`id`, `name`, `region_id`, `description`, `annual_output_rub`, `facade_image_url`) VALUES
(1, 'TechCorp', 1, 'Leading tech company in Moscow', 500000000.00, 'path/to/techcorp_facade.jpg'),
(2, 'GreenEnergy', 2, 'Renewable energy company in Saint Petersburg', 300000000.00, 'path/to/greenenergy_facade.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE `indicators` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`id`, `code`, `name`, `unit`) VALUES
(1, 'energy_usage', 'Energy Consumption', 'kWh'),
(2, 'production_volume', 'Production Volume', 'tons');

-- --------------------------------------------------------

--
-- Table structure for table `indicator_logs`
--

CREATE TABLE `indicator_logs` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `record_date` date NOT NULL,
  `value` decimal(18,4) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indicator_logs`
--

INSERT INTO `indicator_logs` (`id`, `enterprise_id`, `indicator_id`, `record_date`, `value`, `notes`) VALUES
(1, 1, 1, '2025-01-01', 5000.0000, 'Energy consumption in January 2025'),
(2, 1, 2, '2025-01-01', 1000.0000, 'Production volume in January 2025');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Moscow'),
(2, 'Saint Petersburg'),
(3, 'Kazan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `indicators`
--
ALTER TABLE `indicators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `indicator_logs`
--
ALTER TABLE `indicator_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicator_id` (`indicator_id`),
  ADD KEY `idx_enterprise_indicator_date` (`enterprise_id`,`indicator_id`,`record_date`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `indicators`
--
ALTER TABLE `indicators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `indicator_logs`
--
ALTER TABLE `indicator_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD CONSTRAINT `enterprises_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `indicator_logs`
--
ALTER TABLE `indicator_logs`
  ADD CONSTRAINT `indicator_logs_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`),
  ADD CONSTRAINT `indicator_logs_ibfk_2` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
