<?php
require_once __DIR__ . '/includes/config.php';
ensureAuthenticated();
require_once __DIR__ . '/includes/layout.php';
renderHeader('Dashboard - SIMKOM');
renderSidebar('dashboard');
?>
<main>
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
</main>
<?php
renderFooter();
