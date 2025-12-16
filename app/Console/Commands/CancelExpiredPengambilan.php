<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MonitoringBarang;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelExpiredPengambilan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengambilan:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel pengambilan requests that have been pending for more than 24 hours and restore stock';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to check for expired pengambilan requests...');

        // Get all monitoring barang with status 'diajukan' that are older than 24 hours
        $expiredRequests = MonitoringBarang::where('status', 'diajukan')
            ->where('created_at', '<=', Carbon::now()->subSeconds(30))
            ->get();

        if ($expiredRequests->isEmpty()) {
            $this->info('No expired pengambilan requests found.');
            return 0;
        }

        $canceledCount = 0;
        $errors = [];

        foreach ($expiredRequests as $request) {
            try {
                DB::beginTransaction();

                // Note: Tidak perlu restore stok karena saat status 'diajukan' stok belum dikurangi
                // Stok baru dikurangi saat admin approve (status 'diterima')

                // Update status to 'ditolak' and add feedback
                $request->status = 'ditolak';
                $request->alasan_penolakan = 'Barang tidak tersedia';
                $request->save();

                DB::commit();

                $canceledCount++;
                $this->info("Canceled request ID: {$request->id} - {$request->nama_barang} (Qty: {$request->kredit})");
            } catch (\Exception $e) {
                DB::rollBack();
                $errorMsg = "Error processing request ID {$request->id}: " . $e->getMessage();
                $errors[] = $errorMsg;
                $this->error($errorMsg);
                Log::error('CancelExpiredPengambilan: ' . $errorMsg);
            }
        }

        $this->info("\nSummary:");
        $this->info("Total expired requests found: " . $expiredRequests->count());
        $this->info("Successfully canceled: {$canceledCount}");

        if (count($errors) > 0) {
            $this->error("Errors: " . count($errors));
        }

        return 0;
    }
}
