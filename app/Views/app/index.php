<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Percobaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar-scrolled {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-scrolled .nav-text {
            color: #5465FF;
        }
        .navbar-scrolled .nav-text:hover {
            color: #5465FF !important;
        }
        .navbar-scrolled .btn-login {
            border-color: #5465FF;
            color: #5465FF;
        }
        .navbar-scrolled .btn-login:hover {
            background-color: #5465FF;
            color: white;
        }
        .navbar-scrolled .btn-register {
            background-color: #5465FF;
            color: white;
        }
        .navbar-scrolled .btn-register:hover {
            background-color: transparent;
            border-color: #5465FF;
            color: #5465FF;
        }
        .navbar-scrolled .btn-mobile {
            color: #5465FF;
        }
    </style>
</head>
<body>
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-transparent text-white text-[18px]">
        <div class="container mx-auto flex items-center justify-between py-4 px-8 md:6px">
            <div class="flex items-center gap-8">
                <img src="https://ronekimedia.com/wp-content/uploads/2025/05/sdfsdgs.png" class="w-[150px] h-auto">
                <div class="space-x-6 xl:space-x-8 hidden lg:flex">
                    <a href="#hero" class="nav-text hover:text-[#BFD7FF]">Home</a>
                    <a href="#keunggulan" class="nav-text hover:text-[#BFD7FF]">Keunggulan</a>
                    <a href="#cara-kerja" class="nav-text hover:text-[#BFD7FF]">Cara Kerja</a>
                    <a href="#faq" class="nav-text hover:text-[#BFD7FF]">FAQ</a>
                </div>
            </div>
            <div class="hidden lg:flex items-center gap-4">
                <a href="<?= BASE_URL ?>user/auth/" class="btn-login border-2 border-white text-white font-medium px-12 py-[6px] rounded-full hover:bg-white hover:text-[#5465FF] transition">Login</a>
                <a href="<?= BASE_URL ?>user/auth/" class="btn-register bg-white text-[#5465FF] font-medium px-12 py-[6px] rounded-full border-2 border-white hover:bg-transparent hover:text-white transition">Daftar</a>
            </div>
            <button id="menuBtn" class="btn-mobile lg:hidden text-2xl focus:outline-none">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
        </div>
        <div id="mobileMenu" class="lg:hidden fixed top-0 right-0 h-full  w-[280px] max-w-[85%] bg-[#0c0f29] text-white px-6 py-6 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col gap-4 z-50">
            <div class="flex items-center justify-between mb-4">
                <span class="font-semibold text-lg"></span>
                <button id="closeMenuBtn" class="text-2xl hover:text-red-400 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <a href="#hero" class="block hover:text-blue-400">Home</a>
            <a href="#hero" class="block hover:text-blue-400">Home</a>
            <a href="#hero" class="block hover:text-blue-400">Home</a>
            <div class="pt-4 flex flex-col gap-3">
                <a href="" class="border-2 border-white text-center px-10 py-[6px] rounded-full hover:bg-white hover:text-[#5465FF] transition">Login</a>
                <a href="" class="bg-white text-[#5465FF] text-center px-10 py-[6px] rounded-full hover:bg-transparent hover:border-2 hover:border-white hover:text-white transition">Daftar</a>
            </div>
        </div>
    </nav>
    <section id="hero" class="relative h-screen flex items-center bg-gradient-to-bl from-[#5465FF] to-[#788BFF] overflow-hidden">
        <div class="absolute inset-x-0 top-[187px] px-4 text-center z-20">
            <h1 class="text-2xl sm:text-4xl xl:text-5xl font-bold text-white leading-tight max-w-4xl mx-auto">Pantau dan Tingkatkan Konsistensi Belajarmu Secara Otomatis</h1>
        </div>
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center px-4">
            <div class="text-white space-y-6 z-10 mt-32 md:mt-0">
                <p class="md:text-[18px] lg:text-[22px] font-extralight leading-relaxed max-w-md">
                    Terintegrasi dengan Google Calendar & YouTube untuk melacak waktu belajar, memberi insight produktivitas, dan menjaga motivasi.
                </p>
                <div class="px-4 py-1.5 sm:px-5 sm:py-2 md:px-6 md:py-2.5 rounded-full border border-white text-white text-[14px] sm:text-[16px] md:text-[18px] transition inline-block">
                    Mulailah Belajar
                </div>                
            </div>
        </div>
        <div class="absolute left-1/2 -translate-x-1/2 bottom-[-90px] flex items-center justify-center w-full">
            <div class="w-[400px] sm:w-[646px] aspect-square rounded-full border-[30px] sm:border-[40px] border-white/40 flex items-center justify-center relative">
                <img src="yaya.png" class="absolute w-[400px] sm:w-[646px] h-[400px] sm:h-[646px] object-cover rounded-full top-[-60px] sm:top-[-80px]">
                <div class="absolute top-[63%] left-1/2 -translate-x-1/2 px-3 py-2 sm:px-5 sm:py-2.5 md:px-6 md:py-3 rounded-full border border-white/50 bg-white/10 backdrop-blur-md flex gap-2 sm:gap-3 md:gap-4">
                    <a href="#">
                        <button class="px-4 py-1 min-w-[110px] sm:px-7 sm:py-2 sm:min-w-[145px] md:px-10 md:py-2.5 md:min-w-[160px] whitespace-nowrap rounded-full bg-[#5465FF] text-white text-center text-[13px] sm:text-[15px] md:text-[18px] font-medium hover:bg-gray-100 hover:text-[#5465FF] transition">
                            Mulai Sekarang
                        </button>
                    </a>
                    <a href="#keunggulan">
                    <button class="px-4 py-1 min-w-[110px] sm:px-7 sm:py-2 sm:min-w-[145px] md:px-10 md:py-2.5 md:min-w-[160px] whitespace-nowrap rounded-full border border-white text-white text-center text-[13px] sm:text-[15px] md:text-[18px] hover:bg-white/20 transition">
                        Pelajari Lebih Lanjut
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

<!-- BAGIAN KEUNGGULAN -->
    <section id="keunggulan" class="mt-[45px]">
        <div class="container mx-auto px-8 md:6px">
<!-- KEUNGGULAN JUDUL -->
            <div class="flex items-center gap-3 mb-10">
                <div class="h-10 w-10 bg-[#788BFF] rounded-xl flex items-center justify-center text-white font-bold">
                    <i class="fa-solid fa-crown"></i>
                </div>
                <h2 class="text-2xl font-bold text-[#788BFF]">Keungulan Platform Kami</h2>
            </div>
<!-- KEUNGGULAN ISI -->
            <div class="rounded-2xl border-[8px] border-[#9BB1FF] bg-gradient-to-br from-[#788BFF] to-[#9BB1FF] pt-20 pb-20 px-10 min-h-[420px] shadow-lg">
<!-- KEUNGGULAN ISI -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-white py-9">
                    <div class="text-center flex flex-col items-center max-w-xs mx-auto">
                        <div class="w-14 h-14 border border-white rounded-xl bg-white/10 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-bell text-xl"></i>
                        </div>
                        <h3 class="text-lg md:text-[20px] font-semibold mb-1">
                           Notif Pengingat Harian
                        </h3>
                        <p class="text-[18px] font-light leading-relaxed">
                            Kami Akan Mengingatkanmu Agar Tetap Belajar Setiap Hari.
                        </p>
                    </div>
                    <div class="text-center flex flex-col items-center max-w-xs mx-auto">
                        <div class="w-14 h-14 border border-white rounded-xl bg-white/10 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-fire text-2xl"></i>
                        </div>
                        <h3 class="text-lg md:text-[20px] font-semibold mb-1">
                           Leaderboard Streak
                        </h3>
                        <p class="text-[18px] font-light leading-relaxed">
                            Leaderboard Pengguna Aplikasi Agar Kamu Lebih Semangat Belajar.
                        </p>
                    </div>
                    <div class="text-center flex flex-col items-center max-w-xs mx-auto">
                        <div class="w-14 h-14 border border-white rounded-xl bg-white/10 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-chart-area text-2xl"></i>
                        </div>
                        <h3 class="text-lg md:text-[20px] font-semibold mb-1">
                           Grafik Analisis Belajar
                        </h3>
                        <p class="text-[18px] font-light leading-relaxed">
                            Kami Akan Mencarikan Waktu Yang Cocok Supaya Kamu Bisa Belajar Teratur.
                        </p>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
<!-- BAGIAN CARA KERJA -->
    <section id="cara-kerja" class="mt-[45px]">
        <div class="container mx-auto px-8 md:6px">
<!-- CARA KERJA JUDUL -->
            <div class="flex items-center gap-3 mb-10">
                <div class="h-10 w-10 bg-[#788BFF] rounded-xl flex items-center justify-center text-white font-bold">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h2 class="text-2xl font-bold text-[#788BFF]">How to Use</h2>
            </div>
<!-- CARA KERJA ISI -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-[#788BFF] to-[#9BB1FF] p-8 rounded-xl shadow text-white">
                    <div class="w-14 h-14 bg-white/20 border border-white rounded-xl flex items-center justify-center text-3xl font-bold mb-4">
                        <p>1</p>
                    </div>
                    <h3 class="text-[20px] font-semibold mb-2">Daftar / Login</h3>
                    <p class="text-[18px] font-light">
                        Daftarkan diri kamu atau login untuk mulai menyimpan progres belajar.
                    </p>
                </div>
                <div class="bg-gradient-to-br from-[#788BFF] to-[#9BB1FF] p-8 rounded-xl shadow text-white">
                    <div class="w-14 h-14 bg-white/20 border border-white rounded-xl flex items-center justify-center text-3xl font-bold mb-4">
                        <p>2</p>
                    </div>
                    <h3 class="text-[20px] font-semibold mb-2">Isi Profil kamu</h3>
                    <p class="text-[18px] font-light">
                        Isi profil kamu buat verif kalo kamu itu beneran mau belajar
                    </p>
                </div>
                <div class="bg-gradient-to-br from-[#788BFF] to-[#9BB1FF] p-8 rounded-xl shadow text-white">
                    <div class="w-14 h-14 bg-white/20 border border-white rounded-xl flex items-center justify-center text-3xl font-bold mb-4">
                        <p>3</p>
                    </div>
                    <h3 class="text-[20px] font-semibold mb-2">Buat catatan pertama kamu</h3>
                    <p class="text-[18px] font-light">
                        Buat catatan untuk setiap pelajaran yang udah kamu pelajari
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-[#788BFF] to-[#9BB1FF] p-10 rounded-xl shadow text-white">
                    <div class="w-14 h-14 bg-white/20 border border-white rounded-xl flex items-center justify-center text-3xl font-bold mb-4">
                        <p>4</p>
                    </div>
                    <h3 class="text-[20px] font-semibold mb-2">Nyalakan Pengingat</h3>
                    <p class="text-[18px] font-light">Aktifkan notifikasi agar kamu selalu ingat untuk belajar setiap hari.</p>
                </div>
                <div class="bg-gradient-to-br from-[#788BFF] to-[#9BB1FF] p-10 rounded-xl shadow text-white">
                    <div class="w-14 h-14 bg-white/20 border border-white rounded-xl flex items-center justify-center text-3xl font-bold mb-4">
                        <p>5</p>
                    </div>
                    <h3 class="text-[20px] font-semibold mb-2">Jaga Streak Belajar</h3>
                    <p class="text-[18px] font-light">Pertahankan streak-mu untuk mencapai kebiasaan belajar yang kuat.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="faq" class="mt-[45px] mb-[45px]">
        <div class="container mx-auto px-8 md:6px">
            <div class="flex items-center gap-3 mb-10">
                <div class="h-10 w-10 bg-[#788BFF] rounded-xl flex items-center justify-center text-white font-bold">
                    <i class="fa-solid fa-question"></i>
                </div>
                <h2 class="text-2xl font-bold text-[#788BFF]">FAQ</h2>
            </div>
            <div class="flex flex-col md:flex-row gap-14">
                <div class="basis-3/4 space-y-8">
                    <div class="faq-item bg-[#788BFF] p-6 rounded-xl cursor-pointer transition">
                        <button class="faq-btn w-full text-left text-white font-semibold text-[20px] flex justify-between items-center">
                            Apakah Bisa Di Sodok Pake Garpu?
                            <span class="text-2xl font-bold"><i class="fa-solid fa-caret-right"></i></span>
                        </button>
                        <div class="faq-content hidden mt-4 text-white text-[18px] leading-relaxed">
                            Ya Sangat Bisa Sekali Disodok Pake Garpu Dan Tumbler KAI
                        </div>
                    </div>
                    <div class="faq-item bg-[#788BFF] p-6 rounded-xl cursor-pointer transition">
                        <button class="faq-btn w-full text-left text-white font-semibold text-[20px] flex justify-between items-center">
                            Apakah Bisa Di Sodok Pake Garpu?
                            <span class="text-2xl font-bold"><i class="fa-solid fa-caret-right"></i></span>
                        </button>
                        <div class="faq-content hidden mt-4 text-white text-[18px] leading-relaxed">
                            Ya Sangat Bisa Sekali Disodok Pake Garpu Dan Tumbler KAI
                        </div>
                    </div>
                    <div class="faq-item bg-[#788BFF] p-6 rounded-xl cursor-pointer transition">
                        <button class="faq-btn w-full text-left text-white font-semibold text-[20px] flex justify-between items-center">
                            Apakah Bisa Di Sodok Pake Garpu?
                            <span class="text-2xl font-bold"><i class="fa-solid fa-caret-right"></i></span>
                        </button>
                        <div class="faq-content hidden mt-4 text-white text-[18px] leading-relaxed">
                            Ya Sangat Bisa Sekali Disodok Pake Garpu Dan Tumbler KAI
                        </div>
                    </div>
                </div>
                <div class="basis-1/4 bg-gradient-to-br from-[#5465FF] to-[#788BFF] p-12 rounded-2xl text-white flex flex-col text-center justify-center">
                    <h3 class="text-[20px] font-bold mb-6">Hubungi Kami</h3>
                    <p class="text-white/90 mb-6 text-[16px]">
                        <span class="font-semibold text-[18px]">Email:</span><br>
                        mine@mine.shirolink.my.id
                    </p>
                    <p class="text-white/90 mb-8 text-[16px]">
                        <span class="font-semibold text-[18px]">Telepon</span><br>
                        +62 000-0000-0000
                    </p>
                    <button class="px-8 py-2 bg-white text-[#5465FF] font-semibold rounded-full mx-auto hover:bg-gray-100 shadow">
                        Contact Me
                    </button>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-[#E4EEFF] text-white">
        <div class="container mx-auto px-8 md:6px py-5 flex flex-col items-center text-center gap-10">
            <nav class="flex flex-wrap justify-center gap-3 text-[#5465FF] text-[16px] font-medium">
                <a href="#hero" class="hover:text-black transition">Home</a>
                <a href="#keunggulan" class="hover:text-black transition">Keunggulan Kami</a>
                <a href="#cara-kerja" class="hover:text-black transition">Cara Kerja</a>
                <a href="#faq" class="hover:text-black transition">FAQ</a>
            </nav>
            <div class="flex justify-center gap-4">
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-white bg-[#5465FF] hover:bg-white hover:text-[#5465FF] transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-white bg-[#5465FF] hover:bg-white hover:text-[#5465FF] transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-white bg-[#5465FF] hover:bg-white hover:text-[#5465FF] transition"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <div class="bg-[#5465FF] py-2 text-[14px] text-white/90">
            <div class="container mx-auto px-6 text-left">
                <p>© 2025 MINE - Monitoring & Improvement of Note-based Education. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
    window.addEventListener("scroll", () => {
        const navbar = document.getElementById("navbar");
        if (window.scrollY > 10) navbar.classList.add("navbar-scrolled");
        else navbar.classList.remove("navbar-scrolled");
    });

    document.querySelectorAll(".faq-btn").forEach(btn => {
    btn.addEventListener("click", () => {

        const item = btn.closest(".faq-item");
        const content = item.querySelector(".faq-content");
        const icon = btn.querySelector("i");
        const isOpen = !content.classList.contains("hidden");

        document.querySelectorAll(".faq-content").forEach(c => c.classList.add("hidden"));

        document.querySelectorAll(".faq-btn i").forEach(i => {
        i.classList.remove("fa-caret-down");
        i.classList.add("fa-caret-right");
        });

        document.querySelectorAll(".faq-item").forEach(i => {
        i.classList.remove("bg-[#5465FF]");
        i.classList.add("bg-[#788BFF]");
        });

        if (!isOpen) {
        content.classList.remove("hidden");

        icon.classList.remove("fa-caret-right");
        icon.classList.add("fa-caret-down");

        item.classList.remove("bg-[#788BFF]");
        item.classList.add("bg-[#5465FF]");
        }
    });
    });


    const menuBtn = document.getElementById("menuBtn");
    const closeMenuBtn = document.getElementById("closeMenuBtn");
    const mobileMenu = document.getElementById("mobileMenu");

    menuBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("translate-x-full");
    });

    closeMenuBtn.addEventListener("click", () => {
        mobileMenu.classList.add("translate-x-full");
    });
    </script>
</body>
</html>