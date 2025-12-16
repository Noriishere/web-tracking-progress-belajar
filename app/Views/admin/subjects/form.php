<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4"><?= isset($subject) ? 'Edit Subject' : 'Add Subject' ?></h1>
    <form method="POST" action="<?= isset($subject) ? BASE_URL . 'admin/subject/update/' . $subject['id_subject'] : BASE_URL . 'admin/subject/store' ?>">
        <div class="mb-4">
            <label class="block text-sm mb-1">Subject Name</label>
            <input type="text" name="subject_name" value="<?= $subject['subject_name'] ?? '' ?>" class="border p-2 rounded w-full" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm mb-1">YouTube Playlist ID</label>
            <input type="text" name="youtube_playlist_id" value="<?= $subject['youtube_playlist_id'] ?? '' ?>" class="border p-2 rounded w-full">
            <p class="text-sm text-gray-500 mt-1">Masukkan ID playlist (contoh: PLx123...)</p>
        </div>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
            <a href="<?= BASE_URL ?>admin/subject" class="px-4 py-2 bg-gray-200 rounded">Cancel</a>
        </div>
    </form>
</div>