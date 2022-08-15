-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.29-0ubuntu0.20.04.3 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for questions_answers
CREATE DATABASE IF NOT EXISTS `questions_answers` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `questions_answers`;

-- Dumping structure for table questions_answers.answer_options
CREATE TABLE IF NOT EXISTS `answer_options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `answer_option` varchar(255) NOT NULL,
  `answer_status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table questions_answers.answer_options: ~29 rows (approximately)
/*!40000 ALTER TABLE `answer_options` DISABLE KEYS */;
INSERT INTO `answer_options` (`id`, `question_id`, `answer_option`, `answer_status`) VALUES
	(1, 1, '12', 1),
	(2, 1, '18', 0),
	(3, 1, '9', 0),
	(4, 2, '16', 1),
	(5, 2, '12', 0),
	(6, 2, '8', 0),
	(7, 2, '24', 0),
	(8, 3, '16', 1),
	(9, 3, '30', 0),
	(10, 3, '12', 0),
	(11, 4, 'Stuttgart', 0),
	(12, 4, 'Bremen', 0),
	(13, 4, 'Berlin', 1),
	(14, 4, 'Munich', 0),
	(15, 5, 'Linz', 0),
	(16, 5, 'Vienna', 1),
	(17, 5, 'Graz', 0),
	(18, 5, 'Salzburg', 0),
	(19, 5, 'Innsbruck', 0),
	(20, 6, 'Lake Superior', 0),
	(21, 6, 'Lake Victoria', 0),
	(22, 6, 'Lake Huron', 0),
	(23, 6, 'Caspian Sea', 1),
	(24, 6, 'Lake Michigan', 0),
	(25, 7, 'Philippine Sea', 1),
	(26, 7, 'Coral Sea', 0),
	(27, 7, 'Arabian Sea', 0),
	(28, 7, 'Sargasso Sea', 0),
	(29, 7, 'Weddell Sea', 0),
	(30, 7, 'Caribbean Sea', 0);
/*!40000 ALTER TABLE `answer_options` ENABLE KEYS */;

-- Dumping structure for table questions_answers.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_question_amount` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table questions_answers.category: ~2 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `category_name`, `category_question_amount`) VALUES
	(1, 'Math', 3),
	(2, 'Geography', 4);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table questions_answers.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_number` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table questions_answers.questions: ~6 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `category_id`, `question`, `question_number`) VALUES
	(1, 1, 'What is result for 3+3*3', 1),
	(2, 1, 'What is result for (4+4)*2', 2),
	(3, 1, 'What is result for 2+2*4+6', 3),
	(4, 2, 'Which is Germany capital city', 1),
	(5, 2, 'Which is Austria capital city', 2),
	(6, 2, 'Which is greatest lake in the world', 3),
	(7, 2, 'Which is biggest sea in the world', 4);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Dumping structure for table questions_answers.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table questions_answers.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table questions_answers.user_answers
CREATE TABLE IF NOT EXISTS `user_answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `question_id` int NOT NULL,
  `answer_id` int NOT NULL,
  `answered_status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table questions_answers.user_answers: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_answers` ENABLE KEYS */;

-- Dumping structure for table questions_answers.user_final_results
CREATE TABLE IF NOT EXISTS `user_final_results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `correct_answer_amount` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table questions_answers.user_final_results: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_final_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_final_results` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
