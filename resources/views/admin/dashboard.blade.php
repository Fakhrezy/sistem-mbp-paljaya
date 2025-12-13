@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('header')
SISTEM PERSEDIAAN BARANG
@endsection

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    {{-- <h2 class="text-2xl font-semibold text-gray-800">Statistik Barang</h2> --}}

                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Total Barang -->
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-5">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-600 truncate">Total Barang</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ $stats['total'] }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ATK -->
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-5">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-600 truncate">ATK</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ $stats['atk'] }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cetak -->
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-full">
                                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-5">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-600 truncate">Cetakan</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ $stats['cetak'] }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tinta -->
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full">
                                        <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.5c-1.5 0-3 1.5-4.5 4.5C6 10 6 12.5 6 14.5c0 3.5 2.7 6.5 6 6.5s6-3 6-6.5c0-2-0-4.5-1.5-7.5C15 4 13.5 2.5 12 2.5zm0 16c-2.2 0-4-1.8-4-4 0-1.3 0-3.2 1.2-5.5C10.2 7 11.1 6 12 6s1.8 1 2.8 3c1.2 2.3 1.2 4.2 1.2 5.5 0 2.2-1.8 4-4 4z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 w-0 ml-5">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-600 truncate">Tinta</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ $stats['tinta'] }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="mt-8">
                    <!-- Charts Grid -->
                    <div class="charts-grid">
                        <!-- Bar Chart - Low Stock Items -->
                        <div
                            class="overflow-hidden bg-white border border-gray-200 shadow-sm sm:rounded-lg chart-container">
                            <div class="p-6">
                                <div class="mb-6">
                                    <h3 class="text-xl font-semibold text-gray-800">Stok Barang Terendah</h3>
                                    <p class="mt-1 text-sm text-gray-600">10 barang dengan stok paling sedikit</p>
                                </div>

                                <!-- Legend -->
                                <div class="flex flex-wrap gap-4 mb-6">
                                    <div class="flex items-center legend-item">
                                        <div class="w-4 h-4 mr-2 rounded"
                                            style="background-color: rgba(34, 197, 94, 0.8);"></div>
                                        <span class="text-sm text-gray-600">ATK</span>
                                    </div>
                                    <div class="flex items-center legend-item">
                                        <div class="w-4 h-4 mr-2 rounded"
                                            style="background-color: rgba(251, 191, 36, 0.8);"></div>
                                        <span class="text-sm text-gray-600">Cetakan</span>
                                    </div>
                                    <div class="flex items-center legend-item">
                                        <div class="w-4 h-4 mr-2 rounded"
                                            style="background-color: rgba(147, 51, 234, 0.8);"></div>
                                        <span class="text-sm text-gray-600">Tinta</span>
                                    </div>
                                </div>

                                <!-- Bar Chart Container -->
                                <div class="w-full">
                                    @if($lowStockItems->count() > 0)
                                    <div style="position: relative; width: 100%; height: 400px;">
                                        <canvas id="lowStockChart"></canvas>
                                    </div>
                                    @else
                                    <div class="flex items-center justify-center h-64 rounded-lg bg-gray-50">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Belum ada data barang</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart - Top Taken Items -->
                        <div
                            class="overflow-hidden bg-white border border-gray-200 shadow-sm sm:rounded-lg chart-container">
                            <div class="p-6">
                                <div class="mb-6">
                                    <h3 class="text-xl font-semibold text-gray-800">Barang Paling Banyak Diambil</h3>
                                    <p class="mt-1 text-sm text-gray-600">10 barang dengan total pengambilan tertinggi
                                    </p>
                                </div>

                                <!-- Bar Chart Container -->
                                <div class="w-full">
                                    @if(isset($topTakenItems) && $topTakenItems->count() > 0)
                                    <div style="position: relative; width: 100%; height: 400px;">
                                        <canvas id="topTakenChart"></canvas>
                                    </div>
                                    @else
                                    <div class="flex items-center justify-center h-64 rounded-lg bg-gray-50">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Belum ada data pengambilan barang</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart - Category Distribution -->
                        <div
                            class="overflow-hidden bg-white border border-gray-200 shadow-sm sm:rounded-lg chart-container h-fit">
                            <div class="p-6">
                                <div class="mb-6">
                                    <h3 class="text-xl font-semibold text-gray-800">Distribusi Kategori Barang</h3>
                                    <p class="mt-1 text-sm text-gray-600">Persentase barang berdasarkan jenis</p>
                                </div>

                                <!-- Pie Chart Container -->
                                <div class="flex items-center justify-center">
                                    @if($stats['total'] > 0)
                                    <div class="w-72 h-72">
                                        <canvas id="categoryPieChart" width="288" height="288"></canvas>
                                    </div>
                                    @else
                                    <div class="flex items-center justify-center h-64 rounded-lg bg-gray-50">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                                </path>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Belum ada data kategori</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0"></script>
<script>
    @if($lowStockItems->count() > 0)
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('lowStockChart');
        if (!canvas) {
            console.error('Canvas element not found');
            return;
        }

        const ctx = canvas.getContext('2d');
        const chartData = @json($lowStockItems);

        console.log('Bar Chart Data:', chartData);

        // Prepare data
        const labels = chartData.map(item => {
            const name = item.nama_barang;
            return name.length > 15 ? name.substring(0, 15) + '...' : name;
        });

        // Store original values for tooltip
        const originalValues = chartData.map(item => parseInt(item.stok) || 0);

        // For display: if stok is 0, show as 0.5 to make it visible, otherwise use original value
        const dataValues = originalValues.map(val => val === 0 ? 0.5 : val);

        console.log('Original values:', originalValues);
        console.log('Display values:', dataValues);
        console.log('Min value:', Math.min(...originalValues));
        console.log('Max value:', Math.max(...originalValues));

        const colors = chartData.map(item => {
            switch(item.jenis.toLowerCase()) {
                case 'atk': return '#22c55e';
                case 'cetak': return '#fbbf24';
                case 'tinta': return '#9333ea';
                default: return '#6b7280';
            }
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Stok',
                    data: dataValues,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'x',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        padding: 8,
                        titleFont: {
                            size: 13
                        },
                        bodyFont: {
                            size: 12
                        },
                        callbacks: {
                            title: function(context) {
                                return chartData[context[0].dataIndex].nama_barang;
                            },
                            label: function(context) {
                                const item = chartData[context.dataIndex];
                                const actualStok = originalValues[context.dataIndex];
                                return 'Stok: ' + actualStok + ' | Jenis: ' + item.jenis.toUpperCase();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: Math.max(...originalValues, 5) + 1,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (Number.isInteger(value)) return value;
                                return '';
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            display: false,
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        console.log('Bar chart rendered successfully');
    });
    @endif

    @if(isset($topTakenItems) && $topTakenItems->count() > 0)
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('topTakenChart');
        if (!canvas) {
            console.error('Top taken chart canvas element not found');
            return;
        }

        const ctx = canvas.getContext('2d');
        const chartData = @json($topTakenItems);

        console.log('Top Taken Chart Data:', chartData);

        // Prepare data
        const labels = chartData.map(item => {
            const name = item.nama_barang;
            return name.length > 15 ? name.substring(0, 15) + '...' : name;
        });

        const dataValues = chartData.map(item => parseInt(item.total_diambil) || 0);

        console.log('Data values:', dataValues);

        // Color based on jenis barang (same as pie chart)
        const colors = chartData.map(item => {
            if (!item.jenis) return '#6b7280'; // gray if no jenis
            switch(item.jenis.toLowerCase()) {
                case 'atk': return '#22c55e'; // green
                case 'cetak': return '#fbbf24'; // yellow
                case 'cetakan': return '#fbbf24'; // yellow
                case 'tinta': return '#9333ea'; // purple
                default: return '#6b7280'; // gray
            }
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Diambil',
                    data: dataValues,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'x',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        padding: 8,
                        titleFont: {
                            size: 13
                        },
                        bodyFont: {
                            size: 12
                        },
                        callbacks: {
                            title: function(context) {
                                return chartData[context[0].dataIndex].nama_barang;
                            },
                            label: function(context) {
                                const item = chartData[context.dataIndex];
                                const jenis = item.jenis ? item.jenis.toUpperCase() : 'N/A';
                                return 'Total Diambil: ' + context.parsed.y + ' unit | Jenis: ' + jenis;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (Number.isInteger(value)) return value;
                                return '';
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            display: false,
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        console.log('Top taken chart rendered successfully');
    });
    @endif

    @if($stats['total'] > 0)
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('categoryPieChart');
        if (!canvas) {
            console.warn('Pie chart canvas not found');
            return;
        }

        const ctx = canvas.getContext('2d');
        const stats = @json($stats);

        const pieLabels = [];
        const pieData = [];
        const pieColors = [];

        if (stats.atk > 0) {
            pieLabels.push('ATK');
            pieData.push(stats.atk);
            pieColors.push('#22c55e');
        }
        if (stats.cetak > 0) {
            pieLabels.push('Cetakan');
            pieData.push(stats.cetak);
            pieColors.push('#fbbf24');
        }
        if (stats.tinta > 0) {
            pieLabels.push('Tinta');
            pieData.push(stats.tinta);
            pieColors.push('#9333ea');
        }

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieData,
                    backgroundColor: pieColors,
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        padding: 8,
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const total = pieData.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return context.label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });

        console.log('Pie chart rendered');
    });
    @endif
</script>

<style>
    /* Chart responsiveness improvements */
    .charts-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .charts-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (min-width: 1280px) {
        .charts-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 767px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Chart containers alignment */
    @media (min-width: 1024px) {
        .chart-container {
            min-height: 500px;
        }
    }

    /* Ensure pie chart container maintains aspect ratio */
    #categoryPieChart {
        max-width: 100%;
        height: auto;
    }

    /* Chart animation and hover effects */
    .chart-container {
        transition: transform 0.2s ease-in-out;
    }

    .chart-container:hover {
        transform: translateY(-2px);
    }

    /* Legend styling improvements */
    .legend-item {
        transition: opacity 0.2s ease-in-out;
    }

    .legend-item:hover {
        opacity: 0.8;
    }
</style>

@endsection