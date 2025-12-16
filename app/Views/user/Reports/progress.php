<?php
$totalMenit = 0;
$totalSesi  = 0;
$totalProd  = 0;
$hariCount  = count($harian ?? []);

foreach ($harian as $h) {
    $totalMenit += $h['total_minutes'];
    $totalSesi  += $h['total_sessions'];
    $totalProd  += $h['avg_productivity'];
}

$avgProd = $hariCount ? round($totalProd / $hariCount, 2) : 0;
?>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}

.animate-slide-in {
    animation: slideInRight 0.6s ease-out forwards;
    opacity: 0;
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
</style>

<div class="max-w-7xl mx-auto space-y-8 p-4">

    <!-- Header Section dengan Gradient -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate-fade-in-up delay-100">
        <div>
            <h1 class="text-textcolor dark:text-textcolor-dark text-4xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 bg-clip-text text-transparent">
                Progress Belajar Kamu
            </h1>
            <p class="text-sm text-textcolor-muted dark:text-textcolor-muted-dark mt-2">Pantau perkembangan belajarmu secara real-time</p>
        </div>

        <div class="flex items-center gap-4">
            <div class="hidden md:block text-right px-4 py-2 rounded-xl bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/30 border border-bordercolor dark:border-bordercolor-dark">
                <p class="text-xs text-textcolor-muted dark:text-textcolor-muted-dark">Selamat datang,</p>
                <p class="text-lg font-bold text-textcolor dark:text-textcolor-dark">
                    <?= htmlspecialchars($_SESSION['user']['username']) ?>
                </p>
            </div>
            <button
                onclick="downloadMyReport()"
                class="group relative px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-textcolor dark:text-textcolor-dark  font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:scale-105">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-5 h-5 transition-transform group-hover:translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-500 dark:to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </button>
        </div>
    </div>

    <!-- Stats Cards dengan Gradient & Icons -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-textcolor dark:text-textcolor-dark">
        <!-- Total Menit Card -->
        <div class="animate-fade-in-up delay-200 group relative bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-800 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class=" absolute top-0 right-0 w-32 h-32 bg-white/10 dark:bg-white/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-textcolor dark:text-textcolor-dark font-medium">Total</div>
                </div>
                <h3 class="text-textcolor dark:text-textcolor-dark text-sm font-medium mb-1">Total Menit</h3>
                <p class="text-textcolor dark:text-textcolor-dark text-4xl font-bold"><?= number_format($totalMenit) ?></p>
                <p class="text-textcolor dark:text-textcolor-dark text-xs mt-2">≈ <?= round($totalMenit / 60, 1) ?> jam belajar</p>
            </div>
        </div>

        <!-- Total Sesi Card -->
        <div class="animate-fade-in-up delay-300 group relative bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-800 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 dark:bg-white/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="text-white/60 dark:text-white/50 text-sm font-medium">Sesi</div>
                </div>
                <h3 class="text-textcolor dark:text-textcolor-dark text-sm font-medium mb-1">Total Sesi</h3>
                <p class="text-textcolor dark:text-textcolor-dark text-4xl font-bold"><?= number_format($totalSesi) ?></p>
                <p class="text-textcolor dark:text-textcolor-dark text-xs mt-2">Sesi pembelajaran</p>
            </div>
        </div>

        <!-- Produktivitas Card -->
        <div class="animate-fade-in-up delay-400 group relative bg-gradient-to-br from-pink-500 to-rose-600 dark:from-pink-600 dark:to-rose-800 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 dark:bg-white/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div class="text-white/60 dark:text-white/50 text-sm font-medium">Rata-rata</div>
                </div>
                <h3 class="text-textcolor dark:text-textcolor-dark text-sm font-medium mb-1">Produktivitas</h3>
                <p class="text-textcolor dark:text-textcolor-dark text-4xl font-bold"><?= $avgProd ?>%</p>
                <p class="text-textcolor dark:text-textcolor-dark text-xs mt-2">Tingkat produktivitas</p>
            </div>
        </div>
    </div>

    <!-- Progress Harian -->
    <div class="animate-fade-in-up delay-500 bg-card dark:bg-card-dark rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-bordercolor dark:border-bordercolor-dark">
        <div class="bg-gradient-to-r from-indigo-500/10 to-purple-500/10 dark:from-indigo-500/20 dark:to-purple-500/20 px-6 py-4 border-b border-bordercolor dark:border-bordercolor-dark">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg">
                    <svg class="w-5 h-5 text-textcolor dark:text-textcolor-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-textcolor dark:text-textcolor-dark">Progress Harian</h2>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Menit</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Sesi</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Produktivitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-bordercolor dark:divide-bordercolor-dark text-textcolor dark:text-textcolor-dark">
                    <?php foreach ($harian as $h): ?>
                        <tr class="hover:bg-indigo-50 dark:hover:bg-indigo-900/10 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-textcolor dark:text-textcolor-dark">
                                <?= $h['study_date'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200">
                                    <?= $h['total_minutes'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-200">
                                    <?= $h['total_sessions'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-16 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-pink-500 to-rose-500 dark:from-pink-400 dark:to-rose-400 rounded-full transition-all duration-500" style="width: <?= min($h['avg_productivity'], 100) ?>%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-textcolor dark:text-textcolor-dark"><?= $h['avg_productivity'] ?>%</span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Progress per Mata Kuliah -->
    <div class="animate-slide-in delay-100 bg-card dark:bg-card-dark rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-bordercolor dark:border-bordercolor-dark">
        <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 dark:from-purple-500/20 dark:to-pink-500/20 px-6 py-4 border-b border-bordercolor dark:border-bordercolor-dark">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 dtext-textcolor dark:text-textcolor-dark rounded-lg">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-textcolor dark:text-textcolor-dark">Progress per Mata Kuliah</h2>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-900/50 text-textcolor dark:text-textcolor-dark">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Total Sesi</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Total Menit</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Produktivitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-bordercolor dark:divide-bordercolor-dark text-textcolor dark:text-textcolor-dark">
                    <?php foreach ($perMataKuliah as $m): ?>
                        <tr class="hover:bg-purple-50 dark:hover:bg-purple-900/10 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-textcolor dark:text-textcolor-dark">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 dark:from-purple-400 dark:to-pink-400"></div>
                                    <?= $m['subject_name'] ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-200">
                                    <?= $m['total_sessions'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200">
                                    <?= $m['total_minutes'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-pink-100 to-rose-100 dark:from-pink-900/50 dark:to-rose-900/50 text-pink-800 dark:text-pink-200">
                                    <?= $m['avg_productivity'] ?>%
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rekap Belajar YouTube -->
    <div class="animate-slide-in delay-200 bg-card dark:bg-card-dark rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-bordercolor dark:border-bordercolor-dark">
        <div class="bg-gradient-to-r from-red-500/10 to-orange-500/10 dark:from-red-500/20 dark:to-orange-500/20 px-6 py-4 border-b border-bordercolor dark:border-bordercolor-dark">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-100 dark:bg-red-900/50 rounded-lg">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-textcolor dark:text-textcolor-dark">Rekap Belajar YouTube</h2>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-900/50 ">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Total Video</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Total Menit</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-textcolor-muted dark:text-textcolor-muted-dark uppercase tracking-wider">Terakhir Ditonton</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-bordercolor dark:divide-bordercolor-dark text-textcolor dark:text-textcolor-dark">
                    <?php foreach ($youtube as $y): ?>
                        <tr class="hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-textcolor dark:text-textcolor-dark">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-gradient-to-r from-red-500 to-orange-500 dark:from-red-400 dark:to-orange-400"></div>
                                    <?= $y['subject_name'] ?? '-' ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <?= $y['total_video'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-200">
                                    <?= $y['total_minutes'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-textcolor-muted dark:text-textcolor-muted-dark">
                                <?= date('d M Y', strtotime($y['last_watched'])) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    function downloadMyReport() {
        window.location.href = "<?= BASE_URL ?>user/reports/download";
    }
</script>