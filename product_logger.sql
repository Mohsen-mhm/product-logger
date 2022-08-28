-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 06:00 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_logger`
--

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `resource_name` varchar(255) DEFAULT NULL,
  `last_version` varchar(50) DEFAULT NULL,
  `install` int(11) DEFAULT 0,
  `active_install` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `resource_name`, `last_version`, `install`, `active_install`) VALUES
(124, 'product1', '0.1.9', 0, 0),
(125, 'product22', '0.2.3', 0, 0),
(126, 'product33', '0.1.6', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `resource_version`
--

CREATE TABLE `resource_version` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `change_log` text DEFAULT NULL,
  `need_db_update` tinyint(1) DEFAULT NULL,
  `need_congif_update` tinyint(1) DEFAULT NULL,
  `necessary_update` tinyint(1) DEFAULT NULL,
  `release_url` varchar(255) DEFAULT NULL,
  `need_server_response` tinyint(1) DEFAULT NULL,
  `need_client_response` tinyint(1) DEFAULT NULL,
  `server_response_tire1` longtext DEFAULT NULL,
  `server_response_tire2` longtext DEFAULT NULL,
  `server_client_tire1` longtext DEFAULT NULL,
  `server_client_tire2` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource_version`
--

INSERT INTO `resource_version` (`id`, `resource_id`, `version`, `change_log`, `need_db_update`, `need_congif_update`, `necessary_update`, `release_url`, `need_server_response`, `need_client_response`, `server_response_tire1`, `server_response_tire2`, `server_client_tire1`, `server_client_tire2`) VALUES
(53, 124, '0.1.0', 'Test cahnge log1', 0, 1, 1, 'https://product1.com/0-1-0', 0, 1, 'test1', 'test1', 'test1', 'test1'),
(54, 124, '0.1.9', 'Test cahnge log2', 0, 1, 1, 'https://product1.com/0-1-9', 1, 0, 'test2', 'test2', 'test2', 'test2'),
(55, 125, '0.2.3', 'Test cahnge log3', 1, 0, 0, 'https://product22.com/0-2-3', 0, 1, 'test3', 'test3', 'test3', 'test3'),
(56, 126, '0.0.2', 'Test cahnge log4', 1, 1, 0, 'https://product33.com/0-0-2', 0, 0, 'test4', 'test4', 'test4', 'test4\r\n'),
(57, 126, '0.1.6', 'Test cahnge log4', 1, 1, 0, 'https://product33.com/0-1-6', 1, 0, 'test4', 'test4', 'test4', 'test4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'mohsen', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `use_log`
--

CREATE TABLE `use_log` (
  `id` int(11) NOT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `install_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `install_version` varchar(50) DEFAULT NULL,
  `last_run_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_run_version` varchar(50) DEFAULT NULL,
  `runs_number` int(11) DEFAULT NULL,
  `additional_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `use_log`
--

INSERT INTO `use_log` (`id`, `ip`, `resource_id`, `location`, `install_date_time`, `install_version`, `last_run_date_time`, `last_run_version`, `runs_number`, `additional_info`) VALUES
(64, '195.80.150.184', 124, 'Slovenia', '2022-08-21 09:01:57', '0.1.0', '2022-08-21 09:01:57', '0.1.0', 1, 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(65, '191.101.31.36', 124, 'United States', '2022-08-21 09:02:33', '0.1.9', '2022-08-21 09:02:33', '0.1.9', 1, 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(66, '195.80.150.184', 125, 'Slovenia', '2022-08-21 09:03:11', '0.2.3', '2022-08-21 09:03:18', '0.2.3', 3, 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(67, '195.80.150.184', 126, 'Slovenia', '2022-08-21 09:04:13', '0.0.2', '2022-08-21 09:04:13', '0.0.2', 1, 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(68, '191.101.31.36', 126, 'United States', '2022-08-21 09:04:29', '0.0.2', '2022-08-21 10:33:05', '0.0.2', 5, 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(69, '191.101.31.36', 125, 'United States', '2022-08-21 09:04:53', '0.2.3', '2022-08-21 09:12:34', '0.2.3', 3, 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";');

-- --------------------------------------------------------

--
-- Table structure for table `use_log_complate`
--

CREATE TABLE `use_log_complate` (
  `id` int(11) NOT NULL,
  `use_log_id` int(11) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `version` varchar(50) DEFAULT NULL,
  `additional_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `use_log_complate`
--

INSERT INTO `use_log_complate` (`id`, `use_log_id`, `date_time`, `version`, `additional_info`) VALUES
(83, 64, '2022-08-21 09:01:57', '0.1.0', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(84, 65, '2022-08-21 09:02:33', '0.1.9', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(85, 66, '2022-08-21 09:03:11', '0.2.3', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(86, 66, '2022-08-21 09:03:15', '0.2.3', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(87, 66, '2022-08-21 09:03:18', '0.2.3', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(88, 67, '2022-08-21 09:04:13', '0.0.2', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(89, 68, '2022-08-21 09:04:29', '0.0.2', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(90, 69, '2022-08-21 09:04:54', '0.2.3', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(91, 69, '2022-08-21 09:07:43', '0.2.3', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(92, 69, '2022-08-21 09:12:34', '0.2.3', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(93, 68, '2022-08-21 09:18:08', '0.1.0', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(94, 68, '2022-08-21 09:18:40', '0.0.2', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(95, 68, '2022-08-21 09:19:54', '0.0.2', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";'),
(96, 68, '2022-08-21 10:33:05', '0.0.2', 's:42:\"{\"name\":\"name server\",\"oneCync\":\"enabale\"}\";');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_version`
--
ALTER TABLE `resource_version`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_resource_id` (`resource_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `use_log`
--
ALTER TABLE `use_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`,`resource_id`),
  ADD KEY `fk_use_log_resource_id` (`resource_id`);

--
-- Indexes for table `use_log_complate`
--
ALTER TABLE `use_log_complate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_use_log_id` (`use_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `resource_version`
--
ALTER TABLE `resource_version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `use_log`
--
ALTER TABLE `use_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `use_log_complate`
--
ALTER TABLE `use_log_complate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resource_version`
--
ALTER TABLE `resource_version`
  ADD CONSTRAINT `fk_resource_id` FOREIGN KEY (`resource_id`) REFERENCES `resource` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `use_log`
--
ALTER TABLE `use_log`
  ADD CONSTRAINT `fk_use_log_resource_id` FOREIGN KEY (`resource_id`) REFERENCES `resource` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `use_log_complate`
--
ALTER TABLE `use_log_complate`
  ADD CONSTRAINT `fk_use_log_id` FOREIGN KEY (`use_log_id`) REFERENCES `use_log` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
