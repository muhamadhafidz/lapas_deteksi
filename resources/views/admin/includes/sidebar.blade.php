<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('login') }}" class="brand-link text-center font-weight-bold">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-normal">Deteksi Dini</span>
      <br>
      {{ Auth::user()->roles == 'admin' ? 'Admin' : 'Bendahara' }}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="mt-3 pb-3 mb-3 d-flex">
      </div>
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Cari Halaman" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw nav-icon"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          {{-- <li class="nav-item  {{ Request::is('admin/dashboard*') ? 'menu-open' : '' }}">
            
            <a class="nav-link" href="">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> --}}
          @if (Auth::user()->roles == 'user')
          <li class="nav-item">
            <a href="{{ route('user.laporan-user.index') }}" class="nav-link {{ Request::is('user.laporan-user*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Laporan User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user.input-deteksi-dini.index') }}" class="nav-link {{ Request::is('user.input-deteksi-dini*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Input Deteksi Dini</p>
            </a>
          </li>
          @endif
          @if (Auth::user()->roles == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.peta-kerawanan.index') }}" class="nav-link {{ Request::is('peta-kerawanan*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Peta Kerawanan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.laporan-deteksi.index') }}" class="nav-link {{ Request::is('laporan-deteksi*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Laporan Deteksi Dini</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.master-instrument.index') }}" class="nav-link {{ Request::is('master-instrument*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Master Instrument</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.data-upt.index') }}" class="nav-link {{ Request::is('data-upt*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Data UPT</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.data-user.index') }}" class="nav-link {{ Request::is('data-user*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Data User</p>
            </a>
          </li>
          @endif

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>