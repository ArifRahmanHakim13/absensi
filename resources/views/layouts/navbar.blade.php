<nav class="main-header navbar navbar-expand navbar-white navbar-light sen tracking-tight">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
          <p class="mb-0 mt-2 fw-bold d-xs-none" id="navTitle">{{ config('app.name') }}</p>
      </li>

      <li class="nav-item">

      </li>
  </ul>

  <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <div id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-xs-none p-2 fw-bold mt-1" id="userName">{{ Auth::user()->name }}</span>
            <span class="d-sm-none p-1 fw-bold mt-1" id="userNameShort">{{ \Illuminate\Support\Str::before(Auth::user()->name, ' ') }}</span>
            <img src="/img/fotoprofil/{{ Auth::user()->foto }}" style="width: 35px; height: 35px; object-fit: cover;" class="img-circle elevation-1" alt="{{ Auth::user()->name }}" id="userImage">
        </div>

          <ul class="dropdown-menu dropdown-menu-right">
              <li>
                  <a href="{{ route('profil.index') }}" class="dropdown-item">Profil</a>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
              <li>
                  <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-logout">Logout</button>
              </li>
          </ul>
      </li>

  </ul>

</nav>
