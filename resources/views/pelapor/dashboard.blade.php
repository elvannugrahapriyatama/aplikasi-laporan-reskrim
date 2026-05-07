@extends('layouts.app')

@section('title', 'Dashboard Pelapor')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4><i class="fas fa-tachometer-alt me-2"></i> Dashboard Pelapor</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Laporan</h5>
                                    <h2>{{ $totalLaporan ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Menunggu</h5>
                                    <h2>{{ $laporanMenunggu ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Diproses</h5>
                                    <h2>{{ $laporanDiproses ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Selesai</h5>
                                    <h2>{{ $laporanSelesai ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('pelapor.laporan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Buat Laporan Baru
                        </a>
                        <a href="{{ route('pelapor.laporan.index') }}" class="btn btn-info">
                            <i class="fas fa-list"></i> Lihat Semua Laporan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Laporan Terbaru -->
            <div class="card mt-4">
                <div class="card-header bg-dark text-white">
                    <h5><i class="fas fa-history me-2"></i> Laporan Terbaru Anda</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Laporan</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($laporanSaya ?? [])->take(5) as $laporan)
                                <tr>
                                    <td>{{ $laporan->no_laporan }}</td>
                                    <td>{{ Str::limit($laporan->judul_laporan, 40) }}</td>
                                    <td>{!! $laporan->status_badge !!}</td>
                                    <td>{{ $laporan->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('pelapor.laporan.show', $laporan) }}" class="btn btn-sm btn-info">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center">Belum ada laporan</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection