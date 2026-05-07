<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelapor - Polsek Margahayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f4f4f4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 460px;
            position: relative;
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            padding: 40px 35px 20px;
            text-align: center;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: #1A05A2;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            box-shadow: 0 8px 20px -8px rgba(26, 5, 162, 0.3);
        }

        .logo-icon i {
            font-size: 34px;
            color: white;
        }

        .login-header h3 {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.3px;
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 0;
        }

        .login-body {
            padding: 20px 35px 40px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 32px;
        }

        .welcome-text h4 {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .welcome-text p {
            font-size: 13px;
            color: #94a3b8;
        }

        .form-label {
            font-weight: 600;
            font-size: 12px;
            color: #475569;
            margin-bottom: 6px;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            z-index: 10;
            pointer-events: none;
        }

        .input-group-custom .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        .input-group-custom .password-toggle:hover {
            color: #1A05A2;
        }

        .input-group-custom input {
            width: 100%;
            padding: 12px 40px 12px 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 14px;
            transition: all 0.2s;
            background: white;
            font-weight: 500;
        }

        .input-group-custom input:focus {
            outline: none;
            border-color: #1A05A2;
            box-shadow: 0 0 0 3px rgba(26, 5, 162, 0.1);
        }

        .input-group-custom input.is-invalid {
            border-color: #dc2626;
        }

        .input-group-custom input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .invalid-feedback-custom {
            font-size: 11px;
            color: #dc2626;
            margin-top: 6px;
            margin-left: 12px;
        }

        .form-check {
            margin: 20px 0;
            padding-left: 24px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            margin-top: 0;
            cursor: pointer;
            border: 1.5px solid #cbd5e1;
            border-radius: 4px;
        }

        .form-check-input:checked {
            background-color: #1A05A2;
            border-color: #1A05A2;
        }

        .form-check-label {
            font-size: 12px;
            color: #64748b;
            cursor: pointer;
            margin-left: 6px;
        }

        .btn-login {
            background: #1A05A2;
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
            border-radius: 14px;
            transition: all 0.3s;
            margin-top: 8px;
            color: white;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: #15047a;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -8px rgba(26, 5, 162, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-outline-custom {
            background: transparent;
            border: 1.5px solid #e2e8f0;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            border-radius: 40px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-custom:hover {
            border-color: #1A05A2;
            background: #f8fafc;
            color: #1A05A2;
        }

        .role-badge {
            position: absolute;
            top: -12px;
            right: 24px;
            background: #10b981;
            color: white;
            padding: 5px 16px;
            border-radius: 40px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            z-index: 20;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .alert-custom {
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 12px;
            margin-bottom: 24px;
            animation: slideIn 0.3s;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success-custom {
            background: #ecfdf5;
            color: #065f46;
            border-left: 3px solid #10b981;
        }

        .alert-danger-custom {
            background: #fef2f2;
            color: #991b1b;
            border-left: 3px solid #dc2626;
        }

        hr {
            margin: 28px 0;
            border-color: #eef2ff;
        }

        .register-link {
            text-align: center;
        }

        .register-link p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 0;
        }

        .register-link a {
            color: #1A05A2;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 520px) {
            .login-card {
                margin: 20px;
                max-width: calc(100% - 40px);
            }
            
            .login-body {
                padding: 20px 24px 35px;
            }
            
            .login-header {
                padding: 35px 24px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card position-relative">
        <div class="role-badge">
            <i class="ti ti-user"></i> MASYARAKAT
        </div>
        <div class="login-header">
            <div class="logo-icon">
                <i class="ti ti-file-report"></i>
            </div>
            <h3>Aplikasi Laporan Masyarakat</h3>
            <p>Polsek Margahayu - Unit Reskrim</p>
        </div>
        <div class="login-body">
            <div class="welcome-text">
                <h4>Selamat Datang Kembali</h4>
                <p>Silakan login untuk melanjutkan</p>
            </div>
            
            @if(session('success'))
                <div class="alert-custom alert-success-custom">
                    <div>
                        <i class="ti ti-circle-check"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-custom alert-danger-custom">
                    <div>
                        <i class="ti ti-alert-circle"></i>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group-custom">
                        <i class="ti ti-mail input-icon"></i>
                        <input type="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@example.com" required autofocus>
                    </div>
                    @error('email')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom">
                        <i class="ti ti-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror" placeholder="Masukkan password" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="ti ti-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-check d-flex align-items-center">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="ti ti-login"></i> Login
                </button>
            </form>
            
            <hr>
            
            <div class="register-link">
                <p>Belum punya akun? <a href="{{ route('pelapor.register') }}">Daftar disini</a></p>
            </div>
            
            <div class="text-center mt-3">
                <a href="{{ route('petugas.login') }}" class="btn-outline-custom">
                    <i class="ti ti-shield"></i> Login untuk Petugas
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = togglePassword.querySelector('i');
                if (icon) {
                    if (type === 'text') {
                        icon.classList.remove('ti-eye');
                        icon.classList.add('ti-eye-off');
                    } else {
                        icon.classList.remove('ti-eye-off');
                        icon.classList.add('ti-eye');
                    }
                }
            });
        }
    </script>
</body>
</html>