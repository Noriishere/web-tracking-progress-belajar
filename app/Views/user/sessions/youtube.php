<?php
$notes = $notes ?? [];
$subjects = $subjects ?? [];
$subjectMeta = $subjectMeta ?? [];
?>

<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Sidebar Mata Kuliah -->
    <aside class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 space-y-5 transition-all">
        <h2 class="text-lg font-bold mb-2 text-gray-900 dark:text-gray-100">Pilih Mata Kuliah</h2>
        <select id="subjectSelect"
            class="w-full p-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-100 font-medium focus:ring-2 focus:ring-blue-400 transition-all">
            <option value="">-- pilih mata kuliah --</option>
            <?php foreach ($subjects as $s): ?>
                <option id="playlist" value="<?= $s['youtube_playlist_id'] ?>" data-id="<?= $s['subject_id'] ?>">
                    <?= htmlspecialchars($s['subject_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <p id="playlistStatus" class="text-xs text-blue-600 min-h-[1.5em] transition"></p>

        <div id="playlistGrid"
            class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 gap-3 max-h-[63vh] overflow-y-auto pr-2">
        </div>
    </aside>

    <!-- Main Panel Video & Catatan -->
    <main class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 lg:col-span-2 space-y-6 transition">
        <div class="aspect-video w-full mb-3 bg-black rounded-xl overflow-hidden border border-gray-300 dark:border-gray-800 shadow">
            <div id="player" class="w-full h-full"></div>
        </div>

        <div class="flex items-center gap-3">
            <p id="statusLock" class="text-sm font-semibold text-red-600">Status: Belum memutar video</p>
            <p id="progressInfo" class="text-sm text-gray-700 dark:text-gray-200"></p>
        </div>
        <div class="relative h-3 bg-gray-100 dark:bg-gray-700 rounded-full mb-4 shadow-inner overflow-hidden">
            <div id="progressBar"
                class="h-full bg-gradient-to-r from-green-400 to-green-600 w-0 rounded-full transition-all duration-500 shadow-lg"></div>
        </div>

        <div id="saveRequirements" class="mb-4 p-4 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-600 rounded-xl">
            <p class="text-xs font-bold text-blue-700 dark:text-blue-300 mb-1">Persyaratan untuk menyimpan:</p>
            <ul class="text-xs text-blue-800 dark:text-blue-200 space-y-2">
                <li id="req-video" class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full flex items-center justify-center bg-gray-300 transition-all duration-200"></span>
                    Tonton video sampai selesai (minimal 90%)
                </li>
                <li id="req-notes" class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full flex items-center justify-center bg-gray-300 transition-all duration-200"></span>
                    Tulis catatan minimal 10 kata
                </li>
            </ul>
        </div>

        <button id="saveActivityBtn"
            class="px-6 py-3 text-base font-bold rounded-xl bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 transition 
            text-white shadow-md mb-4 hidden opacity-60 cursor-not-allowed active:scale-[.97] duration-150"
            disabled>
            Simpan Aktivitas Belajar
        </button>

        <!-- Notification Toast -->
        <div id="toast" class="hidden fixed top-6 right-6 bg-green-500 text-white px-7 py-4 rounded-lg shadow-2xl z-[9999] transition-all duration-300 animate-slidein">
            <div class="flex items-center gap-3">
                <span id="toastIcon" class="text-2xl font-bold"></span>
                <p id="toastMessage" class="font-medium"></p>
            </div>
        </div>

        <h3 class="text-lg font-bold mb-2 text-gray-900 dark:text-gray-100">Catatan Belajar</h3>
        <select id="noteSelect"
            class="w-full border p-3 rounded-lg mb-2 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-400 font-medium transition-all">
            <option value="">Catatan Baru</option>
            <?php foreach ($notes as $n): ?>
                <option value="<?= $n['id_note'] ?>">
                    <?= substr(strip_tags($n['content']), 0, 30) ?>...
                </option>
            <?php endforeach; ?>
        </select>
        <textarea id="noteEditor"></textarea>
    </main>
</div>

<!-- Animation for toast -->
<style>
    @keyframes slidein {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slidein {
        animation: slidein .5s cubic-bezier(.22, .95, .58, 1.11);
    }
</style>

<!-- TinyMCE CDN -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>

<script>
    const apiKey = "<?= YOUTUBE_API_KEY ?>";
    const BASE = "<?= BASE_URL ?>";

    let currentPlaylistVideos = [];
    let currentVideoId = null;
    let currentSubjectId = null;
    let currentTitle = "";
    let noteId = null;
    let watchedSeconds = new Set();
    let lastSafeTime = 0;
    let userHasTyped = false;
    let lastSavedContent = "";
    let videoFinished = false;
    let videoDuration = 0;
    let legitimatelyWatched = false;

    let player = null;
    let playerReady = false;
    let editorReady = false;

    const subjectSelect = document.getElementById("subjectSelect");
    const playlistGrid = document.getElementById("playlistGrid");
    const playlistStatus = document.getElementById("playlistStatus");
    const progressBar = document.getElementById("progressBar");
    const progressInfo = document.getElementById("progressInfo");
    const statusLock = document.getElementById("statusLock");
    const saveActivityBtn = document.getElementById("saveActivityBtn");
    const noteSelect = document.getElementById("noteSelect");

    // Initialize TinyMCE
    tinymce.init({
        selector: '#noteEditor',
        height: 250,
        menubar: false,
        statusbar: false,
        plugins: 'lists',
        toolbar: 'bold italic | bullist numlist | undo redo',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
        setup: function(editor) {
            editor.on('init', function() {
                editorReady = true;
                console.log('TinyMCE initialized');
            });
            editor.on('keyup change', function() {
                userHasTyped = true;
                checkSaveRequirements();
            });
        }
    });

    subjectSelect.addEventListener("change", async () => {
        const opt = subjectSelect.options[subjectSelect.selectedIndex];
        const playlistId = opt.value;
        currentSubjectId = opt.dataset.id;

        if (!playlistId) {
            playlistGrid.innerHTML = "";
            playlistStatus.textContent = "Tidak ada playlist";
            return;
        }

        playlistStatus.textContent = "Mengambil playlist...";

        const fd = new FormData();
        fd.append("playlist_id", playlistId);

        const res = await fetch(BASE + "user/sessions/getPlaylistVideos", {
            method: "POST",
            body: fd
        });

        const data = await res.json();
        currentPlaylistVideos = [];
        playlistGrid.innerHTML = "";

        (data.items || []).forEach((v, i) => {
            const vid = v.contentDetails?.videoId ?? v.snippet?.resourceId?.videoId;
            const title = v.snippet?.title || "Video tanpa judul";
            const thumb = v.snippet?.thumbnails?.medium?.url ||
                v.snippet?.thumbnails?.high?.url ||
                v.snippet?.thumbnails?.default?.url ||
                "https://via.placeholder.com/320x180?text=No+Thumbnail";

            currentPlaylistVideos.push({
                vid,
                title
            });

            const box = document.createElement("div");
            box.className =
                "cursor-pointer border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 shadow-sm hover:shadow-lg hover:border-blue-500 dark:hover:border-blue-400 hover:scale-[1.03] focus:outline-none transition duration-200 overflow-hidden";
            box.tabIndex = 0;
            box.innerHTML = `
                <img src="${thumb}" class="w-full h-24 object-cover">
                <div class="p-2 text-xs font-semibold text-gray-800 dark:text-gray-100 line-clamp-2">${title}</div>
            `;
            box.onclick = () => loadVideo(vid, title);
            playlistGrid.appendChild(box);

            // Autoplay video pertama setelah player siap
            if (i === 0) {
                const wait = setInterval(() => {
                    if (playerReady) {
                        clearInterval(wait);
                        loadVideo(vid, title);
                    }
                }, 200);
            }
        });

        playlistStatus.textContent = "Playlist siap.";
    });

    function loadVideo(vid, title) {
        currentVideoId = vid;
        currentTitle = title;
        videoFinished = false;
        legitimatelyWatched = false;
        videoDuration = 0;
        if (!playerReady || !player) return;
        watchedSeconds.clear();
        lastSafeTime = 0;
        player.loadVideoById(vid);
        statusLock.textContent = "Status: Memutar (anti-skip aktif)";
        updateRequirementUI('video', false);
        checkSaveRequirements();
    }

    function onYouTubeIframeAPIReady() {
        player = new YT.Player("player", {
            height: "100%",
            width: "100%",
            videoId: "",
            playerVars: {
                autoplay: 0,
                controls: 1,
                disablekb: 1,
                rel: 0
            },
            events: {
                onReady: function() {
                    playerReady = true;
                    console.log('YouTube player ready');
                },
                onStateChange: onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(e) {
        if (e.data === YT.PlayerState.PLAYING && videoDuration === 0) {
            videoDuration = Math.floor(player.getDuration() || 0);
        }
        if (e.data === YT.PlayerState.ENDED) {
            // Cek apakah user benar-benar menonton minimal 90% video
            const watchedCount = watchedSeconds.size;
            const requiredWatch = Math.floor(videoDuration * 0.9);
            if (watchedCount >= requiredWatch) {
                videoFinished = true;
                legitimatelyWatched = true;
                statusLock.textContent = "Video selesai - requirement terpenuhi ✓";
                updateRequirementUI('video', true);
            } else {
                videoFinished = false;
                legitimatelyWatched = false;
                statusLock.textContent = `Video selesai tapi hanya ${watchedCount}/${videoDuration} detik (perlu ${requiredWatch}+ detik)`;
                updateRequirementUI('video', false);
                alert("⚠ Tonton video dengan lengkap, jangan di-skip!");
            }
            checkSaveRequirements();
        }
    }

    function checkSaveRequirements() {
        if (!currentVideoId || !currentSubjectId) {
            saveActivityBtn.classList.add("hidden");
            return;
        }

        const editor = tinymce.get("noteEditor");
        if (!editor) {
            console.log('Editor not ready yet');
            return;
        }

        const content = editor.getContent({
            format: "text"
        }).trim();
        const wordCount = countWords(content);
        const hasEnoughWords = wordCount >= 10;
        updateRequirementUI('notes', hasEnoughWords);

        if (!videoFinished && videoDuration > 0) {
            const watchedCount = watchedSeconds.size;
            const requiredWatch = Math.floor(videoDuration * 0.9);
            if (watchedCount >= requiredWatch && !legitimatelyWatched) {
                legitimatelyWatched = true;
                videoFinished = true;
                updateRequirementUI('video', true);
                statusLock.textContent = "Requirement video terpenuhi ✓";
            }
        }

        // Enable button only if BOTH requirements are met
        if (legitimatelyWatched && hasEnoughWords) {
            saveActivityBtn.classList.remove("hidden", "opacity-60", "cursor-not-allowed");
            saveActivityBtn.disabled = false;
        } else {
            saveActivityBtn.classList.remove("hidden");
            saveActivityBtn.classList.add("opacity-60", "cursor-not-allowed");
            saveActivityBtn.disabled = true;
        }
    }

    function updateRequirementUI(type, completed) {
        const el = document.querySelector(`#req-${type} span`);
        if (!el) return;
        if (completed) {
            el.classList.remove('bg-gray-300');
            el.classList.add('bg-green-500');
            el.innerHTML = '✓';
            el.classList.add('text-white', 'text-xs', 'flex', 'items-center', 'justify-center');
        } else {
            el.classList.remove('bg-green-500', 'text-white');
            el.classList.add('bg-gray-300');
            el.innerHTML = '';
        }
    }

    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");
        const toastMessage = document.getElementById("toastMessage");
        const toastIcon = document.getElementById("toastIcon");
        toastMessage.textContent = message;
        toast.classList.remove("bg-green-500", "bg-yellow-500", "bg-red-500", "bg-blue-500");
        if (type === "success") {
            toast.classList.add("bg-green-500");
            toastIcon.textContent = "✓";
        } else if (type === "warning") {
            toast.classList.add("bg-yellow-500");
            toastIcon.textContent = "⚠";
        } else if (type === "error") {
            toast.classList.add("bg-red-500");
            toastIcon.textContent = "✕";
        } else if (type === "info") {
            toast.classList.add("bg-blue-500");
            toastIcon.textContent = "💾";
        }
        toast.classList.remove("hidden");
        toast.style.opacity = "1";
        setTimeout(() => {
            toast.style.opacity = "0";
            setTimeout(() => {
                toast.classList.add("hidden");
            }, 300);
        }, 3000);
    }

    // Anti-skip enforcement
    const ANTI_SKIP_INTERVAL = 250,
        MAX_FORWARD_GAP = 1.5;
    setInterval(() => {
        if (!playerReady) return;
        let state;
        try {
            state = player.getPlayerState();
        } catch {
            return;
        }
        if (state !== YT.PlayerState.PLAYING) return;
        const t = player.getCurrentTime();
        if (t >= lastSafeTime && (t - lastSafeTime) <= MAX_FORWARD_GAP) {
            lastSafeTime = t;
        } else if (t < lastSafeTime) {
            lastSafeTime = t;
        } else {
            try {
                player.seekTo(lastSafeTime, true);
            } catch {}
        }
    }, ANTI_SKIP_INTERVAL);

    setInterval(() => {
        if (!playerReady) return;
        let state;
        try {
            state = player.getPlayerState();
        } catch {
            return;
        }
        if (state !== YT.PlayerState.PLAYING) return;
        const sec = Math.floor(player.getCurrentTime());
        watchedSeconds.add(sec);
        updateProgress();
        checkSaveRequirements();
    }, 1000);

    function updateProgress() {
        const watched = watchedSeconds.size;
        const dur = videoDuration || Math.floor(player.getDuration() || 0);
        const pct = dur ? Math.round((watched / dur) * 100) : 0;
        progressInfo.textContent = `Menonton ${watched}/${dur} detik (${pct}%)`;
        progressBar.style.width = pct + "%";
    }

    saveActivityBtn.addEventListener("click", async () => {
        if (!currentVideoId || !currentSubjectId) {
            alert("⚠ Pilih mata kuliah dan video dulu");
            return;
        }
        if (!legitimatelyWatched) {
            alert("⚠ Tonton video sampai selesai (minimal 90%)");
            return;
        }
        const editor = tinymce.get("noteEditor");
        if (!editor) {
            alert("⚠ Editor belum siap");
            return;
        }
        const content = editor.getContent({
            format: "text"
        }).trim();
        if (countWords(content) < 10) {
            alert("⚠ Catatan minimal 10 kata sebelum disimpan");
            return;
        }

        // Disable button sementara
        saveActivityBtn.disabled = true;
        saveActivityBtn.textContent = "Menyimpan...";

        try {
            const htmlContent = editor.getContent();

            // Create note jika belum ada
            if (!noteId) {
                await createNoteForVideo(htmlContent);
            } else {
                // Update note yang sudah ada
                await saveNote(htmlContent);
            }

            // Save activity
            const fd = new FormData();
            fd.append("video_url", "https://www.youtube.com/watch?v=" + currentVideoId);
            fd.append("video_title", currentTitle);
            fd.append("duration", Math.round(player.getDuration() / 60));
            fd.append("note_id", noteId);
            fd.append("subject_id", currentSubjectId);

            const res = await fetch(BASE + "user/sessions/storeYoutube", {
                method: "POST",
                body: fd
            });

            const data = await res.json();
            // Cek sukses
            if (data.status === "ok" || data.status === "success" || data.success === true || res.ok) {
                alert("✓ Aktivitas belajar berhasil disimpan!");
                window.location.href = BASE + "user/dashboard";
            } else {
                alert("✕ Gagal menyimpan aktivitas: " + (data.message || "Unknown error"));
                saveActivityBtn.disabled = false;
                saveActivityBtn.textContent = "Simpan Aktivitas Belajar";
            }
        } catch (error) {
            alert("✕ Terjadi kesalahan saat menyimpan: " + error.message);
            saveActivityBtn.disabled = false;
            saveActivityBtn.textContent = "Simpan Aktivitas Belajar";
        }
    });

    noteSelect.addEventListener("change", () => {
        userHasTyped = false;
        lastSavedContent = "";
        const id = noteSelect.value;
        const list = <?= json_encode($notes) ?>;
        const found = list.find(n => n.id_note == id);
        noteId = id || null;

        const editor = tinymce.get("noteEditor");
        if (editor) {
            editor.setContent(found ? found.content : "");
        }
        checkSaveRequirements();
    });

    // Auto-save catatan yang sudah ada (SILENT - no notification)
    setInterval(async () => {
        if (!noteId) return;
        const editor = tinymce.get("noteEditor");
        if (!editor) return;
        if (!userHasTyped) return;
        const content = editor.getContent({
            format: "text"
        }).trim();
        if (countWords(content) < 10) return;
        if (content === lastSavedContent) return;
        lastSavedContent = content;
        await saveNote(editor.getContent());
    }, 2000);

    async function createNoteForVideo(content) {
        if (noteId) return;
        if (!currentSubjectId) {
            alert("⚠ Pilih mata kuliah dulu");
            return;
        }
        const fd = new FormData();
        fd.append("subject_id", currentSubjectId);
        fd.append("content", content);
        const res = await fetch(BASE + "user/notes/create", {
            method: "POST",
            body: fd
        });
        const data = await res.json();
        noteId = data.id;
    }

    async function saveNote(content) {
        if (!noteId) return;
        const fd = new FormData();
        fd.append("note_id", noteId);
        fd.append("content", content);
        await fetch(BASE + "user/notes/save", {
            method: "POST",
            body: fd
        });
    }

    function countWords(text) {
        return text.trim().split(/\s+/).filter(w => w.length > 0).length;
    }
</script>

<script src="https://www.youtube.com/iframe_api"></script>