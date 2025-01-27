-- SQL statement to create the work_requests table
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
