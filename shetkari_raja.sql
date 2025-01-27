-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2025 at 12:27 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shetkari_raja`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

DROP TABLE IF EXISTS `farmers`;
CREATE TABLE IF NOT EXISTS `farmers` (
  `fid` int NOT NULL AUTO_INCREMENT,
  `FNAME` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` int NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `CONTACT` decimal(10,0) NOT NULL,
  `FCITY` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PHOTO` varchar(30) NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `user_id` (`EMAIL`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`fid`, `FNAME`, `password`, `EMAIL`, `CONTACT`, `FCITY`, `PHOTO`) VALUES
(1, 'Farmer A', 1234, 'farmerA@example.com', 9876543210, 'City A', 'farmerA.jpg'),
(2, 'Farmer B', 1234, 'farmerB@example.com', 9876543211, 'City B', 'farmerB.avif'),
(3, 'Farmer C', 1234, 'farmerC@example.com', 9876543212, 'City C', 'farmerC.jpg'),
(4, 'Farmer D', 1234, 'farmerD@example.com', 9876543213, 'City D', 'farmerD.avif'),
(5, 'Farmer E', 1234, 'farmerE@example.com', 9876543214, 'City E', 'farmerE.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `aname` varchar(20) NOT NULL,
  `apass` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`aname`, `apass`) VALUES
('pranav', 'pranav123'),
('tushar', 'tushar123'),
('sushant', 'sushant123');

-- --------------------------------------------------------

--
-- Table structure for table `machinery`
--

DROP TABLE IF EXISTS `machinery`;
CREATE TABLE IF NOT EXISTS `machinery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mimage` varchar(100) NOT NULL,
  `description` text,
  `rental_price` decimal(10,2) NOT NULL,
  `availability` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `machinery`
--

INSERT INTO `machinery` (`id`, `name`, `mimage`, `description`, `rental_price`, `availability`, `created_at`, `updated_at`) VALUES
(1, 'Tractor', 'tractor.jpeg', 'powerful tractor', 1000.00, 2, '2025-01-15 10:16:15', '2025-01-15 14:38:40'),
(2, 'Tractor', 'tractor.jpg', 'Heavy-duty tractor for farming', 150.00, 1, '2025-01-21 04:37:31', '2025-01-21 04:37:31'),
(3, 'Plow', 'plow.jpg', 'Farm plow for tilling soil', 50.00, 1, '2025-01-21 04:37:31', '2025-01-21 04:37:31'),
(4, 'Harvester', 'harvester.jpg', 'Crop harvester for efficient harvesting', 200.00, 1, '2025-01-21 04:37:31', '2025-01-21 04:37:31'),
(5, 'Seeder', 'seeder.jpg', 'Seed planting machine', 75.00, 1, '2025-01-21 04:37:31', '2025-01-21 04:37:31'),
(6, 'Sprayer', 'sprayer.jpg', 'Pesticide sprayer for crops', 60.00, 1, '2025-01-21 04:37:31', '2025-01-21 04:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `fid` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `pname` varchar(25) NOT NULL,
  `pquantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pimage` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`fid`, `pid`, `pname`, `pquantity`, `price`, `pimage`) VALUES
(1, 1, 'Product A', 100, 10.00, 'productA.jpg'),
(2, 2, 'Product B', 200, 15.00, 'productB.jpg'),
(3, 3, 'Product C', 150, 20.00, 'productC.jpg'),
(4, 4, 'Product D', 50, 25.00, 'productD.jpg'),
(5, 5, 'Product E', 75, 30.00, 'productE.jpg'),
(6, 6, 'orange', 100, 90.00, 'orange.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
CREATE TABLE IF NOT EXISTS `rentals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `machinery_id` int NOT NULL,
  `farmer_id` int NOT NULL,
  `rental_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `rental_price` decimal(10,2) NOT NULL,
  `duration` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `machinery_id` (`machinery_id`),
  KEY `farmer_id` (`farmer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `machinery_id`, `farmer_id`, `rental_date`, `return_date`, `rental_price`, `duration`, `total_amount`) VALUES
(1, 1, 1, '2025-01-24 16:37:00', '2025-01-25 16:37:00', 1000.00, 8, 8000.00),
(2, 2, 1, '2025-01-24 16:54:00', '2025-01-25 16:54:00', 1234.00, 24, 29616.00),
(3, 2, 1, '2025-01-24 16:54:00', '2025-01-25 16:54:00', 1234.00, 24, 29616.00),
(4, 3, 1, '2025-01-24 18:06:00', '2025-01-31 18:06:00', 1000.00, 168, 168000.00),
(5, 3, 1, '2025-01-24 18:06:00', '2025-01-31 18:06:00', 1000.00, 168, 168000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int NOT NULL,
  `uname` varchar(30) NOT NULL,
  `upass` varchar(20) NOT NULL,
  `uemail` varchar(30) NOT NULL,
  `uphone` decimal(10,0) NOT NULL,
  `uphoto` varchar(30) NOT NULL,
  PRIMARY KEY (`uemail`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `upass`, `uemail`, `uphone`, `uphoto`) VALUES
(1, 'user1', 'password1', 'user1@example.com', 1234567890, 'photo1.jpg'),
(2, 'user2', 'password2', 'user2@example.com', 1234567891, 'photo2.jpg'),
(3, 'admin1', 'password3', 'admin1@example.com', 1234567892, 'photo3.jpg'),
(4, 'admin2', 'password4', 'admin2@example.com', 1234567893, 'photo4.jpg'),
(5, 'user3', 'password5', 'user3@example.com', 1234567894, 'photo5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
CREATE TABLE IF NOT EXISTS `workers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CONTACT` decimal(10,0) NOT NULL,
  `availability` tinyint(1) DEFAULT '1',
  `PHOTO` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `name`, `password`, `email`, `CONTACT`, `availability`, `PHOTO`) VALUES
(1, 'Worker A', 'passwordA', 'workerA@example.com', 9876543215, 1, 'workerA.jpg'),
(2, 'Worker B', 'passwordB', 'workerB@example.com', 9876543216, 1, 'workerB.jpg'),
(3, 'Worker C', 'passwordC', 'workerC@example.com', 9876543217, 1, 'workerC.jpg'),
(4, 'Worker D', 'passwordD', 'workerD@example.com', 9876543218, 1, 'workerD.jpg'),
(5, 'Worker E', 'passwordE', 'workerE@example.com', 9876543219, 1, 'workerE.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `worker_rentals`
--

DROP TABLE IF EXISTS `worker_rentals`;
CREATE TABLE IF NOT EXISTS `worker_rentals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `farmer_id` int NOT NULL,
  `worker_id` int NOT NULL,
  `rental_duration` int NOT NULL,
  `rental_date` datetime NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`farmer_id`),
  KEY `worker_id` (`worker_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `worker_rentals`
--

INSERT INTO `worker_rentals` (`id`, `farmer_id`, `worker_id`, `rental_duration`, `rental_date`, `notes`) VALUES
(4, 1, 2, 7, '2025-01-24 10:43:26', 'cleaning farm '),
(3, 1, 1, 8, '2025-01-24 10:38:27', 'renting for seeding ');

-- --------------------------------------------------------

--
-- Table structure for table `work_requests`
--

DROP TABLE IF EXISTS `work_requests`;
CREATE TABLE IF NOT EXISTS `work_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `farmer_id` int NOT NULL,
  `plot_size` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `completion_date` datetime NOT NULL,
  `remuneration_per_hour` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_id` (`farmer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
