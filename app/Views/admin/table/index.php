<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="font-bold text-3xl my-8">Admin</h1>
    <div class="flex flex-row">
        <div class="row-auto mb-5">
            <button id="btnOpenModal" type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                onclick="openModal()"
                class="rounded-2xl ps-5 pr-5 pt-3 pb-3 font-bold shadow-md transition delay-100 duration-300 ease-in-out hover:scale-105 bg-white">Tambah
                Admin</button>
        </div>
    </div>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">

        <table class="w-full table-fixed text-sm text-left text-gray-700">
            <thead class="bg-gray-50 text-xs text-gray-800 uppercase">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama asli
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y">
                <?php foreach($data['all_user'] as $user) : ?>
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        <?= $user['username']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $user['email']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $user['nama_admin']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $user['role']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Overlay -->
<div id="userModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 opacity-0 pointer-events-none transition-opacity duration-300"
    aria-hidden="true">

    <!-- Modal Card -->
    <div class="w-full max-w-3xl transform rounded-2xl bg-white p-6 shadow-xl transition-all scale-95"
        id="modalContent">

        <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Tambah Pengguna Baru</h2>

        <form action="<?= BASE_URL ?>table/tambah" method="POST" class="space-y-4">

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2.5 text-sm"
                    placeholder="misal: bagas75" required>
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2.5 text-sm"
                    placeholder="misal: Bagas Nurdiansyah" required>
            </div>
            <!-- Email -->
             <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2.5 text-sm"
                    placeholder="misal: bagas@gmail.com" required>
            </div>
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>

                <!-- Bungkus input + tombol 👁️ -->
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2.5 text-sm pr-10"
                        placeholder="••••••••" required>

                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
                        tabindex="-1">
                        👁️
                    </button>
                </div>
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select id="role" name="role"
                    class="w-full rounded-lg border-gray-300 bg-gray-50 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2.5">
                    <option value="admin">Admin</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>



<script>
const pw = document.getElementById('password')
const rpw = document.getElementById('togglePassword')
const myModal = document.getElementById('userModal');
const modalContent = document.getElementById('modalContent');

function openModal() {
    myModal.classList.remove('opacity-0', 'pointer-events-none');
    setTimeout(() => {
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }, 10);
}

function closeModal() {
    modalContent.classList.remove('scale-100');
    modalContent.classList.add('scale-95');
    setTimeout(() => {
        myModal.classList.add('opacity-0', 'pointer-events-none');
    }, 300);
}

function reveal () {
    pw.type = "text"
    setTimeout(()=>{
        pw.type = "password"
    },300)
}
rpw.addEventListener('click', reveal)

</script>