@extends('layouts.admin')

@section('title', 'Laporan Triwulan')

@section('header')
SISTEM PERSEDIAAN BARANG
@endsection

@push('styles')
<style>
    /* Minimal styles for remaining legacy components */
    .table-modern tbody tr:hover {
        background-color: #f8f9ff;
    }

    .badge-period {
        background: linear-gradient(45deg, #FF6B6B, #4ECDC4);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .value-box {
        background: #f8f9fa;
        padding: 8px 12px;
        border-radius: 8px;
        border-left: 4px solid #007bff;
        font-weight: 600;
    }

    .value-positive {
        border-left-color: #28a745;
        color: #28a745;
    }

    .value-negative {
        border-left-color: #dc3545;
        color: #dc3545;
    }

    .value-neutral {
        border-left-color: #6c757d;
        color: #6c757d;
    }

    .value-currency {
        border-left-color: #ffc107;
        color: #fd7e14;
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
                            <h2 class="text-2xl font-semibold text-gray-800">Laporan Triwulan</h2>
                            <p class="mt-1 text-sm text-gray-600">Kelola laporan triwulan</p>
                        </div>
                        <div class="flex space-x-3">
                            <button onclick="generateCurrentQuarter()"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="mr-2 fas fa-plus"></i>
                                Generate Triwulan Saat Ini
                            </button>
                            <button onclick="generateCustomQuarter()"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="mr-2 fas fa-chart-line"></i>
                                Generate Custom
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter & Statistics Cards -->
                <div class="mb-6 bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="flex items-center text-lg font-semibold text-gray-900">
                            <i class="mr-2 text-blue-600 fas fa-filter"></i>Filter & Ringkasan Laporan
                        </h5>
                    </div>
                    <div class="p-6">
                        <!-- Filter Form -->
                        <form method="GET" id="filterForm"
                            class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <label for="tahun" class="block mb-2 text-sm font-medium text-gray-700">Tahun</label>
                                <select name="tahun" id="tahun"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach($availableYears as $year)
                                    <option value="{{ $year }}" {{ $year==$tahun ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="triwulan"
                                    class="block mb-2 text-sm font-medium text-gray-700">Triwulan</label>
                                <select name="triwulan" id="triwulan"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Triwulan</option>
                                    <option value="1" {{ $triwulan=='1' ? 'selected' : '' }}>Q1 (Jan-Mar)</option>
                                    <option value="2" {{ $triwulan=='2' ? 'selected' : '' }}>Q2 (Apr-Jun)</option>
                                    <option value="3" {{ $triwulan=='3' ? 'selected' : '' }}>Q3 (Jul-Sep)</option>
                                    <option value="4" {{ $triwulan=='4' ? 'selected' : '' }}>Q4 (Oct-Dec)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Aksi</label>
                                <div class="flex space-x-2">
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="mr-2 fas fa-search"></i>Filter
                                    </button>
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        onclick="resetFilter()">
                                        <i class="mr-2 fas fa-undo"></i>Reset
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Export</label>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.laporan-triwulan.export', ['tahun' => $tahun, 'triwulan' => $triwulan, 'format' => 'excel']) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="mr-1 fas fa-file-excel"></i>Excel
                                    </a>
                                    <a href="{{ route('admin.laporan-triwulan.export', ['tahun' => $tahun, 'triwulan' => $triwulan, 'format' => 'csv']) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-teal-600 border border-transparent rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                        <i class="mr-1 fas fa-file-csv"></i>CSV
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Statistics Cards -->
                        @if($ringkasan->isNotEmpty())
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                            @foreach($ringkasan as $index => $stat)
                            @php
                            $colors = [
                            'bg-gradient-to-br from-blue-500 to-purple-600',
                            'bg-gradient-to-br from-pink-500 to-red-500',
                            'bg-gradient-to-br from-cyan-500 to-blue-500',
                            'bg-gradient-to-br from-green-500 to-teal-500'
                            ];
                            @endphp
                            <div class="rounded-lg shadow-sm {{ $colors[$index % 4] }} text-white p-4">
                                <div class="flex items-start">
                                    <div class="flex-1">
                                        <div class="mb-1 text-sm font-medium text-white/70">
                                            Triwulan {{ $stat->triwulan }} - {{ $tahun }}
                                        </div>
                                        <div class="mb-2 text-2xl font-bold">
                                            Rp {{ number_format($stat->total_nilai_akhir, 0, ',', '.') }}
                                        </div>
                                        <div class="space-y-1 text-sm text-white/80">
                                            <div class="flex items-center">
                                                <i class="mr-2 fas fa-boxes"></i>{{ $stat->jumlah_barang }} Jenis Barang
                                            </div>
                                            <div class="flex items-center">
                                                <i class="mr-2 fas fa-arrow-up"></i>Pengadaan: {{
                                                number_format($stat->total_pengadaan) }}
                                            </div>
                                            <div class="flex items-center">
                                                <i class="mr-2 fas fa-arrow-down"></i>Pemakaian: {{
                                                number_format($stat->total_pemakaian) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Data Table -->
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h5 class="flex items-center text-lg font-semibold text-gray-900">
                                <i class="mr-2 text-blue-600 fas fa-table"></i>Data Laporan Triwulan
                                @if($triwulan)
                                - Q{{ $triwulan }} {{ $tahun }}
                                @else
                                - {{ $tahun }}
                                @endif
                            </h5>
                            <div>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="mr-1 fas fa-list"></i>{{ $laporans->count() }} Data
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-0">
                        @if($laporans->isEmpty())
                        <div class="py-12 text-center">
                            <h5 class="mb-2 text-lg font-medium text-gray-500">Belum Ada Data Laporan</h5>
                            <p class="mb-4 text-gray-400">Silakan generate laporan</p>
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                onclick="generateCurrentQuarter()">
                                <i class="mr-2 fas fa-plus"></i> Generate Laporan
                            </button>
                        </div>
                        @else
                        <!-- Desktop Table View -->
                        <div class="hidden overflow-x-auto lg:block">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Periode
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Barang
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Stok Awal
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Pengadaan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Pemakaian
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Stok Akhir
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Nilai (Rp)
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($laporans as $laporan)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Q{{ $laporan->triwulan }} {{ $laporan->tahun }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{
                                                $laporan->barang->nama_barang }}</div>
                                            <div class="text-sm text-gray-500">{{ $laporan->barang->kategori_barang }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ number_format($laporan->stok_awal) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ number_format($laporan->pengadaan) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ number_format($laporan->pemakaian) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ number_format($laporan->stok_akhir) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            Rp {{ number_format($laporan->nilai_akhir, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <button onclick="showDetailLaporan({{ $laporan->id }})"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button onclick="editLaporan({{ $laporan->id }})"
                                                    class="text-green-600 hover:text-green-900">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button onclick="deleteLaporan({{ $laporan->id }})"
                                                    class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@push('scripts')
<script>
    // Generate Current Quarter
function generateCurrentQuarter() {
    const currentQuarter = Math.ceil(new Date().getMonth() / 3);
    const currentYear = new Date().getFullYear();

    Swal.fire({
        title: 'Generate Laporan?',
        text: `Generate laporan Q${currentQuarter} ${currentYear}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Generate!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Implementation for generating current quarter report
            window.location.href = `{{ route('admin.laporan-triwulan.generate') }}?tahun=${currentYear}&triwulan=${currentQuarter}`;
        }
    });
}

// Reset filter
function resetFilter() {
    window.location.href = '{{ route("admin.laporan-triwulan.index") }}';
}

// Show Detail Laporan
function showDetailLaporan(id) {
    // Implementation for showing detail
    console.log('Show detail for ID:', id);
}

// Edit Laporan
function editLaporan(id) {
    // Implementation for editing
    console.log('Edit laporan ID:', id);
}

// Delete Laporan
function deleteLaporan(id) {
    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Implementation for deleting
            console.log('Delete laporan ID:', id);
        }
    });
}

// Generate Custom Quarter
function generateCustomQuarter() {
    Swal.fire({
        title: 'Generate Laporan Custom',
        html: `
            <div class="text-left">
                <div class="mb-3">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Tahun</label>
                    <select id="customTahun" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $year==$tahun ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Triwulan</label>
                    <select id="customTriwulan" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="1">Q1 (Jan-Mar)</option>
                        <option value="2">Q2 (Apr-Jun)</option>
                        <option value="3">Q3 (Jul-Sep)</option>
                        <option value="4">Q4 (Oct-Dec)</option>
                    </select>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Generate',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
            const tahun = document.getElementById('customTahun').value;
            const triwulan = document.getElementById('customTriwulan').value;

            if (!tahun || !triwulan) {
                Swal.showValidationMessage('Pilih tahun dan triwulan');
                return false;
            }

            return { tahun: tahun, triwulan: triwulan };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `{{ route('admin.laporan-triwulan.generate') }}?tahun=${result.value.tahun}&triwulan=${result.value.triwulan}`;
        }
    });
}

// Success notification
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
@endif
</script>
@endpush

@endsection
