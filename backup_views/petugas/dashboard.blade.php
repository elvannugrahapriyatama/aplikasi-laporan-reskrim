@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4><i class="fas fa-tachometer-alt me-2"></i> Dashboard Petugas Reskrim</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5>Total Laporan</h5>
                                    <h2>{{ $totalLaporan ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5>Menunggu Verifikasi</h5>
                                    <h2>{{ $laporanMenunggu ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body">
                                    <h5>Sedang Diproses</h5>
                                    <h2>{{ $laporanDiproses ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5>Selesai</h5>
                                    <h2>{{ $laporanSelesai ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('petugas.laporan.index') }}" class="btn btn-danger">
                            <i class="fas fa-list"></i> Kelola Semua Laporan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Laporan Terbaru -->
            <div class="card mt-4">
                <div class="card-header bg-dark text-white">
                    <h5><i class="fas fa-clock me-2"></i> Laporan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Laporan</th>
                                    <th>Pelapor</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanTerbaru ?? [] as $laporan)
                                <tr>
                                    <td>{{ $laporan->no_laporan }}</td>
                                    <td>{{ $laporan->user->name ?? '-' }}</td>
                                    <td>{{ Str::limit($laporan->judul_laporan, 40) }}</td>
                                    <td>{!! $laporan->status_badge !!}</td>
                                    <td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('petugas.laporan.show', $laporan) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Proses
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center">Belum ada laporan</td></tr>
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