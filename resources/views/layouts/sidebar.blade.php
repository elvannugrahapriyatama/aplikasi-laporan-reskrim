<style>
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 280px;
        height: 100vh;
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        color: white;
        transition: all 0.3s ease;
        z-index: 1000;
        overflow-y: auto;
    }

    .sidebar-header {
        padding: 25px 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 20px;
    }

    .sidebar-header i {
        font-size: 45px;
        margin-bottom: 10px;
        color: #3b82f6;
    }

    .sidebar-header h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .sidebar-header p {
        font-size: 11px;
        opacity: 0.7;
        margin-bottom: 0;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0 15px;
    }

    .sidebar-menu li {
        margin-bottom: 5px;
    }

    .sidebar-menu li a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
    }

    .sidebar-menu li a i {
        font-size: 20px;
        margin-right: 12px;
    }

    .sidebar-menu li a:hover {
        background: rgba(59, 130, 246, 0.2);
        color: white;
    }

    .sidebar-menu li.active a {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 11px;
        text-align: center;
        opacity: 0.6;
    }

    @media (max-width: 768px) {
        .sidebar {
            left: -280px;
        }

        .sidebar.active {
            left: 0;
        }
    }
</style>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <i class="ti ti-shield-filled"></i>
        <h4>Polsek Margahayu</h4>
        <p>Unit Reskrim</p>
    </div>

    <ul class="sidebar-menu">
        @if (Auth::check() && Auth::user()->role == 'petugas')
            <li class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <a href="{{ route('petugas.dashboard') }}">
                    <i class="ti ti-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('petugas.laporan.*') ? 'active' : '' }}">
                <a href="{{ route('petugas.laporan.index') }}">
                    <i class="ti ti-file-description"></i>
                    <span>Daftar Laporan</span>
                </a>
            </li>
        @elseif(Auth::check() && Auth::user()->role == 'pelapor')
            <li class="{{ request()->routeIs('pelapor.dashboard') ? 'active' : '' }}">
                <a href="{{ route('pelapor.dashboard') }}">
                    <i class="ti ti-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('pelapor.laporan.*') ? 'active' : '' }}">
                <a href="{{ route('pelapor.laporan.index') }}">
                    <i class="ti ti-file-description"></i>
                    <span>Laporan Saya</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('pelapor.laporan.create') ? 'active' : '' }}">
                <a href="{{ route('pelapor.laporan.create') }}">
                    <i class="ti ti-plus"></i>
                    <span>Buat Laporan</span>
                </a>
            </li>
        @endif
    </ul>

    <div class="sidebar-footer">
        <i class="ti ti-building-police"></i> Sistem Informasi Laporan Masyarakat
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
    }
</script>
