@extends('layouts.admin')

@section('title', 'Monitoring Barang')

@section('header')
SISTEM PERSEDIAAN BARANG
@endsection

@section('content')
<div class="space-y-6">
    <!-- Success Message -->
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

    <!-- Main Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-xl">
        <!-- Card Header -->
        <div class="px-6 py-4 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="flex items-center text-xl font-bold text-gray-900">
                        <i class="mr-3 fas fa-chart-line"></i>
                        Data Monitoring Barang ATK
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">Kelola dan pantau stok barang ATK</p>
                </div>
                <a href="{{ route('admin.monitoring.create') }}"
                    class="flex items-center px-4 py-2 font-semibold text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                    <i class="mr-2 fas fa-plus"></i>
                    Tambah Data
                </a>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <!-- Filter Section -->
            <div class="p-4 mb-6 rounded-lg bg-gray-50">
                <form method="GET" action="{{ route('admin.monitoring') }}">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block mb-2 text-sm font-medium text-gray-700">
                                <i class="mr-1 fas fa-search"></i>Pencarian
                            </label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="ID, bidang, penerima..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-700">
                                <i class="mr-1 fas fa-flag"></i>Status
                            </label>
                            <select name="status" id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="diajukan" {{ request('status')=='diajukan' ? 'selected' : '' }}>Diajukan
                                </option>
                                <option value="diterima" {{ request('status')=='diterima' ? 'selected' : '' }}>Diterima
                                </option>
                                <option value="ditolak" {{ request('status')=='ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label for="tanggal_dari" class="block mb-2 text-sm font-medium text-gray-700">
                                <i class="mr-1 fas fa-calendar-alt"></i>Tanggal Dari
                            </label>
                            <input type="date" name="tanggal_dari" id="tanggal_dari"
                                value="{{ request('tanggal_dari') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label for="tanggal_sampai" class="block mb-2 text-sm font-medium text-gray-700">
                                <i class="mr-1 fas fa-calendar-alt"></i>Tanggal Sampai
                            </label>
                            <input type="date" name="tanggal_sampai" id="tanggal_sampai"
                                value="{{ request('tanggal_sampai') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-end space-x-2">
                            <button type="submit"
                                class="flex items-center justify-center flex-1 px-4 py-2 font-medium text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700">
                                <i class="mr-2 fas fa-filter"></i>Filter
                            </button>
                            <a href="{{ route('admin.monitoring') }}"
                                class="flex items-center justify-center flex-1 px-4 py-2 font-medium text-white transition duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
                                <i class="mr-2 fas fa-undo"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Pagination Controls -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Tampilkan:</span>
                    <form method="GET" action="{{ route('admin.monitoring') }}" class="inline">
                        @foreach(request()->except('per_page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="per_page" onchange="this.form.submit()"
                            class="px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="10" {{ request('per_page')==10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <span class="text-sm text-gray-600">entri per halaman</span>
                </div>
                <div class="text-sm text-gray-600">
                    <i class="mr-1 fas fa-info-circle"></i>
                    Data diurutkan berdasarkan tanggal terbaru
                </div>
            </div>

            <!-- Data Table -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    <div class="flex items-center">
                                        <i class="mr-2 fas fa-hashtag"></i>
                                        ID Monitoring
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    <div class="flex items-center">
                                        <i class="mr-2 fas fa-calendar"></i>
                                        Tanggal
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    <div class="flex items-center">
                                        <i class="mr-2 fas fa-box"></i>
                                        Barang
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    <div class="flex items-center">
                                        <i class="mr-2 fas fa-building"></i>
                                        Bidang
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    <div class="flex items-center">
                                        <i class="mr-2 fas fa-user"></i>
                                        Penerima
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    <div class="flex items-center justify-center">
                                        <i class="mr-2 fas fa-flag"></i>
                                        Status
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    <div class="flex items-center justify-center">
                                        <i class="mr-2 text-green-600 fas fa-plus"></i>
                                        Debit
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    <div class="flex items-center justify-center">
                                        <i class="mr-2 text-red-600 fas fa-minus"></i>
                                        Kredit
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    <div class="flex items-center justify-center">
                                        <i class="mr-2 fas fa-balance-scale"></i>
                                        Saldo
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    <div class="flex items-center justify-center">
                                        <i class="mr-2 fas fa-cogs"></i>
                                        Aksi
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($monitoring as $item)
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->id_monitoring }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->tanggal->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->tanggal->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $item->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="mr-1 fas fa-building"></i>
                                        {{ \App\Constants\BidangConstants::getBidangName($item->bidang) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-8 h-8">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full">
                                                <i class="text-xs text-gray-600 fas fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->pengambil }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($item->status === 'diterima')
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                        <i class="mr-1 fas fa-check"></i>
                                        Diterima
                                    </span>
                                    @elseif($item->status === 'ditolak')
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                        <i class="mr-1 fas fa-times-circle"></i>
                                        Ditolak
                                    </span>
                                    @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">
                                        <i class="mr-1 fas fa-clock"></i>
                                        Diajukan
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($item->debit > 0)
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded">
                                        <i class="mr-1 fas fa-arrow-up"></i>
                                        {{ number_format($item->debit) }}
                                    </span>
                                    @else
                                    <span class="text-sm text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($item->kredit > 0)
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded">
                                        <i class="mr-1 fas fa-arrow-down"></i>
                                        {{ number_format($item->kredit) }}
                                    </span>
                                    @else
                                    <span class="text-sm text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-sm font-bold text-blue-900 bg-blue-100 rounded-full">
                                        {{ number_format($item->saldo_akhir) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.monitoring.show', $item->id_monitoring) }}"
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 transition-colors duration-150 bg-blue-100 border border-transparent rounded hover:bg-blue-200"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.monitoring.edit', $item->id_monitoring) }}"
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-700 transition-colors duration-150 bg-yellow-100 border border-transparent rounded hover:bg-yellow-200"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.monitoring.destroy', $item->id_monitoring) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirmDelete(event, 'Apakah Anda yakin ingin menghapus data monitoring ini? Stok barang akan dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 transition-colors duration-150 bg-gray-100 border border-transparent rounded hover:bg-gray-200"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="mb-4 text-4xl text-gray-300 fas fa-inbox"></i>
                                        <h3 class="mb-2 text-lg font-medium text-gray-900">Tidak ada data monitoring
                                        </h3>
                                        <p class="text-gray-500">Belum ada data yang sesuai dengan filter yang dipilih.
                                        </p>
                                        <a href="{{ route('admin.monitoring.create') }}"
                                            class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                            <i class="mr-2 fas fa-plus"></i>
                                            Tambah Data Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($monitoring->hasPages())
            <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="flex justify-between flex-1 sm:hidden">
                        @if ($monitoring->onFirstPage())
                        <span
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                            Sebelumnya
                        </span>
                        @else
                        <a href="{{ $monitoring->previousPageUrl() }}"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Sebelumnya
                        </a>
                        @endif

                        @if ($monitoring->hasMorePages())
                        <a href="{{ $monitoring->nextPageUrl() }}"
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Selanjutnya
                        </a>
                        @else
                        <span
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                            Selanjutnya
                        </span>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">{{ $monitoring->firstItem() }}</span>
                                sampai
                                <span class="font-medium">{{ $monitoring->lastItem() }}</span>
                                dari
                                <span class="font-medium">{{ $monitoring->total() }}</span>
                                hasil
                            </p>
                        </div>
                        <div>
                            {{ $monitoring->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table-container {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .status-badge {
        transition: all 0.2s ease-in-out;
    }

    .status-badge:hover {
        transform: scale(1.05);
    }

    .action-button {
        transition: all 0.2s ease-in-out;
    }

    .action-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    function confirmDelete(event, message) {
        event.preventDefault();

        Swal.fire({
            title: 'Hapus Data Monitoring?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times"></i> Batal'

        }).then((result)=> {
            if (result.isConfirmed) {
                Swal.fire({

                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: ()=> {
                        Swal.showLoading();
                    }
                });
            event.target.submit();
        }
    });
    return false;
    }
</style>
@endsection
