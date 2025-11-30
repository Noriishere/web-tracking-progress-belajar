<div class="max-w-6xl mx-auto p-6 space-y-6">

    <h1 class="text-3xl font-bold">Belajar dari YouTube</h1>

    <div class="bg-white p-5 rounded-xl shadow space-y-4">

        <select id="subjectSelect" class="border p-2 rounded w-full">
            <option value="">Pilih Mata Kuliah</option>
            <?php foreach ($subjects as $sub): ?>
                <option value="<?= $sub['subject_name'] ?>"><?= $sub['subject_name'] ?></option>
            <?php endforeach; ?>
        </select>

        <button id="searchBtn" class="px-4 py-2 bg-red-600 text-white rounded w-full">
            Cari Video
        </button>

        <div id="results" class="grid grid-cols-1 md:grid-cols-3 gap-4"></div>

        <div id="playerContainer" class="hidden mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <iframe id="youtubePlayer" class="w-full h-72 rounded-xl"></iframe>

                <form action="<?= BASE_URL ?>user/sessions/storeYoutube" method="POST" class="space-y-3 mt-4">
                    <input type="hidden" name="video_url" id="video_url">
                    <input type="hidden" name="video_title" id="video_title">
                    <input type="hidden" name="note_final_id" id="note_final_id">

                    <select name="subject_id" class="border p-2 rounded w-full" required>
                        <option value="">Pilih Subject</option>
                        <?php foreach ($userSubjects as $s): ?>
                            <option value="<?= $s['id_subject'] ?>"><?= $s['subject_name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input type="number" name="duration" min="1" placeholder="Durasi Belajar (menit)" class="border p-2 rounded w-full">

                    <button class="px-4 py-2 bg-blue-600 text-white rounded w-full">Simpan Aktivitas</button>
                </form>
            </div>

            <div class="bg-white p-4 rounded-xl border shadow space-y-3">

                <h2 class="font-bold text-lg">Catatan Belajar</h2>

                <select id="noteSelect" class="border p-2 rounded w-full">
                    <option value="">Buat Catatan Baru</option>
                    <?php foreach ($notes as $n): ?>
                        <option value="<?= $n['id_note'] ?>"><?= substr($n['content'], 0, 30) ?>...</option>
                    <?php endforeach; ?>
                </select>

                <textarea id="noteEditor"
                    class="border p-3 rounded w-full h-64 resize-none focus:ring focus:ring-blue-300"
                    placeholder="Tulis catatan sambil menonton..."></textarea>
            </div>

        </div>
    </div>
</div>

<script>
    const apiKey = "AIzaSyAvRWPInXCpMITLfqboSJs8x3mhmfC_6bc";

    const ytSubject = document.getElementById("subjectSelect");
    const searchBtn = document.getElementById("searchBtn");

    ytSubject.addEventListener("change", () => {
        if (ytSubject.value === "") {
            searchBtn.disabled = true;
            searchBtn.classList.add("opacity-50", "cursor-not-allowed");
        } else {
            searchBtn.disabled = false;
            searchBtn.classList.remove("opacity-50", "cursor-not-allowed");
        }
    });

    searchBtn.onclick = async () => {
        const subject = subjectSelect.value;
        if (!subject) return;

        const q = subject + " tutorial";

        const res = await fetch(
            "https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=6&q=" +
            encodeURIComponent(q) +
            "&key=" + apiKey
        );

        const data = await res.json();
        const items = data.items;
        results.innerHTML = "";

        items.forEach(v => {
            const id = v.id.videoId;
            const title = v.snippet.title;
            const thumb = v.snippet.thumbnails.medium.url;

            results.innerHTML += `
            <div class='border rounded-xl shadow p-3 cursor-pointer hover:bg-gray-100'
                 onclick="selectVideo('${id}', '${title.replace(/'/g, "\\'")}')">
                <img src='${thumb}' class='rounded mb-2'>
                <p class='font-medium text-sm'>${title}</p>
            </div>
        `;
        });
    };

    function selectVideo(id, title) {
        youtubePlayer.src = "https://www.youtube.com/embed/" + id;
        video_url.value = "https://www.youtube.com/watch?v=" + id;
        video_title.value = title;
        playerContainer.classList.remove("hidden");
    }

    const notesData = <?= json_encode($notes) ?>;
    let selectedNote = null;
    let typingTimer = null;

    noteSelect.onchange = () => {
        const noteId = noteSelect.value;
        selectedNote = noteId === "" ? null : noteId;

        if (selectedNote) {
            const found = notesData.find(x => x.id_note == selectedNote);
            noteEditor.value = found ? found.content : "";
            note_final_id.value = selectedNote;
        } else {
            noteEditor.value = "";
            note_final_id.value = "";
        }
    };

    noteEditor.addEventListener("input", () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(saveNote, 1200);
    });

    function saveNote() {
        const text = noteEditor.value.trim();
        if (text === "") return;

        const fd = new FormData();
        fd.append("content", text);
        fd.append("note_id", selectedNote);

        fetch("<?= BASE_URL ?>user/notes/autosave", {
                method: "POST",
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                if (res.status === "new") {
                    selectedNote = res.id;
                    note_final_id.value = res.id;
                    noteSelect.innerHTML += `<option value="${res.id}">${text.substring(0,30)}...</option>`;
                }
            });
    }
</script>