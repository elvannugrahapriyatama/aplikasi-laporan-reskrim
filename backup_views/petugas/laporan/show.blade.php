@extends('layouts.app')

@section('title', 'Proses Laporan - ' . $laporan->no_laporan)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-tasks me-2"></i> Proses Laporan - {{ $laporan->no_laporan }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Data Pelapor</h5>
                    <table class="table table-sm">
                        <tr><th>Nama</th><td>{{ $laporan->user->name ?? '-' }}</td></tr>
                        <tr><th>Email</th><td>{{ $laporan->user->email ?? '-' }}</td></tr>
                        <tr><th>Telepon</th><td>{{ $laporan->user->no_telepon ?? '-' }}</td></tr>
                        <tr><th>Alamat</th><td>{{ $laporan->user->alamat ?? '-' }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Data Laporan</h5>
                    <table class="table table-sm">
                        <tr><th>No. Laporan</th><td>{{ $laporan->no_laporan }}</td></tr>
                        <tr><th>Status Saat Ini</th><td>{!! $laporan->status_badge !!}</td></tr>
                        <tr><th>Tanggal Lapor</th><td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h5>Detail Kejadian</h5>
                    <table class="table table-sm">
                        <tr><th>Judul</th><td>{{ $laporan->judul_laporan }}</td></tr>
                        <tr><th>Jenis Kejahatan</th><td>{{ str_replace('_', ' ', ucfirst($laporan->jenis_kejahatan)) }}</td></tr>
                        <tr><th>Waktu Kejadian</th><td>{{ $laporan->waktu_kejadian->format('d/m/Y H:i') }}</td></tr>
                        <tr><th>Tempat Kejadian</th><td>{{ $laporan->tempat_kejadian }}</td></tr>
                        <tr><th>Deskripsi</th><td>{{ nl2br($laporan->deskripsi_kejadian) }}</td></tr>
                        @if($laporan->kronologi)<tr><th>Kronologi</th><td>{{ nl2br($laporan->kronologi) }}</td></tr>@endif
                        @if($laporan->barang_bukti)<tr><th>Barang Bukti</th><td>{{ nl2br($laporan->barang_bukti) }}</td></tr>@endif
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h5>Aksi Petugas</h5>
                    
                    @if($laporan->status == 'menunggu')
                        <div class="alert alert-warning">
                            <strong>Laporan menunggu verifikasi</strong>
                        </div>
                        <form action="{{ route('petugas.laporan.terima', $laporan) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle"></i> Terima & Verifikasi
                            </button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal">
                            <i class="fas fa-times-circle"></i> Tolak
                        </button>
                    @endif

                    @if($laporan->status == 'diverifikasi')
                        <div class="alert alert-info">
                            <strong>Laporan telah diverifikasi, silakan proses</strong>
                        </div>
                        <form action="{{ route('petugas.laporan.proses', $laporan) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-play"></i> Proses Laporan
                            </button>
                        </form>
                    @endif

                    @if($laporan->status == 'diproses')
                        <div class="alert alert-primary">
                            <strong>Laporan sedang diproses</strong>
                        </div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#selesaiModal">
                            <i class="fas fa-check-double"></i> Selesaikan
                        </button>
                    @endif

                    <a href="{{ route('petugas.laporan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="tolakModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('petugas.laporan.tolak', $laporan) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5>Tolak Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Alasan Penolakan</label>
                    <textarea name="catatan_petugas" class="form-control" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Selesai -->
<div class="modal fade" id="selesaiModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('petugas.laporan.selesai', $laporan) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5>Selesaikan Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Hasil Penanganan / Kesimpulan</label>
                    <textarea name="hasil_penanganan" class="form-control" rows="4" required placeholder="Jelaskan hasil penanganan laporan ini..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Selesaikan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection