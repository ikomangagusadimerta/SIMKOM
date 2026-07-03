<?php
require_once __DIR__ . '/includes/config.php';
ensureAuthenticated();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transaksi_submit'])) {
    $deskripsi = trim($_POST['transaksi_deskripsi'] ?? '');
    $tipe = trim($_POST['transaksi_tipe'] ?? 'pemasukan');
    $jumlah = intval($_POST['transaksi_jumlah'] ?? 0, 10);
    if ($deskripsi !== '' && $jumlah > 0) {
        addKeuanganTransaction($deskripsi, $tipe, $jumlah);
        header('Location: keuangan.php');
        exit;
    }
}

$keuangan = getKeuanganData();
require_once __DIR__ . '/includes/layout.php';
renderHeader('Keuangan - SIMKOM');
renderSidebar('keuangan');
?>
<main>
  <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Manajemen Keuangan</h2>
      <button onclick="document.getElementById('modal-transaksi').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-4 py-2 text-white transition hover:bg-sky-600">
        <span class="material-symbols-outlined">add</span>Tambah Transaksi
      </button>
    </div>
    <div class="grid grid-cols-3 gap-4 mb-6">
      <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-sky-50 to-sky-100 p-5">
        <p class="text-sm text-slate-600 font-medium">Saldo</p>
        <p id="saldo-text" class="text-2xl font-bold text-sky-600 mt-2"><?= formatRupiah($keuangan['saldo']) ?></p>
      </div>
      <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-emerald-50 to-emerald-100 p-5">
        <p class="text-sm text-slate-600 font-medium">Pemasukan</p>
        <p id="pemasukan-text" class="text-2xl font-bold text-emerald-600 mt-2"><?= formatRupiah($keuangan['pemasukan']) ?></p>
      </div>
      <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-rose-50 to-rose-100 p-5">
        <p class="text-sm text-slate-600 font-medium">Pengeluaran</p>
        <p id="pengeluaran-text" class="text-2xl font-bold text-rose-600 mt-2"><?= formatRupiah($keuangan['pengeluaran']) ?></p>
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
        <tbody>
          <?php foreach ($keuangan['transaksi'] as $item): ?>
          <tr class="border-b border-slate-200">
            <td class="px-4 py-3"><?= htmlentities($item['deskripsi']) ?></td>
            <td class="px-4 py-3"><?= htmlentities($item['tipe']) ?></td>
            <td class="px-4 py-3 text-right <?= $item['tipe'] === 'Pemasukan' ? 'text-emerald-700' : 'text-rose-600' ?>"><?= formatRupiah($item['jumlah']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div id="modal-transaksi" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full mx-4">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold">Tambah Transaksi</h3>
        <button onclick="document.getElementById('modal-transaksi').classList.add('hidden')" class="material-symbols-outlined text-slate-500 hover:text-slate-700 cursor-pointer">close</button>
      </div>
      <form class="space-y-4" method="post" action="keuangan.php">
        <input type="hidden" name="transaksi_submit" value="1" />
        <div>
          <label class="block text-sm font-medium mb-2">Deskripsi</label>
          <input type="text" name="transaksi_deskripsi" placeholder="Masukkan deskripsi transaksi" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Jenis Transaksi</label>
          <select name="transaksi_tipe" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required>
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Jumlah (Rp)</label>
          <input type="number" name="transaksi_jumlah" placeholder="Masukkan jumlah" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div class="flex gap-3 pt-4">
          <button type="submit" class="flex-1 rounded-2xl bg-sky-500 px-4 py-2 text-white font-medium transition hover:bg-sky-600">Simpan</button>
          <button type="button" onclick="document.getElementById('modal-transaksi').classList.add('hidden')" class="flex-1 rounded-2xl border border-slate-200 px-4 py-2 text-slate-700 font-medium transition hover:bg-slate-50">Batal</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php
renderFooter();
