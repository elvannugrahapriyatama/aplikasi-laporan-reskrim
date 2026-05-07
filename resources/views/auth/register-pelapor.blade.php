<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pelapor - Polsek Margahayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #fafafa;
            min-height: 100vh;
            padding: 40px 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .register-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
            max-width: 520px;
            margin: 0 auto;
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

        .register-header {
            padding: 35px 35px 25px;
            text-align: center;
            border-bottom: 1px solid #eef2ff;
        }

        .logo-icon {
            width: 65px;
            height: 65px;
            background: #1A05A2;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px auto;
            box-shadow: 0 8px 20px -8px rgba(26, 5, 162, 0.3);
        }

        .logo-icon i {
            font-size: 32px;
            color: white;
        }

        .register-header h3 {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.3px;
            margin-bottom: 6px;
        }

        .register-header p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 0;
        }

        .register-body {
            padding: 30px 35px 40px;
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

        .input-group-custom input,
        .input-group-custom textarea {
            width: 100%;
            padding: 12px 40px 12px 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 14px;
            transition: all 0.2s;
            background: white;
            font-weight: 500;
        }

        .input-group-custom textarea {
            padding: 12px 16px 12px 44px;
            resize: vertical;
        }

        .input-group-custom input:focus,
        .input-group-custom textarea:focus {
            outline: none;
            border-color: #1A05A2;
            box-shadow: 0 0 0 3px rgba(26, 5, 162, 0.1);
        }

        .input-group-custom input.is-invalid {
            border-color: #dc2626;
        }

        .invalid-feedback-custom {
            font-size: 11px;
            color: #dc2626;
            margin-top: 6px;
            margin-left: 12px;
        }

        .btn-register {
            background: #1A05A2;
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
            border-radius: 14px;
            transition: all 0.3s;
            margin-top: 10px;
            color: white;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-register:hover {
            background: #15047a;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -8px rgba(26, 5, 162, 0.4);
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
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .login-link {
            text-align: center;
        }

        .login-link p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 0;
        }

        .login-link a {
            color: #1A05A2;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 560px) {
            .register-card {
                margin: 20px;
                max-width: calc(100% - 40px);
            }

            .register-body {
                padding: 24px 24px 35px;
            }

            .register-header {
                padding: 30px 24px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="register-card">
        <div class="register-header">
            <div class="logo-icon">
                <i class="ti ti-user-plus"></i>
            </div>
            <h3>Daftar Akun Baru</h3>
            <p>Silakan isi data diri Anda</p>
        </div>
        <div class="register-body">
            @if ($errors->any())
                <div class="alert-custom alert-danger-custom">
                    <div>
                        <i class="ti ti-alert-circle"></i>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('pelapor.register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group-custom">
                        <i class="ti ti-user input-icon"></i>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                    </div>
                    @error('name')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group-custom">
                        <i class="ti ti-mail input-icon"></i>
                        <input type="email" name="email" class="@error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="nama@example.com" required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <div class="input-group-custom">
                        <i class="ti ti-phone input-icon"></i>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                            placeholder="081234567890">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <div class="input-group-custom">
                        <i class="ti ti-home input-icon"></i>
                        <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom">
                        <i class="ti ti-lock input-icon"></i>
                        <input type="password" name="password" id="password"
                            class="@error('password') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="ti ti-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group-custom">
                        <i class="ti ti-lock input-icon"></i>
                        <input type="password" name="password_confirmation" id="passwordConfirm"
                            placeholder="Ulangi password" required>
                        <button type="button" class="password-toggle" id="togglePasswordConfirm">
                            <i class="ti ti-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="ti ti-user-plus"></i> Daftar
                </button>
            </form>

            <hr>

            <div class="login-link">
                <p>Sudah punya akun? <a href="{{ route('pelapor.login') }}">Login disini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('passwordConfirm');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                const icon = togglePassword.querySelector('i');
                if (icon) {
                    icon.classList.toggle('ti-eye');
                    icon.classList.toggle('ti-eye-off');
                }
            });
        }

        if (togglePasswordConfirm && passwordConfirmInput) {
            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmInput.setAttribute('type', type);
                const icon = togglePasswordConfirm.querySelector('i');
                if (icon) {
                    icon.classList.toggle('ti-eye');
                    icon.classList.toggle('ti-eye-off');
                }
            });
        }
    </script>
</body>

</html>
