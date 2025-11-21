@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('header')
SISTEM INFORMASI MONITORING BARANG HABIS PAKAI
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
                            class="overflow-hidden bg-white border border-gray-200 shadow-sm sm:rounded-lg chart-container h-fit">
                            <div class="p-6">
                                <div class="mb-6">
                                    <h3 class="text-xl font-semibold text-gray-800">Stok Barang Terendah</h3>
                                    <p class="mt-1 text-sm text-gray-600">10 barang dengan stok paling sedikit</p>
                                </div>

                                <!-- Bar Chart Container -->
                                <div class="w-full">
                                    @if($lowStockItems->count() > 0)
                                    <canvas id="lowStockChart" width="400" height="300"></canvas>
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

                        <!-- Pie Chart - Category Distribution -->
                        <div
                            class="overflow-hidden bg-white border border-gray-200 shadow-sm sm:rounded-lg chart-container h-fit">
                            <div class="p-6">
                                <div class="mb-6">
                                    <h3 class="text-xl font-semibold text-gray-800">Distribusi Kategori Barang</h3>
                                    <p class="mt-1 text-sm text-gray-600">Persentase barang berdasarkan jenis</p>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bar Chart for Low Stock Items
    @if($lowStockItems->count() > 0)
    const barChartElement = document.getElementById('lowStockChart');
    if (barChartElement) {
        const barCtx = barChartElement.getContext('2d');

        // Data dari controller untuk bar chart
        const chartData = @json($lowStockItems);

        // Prepare data for bar chart
        const labels = chartData.map(item => {
            return item.nama_barang.length > 20
                ? item.nama_barang.substring(0, 20) + '...'
                : item.nama_barang;
        });
        const stockData = chartData.map(item => item.stok);

        // Color mapping for different categories (Tinta hidden)
        const getBarColor = (jenis) => {
            switch(jenis) {
                case 'atk': return 'rgba(34, 197, 94, 0.8)';
                case 'cetak': return 'rgba(251, 191, 36, 0.8)';
                case 'tinta': return 'rgba(147, 51, 234, 0.8)';
                default: return 'rgba(156, 163, 175, 0.8)';
            }
        };

        const backgroundColors = chartData.map(item => getBarColor(item.jenis));
        const borderColors = chartData.map(item => getBarColor(item.jenis).replace('0.8', '1'));

        // Create bar chart
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stok',
                    data: stockData,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        callbacks: {
                            title: function(context) {
                                const index = context[0].dataIndex;
                                return chartData[index].nama_barang;
                            },
                            label: function(context) {
                                const index = context.dataIndex;
                                const jenis = chartData[index].jenis.toUpperCase();
                                return `Stok: ${context.parsed.y} | Jenis: ${jenis}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Stok'
                        },
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Barang'
                        },
                        ticks: {
                            display: false
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 20
                    }
                }
            }
        });

        barCtx.canvas.style.height = '350px';
    }
    @endif

    // Initialize Pie Chart for Category Distribution
    @if($stats['total'] > 0)
    const pieChartElement = document.getElementById('categoryPieChart');
    if (pieChartElement) {
        const pieCtx = pieChartElement.getContext('2d');

        // Data statistik dari controller
        const statsData = @json($stats);

        // Prepare data for pie chart
        const pieLabels = [];
        const pieData = [];
        const pieColors = [];

        if (statsData.atk > 0) {
            pieLabels.push('ATK');
            pieData.push(statsData.atk);
            pieColors.push('rgba(34, 197, 94, 0.8)');
        }

        if (statsData.cetak > 0) {
            pieLabels.push('Cetakan');
            pieData.push(statsData.cetak);
            pieColors.push('rgba(251, 191, 36, 0.8)');
        }

        if (statsData.tinta > 0) {
            pieLabels.push('Tinta');
            pieData.push(statsData.tinta);
            pieColors.push('rgba(147, 51, 234, 0.8)');
        }

        // Create pie chart
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieData,
                    backgroundColor: pieColors,
                    borderColor: pieColors.map(color => color.replace('0.8', '1')),
                    borderWidth: 2,
                    hoverOffset: 4
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
                        callbacks: {
                            label: function(context) {
                                const label = context.label;
                                const value = context.parsed;
                                const total = pieData.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} barang (${percentage}%)`;
                            }
                        }
                    }
                },
                layout: {
                    padding: 20
                }
            }
        });
    }
    @endif
});
</script>

<style>
    /* Chart responsiveness improvements */
    .charts-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 1023px) {
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
