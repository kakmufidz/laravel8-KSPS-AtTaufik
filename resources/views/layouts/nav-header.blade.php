 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li>
    <form class="form-inline" method="GET" action="/anggota">
      <div class="input-group input-group-sm">
        <input name="cari" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user user-menu open">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <img src="{{asset('')}}assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
        <span class="hidden-xs bg-primary">{{ Auth::user()->name }}</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="{{asset('')}}assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

          <p>
            {{ Auth::user()->name }}
            <small>Petugas Koperasi</small>
          </p>
        </li>
        <!-- Menu Footer-->
        <li class="card-footer">
          <div class="text-right">
            <a  href="{{ route('logout') }}" 
                onclick=" event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <button type="button" class="btn btn-danger btn-flat">Logout</button>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</nav>