<?php
$profile = $data['profile'] ?? null;
$subjects = $data['subjects'] ?? [];
$user_subject_ids = $data['user_subject_ids'] ?? [];
$title = 'Profile | Mine';
$pageTitle = 'Profile';
?>
<div class="w-full max-w-4xl mx-auto mt-8 rounded-2xl">
  <!-- TABS -->
  <div class="w-full mb-4">
    <ul class="hidden sm:flex items-center gap-2 border-b border-gray-200 dark:border-gray-700 px-1 relative">
      <?php
      $tabList = [
        ['id' => 'profile', 'label' => 'Profile'],
        ['id' => 'notif', 'label' => 'Notification'],
        ['id' => 'security', 'label' => 'Security']
      ];
      foreach ($tabList as $t): ?>
        <li>
          <button
            onclick="setTab('<?= $t['id'] ?>')"
            id="tab-<?= $t['id'] ?>"
            class="tab-btn relative py-2 px-5 font-medium group text-gray-500 dark:text-gray-400 border-b-2 border-transparent transition
            hover:text-blue-600 dark:hover:text-blue-400
            focus:outline-none">
            <?= $t['label'] ?>
            <span
              class="absolute -bottom-[2px] left-1/2 -translate-x-1/2 w-0 h-[3px] 
            bg-blue-500 dark:bg-blue-400 group-hover:w-4/5 transition-all duration-300 rounded-full pointer-events-none"></span>
          </button>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="sm:hidden">
      <select id="mobileTab" onchange="setTab(this.value)"
        class="block w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 active:scale-[.98] transition">
        <option value="profile">Profile</option>
        <option value="notif">Notification</option>
        <option value="security">Security</option>
      </select>
    </div>
  </div>
  <!-- TAB CONTENT -->
  <div class="relative">
    <!-- Profile TAB -->
    <div id="content-profile">
      <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 px-6 py-8 transition-all animate-fadein">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2 tracking-tight">Lengkapi Profil Kamu</h2>
        <p class="mb-6 text-gray-500 dark:text-gray-400 text-base">Informasi ini digunakan untuk personalisasi akun kamu.</p>
        <form id="profileForm" class="space-y-6" enctype="multipart/form-data" autocomplete="off">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Nama Depan</label>
              <input type="text" name="firstname"
                value="<?= htmlspecialchars($profile['firstname'] ?? '') ?>"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white shadow-inner
                       focus:(border-blue-500 ring-2 ring-blue-300) transition-all duration-200 outline-none" />
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Nama Belakang</label>
              <input type="text" name="lastname"
                value="<?= htmlspecialchars($profile['lastname'] ?? '') ?>"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white shadow-inner
                       focus:(border-blue-500 ring-2 ring-blue-300) transition-all duration-200 outline-none" />
            </div>
          </div>
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Tanggal Lahir</label>
            <input type="date" name="birthday"
              value="<?= htmlspecialchars($profile['birthday'] ?? '') ?>"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white shadow-inner
                     focus:(border-blue-500 ring-2 ring-blue-300) transition-all duration-200 outline-none" />
          </div>
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Bio</label>
            <textarea name="bio" rows="4"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white shadow-inner
                     focus:(border-blue-500 ring-2 ring-blue-300) transition-all duration-200 outline-none resize-none"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>
          </div>
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Foto Profil</label>
            <div class="flex items-center gap-5 mb-3">
              <img id="previewProfile"
                src="<?= ($profile && $profile['image'])
                        ? BASE_URL . 'img/uploads/' . htmlspecialchars($profile['image'])
                        : BASE_URL . 'img/default-profile.png' ?>"
                class="w-20 h-20 object-cover rounded-full border-2 border-gray-300 dark:border-gray-700 shadow-lg transition-transform duration-300 hover:scale-105" />
              <label class="inline-block px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 active:scale-[.97] text-white font-medium shadow-lg cursor-pointer transition-all duration-200">
                Pilih Foto
                <input type="file" name="image" id="profileInput" accept="image/*" class="hidden" />
              </label>
            </div>
            <span class="text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG, WEBP — Max 2MB</span>
          </div>
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
            Pilih Mata Kuliah
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php foreach ($subjects as $i => $subject): ?>
              <label
                class="subject-item flex items-center gap-4 p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800
                 cursor-pointer transition-all duration-300 translate-y-4 mb-2"
                style="transition-delay: <?= $i * 80 ?>ms">

                <input type="checkbox"
                  name="subjects[]"
                  value="<?= $subject['id_subject'] ?>"
                  <?= in_array($subject['id_subject'], $user_subject_ids) ? 'checked' : '' ?>
                  class="w-5 h-5 text-blue-600 rounded border-gray-300 accent-blue-600">

                <span class="text-gray-800 dark:text-gray-100 font-medium">
                  <?= htmlspecialchars($subject['subject_name']) ?>
                </span>
              </label>
            <?php endforeach; ?>
          </div>
          <button type="submit"
            class="w-full py-3 rounded-lg bg-blue-600 hover:bg-blue-700 active:scale-[.98] text-white font-bold shadow-lg transition-transform duration-200 tracking-wide group relative overflow-hidden">
            <span class="group-hover:opacity-80">Simpan Profil</span>
            <span class="absolute right-5 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity"><svg width="18" height="18" fill="currentColor" class="inline text-white">
                <path d="M12.293 6.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L13.586 11H7a1 1 0 110-2h6.586l-1.293-1.293a1 1 0 010-1.414z" />
              </svg></span>
          </button>
        </form>
      </section>

    </div>
    <!-- Notification TAB -->
    <div id="content-notif" class="hidden">
      <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 px-6 py-8 transition-all animate-fadein">
        <div class="md:grid md:grid-cols-2 gap-6">
          <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2 tracking-tight">Notification Setting</h2>
            <p class="mb-4 text-gray-500 dark:text-gray-400">Atur notifikasi yang ingin kamu terima</p>
          </div>
          <div>
            <form class="space-y-6">
              <label class="flex items-center justify-between p-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 cursor-pointer transition duration-200
              hover:(bg-blue-50 dark:bg-blue-900 shadow-md scale-105)">
                <div>
                  <p class="font-medium text-gray-900 dark:text-white">Email Notification</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Notifikasi melalui Email</p>
                </div>
                <input type="checkbox" class="w-5 h-5 text-blue-600 focus:ring-2 focus:ring-blue-400 rounded border-gray-300 dark:border-gray-700 bg-gray-200 dark:bg-gray-900 transition-all duration-200 cursor-pointer accent-blue-500" />
              </label>
              <label class="flex items-center justify-between p-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 cursor-pointer transition duration-200
              hover:(bg-blue-50 dark:bg-blue-900 shadow-md scale-105)">
                <div>
                  <p class="font-medium text-gray-900 dark:text-white">Push Notification</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Notifikasi Device</p>
                </div>
                <input type="checkbox" id="pushNotification" class="w-5 h-5 text-blue-600 focus:ring-2 focus:ring-blue-400 rounded border-gray-300 dark:border-gray-700 bg-gray-200 dark:bg-gray-900 transition-all duration-200 cursor-pointer accent-blue-500" />
              </label>
              <button type="submit"
                class="w-full py-3 px-10 bg-blue-600 hover:bg-blue-700 active:scale-[.98] text-white font-bold shadow-lg rounded-lg transition-transform duration-200 tracking-wide group relative overflow-hidden">
                <span class="group-hover:opacity-80">Save Notification</span>
                <span class="absolute right-8 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity"><svg width="18" height="18" fill="currentColor" class="inline text-white">
                    <path d="M12.293 6.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L13.586 11H7a1 1 0 110-2h6.586l-1.293-1.293a1 1 0 010-1.414z" />
                  </svg></span>
              </button>
            </form>
          </div>
        </div>
      </section>
    </div>
    <!-- Security TAB -->
    <div id="content-security" class="hidden">
      <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 px-6 py-8 transition-all animate-fadein">
        <div class="md:grid md:grid-cols-2 gap-6">
          <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2 tracking-tight">Security Setting</h2>
            <p class="mb-4 text-gray-500 dark:text-gray-400">Password & Keamanan Akun</p>
          </div>
          <div>
            <form class="space-y-6">
              <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Old Password</label>
                <input type="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:(border-red-500 ring-2 ring-red-300) shadow-inner transition-all duration-200 outline-none" />
              </div>
              <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">New Password</label>
                <input type="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:(border-blue-500 ring-2 ring-blue-300) shadow-inner transition-all duration-200 outline-none" />
              </div>
              <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Confirm Password</label>
                <input type="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:(border-blue-500 ring-2 ring-blue-300) shadow-inner transition-all duration-200 outline-none" />
              </div>
              <div class="pt-5 space-y-3">
                <button type="submit"
                  class="w-full py-3 px-10 bg-blue-600 hover:bg-blue-700 active:scale-[.98] text-white font-bold rounded-lg shadow-lg transition-transform duration-200 tracking-wide group relative overflow-hidden">
                  <span class="group-hover:opacity-80">Save Password</span>
                  <span class="absolute right-8 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity"><svg width="18" height="18" fill="currentColor" class="inline text-white">
                      <path d="M12.293 6.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L13.586 11H7a1 1 0 110-2h6.586l-1.293-1.293a1 1 0 010-1.414z" />
                    </svg></span>
                </button>
                <button type="button" onclick="openDeleteModal()"
                  class="w-full py-3 px-8 bg-red-600 hover:bg-red-700 active:scale-[.97] text-white font-bold rounded-lg shadow-lg transition-transform duration-200 group relative overflow-hidden">
                  <span class="group-hover:opacity-80">Delete Account</span>
                  <span class="absolute right-8 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg width="18" height="18" fill="currentColor" class="inline text-white">
                      <path d="M9 4a5 5 0 015 5v1h1a1 1 0 110 2h-1v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4H4a1 1 0 110-2h1V9a5 5 0 014-5zm1 7v-2a1 1 0 10-2 0v2a1 1 0 102 0z"></path>
                    </svg>
                  </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- MODAL -->
<div id="popup-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-md animate-fadein">
  <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 p-7 rounded-2xl max-w-md w-full mx-3 shadow-2xl animate-fadeinscale">
    <h3 class="mb-4 font-semibold text-xl text-gray-900 dark:text-white">Masukkan Password</h3>
    <input type="password" id="deletePassword" placeholder="Password"
      class="w-full px-4 py-3 border rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-red-400 transition mb-2 shadow-inner" />
    <p id="deleteError" class="hidden text-red-500 dark:text-red-400 text-sm mt-1">Password minimal 6 karakter.</p>
    <div class="flex justify-end gap-4 mt-8">
      <button onclick="confirmDelete()"
        class="px-6 py-2 bg-red-600 hover:bg-red-700 active:scale-95 text-white font-bold rounded-lg shadow transition relative overflow-hidden group">
        <span class="group-hover:opacity-80">Yes, Delete</span>
        <span class="absolute right-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity"><svg width="16" height="16" fill="currentColor" class="inline text-white">
            <path d="M9 4a5 5 0 015 5v1h1a1 1 0 110 2h-1v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4H4a1 1 0 110-2h1V9a5 5 0 014-5zm1 7v-2a1 1 0 10-2 0v2a1 1 0 102 0z"></path>
          </svg></span>
      </button>
      <button onclick="closeDeleteModal()"
        class="px-6 py-2 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 active:scale-95 font-bold shadow transition">
        Cancel
      </button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // --- Tab logic ---
  const tabs = ['profile', 'notif', 'security'];
  const storageKey = 'activeTabSettings';

  function setTab(tab) {
    localStorage.setItem(storageKey, tab);
    tabs.forEach(t => {
      document.getElementById("content-" + t).classList.toggle("hidden", t !== tab);
      const btn = document.getElementById("tab-" + t);
      if (btn) {
        // active visual: border+font+underline anim
        btn.classList.toggle("border-blue-600", t === tab);
        btn.classList.toggle("dark:border-blue-400", t === tab);
        btn.classList.toggle("text-blue-600", t === tab);
        btn.classList.toggle("dark:text-blue-400", t === tab);
        btn.classList.toggle("font-bold", t === tab);
        // animated custom line under tab
        const line = btn.querySelector('span');
        if (line) {
          line.classList.toggle('w-4/5', t === tab);
          line.classList.toggle('w-0', t !== tab);
        }
      }
    });
    const mobile = document.getElementById("mobileTab");
    if (mobile) mobile.value = tab;
  }
  document.addEventListener("DOMContentLoaded", () =>
    setTab(localStorage.getItem(storageKey) || "profile")
  );

  // --- Profile preview ---
  document.getElementById("profileInput").addEventListener("change", function() {
    const file = this.files[0];
    if (!file) return;
    document.getElementById("previewProfile").src = URL.createObjectURL(file);
  });

  // --- Modal logic ---
  const deleteModal = document.getElementById("popup-modal");
  const deletePassword = document.getElementById("deletePassword");
  const deleteError = document.getElementById("deleteError");

  function openDeleteModal() {
    deleteModal.classList.remove("hidden");
    setTimeout(() => deletePassword.focus(), 100);
  }

  function closeDeleteModal() {
    deleteModal.classList.add("hidden");
    deletePassword.value = "";
    deleteError.classList.add("hidden");
  }

  function confirmDelete() {
    if (deletePassword.value.length < 6) {
      deleteError.classList.remove("hidden");
      return;
    }
    deleteError.classList.add("hidden");
    Swal.fire({
      icon: 'success',
      title: 'Akun berhasil dihapus',
      text: 'Akun Anda telah dihapus dari sistem',
      confirmButtonColor: '#ef4444'
    });
    closeDeleteModal();
  }
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) closeDeleteModal();
  });

  // --- Profile form submission ---
  document.getElementById("profileForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const checkedSubjects = document.querySelectorAll('input[name="subjects[]"]:checked');
    if (checkedSubjects.length === 0) {
      Swal.fire({
        icon: "warning",
        title: "Mata kuliah wajib dipilih",
        text: "Minimal pilih satu mata kuliah sebelum menyimpan profil",
        confirmButtonColor: "#3b82f6"
      });

      document.querySelector('input[name="subjects[]"]').scrollIntoView({
        behavior: "smooth",
        block: "center"
      });

      return;
    }

    const fd = new FormData(this);

    try {
      const res = await fetch("<?= BASE_URL ?>user/profile/save", {
        method: "POST",
        body: fd
      });

      // <<== Tambahkan proses response JSON di sini:
      const json = await res.json();

      if (json.status === "success" || json.status === "ok") {
        Swal.fire({
          icon: "success",
          title: "Profil berhasil disimpan!",
          text: json.message || "Perubahan profil kamu sudah tersimpan.",
          confirmButtonColor: "#3b82f6"
        }).then(() => {
          // Redirect jika ingin:
          if (json.redirect) {
            window.location.href = json.redirect;
          }
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Gagal menyimpan profil",
          text: json.message || "Terjadi kesalahan.",
          confirmButtonColor: "#ef4444"
        });
      }

    } catch (error) {
      console.error("Error submitting profile form:", error);
      Swal.fire({
        icon: "error",
        title: "Terjadi kesalahan",
        text: "Gagal menyimpan profil. Silakan coba lagi.",
        confirmButtonColor: "#ef4444"
      });
    }
    const pushCheckbox = document.getElementById('pushNotification');

    if ('serviceWorker' in navigator && 'PushManager' in window && pushCheckbox) {
      navigator.serviceWorker.ready.then(async registration => {
        try {
          const existingSub = await registration.pushManager.getSubscription();
          if (existingSub) {
            pushCheckbox.checked = true;
          }
        } catch (err) {
          console.error('Check subscription error:', err);
        }

        pushCheckbox.addEventListener('change', async () => {
          if (pushCheckbox.checked) {
            await subscribePush(registration);
          } else {
            await unsubscribePush(registration);
          }
        });
      });
    }

    async function subscribePush(registration) {
      try {
        const permission = await Notification.requestPermission();
        if (permission !== 'granted') {
          throw new Error('Permission denied');
        }

        const keyRes = await fetch("<?= BASE_URL ?>push/public-key");
        if (!keyRes.ok) throw new Error('Failed to get public key');

        const {
          publicKey
        } = await keyRes.json();

        const subscription = await registration.pushManager.subscribe({
          userVisibleOnly: true,
          applicationServerKey: urlBase64ToUint8Array(publicKey)
        });

        const saveRes = await fetch("<?= BASE_URL ?>user/push/subscribe", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(subscription)
        });

        if (!saveRes.ok) throw new Error('Failed to save subscription');

        Swal.fire({
          icon: "success",
          title: "Push Notification Aktif",
          text: "Notifikasi device berhasil diaktifkan",
          confirmButtonColor: "#3b82f6"
        });

      } catch (error) {
        console.error('Subscribe error:', error);

        pushCheckbox.checked = false;

        Swal.fire({
          icon: "error",
          title: "Gagal mengaktifkan notifikasi",
          text: error.message || "Terjadi kesalahan",
          confirmButtonColor: "#ef4444"
        });
      }
    }

    async function unsubscribePush(registration) {
      try {
        const subscription = await registration.pushManager.getSubscription();
        if (!subscription) return;

        await fetch("<?= BASE_URL ?>user/push/unsubscribe", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            endpoint: subscription.endpoint
          })
        });

        await subscription.unsubscribe();

        Swal.fire({
          icon: "success",
          title: "Push Notification Dimatikan",
          confirmButtonColor: "#3b82f6"
        });

      } catch (error) {
        console.error('Unsubscribe error:', error);

        pushCheckbox.checked = true;

        Swal.fire({
          icon: "error",
          title: "Gagal mematikan notifikasi",
          confirmButtonColor: "#ef4444"
        });
      }
    }

    function urlBase64ToUint8Array(base64String) {
      const padding = '='.repeat((4 - base64String.length % 4) % 4);
      const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
      const rawData = atob(base64);
      return Uint8Array.from([...rawData].map(c => c.charCodeAt(0)));
    }
  });
</script>
<!-- SIMPLE FADE-IN ANIMATION (vanilla!) -->
<style>
  @keyframes fadein {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @keyframes fadeinscale {
    from {
      opacity: 0;
      transform: scale(.96);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .animate-fadein {
    animation: fadein .5s cubic-bezier(.23, 1.02, .52, .97);
  }

  .animate-fadeinscale {
    animation: fadeinscale .45s cubic-bezier(.23, 1.02, .52, .97);
  }
</style>