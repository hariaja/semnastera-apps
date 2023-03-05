<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="bg-header-dark">
    <div class="content-header bg-white-5">
      <!-- Logo -->
      <a class="fw-semibold text-white tracking-wide" href="index.html">
        <span class="smini-visible">
          D<span class="opacity-75">x</span>
        </span>
        <span class="smini-hidden">
          Semnas<span class="opacity-75">tera</span>
        </span>
      </a>
      <!-- END Logo -->

      <!-- Options -->
      <div>
        <!-- Toggle Sidebar Style -->
        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
          <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
        </button>
        <!-- END Toggle Sidebar Style -->

        <!-- Close Sidebar, Visible only on mobile screens -->
        <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close">
          <i class="fa fa-times-circle"></i>
        </button>
        <!-- END Close Sidebar -->
      </div>
      <!-- END Options -->
    </div>
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">
        
        <li class="nav-main-item">
          <a class="nav-main-link {{ Request::is('home*') ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="nav-main-link-icon fa fa-home"></i>
            <span class="nav-main-link-name">{{ trans('page.overview.title') }}</span>
          </a>
        </li>

        @if(userLogin()->hasAnyPermission(['registrations.index', 'transactions.index']) || userRole() == 'Administrator')
          <li class="nav-main-heading">{{ trans('Papper') }}</li>
          <li class="nav-main-item {{ Request::is('pappers*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('pappers*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-file"></i>
              <span class="nav-main-link-name">{{ trans('Papper') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('transactions.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('pappers/transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                  <span class="nav-main-link-name">{{ trans('Transaksi') }}</span>
                </a>
              </li>
              @endcan
              @can('journals.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('pappers/journals*') ? 'active' : '' }}" href="{{ route('journals.index') }}">
                  <span class="nav-main-link-name">{{ trans('Makalah') }}</span>
                </a>
              </li>
              @endcan
              @can('registrations.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('pappers/registrations*') ? 'active' : '' }}" href="{{ route('registrations.index') }}">
                  <span class="nav-main-link-name">{{ trans('Jadwal Submit') }}</span>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        @endif

        @if(userLogin()->hasAnyPermission(['roles.index', 'users.index']) || userRole() == 'Administrator')
          <li class="nav-main-heading">{{ trans('Management') }}</li>
          <li class="nav-main-item {{ Request::is('settings*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-cog"></i>
              <span class="nav-main-link-name">{{ trans('Settings') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('users.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('settings/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                  <span class="nav-main-link-name">{{ trans('Pengguna') }}</span>
                </a>
              </li>
              @endcan
              @can('roles.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('settings/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                  <span class="nav-main-link-name">{{ trans('Role & Permission') }}</span>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        @endif

      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>