-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_fp.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_user` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `role` enum('super_admin','admin') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.admin: ~3 rows (approximately)
INSERT INTO `admin` (`id_user`, `username`, `email`, `password`, `nama_admin`, `role`) VALUES
	(0000000001, 'bagas', 'bagasb65nurdiansyah@gmail.com', '*123admin', 'Bagas Nurdiansyah', 'super_admin'),
	(0000000003, 'bagas123', 'bagasb65nurasdad@gmail.com', 'admin123', 'bagas nurdiansyah', 'admin'),
	(0000000004, 'Akmal123', 'akmal@gmail.com', '1234Admin', 'akmal', 'admin'),
	(0000000006, 'bagasnur', 'bagasb65nurdiansyah@yuhu.com', '$2y$10$SMzErXA6rQCiYk2NQBbcKukiW9ckIdm3qc7iB0Zl9vRxWGanrmIUq', 'bagas ganteng', 'admin');

-- Dumping structure for table db_fp.bug_report
CREATE TABLE IF NOT EXISTS `bug_report` (
  `id_report` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('open','in progress','resolved') DEFAULT 'open',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_report`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bug_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.bug_report: ~0 rows (approximately)

-- Dumping structure for table db_fp.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notif` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('sent','pending') DEFAULT 'pending',
  `notif_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_notif`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.notifications: ~0 rows (approximately)

-- Dumping structure for table db_fp.study_activities
CREATE TABLE IF NOT EXISTS `study_activities` (
  `id_activity` int unsigned NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_activity`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.study_activities: ~5 rows (approximately)
INSERT INTO `study_activities` (`id_activity`, `activity_name`) VALUES
	(1, 'Reading'),
	(2, 'Video Watching'),
	(3, 'Writing Summary'),
	(4, 'Assignments'),
	(5, 'Practice Questions');

-- Dumping structure for table db_fp.study_recommendation
CREATE TABLE IF NOT EXISTS `study_recommendation` (
  `id_recommendation` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `best_hour` time DEFAULT NULL,
  `most_productive_day` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_recommendation`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `study_recommendation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.study_recommendation: ~0 rows (approximately)

-- Dumping structure for table db_fp.study_sessions
CREATE TABLE IF NOT EXISTS `study_sessions` (
  `id_session` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `subject_id` int unsigned DEFAULT NULL,
  `activity_id` int unsigned DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration_minutes` int DEFAULT NULL,
  `productivity_level` enum('low','medium','high') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_session`),
  KEY `user_id` (`user_id`),
  KEY `subject_id` (`subject_id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `study_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `study_sessions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id_subject`) ON DELETE SET NULL,
  CONSTRAINT `study_sessions_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `study_activities` (`id_activity`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.study_sessions: ~0 rows (approximately)

-- Dumping structure for table db_fp.study_video
CREATE TABLE IF NOT EXISTS `study_video` (
  `id_video` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_video`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.study_video: ~0 rows (approximately)

-- Dumping structure for table db_fp.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id_subject` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_subject`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.subjects: ~0 rows (approximately)

-- Dumping structure for table db_fp.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` enum('unverified','verified') DEFAULT 'unverified',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user: ~1 rows (approximately)
INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `verified`, `created_at`) VALUES
	(4, 'bagasnur', 'noriyamashin@gmail.com', '$2y$10$7mqUgD5fk5PTCezweyB/eOtU0/k3X1VjPrtUOUAWv2F8JY/jyK1Ei', 'verified', '2025-11-13 14:33:29'),
	(5, 'akmal', 'bagasytnurdiansyah301105@gmail.com', '$2y$10$pdJQNG3n/OTA67SHbFlYCeqIuU79B.32qoIyyJ57rsVfubLucJGq.', 'unverified', '2025-11-14 14:57:15'),
	(6, 'levy', 'miawaugch@gmail.com', '$2y$10$HZaj4pwrKN2SuEMaQmIX7upWQi7FR5r.iz.SmmSpJDXLCKcaxT7Ge', 'unverified', '2025-11-14 15:00:29'),
	(7, 'norinori', 'if24.bagasnurdiansyah@mhs.ubpkarawang.ac.id', '$2y$10$Elx65OHoKJoaVJHxeN0at.TVBStCSIUmC91GEtNcEzRKzW8xADEuK', 'verified', '2025-11-24 14:00:22');

-- Dumping structure for table db_fp.user_achievement
CREATE TABLE IF NOT EXISTS `user_achievement` (
  `id_achievement` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `streak_days` int DEFAULT '0',
  `total_points` int DEFAULT '0',
  PRIMARY KEY (`id_achievement`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_achievement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_achievement: ~0 rows (approximately)

-- Dumping structure for table db_fp.user_notes
CREATE TABLE IF NOT EXISTS `user_notes` (
  `id_note` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `subject_id` int unsigned DEFAULT NULL,
  `activity_date` date NOT NULL,
  `content` text NOT NULL,
  `word_count` int GENERATED ALWAYS AS (((char_length(`content`) - char_length(replace(`content`,_utf8mb4' ',_utf8mb4''))) + 1)) STORED,
  PRIMARY KEY (`id_note`),
  KEY `user_id` (`user_id`),
  KEY `fk_notes_subject` (`subject_id`),
  CONSTRAINT `fk_notes_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id_subject`) ON DELETE SET NULL,
  CONSTRAINT `user_notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_notes: ~0 rows (approximately)
INSERT INTO `user_notes` (`id_note`, `user_id`, `subject_id`, `activity_date`, `content`) VALUES
	(4, 7, NULL, '2025-11-24', '\r\nՀայերեն Shqip ‫العربية Български Català 中文简体 Hrvatski Česky Dansk Nederlands English Eesti Filipino Suomi Français ქართული Deutsch Ελληνικά ‫עברית हिन्दी Magyar Indonesia Italiano Latviski Lietuviškai македонски Melayu Norsk Polski Português Româna Pyccкий Српски Slovenčina Slovenščina Español Svenska ไทย Türkçe Українська Tiếng Việt\r\nLorem Ipsum\r\n"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."\r\n"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante ligula, vehicula ut nisi eu, bibendum ultricies nibh. Ut hendrerit suscipit tellus, sit amet facilisis lorem posuere sed. Suspendisse rutrum ullamcorper facilisis. Suspendisse potenti. Nullam porttitor sem vel purus tristique, sed malesuada libero euismod. Nullam at nunc maximus, iaculis est eu, tempor sem. Maecenas lacinia dolor et odio posuere, vel accumsan purus gravida. Nulla rhoncus, ligula ac iaculis maximus, risus justo dignissim diam, sit amet viverra mauris ante eget arcu. Aliquam non lacus aliquam, sodales urna at, tempus sem.\r\n\r\nPraesent erat nisi, euismod quis facilisis eget, luctus a risus. Nulla auctor non ligula eu tempor. Maecenas egestas elit vel felis vulputate, in elementum justo porta. Sed lobortis purus eu neque aliquam convallis. In quis porta leo. Sed egestas sapien in dui rhoncus, a aliquam ante bibendum. Quisque luctus ut enim et viverra. Cras cursus in purus eget pulvinar.\r\n\r\nNam in volutpat metus, vel venenatis turpis. Nulla fringilla neque quis augue pharetra, a aliquet ante accumsan. Aenean tincidunt arcu quis ligula scelerisque consequat. Pellentesque vel sapien ac risus mollis sagittis sed eu augue. Nam varius, sapien quis elementum consequat, massa ex venenatis erat, in rhoncus velit nisi auctor elit. Proin vel elit quis velit vulputate sagittis scelerisque et mauris. Donec est nisi, pulvinar eu laoreet nec, cursus in enim. Curabitur ut orci id nisl sagittis lacinia ac non velit. Aliquam suscipit, quam ac luctus posuere, leo quam tincidunt libero, eu finibus lacus dolor ac metus. Quisque at felis tincidunt, pretium lectus vitae, ullamcorper sapien. Praesent commodo maximus eleifend. Pellentesque venenatis elit a neque pretium pretium. Nulla ornare, metus in laoreet euismod, nibh velit cursus nulla, sit amet varius eros ex tristique elit. Nulla bibendum placerat leo, at interdum risus laoreet vel. Mauris vel aliquet sapien, a lobortis diam. Cras bibendum massa non risus sollicitudin tempus.\r\n\r\nAenean mauris lorem, varius at tortor vitae, congue cursus nulla. Fusce egestas dapibus metus. Suspendisse efficitur elit eu odio mattis, ac imperdiet quam fringilla. Nam elementum aliquam eros a gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras purus turpis, placerat in sapien eu, volutpat vulputate urna. Donec purus nibh, tempor ut auctor ac, rutrum sit amet dui. Morbi nunc arcu, convallis in interdum sit amet, malesuada in nibh.\r\n\r\nMaecenas risus turpis, blandit eu mauris at, ullamcorper fringilla enim. Nullam varius felis in pulvinar auctor. Nam vitae leo molestie, aliquet odio eu, sollicitudin enim. Aenean purus est, elementum id lorem at, posuere ullamcorper felis. Suspendisse tincidunt, lacus vitae sagittis condimentum, urna urna hendrerit arcu, sit amet laoreet magna lacus sed orci. Cras a suscipit mi, at porttitor lectus. Praesent non diam at metus vehicula tristique. Pellentesque facilisis lorem id lacinia mattis. Etiam eleifend porttitor aliquet. Vestibulum turpis quam, aliquam eu augue eu, sagittis ornare mauris. Sed vel maximus turpis, et sollicitudin ligula.\r\n\r\nGenerated 5 paragraphs, 479 words, 3210 bytes of Lorem Ipsum\r\nhelp@lipsum.com\r\nPrivacy Policy · \r\n\r\nFreestar');

-- Dumping structure for table db_fp.user_profile
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id_profile` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`id_profile`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_profile: ~0 rows (approximately)
INSERT INTO `user_profile` (`id_profile`, `user_id`, `firstname`, `lastname`, `birthday`, `bio`) VALUES
	(1, 4, 'bagas', 'nurd', '2025-11-21', 'admin123'),
	(2, 7, 'damn', 'trial', '2025-11-14', 'dnjhgfdxgchjkfdfgchjk');

-- Dumping structure for table db_fp.user_progress
CREATE TABLE IF NOT EXISTS `user_progress` (
  `id_progress` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `study_date` date NOT NULL,
  `duration_minutes` int NOT NULL,
  `productivity_level` enum('low','medium','high') DEFAULT 'medium',
  PRIMARY KEY (`id_progress`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_progress: ~0 rows (approximately)

-- Dumping structure for table db_fp.user_streak
CREATE TABLE IF NOT EXISTS `user_streak` (
  `id_streak` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `current_streak` int DEFAULT '0',
  `longest_streak` int DEFAULT '0',
  `last_activity` date DEFAULT NULL,
  PRIMARY KEY (`id_streak`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_streak_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_streak: ~2 rows (approximately)
INSERT INTO `user_streak` (`id_streak`, `user_id`, `current_streak`, `longest_streak`, `last_activity`) VALUES
	(1, 7, 1, 1, '2025-11-24'),
	(2, 4, 1, 1, '2025-11-26');

-- Dumping structure for table db_fp.user_subjects
CREATE TABLE IF NOT EXISTS `user_subjects` (
  `id_user_subject` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `subject_id` int unsigned NOT NULL,
  PRIMARY KEY (`id_user_subject`),
  KEY `user_id` (`user_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `user_subjects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `user_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id_subject`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_subjects: ~0 rows (approximately)

-- Dumping structure for table db_fp.user_tokens
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id_token` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `access_token` text NOT NULL,
  `refresh_token` text,
  `token_type` varchar(50) DEFAULT NULL,
  `expires_in` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_token`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_tokens: ~0 rows (approximately)

-- Dumping structure for table db_fp.user_verification
CREATE TABLE IF NOT EXISTS `user_verification` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_UNIQUE` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.user_verification: ~2 rows (approximately)
INSERT INTO `user_verification` (`id`, `email`, `token`, `created_at`) VALUES
	(3, 'bagasytnurdiansyah301105@gmail.com', '62380dacdcc3ae9dc44ff8efc6e32b94', '2025-11-14 07:57:15'),
	(4, 'miawaugch@gmail.com', '774917ed5319f602e22985a238f833ef', '2025-11-14 08:00:29');

-- Dumping structure for table db_fp.youtube_activity
CREATE TABLE IF NOT EXISTS `youtube_activity` (
  `id_activity` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `video_id` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `channel_title` varchar(255) DEFAULT NULL,
  `watched_duration` int DEFAULT NULL,
  `watched_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_activity`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `youtube_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_fp.youtube_activity: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
