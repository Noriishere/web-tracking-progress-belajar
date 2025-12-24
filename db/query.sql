-- 1. Total Durasi Belajar per User
SELECT 
    u.username AS 'Nama Pengguna',
    COUNT(p.id_progress) AS 'Jumlah Sesi Belajar',
    SUM(p.duration_minutes) AS 'Total Menit Belajar',
    ROUND(AVG(p.duration_minutes), 1) AS 'Rata-rata Durasi (menit)',
    u.created_at AS 'Tanggal Bergabung'
FROM user u
LEFT JOIN user_progress p ON u.id_user = p.user_id
GROUP BY u.id_user
ORDER BY SUM(p.duration_minutes) DESC;

-- 2. Leaderboard Berdasarkan Total Poin
SELECT 
    u.username AS 'Nama Pengguna',
    a.total_points AS 'Total Poin',
    a.streak_days AS 'Streak (Hari)',
    RANK() OVER (ORDER BY a.total_points DESC) AS 'Peringkat'
FROM user u
JOIN user_achievement a ON u.id_user = a.user_id
ORDER BY a.total_points DESC;

-- 3. Grafik Produktivitas per Hari
SELECT 
    p.study_date AS 'Tanggal',
    SUM(p.duration_minutes) AS 'Total Durasi (menit)',
    COUNT(p.id_progress) AS 'Jumlah Sesi'
FROM user_progress p
GROUP BY p.study_date
ORDER BY p.study_date ASC;

-- 4. Tingkat Produktivitas Harian
SELECT 
    p.productivity_level AS 'Level Produktivitas',
    COUNT(p.id_progress) AS 'Jumlah Sesi'
FROM user_progress p
GROUP BY p.productivity_level
ORDER BY FIELD(p.productivity_level, 'low', 'medium', 'high');

-- 5. Streak dan Konsistensi Belajar
SELECT 
    u.username AS 'Nama Pengguna',
    a.streak_days AS 'Jumlah Hari Berturut-turut',
    a.total_points AS 'Total Poin',
    CASE
        WHEN a.streak_days >= 10 THEN 'Sangat Konsisten'
        WHEN a.streak_days >= 5 THEN 'Cukup Konsisten'
        ELSE 'Perlu Ditingkatkan'
    END AS 'Tingkat Konsistensi'
FROM user u
JOIN user_achievement a ON u.id_user = a.user_id
ORDER BY a.streak_days DESC;

-- 6. Jadwal Acara Belajar dari Google Calendar
SELECT 
    u.username AS 'Nama Pengguna',
    c.summary AS 'Judul Kegiatan',
    c.start_time AS 'Mulai',
    c.end_time AS 'Selesai',
    TIMESTAMPDIFF(MINUTE, c.start_time, c.end_time) AS 'Durasi (menit)'
FROM calendar_events c
JOIN user u ON u.id_user = c.user_id
ORDER BY c.start_time ASC;

-- 7. Aktivitas Menonton YouTube
SELECT 
    u.username AS 'Nama Pengguna',
    y.title AS 'Judul Video',
    y.channel_title AS 'Channel',
    y.watched_duration AS 'Durasi (detik)',
    y.watched_at AS 'Tanggal Ditonton'
FROM youtube_activity y
JOIN user u ON u.id_user = y.user_id
ORDER BY y.watched_at DESC;

-- 8. Rekomendasi Waktu Belajar
SELECT 
    u.username AS 'Nama Pengguna',
    r.best_hour AS 'Jam Terbaik Belajar',
    r.most_productive_day AS 'Hari Paling Produktif',
    r.updated_at AS 'Terakhir Diperbarui'
FROM study_recommendation r
JOIN user u ON u.id_user = r.user_id
ORDER BY r.updated_at DESC;

-- 9. Jumlah Notifikasi yang Dikirim ke User
SELECT 
    u.username AS 'Nama Pengguna',
    SUM(n.status = 'sent') AS 'Notifikasi Terkirim',
    SUM(n.status = 'pending') AS 'Notifikasi Pending'
FROM notifications n
JOIN user u ON u.id_user = n.user_id
GROUP BY u.id_user
ORDER BY COUNT(*) DESC;

-- 10. Laporan Bug dan Statusnya
SELECT 
    b.title AS 'Judul Laporan',
    b.description AS 'Deskripsi',
    b.status AS 'Status',
    u.username AS 'Pelapor',
    b.created_at AS 'Dibuat Pada'
FROM bug_report b
JOIN user u ON b.user_id = u.id_user
ORDER BY b.created_at DESC;

-- 11. Top 5 Pengguna Paling Aktif (Gabungan Poin + Durasi Belajar)
SELECT 
    u.username AS 'Nama Pengguna',
    COALESCE(SUM(p.duration_minutes), 0) AS 'Total Menit Belajar',
    a.total_points AS 'Poin',
    (COALESCE(SUM(p.duration_minutes), 0) + a.total_points) AS 'Skor Total'
FROM user u
LEFT JOIN user_progress p ON u.id_user = p.user_id
LEFT JOIN user_achievement a ON u.id_user = a.user_id
GROUP BY u.id_user
ORDER BY Skor_Total DESC
LIMIT 5;

-- 12. Jumlah Catatan Belajar per Pengguna
SELECT 
    u.username AS 'Nama Pengguna',
    COUNT(n.id_note) AS 'Jumlah Catatan',
    SUM(n.word_count) AS 'Total Kata Dicatat'
FROM user_notes n
JOIN user u ON n.user_id = u.id_user
GROUP BY u.id_user
ORDER BY COUNT(n.id_note) DESC;