<?php
require_once __DIR__ . '/includes/config.php';
ensureAuthenticated();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kegiatan_submit'])) {
    $nama = trim($_POST['kegiatan_nama'] ?? '');
    $lokasi = trim($_POST['kegiatan_lokasi'] ?? '');
    $tanggal = trim($_POST['kegiatan_tanggal'] ?? '');
    $status = trim($_POST['kegiatan_status'] ?? 'Rencana');
    if ($nama !== '' && $lokasi !== '' && $tanggal !== '') {
        addKegiatan($nama, $lokasi, $tanggal, $status);
        header('Location: kegiatan.php');
        exit;
    }
}

$kegiatan = getKegiatanData();
require_once __DIR__ . '/includes/layout.php';
renderHeader('Kegiatan - SIMKOM');
renderSidebar('kegiatan');
?>
<main>
  <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Kegiatan Organisasi</h2>
      <button onclick="document.getElementById('modal-kegiatan').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-4 py-2 text-white transition hover:bg-sky-600">
        <span class="material-symbols-outlined">add</span>Tambah Kegiatan
      </button>
    </div>
    <div id="kegiatan-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <?php foreach ($kegiatan as $item): ?>
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
          <p class="text-sm text-slate-500"><?= htmlentities($item['nama']) ?></p>
          <p class="mt-3 text-xl font-semibold">Status: <?= htmlentities($item['status']) ?></p>
          <p class="mt-3 text-slate-600">Lokasi: <?= htmlentities($item['lokasi']) ?></p>
          <p class="mt-2 text-slate-500 text-sm">Tanggal: <?= htmlentities($item['tanggal']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div id="modal-kegiatan" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full mx-4">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold">Tambah Kegiatan</h3>
        <button onclick="document.getElementById('modal-kegiatan').classList.add('hidden')" class="material-symbols-outlined text-slate-500 hover:text-slate-700 cursor-pointer">close</button>
      </div>
      <form class="space-y-4" method="post" action="kegiatan.php">
        <input type="hidden" name="kegiatan_submit" value="1" />
        <div>
          <label class="block text-sm font-medium mb-2">Nama Kegiatan</label>
          <input type="text" name="kegiatan_nama" placeholder="Masukkan nama kegiatan" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Lokasi</label>
          <input type="text" name="kegiatan_lokasi" placeholder="Masukkan lokasi" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Tanggal</label>
          <input type="date" name="kegiatan_tanggal" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-2">Status</label>
          <select name="kegiatan_status" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" required>
            <option value="Rencana">Rencana</option>
            <option value="On-Going">On-Going</option>
            <option value="Sukses">Sukses</option>
          </select>
        </div>
        <div class="flex gap-3 pt-4">
          <button type="submit" class="flex-1 rounded-2xl bg-sky-500 px-4 py-2 text-white font-medium transition hover:bg-sky-600">Simpan</button>
          <button type="button" onclick="document.getElementById('modal-kegiatan').classList.add('hidden')" class="flex-1 rounded-2xl border border-slate-200 px-4 py-2 text-slate-700 font-medium transition hover:bg-slate-50">Batal</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php
renderFooter();
