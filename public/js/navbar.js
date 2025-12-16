const toggleDesktop = document.getElementById('toggleDesktop');
const toggleMobile  = document.getElementById('toggleMobile');
const mobileIcon    = document.getElementById('mobileIcon');

const sidebar  = document.getElementById('sidebar');
const overlay  = document.getElementById('sidebarOverlay');
const root     = document.documentElement;

const notifBtn = document.getElementById('notifBtn');
const notifMenu = document.getElementById('notifMenu');
const closeNotifBtn = document.getElementById('closeNotifBtn');

const profileBtn = document.getElementById('profileBtn');
const profileMenu = document.getElementById('profileMenu');
const profileArrow = document.getElementById('profileArrow');

const darkToggleBtn = document.getElementById('darkModeToggle');

let sidebarOpen = false;
let isMobile = window.innerWidth < 1280;

/* ================= SIDEBAR ================= */
function openDesktop() {
  root.style.setProperty('--sidebar-width', '15rem');
  document.querySelectorAll('.sidebar-text').forEach(el => el.classList.remove('hidden'));
  sidebarOpen = true;
}
function closeDesktop() {
  root.style.setProperty('--sidebar-width', '5rem');
  document.querySelectorAll('.sidebar-text').forEach(el => el.classList.add('hidden'));
  sidebarOpen = false;
}
function openMobile() {
  sidebar.classList.add('active');
  overlay.classList.add('active');
  mobileIcon.className = 'fa-solid fa-xmark';
  sidebarOpen = true;
}
function closeMobile() {
  sidebar.classList.remove('active');
  overlay.classList.remove('active');
  mobileIcon.className = 'fa-solid fa-bars-staggered';
  sidebarOpen = false;
}

toggleDesktop?.addEventListener('click', () => sidebarOpen ? closeDesktop() : openDesktop());
toggleMobile?.addEventListener('click', () => sidebarOpen ? closeMobile() : openMobile());
overlay?.addEventListener('click', closeMobile);

/* ================= AUTO RESET BREAKPOINT ================= */
window.addEventListener('resize', () => {
  const nowMobile = window.innerWidth < 1280;

  if (nowMobile && !isMobile) { closeDesktop(); closeMobile(); }
  if (!nowMobile && isMobile) { closeMobile(); closeDesktop(); }

  notifMenu.classList.add('hidden');
  profileMenu.classList.add('hidden');
  profileArrow?.classList.remove('rotate-180');

  isMobile = nowMobile;
});

/* ================= NOTIF ================= */
notifBtn?.addEventListener('click', (e) => {
  e.stopPropagation();
  notifMenu.classList.toggle('hidden');
  profileMenu.classList.add('hidden');
});

closeNotifBtn?.addEventListener('click', (e) => {
  e.stopPropagation();
  notifMenu.classList.add('hidden');
});

notifMenu?.addEventListener('click', e => e.stopPropagation());

/* ================= PROFILE ================= */
profileBtn?.addEventListener('click', (e) => {
  e.stopPropagation();
  profileMenu.classList.toggle('hidden');
  notifMenu.classList.add('hidden');
  if (profileArrow) profileArrow.classList.toggle('rotate-180');
});

profileMenu?.addEventListener('click', e => e.stopPropagation());

/* ================= GLOBAL CLICK ================= */
document.addEventListener('click', () => {
  notifMenu?.classList.add('hidden');
  profileMenu?.classList.add('hidden');
  if (profileArrow) profileArrow.classList.remove('rotate-180');
});

/* ================= DARK MODE (PERSISTENT) ================= */

/* LOAD SAAT PAGE BUKA */
if (localStorage.getItem('theme') === 'dark') {
  root.classList.add('dark');
}

/* TOGGLE MODE */
darkToggleBtn?.addEventListener('click', () => {
  root.classList.toggle('dark');

  if (root.classList.contains('dark')) {
    localStorage.setItem('theme', 'dark');
  } else {
    localStorage.setItem('theme', 'light');
  }
});

function toggleDark() {
  document.documentElement.classList.add("no-transition");
  document.documentElement.classList.toggle("dark");

  setTimeout(() => {
    document.documentElement.classList.remove("no-transition");
  }, 50); // kecil aja, biar cuma pas toggle
}
