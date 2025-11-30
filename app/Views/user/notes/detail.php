<h1 class="text-3xl font-bold mb-6">Detail Catatan</h1>

<div class="bg-white p-6 rounded-xl shadow space-y-4">
    <p class="text-sm text-gray-500"><?= $note['activity_date'] ?> — <?= $note['word_count'] ?> kata</p>
    <p class="text-gray-800 whitespace-pre-line"><?= $note['content'] ?></p>
</div>

<div class="mt-6 flex gap-4">
    <a href="<?= BASE_URL ?>notes/delete/<?= $note['id_note'] ?>" class="bg-red-600 text-white px-4 py-2 rounded-lg">Hapus</a>
    <a href="<?= BASE_URL ?>notes" class="bg-gray-700 text-white px-4 py-2 rounded-lg">Kembali</a>
</div>
