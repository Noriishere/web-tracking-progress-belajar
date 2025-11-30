<div class="max-w-4xl mx-auto p-6 space-y-6">
    <h1 class="text-3xl font-bold">Session Belajar (Pomodoro)</h1>

    <form id="studyForm" action="<?= BASE_URL ?>user/sessions/store" method="POST" class="space-y-4 bg-white p-6 rounded-xl shadow">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <select name="subject_id" id="subjectSelect" class="border p-2 rounded" required>
                <option value="">Pilih Mata Kuliah</option>
                <?php foreach ($subjects as $sub): ?>
                    <option value="<?= $sub['id_subject'] ?>"><?= $sub['subject_name'] ?></option>
                <?php endforeach; ?>
            </select>

            <select name="activity_id" class="border p-2 rounded" required>
                <?php foreach ($activities as $act): ?>
                    <option value="<?= $act['id_activity'] ?>"><?= $act['activity_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <select name="note_id" class="border p-2 rounded">
            <option value="">Tidak Ada Catatan</option>
            <?php foreach ($notes as $n): ?>
                <option value="<?= $n['id_note'] ?>"><?= substr($n['content'], 0, 35) ?>...</option>
            <?php endforeach; ?>
        </select>

        <select name="productivity_level" class="border p-2 rounded">
            <option value="high">High</option>
            <option value="medium" selected>Medium</option>
            <option value="low">Low</option>
        </select>

        <div class="text-center py-6">
            <div id="display" class="text-6xl font-mono">25:00</div>

            <div class="flex gap-3 justify-center mt-4">
                <button type="button" id="startBtn" class="px-4 py-2 bg-green-600 text-white rounded">Start</button>
                <button type="button" id="stopBtn" class="px-4 py-2 bg-red-600 text-white rounded">Stop</button>
                <button type="button" id="resetBtn" class="px-4 py-2 bg-gray-500 text-white rounded">Reset</button>
            </div>
        </div>

        <input type="hidden" name="start_time" id="start_time">
        <input type="hidden" name="end_time" id="end_time">
        <input type="hidden" name="duration_minutes" id="duration_minutes">

    </form>
</div>

<script>
    const subjectSelect = document.getElementById("subjectSelect");
    const startBtn = document.getElementById("startBtn");

    startBtn.disabled = true;
    startBtn.classList.add("opacity-50", "cursor-not-allowed");

    subjectSelect.addEventListener("change", () => {
        if (subjectSelect.value === "") {
            startBtn.disabled = true;
            startBtn.classList.add("opacity-50", "cursor-not-allowed");
        } else {
            startBtn.disabled = false;
            startBtn.classList.remove("opacity-50", "cursor-not-allowed");
        }
    });
    let total = 1500;
    let started = null;
    let timer = null;

    function f(s) {
        return String(Math.floor(s / 60)).padStart(2, '0') + ':' + String(s % 60).padStart(2, '0');
    }

    display.innerText = f(total);

    startBtn.onclick = () => {
        if (timer) return;
        started = new Date();
        start_time.value = started.toISOString().slice(0, 19).replace('T', ' ');
        timer = setInterval(() => {
            total--;
            display.innerText = f(total);
            if (total <= 0) {
                clearInterval(timer);
                timer = null;
            }
        }, 1000);
    };

    stopBtn.onclick = () => {
        if (!started) return;
        let end = new Date();
        end_time.value = end.toISOString().slice(0, 19).replace('T', ' ');
        duration_minutes.value = Math.round((end - started) / 60000);
        studyForm.submit();
    };

    resetBtn.onclick = () => {
        clearInterval(timer);
        timer = null;
        total = 1500;
        display.innerText = f(total);
        started = null;
    };
</script>