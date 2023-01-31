<div>
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
            {{-- <div class="sidebar-brand-icon">
                <img src="{{ asset('assets/ruangadmin') }}/img/logo/logo2.png">
            </div> --}}
            <div class="sidebar-brand-text mx-3">APLIKASI PENJUALAN</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- ----------------------- MENU KELOLA ----------------------- -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Menu Kelola
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm1"
                aria-expanded="true" aria-controls="collapseForm1">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Products</span>
            </a>
            <div id="collapseForm1" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Products</h6>
                    <a class="collapse-item" href="{{ route('admin-product-list') }}"><i class="fa fa-align-justify"></i>  Products List</a>
                    {{-- <a class="collapse-item" href="#">Tambah Mata Pelajaran</a> --}}
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                aria-expanded="true" aria-controls="collapseForm">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Transactions</span>
            </a>
            <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transactions</h6>
                    <a class="collapse-item" href="{{ route('admin-transaction-list') }}"><i class="fa fa-align-justify"></i> Transactions Detail</a>
                    {{-- <a class="collapse-item" href="#">Tambah Agenda</a> --}}
                </div>
            </div>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="ui-colors.html">
                <i class="fas fa-fw fa-palette"></i>
                <span>Laporan</span>
            </a>
        </li> --}}
        <!-- ----------------------- END MENU KELOLA ----------------------- -->

        <!-- ----------------------- KELOLA LAINNYA ----------------------- -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Menu Lainnya
        </div>
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                aria-expanded="true" aria-controls="collapsePage">
                <i class="fas fa-fw fa-columns"></i>
                <span>Kelola Pengguna</span>
            </a>
            <div id="collapsePage" class="collapse" aria-labelledby="headingPage"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Pengguna</h6>
                    <a class="collapse-item" href="#">
                        <i class="fa fa-address-book"></i>
                        Daftar Akun</a>
                </div>
            </div>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Pengaturan</span>
            </a>
        </li> --}}
        <!-- ----------------------- END KELOLA LAINNYA ----------------------- -->


        <hr class="sidebar-divider">
        {{-- <div class="version" id="version-ruangadmin"></div> --}}
    </ul>
</div>
