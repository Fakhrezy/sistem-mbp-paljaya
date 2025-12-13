<?php

namespace App\Http\Controllers;

use App\Models\MonitoringBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $userBidang = Auth::user()->bidang;
        $userName = Auth::user()->name;

        // Query builder untuk monitoring berdasarkan user yang login saja
        $query = MonitoringBarang::with(['barang'])
            ->whereHas('barang')
            ->where('nama_pengambil', $userName);

        // Filter berdasarkan pencarian (nama barang atau nama pengambil)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengambil', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhereHas('barang', function ($subQ) use ($search) {
                        $subQ->where('nama_barang', 'like', "%{$search}%");
                    });
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal (gunakan tanggal_ambil jika ada, fallback ke created_at)
        if ($request->filled('start_date')) {
            $query->where(function ($q) use ($request) {
                $q->whereDate('tanggal_ambil', '>=', $request->start_date)
                    ->orWhere(function ($subQ) use ($request) {
                        $subQ->whereNull('tanggal_ambil')
                            ->whereDate('created_at', '>=', $request->start_date);
                    });
            });
        }

        if ($request->filled('end_date')) {
            $query->where(function ($q) use ($request) {
                $q->whereDate('tanggal_ambil', '<=', $request->end_date)
                    ->orWhere(function ($subQ) use ($request) {
                        $subQ->whereNull('tanggal_ambil')
                            ->whereDate('created_at', '<=', $request->end_date);
                    });
            });
        }

        $monitorings = $query->orderBy('created_at', 'desc')->paginate(20);

        // Statistik keseluruhan tanpa filter
        $totalCount = MonitoringBarang::with(['barang'])
            ->whereHas('barang')
            ->where('nama_pengambil', $userName)
            ->count();

        $diterimaCount = MonitoringBarang::with(['barang'])
            ->whereHas('barang')
            ->where('nama_pengambil', $userName)
            ->whereIn('status', ['diterima', 'disetujui'])
            ->count();

        $pendingCount = MonitoringBarang::with(['barang'])
            ->whereHas('barang')
            ->where('nama_pengambil', $userName)
            ->whereIn('status', ['diajukan', 'pending'])
            ->count();

        $ditolakCount = MonitoringBarang::with(['barang'])
            ->whereHas('barang')
            ->where('nama_pengambil', $userName)
            ->where('status', 'ditolak')
            ->count();

        return view('user.monitoring.index', compact(
            'monitorings',
            'userBidang',
            'totalCount',
            'diterimaCount',
            'pendingCount',
            'ditolakCount'
        ));
    }
}
