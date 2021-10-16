
  <!-- Main Sidebar Container -->
  @if ((Auth::user()->level) == 'superadmin')
    <aside class="main-sidebar sidebar-light-primary elevation-4">
  @else
    <aside class="main-sidebar sidebar-dark-primary elevation-4">  
  @endif
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('')}}assets/dist/img/logokoperasi.jpg" alt="KSPS At-Taufik" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">KSPS At-Taufik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('')}}assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} <i class="fa fa-circle text-success"></i></a>
        </div>
      </div>

      @if ((Auth::user()->level) == 'superadmin')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/admin" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-info"></i>
              <p>
                Daftar Admin
              </p>
            </a>
          </li>
        </ul>
      </nav>
      @endif
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-info"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy text-green"></i>
              <p>
                Anggota
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
              <ul class="ml-4 nav nav-treeview">
                <li class="nav-item">
                  <a href="/anggota" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>Daftar Anggota</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/anggota/tambah" class="nav-link">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>Tambah Anggota</p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie text-warning"></i>
              <p>
                Simpanan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="ml-4 nav nav-treeview">
              <li class="nav-item">
                <a href="/simpanan" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>History Simpanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/penarikan" class="nav-link">
                  <i class="nav-icon far fa-minus-square""></i>
                  <p>History Penarikan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree text-danger"></i>
              <p>
                Akad
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="ml-4 nav nav-treeview">
              <li class="nav-item">
                <a href="/akad/kredit" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Kredit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/akad/qordh" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Hutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/akad/mudorobah" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Mudorobah</p>
                </a>
              </li>                
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit text-blue"></i>
              <p>
                Angsuran
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="ml-4 nav nav-treeview">
              <li class="nav-item">
                <a href="/angsuran/kredit" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Angsuran Kredit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/angsuran/qordh" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Angsuran Hutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/angsuran/mudorobah" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Angsuran Mudorobah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/angsuran/mudorobah/keuntungan" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Keuntungan Mudorobah</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy text-green"></i>
              <p>
                Koperasi
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
              <ul class="ml-4 nav nav-treeview">
                <li class="nav-item">
                  <a href="/koperasi" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>Profile Koperasi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/koperasi/pengurus" class="nav-link">
                    <i class="nav-icon far fa-copy"></i>
                    <p>Pengurus Koperasi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/mdata" class="nav-link">
                    <i class="nav-icon far fa-copy"></i>
                    <p>Master Data</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/pemasukan/tambah" class="nav-link">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>Pemasukan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/pengeluaran/tambah" class="nav-link">
                    <i class="nav-icon far fa-minus-square"></i>
                    <p>Pengeluaran</p>
                  </a>
                </li>
              </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>