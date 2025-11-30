<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <div class="text-xl font-bold text-indigo-600">LearnTrack</div>
    <div class="flex gap-6">
        <a href="<?= BASE_URL ?>dashboard" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
        <a href="<?= BASE_URL ?>notes" class="text-gray-700 hover:text-indigo-600">Catatan</a>
        <a href="<?= BASE_URL ?>logout" class="text-gray-700 hover:text-red-600">Logout</a>
    </div>
</nav>
<div class="max-w-7xl mx-auto p-6">