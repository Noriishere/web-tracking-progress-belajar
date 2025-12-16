<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manage Subjects</h1>
        <a href="<?= BASE_URL ?>admin/subject/add" class="px-4 py-2 bg-indigo-600 text-white rounded">Add Subject</a>
    </div>
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Subject</th>
                    <th class="p-3">Playlist ID</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $s): ?>
                    <tr class="border-t">
                        <td class="p-3"><?= $s['id_subject'] ?></td>
                        <td class="p-3"><?= htmlspecialchars($s['subject_name']) ?></td>
                        <td class="p-3"><?= htmlspecialchars($s['youtube_playlist_id']) ?></td>
                        <td class="p-3">
                            <a href="<?= BASE_URL ?>admin/subject/edit/<?= $s['id_subject'] ?>" class="px-3 py-1 bg-yellow-400 rounded mr-2">Edit</a>
                            <a href="<?= BASE_URL ?>admin/subject/delete/<?= $s['id_subject'] ?>" class="px-3 py-1 bg-red-500 text-white rounded" onclick="return confirm('Delete subject?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>