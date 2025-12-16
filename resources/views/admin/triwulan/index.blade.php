@extends('layouts.admin')

@section('title', 'Data Triwulan')

@section('header')
SISTEM PERSEDIAAN BARANG
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="h-full">
    <div class="max-w-full">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Data Triwulan</h2>

                        </div>
                    </div>
                </div>

                @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            toast: true,
                            position: 'top-end'
                        });
                    });
                </script>
                @endif

                <!-- Statistics Cards - Horizontal Layout -->
                <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                    <!-- Total Keluar -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-full">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 12H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-3">
                                    <dl>
                                        <dt class="text-xs font-medium text-red-700 truncate">Total Keluar</dt>
                                        <dd class="text-lg font-bold text-red-600" id="total-keluar">
                                            {{ isset($statistics['total_kredit']) ?
                                            number_format($statistics['total_kredit'], 0, ',', '.') : '0' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Masuk -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-3">
                                    <dl>
                                        <dt class="text-xs font-medium text-green-700 truncate">Total Masuk</dt>
                                        <dd class="text-lg font-bold text-green-600" id="total-masuk">
                                            {{ isset($statistics['total_debit']) ?
                                            number_format($statistics['total_debit'], 0, ',', '.') : '0' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Persediaan -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-3">
                                    <dl>
                                        <dt class="text-xs font-medium text-blue-700 truncate">Total Persediaan</dt>
                                        <dd class="text-lg font-bold text-blue-600" id="total-persediaan">
                                            {{ isset($statistics['total_persediaan']) ?
                                            number_format($statistics['total_persediaan'], 0, ',', '.') : '0' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Harga Debit -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full"
                                        style="background-color: rgba(52, 211, 153, 0.1);">
                                        <svg class="w-5 h-5" fill="none" stroke="rgb(52, 211, 153)" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-3">
                                    <dl>
                                        <dt class="text-xs font-medium truncate text-emerald-700">Harga Masuk</dt>
                                        <dd class="text-sm font-bold text-emerald-600" id="total-harga-masuk">
                                            Rp {{ isset($statistics['total_harga_debit']) ?
                                            number_format($statistics['total_harga_debit'], 0, ',', '.') : '0' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Harga Persediaan -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full"
                                        style="background-color: rgba(79, 70, 229, 0.1);">
                                        <svg class="w-5 h-5" fill="none" stroke="rgb(79, 70, 229)" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-3">
                                    <dl>
                                        <dt class="text-xs font-medium text-indigo-700 truncate">Harga Persediaan</dt>
                                        <dd class="text-sm font-bold text-indigo-600" id="total-harga-persediaan">
                                            Rp {{ isset($statistics['total_harga_persediaan']) ?
                                            number_format($statistics['total_harga_persediaan'], 0, ',', '.') : '0' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="p-4 mb-6 rounded-lg bg-gray-50">
                    <form action="{{ route('admin.triwulan.index') }}" method="GET"
                        class="flex flex-wrap items-end gap-4">
                        <div class="min-w-48">
                            <label for="search" class="block text-sm font-medium text-gray-700">Pencarian</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari nama barang..."
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="min-w-48">
                            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                            <select name="tahun" id="tahun"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Semua Tahun</option>
                                @foreach($tahuns as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun')==$tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="min-w-48">
                            <label for="triwulan" class="block text-sm font-medium text-gray-700">Triwulan</label>
                            <select name="triwulan" id="triwulan"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Semua Triwulan</option>
                                <option value="1" {{ request('triwulan')=='1' ? 'selected' : '' }}>Triwulan 1</option>
                                <option value="2" {{ request('triwulan')=='2' ? 'selected' : '' }}>Triwulan 2</option>
                                <option value="3" {{ request('triwulan')=='3' ? 'selected' : '' }}>Triwulan 3</option>
                                <option value="4" {{ request('triwulan')=='4' ? 'selected' : '' }}>Triwulan 4</option>
                            </select>
                        </div>

                        <div class="min-w-48">
                            <label for="jenis_barang" class="block text-sm font-medium text-gray-700">Jenis
                                Barang</label>
                            <select name="jenis_barang" id="jenis_barang"
                                class="w-full px-3 mt-1 border border-gray-300 rounded-md h-9 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Semua Jenis</option>
                                <option value="atk" {{ request('jenis_barang')=='atk' ? 'selected' : '' }}>ATK</option>
                                <option value="cetak" {{ request('jenis_barang')=='cetak' ? 'selected' : '' }}>Cetakan
                                </option>
                                <option value="tinta" {{ request('jenis_barang')=='tinta' ? 'selected' : '' }}>Tinta
                                </option>
                            </select>
                        </div>

                        <div class="flex items-end space-x-2">
                            <button type="submit"
                                class="inline-flex items-center px-4 text-gray-700 bg-white border border-gray-300 rounded-md h-9 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                            @if(request('search') || request('tahun') || request('triwulan') || request('jenis_barang'))
                            <a href="{{ route('admin.triwulan.index') }}"
                                class="inline-flex items-center px-4 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md h-9 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reset
                            </a>
                            @endif

                            <!-- Export Button -->
                            <a href="{{ route('admin.triwulan.export.excel', request()->only(['search','tahun','triwulan','jenis_barang'])) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold tracking-widest transition duration-150 ease-in-out bg-white border rounded-md shadow-sm border-emerald-500 text-emerald-600 hover:bg-emerald-50 focus:bg-emerald-50 active:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 hover:shadow"
                                title="Export Excel (XLSX)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-emerald-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Ekspor Data
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="w-full overflow-x-auto bg-white rounded-lg shadow-md">
                    <table class="w-full border-collapse table-fixed min-w-max">
                        <thead>
                            <tr class="bg-gray-100">
                                <th
                                    class="w-12 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    No</th>
                                <th
                                    class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300 w-36">
                                    Periode</th>
                                <th
                                    class="w-56 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Nama Barang</th>
                                <th
                                    class="w-24 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Satuan</th>
                                <th
                                    class="w-24 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Harga Satuan</th>
                                <th
                                    class="w-16 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Stok Awal</th>
                                <th
                                    class="w-16 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Total Keluar</th>
                                <!-- Hidden: Total Harga Keluar -->
                                <th
                                    class="w-16 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Total Masuk</th>
                                <th
                                    class="w-32 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Total Harga Masuk</th>
                                <th
                                    class="w-32 px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300">
                                    Total Persediaan</th>
                                <th
                                    class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-900 uppercase border border-gray-300 w-36">
                                    Total Harga Persediaan</th>
                                <!-- Hidden: Aksi column -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($triwulans as $index => $triwulan)
                            <tr class="transition-colors duration-200 ease-in-out hover:bg-gray-50">
                                <td
                                    class="px-3 py-4 text-sm font-medium text-center text-gray-900 align-top border border-gray-300 whitespace-nowrap">
                                    {{ ($triwulans->currentPage() - 1) * $triwulans->perPage() + $index + 1 }}
                                </td>
                                <td class="px-3 py-4 align-top border border-gray-300">
                                    <div class="text-sm font-medium leading-relaxed text-gray-900 break-words">{{
                                        $triwulan->nama_triwulan }}</div>
                                </td>
                                <td class="px-3 py-4 align-top border border-gray-300">
                                    <div class="text-sm font-medium leading-relaxed text-gray-900 break-words">{{
                                        $triwulan->nama_barang }}</div>
                                </td>
                                <td class="px-3 py-4 align-top border border-gray-300 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">{{ $triwulan->satuan }}</span>
                                </td>
                                <td class="px-3 py-4 text-right align-top border border-gray-300 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">Rp {{ number_format($triwulan->harga_satuan, 0,
                                        ',', '.') }}</span>
                                </td>
                                <td class="px-3 py-4 text-right align-top border border-gray-300 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{
                                        number_format($triwulan->saldo_awal_triwulan, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-3 py-4 text-right align-top border border-gray-300 whitespace-nowrap">
                                    <span class="text-sm font-medium text-red-600">{{
                                        number_format($triwulan->total_kredit_triwulan, 0, ',', '.') }}</span>
                                </td>
                                <!-- Hidden: Total Harga Keluar cell -->
                                <td class="px-3 py-4 text-right align-top border border-gray-300 whitespace-nowrap">
                                    <span class="text-sm font-medium text-green-600">{{
                                        number_format($triwulan->total_debit_triwulan, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-2 py-4 text-right align-top border border-gray-300">
                                    <span class="text-xs leading-tight text-green-600 break-words">Rp {{
                                        number_format($triwulan->total_harga_debit, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-3 py-4 text-right align-top border border-gray-300 whitespace-nowrap">
                                    <span class="text-sm font-medium text-blue-600">{{
                                        number_format($triwulan->total_persediaan_triwulan, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-2 py-4 text-right align-top border border-gray-300">
                                    <span class="text-xs font-medium leading-tight text-blue-600 break-words">Rp {{
                                        number_format($triwulan->total_harga_persediaan, 0, ',', '.') }}</span>
                                </td>
                                <!-- Hidden: Aksi column -->
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-2 text-4xl text-gray-400 fas fa-calendar-alt"></i>
                                        <p class="text-base font-medium text-gray-500">Belum ada data triwulan</p>
                                        <p class="mt-1 text-sm text-gray-400">Gunakan tombol "Generate Data" untuk
                                            membuat laporan triwulan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($triwulans->hasPages())
                <div class="mt-8 mb-6">
                    {{ $triwulans->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Hidden form for sync all data -->
<form id="syncAllForm" action="{{ route('admin.triwulan.syncall') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function syncAllData() {
    // Show loading directly without confirmation
    Swal.fire({
        title: 'Menyinkronkan Data...',
        text: 'Sedang memproses sinkronisasi data triwulan',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Submit form directly
    document.getElementById('syncAllForm').submit();
}function deleteTriwulan(id) {
    Swal.fire({
        title: 'Hapus Data Triwulan?',
        text: 'Yakin ingin menghapus data triwulan ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="mr-2 fas fa-trash"></i>Hapus!',
        cancelButtonText: '<i class="mr-2 fas fa-times"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Sedang menghapus data triwulan',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send delete request
            fetch(`/admin/triwulan/${id}`, {
                method: 'DELETE',
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
                        text: data.message || 'Data triwulan berhasil dihapus',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan saat menghapus data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
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
    const form = document.querySelector('form[action="{{ route('admin.triwulan.index') }}"]');
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
    fetch('{{ route('admin.triwulan.statistics') }}?' + params.toString(), {
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
            // Update statistics cards
            updateStatCard('total-kredit', data.data.total_kredit);
            updateStatCard('total-debit', data.data.total_debit);
            updateStatCard('total-persediaan', data.data.total_persediaan);
            updateStatCard('total-harga-debit', data.data.total_harga_debit, true);
            updateStatCard('total-harga-persediaan', data.data.total_harga_persediaan, true);

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
function updateStatCard(elementId, value, isRupiah = false) {
    const element = document.getElementById(elementId);
    if (element) {
        const formattedValue = isRupiah ?
            'Rp ' + numberFormat(value || 0) :
            numberFormat(value || 0);
        element.textContent = formattedValue;
    }
}

// Helper function to show loading state
function showLoadingState() {
    const statCards = ['total-kredit', 'total-debit', 'total-persediaan', 'total-harga-debit', 'total-harga-persediaan'];
    statCards.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.add('opacity-50');
        }
    });
}

// Helper function to hide loading state
function hideLoadingState() {
    const statCards = ['total-kredit', 'total-debit', 'total-persediaan', 'total-harga-debit', 'total-harga-persediaan'];
    statCards.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.remove('opacity-50');
        }
    });
}

// Helper function to add update animation
function addUpdateAnimation() {
    const statCards = ['total-kredit', 'total-debit', 'total-persediaan', 'total-harga-debit', 'total-harga-persediaan'];
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
    console.warn('Statistics update failed:', message);
}

// Number formatting function
function numberFormat(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

// Event listeners for real-time updates
document.addEventListener('DOMContentLoaded', function() {
    // Listen for changes in filter inputs
    const filterInputs = document.querySelectorAll('#search, #tahun, #triwulan');

    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Small delay to allow user to finish typing/selecting
            setTimeout(updateStatistics, 300);
        });
    });

    // For search input, also listen to input event (typing)
    const searchInput = document.querySelector('#search');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(updateStatistics, 800); // Longer delay for typing
        });
    }

    // Listen for form submission to update statistics immediately
    const filterForm = document.querySelector('form[action="{{ route('admin.triwulan.index') }}"]');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            // Don't prevent default, but update statistics
            setTimeout(updateStatistics, 100);
        });
    }
});
</script>

@endsection
