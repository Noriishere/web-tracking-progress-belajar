-- ========================
-- TABEL: user (data akun utama)
-- ========================
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `verified` ENUM('unverified', 'verified') DEFAULT 'unverified',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ========================
-- TABEL: user_profile (informasi tambahan user)
-- ========================
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id_profile` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `firstname` VARCHAR(50),
  `lastname` VARCHAR(50),
  `birthday` DATE,
  `bio` TEXT,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: user_progress (catatan durasi belajar)
-- ========================
CREATE TABLE IF NOT EXISTS `user_progress` (
  `id_progress` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `study_date` DATE NOT NULL,
  `duration_minutes` INT NOT NULL,
  `productivity_level` ENUM('low','medium','high') DEFAULT 'medium',
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: user_notes (catatan belajar harian)
-- ========================
CREATE TABLE IF NOT EXISTS `user_notes` (
  `id_note` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `activity_date` DATE NOT NULL,
  `content` TEXT NOT NULL,
  `word_count` INT GENERATED ALWAYS AS (
    CHAR_LENGTH(`content`) - CHAR_LENGTH(REPLACE(`content`, ' ', '')) + 1
  ) STORED,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: user_achievement (streak dan poin)
-- ========================
CREATE TABLE IF NOT EXISTS `user_achievement` (
  `id_achievement` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `streak_days` INT DEFAULT 0,
  `total_points` INT DEFAULT 0,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: notifications (pengingat otomatis)
-- ========================
CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notif` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `message` VARCHAR(255) NOT NULL,
  `status` ENUM('sent','pending') DEFAULT 'pending',
  `notif_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: study_recommendation (hasil analisis otomatis)
-- ========================
CREATE TABLE IF NOT EXISTS `study_recommendation` (
  `id_recommendation` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `best_hour` TIME,
  `most_productive_day` ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'),
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: study_video (referensi video belajar)
-- ========================
CREATE TABLE IF NOT EXISTS `study_video` (
  `id_video` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `category` VARCHAR(50),
  `description` TEXT
) ENGINE=InnoDB;

-- ========================
-- TABEL: youtube_activity (integrasi API YouTube)
-- ========================
CREATE TABLE IF NOT EXISTS `youtube_activity` (
  `id_activity` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `video_id` VARCHAR(50),
  `title` VARCHAR(255),
  `channel_title` VARCHAR(255),
  `watched_duration` INT,
  `watched_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: calendar_events (integrasi API Google Calendar)
-- ========================
CREATE TABLE IF NOT EXISTS `calendar_events` (
  `id_event` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `event_id` VARCHAR(255) NOT NULL,
  `summary` VARCHAR(255),
  `description` TEXT,
  `start_time` DATETIME,
  `end_time` DATETIME,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: user_tokens (token OAuth untuk API Google)
-- ========================
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id_token` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `access_token` TEXT NOT NULL,
  `refresh_token` TEXT,
  `token_type` VARCHAR(50),
  `expires_in` INT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================
-- TABEL: bug_report (laporan masalah sistem)
-- ========================
CREATE TABLE IF NOT EXISTS `bug_report` (
  `id_report` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `status` ENUM('open','in progress','resolved') DEFAULT 'open',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB;
