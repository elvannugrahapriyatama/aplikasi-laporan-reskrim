@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
    <div class="container-fluid px-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-section py-3">
                    <h1 class="h2 mb-1 fw-semibold" style="color: #0A3A5C;">Selamat Datang, {{ Auth::user()->name }}</h1>
                    <p class="text-muted" style="color: #5A7D9A !important;">Ringkasan laporan dan aktivitas hari ini</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards - 4 Cards Only -->
        <div class="row g-4 mb-4">
            <!-- Card 1: Total Laporan -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card"
                    style="background: white; border-radius: 20px; padding: 1.5rem; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.08); border: 1px solid rgba(10, 58, 92, 0.1); transition: all 0.2s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small fw-semibold text-uppercase"
                                style="color: #5A7D9A !important; letter-spacing: 0.5px;">Total Laporan</p>
                            <h2 class="mb-0 fw-bold" style="color: #0A3A5C; font-size: 2.5rem;">
                                {{ number_format($totalLaporan) }}</h2>
                        </div>
                        <div class="stat-icon"
                            style="width: 48px; height: 48px; background: rgba(10, 58, 92, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-folder-open fa-lg" style="color: #0A3A5C;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="small" style="color: #2E6A8E;">Seluruh laporan masuk</span>
                    </div>
                </div>
            </div>

            <!-- Card 2: Laporan Hari Ini -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card"
                    style="background: white; border-radius: 20px; padding: 1.5rem; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.08); border: 1px solid rgba(10, 58, 92, 0.1); transition: all 0.2s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small fw-semibold text-uppercase"
                                style="color: #5A7D9A !important; letter-spacing: 0.5px;">Laporan Hari Ini</p>
                            <h2 class="mb-0 fw-bold" style="color: #0A3A5C; font-size: 2.5rem;">
                                {{ number_format($laporanHariIni) }}</h2>
                        </div>
                        <div class="stat-icon"
                            style="width: 48px; height: 48px; background: rgba(10, 58, 92, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar-day fa-lg" style="color: #0A3A5C;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="small" style="color: #2E6A8E;">Laporan masuk hari ini</span>
                    </div>
                </div>
            </div>

            <!-- Card 3: Laporan Selesai -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card"
                    style="background: white; border-radius: 20px; padding: 1.5rem; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.08); border: 1px solid rgba(42, 157, 143, 0.2); transition: all 0.2s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small fw-semibold text-uppercase"
                                style="color: #2A9D8F !important; letter-spacing: 0.5px;">Laporan Selesai</p>
                            <h2 class="mb-0 fw-bold" style="color: #2A9D8F; font-size: 2.5rem;">
                                {{ number_format($laporanSelesai) }}</h2>
                        </div>
                        <div class="stat-icon"
                            style="width: 48px; height: 48px; background: rgba(42, 157, 143, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle fa-lg" style="color: #2A9D8F;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="small" style="color: #21867A;">Laporan terselesaikan</span>
                    </div>
                </div>
            </div>

            <!-- Card 4: Laporan Diproses -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card"
                    style="background: white; border-radius: 20px; padding: 1.5rem; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.08); border: 1px solid rgba(0, 150, 199, 0.2); transition: all 0.2s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small fw-semibold text-uppercase"
                                style="color: #0096C7 !important; letter-spacing: 0.5px;">Laporan Diproses</p>
                            <h2 class="mb-0 fw-bold" style="color: #0096C7; font-size: 2.5rem;">
                                {{ number_format($laporanDiproses) }}</h2>
                        </div>
                        <div class="stat-icon"
                            style="width: 48px; height: 48px; background: rgba(0, 150, 199, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-spinner fa-lg" style="color: #0096C7;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="small" style="color: #0077B6;">Sedang ditangani</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row - 2 Charts -->
        <div class="row g-4 mb-4">
            <!-- Chart 1: Laporan per Status (Donut Chart) -->
            <div class="col-xl-6">
                <div class="chart-card"
                    style="background: white; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.08); border: 1px solid rgba(10, 58, 92, 0.08); overflow: hidden;">
                    <div class="chart-header p-4 pb-0">
                        <h5 class="fw-semibold mb-1" style="color: #0A3A5C;">
                            <i class="fas fa-chart-pie me-2" style="color: #0A3A5C;"></i> Laporan Berdasarkan Status
                        </h5>
                        <p class="text-muted small mb-0" style="color: #5A7D9A !important;">Distribusi seluruh laporan</p>
                    </div>
                    <div class="chart-body p-4">
                        <canvas id="statusDonutChart" style="max-height: 300px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Chart 2: Laporan per Bulan (Bar Chart) -->
            <div class="col-xl-6">
                <div class="chart-card"
                    style="background: white; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.08); border: 1px solid rgba(10, 58, 92, 0.08); overflow: hidden;">
                    <div class="chart-header p-4 pb-0">
                        <h5 class="fw-semibold mb-1" style="color: #0A3A5C;">
                            <i class="fas fa-chart-line me-2" style="color: #0A3A5C;"></i> Tren Laporan Per Bulan
                        </h5>
                        <p class="text-muted small mb-0" style="color: #5A7D9A !important;">6 bulan terakhir</p>
                    </div>
                    <div class="chart-body p-4">
                        <canvas id="monthlyBarChart" style="max-height: 300px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reports Table -->
        <div class="row">
            <div class="col-12">
                <div class="recent-table"
                    style="background: white; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.08); border: 1px solid rgba(10, 58, 92, 0.08); overflow: hidden;">
                    <div class="table-header p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-semibold mb-1" style="color: #0A3A5C;">
                                    <i class="fas fa-clock me-2" style="color: #0A3A5C;"></i> Laporan Terbaru
                                </h5>
                                <p class="text-muted small mb-0" style="color: #5A7D9A !important;">5 laporan terakhir
                                    yang masuk</p>
                            </div>
                            <a href="{{ route('petugas.laporan.index') }}" class="btn btn-sm"
                                style="background: rgba(10, 58, 92, 0.08); border-radius: 10px; color: #0A3A5C;">
                                Lihat semua <i class="fas fa-chevron-right ms-1 fa-xs"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive px-4 pb-4">
                        <table class="table table-hover align-middle mb-0"
                            style="border-collapse: separate; border-spacing: 0 8px;">
                            <thead>
                                <tr style="border-bottom: 1px solid rgba(10, 58, 92, 0.08);">
                                    <th
                                        style="color: #5A7D9A; font-weight: 500; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 0.5rem;">
                                        No. Laporan</th>
                                    <th
                                        style="color: #5A7D9A; font-weight: 500; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 0.5rem;">
                                        Pelapor</th>
                                    <th
                                        style="color: #5A7D9A; font-weight: 500; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 0.5rem;">
                                        Judul Laporan</th>
                                    <th
                                        style="color: #5A7D9A; font-weight: 500; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 0.5rem;">
                                        Status</th>
                                    <th
                                        style="color: #5A7D9A; font-weight: 500; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 0.5rem;">
                                        Tanggal</th>
                                    <th
                                        style="color: #5A7D9A; font-weight: 500; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 0.5rem;">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanTerbaru as $laporan)
                                    <tr style="transition: all 0.2s;">
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span class="fw-semibold"
                                                style="color: #0A3A5C; font-size: 0.875rem;">{{ $laporan->no_laporan }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span
                                                style="color: #2E6A8E; font-size: 0.875rem;">{{ $laporan->user->name ?? '-' }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span
                                                style="color: #4A627A; font-size: 0.875rem;">{{ Str::limit($laporan->judul_laporan, 45) }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            @php
                                                $statusColors = [
                                                    'menunggu' => ['bg' => '#FFF3E0', 'color' => '#FF6B35'],
                                                    'diverifikasi' => ['bg' => '#E3F2FD', 'color' => '#48BBFF'],
                                                    'diproses' => ['bg' => '#E0F7FA', 'color' => '#0096C7'],
                                                    'selesai' => ['bg' => '#E8F5E9', 'color' => '#2A9D8F'],
                                                    'ditolak' => ['bg' => '#FFEBEE', 'color' => '#E63946'],
                                                ];
                                                $colors = $statusColors[$laporan->status] ?? [
                                                    'bg' => '#F5F5F5',
                                                    'color' => '#757575',
                                                ];
                                            @endphp
                                            <span class="badge"
                                                style="background: {{ $colors['bg'] }}; color: {{ $colors['color'] }}; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 500; font-size: 0.7rem;">
                                                {{ ucfirst($laporan->status) }}
                                            </span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span
                                                style="color: #5A7D9A; font-size: 0.75rem;">{{ $laporan->created_at->format('d/m/Y H:i') }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <a href="{{ route('petugas.laporan.show', $laporan) }}" class="btn btn-sm"
                                                style="background: rgba(10, 58, 92, 0.08); border-radius: 10px; color: #0A3A5C; padding: 0.35rem 1rem;">
                                                <i class="fas fa-eye me-1"></i> Proses
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5" style="color: #5A7D9A;">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block" style="color: #C5D5E0;"></i>
                                            Belum ada laporan masuk
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Hover Effects */
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(10, 58, 92, 0.12) !important;
        }

        .chart-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(10, 58, 92, 0.12) !important;
        }

        .recent-table tbody tr:hover {
            background-color: rgba(10, 58, 92, 0.02);
            cursor: pointer;
        }

        /* Custom Scrollbar */
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #F0F4F8;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #C5D5E0;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #A8BDCC;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // Chart 1: Donut Chart untuk Status Laporan
        const statusCtx = document.getElementById('statusDonutChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($laporanPerStatus)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($laporanPerStatus)) !!},
                    backgroundColor: ['#0A3A5C', '#48BBFF', '#0096C7', '#2A9D8F', '#E63946'],
                    borderWidth: 0,
                    hoverOffset: 8,
                    cutout: '65%',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 15,
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            },
                            color: '#4A627A',
                            boxWidth: 10,
                            boxHeight: 10,
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0A3A5C',
                        titleColor: 'white',
                        bodyColor: 'rgba(255,255,255,0.8)',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                }
            }
        });

        // Chart 2: Bar Chart untuk Laporan per Bulan
        const monthlyCtx = document.getElementById('monthlyBarChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(collect($laporanPerBulanFormatted)->pluck('bulan')) !!},
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: {!! json_encode(collect($laporanPerBulanFormatted)->pluck('total')) !!},
                    backgroundColor: '#0A3A5C',
                    borderRadius: 8,
                    barPercentage: 0.65,
                    categoryPercentage: 0.8,
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
                        backgroundColor: '#0A3A5C',
                        titleColor: 'white',
                        bodyColor: 'rgba(255,255,255,0.8)',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return `Jumlah: ${context.raw} laporan`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(10, 58, 92, 0.08)',
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 1,
                            color: '#5A7D9A',
                            font: {
                                size: 11
                            }
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Laporan',
                            color: '#5A7D9A',
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#5A7D9A',
                            font: {
                                size: 11
                            },
                            maxRotation: 45,
                            minRotation: 45,
                        }
                    }
                }
            }
        });

        // Optional: Make table rows clickable
        document.querySelectorAll('.recent-table tbody tr').forEach(row => {
            if (row.querySelector('a')) {
                row.addEventListener('click', (e) => {
                    if (!e.target.closest('a')) {
                        const link = row.querySelector('a');
                        if (link) window.location.href = link.href;
                    }
                });
            }
        });
    </script>
@endsection
