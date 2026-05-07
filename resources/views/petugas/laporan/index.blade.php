@extends('layouts.app')

@section('title', 'Semua Laporan')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-title-section">
                    <h1 class="h2 fw-semibold mb-1" style="color: #0A3A5C;">
                        <i class="fas fa-file-alt me-2" style="color: #0A3A5C;"></i> Semua Laporan
                    </h1>
                    <p class="text-muted" style="color: #5A7D9A !important;">Kelola dan pantau seluruh laporan yang masuk</p>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <form method="GET" action="{{ route('petugas.laporan.index') }}" class="d-flex gap-2">
                        <div class="input-group" style="width: 320px;">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari no. laporan, judul, atau pelapor..." value="{{ request('search') }}"
                                style="border-radius: 40px 0 0 40px; border: 1px solid #E2E8F0; padding: 0.6rem 1rem;">
                            <button type="submit" class="btn"
                                style="background: #0A3A5C; border-radius: 0 40px 40px 0; color: white; padding: 0.6rem 1.5rem;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        @if (request('search') || request('status') || request('jenis'))
                            <a href="{{ route('petugas.laporan.index') }}" class="btn"
                                style="background: rgba(10, 58, 92, 0.08); border-radius: 40px; color: #0A3A5C; padding: 0.6rem 1.25rem;">
                                <i class="fas fa-times me-1"></i> Reset
                            </a>
                        @endif
                    </form>

                    <form method="GET" action="{{ route('petugas.laporan.index') }}" class="d-flex gap-2" id="filterForm">
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <select name="status" class="form-select custom-select" id="statusSelect"
                            onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>
                                Diverifikasi</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>

                        <select name="jenis" class="form-select custom-select" id="jenisSelect"
                            onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            <option value="pencurian" {{ request('jenis') == 'pencurian' ? 'selected' : '' }}>Pencurian
                            </option>
                            <option value="penganiayaan" {{ request('jenis') == 'penganiayaan' ? 'selected' : '' }}>
                                Penganiayaan</option>
                            <option value="penipuan" {{ request('jenis') == 'penipuan' ? 'selected' : '' }}>Penipuan
                            </option>
                            <option value="pengerusakan" {{ request('jenis') == 'pengerusakan' ? 'selected' : '' }}>
                                Pengerusakan</option>
                            <option value="narkoba" {{ request('jenis') == 'narkoba' ? 'selected' : '' }}>Narkoba</option>
                            <option value="kekerasan_dalam_rumah_tangga"
                                {{ request('jenis') == 'kekerasan_dalam_rumah_tangga' ? 'selected' : '' }}>KDRT</option>
                            <option value="pencabulan" {{ request('jenis') == 'pencabulan' ? 'selected' : '' }}>Pencabulan
                            </option>
                            <option value="lalu_lintas" {{ request('jenis') == 'lalu_lintas' ? 'selected' : '' }}>Lalu
                                Lintas</option>
                            <option value="lainnya" {{ request('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-container"
                    style="background: white; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06); border: 1px solid rgba(10, 58, 92, 0.08); overflow: hidden;">
                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table" style="margin-bottom: 0; border-collapse: collapse; width: 100%;">
                            <thead>
                                <tr>
                                    <th
                                        style="padding: 1rem 1rem; color: #5A7D9A; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                        No. Laporan</th>
                                    <th
                                        style="padding: 1rem 1rem; color: #5A7D9A; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                        Pelapor</th>
                                    <th
                                        style="padding: 1rem 1rem; color: #5A7D9A; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                        Judul Laporan</th>
                                    <th
                                        style="padding: 1rem 1rem; color: #5A7D9A; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                        Status</th>
                                    <th
                                        style="padding: 1rem 1rem; color: #5A7D9A; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                        Tanggal Lapor</th>
                                    <th
                                        style="padding: 1rem 1rem; color: #5A7D9A; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporans as $laporan)
                                    <tr style="border-bottom: 1px solid #EDF2F7; transition: background-color 0.2s;">
                                        <td style="padding: 1rem 1rem;">
                                            <span class="fw-semibold"
                                                style="color: #0A3A5C; font-size: 0.875rem;">{{ $laporan->no_laporan }}</span>
                                        </td>
                                        <td style="padding: 1rem 1rem;">
                                            <div style="display: flex; align-items: center; gap: 8px;">
                                                <div
                                                    style="width: 32px; height: 32px; background: rgba(10, 58, 92, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user" style="color: #0A3A5C; font-size: 12px;"></i>
                                                </div>
                                                <span
                                                    style="color: #2E6A8E; font-size: 0.875rem;">{{ $laporan->user->name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td style="padding: 1rem 1rem;">
                                            <span
                                                style="color: #4A627A; font-size: 0.875rem; font-weight: 500;">{{ Str::limit($laporan->judul_laporan, 50) }}</span>
                                        </td>
                                        <td style="padding: 1rem 1rem;">
                                            @php
                                                $statusColors = [
                                                    'menunggu' => [
                                                        'bg' => '#FFF3E0',
                                                        'color' => '#FF6B35',
                                                        'icon' => 'fa-clock',
                                                    ],
                                                    'diverifikasi' => [
                                                        'bg' => '#E3F2FD',
                                                        'color' => '#48BBFF',
                                                        'icon' => 'fa-check-double',
                                                    ],
                                                    'diproses' => [
                                                        'bg' => '#E0F7FA',
                                                        'color' => '#0096C7',
                                                        'icon' => 'fa-spinner',
                                                    ],
                                                    'selesai' => [
                                                        'bg' => '#E8F5E9',
                                                        'color' => '#2A9D8F',
                                                        'icon' => 'fa-check-circle',
                                                    ],
                                                    'ditolak' => [
                                                        'bg' => '#FFEBEE',
                                                        'color' => '#E63946',
                                                        'icon' => 'fa-ban',
                                                    ],
                                                ];
                                                $colors = $statusColors[$laporan->status] ?? [
                                                    'bg' => '#F5F5F5',
                                                    'color' => '#757575',
                                                    'icon' => 'fa-circle',
                                                ];
                                            @endphp
                                            <span class="badge"
                                                style="background: {{ $colors['bg'] }}; color: {{ $colors['color'] }}; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 500; font-size: 0.7rem;">
                                                <i class="fas {{ $colors['icon'] }} me-1" style="font-size: 0.65rem;"></i>
                                                {{ ucfirst($laporan->status) }}
                                            </span>
                                        </td>
                                        <td style="padding: 1rem 1rem;">
                                            <div style="display: flex; flex-direction: column;">
                                                <span
                                                    style="color: #4A627A; font-size: 0.75rem;">{{ $laporan->created_at->format('d/m/Y') }}</span>
                                                <span
                                                    style="color: #A8BDCC; font-size: 0.65rem;">{{ $laporan->created_at->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td style="padding: 1rem 1rem; text-align: center;">
                                            <a href="{{ route('petugas.laporan.show', $laporan) }}" class="btn btn-sm"
                                                style="background: rgba(10, 58, 92, 0.08); border-radius: 10px; color: #0A3A5C; padding: 0.35rem 1rem; transition: all 0.2s;">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="padding: 3rem 1rem; text-align: center;">
                                            <i class="fas fa-inbox fa-3x mb-3" style="color: #C5D5E0;"></i>
                                            <p class="mb-0" style="color: #5A7D9A;">Belum ada laporan yang tersedia</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($laporans->hasPages())
                        <div class="pagination-wrapper"
                            style="padding: 1rem 1.5rem; border-top: 1px solid #EDF2F7; background: #F8FAFC;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div class="text-muted small" style="color: #5A7D9A;">
                                    Menampilkan {{ $laporans->firstItem() ?? 0 }} - {{ $laporans->lastItem() ?? 0 }} dari
                                    {{ $laporans->total() }} laporan
                                </div>
                                <div>
                                    <ul class="pagination mb-0" style="gap: 6px;">
                                        @if ($laporans->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link"
                                                    style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #C5D5E0; background: white;">&laquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $laporans->previousPageUrl() }}"
                                                    style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #0A3A5C; background: white; transition: all 0.2s;">
                                                    &laquo;
                                                </a>
                                            </li>
                                        @endif

                                        @php
                                            $currentPage = $laporans->currentPage();
                                            $lastPage = $laporans->lastPage();
                                            $start = max(1, $currentPage - 2);
                                            $end = min($start + 4, $lastPage);

                                            if ($end - $start < 4 && $lastPage > 5) {
                                                $start = max(1, $lastPage - 4);
                                                $end = $lastPage;
                                            }
                                        @endphp

                                        @if ($start > 1)
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $laporans->url(1) }}"
                                                    style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #0A3A5C; background: white;">1</a>
                                            </li>
                                            @if ($start > 2)
                                                <li class="page-item disabled"><span class="page-link"
                                                        style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #C5D5E0; background: white;">...</span>
                                                </li>
                                            @endif
                                        @endif

                                        @for ($i = $start; $i <= $end; $i++)
                                            @if ($i == $currentPage)
                                                <li class="page-item active">
                                                    <span class="page-link"
                                                        style="border-radius: 10px; padding: 0.5rem 0.9rem; background: #0A3A5C; border: 1px solid #0A3A5C; color: white; font-weight: 500;">{{ $i }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $laporans->url($i) }}"
                                                        style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #0A3A5C; background: white;">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endfor

                                        @if ($end < $lastPage)
                                            @if ($end < $lastPage - 1)
                                                <li class="page-item disabled"><span class="page-link"
                                                        style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #C5D5E0; background: white;">...</span>
                                                </li>
                                            @endif
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $laporans->url($lastPage) }}"
                                                    style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #0A3A5C; background: white;">{{ $lastPage }}</a>
                                            </li>
                                        @endif

                                        @if ($laporans->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $laporans->nextPageUrl() }}"
                                                    style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #0A3A5C; background: white;">
                                                    &raquo;
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link"
                                                    style="border-radius: 10px; padding: 0.5rem 0.9rem; border: 1px solid #E2E8F0; color: #C5D5E0; background: white;">&raquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .table tbody tr:hover {
            background-color: #F8FAFC !important;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0A3A5C;
            box-shadow: 0 0 0 0.2rem rgba(10, 58, 92, 0.1);
            outline: none;
        }

        .pagination .page-link:hover {
            background-color: #0A3A5C;
            border-color: #0A3A5C;
            color: white;
            transform: translateY(-1px);
        }

        .custom-select {
            border-radius: 40px;
            border: 1px solid #E2E8F0;
            background-color: white;
            padding: 0.6rem 2rem 0.6rem 1.25rem;
            width: auto;
            min-width: 140px;
            cursor: pointer;
            font-size: 0.875rem;
            color: #0A3A5C;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%230A3A5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 14px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            transition: background-image 0.1s ease;
        }

        .custom-select option {
            color: #0A3A5C;
            background-color: white;
        }

        .custom-select.open {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%230A3A5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='18 15 12 9 6 15'%3E%3C/polyline%3E%3C/svg%3E");
        }
    </style>

    <script>
        document.querySelectorAll('.table tbody tr').forEach(function(row) {
            if (row.querySelector('a')) {
                row.addEventListener('click', function(e) {
                    if (!e.target.closest('a')) {
                        var link = row.querySelector('a');
                        if (link && link.href) {
                            window.location.href = link.href;
                        }
                    }
                });
            }
        });

        var selects = document.querySelectorAll('.custom-select');
        selects.forEach(function(select) {
            select.addEventListener('mousedown', function() {
                if (!this.classList.contains('open')) {
                    this.classList.add('open');
                }
            });

            select.addEventListener('blur', function() {
                this.classList.remove('open');
            });

            select.addEventListener('change', function() {
                this.classList.remove('open');
            });
        });
    </script>
@endsection
