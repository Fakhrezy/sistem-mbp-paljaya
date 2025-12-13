@extends('layouts.user')

@section('title', 'Status Pengambilan')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold">Status Pengambilan Barang</h2>
            </div>
            <a href="{{ route('user.pengambilan.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <i class="mr-2 fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        @if(session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Pengambilan -->
            <div class="p-4 border border-blue-200 rounded-lg bg-blue-50 cursor-pointer hover:shadow-md transition-shadow duration-200"
                onclick="filterByStatus('')">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="text-blue-600 fas fa-list"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-900">Total Pengambilan</p>
                        <p class="text-lg font-semibold text-blue-600">{{ $totalCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Proses -->
            <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50 cursor-pointer hover:shadow-md transition-shadow duration-200"
                onclick="filterByStatus('diajukan')">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="text-yellow-600 fas fa-clock"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-yellow-900">Proses</p>
                        <p class="text-lg font-semibold text-yellow-600">
                            {{ $pendingCount }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Diterima -->
            <div class="p-4 border border-green-200 rounded-lg bg-green-50 cursor-pointer hover:shadow-md transition-shadow duration-200"
                onclick="filterByStatus('diterima')">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="text-green-600 fas fa-check-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-900">Diterima</p>
                        <p class="text-lg font-semibold text-green-600">
                            {{ $diterimaCount }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="p-4 border border-red-200 rounded-lg bg-red-50 cursor-pointer hover:shadow-md transition-shadow duration-200"
                onclick="filterByStatus('ditolak')">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="text-red-600 fas fa-times-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-900">Ditolak</p>
                        <p class="text-lg font-semibold text-red-600">
                            {{ $ditolakCount }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="p-4 mb-6 rounded-lg bg-gray-50">
            <form method="GET" action="{{ route('user.monitoring.index') }}" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-64">
                    <label for="search" class="block text-sm font-medium text-gray-700">Pencarian</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Cari nama barang atau nama pengambil...">
                </div>

                <div class="min-w-48">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status"
                        class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Semua Status</option>
                        <option value="diterima" {{ request('status')=='diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="diajukan" {{ request('status')=='diajukan' ? 'selected' : '' }}>Diajukan</option>
                        <option value="ditolak" {{ request('status')=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="min-w-40">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div class="min-w-40">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div class="flex items-end space-x-2">
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="w-4 h-4 mr-1 text-gray-500 fas fa-search"></i>
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'status', 'start_date', 'end_date']))
                    <a href="{{ route('user.monitoring.index') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left w-12">No</th>
                        <th class="px-4 py-3 text-left w-24">Tanggal</th>
                        <th class="px-4 py-3 text-left min-w-48">Nama Barang</th>
                        <th class="px-4 py-3 text-left w-20">Total Ambil</th>
                        <th class="px-4 py-3 text-left w-24">Status</th>
                        <th class="px-4 py-3 text-left min-w-40">Keterangan</th>
                        <th class="px-4 py-3 text-left min-w-40">Feedback</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($monitorings as $monitoring)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                            {{ $monitoring->tanggal_ambil ? $monitoring->tanggal_ambil->format('d/m/Y') :
                            $monitoring->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 min-w-48">
                            <div class="text-sm font-medium text-gray-900 break-words leading-relaxed">{{
                                $monitoring->barang->nama_barang ??
                                $monitoring->nama_barang }}</div>
                            <div class="text-xs text-gray-500">{{ $monitoring->jenis_barang ??
                                $monitoring->barang->jenis ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold">
                            @if($monitoring->kredit > 0)
                            <span class="text-gray-900">{{ number_format($monitoring->kredit) }}</span>
                            @else
                            <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @php
                            $statusClass = 'bg-gray-100 text-gray-800';
                            $statusText = $monitoring->status ?? 'Pending';

                            if (strtolower($statusText) == 'diterima' || strtolower($statusText) == 'disetujui') {
                            $statusClass = 'bg-green-100 text-green-800';
                            } elseif (strtolower($statusText) == 'ditolak') {
                            $statusClass = 'bg-red-100 text-red-800';
                            } elseif (strtolower($statusText) == 'diajukan' || strtolower($statusText) == 'pending') {
                            $statusClass = 'bg-yellow-100 text-yellow-800';
                            }
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                {{ ucfirst($statusText) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 min-w-40">
                            @if($monitoring->keterangan)
                            <div class="break-words leading-relaxed">
                                {{ $monitoring->keterangan }}
                            </div>
                            @else
                            -
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 min-w-40">
                            @if($monitoring->alasan_penolakan)
                            @if(strtolower($monitoring->status) == 'ditolak')
                            <div class="p-2 bg-red-50 border-l-4 border-red-400 rounded">
                                <p class="text-xs text-red-600 break-words leading-relaxed">
                                    {{ $monitoring->alasan_penolakan }}
                                </p>
                            </div>
                            @elseif(strtolower($monitoring->status) == 'diterima')
                            <div class="p-2 bg-green-50 border-l-4 border-green-400 rounded">
                                <p class="text-xs text-green-600 break-words leading-relaxed">
                                    {{ $monitoring->alasan_penolakan }}
                                </p>
                            </div>
                            @else
                            <div class="break-words leading-relaxed">
                                {{ $monitoring->alasan_penolakan }}
                            </div>
                            @endif
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="mb-3 text-3xl text-gray-400 fas fa-clipboard-list"></i>
                                <p class="text-base font-medium">Belum ada riwayat pengambilan barang</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($monitorings->hasPages())
        <div class="mt-6">
            {{ $monitorings->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    function filterByStatus(status) {
    // Get current URL
    const url = new URL(window.location.href);

    // Set or remove status parameter
    if (status === '') {
        url.searchParams.delete('status');
    } else {
        url.searchParams.set('status', status);
    }

    // Reset to page 1 when filtering
    url.searchParams.delete('page');

    // Navigate to new URL
    window.location.href = url.toString();
}
</script>
@endsection