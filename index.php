<?php
// SIMKOM Interaktif - PHP version
// Halaman utama yang menampilkan semua konten tanpa perlu login
$pageTitle = 'SIMKOM Interaktif';
$initialSaldo = 45250000;
$initialPemasukan = 12800000;
$initialPengeluaran = 8420000;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlentities($pageTitle) ?></title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" />
  <style>
    :root { font-family: 'Inter', sans-serif; }
    body { background: #f8f9ff; color: #0b1c30; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .hidden-page { display: none; }
    .active-page { display: block; }
    .nav-link.active { background: rgba(255,255,255,.18); color: #0b1c30; }
    .hidden { display: none !important; }
  </style>
</head>
<body class="min-h-screen">
  <div class="mx-auto max-w-7xl px-4 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-[320px_minmax(0,1fr)] gap-6">
      <aside class="space-y-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
          <div class="flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-500 text-white">
              <span class="material-symbols-outlined">school</span>
            </div>
            <div>
              <h1 class="text-xl font-semibold">SIMKOM</h1>
              <p class="text-sm text-slate-500">Sistem Manajemen Organisasi</p>
            </div>
          </div>
          <div class="mt-6 space-y-2 text-sm text-slate-600">
            <div class="rounded-2xl bg-slate-50 p-3">
              <p class="font-semibold">Status</p>
              <p id="status-text">Belum login</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-3">
              <p class="font-semibold">Aksi cepat</p>
              <button id="go-dashboard" class="mt-2 inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-4 py-2 text-white transition hover:bg-sky-600">Buka Dashboard</button>
            </div>
          </div>
        </div>
        <nav class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
          <p class="mb-4 font-semibold text-slate-700">Navigasi</p>
          <ul class="space-y-2">
            <li><button class="nav-link w-full flex items-center gap-3 rounded-2xl px-4 py-3 text-left transition hover:bg-slate-100" data-page="dashboard"><span class="material-symbols-outlined">dashboard</span>Dashboard</button></li>
            <li><button class="nav-link w-full flex items-center gap-3 rounded-2xl px-4 py-3 text-left transition hover:bg-slate-100" data-page="kegiatan"><span class="material-symbols-outlined">event</span>Kegiatan</button></li>
            <li><button class="nav-link w-full flex items-center gap-3 rounded-2xl px-4 py-3 text-left transition hover:bg-slate-100" data-page="proposal"><span class="material-symbols-outlined">description</span>Proposal & LPJ</button></li>
            <li><button class="nav-link w-full flex items-center gap-3 rounded-2xl px-4 py-3 text-left transition hover:bg-slate-100" data-page="keuangan"><span class="material-symbols-outlined">account_balance_wallet</span>Keuangan</button></li>
          </ul>
        </nav>
      </aside>
      <main class="space-y-6">
        <div id="page-login">
          <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm max-w-md mx-auto">
            <div class="flex items-center justify-center gap-3 mb-6">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-500 text-white">
                <span class="material-symbols-outlined">lock</span>
              </div>
              <h2 class="text-2xl font-bold">Login SIMKOM</h2>
            </div>
            <form id="login-form" class="space-y-4" method="post" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>">
              <div>
                <label class="block text-sm font-medium mb-2">Email / Username</label>
                <input type="text" id="login-username" name="login_username" placeholder="Masukkan email atau username" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" />
              </div>
              <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <div class="flex items-center gap-2">
                  <input type="password" id="login-password" name="login_password" placeholder="Masukkan password" class="flex-1 rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" />
                  <button type="button" id="toggle-password" class="material-symbols-outlined text-slate-500 hover:text-slate-700 cursor-pointer">visibility</button>
                </div>
              </div>
              <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember_me" class="rounded" />
                <span>Ingat saya</span>
              </label>
              <button type="submit" class="w-full rounded-2xl bg-sky-500 px-4 py-2 text-white font-medium transition hover:bg-sky-600">Login</button>
            </form>
          </div>
        </div>
        <div id="page-dashboard" class="hidden-page">
          <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-bold mb-6">Dashboard Organisasi</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-sky-50 to-sky-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Anggota Aktif</p>
                <p class="text-3xl font-bold text-sky-600 mt-2">150</p>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-emerald-50 to-emerald-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Kegiatan Aktif</p>
                <p class="text-3xl font-bold text-emerald-600 mt-2">5</p>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-violet-50 to-violet-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Kegiatan Selesai</p>
                <p class="text-3xl font-bold text-violet-600 mt-2">24</p>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-amber-50 to-amber-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Pemasukan</p>
                <p class="text-xl font-bold text-amber-600 mt-2">Rp 15.000.000</p>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-rose-50 to-rose-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Pengeluaran</p>
                <p class="text-xl font-bold text-rose-600 mt-2">Rp 12.500.000</p>
              </div>
            </div>
          </div>
        </div>
        <div id="page-kegiatan" class="hidden-page">
          <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-2xl font-bold">Kegiatan Organisasi</h2>
              <button id="btn-add-kegiatan" class="inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-4 py-2 text-white transition hover:bg-sky-600">
                <span class="material-symbols-outlined">add</span>Tambah Kegiatan
              </button>
            </div>
            <div id="kegiatan-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm text-slate-500">Rapat Organisasi</p>
                <p class="mt-3 text-xl font-semibold">Status: Sukses</p>
                <p class="mt-3 text-slate-600">Lokasi: Gedung Serbaguna</p>
                <p class="mt-2 text-slate-500 text-sm">Tanggal: 2026-06-15</p>
              </div>
            </div>
          </div>
        </div>
        <div id="page-proposal" class="hidden-page">
          <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-2xl font-bold">Proposal & LPJ</h2>
              <button id="btn-add-dokumen" class="inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-4 py-2 text-white transition hover:bg-sky-600">
                <span class="material-symbols-outlined">upload</span>Upload PDF
              </button>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full text-left text-sm">
                <thead>
                  <tr class="border-b border-slate-200 bg-slate-50">
                    <th class="px-4 py-3 font-semibold">Nama Dokumen</th>
                    <th class="px-4 py-3 font-semibold">Jenis</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Aksi</th>
                  </tr>
                </thead>
                <tbody id="dokumen-tbody">
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">Proposal Kegiatan Baksos</td>
                    <td class="px-4 py-3">Proposal</td>
                    <td class="px-4 py-3"><span class="rounded-full bg-emerald-100 px-3 py-1 text-emerald-700 text-xs font-medium">Disetujui</span></td>
                    <td class="px-4 py-3"><a href="#" class="text-sky-500 hover:text-sky-700 font-medium text-xs">Lihat</a></td>
                  </tr>
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">LPJ Kegiatan Seminar</td>
                    <td class="px-4 py-3">LPJ</td>
                    <td class="px-4 py-3"><span class="rounded-full bg-blue-100 px-3 py-1 text-blue-700 text-xs font-medium">Review</span></td>
                    <td class="px-4 py-3"><a href="#" class="text-sky-500 hover:text-sky-700 font-medium text-xs">Lihat</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div id="page-keuangan" class="hidden-page">
          <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-2xl font-bold">Manajemen Keuangan</h2>
              <button id="btn-add-transaksi" class="inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-4 py-2 text-white transition hover:bg-sky-600">
                <span class="material-symbols-outlined">add</span>Tambah Transaksi
              </button>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-6">
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-sky-50 to-sky-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Saldo</p>
                <p id="saldo-text" class="text-2xl font-bold text-sky-600 mt-2"><?= 'Rp ' . number_format($initialSaldo, 0, ',', '.') ?></p>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-emerald-50 to-emerald-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Pemasukan</p>
                <p id="pemasukan-text" class="text-2xl font-bold text-emerald-600 mt-2"><?= 'Rp ' . number_format($initialPemasukan, 0, ',', '.') ?></p>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-rose-50 to-rose-100 p-5">
                <p class="text-sm text-slate-600 font-medium">Pengeluaran</p>
                <p id="pengeluaran-text" class="text-2xl font-bold text-rose-600 mt-2"><?= 'Rp ' . number_format($initialPengeluaran, 0, ',', '.') ?></p>
              </div>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full text-left text-sm">
                <thead>
                  <tr class="border-b border-slate-200 bg-slate-50">
                    <th class="px-4 py-3 font-semibold">Deskripsi</th>
                    <th class="px-4 py-3 font-semibold">Jenis</th>
                    <th class="px-4 py-3 font-semibold text-right">Jumlah</th>
                  </tr>
                </thead>
                <tbody id="transaksi-tbody">
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">Iuran Anggota Bulan Juni</td>
                    <td class="px-4 py-3">Pemasukan</td>
                    <td class="px-4 py-3 text-right text-emerald-700">Rp 5.000.000</td>
                  </tr>
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">Pembelian Perlengkapan Acara</td>
                    <td class="px-4 py-3">Pengeluaran</td>
                    <td class="px-4 py-3 text-right text-rose-600">Rp 2.000.000</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <div id="modal-kegiatan" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full mx-4">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold">Tambah Kegiatan</h3>
        <button id="close-modal-kegiatan" class="material-symbols-outlined text-slate-500 hover:text-slate-700 cursor-pointer">close</button>
      </div>
      <form id="form-kegiatan" class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-2">Nama Kegiatan</label>
          <input type="text" id="kegiatan-nama" placeholder="Masukkan nama kegiatan" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Lokasi</label>
          <input type="text" id="kegiatan-lokasi" placeholder="Masukkan lokasi" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Tanggal</label>
          <input type="date" id="kegiatan-tanggal" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Status</label>
          <select id="kegiatan-status" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required>
            <option value="Rencana">Rencana</option>
            <option value="On-Going">On-Going</option>
            <option value="Sukses">Sukses</option>
          </select>
        </div>
        <div class="flex gap-3 pt-4">
          <button type="submit" class="flex-1 rounded-2xl bg-sky-500 px-4 py-2 text-white font-medium transition hover:bg-sky-600">Simpan</button>
          <button type="button" id="close-modal-kegiatan-btn" class="flex-1 rounded-2xl border border-slate-200 px-4 py-2 text-slate-700 font-medium transition hover:bg-slate-50">Batal</button>
        </div>
      </form>
    </div>
  </div>
  <div id="modal-transaksi" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full mx-4">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold">Tambah Transaksi</h3>
        <button id="close-modal-transaksi" class="material-symbols-outlined text-slate-500 hover:text-slate-700 cursor-pointer">close</button>
      </div>
      <form id="form-transaksi" class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-2">Deskripsi</label>
          <input type="text" id="transaksi-deskripsi" placeholder="Masukkan deskripsi transaksi" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Jenis Transaksi</label>
          <select id="transaksi-tipe" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required>
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Jumlah (Rp)</label>
          <input type="number" id="transaksi-jumlah" placeholder="Masukkan jumlah" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div class="flex gap-3 pt-4">
          <button type="submit" class="flex-1 rounded-2xl bg-sky-500 px-4 py-2 text-white font-medium transition hover:bg-sky-600">Simpan</button>
          <button type="button" id="close-modal-transaksi-btn" class="flex-1 rounded-2xl border border-slate-200 px-4 py-2 text-slate-700 font-medium transition hover:bg-slate-50">Batal</button>
        </div>
      </form>
    </div>
  </div>
  <div id="modal-dokumen" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full mx-4">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold">Upload Dokumen</h3>
        <button id="close-modal-dokumen" class="material-symbols-outlined text-slate-500 hover:text-slate-700 cursor-pointer">close</button>
      </div>
      <form id="form-dokumen" class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-2">Nama Dokumen</label>
          <input type="text" id="dokumen-nama" placeholder="Misal: Proposal Baksos 2024" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Jenis Dokumen</label>
          <select id="dokumen-jenis" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required>
            <option value="Proposal">Proposal</option>
            <option value="LPJ">LPJ</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">File PDF</label>
          <input type="file" id="dokumen-file" accept=".pdf" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
          <p class="text-xs text-slate-500 mt-1">Maksimal 10MB, format PDF</p>
        </div>
        <div class="flex gap-3 pt-4">
          <button type="submit" class="flex-1 rounded-2xl bg-sky-500 px-4 py-2 text-white font-medium transition hover:bg-sky-600">Upload</button>
          <button type="button" id="close-modal-dokumen-btn" class="flex-1 rounded-2xl border border-slate-200 px-4 py-2 text-slate-700 font-medium transition hover:bg-slate-50">Batal</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    const loginForm = document.getElementById('login-form');
    const pageLogin = document.getElementById('page-login');
    const pageDashboard = document.getElementById('page-dashboard');
    const pageKegiatan = document.getElementById('page-kegiatan');
    const pageProposal = document.getElementById('page-proposal');
    const pageKeuangan = document.getElementById('page-keuangan');
    const navLinks = document.querySelectorAll('.nav-link');
    const statusText = document.getElementById('status-text');
    const goDashboard = document.getElementById('go-dashboard');
    const togglePassword = document.getElementById('toggle-password');
    const passwordField = document.getElementById('login-password');

    const modalKegiatan = document.getElementById('modal-kegiatan');
    const btnAddKegiatan = document.getElementById('btn-add-kegiatan');
    const formKegiatan = document.getElementById('form-kegiatan');
    const closeModalKegiatan = document.getElementById('close-modal-kegiatan');
    const closeModalKegiatanBtn = document.getElementById('close-modal-kegiatan-btn');
    const kegiatanList = document.getElementById('kegiatan-list');

    const modalDokumen = document.getElementById('modal-dokumen');
    const btnAddDokumen = document.getElementById('btn-add-dokumen');
    const formDokumen = document.getElementById('form-dokumen');
    const closeModalDokumen = document.getElementById('close-modal-dokumen');
    const closeModalDokumenBtn = document.getElementById('close-modal-dokumen-btn');
    const dokumenTbody = document.getElementById('dokumen-tbody');

    const modalTransaksi = document.getElementById('modal-transaksi');
    const btnAddTransaksi = document.getElementById('btn-add-transaksi');
    const formTransaksi = document.getElementById('form-transaksi');
    const closeModalTransaksi = document.getElementById('close-modal-transaksi');
    const closeModalTransaksiBtn = document.getElementById('close-modal-transaksi-btn');
    const transaksiTbody = document.getElementById('transaksi-tbody');

    let saldoKeuangan = <?= $initialSaldo ?>;
    let totalPemasukan = <?= $initialPemasukan ?>;
    let totalPengeluaran = <?= $initialPengeluaran ?>;

    const pages = {
      dashboard: pageDashboard,
      kegiatan: pageKegiatan,
      proposal: pageProposal,
      keuangan: pageKeuangan
    };

    function formatRupiah(num) {
      return 'Rp ' + num.toLocaleString('id-ID');
    }

    function showPage(pageId) {
      pageLogin.classList.add('hidden-page');
      Object.values(pages).forEach(page => page.classList.add('hidden-page'));
      if (pageId === 'login') {
        pageLogin.classList.remove('hidden-page');
        statusText.textContent = 'Belum login';
        document.title = 'SIMKOM Interaktif - Login';
      } else {
        pages[pageId].classList.remove('hidden-page');
        statusText.textContent = 'Sedang aktif: ' + pageId;
        document.title = 'SIMKOM Interaktif - ' + pageId.charAt(0).toUpperCase() + pageId.slice(1);
      }
      navLinks.forEach(link => {
        link.classList.toggle('active', link.dataset.page === pageId);
      });
    }

    loginForm.addEventListener('submit', event => {
      event.preventDefault();
      showPage('dashboard');
    });

    navLinks.forEach(link => {
      link.addEventListener('click', () => showPage(link.dataset.page));
    });

    goDashboard.addEventListener('click', () => showPage('dashboard'));

    togglePassword.addEventListener('click', () => {
      passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
      togglePassword.textContent = passwordField.type === 'password' ? 'visibility' : 'visibility_off';
    });

    btnAddKegiatan.addEventListener('click', () => {
      formKegiatan.reset();
      modalKegiatan.classList.remove('hidden');
    });

    closeModalKegiatan.addEventListener('click', () => {
      modalKegiatan.classList.add('hidden');
    });

    closeModalKegiatanBtn.addEventListener('click', () => {
      modalKegiatan.classList.add('hidden');
    });

    formKegiatan.addEventListener('submit', e => {
      e.preventDefault();
      const nama = document.getElementById('kegiatan-nama').value;
      const lokasi = document.getElementById('kegiatan-lokasi').value;
      const tanggal = document.getElementById('kegiatan-tanggal').value;
      const status = document.getElementById('kegiatan-status').value;
      const card = document.createElement('div');
      card.className = 'rounded-3xl border border-slate-200 bg-slate-50 p-5';
      card.innerHTML = '<p class="text-sm text-slate-500">' + nama + '</p><p class="mt-3 text-xl font-semibold">Status: ' + status + '</p><p class="mt-3 text-slate-600">Lokasi: ' + lokasi + '</p><p class="mt-2 text-slate-500 text-sm">Tanggal: ' + tanggal + '</p>';
      kegiatanList.appendChild(card);
      modalKegiatan.classList.add('hidden');
    });

    modalKegiatan.addEventListener('click', e => {
      if (e.target === modalKegiatan) modalKegiatan.classList.add('hidden');
    });

    btnAddDokumen.addEventListener('click', () => {
      formDokumen.reset();
      modalDokumen.classList.remove('hidden');
    });

    closeModalDokumen.addEventListener('click', () => {
      modalDokumen.classList.add('hidden');
    });

    closeModalDokumenBtn.addEventListener('click', () => {
      modalDokumen.classList.add('hidden');
    });

    formDokumen.addEventListener('submit', e => {
      e.preventDefault();
      const nama = document.getElementById('dokumen-nama').value;
      const jenis = document.getElementById('dokumen-jenis').value;
      const file = document.getElementById('dokumen-file').files[0];
      
      if (!file) {
        alert('Pilih file PDF terlebih dahulu');
        return;
      }

      if (file.type !== 'application/pdf') {
        alert('File harus berformat PDF');
        return;
      }

      if (file.size > 10 * 1024 * 1024) {
        alert('Ukuran file maksimal 10MB');
        return;
      }

      const tr = document.createElement('tr');
      tr.className = 'border-b border-slate-200';
      const status = 'Pending';
      const statusColor = status === 'Disetujui' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700';
      tr.innerHTML = '<td class="px-4 py-3">' + nama + '</td><td class="px-4 py-3">' + jenis + '</td><td class="px-4 py-3"><span class="rounded-full ' + statusColor + ' px-3 py-1 text-xs font-medium">' + status + '</span></td><td class="px-4 py-3"><a href="#" class="text-sky-500 hover:text-sky-700 font-medium text-xs">Lihat</a></td>';
      dokumenTbody.appendChild(tr);
      
      modalDokumen.classList.add('hidden');
    });

    modalDokumen.addEventListener('click', e => {
      if (e.target === modalDokumen) modalDokumen.classList.add('hidden');
    });

    btnAddTransaksi.addEventListener('click', () => {
      formTransaksi.reset();
      modalTransaksi.classList.remove('hidden');
    });

    closeModalTransaksi.addEventListener('click', () => {
      modalTransaksi.classList.add('hidden');
    });

    closeModalTransaksiBtn.addEventListener('click', () => {
      modalTransaksi.classList.add('hidden');
    });

    formTransaksi.addEventListener('submit', e => {
      e.preventDefault();
      const deskripsi = document.getElementById('transaksi-deskripsi').value;
      const tipe = document.getElementById('transaksi-tipe').value;
      const jumlah = parseInt(document.getElementById('transaksi-jumlah').value, 10);
      if (tipe === 'pemasukan') {
        saldoKeuangan += jumlah;
        totalPemasukan += jumlah;
      } else {
        saldoKeuangan -= jumlah;
        totalPengeluaran += jumlah;
      }
      const tr = document.createElement('tr');
      tr.className = 'border-b border-slate-200';
      const warnaJumlah = tipe === 'pemasukan' ? 'text-emerald-700' : 'text-rose-600';
      const tipeLabel = tipe === 'pemasukan' ? 'Pemasukan' : 'Pengeluaran';
      tr.innerHTML = '<td class="px-4 py-3">' + deskripsi + '</td><td class="px-4 py-3">' + tipeLabel + '</td><td class="px-4 py-3 text-right ' + warnaJumlah + '">' + formatRupiah(jumlah) + '</td>';
      transaksiTbody.appendChild(tr);
      document.getElementById('saldo-text').textContent = formatRupiah(saldoKeuangan);
      document.getElementById('pemasukan-text').textContent = formatRupiah(totalPemasukan);
      document.getElementById('pengeluaran-text').textContent = formatRupiah(totalPengeluaran);
      modalTransaksi.classList.add('hidden');
    });

    modalTransaksi.addEventListener('click', e => {
      if (e.target === modalTransaksi) modalTransaksi.classList.add('hidden');
    });

    showPage('login');
  </script>
</body>
</html>
