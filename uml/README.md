# Deskripsi

## 👨‍🎓 Mahasiswa/Pelajar User

| No | Use Case | Deskripsi |
|----|-----------|------------|
| 1 | **Login** | Mahasiswa masuk ke sistem menggunakan akun terdaftar. Jika berhasil, diarahkan ke Dashboard. |
| 2 | **Dashboard** | Halaman utama berisi ringkasan streak, progress, dan menu utama. Semua fitur utama dapat diakses dari sini. |
| 3 | **Kelola Profil** | Mahasiswa dapat melihat dan mengedit profil mereka. Relasi ke `Lihat Profil` dan `Edit Profil`. |
| 4 | **Lihat Profil** | Menampilkan informasi pribadi mahasiswa seperti nama, email, program studi, dan total streak. |
| 5 | **Edit Profil** | Mahasiswa dapat memperbarui data diri seperti nama, foto, atau kata sandi. |
| 6 | **Melihat Streak Belajar** | Menampilkan jumlah hari berturut-turut mahasiswa aktif belajar. |
| 7 | **Melihat Leaderboard Streak** | Menampilkan peringkat streak seluruh mahasiswa untuk memotivasi belajar. |
| 8 | **Melihat Progress Belajar** | Menampilkan total jam belajar per mata kuliah dan status progress. |
| 9 | **Melihat Grafik Progress** | Menampilkan grafik time-series dan kategori berdasarkan data belajar. |
| 10 | **Membuat Catatan Belajar** | Mahasiswa mencatat aktivitas belajar (tanggal, jam, durasi, topik). |
| 11 | **Melihat Video Referensi Belajar** | Menampilkan video pembelajaran dari YouTube API sesuai mata kuliah. |
| 12 | **Melihat Rekomendasi Jam Belajar Terbaik** | Sistem memberikan rekomendasi jam belajar paling produktif berdasarkan analisis data aktivitas. |
| 13 | **Lapor Bug / Contact Support** | Mahasiswa dapat mengirim laporan bug atau saran ke admin/pengembang. |
| 14 | **Logout** | Mengakhiri sesi pengguna dan keluar dari sistem. |

---

## 🧑‍💼 Admin

| No | Use Case | Deskripsi |
|----|-----------|------------|
| 1 | **Login** | Admin masuk ke sistem menggunakan akun khusus admin. |
| 2 | **Validasi Admin** | Sistem memverifikasi kredensial admin sebelum memberi akses penuh. |
| 3 | **Kelola Data Mahasiswa** | Admin dapat menambah, mengedit, dan menghapus data mahasiswa. |
| 4 | **Kelola Jadwal Belajar Global** | Admin dapat membuat atau mengatur jadwal belajar umum untuk semua mahasiswa. |
| 5 | **Mengatur Akses Jadwal Belajar Lewat Google Calendar** | Sistem melakukan sinkronisasi jadwal global dengan Google Calendar API agar mahasiswa otomatis dapat pengingat belajar. |
| 6 | **Kelola Integrasi API** | Admin dapat mengatur koneksi dan kredensial API eksternal seperti Google Calendar & YouTube API. |
| 7 | **Mengatur Referensi Belajar dari YouTube** | Sistem mengambil daftar video pembelajaran menggunakan YouTube API sesuai dengan mata kuliah tertentu. |
| 8 | **Kirim Notifikasi** | Sistem otomatis mengirimkan notifikasi ke mahasiswa berdasarkan jadwal belajar atau aktivitas tertentu. |
| 9 | **Lihat Laporan Aktivitas Mahasiswa** | Admin memantau aktivitas belajar mahasiswa melalui laporan statistik dan grafik. |
| 10 | **Analisis Data Aktivitas Mahasiswa** | Sistem menganalisis data aktivitas belajar mahasiswa untuk menentukan pola belajar dan efektivitas waktu. |

---

## 🔗 API Integration

| No | API | Deskripsi | Digunakan Oleh | Use Case Terkait |
|----|-----|------------|----------------|------------------|
| 1 | **Google Calendar API** | Digunakan untuk mengambil atau membuat jadwal belajar mahasiswa serta mengirim pengingat otomatis. | Admin / Sistem | Mengatur Akses Jadwal Belajar Lewat Google Calendar |
| 2 | **YouTube API** | Digunakan untuk mengambil daftar video pembelajaran dari channel atau playlist tertentu. | Admin / Mahasiswa | Mengatur Referensi Belajar dari YouTube, Melihat Video Referensi Belajar |
| 3 | **Internal Notification API** | API internal sistem untuk mengirim pesan notifikasi (email/push). | Sistem | Kirim Notifikasi |
| 4 | **Analytics Service (Internal)** | Modul internal untuk menghitung jam belajar, streak, dan rekomendasi jam belajar. | Sistem | Analisis Data Aktivitas Mahasiswa, Melihat Rekomendasi Jam Belajar Terbaik |

---

## ⚙️ Actors Summary

| Aktor | Deskripsi |
|--------|-----------|
| **Mahasiswa/Pelajar (User)** | Menggunakan sistem untuk mencatat aktivitas belajar, melihat progress, dan mendapatkan rekomendasi belajar. |
| **Admin** | Mengelola data mahasiswa, jadwal belajar, serta konfigurasi API eksternal. |
| **Sistem (Otomatis)** | Menangani proses analisis, notifikasi, dan komunikasi dengan API eksternal. |
| **Google Calendar API** | Pihak eksternal untuk sinkronisasi jadwal belajar. |
| **YouTube API** | Pihak eksternal untuk menampilkan referensi video pembelajaran. |