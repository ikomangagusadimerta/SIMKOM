<?php
session_start();

$dbConfig = [
    'host' => 'localhost',
    'dbname' => 'simkom',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];

function getDbConnection() {
    global $dbConfig;
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $dbConfig['host'], $dbConfig['dbname'], $dbConfig['charset']);

    try {
        $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $error) {
        error_log('Database connection failed: ' . $error->getMessage());
        die('Koneksi database gagal. Periksa konfigurasi di includes/config.php');
    }

    return $pdo;
}

// ===== USER FUNCTIONS =====
function authenticateUser($username, $password) {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare('SELECT id, username, display_name, password_hash FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $user['username'];
            $_SESSION['display_name'] = $user['display_name'];
            return true;
        }
        return false;
    } catch (PDOException $e) {
        error_log('Authentication error: ' . $e->getMessage());
        return false;
    }
}

function logoutUser() {
    session_destroy();
    header('Location: login.php');
    exit;
}

// ===== KEGIATAN FUNCTIONS =====
function getKegiatanData() {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->query('SELECT id, nama, lokasi, tanggal, status FROM kegiatan ORDER BY created_at DESC');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log('Get kegiatan error: ' . $e->getMessage());
        return [];
    }
}

function addKegiatan($nama, $lokasi, $tanggal, $status) {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare('INSERT INTO kegiatan (nama, lokasi, tanggal, status) VALUES (?, ?, ?, ?)');
        $stmt->execute([$nama, $lokasi, $tanggal, $status]);
        return true;
    } catch (PDOException $e) {
        error_log('Add kegiatan error: ' . $e->getMessage());
        return false;
    }
}

// ===== TRANSAKSI FUNCTIONS =====
function getKeuanganData() {
    try {
        $pdo = getDbConnection();
        
        // Get transaksi list
        $stmt = $pdo->query('SELECT id, deskripsi, tipe, jumlah, created_at FROM transaksi ORDER BY created_at DESC');
        $transaksi = $stmt->fetchAll();
        
        // Calculate totals
        $saldo = 0;
        $pemasukan = 0;
        $pengeluaran = 0;
        
        foreach ($transaksi as $t) {
            if ($t['tipe'] === 'Pemasukan') {
                $saldo += $t['jumlah'];
                $pemasukan += $t['jumlah'];
            } else {
                $saldo -= $t['jumlah'];
                $pengeluaran += $t['jumlah'];
            }
        }
        
        return [
            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'transaksi' => $transaksi,
        ];
    } catch (PDOException $e) {
        error_log('Get keuangan error: ' . $e->getMessage());
        return [
            'saldo' => 0,
            'pemasukan' => 0,
            'pengeluaran' => 0,
            'transaksi' => [],
        ];
    }
}

function addKeuanganTransaction($deskripsi, $tipe, $jumlah) {
    try {
        $pdo = getDbConnection();
        $tipeName = $tipe === 'pemasukan' ? 'Pemasukan' : 'Pengeluaran';
        $stmt = $pdo->prepare('INSERT INTO transaksi (deskripsi, tipe, jumlah) VALUES (?, ?, ?)');
        $stmt->execute([$deskripsi, $tipeName, $jumlah]);
        return true;
    } catch (PDOException $e) {
        error_log('Add transaksi error: ' . $e->getMessage());
        return false;
    }
}

// ===== UTILITY FUNCTIONS =====
function formatRupiah($value) {
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function ensureAuthenticated() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
