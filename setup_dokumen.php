<?php
require_once __DIR__ . '/includes/config.php';
header('Content-Type: text/plain; charset=utf-8');

echo "Setting up dokumen table...\n";

try {
    $pdo = getDbConnection();
    
    $sql = "CREATE TABLE IF NOT EXISTS `dokumen` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `nama` VARCHAR(255) NOT NULL,
      `jenis` VARCHAR(50) NOT NULL,
      `filename` VARCHAR(255) NOT NULL,
      `original_name` VARCHAR(255),
      `uploaded_by` INT,
      `status` VARCHAR(50) DEFAULT 'Pending',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      INDEX idx_status (status),
      INDEX idx_created (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Tabel dokumen berhasil dibuat atau sudah ada.\n";
    
    // Verify table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'dokumen'");
    $result = $stmt->fetch();
    if ($result) {
        echo "✓ Verifikasi: Tabel dokumen ditemukan.\n";
    } else {
        echo "✗ Verifikasi gagal: Tabel tidak ditemukan.\n";
    }
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\nSekarang Anda bisa upload PDF di: proposal.php\n";
echo "Script ini bisa dihapus setelah dijalankan.\n";
