<h1 class="text-3xl font-extrabold mb-8 tracking-tight text-gray-900 dark:text-white">Detail Catatan</h1>

<div class="bg-white dark:bg-gray-900 p-6 sm:p-8 rounded-2xl shadow-xl space-y-4 border border-gray-100 dark:border-gray-800 transition-all">
    <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
        <span class="inline-flex items-center gap-1">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m4 4V3m-6 8a6 6 0 1112 0 6 6 0 01-12 0zm8 11h-.01"/></svg>
            <?= $note['activity_date'] ?>
        </span>
        <span>—</span>
        <span class="inline-flex items-center gap-1">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2 7h16M2 13h16M7 7v6a2 2 0 002 2h2a2 2 0 002-2V7"/></svg>
            <?= $note['word_count'] ?> kata
        </span>
    </div>
    <div class="text-lg text-gray-800 dark:text-gray-100 whitespace-pre-line">
        <?= $note['content'] ?>
    </div>
</div>

<div class="mt-8 flex flex-wrap gap-4">
    <a href="<?= BASE_URL ?>user/notes/delete/<?= $note['id_note'] ?>"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold shadow transition
       focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
       onclick="return confirm('Yakin hapus catatan ini?');">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        Hapus
    </a>
    <a href="<?= BASE_URL ?>user/notes/index"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gray-100 hover:bg-gray-200 active:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-50 font-medium shadow-sm transition
       focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
        Kembali
    </a>
</div>