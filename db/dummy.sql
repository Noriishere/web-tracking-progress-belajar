-- -----------------------
-- INSERT: user
-- -----------------------
INSERT INTO `user` (`username`, `email`, `password`, `verified`, `created_at`) VALUES
('damar', 'damar@example.com', SHA2('Damar2025!',256), 'verified', '2025-09-05 09:00:00'),
('andika', 'andika@example.com', SHA2('Andika2025!',256), 'verified', '2025-09-07 11:20:00'),
('nabila', 'nabila@example.com', SHA2('Nabila2025!',256), 'verified', '2025-09-10 08:45:00'),
('rudi', 'rudi@example.com', SHA2('Rudi2025!',256), 'unverified', '2025-09-12 10:15:00'),
('siti', 'siti@example.com', SHA2('Siti2025!',256), 'verified', '2025-09-14 13:30:00'),
('bayu', 'bayu@example.com', SHA2('Bayu2025!',256), 'verified', '2025-09-18 09:00:00'),
('melisa', 'melisa@example.com', SHA2('Melisa2025!',256), 'verified', '2025-09-20 14:25:00'),
('dwi', 'dwi@example.com', SHA2('Dwi2025!',256), 'verified', '2025-09-22 07:50:00'),
('farhan', 'farhan@example.com', SHA2('Farhan2025!',256), 'verified', '2025-09-25 10:00:00'),
('nurul', 'nurul@example.com', SHA2('Nurul2025!',256), 'verified', '2025-09-27 09:30:00'),
('rizki', 'rizki@example.com', SHA2('Rizki2025!',256), 'verified', '2025-10-01 15:40:00'),
('maya', 'maya@example.com', SHA2('Maya2025!',256), 'verified', '2025-10-04 16:15:00'),
('agus', 'agus@example.com', SHA2('Agus2025!',256), 'unverified', '2025-10-07 10:10:00'),
('tania', 'tania@example.com', SHA2('Tania2025!',256), 'verified', '2025-10-10 09:05:00'),
('fikri', 'fikri@example.com', SHA2('Fikri2025!',256), 'verified', '2025-10-12 08:55:00');

-- -----------------------
-- INSERT: user_profile
-- -----------------------
INSERT INTO `user_profile` (`user_id`, `firstname`, `lastname`, `birthday`, `bio`) VALUES
(1, 'Damar', 'Nugraha', '2002-05-14', 'Fokus meningkatkan kebiasaan belajar setiap hari.'),
(2, 'Andika', 'Pratama', '2001-09-20', 'Suka coding dan eksplor framework PHP.'),
(3, 'Nabila', 'Salsabila', '2003-01-02', 'Rajin menulis catatan belajar harian.'),
(4, 'Rudi', 'Santoso', '2000-11-10', 'Ingin membangun disiplin belajar.'),
(5, 'Siti', 'Nurhaliza', '2002-03-17', 'Aktif belajar online setiap pagi.'),
(6, 'Bayu', 'Saputra', '2001-12-05', 'Fokus belajar database dan backend.'),
(7, 'Melisa', 'Ayu', '2003-06-28', 'Suka menonton video motivasi belajar.'),
(8, 'Dwi', 'Rahman', '2002-07-10', 'Senang belajar lewat proyek nyata.'),
(9, 'Farhan', 'Putra', '2001-05-25', 'Belajar sambil membuat mini project.'),
(10, 'Nurul', 'Aini', '2002-09-08', 'Menulis ringkasan materi setiap malam.'),
(11, 'Rizki', 'Hidayat', '2000-04-22', 'Suka belajar data science dan SQL.'),
(12, 'Maya', 'Sari', '2002-10-10', 'Senang belajar lewat video edukatif.'),
(13, 'Agus', 'Setiawan', '2001-08-30', 'Belajar sambil bantu teman memahami materi.'),
(14, 'Tania', 'Fitriani', '2003-02-25', 'Suka membuat jadwal belajar mingguan.'),
(15, 'Fikri', 'Ramadhan', '2001-11-12', 'Fokus di efisiensi waktu belajar.');

-- -----------------------
-- INSERT: user_progress (sample recent + some Sept entries)
-- -----------------------
INSERT INTO `user_progress` (`user_id`, `study_date`, `duration_minutes`, `productivity_level`) VALUES
(1, '2025-11-10', 120, 'high'),
(2, '2025-11-09', 90, 'medium'),
(3, '2025-11-11', 150, 'high'),
(4, '2025-11-10', 60, 'medium'),
(5, '2025-11-11', 45, 'low'),
(6, '2025-11-08', 80, 'medium'),
(7, '2025-11-09', 100, 'high'),
(8, '2025-11-10', 95, 'medium'),
(9, '2025-11-08', 70, 'low'),
(10, '2025-11-09', 110, 'high'),
(11, '2025-11-11', 85, 'medium'),
(12, '2025-11-10', 130, 'high'),
(13, '2025-11-09', 55, 'low'),
(14, '2025-11-08', 140, 'high'),
(15, '2025-11-11', 100, 'medium'),
-- additional sept sample
(1, '2025-09-06', 60, 'medium'),
(2, '2025-09-08', 45, 'low'),
(3, '2025-09-10', 90, 'high'),
(4, '2025-09-12', 30, 'low'),
(5, '2025-09-14', 50, 'medium');

-- -----------------------
-- INSERT: user_notes
-- -----------------------
INSERT INTO `user_notes` (`user_id`, `activity_date`, `content`) VALUES
(1, '2025-11-10', 'Mempelajari konsep relasi antar tabel di MySQL.'),
(2, '2025-11-09', 'Mencoba membuat CRUD sederhana menggunakan PHP.'),
(3, '2025-11-11', 'Menulis catatan tentang normalisasi database.'),
(4, '2025-11-10', 'Latihan membuat ERD untuk proyek final.'),
(5, '2025-11-11', 'Menyusun ringkasan materi algoritma dasar.'),
(6, '2025-11-08', 'Menonton video tutorial tentang PHPMyAdmin.'),
(7, '2025-11-09', 'Membuat catatan perbandingan framework web.'),
(8, '2025-11-10', 'Menulis hasil eksperimen API integrasi.'),
(9, '2025-11-08', 'Mempelajari cara pakai foreign key dengan benar.'),
(10, '2025-11-09', 'Mencatat poin penting dari kelas online SQL.'),
(11, '2025-11-11', 'Belajar tentang trigger dan prosedur di MySQL.'),
(12, '2025-11-10', 'Menonton video machine learning dasar.'),
(13, '2025-11-09', 'Membaca dokumentasi Google Calendar API.'),
(14, '2025-11-08', 'Menulis laporan harian untuk progress project.'),
(15, '2025-11-11', 'Menganalisis data belajar menggunakan query join.'),
-- sept notes
(1, '2025-09-06', 'Mulai membuat catatan harian untuk habit tracking.'),
(2, '2025-09-08', 'Setup environment PHP dan MySQL.'),
(3, '2025-09-10', 'Mencatat materi normalisasi database.');

-- -----------------------
-- INSERT: study_video (YouTube asli)
-- -----------------------
INSERT INTO `study_video` (`title`, `url`, `category`, `description`) VALUES
('Belajar MySQL Dasar', 'https://www.youtube.com/watch?v=9ylj9NR0Lcg', 'Database', 'Pengenalan dasar MySQL untuk pemula.'),
('PHP untuk Pemula', 'https://www.youtube.com/watch?v=OK_JCtrrv-c', 'Web Development', 'Video pengantar belajar PHP dasar.'),
('Belajar JavaScript Modern', 'https://www.youtube.com/watch?v=upDLs1sn7g4', 'Web Development', 'Tutorial lengkap JavaScript untuk web.'),
('Tips Konsisten Belajar', 'https://www.youtube.com/watch?v=pH_J1eQROjU', 'Motivasi', 'Motivasi untuk menjaga rutinitas belajar.'),
('Mengenal API dengan PHP', 'https://www.youtube.com/watch?v=YWjLE0dq0mA', 'Backend', 'Panduan membuat API sederhana.'),
('Belajar HTML & CSS', 'https://www.youtube.com/watch?v=UB1O30fR-EE', 'Frontend', 'Tutorial dasar HTML dan CSS.'),
('Dasar SQL Query', 'https://www.youtube.com/watch?v=HXV3zeQKqGY', 'Database', 'Mengenal query SELECT, JOIN, dan lainnya.'),
('Google Calendar API Tutorial', 'https://www.youtube.com/watch?v=V-1Ws9jrqxA', 'Integration', 'Cara menggunakan Google Calendar API.'),
('Belajar Git & GitHub', 'https://www.youtube.com/watch?v=RGOj5yH7evk', 'Version Control', 'Tutorial Git dan GitHub untuk pemula.'),
('Manajemen Waktu Belajar', 'https://www.youtube.com/watch?v=ZXsQAXx_ao0', 'Motivasi', 'Strategi efektif mengatur waktu belajar.');

-- -----------------------
-- INSERT: user_achievement
-- -----------------------
INSERT INTO `user_achievement` (`user_id`, `streak_days`, `total_points`) VALUES
(1, 12, 450),
(2, 7, 300),
(3, 9, 370),
(4, 4, 150),
(5, 3, 120),
(6, 6, 260),
(7, 10, 410),
(8, 8, 320),
(9, 2, 80),
(10, 11, 430),
(11, 5, 200),
(12, 9, 360),
(13, 1, 60),
(14, 7, 280),
(15, 10, 400);

-- -----------------------
-- INSERT: notifications
-- -----------------------
INSERT INTO `notifications` (`user_id`, `message`, `status`, `notif_date`) VALUES
(1, 'Jangan lupa catat progres belajar hari ini!', 'sent', '2025-11-10 08:00:00'),
(1, 'Reminder: Sesi MySQL malam ini jam 19:00', 'pending', '2025-11-12 18:00:00'),
(2, 'Kamu punya event review besok pagi.', 'sent', '2025-11-12 07:30:00'),
(3, 'Selamat! Streak 7 hari tercapai.', 'sent', '2025-11-11 22:10:00'),
(4, 'Cek ringkasan hari ini di dashboard.', 'pending', '2025-11-10 12:00:00'),
(5, 'Ingat: Jadwal belajar pagi besok 06:30', 'sent', '2025-11-11 21:00:00'),
(6, 'Ada rekomendasi video baru untukmu.', 'pending', '2025-11-09 15:30:00'),
(7, 'Tantangan minggu ini: 5 sesi fokus.', 'sent', '2025-11-09 09:00:00'),
(8, 'Kamu belum menautkan Google Calendar.', 'pending', '2025-11-08 10:00:00'),
(9, 'Rekomendasi materi SQL terbaru sudah tersedia.', 'sent', '2025-11-08 14:00:00'),
(10, 'Selamat! Total 10 sesi tercapai bulan ini.', 'sent', '2025-11-09 20:00:00'),
(11, 'Coba fitur analisis waktu terbaik hari ini.', 'pending', '2025-11-11 16:45:00'),
(12, 'Video rekomendasi: Belajar Machine Learning Dasar', 'sent', '2025-11-10 18:30:00'),
(13, 'Perbarui token Google untuk integrasi Calendar.', 'pending', '2025-11-09 08:15:00'),
(14, 'Reminder: submit laporan proyek.', 'sent', '2025-11-08 11:00:00'),
(15, 'Kamu memperoleh 50 poin tambahan!', 'sent', '2025-11-11 19:40:00');

-- -----------------------
-- INSERT: calendar_events
-- -----------------------
INSERT INTO `calendar_events` (`user_id`, `event_id`, `summary`, `description`, `start_time`, `end_time`) VALUES
(1, 'evt-dm-001', 'Sesi Belajar MySQL', 'Latihan relasi dan JOIN query', '2025-11-12 19:00:00', '2025-11-12 20:30:00'),
(2, 'evt-an-002', 'Review PHP', 'Mereview materi dasar PHP sebelum kuis', '2025-11-13 08:00:00', '2025-11-13 09:15:00'),
(3, 'evt-na-003', 'Catatan dan Normalisasi', 'Menulis ringkasan normalisasi sampai 3NF', '2025-11-14 18:30:00', '2025-11-14 20:00:00'),
(4, 'evt-ru-004', 'Membuat ERD', 'Sesi pembuatan ERD proyek final', '2025-11-12 14:00:00', '2025-11-12 16:00:00'),
(5, 'evt-si-005', 'Algoritma Dasar', 'Latihan soal algoritma', '2025-11-15 07:00:00', '2025-11-15 08:30:00'),
(6, 'evt-ba-006', 'Database Performance', 'Belajar indexing dan optimisasi', '2025-11-13 16:00:00', '2025-11-13 17:30:00'),
(7, 'evt-me-007', 'Tonton: Tips Konsisten', 'Menonton video motivasi dan catat', '2025-11-09 20:00:00', '2025-11-09 21:00:00'),
(8, 'evt-dw-008', 'API Integration Lab', 'Praktik integrasi API sederhana', '2025-11-10 09:00:00', '2025-11-10 11:00:00'),
(9, 'evt-fa-009', 'Mini Project: CRUD', 'Mengerjakan CRUD untuk modul pengguna', '2025-11-11 13:00:00', '2025-11-11 15:00:00'),
(10, 'evt-nu-010', 'Sesi SQL Lanjutan', 'Belajar subquery dan view', '2025-11-12 10:00:00', '2025-11-12 12:00:00'),
(11, 'evt-ri-011', 'Data Science Intro', 'Tonton video pengantar data science', '2025-11-14 19:00:00', '2025-11-14 20:30:00'),
(12, 'evt-maya-012', 'ML Basics', 'Latihan konsep supervised learning', '2025-11-13 21:00:00', '2025-11-13 22:30:00'),
(13, 'evt-ag-013', 'Sync Calendar', 'Sinkronisasi kalender dengan sistem', '2025-11-08 08:00:00', '2025-11-08 08:15:00'),
(14, 'evt-ta-014', 'Sprint Plan Mingguan', 'Membuat rencana belajar mingguan', '2025-11-10 17:00:00', '2025-11-10 18:00:00'),
(15, 'evt-fi-015', 'Analisis Progress', 'Review grafik progress belajar', '2025-11-11 09:00:00', '2025-11-11 10:30:00');

-- -----------------------
-- INSERT: youtube_activity
-- -----------------------
INSERT INTO `youtube_activity` (`user_id`, `video_id`, `title`, `channel_title`, `watched_duration`, `watched_at`) VALUES
(1, '9ylj9NR0Lcg', 'Belajar MySQL Dasar', 'freeCodeCamp.org', 900, '2025-11-10 19:30:00'),
(2, 'OK_JCtrrv-c', 'PHP untuk Pemula', 'Programming with Mosh', 1200, '2025-11-09 10:00:00'),
(3, 'upDLs1sn7g4', 'Belajar JavaScript Modern', 'Traversy Media', 1500, '2025-11-11 21:00:00'),
(4, 'pH_J1eQROjU', 'Tips Konsisten Belajar', 'MotivasiID', 600, '2025-11-10 07:30:00'),
(5, 'YWjLE0dq0mA', 'Mengenal API dengan PHP', 'Code with Luke', 800, '2025-11-11 09:15:00'),
(6, 'UB1O30fR-EE', 'Belajar HTML & CSS', 'The Net Ninja', 700, '2025-11-08 18:00:00'),
(7, 'HXV3zeQKqGY', 'Dasar SQL Query', 'Corey Schafer', 1100, '2025-11-09 20:30:00'),
(8, 'V-1Ws9jrqxA', 'Google Calendar API Tutorial', 'Google Developers', 900, '2025-11-10 10:45:00'),
(9, 'RGOj5yH7evk', 'Belajar Git & GitHub', 'Traversy Media', 950, '2025-11-08 13:45:00'),
(10, 'ZXsQAXx_ao0', 'Manajemen Waktu Belajar', 'TEDx Talks', 500, '2025-11-09 06:30:00'),
(11, '9ylj9NR0Lcg', 'Belajar MySQL Dasar', 'freeCodeCamp.org', 600, '2025-11-11 17:20:00'),
(12, 'HXV3zeQKqGY', 'Dasar SQL Query', 'Corey Schafer', 1400, '2025-11-10 19:50:00'),
(13, 'V-1Ws9jrqxA', 'Google Calendar API Tutorial', 'Google Developers', 420, '2025-11-09 08:45:00'),
(14, 'OK_JCtrrv-c', 'PHP untuk Pemula', 'Programming with Mosh', 1000, '2025-11-08 17:10:00'),
(15, 'upDLs1sn7g4', 'Belajar JavaScript Modern', 'Traversy Media', 1250, '2025-11-11 11:05:00');

-- -----------------------
-- INSERT: user_tokens
-- -----------------------
INSERT INTO `user_tokens` (`user_id`, `access_token`, `refresh_token`, `token_type`, `expires_in`, `created_at`) VALUES
(1, 'ya29.a_dummy_token_1', '1//refresh_dummy_1', 'Bearer', 3600, '2025-09-05 09:05:00'),
(2, 'ya29.a_dummy_token_2', '1//refresh_dummy_2', 'Bearer', 3600, '2025-09-07 11:25:00'),
(3, 'ya29.a_dummy_token_3', '1//refresh_dummy_3', 'Bearer', 3600, '2025-09-10 08:50:00'),
(4, 'ya29.a_dummy_token_4', '1//refresh_dummy_4', 'Bearer', 3600, '2025-09-12 10:20:00'),
(5, 'ya29.a_dummy_token_5', '1//refresh_dummy_5', 'Bearer', 3600, '2025-09-14 13:35:00'),
(6, 'ya29.a_dummy_token_6', '1//refresh_dummy_6', 'Bearer', 3600, '2025-09-18 09:05:00'),
(7, 'ya29.a_dummy_token_7', '1//refresh_dummy_7', 'Bearer', 3600, '2025-09-20 14:30:00'),
(8, 'ya29.a_dummy_token_8', '1//refresh_dummy_8', 'Bearer', 3600, '2025-09-22 07:55:00'),
(9, 'ya29.a_dummy_token_9', '1//refresh_dummy_9', 'Bearer', 3600, '2025-09-25 10:05:00'),
(10, 'ya29.a_dummy_token_10', '1//refresh_dummy_10', 'Bearer', 3600, '2025-09-27 09:35:00'),
(11, 'ya29.a_dummy_token_11', '1//refresh_dummy_11', 'Bearer', 3600, '2025-10-01 15:45:00'),
(12, 'ya29.a_dummy_token_12', '1//refresh_dummy_12', 'Bearer', 3600, '2025-10-04 16:20:00'),
(13, 'ya29.a_dummy_token_13', '1//refresh_dummy_13', 'Bearer', 3600, '2025-10-07 10:15:00'),
(14, 'ya29.a_dummy_token_14', '1//refresh_dummy_14', 'Bearer', 3600, '2025-10-10 09:10:00'),
(15, 'ya29.a_dummy_token_15', '1//refresh_dummy_15', 'Bearer', 3600, '2025-10-12 09:00:00');

-- -----------------------
-- INSERT: study_recommendation
-- -----------------------
INSERT INTO `study_recommendation` (`user_id`, `best_hour`, `most_productive_day`, `updated_at`) VALUES
(1, '19:00:00', 'Rabu', '2025-11-11 20:00:00'),
(2, '08:30:00', 'Selasa', '2025-11-11 09:00:00'),
(3, '20:15:00', 'Kamis', '2025-11-11 21:10:00'),
(4, '14:00:00', 'Rabu', '2025-11-10 15:00:00'),
(5, '06:30:00', 'Sabtu', '2025-11-11 06:35:00'),
(6, '16:00:00', 'Kamis', '2025-11-09 16:05:00'),
(7, '20:00:00', 'Minggu', '2025-11-09 20:05:00'),
(8, '09:00:00', 'Senin', '2025-11-10 09:10:00'),
(9, '13:00:00', 'Selasa', '2025-11-08 13:05:00'),
(10, '10:00:00', 'Kamis', '2025-11-09 10:10:00'),
(11, '17:00:00', 'Rabu', '2025-11-11 17:05:00'),
(12, '21:00:00', 'Sabtu', '2025-11-10 21:05:00'),
(13, '08:00:00', 'Jumat', '2025-11-08 08:05:00'),
(14, '17:00:00', 'Senin', '2025-11-10 17:05:00'),
(15, '09:00:00', 'Minggu', '2025-11-11 09:05:00');

-- -----------------------
-- INSERT: bug_report
-- -----------------------
INSERT INTO `bug_report` (`user_id`, `title`, `description`, `status`, `created_at`) VALUES
(1, 'Progress tidak tersimpan', 'Setelah input durasi belajar, data tidak muncul di dashboard.', 'open', '2025-11-10 09:10:00'),
(2, 'Notifikasi ganda', 'Sistem mengirim dua pengingat sekaligus pada jam yang sama.', 'in progress', '2025-11-09 11:15:00'),
(3, 'Video tidak tampil', 'Halaman rekomendasi video hanya menampilkan thumbnail kosong.', 'open', '2025-11-11 21:30:00'),
(5, 'Sync Calendar gagal', 'Event Google Calendar tidak muncul di dashboard setelah auth.', 'in progress', '2025-11-11 07:55:00'),
(8, 'API rate limit', 'Integrasi YouTube kadang-terputus karena limit quota.', 'open', '2025-11-10 10:05:00'),
(10, 'Performa dashboard lambat', 'Load data grafis memakan waktu lebih dari 5 detik.', 'in progress', '2025-11-09 20:30:00'),
(15, 'Perhitungan poin salah', 'Poin total tidak bertambah setelah menyelesaikan sesi.', 'open', '2025-11-11 09:50:00');