<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas - Polsek Margahayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0c10 0%, #1a1a2e 50%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.02) 0px, rgba(255, 255, 255, 0.02) 2px, transparent 2px, transparent 8px);
            pointer-events: none;
        }

        .login-card {
            background: rgba(18, 22, 35, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.6);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            padding: 40px 35px 35px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .badge-police {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
            padding: 6px 16px;
            border-radius: 40px;
            margin-bottom: 25px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .shield-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1e3a8a, #dc2626);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .login-header:hover .shield-logo {
            transform: scale(1.05);
        }

        .shield-logo svg {
            width: 45px;
            height: 45px;
        }

        .login-header h3 {
            font-size: 22px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 12px;
            opacity: 0.6;
            color: #94a3b8;
            margin-bottom: 0;
        }

        .login-body {
            padding: 35px 38px 45px;
        }

        .login-body h4 {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin-bottom: 28px;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            font-size: 11px;
            color: #94a3b8;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 20px;
            z-index: 10;
            transition: color 0.2s ease;
            pointer-events: none;
        }

        .input-group-custom .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            cursor: pointer;
            font-size: 20px;
            z-index: 10;
            transition: color 0.2s ease;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-custom .password-toggle:hover {
            color: #60a5fa;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 48px 14px 48px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-weight: 500;
        }

        .input-group-custom input::placeholder {
            color: #475569;
        }

        .input-group-custom input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .input-group-custom input.is-invalid {
            border-color: #dc2626;
        }

        .input-group-custom input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .invalid-feedback-custom {
            font-size: 11px;
            color: #ef4444;
            margin-top: 6px;
            margin-left: 12px;
        }

        .form-check {
            margin: 22px 0;
            padding-left: 28px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            margin-top: 0;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .form-check-label {
            font-size: 12px;
            color: #94a3b8;
            cursor: pointer;
            margin-left: 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
            border: none;
            padding: 14px;
            font-weight: 700;
            font-size: 14px;
            border-radius: 14px;
            transition: all 0.3s ease;
            margin-top: 10px;
            letter-spacing: 0.5px;
            color: white;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(30, 58, 138, 0.4);
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 600;
            color: #94a3b8;
            border-radius: 40px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-custom:hover {
            border-color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
        }

        .role-badge {
            position: absolute;
            top: -12px;
            right: 24px;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 6px 18px;
            border-radius: 40px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            z-index: 20;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 12px 16px;
            font-size: 12px;
            margin-bottom: 24px;
            animation: slideIn 0.3s ease-out;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success-custom {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-left: 3px solid #10b981;
        }

        .alert-danger-custom {
            background: rgba(220, 38, 38, 0.1);
            color: #f87171;
            border-left: 3px solid #dc2626;
        }

        hr {
            margin: 28px 0;
            border-color: rgba(255, 255, 255, 0.05);
        }

        @media (max-width: 560px) {
            .login-card {
                margin: 20px;
                max-width: calc(100% - 40px);
            }

            .login-body {
                padding: 28px 24px 35px;
            }

            .login-header {
                padding: 30px 24px 25px;
            }

            .shield-logo {
                width: 65px;
                height: 65px;
            }

            .shield-logo svg {
                width: 35px;
                height: 35px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card position-relative">
        <div class="role-badge">
            <i class="ti ti-shield-filled"></i> RESKRIM
        </div>
        <div class="login-header">
            <div class="badge-police">
                <i class="ti ti-building-police"></i> POLSEK MARGAHAYU
            </div>
            <div class="shield-logo">
                <svg width="179px" height="179px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M11.302 21.6149C11.5234 21.744 11.6341 21.8086 11.7903 21.8421C11.9116 21.8681 12.0884 21.8681 12.2097 21.8421C12.3659 21.8086 12.4766 21.744 12.698 21.6149C14.646 20.4784 20 16.9084 20 12V6.6C20 6.04207 20 5.7631 19.8926 5.55048C19.7974 5.36198 19.6487 5.21152 19.4613 5.11409C19.25 5.00419 18.9663 5.00084 18.3988 4.99413C15.4272 4.95899 13.7136 4.71361 12 3C10.2864 4.71361 8.57279 4.95899 5.6012 4.99413C5.03373 5.00084 4.74999 5.00419 4.53865 5.11409C4.35129 5.21152 4.20259 5.36198 4.10739 5.55048C4 5.7631 4 6.04207 4 6.6V12C4 16.9084 9.35396 20.4784 11.302 21.6149Z"
                            stroke="#ffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>
            <h3>Sistem Penanganan Laporan</h3>
            <p>Unit Reskrim & Penyelidikan</p>
        </div>
        <div class="login-body">
            <h4>Akses Petugas</h4>

            @if (session('success'))
                <div class="alert-custom alert-success-custom">
                    <div>
                        <i class="ti ti-circle-check"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-sm btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-custom alert-danger-custom">
                    <div>
                        <i class="ti ti-alert-circle"></i>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-close btn-close-sm btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">EMAIL</label>
                    <div class="input-group-custom">
                        <i class="ti ti-mail input-icon"></i>
                        <input type="email" name="email" class="@error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="petugas@polsek.com" required autofocus>
                    </div>
                    @error('email')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">KATA SANDI</label>
                    <div class="input-group-custom">
                        <i class="ti ti-lock input-icon"></i>
                        <input type="password" name="password" id="password"
                            class="@error('password') is-invalid @enderror" placeholder="Masukkan kata sandi" required>
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
                    <i class="ti ti-login"></i> MASUK KE DASHBOARD
                </button>
            </form>

            <hr>

            <div class="text-center">
                <a href="{{ route('pelapor.login') }}" class="btn-outline-custom">
                    <i class="ti ti-user"></i> Portal Masyarakat
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
