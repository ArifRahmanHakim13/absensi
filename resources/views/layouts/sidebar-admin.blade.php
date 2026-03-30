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

          <li class="nav-header fw-bold mt-2">MASTER DATA</li>

          <li class="nav-item {{ Request::is('user*') |
                 Request::is('kapus*') |
                 Request::is('admin*') |
                 Request::is('staf*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('user*') |
                     Request::is('kapus*') |
                     Request::is('admin*') |
                     Request::is('staf*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    PENGGUNA
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('admin.index') }}" class="nav-link {{ Request::is('admin*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Admin</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('kapus.index') }}" class="nav-link {{ Request::is('kapus*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Kapus</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('staf.index') }}" class="nav-link {{ Request::is('staf*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Staf</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-item {{ Request::is('sekolah*') |
                 Request::is('tapel*') |
                 Request::is('libur*') |
                 Request::is('kelas*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('sekolah*') |
                     Request::is('tapel*') |
                     Request::is('libur*') |
                     Request::is('kelas*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    KELOLA DATA
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('sekolah.index') }}" class="nav-link {{ Request::is('sekolah*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Puskesmas</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('tapel.index') }}" class="nav-link {{ Request::is('tapel*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Tahun</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('libur.index') }}" class="nav-link {{ Request::is('libur*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Hari Libur</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-header fw-bold mt-2">ABSENSI</li>

          <li class="nav-item {{ Request::is('menu*') |
                 Request::is('rekapitulasi*') |
                 Request::is('absensi*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('menu*') |
                     Request::is('rekapitulasi*') |
                     Request::is('absensi*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    KELOLA ABSENSI
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('absensi.admin.index') }}" class="nav-link {{ Request::is('absensi/admin*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Absensi</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('rekapitulasi.index') }}" class="nav-link {{ Request::is('rekapitulasi*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Rekapitulasi Absensi</p>
                      </a>
                  </li>
              </ul>
          </li>


          <li class="nav-header mt-2 fw-bold">SAYA</li>

          <li class="nav-item mb-3">
              <a href="/profil" class="nav-link {{ Request::is('profil*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Profil</p>
              </a>
          </li>

      </ul>
    </nav>
  </div>
</aside>
