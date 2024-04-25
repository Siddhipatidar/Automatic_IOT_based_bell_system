-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 06:13 AM
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
-- Database: `bell_system`
--

DELIMITER $$
--
-- Procedures
-- --
CREATE DEFINER=`root`@`localhost` PROCEDURE `bellOFF` ()   BEGIN
UPDATE bell_system.ring SET ring.status = 0 WHERE ring.device='D4' AND EXISTS(SELECT time_intervals.end_time FROM bell_system.time_intervals WHERE exam_date = CURRENT_DATE AND time_intervals.end_time=CURRENT_TIME);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bellON` ()  NO SQL BEGIN
UPDATE bell_system.ring SET ring.status = 1 WHERE ring.device='D4' AND EXISTS(SELECT time_intervals.bell_time FROM bell_system.time_intervals WHERE exam_date = CURRENT_DATE AND time_intervals.bell_time=CURRENT_TIME);
END$$

--
-- Triggers
--
-- Create an event to continuously update status based on start time
DELIMITER //
CREATE EVENT update_status_start_event
ON SCHEDULE EVERY 1 SECOND
DO
BEGIN
    SET @current_time = NOW();
    SET @interval_start = (SELECT bell_time FROM time_intervals WHERE bell_time = @current_time OR exam_date = DATE(@current_time) LIMIT 1);
    
    UPDATE ring SET status = IF(@interval_start IS NOT NULL, 1, status);
END //
DELIMITER ;

-- Create an event to continuously update status based on end time
DELIMITER //
CREATE EVENT update_status_end_event
ON SCHEDULE EVERY 1 SECOND
DO
BEGIN
    SET @current_time = NOW();
    SET @interval_end = (SELECT end_time FROM time_intervals WHERE end_time = @current_time OR exam_date = DATE(@current_time) LIMIT 1);
    
    UPDATE ring SET status = IF(@interval_end IS NOT NULL, 0, status);
END //
DELIMITER ;

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `bell1` () RETURNS INT(10) UNSIGNED  BEGIN
DECLARE x INT;
SET x = (SELECT time_intervals.duration FROM bell_system.time_intervals WHERE exam_date = CURRENT_DATE);
UPDATE bell_system.ring SET ring.status = 1 WHERE ring.device='D4';
RETURN x;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ring`
--

CREATE TABLE `ring` (
  `id` int(11) NOT NULL,
  `device` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ring`
--

INSERT INTO `ring` (`id`, `device`, `status`) VALUES
(1, 'D4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `time_intervals`
--

CREATE TABLE `time_intervals` (
  `id` int(11) NOT NULL,
  `exam_date` varchar(100) CHARACTER SET latin1 NOT NULL,
  `bell_time` varchar(100) CHARACTER SET latin1 NOT NULL,
  `duration` int(100) NOT NULL COMMENT 'In Seconds',
  `end_time` varchar(200) CHARACTER SET latin1 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time_intervals`
--

INSERT INTO `time_intervals` (`id`, `exam_date`, `bell_time`, `duration`, `end_time`, `timestamp`) VALUES
(5, '2023-03-26', '10:00:00', 5, '10:00:05', '2023-03-26 08:21:52'),
(6, '2023-03-28', '23:04:00', 5, '23:04:05', '2023-03-28 14:09:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ring`
--
ALTER TABLE `ring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_intervals`
--
ALTER TABLE `time_intervals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ring`
--
ALTER TABLE `ring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_intervals`
--
ALTER TABLE `time_intervals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `Ringing Bell1` ON SCHEDULE EVERY 1 SECOND STARTS '2023-03-11 14:13:30' ENDS '2025-08-30 14:13:30' ON COMPLETION NOT PRESERVE ENABLE DO CALL bellON$$

CREATE DEFINER=`root`@`localhost` EVENT `Ringing bell2` ON SCHEDULE EVERY 1 SECOND STARTS '2023-03-11 15:15:15' ENDS '2024-02-29 15:15:15' ON COMPLETION NOT PRESERVE ENABLE DO CALL bellOFF$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
