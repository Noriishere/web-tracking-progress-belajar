<?php
$recent_sessions = $recent_sessions ?? [];
$recent_youtube  = $recent_youtube ?? [];
$isEmptyChart = array_sum($session_chart_data ?? []) == 0;
?>

<div class="max-w-7xl mx-auto p-6 space-y-6">

    <h1 class="text-3xl font-bold">Selamat datang, <?= htmlspecialchars($username) ?> 👋</h1>
    <p class="text-gray-600">🔥 Streak: <?= $streak ?> hari • Rekor: <?= $longest_streak ?></p>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Catatan Hari Ini</p>
            <h2 class="text-2xl font-bold"><?= $notes_today ?></h2>
        </div>
        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Total Kata</p>
            <h2 class="text-2xl font-bold"><?= $word_today ?></h2>
        </div>
        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Durasi Belajar</p>
            <h2 class="text-2xl font-bold"><?= $duration_today ?> menit</h2>
        </div>
        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Total Session</p>
            <h2 class="text-2xl font-bold"><?= count($recent_sessions) ?></h2>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Hari Paling Produktif</p>
            <h2 class="text-xl font-bold"><?= $productive_day ?: 'Belum Ada Data' ?></h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Jam Belajar Minggu Ini</p>
            <h2 class="text-xl font-bold"><?= round($weekly_minutes / 60, 1) ?> jam</h2>
            <p class="text-sm text-gray-500"><?= $weekly_growth >= 0 ? '+' : '' ?><?= $weekly_growth ?>% dari minggu lalu</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Mata Kuliah Teratas</p>
            <h2 class="text-xl font-bold"><?= $top_subject ?: 'Belum Ada Data' ?></h2>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Durasi Belajar YouTube (Minggu Ini)</p>
            <h2 class="text-xl font-bold"><?= round($youtube_minutes / 60, 1) ?> jam</h2>
        </div>
    </div>

    <div class="flex gap-4 mt-6">
        <a href="<?= BASE_URL ?>user/sessions/study" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Mulai Belajar (Pomodoro)</a>
        <a href="<?= BASE_URL ?>user/sessions/youtube" class="px-4 py-2 bg-red-600 text-white rounded-lg">Belajar dari YouTube</a>
    </div>
    <div class="bg-white p-6 rounded-xl shadow mt-6">
        <h3 class="text-lg font-bold mb-2">Rekomendasi Belajar</h3>

        <p class="text-gray-700">
            Waktu terbaik belajar:
            <span class="font-semibold">
                <?= $rec_best_hour ? $rec_best_hour : 'Belum ada data' ?>
            </span>
        </p>

        <p class="text-gray-700">
            Hari paling produktif:
            <span class="font-semibold">
                <?= $rec_day ? $rec_day : 'Belum ada data' ?>
            </span>
        </p>

        <p class="mt-3 text-gray-600 text-sm">
            Rekomendasi ini dihasilkan dari pola belajar Anda.
            Perbarui secara otomatis setiap ada sesi belajar baru.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-bold mb-4">Grafik Belajar 7 Hari</h3>

            <?php if ($isEmptyChart): ?>
                <div class="w-full h-[150px] flex flex-col items-center justify-center text-gray-500">
                    <p class="font-medium">Belum ada aktivitas belajar minggu ini</p>
                    <p class="text-sm">Mulailah session untuk melihat grafik perkembanganmu 📈</p>
                </div>
            <?php else: ?>
                <canvas id="sessionsChart" height="140"></canvas>
            <?php endif; ?>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-bold mb-4">Recent Sessions</h3>

            <?php if (empty($recent_sessions)): ?>
                <div class="w-full h-[150px] flex flex-col items-center justify-center text-gray-500">
                    <p class="font-medium">Belum ada sesi belajar</p>
                    <p class="text-sm">Mulai Pomodoro untuk mencatat sesi pertama kamu 🎯</p>
                </div>
            <?php else: ?>
                <?php foreach ($recent_sessions as $sess): ?>
                    <div class="p-3 border-b">
                        <p class="text-gray-700 font-medium"><?= $sess['subject_name'] ?></p>
                        <p class="text-sm text-gray-500"><?= $sess['duration_minutes'] ?> menit • <?= $sess['start_time'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold mb-4">Recent Notes</h3>

        <?php if (empty($recent_notes)): ?>
            <div class="w-full h-[150px] flex flex-col items-center justify-center text-gray-500">
                <p class="font-medium">Belum ada catatan</p>
                <p class="text-sm">Buat catatan baru dari menu Notes atau YouTube Editor ✏️</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach ($recent_notes as $n): ?>
                    <div class="p-3 border rounded-lg hover:bg-gray-50 transition">
                        <p class="font-medium text-gray-800">
                            <?= date("d M Y", strtotime($n['activity_date'])) ?>
                        </p>
                        <p class="text-gray-600 text-sm">
                            <?= htmlspecialchars(substr($n['content'], 0, 80)) ?>...
                        </p>
                        <a href="<?= BASE_URL ?>notes/detail/<?= $n['id_note'] ?>" class="text-blue-600 text-sm">Buka Catatan →</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4 text-right">
                <a href="<?= BASE_URL ?>notes" class="text-blue-600 font-medium">
                    Lihat Semua Catatan →
                </a>
            </div>
        <?php endif; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php if (!$isEmptyChart): ?>
    <script>
        const labels = <?= json_encode($session_chart_labels) ?>;
        const data = <?= json_encode($session_chart_data) ?>;

        new Chart(document.getElementById('sessionsChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    borderColor: 'rgb(59,130,246)',
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
<?php endif; ?>