@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-folder me-2"></i> Laporan Saya</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('pelapor.laporan.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Buat Laporan Baru
            </a>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No. Laporan</th>
                            <th>Judul Laporan</th>
                            <th>Jenis Kejahatan</th>
                            <th>Status</th>
                            <th>Penerima</th>
                            <th>Tanggal Lapor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                        <tr>
                            <td>{{ $laporan->no_laporan }}</td>
                            <td>{{ Str::limit($laporan->judul_laporan, 50) }}</td>
                            <td>{{ str_replace('_', ' ', ucfirst($laporan->jenis_kejahatan)) }}</td>
                            <td>{!! $laporan->status_badge !!}</td>
                            <td>{{ $laporan->nama_penerima ?? 'Belum diterima' }}</td>
                            <td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('pelapor.laporan.show', $laporan) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('pelapor.laporan.cetak', $laporan) }}" class="btn btn-sm btn-secondary" target="_blank">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="py-4">
                                    <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                                    <p>Belum ada laporan yang dibuat</p>
                                    <a href="{{ route('pelapor.laporan.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Buat Laporan Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection