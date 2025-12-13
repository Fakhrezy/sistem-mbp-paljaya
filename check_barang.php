<?php
require 'vendor/autoload.php';

use App\Models\Barang;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel');

echo "=== CEK DATA BARANG ===\n";

$count = Barang::count();
echo "Total barang: " . $count . "\n\n";

if ($count > 0) {
    echo "10 Barang dengan stok terendah:\n";
    echo str_pad("Nama Barang", 30) . " | " . str_pad("Stok", 6) . " | " . str_pad("Jenis", 8) . "\n";
    echo str_repeat("-", 60) . "\n";

    $items = Barang::select('nama_barang', 'stok', 'jenis')
        ->orderBy('stok', 'asc')
        ->limit(10)
        ->get();

    foreach ($items as $item) {
        echo str_pad($item->nama_barang, 30) . " | " . str_pad($item->stok, 6) . " | " . str_pad($item->jenis, 8) . "\n";
    }
} else {
    echo "❌ TIDAK ADA DATA BARANG DI DATABASE!\n";
}
