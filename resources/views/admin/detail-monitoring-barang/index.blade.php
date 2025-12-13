@extends('layouts.admin')

@section('title', 'Detail Monitoring Barang')

@section('header')
SISTEM PERSEDIAAN BARANG
@endsection

@push('styles')
<style>
    /* Statistics card animations */
    .stat-card {
        transition: all 0.3s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        border-left-width: 6px;
    }

    .stat-value {
        transition: all 0.2s ease-in-out;
    }

    .loading-skeleton {
        background: linear-gradient(90deg, transparent, rgba(156, 163, 175, 0.3), transparent);
        background-size: 200% 100%;
        animation: skeleton-loading 1.5s infinite;
    }

    @keyframes skeleton-loading {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    .error-state {
        color: #ef4444 !important;
        font-style: italic;
    }
</style>
@endpush

@section('content')
<div class="h-full">
    <div class="max-w-full">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Detail Monitoring Barang</h2>
                            <p class="mt-1 text-sm text-gray-600">Rekapitulasi monitoring pengambilan dan pengadaan
                                barang</p>

                        </div>
                        <div class="flex items-center space-x-3">
                            <!-- Export Button -->
                            <a href="{{ route('admin.detail-monitoring-barang.export', request()->query()) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold tracking-widest transition duration-150 ease-in-out bg-white border rounded-md shadow-sm border-emerald-500 text-emerald-600 hover:bg-emerald-50 focus:bg-emerald-50 active:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 hover:shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-emerald-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Ekspor Data
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3" id="statistics-container">
                    <!-- Total Masuk -->
                    <div class="overflow-hidden bg-white rounded-lg shadow stat-card">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-5">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-600 truncate">Total Masuk (Pengadaan)
                                        </dt>
                                        <dd class="text-lg font-medium text-gray-900 stat-value" id="total-debit">
                                            {{ isset($statistics['total_debit']) ?
                                            number_format($statistics['total_debit'], 0, ',', '.') : '0' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Keluar -->
                    <div class="overflow-hidden bg-white rounded-lg shadow stat-card">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
                                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 12H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-5">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-600 truncate">Total Keluar (Pemakaian)
                                        </dt>
                                        <dd class="text-lg font-medium text-gray-900 stat-value" id="total-kredit">
                                            {{ isset($statistics['total_kredit']) ?
                                            number_format($statistics['total_kredit'], 0, ',', '.') : '0' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Total Stok -->
                    <div class="overflow-hidden bg-white rounded-lg shadow stat-card">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-5">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-600 truncate">Total Persediaan
                                        </dt>
                                        <dd class="text-lg font-medium text-gray-900 stat-value" id="total-saldo">
                                            @if(empty($filters['id_barang']))
                                            -
                                            @else
                                            {{ isset($statistics['total_saldo']) ?
                                            number_format($statistics['total_saldo'], 0, ',', '.') : '0' }}
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="p-4 mb-6 rounded-lg bg-gray-50">
                    <form method="GET" action="{{ route('admin.detail-monitoring-barang.index') }}"
                        class="flex flex-wrap items-end gap-4">

                        <div class="flex-1 min-w-48">
                            <label for="search" class="block text-sm font-medium text-gray-700">Cari
                                Barang/Pengambil</label>
                            <input type="text" id="search" name="search" value="{{ $filters['search'] ?? '' }}"
                                placeholder="Ketik nama barang atau nama pengambil..."
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="min-w-40">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                            <input type="date" id="start_date" name="start_date" value="{{ $filters['start_date'] }}"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="min-w-40">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                            <input type="date" id="end_date" name="end_date" value="{{ $filters['end_date'] }}"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="min-w-48">
                            <label for="bidang" class="block text-sm font-medium text-gray-700">Bidang</label>
                            <select id="bidang" name="bidang"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Semua Bidang</option>
                                @foreach($bidangList as $bidang)
                                <option value="{{ $bidang }}" {{ $filters['bidang']==$bidang ? 'selected' : '' }}>
                                    {{ \App\Constants\BidangConstants::getBidangName($bidang) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="min-w-40">
                            <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Transaksi</label>
                            <select id="jenis" name="jenis"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Semua Transaksi</option>
                                <option value="debit" {{ $filters['jenis']=='debit' ? 'selected' : '' }}>Masuk
                                    (Pengadaan)</option>
                                <option value="kredit" {{ $filters['jenis']=='kredit' ? 'selected' : '' }}>Keluar
                                    (Pengambilan)</option>
                            </select>
                        </div>

                        <div class="min-w-40">
                            <label for="jenis_barang" class="block text-sm font-medium text-gray-700">Jenis
                                Barang</label>
                            <select id="jenis_barang" name="jenis_barang"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Semua Jenis</option>
                                <option value="atk" {{ $filters['jenis_barang']=='atk' ? 'selected' : '' }}>ATK</option>
                                <option value="cetak" {{ $filters['jenis_barang']=='cetak' ? 'selected' : '' }}>Cetak
                                </option>
                                <option value="tinta" {{ $filters['jenis_barang']=='tinta' ? 'selected' : '' }}>Tinta
                                </option>
                            </select>
                        </div>

                        <div class="flex items-end space-x-2">
                            <button type="submit" id="filter-submit"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                            @if(array_filter($filters))
                            <a href="{{ route('admin.detail-monitoring-barang.index') }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            toast: true,
                            position: 'top-end'
                        });
                    });
                </script>
                @endif

                @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: '{{ session('error') }}',
                            confirmButtonColor: '#d33'
                        });
                    });
                </script>
                @endif

                <!-- Data Table -->
                <div class="bg-white rounded-lg shadow">
                </div>

                <!-- Data Table -->
                <div class="bg-white rounded-lg shadow">
                    <!-- Mobile view -->
                    <div class="hidden lg:hidden">
                        <div class="p-4 space-y-4">
                            @forelse ($detailMonitoring as $index => $item)
                            <div class="p-4 border rounded-lg bg-gray-50">
                                <!-- Header dengan No dan Tanggal -->
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-white bg-blue-600 rounded-full">
                                            {{ $detailMonitoring->firstItem() + $index }}
                                        </span>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{
                                                $item->tanggal->format('d/m/Y') }}</div>
                                            <div class="text-xs text-gray-600" title="{{ $item->nama_barang }}">
                                                <i class="mr-1 text-gray-500 fas fa-box"></i>
                                                {{ Str::limit($item->nama_barang, 25) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Uraian Section -->
                                <div class="mb-4">
                                    <h4 class="mb-2 text-xs font-semibold text-gray-700 uppercase">Uraian</h4>
                                    <div class="space-y-2 text-xs">
                                        @if($item->keterangan)
                                        <div>
                                            <span class="font-medium text-gray-600">Keterangan:</span>
                                            <p class="text-gray-700">{{ $item->keterangan }}</p>
                                        </div>
                                        @endif
                                        @if($item->bidang)
                                        <div class="flex items-center space-x-2">
                                            <i class="text-blue-500 fas fa-building"></i>
                                            <span class="font-medium text-gray-600">Bidang:</span>
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded">
                                                {{ \App\Constants\BidangConstants::getBidangName($item->bidang) }}
                                            </span>
                                        </div>
                                        @endif
                                        @if($item->pengambil)
                                        <div class="flex items-center space-x-2">
                                            <i class="text-blue-500 fas fa-user"></i>
                                            <span class="font-medium text-gray-600">Penerima:</span>
                                            <span class="text-gray-700">{{ $item->pengambil }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Persediaan Section -->
                                <div>
                                    <h4 class="mb-2 text-xs font-semibold text-gray-700 uppercase">Persediaan</h4>
                                    <div class="grid grid-cols-3 gap-3 text-center">
                                        <div class="p-2 border border-green-200 rounded bg-green-50">
                                            <div class="text-xs font-medium text-green-700">Masuk</div>
                                            <div class="text-sm font-bold text-green-600">
                                                {{ $item->debit ? '+' . number_format($item->debit, 0, ',', '.') : '0'
                                                }}
                                            </div>
                                        </div>
                                        <div class="p-2 border border-red-200 rounded bg-red-50">
                                            <div class="text-xs font-medium text-red-700">Keluar</div>
                                            <div class="text-sm font-bold text-red-600">
                                                {{ $item->kredit ? '-' . number_format($item->kredit, 0, ',', '.') : '0'
                                                }}
                                            </div>
                                        </div>
                                        <div class="p-2 border border-blue-200 rounded bg-blue-50">
                                            <div class="text-xs font-medium text-blue-700">Sisa</div>
                                            <div class="text-sm font-bold text-blue-600">
                                                {{ number_format($item->saldo, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="py-8 text-center text-gray-500">
                                <i class="mb-2 text-3xl text-gray-400 fas fa-chart-line"></i>
                                <p class="text-base font-medium">Belum ada data monitoring</p>
                                <p class="text-sm">Klik "Sinkronisasi Data" untuk memuat data dari monitoring barang dan
                                    pengadaan</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Desktop view -->
                    <div class="block">
                        <table class="w-full border-collapse table-auto">
                            <thead>
                                <!-- Header Utama -->
                                <tr class="bg-gray-100">
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border"
                                        rowspan="2">
                                        No
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border"
                                        rowspan="2">
                                        Tanggal
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border"
                                        rowspan="2">
                                        Nama Barang
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border"
                                        colspan="3">
                                        Uraian
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border"
                                        colspan="3">
                                        Persediaan
                                    </th>
                                </tr>
                                <!-- Sub Header -->
                                <tr class="bg-gray-100">
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border">
                                        Keterangan</th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border">
                                        Bidang
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border">
                                        Penerima
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border">
                                        Masuk
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border">
                                        Keluar
                                    </th>
                                    <th class="px-3 py-3 text-sm font-bold text-center text-gray-700 uppercase border">
                                        Sisa
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($detailMonitoring as $index => $item)
                                <tr class="transition-colors duration-200 hover:bg-gray-50">
                                    <!-- No -->
                                    <td class="px-3 py-3 text-sm text-center text-gray-900 border">
                                        {{ $detailMonitoring->firstItem() + $index }}
                                    </td>
                                    <!-- Tanggal -->
                                    <td class="px-3 py-3 text-sm text-center text-gray-900 border">
                                        {{ $item->tanggal->format('d/m/Y') }}
                                    </td>
                                    <!-- Nama Barang -->
                                    <td class="px-3 py-3 text-sm text-gray-900 border">
                                        {{ $item->barang->nama_barang ?? $item->nama_barang ?? '-' }}
                                    </td>
                                    <!-- Uraian: Keterangan -->
                                    <td class="px-3 py-3 text-sm text-gray-900 border">
                                        @if($item->keterangan)
                                        <span title="{{ $item->keterangan }}">
                                            {{ Str::limit($item->keterangan, 30) }}
                                        </span>
                                        @else
                                        <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <!-- Uraian: Bidang -->
                                    <td class="px-3 py-3 text-sm text-center text-gray-900 border">
                                        {{ $item->bidang ? \App\Constants\BidangConstants::getBidangName($item->bidang)
                                        : '-' }}
                                    </td>
                                    <!-- Uraian: Penerima -->
                                    <td class="px-3 py-3 text-sm text-center text-gray-900 border">
                                        {{ $item->pengambil ? Str::limit($item->pengambil, 15) : '-' }}
                                    </td>
                                    <!-- Persediaan: Masuk -->
                                    <td class="px-3 py-3 text-sm text-center text-gray-900 border">
                                        {{ $item->debit ? number_format($item->debit, 0, ',', '.') : '0' }}
                                    </td>
                                    <!-- Persediaan: Keluar -->
                                    <td class="px-3 py-3 text-sm text-center text-gray-900 border">
                                        {{ $item->kredit ? number_format($item->kredit, 0, ',', '.') : '0' }}
                                    </td>
                                    <!-- Persediaan: Stok -->
                                    <td class="px-3 py-3 text-sm text-center text-gray-900 border">
                                        {{ number_format($item->saldo, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-3 py-8 text-center text-gray-500 border">
                                        <div class="flex flex-col items-center">
                                            <i class="mb-2 text-3xl text-gray-400 fas fa-chart-line"></i>
                                            <p class="text-base font-medium">Belum ada data monitoring</p>
                                            <p class="text-sm">Klik "Sinkronisasi Data" untuk memuat data dari
                                                monitoring barang dan pengadaan</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if($detailMonitoring->hasPages())
                <div class="mt-6">
                    {{ $detailMonitoring->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Sync data function
function syncData() {
    Swal.fire({
        title: 'Sinkronisasi Data?',
        html: 'Proses ini akan menyinkronkan data ke detail monitoring dari:<br>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="mr-2 fas fa-sync-alt"></i>Ya, Sinkronisasi!',
        cancelButtonText: '<i class="mr-2 fas fa-times"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Melakukan Sinkronisasi...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send sync request
            fetch('{{ route('admin.detail-monitoring-barang.sync') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonColor: '#dc2626',
                        confirmButtonText: '<i class="mr-2 fas fa-times"></i>OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat melakukan sinkronisasi',
                    icon: 'error',
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: '<i class="mr-2 fas fa-times"></i>OK'
                });
            });
        }
    });
}

// Function to update statistics in real-time
function updateStatistics() {
    const form = document.querySelector('form[method="GET"]');
    if (!form) return;

    const formData = new FormData(form);
    const params = new URLSearchParams();

    // Convert FormData to URLSearchParams
    for (let [key, value] of formData.entries()) {
        if (value && value.trim() !== '') {
            params.append(key, value);
        }
    }

    // Show loading indicators
    showLoadingState();

    // Fetch updated statistics
    fetch('{{ route('admin.detail-monitoring-barang.statistics') }}?' + params.toString(), {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success && data.data) {
            // Update statistics cards with error checking
            updateStatCard('total-debit', data.data.total_debit);
            updateStatCard('total-kredit', data.data.total_kredit);
            updateStatCard('total-saldo', data.data.total_saldo);

            // Add success animation
            addUpdateAnimation();
        } else {
            throw new Error(data.message || 'Invalid data received');
        }
    })
    .catch(error => {
        console.error('Error updating statistics:', error);
        showErrorState(error.message);
    })
    .finally(() => {
        hideLoadingState();
    });
}

// Helper function to update individual stat card
function updateStatCard(elementId, value) {
    const element = document.getElementById(elementId);
    if (element) {
        // Special case for total-saldo when no specific item is selected
        if (elementId === 'total-saldo') {
            const idBarangSelect = document.getElementById('id_barang');
            if (idBarangSelect && idBarangSelect.value === '') {
                element.textContent = '-';
                return;
            }
        }
        const formattedValue = numberFormat(value || 0);
        element.textContent = formattedValue;
    }
}

// Helper function to show loading state
function showLoadingState() {
    const statCards = ['total-debit', 'total-kredit', 'total-saldo'];
    statCards.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.add('opacity-50');
        }
    });
}

// Helper function to hide loading state
function hideLoadingState() {
    const statCards = ['total-debit', 'total-kredit', 'total-saldo'];
    statCards.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.remove('opacity-50');
        }
    });
}

// Helper function to add update animation
function addUpdateAnimation() {
    const statCards = ['total-debit', 'total-kredit', 'total-saldo'];
    statCards.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.add('animate-pulse');
            setTimeout(() => {
                element.classList.remove('animate-pulse');
            }, 1000);
        }
    });
}

// Helper function to show error state
function showErrorState(message) {
    // Optional: Show a small error indicator
    console.warn('Statistics update failed:', message);
}

// Number formatting function
function numberFormat(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

// Event listeners for real-time updates
document.addEventListener('DOMContentLoaded', function() {
    // Listen for changes in filter inputs
    const filterInputs = document.querySelectorAll('#id_barang, #start_date, #end_date, #bidang, #jenis');

    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Small delay to allow user to finish typing
            setTimeout(updateStatistics, 300);
        });
    });

    // Listen for form submission to update statistics immediately
    const filterForm = document.querySelector('form[method="GET"]');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            // Don't prevent default, but update statistics
            setTimeout(updateStatistics, 100);
        });
    }
});
</script>
@endsection