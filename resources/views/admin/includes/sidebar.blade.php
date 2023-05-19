<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('login') }}" class="brand-link text-center font-weight-bold">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-normal">Yayasan Yatim Al-Ihsan</span>
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
          
          <li class="nav-item  {{ Request::is('admin/dashboard*') ? 'menu-open' : '' }}">
            
            <a class="nav-link" href="">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if (Auth::user()->roles == 'user')
          <li class="nav-item">
            <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ Request::is('pengeluaran*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Pengeluaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pemasukan.index') }}" class="nav-link {{ Request::is('pemasukan*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Pemasukan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('data-donasi.index') }}" class="nav-link {{ Request::is('data-donasi*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Data Donasi</p>
            </a>
          </li>
          @endif
          @if (Auth::user()->roles == 'admin')
{{--           
          <li class="nav-item">
            <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ Request::is('pengeluaran*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Pengeluaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pemasukan.index') }}" class="nav-link {{ Request::is('pemasukan*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Pemasukan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('data-donasi.index') }}" class="nav-link {{ Request::is('data-donasi*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Data Donasi</p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ route('master-donatur.index') }}" class="nav-link {{ Request::is('donatur*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Donatur</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('master-pengurus.index') }}" class="nav-link {{ Request::is('pengurus*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Pengurus</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('master-anak-asuh.index') }}" class="nav-link {{ Request::is('anak-asuh*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Anak Asuh</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kegiatan.index') }}" class="nav-link {{ Request::is('kegiatan*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Kegiatan Yayasan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('profil-yayasan.index') }}" class="nav-link {{ Request::is('profil-yayasan*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Profil Yayasan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pengguna.index') }}" class="nav-link {{ Request::is('pengguna*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Pengguna</p>
            </a>
          </li>
          @endif

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>