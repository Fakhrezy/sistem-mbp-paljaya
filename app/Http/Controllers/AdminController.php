<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total' => \App\Models\Barang::count(),
            'atk' => \App\Models\Barang::where('jenis', 'atk')->count(),
            'cetak' => \App\Models\Barang::where('jenis', 'cetak')->count(),
            'tinta' => \App\Models\Barang::where('jenis', 'tinta')->count(),
        ];

        // Data untuk chart barang dengan stok paling sedikit (10 barang teratas, termasuk stok 0)
        $lowStockItems = \App\Models\Barang::select('nama_barang', 'stok', 'jenis')
            ->where('stok', '<=', 10) // Hanya ambil barang dengan stok 10 atau kurang
            ->orderBy('stok', 'asc')
            ->limit(10)
            ->get();

        // Data untuk chart barang paling banyak diambil (10 teratas)
        $topTakenItems = \App\Models\MonitoringBarang::selectRaw('monitoring_barang.nama_barang, SUM(monitoring_barang.kredit) as total_diambil, barang.jenis')
            ->leftJoin('barang', 'monitoring_barang.id_barang', '=', 'barang.id_barang')
            ->where('monitoring_barang.status', 'diterima')
            ->groupBy('monitoring_barang.nama_barang', 'barang.jenis')
            ->orderBy('total_diambil', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'lowStockItems', 'topTakenItems'));
    }
}
