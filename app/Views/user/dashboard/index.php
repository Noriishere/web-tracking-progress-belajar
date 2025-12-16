<?php
$recent_sessions = $recent_sessions ?? [];
$recent_youtube  = $recent_youtube ?? [];
$isEmptyChart = array_sum($session_chart_data ?? []) == 0;
?>

<div class="w-full px-6 sm:px-10 pt-4 pb-10">
  <!-- Header Section with Animation -->
  <div class="mb-8 animate-fade-in">
    <h3 class="font-bold text-3xl sm:text-4xl text-textcolor dark:text-textcolor-dark bg-gradient-to-r from-blue-300 to-blue-500 bg-clip-text text-transparent">
      Selamat Datang, <?= htmlspecialchars($username) ?>
    </h3>

    <!-- Streak Cards -->
    <div class="flex flex-wrap gap-4 mt-6">
      <div class="group relative overflow-hidden bg-gradient-to-br from-orange-500/20 to-red-500/20 dark:from-orange-500/10 dark:to-red-500/10 border border-orange-500/30 rounded-2xl px-6 py-4 hover:scale-105 transition-all duration-300 hover:shadow-xl hover:shadow-orange-500/20">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-500/0 to-orange-500/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
        <div class="relative flex items-center gap-3">
          <i class="fa-solid fa-fire text-3xl text-orange-500 drop-shadow-[0_0_15px_rgba(249,115,22,0.6)] animate-pulse"></i>
          <div>
            <p class="text-sm text-textcolor/70 dark:text-textcolor-dark/70 font-medium">Current Streak</p>
            <p class="text-2xl font-bold text-textcolor dark:text-textcolor-dark">
              <?= $streak > 0 ? htmlspecialchars($streak) . ' Hari' : 'Streak Mati' ?>
            </p>
          </div>
        </div>
      </div>

      <div class="group relative overflow-hidden bg-gradient-to-br from-yellow-500/20 to-amber-500/20 dark:from-yellow-500/10 dark:to-amber-500/10 border border-yellow-500/30 rounded-2xl px-6 py-4 hover:scale-105 transition-all duration-300 hover:shadow-xl hover:shadow-yellow-500/20">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/0 to-yellow-500/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
        <div class="relative flex items-center gap-3">
          <i class="fa-solid fa-trophy text-3xl text-yellow-500 drop-shadow-[0_0_15px_rgba(234,179,8,0.6)]"></i>
          <div>
            <p class="text-sm text-textcolor/70 dark:text-textcolor-dark/70 font-medium">Best Streak</p>
            <p class="text-2xl font-bold text-textcolor dark:text-textcolor-dark">
              <?= htmlspecialchars($longest_streak) ?> Hari
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Grid with Hover Effects -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <!-- Card 1: Notes Today -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark rounded-2xl p-6 hover:shadow-2xl hover:shadow-brand-500/20 transition-all duration-300 hover:scale-105 hover:border-brand-500/50">
      <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-full blur-3xl group-hover:bg-brand-500/10 transition-all duration-500"></div>
      <div class="relative flex items-center gap-4">
        <div class="w-14 h-14 border-2 border-brand-500 bg-gradient-to-br from-brand-500/30 to-brand-600/30 rounded-xl flex items-center justify-center shrink-0 group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
          <i class="fa-solid fa-pen text-xl text-brand-500"></i>
        </div>
        <div class="flex flex-col">
          <p class="text-textcolor/70 dark:text-textcolor-dark/70 text-sm font-medium">Catatan Hari Ini</p>
          <h3 class="text-textcolor dark:text-textcolor-dark font-bold text-3xl mt-1 group-hover:text-brand-500 transition-colors">
            <?= htmlspecialchars($notes_today) ?>
          </h3>
        </div>
      </div>
    </div>

    <!-- Card 2: Total Words -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark rounded-2xl p-6 hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-300 hover:scale-105 hover:border-purple-500/50">
      <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-all duration-500"></div>
      <div class="relative flex items-center gap-4">
        <div class="w-14 h-14 border-2 border-purple-500 bg-gradient-to-br from-purple-500/30 to-purple-600/30 rounded-xl flex items-center justify-center shrink-0 group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
          <i class="fa-solid fa-font text-xl text-purple-500"></i>
        </div>
        <div class="flex flex-col">
          <p class="text-textcolor/70 dark:text-textcolor-dark/70 text-sm font-medium">Total Kata</p>
          <h3 class="text-textcolor dark:text-textcolor-dark font-bold text-3xl mt-1 group-hover:text-purple-500 transition-colors">
            <?= htmlspecialchars($word_today) ?>
          </h3>
        </div>
      </div>
    </div>

    <!-- Card 3: Study Duration -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark rounded-2xl p-6 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-300 hover:scale-105 hover:border-blue-500/50">
      <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-all duration-500"></div>
      <div class="relative flex items-center gap-4">
        <div class="w-14 h-14 border-2 border-blue-500 bg-gradient-to-br from-blue-500/30 to-blue-600/30 rounded-xl flex items-center justify-center shrink-0 group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
          <i class="fa-solid fa-clock text-xl text-blue-500"></i>
        </div>
        <div class="flex flex-col">
          <p class="text-textcolor/70 dark:text-textcolor-dark/70 text-sm font-medium">Durasi Belajar</p>
          <h3 class="text-textcolor dark:text-textcolor-dark font-bold text-3xl mt-1 group-hover:text-blue-500 transition-colors">
            <?= htmlspecialchars($duration_today) ?><span class="text-lg ml-1">min</span>
          </h3>
        </div>
      </div>
    </div>

    <!-- Card 4: Total Sessions -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark rounded-2xl p-6 hover:shadow-2xl hover:shadow-green-500/20 transition-all duration-300 hover:scale-105 hover:border-green-500/50">
      <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-full blur-3xl group-hover:bg-green-500/10 transition-all duration-500"></div>
      <div class="relative flex items-center gap-4">
        <div class="w-14 h-14 border-2 border-green-500 bg-gradient-to-br from-green-500/30 to-green-600/30 rounded-xl flex items-center justify-center shrink-0 group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
          <i class="fa-solid fa-graduation-cap text-xl text-green-500"></i>
        </div>
        <div class="flex flex-col">
          <p class="text-textcolor/70 dark:text-textcolor-dark/70 text-sm font-medium">Total Sesi</p>
          <h3 class="text-textcolor dark:text-textcolor-dark font-bold text-3xl mt-1 group-hover:text-green-500 transition-colors">
            <?= htmlspecialchars($total_sessions) ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Recommendation Card -->
  <div class="mb-8">
    <div class="group relative overflow-hidden bg-gradient-to-br from-indigo-500/10 via-purple-500/10 to-pink-500/10 dark:from-indigo-500/5 dark:via-purple-500/5 dark:to-pink-500/5 border border-indigo-500/30 rounded-2xl p-6 hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_120%,rgba(120,119,198,0.1),transparent)]"></div>
      <div class="relative">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
            <i class="fa-solid fa-lightbulb text-white"></i>
          </div>
          <p class="font-bold text-lg text-textcolor dark:text-textcolor-dark">Rekomendasi Belajar</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex items-start gap-3 p-3 bg-white/50 dark:bg-black/20 rounded-xl backdrop-blur-sm">
            <i class="fa-solid fa-clock text-indigo-500 mt-1"></i>
            <div>
              <p class="text-xs text-textcolor/60 dark:text-textcolor-dark/60 font-medium">Waktu Terbaik</p>
              <p class="text-textcolor dark:text-textcolor-dark font-semibold">
                <?= htmlspecialchars($rec_best_hour ? $rec_best_hour : 'Belum ada data') ?>
              </p>
            </div>
          </div>
          <div class="flex items-start gap-3 p-3 bg-white/50 dark:bg-black/20 rounded-xl backdrop-blur-sm">
            <i class="fa-solid fa-star text-purple-500 mt-1"></i>
            <div>
              <p class="text-xs text-textcolor/60 dark:text-textcolor-dark/60 font-medium">Hari Produktif</p>
              <p class="text-textcolor dark:text-textcolor-dark font-semibold">
                <?= htmlspecialchars($productive_day) ?>
              </p>
            </div>
          </div>
        </div>
        <p class="text-textcolor/60 dark:text-textcolor-dark/60 text-xs mt-4 italic">
          <span class="fa fa-star"></span> Dihasilkan otomatis dari pola belajar Anda
        </p>
      </div>
    </div>
  </div>

  <!-- Weekly Stats -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="group relative overflow-hidden bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark p-6 rounded-2xl hover:shadow-xl transition-all duration-300 hover:scale-105">
      <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-full blur-2xl"></div>
      <div class="relative">
        <div class="flex items-center gap-2 mb-3">
          <i class="fa-solid fa-chart-line text-blue-500"></i>
          <p class="text-textcolor/70 dark:text-textcolor-dark/70 text-sm font-medium">Minggu Ini</p>
        </div>
        <h2 class="text-textcolor dark:text-textcolor-dark font-bold text-4xl mb-2">
          <?= htmlspecialchars(round($weekly_minutes / 60, 1)) ?><span class="text-xl ml-1">jam</span>
        </h2>
        <div class="flex items-center gap-2">
          <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $weekly_growth >= 0 ? 'bg-green-500/20 text-green-600 dark:text-green-400' : 'bg-red-500/20 text-red-600 dark:text-red-400' ?>">
            <?= $weekly_growth >= 0 ? '↑' : '↓' ?> <?= abs($weekly_growth) ?>%
          </span>
          <span class="text-xs text-textcolor/60 dark:text-textcolor-dark/60">vs minggu lalu</span>
        </div>
      </div>
    </div>

    <div class="group relative overflow-hidden bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark p-6 rounded-2xl hover:shadow-xl transition-all duration-300 hover:scale-105">
      <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/5 rounded-full blur-2xl"></div>
      <div class="relative">
        <div class="flex items-center gap-2 mb-3">
          <i class="fa-solid fa-book text-purple-500"></i>
          <p class="text-textcolor/70 dark:text-textcolor-dark/70 text-sm font-medium">Mata Kuliah Teratas</p>
        </div>
        <h2 class="text-textcolor dark:text-textcolor-dark font-bold text-2xl truncate">
          <?= htmlspecialchars($top_subject ?: 'Belum Ada Data') ?>
        </h2>
      </div>
    </div>

    <div class="group relative overflow-hidden bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark p-6 rounded-2xl hover:shadow-xl transition-all duration-300 hover:scale-105">
      <div class="absolute top-0 right-0 w-24 h-24 bg-red-500/5 rounded-full blur-2xl"></div>
      <div class="relative">
        <div class="flex items-center gap-2 mb-3">
          <i class="fa-brands fa-youtube text-red-500"></i>
          <p class="text-textcolor/70 dark:text-textcolor-dark/70 text-sm font-medium">YouTube (Minggu Ini)</p>
        </div>
        <h2 class="text-textcolor dark:text-textcolor-dark font-bold text-4xl">
          <?= htmlspecialchars(round($youtube_minutes / 60, 1)) ?><span class="text-xl ml-1">jam</span>
        </h2>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="flex flex-wrap gap-4 mb-8">
    <a href="<?= BASE_URL ?>user/sessions/study" class="group relative overflow-hidden px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-semibold shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 hover:scale-105">
      <div class="absolute inset-0 bg-white/20 translate-y-[100%] group-hover:translate-y-0 transition-transform duration-300"></div>
      <span class="relative flex items-center gap-2">
        <i class="fa-solid fa-play"></i>
        Mulai Belajar (Pomodoro)
      </span>
    </a>
    <a href="<?= BASE_URL ?>user/sessions/youtube" class="group relative overflow-hidden px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 transition-all duration-300 hover:scale-105">
      <div class="absolute inset-0 bg-white/20 translate-y-[100%] group-hover:translate-y-0 transition-transform duration-300"></div>
      <span class="relative flex items-center gap-2">
        <i class="fa-brands fa-youtube"></i>
        Belajar dari YouTube
      </span>
    </a>
  </div>

  <!-- Chart and Sessions Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Chart -->
    <div class="bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
      <h3 class="text-textcolor dark:text-textcolor-dark font-bold text-lg mb-4 flex items-center gap-2">
        <i class="fa-solid fa-chart-area text-brand-500"></i>
        Grafik Belajar 7 Hari
      </h3>
      <div class="h-[240px]">
        <canvas id="sessionsChart"></canvas>
      </div>
    </div>

    <!-- Recent Sessions -->
    <div class="bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
      <h3 class="text-textcolor dark:text-textcolor-dark font-bold text-lg mb-4 flex items-center gap-2">
        <i class="fa-solid fa-history text-brand-500"></i>
        Recent Sessions
      </h3>

      <?php if (empty($recent_sessions)): ?>
        <div class="w-full h-[180px] flex flex-col items-center justify-center text-textcolor/50 dark:text-textcolor-dark/50">
          <i class="fa-solid fa-clock text-4xl mb-3 opacity-30"></i>
          <p class="font-semibold">Belum ada sesi belajar</p>
          <p class="text-sm text-center mt-1">Mulai Pomodoro untuk mencatat sesi pertama 🎯</p>
        </div>
      <?php else: ?>
        <div class="space-y-2 max-h-[200px] overflow-y-auto pr-2 custom-scrollbar">
          <?php foreach ($recent_sessions as $sess): ?>
            <div class="group p-4 border border-bordercolor/50 dark:border-bordercolor-dark/50 rounded-xl hover:bg-brand-500/5 hover:border-brand-500/30 transition-all duration-300">
              <p class="text-textcolor dark:text-textcolor-dark font-semibold group-hover:text-brand-500 transition-colors">
                <?= htmlspecialchars($sess['subject_name']) ?>
              </p>
              <div class="flex items-center gap-3 mt-2 text-sm text-textcolor/60 dark:text-textcolor-dark/60">
                <span class="flex items-center gap-1">
                  <i class="fa-solid fa-clock text-xs"></i>
                  <?= htmlspecialchars($sess['duration_minutes']) ?> menit
                </span>
                <span class="flex items-center gap-1">
                  <i class="fa-solid fa-calendar text-xs"></i>
                  <?= htmlspecialchars($sess['start_time']) ?>
                </span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Recent Notes -->
  <div class="bg-gradient-to-br from-card to-card/50 dark:from-card-dark dark:to-card-dark/50 border border-bordercolor dark:border-bordercolor-dark p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
    <h3 class="text-textcolor dark:text-textcolor-dark font-bold text-lg mb-4 flex items-center gap-2">
      <i class="fa-solid fa-sticky-note text-brand-500"></i>
      Recent Notes
    </h3>

    <?php if (empty($recent_notes)): ?>
      <div class="w-full h-[150px] flex flex-col items-center justify-center text-textcolor/50 dark:text-textcolor-dark/50">
        <i class="fa-solid fa-file-lines text-4xl mb-3 opacity-30"></i>
        <p class="font-semibold">Belum ada catatan</p>
        <p class="text-sm text-center mt-1">Buat catatan baru dari menu Notes atau YouTube Editor ✏️</p>
      </div>
    <?php else: ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($recent_notes as $n): ?>
          <a href="<?= BASE_URL ?>user/notes/detail/<?= $n['id_note'] ?>"
            class="group relative overflow-hidden p-4 border border-bordercolor dark:border-bordercolor-dark rounded-xl hover:bg-gradient-to-br hover:from-brand-500/5 hover:to-purple-500/5 hover:border-brand-500/30 transition-all duration-300 hover:scale-105 hover:shadow-lg">
            <div class="absolute top-0 right-0 w-20 h-20 bg-brand-500/5 rounded-full blur-2xl group-hover:bg-brand-500/10 transition-all duration-500"></div>
            <div class="relative">
              <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold text-brand-500 bg-brand-500/10 px-2 py-1 rounded-full">
                  <?= date("d M Y", strtotime($n['activity_date'])) ?>
                </span>
                <i class="fa-solid fa-arrow-right text-brand-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
              </div>
              <p class="text-textcolor dark:text-textcolor-dark text-sm line-clamp-3">
                <?= htmlspecialchars(substr($n['content'], 0, 100)) ?>...
              </p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

      <div class="mt-6 text-center">
        <a href="<?= BASE_URL ?>user/notes"
          class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-brand-500/10 to-purple-500/10 hover:from-brand-500/20 hover:to-purple-500/20 border border-brand-500/30 text-textcolor dark:text-textcolor-dark font-semibold rounded-xl transition-all duration-300 hover:scale-105">
          Lihat Semua Catatan
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Custom Styles -->
<style>
  @keyframes fade-in {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in {
    animation: fade-in 0.6s ease-out;
  }

  .custom-scrollbar::-webkit-scrollbar {
    width: 6px;
  }

  .custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(139, 92, 246, 0.3);
    border-radius: 3px;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(139, 92, 246, 0.5);
  }

  .line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>

<!-- Service Worker Script -->
<script>
  function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
      .replace(/-/g, '+')
      .replace(/_/g, '/');

    const rawData = atob(base64);
    return Uint8Array.from([...rawData].map(c => c.charCodeAt(0)));
  }

  const publicKey = "<?= VAPID_PUBLIC_KEY ?>";

  async function subscribePush() {
    if (!("serviceWorker" in navigator)) return;

    const reg = await navigator.serviceWorker.register("/sw.js");

    const sub = await reg.pushManager.subscribe({
      userVisibleOnly: true,
      applicationServerKey: urlBase64ToUint8Array(publicKey)
    });

    await fetch("<?= BASE_URL ?>user/push/subscribe", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(sub)
    });
  }

  subscribePush();
</script>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  const canvas = document.getElementById("sessionsChart");

  const labels = <?= json_encode($session_chart_labels ?? []) ?>;
  const data = <?= json_encode($session_chart_data ?? []) ?>;

  if (canvas) {
    const ctx = canvas.getContext("2d");

    // Create gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 240);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.05)');

    new Chart(ctx, {
      type: "line",
      data: {
        labels: labels,
        datasets: [{
          data: data,
          borderColor: "rgb(99, 102, 241)",
          backgroundColor: gradient,
          fill: true,
          tension: 0.4,
          borderWidth: 3,
          pointRadius: 5,
          pointHoverRadius: 8,
          pointBackgroundColor: "rgb(99, 102, 241)",
          pointBorderColor: "#fff",
          pointBorderWidth: 2,
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgb(99, 102, 241)",
          pointHoverBorderWidth: 3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          intersect: false,
          mode: 'index'
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            enabled: true,
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleColor: '#fff',
            bodyColor: '#fff',
            borderColor: 'rgb(99, 102, 241)',
            borderWidth: 1,
            padding: 12,
            displayColors: false,
            callbacks: {
              label: function(context) {
                return context.parsed.y + ' menit';
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(99, 102, 241, 0.1)',
              drawBorder: false
            },
            ticks: {
              color: 'rgba(107, 114, 128, 0.8)',
              callback: function(value) {
                return value + ' min';
              }
            }
          },
          x: {
            grid: {
              display: false,
              drawBorder: false
            },
            ticks: {
              color: 'rgba(107, 114, 128, 0.8)'
            }
          }
        },
        animation: {
          duration: 1500,
          easing: 'easeInOutQuart'
        }
      }
    });
  }
</script>