<?php
$profile = $data['profile'] ?? null;
?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-gray-100 to-white p-6">
  <div class="bg-white p-8 rounded-xl shadow-lg max-w-lg w-full">
    <h2 class="text-2xl font-bold mb-4 text-center">Lengkapi Profil Kamu</h2>

    <form id="profileForm" class="space-y-4">
      <div>
        <label class="block text-gray-700">Nama Depan</label>
        <input type="text" name="firstname" value="<?= htmlspecialchars($profile['firstname'] ?? '') ?>"
               class="w-full mt-1 p-2 border rounded-lg" required>
      </div>

      <div>
        <label class="block text-gray-700">Nama Belakang</label>
        <input type="text" name="lastname" value="<?= htmlspecialchars($profile['lastname'] ?? '') ?>"
               class="w-full mt-1 p-2 border rounded-lg" required>
      </div>

      <div>
        <label class="block text-gray-700">Tanggal Lahir</label>
        <input type="date" name="birthday" value="<?= htmlspecialchars($profile['birthday'] ?? '') ?>"
               class="w-full mt-1 p-2 border rounded-lg" required>
      </div>

      <div>
        <label class="block text-gray-700">Bio (opsional)</label>
        <textarea name="bio" class="w-full mt-1 p-2 border rounded-lg"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>
      </div>

      <button type="submit" class="w-full bg-[#5465ff] text-white py-2 rounded-lg hover:bg-[#788bff]">Simpan Profil</button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('profileForm').addEventListener('submit', async function(e){
  e.preventDefault();
  const fd = new FormData(this);

  try {
    const res = await fetch("<?= BASE_URL ?>user/profile/save", {
      method: "POST",
      body: fd
    });
    const json = await res.json();
    Swal.fire({
      icon: json.status === 'success' ? 'success' : 'error',
      title: json.message
    }).then(() => {
      if (json.redirect) window.location.href = json.redirect;
    });
  } catch(err) {
    Swal.fire({ icon: 'error', title: 'Gagal menyimpan profil', text: err.message });
  }
});
</script>
