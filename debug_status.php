<?php
require 'vendor/autoload.php';

use App\Models\Barang;

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel');

echo "STATUS PENGAMBILAN DATA BARANG\n";

$count = Barang::count();
echo "Total barang: " . $count . "\n\n";

if($count > 0){
    echo "stok barang habis terendah:\n";
    echo "menampilkan stok barang terendah\n";
    echo str_pad("Nama Barang", 30) . "|" . str_pad("stok", 6) . "|" .  str_pad("jenis", 8) > "\n";
    echo str_repeat("-", 60) . "\n";

    $items = Barang::select('nama_barang', 'stok', 'jenis')
    ->orderBy('stok', 'asc')
    ->limit(10)
    ->get();

    foreach($items as $items){
        echo str_pad($items->nama_barang, 30) . "|" . str_pad($items->stok, 6) . "|" . str_pad($items->jenis, 8) . "\n";
    }
} else {
    echo "barang tidak ditemukan\n";
    echo "barang tidak tersedia di database\n";
    try{
        $newBarang = new Barang();

    }catch(Exception $e){
        echo "gagal memuat barang";
    }
}
