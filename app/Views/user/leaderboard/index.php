<?php
$title = 'Profile | Mine';
$pageTitle = 'Profile';
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="min-h-screen w-full px-4 sm:px-6 lg:px-10 pt-8 pb-12 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-800 dark:to-indigo-950 transition-colors duration-300">

  <!-- TITLE WITH ANIMATED GRADIENT -->
  <div class="text-center mb-12 space-y-3">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-amber-500 blur-2xl opacity-60 animate-pulse"></div>
        <i class="fas fa-trophy relative text-5xl sm:text-6xl text-transparent bg-clip-text bg-gradient-to-br from-yellow-400 via-amber-500 to-yellow-600 drop-shadow-2xl"></i>
      </div>
    </div>
    <h1 class="text-5xl sm:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 tracking-tight">
      Leaderboard
    </h1>
    <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg font-medium flex items-center justify-center gap-2">
      <i class="fas fa-star text-yellow-500 text-sm animate-spin" style="animation-duration: 3s;"></i>
      Top performers this season
      <i class="fas fa-star text-yellow-500 text-sm animate-spin" style="animation-duration: 3s;"></i>
    </p>
  </div>

  <!-- PODIUM WITH ENHANCED DESIGN -->
  <div class="flex items-end justify-center gap-6 sm:gap-10 lg:gap-16 mb-16 px-4">

    <!-- Rank 2 - Silver -->
    <div class="flex flex-col items-center group">
      <div class="relative transform hover:scale-110 transition-all duration-500 hover:-translate-y-2">
        <!-- Glow Effect -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-300 via-slate-400 to-slate-500 rounded-3xl blur-2xl opacity-40 group-hover:opacity-70 transition-opacity duration-500"></div>
        
        <!-- Card -->
        <div class="relative h-40 sm:h-48 w-28 sm:w-36 bg-gradient-to-br from-slate-200 via-slate-300 to-slate-400 dark:from-slate-600 dark:to-slate-800 rounded-3xl flex flex-col justify-center items-center shadow-2xl border-4 border-slate-300 dark:border-slate-500 overflow-hidden">
          <!-- Shine Effect -->
          <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
          
          <!-- Medal Icon -->
          <div class="relative mb-3 transform group-hover:rotate-12 transition-transform duration-500">
            <i class="fas fa-medal text-5xl sm:text-6xl text-slate-600 dark:text-slate-300 drop-shadow-lg"></i>
          </div>
          
          <!-- Player Name -->
          <span class="relative text-slate-900 dark:text-white font-black text-lg sm:text-xl drop-shadow-md">Budi</span>
          
          <!-- Score Badge -->
          <div class="relative mt-2 px-4 py-1.5 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm rounded-full shadow-lg border-2 border-slate-300 dark:border-slate-600">
            <span class="text-slate-700 dark:text-slate-200 text-sm sm:text-base font-bold flex items-center gap-1.5">
              <i class="fas fa-fire text-orange-500 text-xs"></i>
              950
            </span>
          </div>
        </div>
      </div>
      
      <!-- Rank Badge -->
      <div class="mt-4 px-5 py-2 bg-gradient-to-r from-slate-300 to-slate-400 dark:from-slate-600 dark:to-slate-700 rounded-full shadow-xl border-2 border-slate-200 dark:border-slate-500 transform group-hover:scale-110 transition-transform duration-300">
        <span class="text-slate-800 dark:text-slate-100 font-black text-base sm:text-lg">#2</span>
      </div>
    </div>

    <!-- Rank 1 - Gold (Elevated) -->
    <div class="flex flex-col items-center group">
      <div class="relative transform hover:scale-110 transition-all duration-500 hover:-translate-y-3">
        <!-- Animated Glow -->
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-300 via-amber-400 to-orange-500 rounded-3xl blur-3xl opacity-75 animate-pulse group-hover:opacity-100 transition-opacity duration-500"></div>
        
        <!-- Crown Above -->
        <div class="absolute -top-8 left-1/2 -translate-x-1/2 z-20">
          <div class="relative animate-bounce" style="animation-duration: 2s;">
            <i class="fas fa-crown text-4xl sm:text-5xl text-yellow-400 drop-shadow-2xl"></i>
            <div class="absolute inset-0 animate-ping">
              <i class="fas fa-crown text-4xl sm:text-5xl text-yellow-400 opacity-30"></i>
            </div>
          </div>
        </div>
        
        <!-- Card -->
        <div class="relative h-52 sm:h-64 w-32 sm:w-40 bg-gradient-to-br from-yellow-300 via-amber-400 to-yellow-500 rounded-3xl flex flex-col justify-center items-center shadow-2xl border-4 border-yellow-400 overflow-hidden">
          <!-- Animated Shine -->
          <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/50 to-transparent animate-pulse"></div>
          
          <!-- Sparkles -->
          <i class="fas fa-sparkles absolute top-4 left-4 text-yellow-200 text-xl animate-pulse"></i>
          <i class="fas fa-sparkles absolute top-6 right-4 text-yellow-200 text-sm animate-pulse" style="animation-delay: 0.5s;"></i>
          <i class="fas fa-sparkles absolute bottom-6 left-6 text-yellow-200 text-sm animate-pulse" style="animation-delay: 1s;"></i>
          
          <!-- Trophy Icon -->
          <div class="relative mb-3 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
            <i class="fas fa-trophy text-6xl sm:text-7xl text-yellow-100 drop-shadow-2xl"></i>
          </div>
          
          <!-- Player Name -->
          <span class="relative text-white font-black text-xl sm:text-2xl drop-shadow-lg tracking-wide">Andi</span>
          
          <!-- Score Badge -->
          <div class="relative mt-3 px-5 py-2 bg-white/90 backdrop-blur-sm rounded-full shadow-2xl border-2 border-yellow-200">
            <span class="text-yellow-700 text-base sm:text-lg font-black flex items-center gap-2">
              <i class="fas fa-star text-yellow-500"></i>
              980
              <i class="fas fa-star text-yellow-500"></i>
            </span>
          </div>
        </div>
      </div>
      
      <!-- Rank Badge -->
      <div class="mt-5 px-6 py-2.5 bg-gradient-to-r from-yellow-400 via-amber-500 to-yellow-500 rounded-full shadow-2xl border-2 border-yellow-300 transform group-hover:scale-110 transition-transform duration-300">
        <span class="text-white font-black text-lg sm:text-xl flex items-center gap-1.5">
          <i class="fas fa-crown text-yellow-200 text-sm"></i>
          #1
        </span>
      </div>
    </div>

    <!-- Rank 3 - Bronze -->
    <div class="flex flex-col items-center group">
      <div class="relative transform hover:scale-110 transition-all duration-500 hover:-translate-y-2">
        <!-- Glow Effect -->
        <div class="absolute inset-0 bg-gradient-to-br from-orange-300 via-amber-500 to-orange-600 rounded-3xl blur-2xl opacity-40 group-hover:opacity-70 transition-opacity duration-500"></div>
        
        <!-- Card -->
        <div class="relative h-36 sm:h-44 w-28 sm:w-36 bg-gradient-to-br from-orange-300 via-amber-400 to-orange-500 dark:from-orange-700 dark:to-amber-900 rounded-3xl flex flex-col justify-center items-center shadow-2xl border-4 border-orange-400 dark:border-orange-600 overflow-hidden">
          <!-- Shine Effect -->
          <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
          
          <!-- Award Icon -->
          <div class="relative mb-3 transform group-hover:rotate-12 transition-transform duration-500">
            <i class="fas fa-award text-5xl sm:text-6xl text-orange-100 dark:text-orange-200 drop-shadow-lg"></i>
          </div>
          
          <!-- Player Name -->
          <span class="relative text-orange-900 dark:text-orange-100 font-black text-lg sm:text-xl drop-shadow-md">Citra</span>
          
          <!-- Score Badge -->
          <div class="relative mt-2 px-4 py-1.5 bg-white/80 dark:bg-orange-950/80 backdrop-blur-sm rounded-full shadow-lg border-2 border-orange-300 dark:border-orange-700">
            <span class="text-orange-700 dark:text-orange-200 text-sm sm:text-base font-bold flex items-center gap-1.5">
              <i class="fas fa-bolt text-yellow-500 text-xs"></i>
              920
            </span>
          </div>
        </div>
      </div>
      
      <!-- Rank Badge -->
      <div class="mt-4 px-5 py-2 bg-gradient-to-r from-orange-400 to-amber-500 dark:from-orange-600 dark:to-amber-700 rounded-full shadow-xl border-2 border-orange-300 dark:border-orange-500 transform group-hover:scale-110 transition-transform duration-300">
        <span class="text-orange-900 dark:text-orange-100 font-black text-base sm:text-lg">#3</span>
      </div>
    </div>

  </div>

  <!-- ENHANCED TABLE -->
  <div class="max-w-5xl mx-auto w-full">
    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-700 transform hover:shadow-3xl transition-all duration-300">
      
      <!-- Table Header -->
      <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-700 dark:via-purple-700 dark:to-pink-700 px-6 py-5 flex items-center justify-between">
        <h2 class="text-white font-black text-xl sm:text-2xl flex items-center gap-3">
          <i class="fas fa-ranking-star"></i>
          Rankings
        </h2>
        <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full">
          <i class="fas fa-users text-white text-sm"></i>
          <span class="text-white text-sm font-bold">10 Players</span>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-950/50 dark:to-purple-950/50 border-b-2 border-indigo-200 dark:border-indigo-800">
              <th class="py-4 px-6 text-left text-xs sm:text-sm font-black text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">
                <i class="fas fa-hashtag mr-2"></i>Rank
              </th>
              <th class="py-4 px-6 text-left text-xs sm:text-sm font-black text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">
                <i class="fas fa-user mr-2"></i>Player
              </th>
              <th class="py-4 px-6 text-right text-xs sm:text-sm font-black text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">
                <i class="fas fa-chart-line mr-2"></i>Score
              </th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-200 dark:divide-slate-700">

            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-950/30 dark:hover:to-purple-950/30 transition-all duration-300 cursor-pointer">
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 font-black text-base shadow-lg group-hover:scale-110 transition-transform duration-300">4</span>
                </div>
              </td>
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-sm"></i>
                  </div>
                  <span class="text-slate-800 dark:text-slate-200 font-bold text-base sm:text-lg">Dewi</span>
                </div>
              </td>
              <td class="py-5 px-6 text-right">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 rounded-full font-black text-sm sm:text-base shadow-lg group-hover:scale-105 transition-transform duration-300">
                  <i class="fas fa-fire-flame-curved text-orange-500 text-xs"></i>
                  880
                </span>
              </td>
            </tr>

            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-950/30 dark:hover:to-purple-950/30 transition-all duration-300 cursor-pointer">
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 font-black text-base shadow-lg group-hover:scale-110 transition-transform duration-300">5</span>
                </div>
              </td>
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-sm"></i>
                  </div>
                  <span class="text-slate-800 dark:text-slate-200 font-bold text-base sm:text-lg">Eko</span>
                </div>
              </td>
              <td class="py-5 px-6 text-right">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 rounded-full font-black text-sm sm:text-base shadow-lg group-hover:scale-105 transition-transform duration-300">
                  <i class="fas fa-fire-flame-curved text-orange-500 text-xs"></i>
                  860
                </span>
              </td>
            </tr>

            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-950/30 dark:hover:to-purple-950/30 transition-all duration-300 cursor-pointer">
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 font-black text-base shadow-lg group-hover:scale-110 transition-transform duration-300">6</span>
                </div>
              </td>
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-sm"></i>
                  </div>
                  <span class="text-slate-800 dark:text-slate-200 font-bold text-base sm:text-lg">Fajar</span>
                </div>
              </td>
              <td class="py-5 px-6 text-right">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 rounded-full font-black text-sm sm:text-base shadow-lg group-hover:scale-105 transition-transform duration-300">
                  <i class="fas fa-fire-flame-curved text-orange-500 text-xs"></i>
                  830
                </span>
              </td>
            </tr>

            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-950/30 dark:hover:to-purple-950/30 transition-all duration-300 cursor-pointer">
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 font-black text-base shadow-lg group-hover:scale-110 transition-transform duration-300">7</span>
                </div>
              </td>
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-fuchsia-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-sm"></i>
                  </div>
                  <span class="text-slate-800 dark:text-slate-200 font-bold text-base sm:text-lg">Gina</span>
                </div>
              </td>
              <td class="py-5 px-6 text-right">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 rounded-full font-black text-sm sm:text-base shadow-lg group-hover:scale-105 transition-transform duration-300">
                  <i class="fas fa-fire-flame-curved text-orange-500 text-xs"></i>
                  800
                </span>
              </td>
            </tr>

            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-950/30 dark:hover:to-purple-950/30 transition-all duration-300 cursor-pointer">
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 font-black text-base shadow-lg group-hover:scale-110 transition-transform duration-300">8</span>
                </div>
              </td>
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-sm"></i>
                  </div>
                  <span class="text-slate-800 dark:text-slate-200 font-bold text-base sm:text-lg">Hadi</span>
                </div>
              </td>
              <td class="py-5 px-6 text-right">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 rounded-full font-black text-sm sm:text-base shadow-lg group-hover:scale-105 transition-transform duration-300">
                  <i class="fas fa-fire-flame-curved text-orange-500 text-xs"></i>
                  770
                </span>
              </td>
            </tr>

            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-950/30 dark:hover:to-purple-950/30 transition-all duration-300 cursor-pointer">
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 font-black text-base shadow-lg group-hover:scale-110 transition-transform duration-300">9</span>
                </div>
              </td>
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-400 to-rose-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-sm"></i>
                  </div>
                  <span class="text-slate-800 dark:text-slate-200 font-bold text-base sm:text-lg">Indra</span>
                </div>
              </td>
              <td class="py-5 px-6 text-right">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 rounded-full font-black text-sm sm:text-base shadow-lg group-hover:scale-105 transition-transform duration-300">
                  <i class="fas fa-fire-flame-curved text-orange-500 text-xs"></i>
                  740
                </span>
              </td>
            </tr>

            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-950/30 dark:hover:to-purple-950/30 transition-all duration-300 cursor-pointer">
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 font-black text-base shadow-lg group-hover:scale-110 transition-transform duration-300">10</span>
                </div>
              </td>
              <td class="py-5 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-white text-sm"></i>
                  </div>
                  <span class="text-slate-800 dark:text-slate-200 font-bold text-base sm:text-lg">Joko</span>
                </div>
              </td>
              <td class="py-5 px-6 text-right">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 rounded-full font-black text-sm sm:text-base shadow-lg group-hover:scale-105 transition-transform duration-300">
                  <i class="fas fa-fire-flame-curved text-orange-500 text-xs"></i>
                  700
                </span>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>