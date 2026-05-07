@extends('layouts.app')

@section('title', 'Semua Laporan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h4><i class="fas fa-file-alt me-2"></i> Semua Laporan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No. Laporan</th>
                            <th>Pelapor</th>
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
                            <td>{{ $laporan->user->name ?? '-' }}</td>
                            <td>{{ Str::limit($laporan->judul_laporan, 40) }}</td>
                            <td>{{ str_replace('_', ' ', ucfirst($laporan->jenis_kejahatan)) }}</td>
                            <td>{!! $laporan->status_badge !!}</td>
                            <td>{{ $laporan->nama_penerima ?? 'Belum diterima' }}</td>
                            <td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('petugas.laporan.show', $laporan) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Proses
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">Belum ada laporan</td></tr>
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