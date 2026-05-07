<style>
    .navbar-custom {
        background: white;
        padding: 12px 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .menu-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #1e293b;
        padding: 8px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .menu-toggle:hover {
        background: #f1f5f9;
    }

    .navbar-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
    }

    .navbar-title i {
        margin-right: 10px;
        color: #3b82f6;
    }

    .user-dropdown {
        position: relative;
        cursor: pointer;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 16px;
        border-radius: 40px;
        background: #f8fafc;
        transition: all 0.3s ease;
    }

    .user-info:hover {
        background: #f1f5f9;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 16px;
    }

    .user-name {
        font-weight: 600;
        font-size: 14px;
        color: #1e293b;
    }

    .user-role {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .dropdown-menu-custom {
        position: absolute;
        top: 60px;
        right: 0;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 240px;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .dropdown-menu-custom.show {
        opacity: 1;
        visibility: visible;
        top: 55px;
    }

    .dropdown-menu-custom a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 14px;
    }

    .dropdown-menu-custom a:hover {
        background: #f8fafc;
        color: #1e293b;
    }

    .dropdown-menu-custom hr {
        margin: 8px 0;
        border-color: #e2e8f0;
    }

    @media (max-width: 768px) {
        .menu-toggle {
            display: block;
        }
        
        .navbar-custom {
            padding: 12px 20px;
        }
        
        .user-name, .user-role {
            display: none;
        }
        
        .user-info {
            padding: 4px;
        }
    }
</style>

<div class="navbar-custom">
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="ti ti-menu-2"></i>
    </button>
    
    <div class="navbar-title">
        <i class="ti ti-file-report"></i>
        @if(Auth::check() && Auth::user()->role == 'petugas')
            Panel Petugas Reskrim
        @elseif(Auth::check() && Auth::user()->role == 'pelapor')
            Panel Pelapor Masyarakat
        @else
            Sistem Laporan Masyarakat
        @endif
    </div>
    
    @if(Auth::check())
    <div class="user-dropdown" onclick="event.stopPropagation()">
        <div class="user-info" onclick="toggleDropdown()">
            <div class="user-avatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->role == 'petugas' ? 'Petugas' : 'Masyarakat' }}</div>
            </div>
            <i class="ti ti-chevron-down" style="font-size: 16px; color: #94a3b8;"></i>
        </div>
        
        <div class="dropdown-menu-custom" id="dropdownMenu">
            <a href="#">
                <i class="ti ti-user-circle"></i>
                <span>Profil Saya</span>
            </a>
            <a href="#">
                <i class="ti ti-settings"></i>
                <span>Pengaturan</span>
            </a>
            <hr>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="#" onclick="document.getElementById('logout-form').submit(); return false;">
                    <i class="ti ti-logout"></i>
                    <span>Keluar</span>
                </a>
            </form>
        </div>
    </div>
    @endif
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('show');
    }
    
    document.addEventListener('click', function() {
        const dropdown = document.getElementById('dropdownMenu');
        if (dropdown && dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    });
</script>