<div class="max-w-6xl mx-auto p-6 space-y-6">

    <h1 class="text-3xl font-bold">Belajar dari YouTube</h1>

    <div class="bg-white p-5 rounded-xl shadow space-y-4">

        <select id="subjectSelect" class="border p-2 rounded w-full">
            <option value="">Pilih Mata Kuliah</option>
            <?php foreach ($subjects as $s): ?>
                <option value="<?= htmlspecialchars($s['subject_name']) ?>">
                    <?= $s['subject_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button id="searchBtn" disabled class="px-4 py-2 bg-red-600 text-white rounded w-full opacity-50">
            Cari Video
        </button>

        <div id="results" class="grid grid-cols-1 md:grid-cols-3 gap-4"></div>

        <div id="playerContainer" class="hidden mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <button id="backBtn" class="px-3 py-1 bg-gray-200 rounded text-sm hover:bg-gray-300 mb-3">
                    ← Kembali
                </button>

                <iframe id="youtubePlayer" class="w-full h-72 rounded-xl"></iframe>

                <form action="<?= BASE_URL ?>user/sessions/storeYoutube" method="POST" class="space-y-3 mt-4">

                    <input type="hidden" id="video_url" name="video_url">
                    <input type="hidden" id="video_title" name="video_title">
                    <input type="hidden" id="note_final_id" name="note_final_id">
                    <input type="hidden" id="detected_duration" name="detected_duration">
                    <input type="hidden" id="subject_id_hidden" name="subject_id">

                    <p class="text-sm text-gray-700">
                        Mata Kuliah: <span id="subjectLabel" class="font-semibold"></span>
                    </p>

                    <input type="number" name="duration" id="durationInput" min="1"
                        placeholder="Durasi Belajar (menit)" class="border p-2 rounded w-full">

                    <p id="autoDurationText" class="text-sm text-green-700"></p>

                    <button class="px-4 py-2 bg-blue-600 text-white rounded w-full">
                        Simpan Aktivitas
                    </button>
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
    document.addEventListener("DOMContentLoaded", () => {

        const apiKey = "AIzaSyAvRWPInXCpMITLfqboSJs8x3mhmfC_6bc";

        const ytSubject = document.getElementById("subjectSelect");
        const searchBtn = document.getElementById("searchBtn");
        const results = document.getElementById("results");
        const playerContainer = document.getElementById("playerContainer");
        const youtubePlayer = document.getElementById("youtubePlayer");
        const subjectLabel = document.getElementById("subjectLabel");
        const subjectHidden = document.getElementById("subject_id_hidden");

        const notesData = <?= json_encode($notes) ?>;
        const subjectData = <?= json_encode($userSubjects ?? []) ?>;

        ytSubject.addEventListener("change", () => {
            if (ytSubject.value.trim() === "") {
                searchBtn.setAttribute("disabled", true);
                searchBtn.classList.add("opacity-50");
            } else {
                searchBtn.removeAttribute("disabled");
                searchBtn.classList.remove("opacity-50");
            }
        });

        searchBtn.onclick = async () => {
            const subject = ytSubject.value.trim();
            if (!subject) return;

            const q = subject + " tutorial";

            const res = await fetch(
                "https://www.googleapis.com/youtube/v3/search" +
                "?part=snippet&type=video&maxResults=12&q=" + encodeURIComponent(q) +
                "&key=" + apiKey
            );

            const data = await res.json();
            results.innerHTML = "";

            if (!data.items) return;

            data.items.forEach(v => {
                const id = v.id.videoId;
                const title = v.snippet.title;
                const thumb = v.snippet.thumbnails.medium.url;

                results.innerHTML += `
                <div class="border rounded-xl shadow p-3 cursor-pointer hover:bg-gray-100"
                    data-id="${id}"
                    data-title="${title.replace(/"/g, "&quot;")}"
                    onclick="selectVideo(this)">
                    <img src="${thumb}" class="rounded mb-2">
                    <p class="font-medium text-sm">${title}</p>
                </div>`;
            });
        };

        window.selectVideo = async (el) => {
            const id = el.dataset.id;
            const title = el.dataset.title;

            youtubePlayer.src = "https://www.youtube.com/embed/" + id;

            document.getElementById("video_url").value =
                "https://www.youtube.com/watch?v=" + id;

            document.getElementById("video_title").value = title;

            const selectedSubject = ytSubject.value.trim();
            const match = subjectData.find(x => x.subject_name === selectedSubject);

            if (match) {
                subjectHidden.value = match.id_subject;
                subjectLabel.textContent = match.subject_name;
            }

            playerContainer.classList.remove("hidden");

            await detectVideoDuration(id);

            window.scrollTo({
                top: playerContainer.offsetTop - 20,
                behavior: "smooth"
            });
        };


        async function detectVideoDuration(videoId) {
            const res = await fetch(
                "https://www.googleapis.com/youtube/v3/videos" +
                "?part=contentDetails&id=" + videoId +
                "&key=" + apiKey
            );

            const data = await res.json();
            if (!data.items) return;

            const iso = data.items[0].contentDetails.duration;
            const minutes = isoToMinutes(iso);

            document.getElementById("detected_duration").value = minutes;
            document.getElementById("autoDurationText").textContent =
                "Durasi terdeteksi: " + minutes + " menit";
        }

        function isoToMinutes(iso) {
            const h = iso.match(/(\d+)H/);
            const m = iso.match(/(\d+)M/);
            const s = iso.match(/(\d+)S/);

            return Math.round(
                (h ? +h[1] : 0) * 60 +
                (m ? +m[1] : 0) +
                (s ? +s[1] / 60 : 0)
            );
        }

    });
</script>