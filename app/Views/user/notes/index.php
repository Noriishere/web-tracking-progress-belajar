<h1 class="text-2xl font-bold text-textcolor dark:text-textcolor-dark mb-2">
    Catatan Belajar
</h1>
<p class="text-textcolor-muted dark:text-textcolor-muted-dark mb-6">
    Semua catatan dari aktivitas belajarmu ✍️
</p>

<a href="<?= BASE_URL ?>user/sessions/youtube"
    class="inline-flex items-center gap-2
          bg-brand-500/10 hover:bg-brand-500/20
          border border-bordercolor dark:border-bordercolor-dark
          text-textcolor dark:text-textcolor-dark
          px-5 py-2.5 rounded-xl
          shadow-sm transition mb-8
          hover:scale-[1.02] active:scale-95">

    <i class="fa-solid fa-plus"></i>
    <span class="font-medium">Buat Catatan Baru</span>

</a>


<?php if (empty($notes)): ?>
    <!-- EMPTY STATE -->
    <div class="bg-card dark:bg-card-dark 
                border border-dashed border-bordercolor dark:border-bordercolor-dark 
                rounded-xl p-8 text-center 
                text-textcolor-muted dark:text-textcolor-muted-dark">
        <p class="font-medium mb-1">Belum ada catatan</p>
        <p class="text-sm">Mulai belajar dan buat catatan pertamamu 🚀</p>
    </div>
<?php else: ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-8">

        <?php foreach ($notes as $note): ?>
            <a href="<?= BASE_URL ?>user/notes/detail/<?= $note['id_note'] ?>"
                class="group relative overflow-hidden
                      bg-card dark:bg-card-dark
                      border border-bordercolor dark:border-bordercolor-dark
                      rounded-xl p-5 shadow-sm
                      hover:border-brand-500/60
                      transition">

                <!-- Accent Bar -->
                <div class="absolute left-0 top-0 h-full w-1 bg-brand-500"></div>

                <!-- Meta -->
                <div class="flex items-center justify-between mb-2 text-xs
                            text-textcolor-muted dark:text-textcolor-muted-dark">
                    <span><?= htmlspecialchars($note['activity_date']) ?></span>
                    <span class="px-2 py-0.5 rounded-full
                                 bg-brand-500/10 text-brand-500">
                        <?= (int)$note['word_count'] ?> kata
                    </span>
                </div>

                <!-- Content Preview -->
                <p class="text-textcolor dark:text-textcolor-dark 
                          font-medium leading-relaxed mb-3">
                    <?= htmlspecialchars(mb_strimwidth(strip_tags($note['content']), 0, 120, '…')) ?>
                </p>

                <!-- Footer -->
                <div class="flex items-center justify-between text-sm
                            text-textcolor-muted dark:text-textcolor-muted-dark">
                    <span>Lihat detail</span>
                    <span class="group-hover:translate-x-1 transition">→</span>
                </div>

            </a>
        <?php endforeach; ?>

    </div>

<?php endif; ?>