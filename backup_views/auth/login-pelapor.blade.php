<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelapor - Polsek Margahayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }
        .login-header i {
            font-size: 60px;
            margin-bottom: 15px;
        }
        .login-body {
            padding: 30px;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: bold;
        }
        .role-badge {
            position: absolute;
            top: -15px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="login-card position-relative">
        <div class="role-badge">
            <i class="fas fa-user"></i> MASYARAKAT / PELAPOR
        </div>
        <div class="login-header">
            <i class="fas fa-file-alt"></i>
            <h3>Aplikasi Laporan Masyarakat</h3>
            <p class="mb-0">Polsek Margahayu - Unit Reskrim</p>
        </div>
        <div class="login-body">
            <h4 class="text-center mb-4">Login Pelapor</h4>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login w-100">
                    <i class="fas fa-sign-in-alt me-2"></i> Login sebagai Pelapor
                </button>
            </form>
            
            <hr class="my-4">
            
            <div class="text-center">
                <p>Belum punya akun? <a href="{{ route('pelapor.register') }}">Daftar disini</a></p>
                <a href="{{ route('petugas.login') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-user-shield"></i> Login untuk Petugas
                </a>
            </div>
            
            <div class="mt-3 text-center">
                <small class="text-muted">Demo: pelapor@example.com / password</small>
            </div>
        </div>
    </div>
</body>
</html>