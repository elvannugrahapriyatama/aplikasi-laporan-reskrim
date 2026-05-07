<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Aplikasi Laporan Reskrim Polsek Margahayu')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-brand {
            font-weight: bold;
        }
        
        .sidebar {
            min-height: calc(100vh - 56px);
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 16px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
        }
        
        .sidebar .nav-link i {
            width: 25px;
        }
        
        .card-stats {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
        }
        
        .card-stats:hover {
            transform: translateY(-5px);
        }
        
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        footer {
            background-color: #1e3c72;
            color: white;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route(Auth::user()->role . '.dashboard') }}">
                <i class="fas fa-shield-alt me-2"></i>
                Polsek Margahayu - Unit Reskrim
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i>
                        {{ Auth::user()->name }}
                        <span class="badge bg-light text-dark ms-1">{{ ucfirst(Auth::user()->role) }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                <i class="fas fa-user-circle me-2"></i> Profil Saya
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar p-0">
                <div class="p-3">
                    <div class="text-center mb-4">
                        <i class="fas fa-police-badge fa-3x"></i>
                        <h5 class="mt-2">Unit Reskrim</h5>
                        <small>Polsek Margahayu</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}" 
                               href="{{ route(Auth::user()->role . '.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        
                        @if(Auth::user()->role == 'petugas')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('petugas.laporan.*') ? 'active' : '' }}" 
                               href="{{ route('petugas.laporan.index') }}">
                                <i class="fas fa-file-alt"></i> Semua Laporan
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pelapor.laporan.*') ? 'active' : '' }}" 
                               href="{{ route('pelapor.laporan.index') }}">
                                <i class="fas fa-folder"></i> Laporan Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pelapor.laporan.create') ? 'active' : '' }}" 
                               href="{{ route('pelapor.laporan.create') }}">
                                <i class="fas fa-plus-circle"></i> Buat Laporan
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4" style="margin-top: 20px; min-height: calc(100vh - 120px);">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <footer class="text-center">
        <div class="container">
            <small>&copy; 2026 Polsek Margahayu - Unit Reserse Kriminal. All rights reserved.</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>