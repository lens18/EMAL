<!-- Sidebar -->

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand" href="/">
        <div class="sidebar-brand-icon">
            <img src="/img/logo JKR.png" style="width: 100%; height: 90px">
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard <sup>JKR|EMAL</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-list"></i>
            <span>Dashboard</span></a>
    </li>




    @if(Auth::user()->roles->first()->name == "superadmin")


    <!-- Heading -->
    <div class="sidebar-heading">
        Permohonan
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/approval">
                <i class="fas fa-history"></i>
                <span>Menunggu Kelulusan</span></a>
        </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengguna
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/adminList">
                <i class="fas fa-user-plus"></i>
                <span>Urus Kakitangan </span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/approvedUser">
                <i class="fas fa-users"></i>
                <span>Pengguna Diluluskan</span></a>
        </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Bahan/Barang
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/view_material">
                <i class="fas fa-stream"></i>
                <span>List Barang Berdaftar</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/view_category">
                <i class="fas fa-plus-square"></i>
                <span>Tambah Kategori</span></a>
        </li>

    @endif

    @if(Auth::user()->roles->first()->name == "admin")
    <!-- Heading -->
    <div class="sidebar-heading">
        Pengguna
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/approvedUser">
                <i class="fas fa-users"></i>
                <span>Pengguna Diterima</span></a>
        </li>

        <!-- Heading -->
    <div class="sidebar-heading">
        Permohonan
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/approval">
                <i class="fas fa-history"></i>
                <span>Menunggu Kelulusan</span></a>
        </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Bahan/Barang
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/view_material">
                <i class="fas fa-stream"></i>
                <span>List Barang Berdaftar</span></a>
        </li>
    @endif

    @if(Auth::user()->roles->first()->name == "staff")
    <!-- Heading -->
    <div class="sidebar-heading">
        Pengguna
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/approvedUser">
                <i class="fas fa-users"></i>
                <span>Pengguna Diterima </span></a>
        </li>

        <!-- Heading -->
    <div class="sidebar-heading">
        Permohonan
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/pending">
                <i class="fas fa-file-alt"></i>
                <span>List Permohonan Baru</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/approval">
                <i class="fas fa-history"></i>
                <span>Menunggu Semakan </span></a>
        </li>
    @endif

    {{-- @if(Auth::user()->roles->first()->name == "staff")
    <li class="nav-item active">
        <a class="nav-link" href="/pending">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>
                @if (Auth::user()->roles->first()->name == "admin")
                Pending Approval
                @elseif (Auth::user()->roles->first()->name == "staff")
                List Permohonan
                @endif
            </span></a>
    </li>
    @endif

    @if(Auth::user()->roles->first()->name == "admin" || Auth::user()->roles->first()->name == "staff")
    <li class="nav-item active">
        <a class="nav-link" href="/approval">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>
                @if (Auth::user()->roles->first()->name == "admin")
                Pending Approval
                @elseif (Auth::user()->roles->first()->name == "staff")
                Pending Semakan
                @endif
            </span></a>
    </li>
    @endif--}}

    @if(Auth::user()->statusSemakan == "approve")
    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

        <li class="nav-item active">
            <a class="nav-link" href="/material_registration">
                <i class="fas fa-plus-square"></i>
                <span>Pendaftaran Bahan</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/view_material">
                <i class="fas fa-stream"></i>
                <span>List barang berdaftar</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Sidebar Toggler (Sidebar)
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->


</ul>
<!-- End of Sidebar -->
