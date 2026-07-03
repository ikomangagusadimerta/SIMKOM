<?php
require_once __DIR__ . '/includes/config.php';
ensureAuthenticated();
require_once __DIR__ . '/includes/layout.php';
renderHeader('Proposal & LPJ - SIMKOM');
renderSidebar('proposal');
?>
<main>
  <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-2xl font-bold mb-6">Proposal & LPJ</h2>
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm">
        <thead>
          <tr class="border-b border-slate-200 bg-slate-50">
            <th class="px-4 py-3 font-semibold">Nama Dokumen</th>
            <th class="px-4 py-3 font-semibold">Jenis</th>
            <th class="px-4 py-3 font-semibold">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b border-slate-200">
            <td class="px-4 py-3">Proposal Kegiatan Baksos</td>
            <td class="px-4 py-3">Proposal</td>
            <td class="px-4 py-3"><span class="rounded-full bg-emerald-100 px-3 py-1 text-emerald-700 text-xs font-medium">Disetujui</span></td>
          </tr>
          <tr class="border-b border-slate-200">
            <td class="px-4 py-3">LPJ Kegiatan Seminar</td>
            <td class="px-4 py-3">LPJ</td>
            <td class="px-4 py-3"><span class="rounded-full bg-blue-100 px-3 py-1 text-blue-700 text-xs font-medium">Review</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>
<?php
renderFooter();
