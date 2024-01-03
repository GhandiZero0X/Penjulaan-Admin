<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image">
                    <img src="{{ asset('images/faces/Ghandi.jfif') }}" alt="image">
                    <span class="sidebar-status-indicator"></span>
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name">
                        Muhamad Ghandi Nur Setiawan
                    </p>
                    <p class="sidebar-designation">
                        Welcome
                    </p>
                </div>
            </div>
            <p class="sidebar-menu-title">Pilihan Menu : </p>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('penjualan.index') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Penjualan</span>
            </a>
        </li>

    </ul>
</nav>
