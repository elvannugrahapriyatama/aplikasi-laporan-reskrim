@extends('layouts.app')

@section('title', 'Buat Laporan Baru')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-plus-circle me-2"></i> Form Laporan Kejadian</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pelapor.laporan.store') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" name="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" required>
                        @error('judul_laporan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kejahatan <span class="text-danger">*</span></label>
                        <select name="jenis_kejahatan" class="form-control @error('jenis_kejahatan') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Kejahatan</option>
                            <option value="pencurian">Pencurian</option>
                            <option value="penganiayaan">Penganiayaan</option>
                            <option value="penipuan">Penipuan</option>
                            <option value="pengerusakan">Pengerusakan</option>
                            <option value="narkoba">Narkoba</option>
                            <option value="kekerasan_dalam_rumah_tangga">KDRT</option>
                            <option value="pencabulan">Pencabulan</option>
                            <option value="lalu_lintas">Lalu Lintas</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        @error('jenis_kejahatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Kejadian <span class="text-danger">*</span></label>
                    <textarea name="deskripsi_kejadian" class="form-control @error('deskripsi_kejadian') is-invalid @enderror" rows="4" required></textarea>
                    <small class="text-muted">Jelaskan secara detail apa yang terjadi</small>
                    @error('deskripsi_kejadian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kronologi Kejadian</label>
                    <textarea name="kronologi" class="form-control" rows="3"></textarea>
                    <small class="text-muted">Urutan waktu kejadian dari awal hingga akhir</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Kejadian <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="waktu_kejadian" class="form-control @error('waktu_kejadian') is-invalid @enderror" required>
                        @error('waktu_kejadian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tempat Kejadian <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_kejadian" class="form-control @error('tempat_kejadian') is-invalid @enderror" placeholder="Alamat lengkap TKP" required>
                        @error('tempat_kejadian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-header">
                        <strong><i class="fas fa-user-injured me-2"></i> Data Korban (Opsional)</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Korban</label>
                                <input type="text" name="korban_nama" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Alamat Korban</label>
                                <textarea name="korban_alamat" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-header">
                        <strong><i class="fas fa-user-secret me-2"></i> Data Pelaku (Opsional)</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Pelaku (jika diketahui)</label>
                                <input type="text" name="pelaku_nama" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Ciri-ciri Pelaku</label>
                                <textarea name="ciri_pelaku" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Barang Bukti</label>
                    <textarea name="barang_bukti" class="form-control" rows="2" placeholder="Sebutkan barang bukti yang ada (jika ada)"></textarea>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Perhatian:</strong> Pastikan data yang Anda isikan benar dan sesuai dengan kejadian yang sebenarnya. Pemberian data palsu dapat dikenakan sanksi hukum.
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pelapor.laporan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i> Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection