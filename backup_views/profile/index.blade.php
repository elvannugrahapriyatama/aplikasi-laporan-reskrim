@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-user-circle me-2"></i> Profil Saya</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                        <small class="text-muted">Email tidak dapat diubah</small>
                    </div>
                </div>

                @if(Auth::user()->role == 'pelapor')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="{{ Auth::user()->no_telepon }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ Auth::user()->alamat }}</textarea>
                    </div>
                </div>
                @endif

                <hr>

                <h5 class="mb-3">Ganti Password (Opsional)</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection