<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Daftar Mata Kuliah</h1>

        <a href="<?= BASE_URL ?>admin/subject/add" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Tambah Mata Kuliah
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Mata Kuliah</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; foreach($subjects as $subject): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?= $no++ ?></td>
                    <td class="p-3"><?= $subject['subject_name'] ?></td>
                    <td class="p-3 flex gap-2">
                        
                        <a href="<?= BASE_URL ?>admin/subject/edit/<?= $subject['id_subject'] ?>"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Edit
                        </a>

                        <a href="<?= BASE_URL ?>admin/subject/delete/<?= $subject['id_subject'] ?>"
                           onclick="return confirm('Yakin ingin menghapus?')"
                           class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Hapus
                        </a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
