<div class="p-6 max-w-3xl mx-auto">

    <h1 class="text-2xl font-semibold mb-6">Pilih Mata Kuliah</h1>

    <form action="<?= BASE_URL ?>user/profile/saveSubjects" method="POST"
          class="bg-white shadow rounded-lg p-6 space-y-6">

        <div class="space-y-4">
            <?php foreach ($subjects as $subject): ?>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" 
                           name="subjects[]" 
                           value="<?= $subject['id_subject'] ?>"
                           <?= in_array($subject['id_subject'], $user_subject_ids) ? 'checked' : '' ?>
                           class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">

                    <span class="text-gray-800 text-lg"><?= $subject['subject_name'] ?></span>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan & Lanjutkan
            </button>
        </div>

    </form>
</div>
