<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="brand-content">
                <img src="images/Teck_Market.png" alt="logo" class="brand-logo-image"
                    style="max-width: 40px; max-height: 50px; margin-left: 30px;" />
                <span class="brand-logo-text" style="color: #D12027; font-weight: bold;">TeckMarket </span>
            </div>
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="images/Teck_Market.png"
                alt="logo" /></a>
        <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button"
            data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item  d-none d-lg-flex">
                <a class="nav-link active">
                    Statistic
                </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
                <a class="nav-link" href="{{ route('user.index') }}">
                    Employee
                </a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown"
                    id="profileDropdown">
                    <i class="typcn typcn-user-outline mr-0"></i>
                    <span class="nav-profile-name">Muhamad Ghandi Nur Setiawan</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item">
                        <i class="typcn typcn-power text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>
