<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login / Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

      <!-- LOGIN FORM -->
      <form id="loginForm" class="flex flex-col space-y-5 w-full mt-8 md:mt-5">
        <div class="flex flex-col space-y-2">
          <label for="email" class="text-base text-black">Email</label>
          <input type="email" name="email" placeholder="mamal@gmail.com"
            class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                   w-full focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" required/>
        </div>

        <div class="flex flex-col space-y-2">
          <label for="password" class="text-base text-black">Password</label>
          <input type="password" name="password" placeholder="••••••••"
            class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                   w-full focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" required/>
        </div>

        <button type="submit"
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

    let isRegister = false;
    let animating = false;

    // --- FORM REGISTER (sesuai tabel user kamu)
    function setRegisterForm() {
      formContainer.innerHTML = `
        <p class="text-[22px] sm:text-[24px] md:text-[26px] font-bold text-black leading-snug w-full">
          Buat Akun Baru, <br>Mulai Catat Progres Belajarmu!
        </p>

        <form id="registerForm" class="flex flex-col space-y-5 w-full mt-8 md:mt-5">
          <div class="flex flex-col space-y-2">
            <label class="text-base text-black">Username</label>
            <input type="text" name="username" placeholder="Masukkan username"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" required />
          </div>

          <div class="flex flex-col space-y-2">
            <label class="text-base text-black">Email</label>
            <input type="email" name="email" placeholder="Masukkan email"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" required />
          </div>

          <div class="flex flex-col space-y-2">
            <label class="text-base text-black">Password</label>
            <input type="password" name="password" placeholder="Masukkan password"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" required />
          </div>

          <button type="submit"
            class="mt-8 w-full bg-[#5465ff] hover:bg-[#788bff] text-white py-3 rounded-[10px] font-medium transition">
            Daftar
          </button>
        </form>
      `;

      judulUngu.innerHTML = "Masuk Dan <br> Lanjutkan Progresmu!";
      descUngu.innerHTML = "Jangan Lupa, Konsistensi Kecil Bisa Bawa Hasil Besar!";
      toggleBtn.textContent = "Masuk";
    }

    // --- FORM LOGIN (balikin tampilan awal)
    function setLoginForm() {
      formContainer.innerHTML = `
        <p class="text-[22px] sm:text-[24px] md:text-[26px] font-bold text-black leading-snug w-full">
          Selamat Datang Kembali, <br>Teruskan Progresmu!
        </p>

        <form id="loginForm" class="flex flex-col space-y-5 w-full mt-8 md:mt-5">
          <div class="flex flex-col space-y-2">
            <label class="text-base text-black">Email</label>
            <input type="email" name="email" placeholder="mamal@gmail.com"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" required/>
          </div>

          <div class="flex flex-col space-y-2">
            <label class="text-base text-black">Password</label>
            <input type="password" name="password" placeholder="••••••••"
              class="h-12 md:h-14 rounded-[10px] border border-gray-300 px-4 text-gray-700 text-lg
                     focus:border-[#5465ff] focus:ring-2 focus:ring-[#5465ff]/40 outline-none transition-all duration-200" required/>
          </div>

          <button type="submit"
            class="mt-8 w-full bg-[#5465ff] hover:bg-[#788bff] text-white py-3 rounded-[10px] font-medium transition">
            Masuk
          </button>
        </form>
      `;

      judulUngu.innerHTML = "Daftar Sekarang Dan <br> Mulai Catat Progres Belajarmu!";
      descUngu.innerHTML = "Setiap Langkah Kecil Hari Ini Akan Jadi Kemajuan Besar Di Masa Depan.";
      toggleBtn.textContent = "Buat Akun";
    }

    // --- ANIMASI SWITCH LOGIN / REGISTER
    toggleBtn.addEventListener("click", () => {
      if (animating) return;
      animating = true;
      isRegister = !isRegister;

      const putihTarget = isRegister ? "100%" : "0%";
      const unguTarget = isRegister ? "-100%" : "0%";

      gsap.to(panelPutih, {
        x: putihTarget, duration: 1, ease: "back.out(1.2)",
        onStart: () => { isRegister ? setRegisterForm() : setLoginForm(); },
        onComplete: () => animating = false
      });

      gsap.to(panelUngu, { x: unguTarget, duration: 1, ease: "back.out(1.2)" });
    });

    // --- FETCH API: REGISTER / LOGIN HANDLER
    document.addEventListener("submit", async (e) => {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);
      const action = form.id === "registerForm" ? "register" : "login";

      try {
        const response = await fetch(`${window.location.origin}/composer-template/public/user/auth/handleRequest?action=${action}`, {
          method: "POST",
          body: formData
        });

        console.log("Response status:", response.status);
        const text = await response.text();
        console.log("Raw response:", text);

        let result;
        try {
          result = JSON.parse(text);
        } catch (e) {
          Swal.fire({
            icon: "error",
            title: "Server Error!",
            html: "<pre style='text-align:left;white-space:pre-wrap'>" + text + "</pre>",
            confirmButtonColor: "#5465ff"
          });
          return;
        }

        console.log("Result:", result);

        Swal.fire({
          icon: result.status === "success" ? "success" : "error",
          title: result.status === "success" ? "Berhasil!" : "Gagal!",
          text: result.message,
          confirmButtonColor: "#5465ff"
        }).then(() => {
          if (result.status === "success" && action === "register") {
            setLoginForm();
          }
          if (result.status === "success" && action === "login") {
            window.location.href = "/dashboard";
          }
        });
      } catch (err) {
        Swal.fire({
          icon: "error",
          title: "Terjadi Kesalahan!",
          text: "Gagal terhubung ke server.",
          confirmButtonColor: "#5465ff"
        });
      }
    });
    document.addEventListener("input", async (e) => {
      if (e.target.name === "username") {
        const username = e.target.value.trim();
        if (!username) return;

        try {
          const res = await fetch(`${window.location.origin}/composer-template/public/user/auth/checkUsername?username=${encodeURIComponent(username)}`);
          const result = await res.json();

          if (!result.available) {
            e.target.classList.add("border-red-500");
            Swal.fire({
              icon: "warning",
              title: "Username sudah digunakan!",
              text: "Silakan pilih username lain.",
              confirmButtonColor: "#5465ff"
            });
          } else {
            e.target.classList.remove("border-red-500");
          }
        } catch (err) {
          console.error("Gagal cek username:", err);
        }
      }
    });

  </script>
</body>
</html>