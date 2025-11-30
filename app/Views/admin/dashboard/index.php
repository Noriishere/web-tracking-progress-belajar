<div class="mt-5 max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-semibold"> DASHBOARD </h1>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 mt-5">
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500">Users</p>
            <h2 class="text-2xl font-bold"><?= $total_users ?></h2>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500">Study Sessions</p>
            <h2 class="text-2xl font-bold"><?= $total_sessions ?></h2>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500">YouTube Activities</p>
            <h2 class="text-2xl font-bold"><?= $total_youtube ?></h2>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500">Subjects</p>
            <h2 class="text-2xl font-bold"><?= $total_subjects ?></h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="col-span-2 bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Sessions (7 hari)</h3>
            <canvas id="adminSessionsChart" height="120"></canvas>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
            <div class="space-y-3">
                <?php if (empty($recent_users)): ?>
                    <div class="text-gray-500">No users</div>
                <?php else: ?>
                    <?php foreach ($recent_users as $u): ?>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium"><?= htmlspecialchars($u['username']) ?></div>
                                <div class="text-xs text-gray-500"><?= htmlspecialchars($u['email']) ?></div>
                            </div>
                            <div class="text-xs text-gray-400"><?= date('d M Y', strtotime($u['created_at'])) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Recent Study Sessions</h3>
            <?php if (empty($recent_sessions)): ?>
                <div class="text-gray-500">No sessions</div>
            <?php else: ?>
                <div class="space-y-3">
                    <?php foreach ($recent_sessions as $s): ?>
                        <div class="p-3 border rounded">
                            <div class="text-sm text-gray-500"><?= date('d M Y H:i', strtotime($s['start_time'])) ?></div>
                            <div class="font-medium"><?= htmlspecialchars($s['subject_name'] ?? '–') ?></div>
                            <div class="text-sm text-gray-600"><?= intval($s['duration_minutes']) ?> menit • <?= htmlspecialchars($s['activity_name'] ?? '–') ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Recent YouTube Activities</h3>
            <?php if (empty($recent_youtube)): ?>
                <div class="text-gray-500">No youtube activity</div>
            <?php else: ?>
                <div class="space-y-3">
                    <?php foreach ($recent_youtube as $y): ?>
                        <div class="p-3 border rounded">
                            <div class="text-xs text-gray-500"><?= date('d M Y H:i', strtotime($y['created_at'])) ?></div>
                            <div class="font-medium"><?= htmlspecialchars($y['video_title']) ?></div>
                            <div class="text-sm text-gray-600"><?= intval($y['duration_minutes']) ?> menit • <?= htmlspecialchars($y['subject_name'] ?? '–') ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const adminLabels = <?= json_encode($session_chart_labels) ?>;
const adminData = <?= json_encode($session_chart_data) ?>;

new Chart(document.getElementById('adminSessionsChart'), {
    type: 'bar',
    data: {
        labels: adminLabels,
        datasets: [{
            label: 'Menit Belajar',
            data: adminData,
            backgroundColor: 'rgba(59,130,246,0.8)'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>
