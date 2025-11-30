<h1 class="text-3xl font-bold mb-6">Tambah Catatan</h1>

<form action="<?= BASE_URL ?>notes/store" method="POST" class="bg-white p-6 rounded-xl shadow space-y-4">
    <textarea name="content" rows="8" class="w-full border-gray-300 rounded-lg p-3" placeholder="Tulis catatan belajar Anda..."></textarea>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
        Simpan Catatan
    </button>
</form>
