@extends('layouts.app')

@section('title', 'Detail Laporan - ' . $laporan->no_laporan)

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="page-title-section">
                        <h1 class="h2 fw-semibold mb-1" style="color: #0A3A5C;">
                            <i class="fas fa-file-alt me-2" style="color: #0A3A5C;"></i> Detail Laporan
                        </h1>
                        <p class="text-muted" style="color: #5A7D9A !important;">{{ $laporan->no_laporan }}</p>
                    </div>
                    <div class="d-flex gap-2">
                        @php
                            $actionButton = null;
                            if ($laporan->status == 'menunggu') {
                                $actionButton = [
                                    'route' => route('petugas.laporan.terima', $laporan->id),
                                    'label' => 'TERIMA LAPORAN',
                                    'color' => '#2A9D8F',
                                    'icon' => 'fa-check',
                                ];
                            } elseif ($laporan->status == 'diverifikasi') {
                                $actionButton = [
                                    'route' => route('petugas.laporan.proses', $laporan->id),
                                    'label' => 'PROSES LAPORAN',
                                    'color' => '#0096C7',
                                    'icon' => 'fa-play',
                                ];
                            } elseif ($laporan->status == 'diproses') {
                                $actionButton = [
                                    'route' => '#',
                                    'label' => 'SELESAIKAN',
                                    'color' => '#2A9D8F',
                                    'icon' => 'fa-check-circle',
                                    'modal' => 'modalSelesai',
                                ];
                            }
                        @endphp
                        @if ($laporan->status == 'menunggu')
                            <button type="button" class="btn px-4 py-2"
                                style="background: #E63946; border-radius: 12px; color: white; font-weight: 500;"
                                data-bs-toggle="modal" data-bs-target="#modalTolak">
                                <i class="fas fa-ban me-2"></i> TOLAK LAPORAN
                            </button>
                        @endif
                        @if ($actionButton)
                            @if (isset($actionButton['modal']))
                                <button type="button" class="btn px-4 py-2"
                                    style="background: {{ $actionButton['color'] }}; border-radius: 12px; color: white; font-weight: 500;"
                                    data-bs-toggle="modal" data-bs-target="#{{ $actionButton['modal'] }}">
                                    <i class="fas {{ $actionButton['icon'] }} me-2"></i> {{ $actionButton['label'] }}
                                </button>
                            @else
                                <a href="{{ $actionButton['route'] }}" class="btn px-4 py-2"
                                    style="background: {{ $actionButton['color'] }}; border-radius: 12px; color: white; font-weight: 500;"
                                    onclick="return confirm('Lanjutkan proses ini?')">
                                    <i class="fas {{ $actionButton['icon'] }} me-2"></i> {{ $actionButton['label'] }}
                                </a>
                            @endif
                        @endif
                        <a href="{{ route('petugas.laporan.cetak', $laporan->id) }}" target="_blank" class="btn px-4 py-2"
                            style="background: rgba(10, 58, 92, 0.08); border-radius: 12px; color: #0A3A5C; font-weight: 500;">
                            <i class="fas fa-print me-2"></i> Cetak
                        </a>
                        <a href="{{ route('petugas.laporan.index') }}" class="btn px-4 py-2"
                            style="background: rgba(10, 58, 92, 0.08); border-radius: 12px; color: #0A3A5C; font-weight: 500;">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card mb-4"
                    style="border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06);">
                    <div class="card-header bg-transparent p-4 pb-0" style="border-bottom: 1px solid #EDF2F7;">
                        <h5 class="fw-semibold mb-0" style="color: #0A3A5C;">
                            <i class="fas fa-info-circle me-2" style="color: #0A3A5C;"></i> Informasi Laporan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase mb-1"
                                        style="color: #5A7D9A; letter-spacing: 0.5px;">No. Laporan :</label>
                                    <p class="fw-semibold mb-0" style="color: #0A3A5C; font-size: 1rem;">
                                        {{ $laporan->no_laporan }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase mb-1"
                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Status Laporan :</label>
                                    <div>
                                        @php
                                            $statusColors = [
                                                'menunggu' => [
                                                    'bg' => '#FFF3E0',
                                                    'color' => '#FF6B35',
                                                    'icon' => 'fa-clock',
                                                    'label' => 'Menunggu Verifikasi',
                                                ],
                                                'diverifikasi' => [
                                                    'bg' => '#E3F2FD',
                                                    'color' => '#48BBFF',
                                                    'icon' => 'fa-check-double',
                                                    'label' => 'Terverifikasi',
                                                ],
                                                'diproses' => [
                                                    'bg' => '#E0F7FA',
                                                    'color' => '#0096C7',
                                                    'icon' => 'fa-spinner',
                                                    'label' => 'Sedang Diproses',
                                                ],
                                                'selesai' => [
                                                    'bg' => '#E8F5E9',
                                                    'color' => '#2A9D8F',
                                                    'icon' => 'fa-check-circle',
                                                    'label' => 'Selesai',
                                                ],
                                                'ditolak' => [
                                                    'bg' => '#FFEBEE',
                                                    'color' => '#E63946',
                                                    'icon' => 'fa-ban',
                                                    'label' => 'Ditolak',
                                                ],
                                            ];
                                            $status = $statusColors[$laporan->status] ?? [
                                                'bg' => '#F5F5F5',
                                                'color' => '#757575',
                                                'icon' => 'fa-circle',
                                                'label' => ucfirst($laporan->status),
                                            ];
                                        @endphp
                                        <span class="badge"
                                            style="background: {{ $status['bg'] }}; color: {{ $status['color'] }}; padding: 0.5rem 1rem; border-radius: 30px; font-weight: 500;">
                                            <i class="fas {{ $status['icon'] }} me-2"></i> {{ $status['label'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase mb-1"
                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Judul Laporan :</label>
                                    <p class="mb-0" style="color: #4A627A;">{{ $laporan->judul_laporan }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase mb-1"
                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Jenis Kejahatan :</label>
                                    <p class="mb-0">
                                        <span class="badge"
                                            style="background: rgba(10, 58, 92, 0.08); color: #0A3A5C; padding: 0.35rem 0.75rem; border-radius: 20px;">
                                            {{ str_replace('_', ' ', ucfirst($laporan->jenis_kejahatan)) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase mb-1"
                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Tempat Kejadian :</label>
                                    <p class="mb-0" style="color: #4A627A;">{{ $laporan->tempat_kejadian }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase mb-1"
                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Waktu Kejadian :</label>
                                    <p class="mb-0" style="color: #4A627A;">
                                        {{ \Carbon\Carbon::parse($laporan->waktu_kejadian)->translatedFormat('l, d F Y H:i') }}
                                        WIB</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase mb-1"
                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Deskripsi Kejadian :</label>
                                    <div class="p-3"
                                        style="background: #F8FAFC; border-radius: 12px; color: #4A627A; line-height: 1.6;">
                                        {{ nl2br($laporan->deskripsi_kejadian) }}
                                    </div>
                                </div>
                            </div>
                            @if ($laporan->kronologi)
                                <div class="col-12">
                                    <div class="info-item">
                                        <label class="text-muted small text-uppercase mb-1"
                                            style="color: #5A7D9A; letter-spacing: 0.5px;">Kronologi Kejadian :</label>
                                        <div class="p-3"
                                            style="background: #F8FAFC; border-radius: 12px; color: #4A627A; line-height: 1.6;">
                                            {{ nl2br($laporan->kronologi) }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($laporan->korban_nama || $laporan->pelaku_nama)
                                <div class="col-12">
                                    <hr style="border-color: #EDF2F7;">
                                    <h6 class="fw-semibold mb-3" style="color: #0A3A5C;">Data Korban & Pelaku</h6>
                                    <div class="row">
                                        @if ($laporan->korban_nama)
                                            <div class="col-md-6">
                                                <div class="info-item mb-2">
                                                    <label class="text-muted small text-uppercase mb-1"
                                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Nama Korban
                                                        :</label>
                                                    <p class="mb-0" style="color: #4A627A;">{{ $laporan->korban_nama }}
                                                    </p>
                                                </div>
                                                @if ($laporan->korban_alamat)
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase mb-1"
                                                            style="color: #5A7D9A; letter-spacing: 0.5px;">Alamat Korban
                                                            :</label>
                                                        <p class="mb-0" style="color: #4A627A;">
                                                            {{ $laporan->korban_alamat }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                        @if ($laporan->pelaku_nama)
                                            <div class="col-md-6">
                                                <div class="info-item mb-2">
                                                    <label class="text-muted small text-uppercase mb-1"
                                                        style="color: #5A7D9A; letter-spacing: 0.5px;">Nama Pelaku
                                                        :</label>
                                                    <p class="mb-0" style="color: #4A627A;">{{ $laporan->pelaku_nama }}
                                                    </p>
                                                </div>
                                                @if ($laporan->ciri_pelaku)
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase mb-1"
                                                            style="color: #5A7D9A; letter-spacing: 0.5px;">Ciri-ciri Pelaku
                                                            :</label>
                                                        <p class="mb-0" style="color: #4A627A;">
                                                            {{ $laporan->ciri_pelaku }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if ($laporan->barang_bukti)
                                <div class="col-12">
                                    <div class="info-item">
                                        <label class="text-muted small text-uppercase mb-1"
                                            style="color: #5A7D9A; letter-spacing: 0.5px;">Barang Bukti :</label>
                                        <div class="p-3"
                                            style="background: #F8FAFC; border-radius: 12px; color: #4A627A;">
                                            {{ $laporan->barang_bukti }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($laporan->hasil_penanganan || ($laporan->catatan_petugas && $laporan->status == 'ditolak'))
                    <div class="card mb-4"
                        style="border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06);">
                        <div class="card-header bg-transparent p-4 pb-0" style="border-bottom: 1px solid #EDF2F7;">
                            <h5 class="fw-semibold mb-0" style="color: #0A3A5C;">
                                <i class="fas fa-clipboard-list me-2" style="color: #0A3A5C;"></i> Penanganan Laporan
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @if ($laporan->hasil_penanganan)
                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase mb-2"
                                        style="color: #2A9D8F; letter-spacing: 0.5px;">
                                        <i class="fas fa-check-circle me-1"></i> Hasil Penanganan :
                                    </label>
                                    <div class="p-3"
                                        style="background: rgba(42, 157, 143, 0.05); border-radius: 12px; color: #4A627A; line-height: 1.6;">
                                        {{ nl2br($laporan->hasil_penanganan) }}
                                    </div>
                                </div>
                            @endif
                            @if ($laporan->catatan_petugas && $laporan->status == 'ditolak')
                                <div class="mb-3">
                                    <label class="text-muted small text-uppercase mb-2"
                                        style="color: #E63946; letter-spacing: 0.5px;">
                                        <i class="fas fa-ban me-1"></i> Alasan Penolakan :
                                    </label>
                                    <div class="p-3"
                                        style="background: rgba(230, 57, 70, 0.05); border-radius: 12px; color: #4A627A; line-height: 1.6;">
                                        {{ nl2br($laporan->catatan_petugas) }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if ($laporan->tracking_history)
                    <div class="card"
                        style="border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06);">
                        <div class="card-header bg-transparent p-4 pb-0" style="border-bottom: 1px solid #EDF2F7;">
                            <h5 class="fw-semibold mb-0" style="color: #0A3A5C;">
                                <i class="fas fa-history me-2" style="color: #0A3A5C;"></i> Riwayat Tracking
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @php
                                $tracking = is_string($laporan->tracking_history)
                                    ? json_decode($laporan->tracking_history, true)
                                    : $laporan->tracking_history;
                            @endphp
                            @if ($tracking && is_array($tracking))
                                <div class="timeline">
                                    @foreach ($tracking as $index => $item)
                                        <div class="timeline-item d-flex gap-3 mb-3">
                                            <div class="timeline-icon" style="flex-shrink: 0;">
                                                <div
                                                    style="width: 32px; height: 32px; background: rgba(10, 58, 92, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-check-circle"
                                                        style="color: #0A3A5C; font-size: 14px;"></i>
                                                </div>
                                            </div>
                                            <div class="timeline-content flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <span class="fw-semibold"
                                                        style="color: #0A3A5C;">{{ ucfirst($item['status'] ?? 'Update') }}</span>
                                                    <small class="text-muted"
                                                        style="color: #5A7D9A;">{{ isset($item['tanggal']) ? \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y H:i') : '-' }}</small>
                                                </div>
                                                @if (isset($item['catatan']))
                                                    <p class="mb-0 small" style="color: #4A627A;">{{ $item['catatan'] }}
                                                    </p>
                                                @endif
                                                @if ($index + 1 < count($tracking))
                                                    <div
                                                        style="width: 2px; height: 12px; background: #EDF2F7; margin-left: 15px; margin-top: 8px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card mb-4"
                    style="border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06);">
                    <div class="card-header bg-transparent p-4 pb-0" style="border-bottom: 1px solid #EDF2F7;">
                        <h5 class="fw-semibold mb-0" style="color: #0A3A5C;">
                            <i class="fas fa-user-circle me-2" style="color: #0A3A5C;"></i> Data Pelapor
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div
                                style="width: 72px; height: 72px; background: rgba(10, 58, 92, 0.1); border-radius: 36px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fas fa-user fa-2x" style="color: #0A3A5C;"></i>
                            </div>
                        </div>
                        <div class="info-item mb-3">
                            <label class="text-muted small text-uppercase mb-1"
                                style="color: #5A7D9A; letter-spacing: 0.5px;">Nama Lengkap :</label>
                            <p class="fw-semibold mb-0" style="color: #0A3A5C;">{{ $laporan->user->name ?? '-' }}</p>
                        </div>
                        <div class="info-item mb-3">
                            <label class="text-muted small text-uppercase mb-1"
                                style="color: #5A7D9A; letter-spacing: 0.5px;">Email :</label>
                            <p class="mb-0" style="color: #4A627A;">{{ $laporan->user->email ?? '-' }}</p>
                        </div>
                        <div class="info-item mb-3">
                            <label class="text-muted small text-uppercase mb-1"
                                style="color: #5A7D9A; letter-spacing: 0.5px;">Nomor Telepon :</label>
                            <p class="mb-0" style="color: #4A627A;">{{ $laporan->user->no_telepon ?? '-' }}</p>
                        </div>
                        <div class="info-item">
                            <label class="text-muted small text-uppercase mb-1"
                                style="color: #5A7D9A; letter-spacing: 0.5px;">Alamat :</label>
                            <p class="mb-0" style="color: #4A627A;">{{ $laporan->user->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-4"
                    style="border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06);">
                    <div class="card-header bg-transparent p-4 pb-0" style="border-bottom: 1px solid #EDF2F7;">
                        <h5 class="fw-semibold mb-0" style="color: #0A3A5C;">
                            <i class="fas fa-chart-line me-2" style="color: #0A3A5C;"></i> Informasi Proses
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="progress mb-3" style="height: 8px; border-radius: 10px; background-color: #EDF2F7;">
                            @php
                                $progressMap = [
                                    'menunggu' => 25,
                                    'diverifikasi' => 50,
                                    'diproses' => 75,
                                    'selesai' => 100,
                                    'ditolak' => 0,
                                ];
                                $progress = $progressMap[$laporan->status] ?? 0;
                            @endphp
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ $progress }}%; background-color: #0A3A5C; border-radius: 10px;"
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="info-item mb-3">
                            <label class="text-muted small text-uppercase mb-1"
                                style="color: #5A7D9A; letter-spacing: 0.5px;">Tanggal Laporan :</label>
                            <p class="mb-0" style="color: #4A627A;">
                                {{ $laporan->created_at->translatedFormat('d F Y H:i') }} WIB</p>
                        </div>
                        @if ($laporan->tanggal_diterima)
                            <div class="info-item mb-3">
                                <label class="text-muted small text-uppercase mb-1"
                                    style="color: #5A7D9A; letter-spacing: 0.5px;">Tanggal Diterima :</label>
                                <p class="mb-0" style="color: #4A627A;">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_diterima)->translatedFormat('d F Y H:i') }}
                                    WIB</p>
                            </div>
                        @endif
                        @if ($laporan->tanggal_verifikasi)
                            <div class="info-item mb-3">
                                <label class="text-muted small text-uppercase mb-1"
                                    style="color: #5A7D9A; letter-spacing: 0.5px;">Tanggal Verifikasi :</label>
                                <p class="mb-0" style="color: #4A627A;">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_verifikasi)->translatedFormat('d F Y H:i') }}
                                    WIB</p>
                            </div>
                        @endif
                        @if ($laporan->target_selesai)
                            <div class="info-item">
                                <label class="text-muted small text-uppercase mb-1"
                                    style="color: #5A7D9A; letter-spacing: 0.5px;">Target Selesai :</label>
                                <p class="mb-0" style="color: #4A627A;">
                                    {{ \Carbon\Carbon::parse($laporan->target_selesai)->translatedFormat('d F Y') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($laporan->nama_penerima)
                    <div class="card mb-4"
                        style="border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06);">
                        <div class="card-header bg-transparent p-4 pb-0" style="border-bottom: 1px solid #EDF2F7;">
                            <h5 class="fw-semibold mb-0" style="color: #0A3A5C;">
                                <i class="fas fa-user-shield me-2" style="color: #0A3A5C;"></i> Petugas Penanganan
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    style="width: 48px; height: 48px; background: rgba(10, 58, 92, 0.1); border-radius: 24px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-tie fa-lg" style="color: #0A3A5C;"></i>
                                </div>
                                <div>
                                    <p class="fw-semibold mb-0" style="color: #0A3A5C;">{{ $laporan->nama_penerima }}</p>
                                    <small class="text-muted" style="color: #5A7D9A;">Petugas Penerima</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($laporan->verifikator_id && $laporan->verifikator)
                    <div class="card"
                        style="border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 2px 12px rgba(10, 58, 92, 0.06);">
                        <div class="card-header bg-transparent p-4 pb-0" style="border-bottom: 1px solid #EDF2F7;">
                            <h5 class="fw-semibold mb-0" style="color: #0A3A5C;">
                                <i class="fas fa-check-double me-2" style="color: #0A3A5C;"></i> Petugas Verifikator
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    style="width: 48px; height: 48px; background: rgba(10, 58, 92, 0.1); border-radius: 24px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-check fa-lg" style="color: #0A3A5C;"></i>
                                </div>
                                <div>
                                    <p class="fw-semibold mb-0" style="color: #0A3A5C;">
                                        {{ $laporan->verifikator->name ?? ($laporan->nama_verifikator ?? '-') }}</p>
                                    <small class="text-muted" style="color: #5A7D9A;">Petugas Verifikator</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTolak" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('petugas.laporan.tolak', $laporan->id) }}" method="GET">
                <div class="modal-content" style="border-radius: 20px; border: none;">
                    <div class="modal-header" style="border-bottom: 1px solid #EDF2F7; padding: 1.25rem 1.5rem;">
                        <h5 class="modal-title fw-semibold" style="color: #E63946;">
                            <i class="fas fa-ban me-2"></i> Tolak Laporan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="padding: 1.5rem;">
                        <label class="form-label fw-semibold mb-2" style="color: #0A3A5C;">Alasan Penolakan</label>
                        <textarea name="catatan_petugas" class="form-control" rows="4" required
                            placeholder="Masukkan alasan penolakan laporan..." style="border-radius: 12px; border-color: #E2E8F0;"></textarea>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #EDF2F7; padding: 1rem 1.5rem;">
                        <button type="button" class="btn"
                            style="background: rgba(10, 58, 92, 0.08); border-radius: 10px; color: #0A3A5C; padding: 0.5rem 1.5rem;"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn"
                            style="background: #E63946; border-radius: 10px; color: white; padding: 0.5rem 1.5rem;">Tolak
                            Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalSelesai" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('petugas.laporan.selesai', $laporan->id) }}" method="GET">
                <div class="modal-content" style="border-radius: 20px; border: none;">
                    <div class="modal-header" style="border-bottom: 1px solid #EDF2F7; padding: 1.25rem 1.5rem;">
                        <h5 class="modal-title fw-semibold" style="color: #2A9D8F;">
                            <i class="fas fa-check-circle me-2"></i> Selesaikan Laporan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="padding: 1.5rem;">
                        <label class="form-label fw-semibold mb-2" style="color: #0A3A5C;">Hasil Penanganan</label>
                        <textarea name="hasil_penanganan" class="form-control" rows="4" required
                            placeholder="Masukkan hasil penanganan laporan..." style="border-radius: 12px; border-color: #E2E8F0;"></textarea>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #EDF2F7; padding: 1rem 1.5rem;">
                        <button type="button" class="btn"
                            style="background: rgba(10, 58, 92, 0.08); border-radius: 10px; color: #0A3A5C; padding: 0.5rem 1.5rem;"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn"
                            style="background: #2A9D8F; border-radius: 10px; color: white; padding: 0.5rem 1.5rem;">Selesaikan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .form-control:focus {
            border-color: #0A3A5C;
            box-shadow: 0 0 0 0.2rem rgba(10, 58, 92, 0.1);
            outline: none;
        }

        .btn:hover {
            transform: translateY(-1px);
            transition: transform 0.2s;
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(10, 58, 92, 0.12) !important;
        }
    </style>
@endsection
