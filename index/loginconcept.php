<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>

<body class="flex flex-col md:flex-row min-h-screen overflow-x-hidden bg-gradient-to-r from-[#788bff] to-[#5465ff] relative">

  <!-- Logo -->
  <div class="absolute top-6 left-6 md:top-10 md:left-10 z-20">
    <img id="logo" 
         src="https://ronekimedia.com/wp-content/uploads/2025/05/sdfsdgs.png" 
         alt="Logo"
         class="w-20 sm:w-24 md:w-28 h-auto transition-all duration-500" />
  </div>

  <!-- Panel Putih -->
  <div id="panelPutih" 
       class="relative bg-white flex flex-col justify-start w-full md:w-1/2
              px-6 sm:px-10 md:px-14 lg:px-20 xl:px-32
              py-10 md:pt-44 md:space-y-8 shadow-2xl z-10">

    <div id="formContainer" 
         class="mt-20 sm:mt-24 md:mt-0 w-full max-w-[640px] mx-auto transition-all duration-500">
      <p id="judul" 
         class="text-[22px] sm:text-[24px] md:text-[26px] font-bold text-black leading-snug w-full">
        Selamat Datang Kembali, <br>Teruskan Progresmu!
      </p>

      <form class="flex flex-col space-y-5 w-full mt-8 md:mt-5">
        <div class="flex flex-col space-y-2">
          <label for="email" class="text-base text-black">Email</label>
          <input type="email" name="email" placeholder="mamal@gmail.com"
            class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                   w-full focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
        </div>

        <div class="flex flex-col space-y-2">
          <label for="password" class="text-base text-black">Password</label>
          <input type="password" name="password" placeholder="••••••••"
            class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                   w-full focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
        </div>

        <div class="flex items-center justify-between w-full">
          <label class="flex items-center space-x-2 text-gray-700 ">
            <input type="checkbox"
              class="w-5 h-5 appearance-none rounded-[5px] border border-gray-400
                     checked:bg-[#5465ff] checked:border-[#5465ff] cursor-pointer transition-all" />
            <span class="text-base select-none">Ingatkan saya</span>
          </label>

          <a href="#" class="text-[#5465ff] text-base hover:underline">
            Lupa password?
          </a>
        </div>

        <button type="button"
          class="mt-8 w-full bg-[#5465ff] hover:bg-[#788bff] text-white py-3 rounded-[10px] font-medium transition">
          Masuk
        </button>
      </form>
    </div>
  </div>

  <!-- Panel Ungu -->
  <div id="panelUngu" 
       class="relative w-full md:w-1/2 h-[370px] md:h-auto md:min-h-screen flex flex-col items-center justify-center text-center text-white px-8 space-y-4">
    <h2 id="judulUngu" class="text-3xl font-semibold">Daftar Sekarang Dan <br> Mulai Catat Progres Belajarmu!</h2>
    <p id="descUngu" class="text-white/90 max-w-md">Setiap Langkah Kecil Hari Ini Akan Jadi <br> Kemajuan Besar Di Masa Depan.</p>
    <button id="toggleBtn"
      class="border border-white text-white text-lg font-medium px-8 py-3 rounded-lg hover:bg-white/20 transition">
      Buat Akun
    </button>
  </div>

  <script>
    const panelPutih = document.getElementById("panelPutih");
    const panelUngu = document.getElementById("panelUngu");
    const toggleBtn = document.getElementById("toggleBtn");
    const formContainer = document.getElementById("formContainer");
    const judulUngu = document.getElementById("judulUngu");
    const descUngu = document.getElementById("descUngu");
    const logo = document.getElementById("logo");

    let isRegister = false;
    let animating = false;

    function setRegisterForm() {
      formContainer.innerHTML = `
        <p class="text-[22px] sm:text-[24px] md:text-[26px] font-bold text-black leading-snug w-full">
          Buat Akun Baru, <br>Mulai Petualanganmu!
        </p>

        <form class="flex flex-col space-y-5 w-full mt-8 md:mt-5">
          <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
            <div class="flex flex-col space-y-2 w-full sm:w-1/2">
              <label for="namadepan" class="text-base text-black">Nama Depan</label>
              <input type="text" id="namadepan" placeholder="Nama Depan"
                class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                       focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
            </div>

            <div class="flex flex-col space-y-2 w-full sm:w-1/2">
              <label for="namabelakang" class="text-base text-black">Nama Belakang</label>
              <input type="text" id="namabelakang" placeholder="Nama Belakang"
                class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                       focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
            </div>
          </div>

          <div class="flex flex-col space-y-2">
            <label class="text-base text-black">Email</label>
            <input type="email" placeholder="Email"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
          </div>

          <div class="flex flex-col space-y-2">
            <label class="text-base text-black">Password</label>
            <input type="password" placeholder="Password"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
          </div>

          <div class="flex flex-col space-y-5 w-full mt-2">
            <label class="flex items-start space-x-2 text-gray-700">
              <input type="checkbox"
                class="mt-1 w-5 h-5 appearance-none rounded-[5px] border border-gray-400
                       checked:bg-[#5465ff] checked:border-[#5465ff] cursor-pointer transition-all duration-200" />
              <span class="text-base leading-relaxed select-none">
                Saya menyetujui 
                <a href="#" class="text-[#5465ff] hover:underline">Syarat & Ketentuan</a> 
                serta 
                <a href="#" class="text-[#5465ff] hover:underline">Kebijakan Privasi</a>.
              </span>
            </label>

            <button type="button"
              class="w-full bg-[#5465ff] hover:bg-[#788bff] text-white py-3 rounded-[10px] font-medium transition">
              Daftar
            </button>
          </div>
        </form>`;

      judulUngu.innerHTML = "Masuk Dan <br> Lanjutkan Progresmu!";
      descUngu.innerHTML = "Jangan Lupa, Konsistensi Kecil <br> Bisa Bawa Hasil Besar!";
      toggleBtn.textContent = "Masuk";

      if (window.innerWidth >= 900) {
        logo.src = "https://ronekimedia.com/wp-content/uploads/2025/05/sdfsdgs.png";
      } else {
        logo.src = "https://ronekimedia.com/wp-content/uploads/2025/05/sdfsdgs.png";
      }
    }

    function setLoginForm() {
      formContainer.innerHTML = `
        <p class="text-[22px] sm:text-[24px] md:text-[26px] font-bold text-black leading-snug w-full">
          Selamat Datang Kembali, <br>Teruskan Progresmu!
        </p>

        <form class="flex flex-col space-y-5 w-full mt-8 md:mt-5">
          <div class="flex flex-col space-y-2">
            <label for="email" class="text-base text-black">Email</label>
            <input type="email" name="email" placeholder="mamal@gmail.com"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     w-full focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
          </div>

          <div class="flex flex-col space-y-2">
            <label for="password" class="text-base text-black">Password</label>
            <input type="password" name="password" placeholder="••••••••"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     w-full focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" />
          </div>

          <div class="flex items-center justify-between w-full">
            <label class="flex items-center space-x-2 text-gray-700">
              <input type="checkbox"
                class="w-5 h-5 appearance-none rounded-[5px] border border-gray-400
                       checked:bg-[#5465ff] checked:border-[#5465ff] cursor-pointer transition-all" />
              <span class="text-base select-none">Ingatkan saya</span>
            </label>

            <a href="#" class="text-[#5465ff] text-base hover:underline">Lupa password?</a>
          </div>

          <button type="button"
            class="mt-8 w-full bg-[#5465ff] hover:bg-[#788bff] text-white py-3 rounded-[10px] font-medium transition">
            Masuk
          </button>
        </form>`;

      judulUngu.innerHTML = "Daftar Sekarang Dan <br> Mulai Catat Progres Belajarmu!";
      descUngu.innerHTML = "Setiap Langkah Kecil Hari Ini Akan Jadi <br> Kemajuan Besar Di Masa Depan.";
      toggleBtn.textContent = "Buat Akun";
      logo.src = "https://ronekimedia.com/wp-content/uploads/2025/05/sdfsdgs.png";
    }

    toggleBtn.addEventListener("click", () => {
      const isMobile = window.innerWidth < 900;

      if (isMobile) {
        gsap.set(panelPutih, { x: 0 });
        gsap.set(panelUngu, { x: 0 });
        isRegister = !isRegister;
        if (isRegister) setRegisterForm();
        else setLoginForm();
        return;
      }

      if (animating) return;
      animating = true;
      isRegister = !isRegister;

      const putihTarget = isRegister ? "100%" : "0%";
      const unguTarget = isRegister ? "-100%" : "0%";

      gsap.to(panelPutih, {
        x: putihTarget,
        duration: 1,
        ease: "back.out(1.2)",
        onStart: () => {
          if (isRegister) setRegisterForm();
          else setLoginForm();
        },
        onComplete: () => (animating = false)
      });

      gsap.to(panelUngu, {
        x: unguTarget,
        duration: 1,
        ease: "back.out(1.2)"
      });
    });

    // 🧩 Reset posisi saat resize dari desktop → mobile
    window.addEventListener("resize", () => {
      if (window.innerWidth < 900) {
        gsap.set(panelPutih, { x: 0 });
        gsap.set(panelUngu, { x: 0 });
      }
    });
  </script>
</body>
</html>
