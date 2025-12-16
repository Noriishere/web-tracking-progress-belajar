<div class="max-w-3xl mx-auto p-6 space-y-6">
    <h1 class="text-3xl font-bold text-textcolor dark:text-textcolor-dark">
        Session Belajar (Pomodoro)
    </h1>
    <form id="studyForm"
        action="<?= BASE_URL ?>user/sessions/store"
        method="POST"
        class="bg-card dark:bg-card-dark border border-bordercolor dark:border-bordercolor-dark 
                 rounded-2xl p-6 space-y-6 shadow-sm">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <select name="subject_id" id="subjectSelect"
                class="w-full rounded-lg border border-bordercolor dark:border-bordercolor-dark 
               bg-background dark:bg-background-dark p-3
               text-textcolor dark:text-textcolor-dark"
                required>

                <option value="">Pilih Mata Kuliah</option>

                <?php foreach ($subjects as $sub): ?>
                    <option value="<?= $sub['subject_id'] ?>">
                        <?= htmlspecialchars($sub['subject_name']) ?>
                    </option>
                <?php endforeach; ?>

            </select>


            <select name="activity_id"
                class="w-full rounded-lg border border-bordercolor dark:border-bordercolor-dark 
                           bg-background dark:bg-background-dark p-3
                           text-textcolor dark:text-textcolor-dark"
                required>
                <?php foreach ($activities as $act): ?>
                    <option value="<?= $act['id_activity'] ?>">
                        <?= $act['activity_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <select name="note_id"
            class="w-full rounded-lg border border-bordercolor dark:border-bordercolor-dark 
                       bg-background dark:bg-background-dark p-3
                       text-textcolor dark:text-textcolor-dark">
            <option value="">Tidak Ada Catatan</option>
            <?php foreach ($notes as $n): ?>
                <option value="<?= $n['id_note'] ?>">
                    <?= substr($n['content'], 0, 35) ?>...
                </option>
            <?php endforeach; ?>
        </select>

        <select name="productivity_level"
            class="w-full rounded-lg border border-bordercolor dark:border-bordercolor-dark 
                       bg-background dark:bg-background-dark p-3
                       text-textcolor dark:text-textcolor-dark">
            <option value="high">High</option>
            <option value="medium" selected>Medium</option>
            <option value="low">Low</option>
        </select>

        <div class="bg-background dark:bg-background-dark 
                    border border-bordercolor dark:border-bordercolor-dark
                    rounded-2xl p-6 text-center space-y-4">

            <div id="display"
                class="text-6xl font-mono font-bold tracking-wide
                        text-textcolor dark:text-textcolor-dark">
                25:00
            </div>

            <div class="flex justify-center gap-3">
                <button type="button" id="startBtn"
                    class="px-5 py-2 rounded-lg bg-green-600 text-white font-medium
                               hover:bg-green-700 active:scale-95 transition">
                    Start
                </button>

                <button type="button" id="stopBtn"
                    class="px-5 py-2 rounded-lg bg-red-600 text-white font-medium
                               hover:bg-red-700 active:scale-95 transition">
                    Stop
                </button>

                <button type="button" id="resetBtn"
                    class="px-5 py-2 rounded-lg bg-gray-500 text-white font-medium
                               hover:bg-gray-600 active:scale-95 transition">
                    Reset
                </button>
            </div>
        </div>

        <input type="hidden" name="start_time" id="start_time">
        <input type="hidden" name="end_time" id="end_time">
        <input type="hidden" name="duration_minutes" id="duration_minutes">

    </form>
</div>
<script>
    let duration = 25 * 60;
    let timer = null;
    let startTime = null;

    const display = document.getElementById('display');
    const startBtn = document.getElementById('startBtn');
    const stopBtn = document.getElementById('stopBtn');
    const resetBtn = document.getElementById('resetBtn');

    const startInput = document.getElementById('start_time');
    const endInput = document.getElementById('end_time');
    const durationInput = document.getElementById('duration_minutes');

    function render() {
        const m = Math.floor(duration / 60);
        const s = duration % 60;
        display.textContent =
            String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
    }

    startBtn.onclick = () => {
        if (timer) return;

        startTime = new Date();
        startInput.value = startTime.toISOString().slice(0, 19).replace('T', ' ');

        timer = setInterval(() => {
            duration--;
            render();

            if (duration <= 0) {
                stopTimer();
            }
        }, 1000);
    };

    function stopTimer() {
        clearInterval(timer);
        timer = null;

        const end = new Date();
        endInput.value = end.toISOString().slice(0, 19).replace('T', ' ');

        const used = Math.floor((end - startTime) / 60000);
        durationInput.value = used;

        document.getElementById('studyForm').submit();
    }

    stopBtn.onclick = stopTimer;

    resetBtn.onclick = () => {
        clearInterval(timer);
        timer = null;
        duration = 25 * 60;
        render();
    };

    render();
</script>