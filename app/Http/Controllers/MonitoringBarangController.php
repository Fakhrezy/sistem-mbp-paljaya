<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonitoringBarang;
use App\Models\Barang;
use App\Services\DetailMonitoringBarangService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MonitoringBarangController extends Controller
{
    protected $detailMonitoringService;

    public function __construct(DetailMonitoringBarangService $detailMonitoringService)
    {
        $this->middleware(['auth']);
        $this->detailMonitoringService = $detailMonitoringService;
    }

    /**
     * Display a listing of monitoring barang
     */
    public function index(Request $request)
    {
        $query = MonitoringBarang::query();

        // Filter by status if provided
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by bidang if provided
        if ($request->bidang) {
            // Validasi bidang menggunakan BidangConstants
            if (\App\Constants\BidangConstants::isValidBidang($request->bidang)) {
                $query->where('bidang', $request->bidang);
            }
        }

        // Filter by jenis_barang if provided
        if ($request->jenis_barang) {
            $query->where('jenis_barang', $request->jenis_barang);
        }

        // Search by nama_barang or nama_pengambil
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_pengambil', 'like', '%' . $request->search . '%');
            });
        }

        // Order by custom status priority: diajukan, diterima, ditolak, then by created_at desc
        $monitoringBarang = $query->orderByRaw("
            CASE status
                WHEN 'diajukan' THEN 1
                WHEN 'diterima' THEN 2
                WHEN 'ditolak' THEN 3
                ELSE 4
            END
        ")->orderBy('created_at', 'desc')->paginate(15);

        // Sync saldo dengan stok barang terkini untuk status 'diajukan'
        $this->syncSaldoWithCurrentStock();

        return view('admin.monitoring-barang.index', compact('monitoringBarang'));
    }

    /**
     * Update status of monitoring barang
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diproses,diterima,ditolak',
            'feedback' => 'nullable|string|max:1000'
        ]);

        try {
            DB::beginTransaction();

            $monitoringBarang = MonitoringBarang::findOrFail($id);
            $currentStatus = $monitoringBarang->status;
            $newStatus = $request->status;

            $barang = Barang::findOrFail($monitoringBarang->id_barang);

            // If status is being changed to 'diterima', reduce the stock
            if ($newStatus === 'diterima' && $currentStatus !== 'diterima') {
                // Recheck stock availability
                if ($barang->stok < $monitoringBarang->kredit) {
                    throw new \Exception("Stok {$barang->nama_barang} tidak mencukupi. Stok tersedia: {$barang->stok}");
                }

                // Update the stock (reduce)
                $barang->decrement('stok', $monitoringBarang->kredit);

                // Update saldo_akhir in monitoring record
                $monitoringBarang->saldo_akhir = $barang->stok;
            }

            // If status is being changed from 'diterima' to 'diajukan', restore the stock
            if ($currentStatus === 'diterima' && $newStatus === 'diajukan') {
                // Return the stock (add back)
                $barang->increment('stok', $monitoringBarang->kredit);

                // Update saldo_akhir in monitoring record to reflect new stock
                $monitoringBarang->saldo_akhir = $barang->stok;
            }

            // Update the status
            $monitoringBarang->status = $newStatus;

            // Simpan feedback jika ada (untuk status diterima)
            if ($request->has('feedback') && $request->feedback) {
                $monitoringBarang->alasan_penolakan = $request->feedback;
            }

            $monitoringBarang->save();

            // Sinkronisasi ke detail monitoring barang berdasarkan status baru
            $this->detailMonitoringService->syncOnStatusChange('barang', $id, $newStatus);

            DB::commit();

            // Generate appropriate success message based on status change
            $message = 'Status berhasil diperbarui!';
            if ($currentStatus === 'diterima' && $newStatus === 'diajukan') {
                $message = 'Status dikembalikan';
            } elseif ($newStatus === 'diterima' && $currentStatus !== 'diterima') {
                $message = 'Status diterima';
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified monitoring barang
     */
    public function edit($id)
    {
        try {
            $monitoringBarang = MonitoringBarang::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $monitoringBarang
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data monitoring tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified monitoring barang in storage
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kredit' => 'required|numeric|min:0'
        ]);

        try {
            $monitoringBarang = MonitoringBarang::findOrFail($id);

            // Hanya update field kredit
            $monitoringBarang->update([
                'kredit' => $request->kredit
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kredit berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kredit: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reject monitoring barang record (change status to ditolak with reason)
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10|max:1000'
        ]);

        try {
            DB::beginTransaction();

            $monitoringBarang = MonitoringBarang::findOrFail($id);

            // Debug logging
            Log::info("Before update - ID: {$id}, Status: {$monitoringBarang->status}");

            // Update status to 'ditolak' dan simpan alasan penolakan
            $monitoringBarang->update([
                'status' => 'ditolak',
                'alasan_penolakan' => $request->alasan_penolakan
            ]);

            // Verify update
            $monitoringBarang->refresh();
            Log::info("After update - ID: {$id}, Status: {$monitoringBarang->status}, Alasan: {$monitoringBarang->alasan_penolakan}");            // Sinkronisasi ke detail monitoring barang berdasarkan status baru
            $this->detailMonitoringService->syncOnStatusChange('barang', $id, 'ditolak');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pengambilan berhasil ditolak dengan alasan yang disimpan!',
                'debug' => [
                    'id' => $id,
                    'new_status' => $monitoringBarang->status,
                    'alasan' => $monitoringBarang->alasan_penolakan,
                    'timestamp' => now()->toDateTimeString()
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menolak pengambilan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Sync saldo in monitoring barang with current stock from barang table
     */
    private function syncSaldoWithCurrentStock()
    {
        // Update saldo untuk semua monitoring barang dengan status 'diajukan'
        // berdasarkan stok terkini dari tabel barang
        DB::statement("
            UPDATE monitoring_barang mb
            INNER JOIN barang b ON mb.id_barang = b.id_barang
            SET mb.saldo = b.stok,
                mb.saldo_akhir = b.stok - mb.kredit
            WHERE mb.status = 'diajukan'
        ");
    }
}
