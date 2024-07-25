@php
  use App\Models\AclResource;

  if (!isset($menu_active)) {
      $menu_active = null;
  }
@endphp

<aside class="main-sidebar sidebar-light-primary elevation-4">
  <a class="brand-link" href="{{ url('admin/') }}">
    <img class="brand-image img-circle elevation-3" src="{{ url('dist/img/logo.png') }}" alt="App Logo" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ App\Models\Setting::value('company.name', 'SIAKAM') }}</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-flat nav-collapse-hide-child" data-widget="treeview"
        data-accordion="false" role="menu">
        <li class="nav-item">
          <a class="nav-link {{ $nav_active == 'dashboard' ? 'active' : '' }}" href="{{ url('admin/') }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- @if (Auth::user()->canAccess(AclResource::REPORT_MENU)) --}}
        <li class="nav-item {{ $menu_active == 'master' ? 'menu-open' : '' }}">
          <a class="nav-link {{ $menu_active == 'master' ? 'active' : '' }}" href="#">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a class="nav-link {{ $nav_active == 'student' ? 'active' : '' }}"
                href="{{ url('/admin/student') }}">
                <i class="nav-icon fas fa-children"></i>
                <p>Santri</p>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $nav_active == 'school-grade' ? 'active' : '' }}"
                  href="{{ url('/admin/school-grade') }}">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $nav_active == 'school-stage' ? 'active' : '' }}"
                  href="{{ url('/admin/school-stage') }}">
                  <i class="nav-icon fas fa-people-roof"></i>
                  <p>Marhalah</p>
                </a>
              </li>
          </ul>
        </li>
        {{-- @endif --}}

        {{-- Report Menu --}}
        {{-- @if (Auth::user()->canAccess(AclResource::REPORT_MENU))
          <li class="nav-item {{ $menu_active == 'report' ? 'menu-open' : '' }}">
            <a class="nav-link {{ $menu_active == 'report' ? 'active' : '' }}" href="/admin/report/">
              <i class="nav-icon fas fa-file-waveform"></i>
              <p>Laporan</p>
            </a>
          </li>
        @endif --}}
        {{-- End Report Menu --}}

        {{-- System Menu --}}
        @if (Auth::user()->canAccess(AclResource::SYSTEM_MENU))
          <li class="nav-item {{ $menu_active == 'system' ? 'menu-open' : '' }}">
            <a class="nav-link {{ $menu_active == 'system' ? 'active' : '' }}" href="#">
              <i class="nav-icon fas fa-gears"></i>
              <p>
                Sistem
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::user()->canAccess(AclResource::USER_ACTIVITY))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'user-activity' ? 'active' : '' }}"
                    href="{{ url('/admin/user-activity') }}">
                    <i class="nav-icon fas fa-file-waveform"></i>
                    <p>Log Aktivitas</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::USER_MANAGEMENT))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'user' ? 'active' : '' }}" href="{{ url('/admin/user') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Pengguna</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::SETTINGS))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'settings' ? 'active' : '' }}"
                    href="{{ url('/admin/settings') }}">
                    <i class="nav-icon fas fa-gear"></i>
                    <p>Pengaturan</p>
                  </a>
                </li>
              @endif
            </ul>
          </li>
        @endif
        {{-- End of System  menu --}}

        <li class="nav-item">
          <a class="nav-link {{ $nav_active == 'profile' ? 'active' : '' }}" href="{{ url('/admin/user/profile/') }}">
            <i class="nav-icon fas fa-user"></i>
            <p>{{ Auth::user()->username }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('auth.logout') }}">
            <i class="nav-icon fas fa-right-from-bracket"></i>
            <p>Keluar</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
