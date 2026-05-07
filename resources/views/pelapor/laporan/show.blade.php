@extends('layouts.app')

@section('title', 'Detail Laporan - ' . $laporan->no_laporan)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4><i class="fas fa-file-alt me-2"></i> Detail Laporan - {{ $laporan->no_laporan }}</h4>
        </div>
        <div class="card-body">
            <!-- Progress Bar -->
            <div class="mb-4">
                <h6>Status: {!! $laporan->status_badge !!}</h6>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ 
                        $laporan->progress == 100 ? 'success' : 
                        ($laporan->progress >= 75 ? 'info' : 
                        ($laporan->progress >= 50 ? 'primary' : 'warning')) 
                    }}" role="progressbar" style="width: {{ $laporan->progress }}%;">
                        {{ $laporan->progress }}%
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><th width="35%">No. Laporan</th><td>{{ $laporan->no_laporan }}</td></tr>
                        <tr><th>Judul</th><td>{{ $laporan->judul_laporan }}</td></tr>
                        <tr><th>Jenis Kejahatan</th><td>{{ str_replace('_', ' ', ucfirst($laporan->jenis_kejahatan)) }}</td></tr>
                        <tr><th>Tanggal Lapor</th><td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><th>Waktu Kejadian</th><td>{{ $laporan->waktu_kejadian->format('d/m/Y H:i') }}</td></tr>
                        <tr><th>Tempat Kejadian</th><td>{{ $laporan->tempat_kejadian }}</td></tr>
                        <tr><th>Penerima</th><td>{{ $laporan->nama_penerima ?? 'Belum diterima' }}</td></tr>
                        <tr><th>Tanggal Diterima</th><td>{{ $laporan->tanggal_diterima ? $laporan->tanggal_diterima->format('d/m/Y H:i') : '-' }}</td></tr>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-align-left me-2"></i> Deskripsi Kejadian</h5>
                    <p>{{ nl2br($laporan->deskripsi_kejadian) }}</p>
                    
                    @if($laporan->kronologi)
                        <h5><i class="fas fa-history me-2"></i> Kronologi</h5>
                        <p>{{ nl2br($laporan->kronologi) }}</p>
                    @endif
                    
                    @if($laporan->korban_nama)
                        <h5><i class="fas fa-user-injured me-2"></i> Data Korban</h5>
                        <p>Nama: {{ $laporan->korban_nama }}<br>Alamat: {{ $laporan->korban_alamat ?? '-' }}</p>
                    @endif
                    
                    @if($laporan->pelaku_nama)
                        <h5><i class="fas fa-user-secret me-2"></i> Data Pelaku</h5>
                        <p>Nama: {{ $laporan->pelaku_nama }}<br>Ciri-ciri: {{ $laporan->ciri_pelaku ?? '-' }}</p>
                    @endif
                    
                    @if($laporan->barang_bukti)
                        <h5><i class="fas fa-box me-2"></i> Barang Bukti</h5>
                        <p>{{ nl2br($laporan->barang_bukti) }}</p>
                    @endif
                    
                    @if($laporan->hasil_penanganan)
                        <div class="alert alert-success">
                            <h5><i class="fas fa-check-circle me-2"></i> Hasil Penanganan</h5>
                            <p class="mb-0">{{ nl2br($laporan->hasil_penanganan) }}</p>
                        </div>
                    @endif
                    
                    @if($laporan->catatan_petugas)
                        <div class="alert alert-info">
                            <h5><i class="fas fa-sticky-note me-2"></i> Catatan Petugas</h5>
                            <p class="mb-0">{{ nl2br($laporan->catatan_petugas) }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tracking History -->
            @if($laporan->tracking_history)
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i> Riwayat Tracking</h5>
                </div>
                <div class="card-body">
                    @foreach($laporan->tracking_history as $history)
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                @if($history['status'] == 'selesai')
                                    <i class="fas fa-check-circle text-success fa-2x"></i>
                                @elseif($history['status'] == 'ditolak')
                                    <i class="fas fa-times-circle text-danger fa-2x"></i>
                                @else
                                    <i class="fas fa-circle text-info fa-2x"></i>
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ ucfirst($history['status']) }}</strong>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($history['tanggal'])->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-0">{{ $history['keterangan'] }}</p>
                                @if(isset($history['petugas']) && $history['petugas'])
                                    <small class="text-muted">Oleh: {{ $history['petugas'] }}</small>
                                @endif
                            </div>
                        </div>
                        @if(!$loop->last)
                            <div class="ms-3 ps-3 mb-2 border-start"></div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <div class="mt-3">
                <a href="{{ route('pelapor.laporan.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('pelapor.laporan.cetak', $laporan) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.border-start {
    border-left: 2px solid #dee2e6;
    margin-left: 10px;
    height: 20px;
}
</style>
@endsection