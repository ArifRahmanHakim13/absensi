<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link">
    <img src="/img/{{ $sekolah->logo }}" alt="{{ config('app.name') }}"
          class="brand-image img-circle elevation-3" style="opacity: .8" style="width: 50px">
      <span class="brand-text font-weight-light d-xs-none text-uppercase">{{ Auth::user()->role }}</span>
      <span class="brand-text font-weight-light d-sm-none">{{ config('app.name') }}
      </span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
          data-accordion="false">

          <li class="nav-item mt-1">
              <a href="{{ '/dashboard' }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Dashboard
                  </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="/absensi/staf" class="nav-link {{ Request::is('absensi/staf*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>Absen</p>
              </a>
          </li>

          <li class="nav-item mb-3">
              <a href="/profil" class="nav-link {{ Request::is('profil*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Profil Saya</p>
              </a>
          </li>

      </ul>
    </nav>
  </div>
</aside>
