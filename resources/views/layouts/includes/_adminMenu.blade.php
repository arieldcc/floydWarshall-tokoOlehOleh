<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/data-toko">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-building-user fa-bounce"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko Oleh-Oleh</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $menu=='data-toko'? 'active':'' }}">
        <a class="nav-link" href="/data-toko">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $menu=='data-jalan'? 'active':'' }}">
        <a class="nav-link" href="/data-jalan">
            <i class="fa-solid fa-building-user"></i>
            <span>Data Jalan</span></a>
    </li>
    <li class="nav-item {{ $menu=='data-toko'? 'active':'' }}">
        <a class="nav-link" href="/data-toko">
            <i class="fas fa-concierge-bell"></i>
            <span>Data Toko</span></a>
    </li>
    {{-- <li class="nav-item {{ $menu=='floyd-warshall'? 'active':'' }}">
        <a class="nav-link" href="/floyd-warshall">
            <i class="fas fa-solid fa-list-ol"></i>
            <span>Coba Algoritma Floyd-Warshall</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Proses Data
    </div>

    <li class="nav-item {{ $menu=='data-edge'? 'active':'' }}">
        <a class="nav-link" href="/data-edge">
            {{-- <i class="fas fa-solid fa-list-ol"></i> --}}
            <i class="fas fa-solid fa-folder-plus"></i>
            <span>Buat Edge</span></a>
    </li>

    {{-- <li class="nav-item {{ $menu=='data-pengajuan'? 'active':'' }}">
        <a class="nav-link" href="/data-pengajuan">
            <i class="fa-solid fa-boxes-packing"></i>
            <span>Data Pengajuan Pelayanan Desa</span></a>
    </li> --}}

    <div class="sidebar-heading">
        Rute
    </div>

    <li class="nav-item {{ $menu=='data-fw'? 'active':'' }}">
        <a class="nav-link" href="/data-fw">
            <i class="fa-solid fa-business-time fa-beat-fade"></i>
            <span>Algoritma Floyd Warshall</span></a>
    </li>

    <li class="nav-item {{ $menu=='data-rutefw'? 'active':'' }}">
        <a class="nav-link" href="/data-rutefw">
            <i class="fa-solid fa-business-time fa-beat-fade"></i>
            <span>Rute Floyd Warshall</span></a>
    </li>


    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Tools
    </div> --}}

    {{-- <li class="nav-item {{ $menu=='data-user'? 'active':'' }}">
        <a class="nav-link" href="/data-user"> --}}
            {{-- <i class="fas fa-solid fa-server"></i> --}}
            {{-- <i class="fas fa-solid fa-users"></i>
            <span>Data User</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
