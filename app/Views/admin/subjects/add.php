<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-semibold mb-6">Tambah Mata Kuliah</h1>

    <form action="<?= BASE_URL ?>admin/subject/store" method="POST"
          class="bg-white shadow rounded-lg p-6 space-y-4">

        <div>
            <label class="block mb-2 text-gray-700">Nama Mata Kuliah</label>
            <input type="text" name="subject_name" required
                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div class="flex justify-end gap-3">
            <a href="<?= BASE_URL ?>admin/subject"
               class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                Batal
            </a>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
