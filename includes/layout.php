<?php
function renderHeader($title = 'SIMKOM Interaktif') {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title><?= htmlentities($title) ?></title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" />
      <link rel="stylesheet" href="assets/styles.css" />
      <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .active-nav { background: rgba(56, 189, 248, 0.12); color: #0b1c30; }
      </style>
    </head>
    <body class="min-h-screen">
    <div class="mx-auto max-w-7xl px-4 py-6">
      <div class="grid grid-cols-1 lg:grid-cols-[300px_minmax(0,1fr)] gap-6">
    <?php
}

function renderFooter() {
    ?>
      </div>
    </div>
    </body>
    </html>
    <?php
}

function renderSidebar($activePage) {
    $menu = [
        'dashboard' => ['icon' => 'dashboard', 'label' => 'Dashboard', 'url' => 'dashboard.php'],
        'kegiatan' => ['icon' => 'event', 'label' => 'Kegiatan', 'url' => 'kegiatan.php'],
        'proposal' => ['icon' => 'description', 'label' => 'Proposal & LPJ', 'url' => 'proposal.php'],
        'keuangan' => ['icon' => 'account_balance_wallet', 'label' => 'Keuangan', 'url' => 'keuangan.php'],
    ];
    ?>
    <aside class="space-y-6">
      <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <div class="flex items-center gap-4 mb-8">
          <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-500 text-white">
            <span class="material-symbols-outlined text-3xl">school</span>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-slate-900">SIMKOM</h1>
            <p class="text-sm text-slate-500">Sistem Manajemen Organisasi</p>
          </div>
        </div>
        <div class="space-y-4">
          <?php if (isset($_SESSION['user_id'])): ?>
            <div>
              <p class="text-sm font-semibold text-slate-600 mb-1">Status</p>
              <p class="text-slate-700">
                Sedang aktif: 
                <span class="font-semibold text-slate-900">
                  <?php 
                    $pageLabels = [
                      'dashboard' => 'Dashboard',
                      'kegiatan' => 'Kegiatan',
                      'proposal' => 'Proposal',
                      'keuangan' => 'Keuangan',
                    ];
                    echo $pageLabels[$activePage] ?? 'Halaman';
                  ?>
                </span>
              </p>
            </div>
            <div>
              <p class="text-sm font-semibold text-slate-600 mb-2">Aksi cepat</p>
              <a href="dashboard.php" class="inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-6 py-2 text-white font-medium transition hover:bg-sky-600">
                <span class="material-symbols-outlined text-sm">home</span>Buka Dashboard
              </a>
            </div>
          <?php else: ?>
            <div>
              <p class="text-sm font-semibold text-slate-600 mb-2">Login</p>
              <a href="login.php" class="inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-6 py-2 text-white font-medium transition hover:bg-sky-600">
                <span class="material-symbols-outlined text-sm">lock</span>Masuk Sekarang
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <?php if (isset($_SESSION['user_id'])): ?>
      <nav class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
        <p class="mb-4 font-semibold text-slate-700">Navigasi</p>
        <ul class="space-y-2">
          <?php foreach ($menu as $key => $item): ?>
            <li>
              <a href="<?= $item['url'] ?>" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left transition hover:bg-slate-100 <?= $activePage === $key ? 'active-nav' : '' ?>">
                <span class="material-symbols-outlined"><?= $item['icon'] ?></span>
                <?= $item['label'] ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </nav>
      <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
        <a href="logout.php" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left transition hover:bg-slate-100 text-slate-700">
          <span class="material-symbols-outlined">logout</span>
          Logout
        </a>
      </div>
      <?php endif; ?>
    <?php
}
