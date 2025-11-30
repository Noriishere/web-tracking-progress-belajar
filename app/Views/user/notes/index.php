<h1 class="text-3xl font-bold mb-6">Catatan Saya</h1>

<a href="<?= BASE_URL ?>notes/add" class="bg-indigo-600 text-white px-4 py-2 rounded-lg mb-6 inline-block">
    + Buat Catatan
</a>

<div class="space-y-4">
    <?php foreach ($notes as $note): ?>
        <a href="<?= BASE_URL ?>notes/detail/<?= $note['id_note'] ?>" class="block bg-white p-4 rounded-xl shadow border-l-4 border-indigo-500">
            <p class="text-sm text-gray-500"><?= $note['activity_date'] ?> — <?= $note['word_count'] ?> kata</p>
            <p class="text-gray-800 font-medium"><?= substr($note['content'], 0, 120) ?>...</p>
        </a>
    <?php endforeach; ?>
</div>
