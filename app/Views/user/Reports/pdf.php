<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f0f0f0;
        }

        .left {
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Laporan Progress Belajar</h1>

    <h2>Progress Harian</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Menit</th>
                <th>Sesi</th>
                <th>Produktivitas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($harian as $h): ?>
                <tr>
                    <td><?= $h['study_date'] ?></td>
                    <td><?= $h['total_minutes'] ?></td>
                    <td><?= $h['total_sessions'] ?></td>
                    <td><?= $h['avg_productivity'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Progress per Mata Kuliah</h2>
    <table>
        <thead>
            <tr>
                <th class="left">Mata Kuliah</th>
                <th>Sesi</th>
                <th>Menit</th>
                <th>Produktivitas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subject as $s): ?>
                <tr>
                    <td class="left"><?= $s['subject_name'] ?></td>
                    <td><?= $s['total_sessions'] ?></td>
                    <td><?= $s['total_minutes'] ?></td>
                    <td><?= $s['avg_productivity'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Rekap Belajar YouTube</h2>
    <table>
        <thead>
            <tr>
                <th class="left">Mata Kuliah</th>
                <th>Video</th>
                <th>Menit</th>
                <th>Terakhir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($youtube as $y): ?>
                <tr>
                    <td class="left"><?= $y['subject_name'] ?? '-' ?></td>
                    <td><?= $y['total_video'] ?></td>
                    <td><?= $y['total_minutes'] ?></td>
                    <td><?= date('Y-m-d', strtotime($y['last_watched'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>