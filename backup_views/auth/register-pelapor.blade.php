<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pelapor - Polsek Margahayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
        }
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            max-width: 550px;
            margin: 0 auto;
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }
        .register-header i {
            font-size: 50px;
            margin-bottom: 10px;
        }
        .register-body {
            padding: 30px;
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <i class="fas fa-user-plus"></i>
            <h3>Daftar Akun Baru</h3>
            <p class="mb-0">Silakan isi data diri Anda</p>
        </div>
        <div class="register-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('pelapor.register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register w-100">
                    <i class="fas fa-user-plus me-2"></i> Daftar
                </button>
            </form>
            
            <hr class="my-4">
            
            <div class="text-center">
                <p>Sudah punya akun? <a href="{{ route('pelapor.login') }}">Login disini</a></p>
            </div>
        </div>
    </div>
</body>
</html>