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

        // Query builder untuk monitoring berdasarkan bidang user yang login
        $query = MonitoringBarang::with(['barang'])
            ->whereHas('barang')
            ->where('bidang', $userBidang);

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

        return view('user.monitoring.index', compact('monitorings', 'userBidang'));
    }
}
