<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <div class="d-flex justify-content-start align-items-center">
            <img src="{{ asset('backend/images/icons/logo.svg') }}" alt="icon">
            <span>Admin</span>
        </div>

        <button id="toggle-navbar" onclick="toggleNavbar()">
            <img src="{{ asset('backend/images/icons/navbar-times.svg') }}" alt="icon">
        </button>
    </a>

    <h5 class="sidebar-title">General</h5>

    <a href="{{ route('admin.dashboard') }}" class="sidebar-item @yield('dashboardPage')">
        <img src="{{ asset('backend/images/icons/grid.svg') }}" alt="icon" width="18" height="18" class="me-3" >
        <span>Dashboard</span>
    </a>

    <a href="{{ route('admin.occupation.index') }}" class="sidebar-item @yield('occupationPage')">
        <img src="{{ asset('backend/images/icons/receipt.svg') }}" alt="icon" width="18" height="18" class="me-3" >
        <span>Occupation</span>
    </a>

    {{-- <a href="{{ route('admin.products.index') }}" class="sidebar-item @yield('productPage')">
        <img src="{{ asset('backend/images/icons/bag-frame.svg') }}" alt="icon" width="18" height="18" class="me-3" >
        <span>Product</span>
    </a> --}}

    <a href="#" class="sidebar-item">
        <img src="{{ asset('backend/images/icons/log-out.svg') }}" alt="icon" width="18" height="18" class="me-3" >
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="p-0 btn btn-sm btn-link hover-off">Logout</button>
        </form>
    </a>

</aside>
