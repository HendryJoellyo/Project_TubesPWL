<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('Gambar/logo_univ.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold">Kristen Maranatha</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('Gambar/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-open">
      <a href="{{ route('prodi.index') }}" class="nav-link {{ request()->routeIs('prodi.index') ? 'active' : '' }}">
      <p>Data Prodi</p>
    </a>
    <a href="{{ route('dosen.index') }}" class="nav-link {{ request()->routeIs('dosen.index') ? 'active' : '' }}">
      <p>Data Dosen</p>
    </a>
    <a href="{{ route('kaprodi.dashboard') }}" class="nav-link {{ request()->routeIs('kaprodi.dashboard') ? 'active' : '' }}">
      <p>Data Kaprodi</p>
    </a>
    
    <a href="{{ route('tata_usaha.index') }}" class="nav-link {{ request()->routeIs('tata_usaha.index') ? 'active' : '' }}">
      <p>Data Tata Usaha</p>
    </a>
    <a href="{{ route('manager.index') }}" class="nav-link {{ request()->routeIs('manager.index') ? 'active' : '' }}">
      <p>Data Manager Operasional</p>
    </a>
    <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.index') ? 'active' : '' }}">
      <p>Data Mahasiswa</p>
  </a>
  <a href="{{ route('surat.index') }}" class="nav-link {{ request()->routeIs('surat.index') ? 'active' : '' }}">
    <p>Surat</p>
</a>
  
    <!-- <a href="{{ route('prodi.index') }}" class="nav-link {{ request()->routeIs('prodi.index') ? 'active' : '' }}">
      <p>Data Tata Usaha</p>
    </a> -->

</li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>