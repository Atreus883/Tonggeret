-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2024 at 01:24 PM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tonggeret`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tmdb_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `poster_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tmdb_id` (`tmdb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `tmdb_id`, `title`, `release_date`, `poster_url`) VALUES
(8, 912649, 'Venom: The Last Dance', '2024-10-22', '/aosm8NMQ3UyoBVpSxyimorCQykC.jpg'),
(9, 558449, 'Gladiator II', '2024-11-13', '/2cxhvwyEwRlysAmRH4iodkvo0z5.jpg'),
(10, 670, 'Oldboy', '2003-11-21', '/pWDtjs568ZfOTMbURQBYuT4Qxka.jpg'),
(11, 289, 'Casablanca', '1943-01-15', '/5K7cOHoay2mZusSLezBOY0Qxh8a.jpg'),
(12, 11837, 'Watership Down', '1978-10-14', '/q9ZcNxfquJbMTd6UfhAlJbmLBts.jpg'),
(13, 1118031, 'Apocalypse Z: The Beginning of the End', '2024-10-04', '/wIGJnIFQlESkC2rLpfA8EDHqk4g.jpg'),
(14, 26202, 'The Stone Killer', '1973-08-08', '/4q5gLjMEfV0JV10KK59Lfp2kuX.jpg'),
(15, 1184918, 'The Wild Robot', '2024-09-12', '/wTnV3PCVW5O92JMrFvvrRcV39RU.jpg'),
(16, 843, 'In the Mood for Love', '2000-09-29', '/iYypPT4bhqXfq1b6EnmxvRt6b2Y.jpg'),
(17, 933260, 'The Substance', '2024-09-07', '/lqoMzCcZYEFK729d6qzt349fB4o.jpg'),
(18, 580489, 'Venom: Let There Be Carnage', '2021-09-30', '/1MJNcPZy46hIy2CmSqOeru0yr5C.jpg'),
(19, 1142518, 'Freedom', '2024-11-01', '/b2YL2kncIqlcDcqly78AsOPJi6r.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movie_reviews`
--

DROP TABLE IF EXISTS `movie_reviews`;
CREATE TABLE IF NOT EXISTS `movie_reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `tmdb_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `review_text` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `tmdb_id` (`tmdb_id`),
  KEY `tmdb_id_2` (`tmdb_id`)
) ;

--
-- Dumping data for table `movie_reviews`
--

INSERT INTO `movie_reviews` (`id`, `user_id`, `tmdb_id`, `rating`, `review_text`, `created_at`) VALUES
(19, 9, 1118031, 5, 'asdadadsads', '2024-11-16 13:32:36'),
(20, 9, 1184918, 10, 'Nice', '2024-11-16 14:30:59'),
(21, 10, 1184918, 7, 'Gelopisan', '2024-11-16 14:31:44'),
(22, 10, 843, 10, '10', '2024-11-16 14:55:39'),
(23, 10, 933260, 10, 'Gokil', '2024-11-16 15:13:21'),
(24, 10, 580489, 9, 'Nanon ieu, butut pisan', '2024-11-17 12:35:17'),
(25, 10, 1142518, 1, 'wkwkkwkw', '2024-11-17 13:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `tvs`
--

DROP TABLE IF EXISTS `tvs`;
CREATE TABLE IF NOT EXISTS `tvs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tmdb_id` int NOT NULL,
  `original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_air_date` date NOT NULL,
  `poster_url` varchar(2083) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tmdb_id` (`tmdb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tvs`
--

INSERT INTO `tvs` (`id`, `tmdb_id`, `original_name`, `first_air_date`, `poster_url`, `created_at`) VALUES
(3, 218145, 'Mama na prenájom', '2023-01-09', '/fH7PP2Rkdlo414IHvZABBHhtoqd.jpg', '2024-11-16 12:19:49'),
(4, 1396, 'Breaking Bad', '2008-01-20', '/ztkUQFLlC19CCMYHW9o1zWhJRNq.jpg', '2024-11-16 14:14:01'),
(5, 257064, 'Volta por Cima', '2024-09-30', '/nyN8R0P1Hqwq7ksJz4O2BIAUd4W.jpg', '2024-11-17 19:15:08'),
(6, 153312, 'Tulsa King', '2022-11-13', '/zMFAdj30K84Sz90bCd6ePwiAO37.jpg', '2024-11-17 19:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `tv_reviews`
--

DROP TABLE IF EXISTS `tv_reviews`;
CREATE TABLE IF NOT EXISTS `tv_reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `tmdb_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `review_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_tv_reviews_user_id` (`user_id`),
  KEY `fk_tv_reviews_tmdb_id` (`tmdb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tv_reviews`
--

INSERT INTO `tv_reviews` (`id`, `user_id`, `tmdb_id`, `rating`, `review_text`, `created_at`) VALUES
(1, 9, 257064, 8, 'Kerennn', '2024-11-17 12:15:08'),
(2, 10, 257064, 7, 'India momen\r\n', '2024-11-17 12:24:15'),
(3, 10, 153312, 8, 'Wowww', '2024-11-17 12:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(3, 'Bagas', 'Diatama@gmail.com', '$2y$10$UI2HCj09ESOuF9/Gyzbis.9pnO9wZgOw2OlyFoRfC709aFv7P2kb.', '2024-10-06 00:08:20'),
(5, 'Diatama', 'Diatamaw8@gmail.com', '$2y$10$n9bMRFQsey4fijNCT8Zs4ez26GhWl9MroaQ9hEqMwLpyQml8jVQNq', '2024-10-06 00:16:53'),
(8, 'PlasticTr3es', 'diatama.w8@gmail.com', '$2y$10$bwQ9ernoTDa7jXlzoLIEC.EE53rU.VXn0c96BwP9hAQMeT9efFYoO', '2024-10-07 02:58:11'),
(9, 'Test', 'Test@mail.com', '$2y$10$BUhh7PaMWTFSjOJT6HRP1.jZRUW/JBMIV8ePd3AAAAaTmlQJ/EW0.', '2024-11-14 23:47:16'),
(10, 'Test2', 'Test2@mail.com', '$2y$10$YYbIJArq/tMimBTAzzQwtOsqsEsj.9.y1KHmj3Gy7vt3rv4esh7fW', '2024-11-16 06:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_movie_list`
--

DROP TABLE IF EXISTS `user_movie_list`;
CREATE TABLE IF NOT EXISTS `user_movie_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `movie_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_movie_id` (`movie_id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_movie_list`
--

INSERT INTO `user_movie_list` (`id`, `user_id`, `movie_id`, `created_at`) VALUES
(6, 9, 8, '2024-11-16 12:06:45'),
(7, 9, 9, '2024-11-16 12:36:40'),
(8, 9, 10, '2024-11-16 14:12:34'),
(9, 9, 11, '2024-11-16 19:50:41'),
(10, 9, 12, '2024-11-16 20:03:25'),
(11, 10, 16, '2024-11-16 21:55:29'),
(12, 10, 17, '2024-11-17 20:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_tv_list`
--

DROP TABLE IF EXISTS `user_tv_list`;
CREATE TABLE IF NOT EXISTS `user_tv_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `tv_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_tv_list_user_id` (`user_id`),
  KEY `fk_tv_list_tv_id` (`tv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tv_list`
--

INSERT INTO `user_tv_list` (`id`, `user_id`, `tv_id`, `created_at`) VALUES
(1, 9, 3, '2024-11-16 12:19:49'),
(2, 9, 4, '2024-11-16 14:14:01'),
(3, 10, 5, '2024-11-17 19:24:35');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_reviews`
--
ALTER TABLE `movie_reviews`
  ADD CONSTRAINT `movie_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `movie_reviews_ibfk_2` FOREIGN KEY (`tmdb_id`) REFERENCES `movies` (`tmdb_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tv_reviews`
--
ALTER TABLE `tv_reviews`
  ADD CONSTRAINT `fk_tv_reviews_tmdb_id` FOREIGN KEY (`tmdb_id`) REFERENCES `tvs` (`tmdb_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_tv_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_movie_list`
--
ALTER TABLE `user_movie_list`
  ADD CONSTRAINT `fk_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_tv_list`
--
ALTER TABLE `user_tv_list`
  ADD CONSTRAINT `fk_tv_list_tv_id` FOREIGN KEY (`tv_id`) REFERENCES `tvs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_tv_list_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
