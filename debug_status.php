<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Query langsung ke database
    $ditolak = Capsule::table('monitoring_barang')->where('status', 'ditolak')->get();
    $diterima = Capsule::table('monitoring_barang')->where('status', 'diterima')->get();
    $diajukan = Capsule::table('monitoring_barang')->where('status', 'diajukan')->get();

    echo "=== DEBUG STATUS MONITORING BARANG ===\n";
    echo "Data DITOLAK: " . count($ditolak) . " records\n";
    echo "Data DITERIMA: " . count($diterima) . " records\n";
    echo "Data DIAJUKAN: " . count($diajukan) . " records\n\n";

    if (count($ditolak) > 0) {
        echo "=== DETAIL DATA DITOLAK ===\n";
        foreach ($ditolak as $item) {
            echo "ID: {$item->id}, Status: {$item->status}, Alasan: {$item->alasan_penolakan}, Updated: {$item->updated_at}\n";
        }
    }

    // Cek semua status yang ada
    $allStatuses = Capsule::table('monitoring_barang')
        ->select('status', Capsule::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->get();

    echo "\n=== SEMUA STATUS ===\n";
    foreach ($allStatuses as $status) {
        echo "Status: {$status->status}, Count: {$status->count}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
