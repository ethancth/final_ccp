@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
  <nav
    class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="{{ url('/') }}">
            <span class="brand-logo">
             <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1221 1222"  height="28">
                    <title>cimb-ar21-230322-1-pdf-svg</title>
                    <defs>
                        <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                            <path d="m-1439.64-4917.85h21984.31v31054.64h-21984.31z"/>
                        </clipPath>
                    </defs>
                    <style>
                        .s0 { fill: #790008 }
                        .s1 { fill: #ffffff }
                        .s2 { fill: #ed1d24 }
                    </style>
                    <g id="Clip-Path: Page 1" clip-path="url(#cp1)">
                        <g id="Page 1">
                            <path id="Path 293" class="s0" d="m0.1 0.4h1220.2v1220.8h-1220.2z"/>
                            <path id="Path 294" class="s1" d="m1100.3 610.8h-647.9l-288-379.9h649.8z"/>
                            <path id="Path 295" class="s2" d="m814.2 990.6h-649.8l288-379.8h647.9z"/>
                        </g>
                    </g>
                </svg>
            </span>
          </a>
        </li>
      </ul>
    </div>
  @else
    <nav
      class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating'? 'container-xxl': '' }}">
@endif
<div class="navbar-container d-flex content">
  <div class="bookmark-wrapper d-flex align-items-center">
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
            data-feather="menu"></i></a></li>
    </ul>

  </div>
  <ul class="nav navbar-nav align-items-center ms-auto">
    <li class="nav-item dropdown dropdown-language">
      <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
        <i class="flag-icon flag-icon-us"></i>
        <span class="selected-language">English</span>
      </a>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
        <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
          <i class="flag-icon flag-icon-us"></i> English
        </a>
      </div>
    </li>
      <li class="nav-item d-none d-lg-block"><a class="nav-link"><span class="user-name fw-bolder">You are in tenant  -
                  {{Auth::User()->tenant[0]['name'] }}
              </span></a></li>

      @livewire('home-theme')


    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
          data-feather="search"></i></a>
      <div class="search-input">
        <div class="search-input-icon"><i data-feather="search"></i></div>
        <input class="form-control input" type="text" placeholder="Search Project..." tabindex="-1" data-search="search">
        <div class="search-input-close"><i data-feather="x"></i></div>
        <ul class="search-list search-list-main"></ul>
      </div>
    </li>

    <li class="nav-item dropdown dropdown-notification me-25">
      <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
        <i class="ficon" data-feather="bell"></i>
{{--        <span class="badge rounded-pill bg-danger badge-up">5</span>--}}
      </a>
      <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
        <li class="dropdown-menu-header">
          <div class="dropdown-header d-flex">
            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
            <div class="badge rounded-pill badge-light-primary">0 New</div>
          </div>
        </li>
        <li class="dropdown-menu-footer">
          <a class="btn btn-primary w-100" href="javascript:void(0)">Read all notifications</a>
        </li>
      </ul>
    </li>

    <li class="nav-item dropdown dropdown-user">
      <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
        data-bs-toggle="dropdown" aria-haspopup="true">
        <div class="user-nav d-sm-flex d-none">
          <span class="user-name fw-bolder">
{{--              {{dd( Auth::viaRemember())}}--}}
            @if (Auth::check())

              {{ ucwords(Auth::user()->name ) }}
            @else

            @endif
          </span>
          <span class="user-status">
              {{Auth::user()->role_name}}
          </span>
        </div>
        <span class="avatar">
          <img class="round"
            src="{{ Auth::user() ? Auth::user()->avatar : asset('images/portrait/small/avatar-s-11.jpg') }}"
            alt="avatar" height="40" width="40">
          <span class="avatar-status-online"></span>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
        <h6 class="dropdown-header">Manage Profile</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item"
          href="{{ Route::has('tenants.profile') ? route('tenants.profile') : 'javascript:void(0)' }}">
          <i class="me-50" data-feather="user"></i> Profile
        </a>

          <form method="POST" id="tenant-form" action="{{ route('switch.tenants') }}">
              @csrf
              <input value="" name="tenant_id" id="tenant_id" class="hidden" >
          </form>

          @foreach(Auth::User()->tenant as $tenants)


                  @if(Auth::User()->company_id==$tenants->id)
                  <a class="dropdown-item"

                     href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0)' }}">
                      <i class="me-50" data-feather="type"></i>
                      {{$tenants->name}}
                      <i class="me-50 text-success" data-feather="check"></i>
                  </a>
                  @else
                      <a class="dropdown-item" data-id="{{$tenants->id}}" href="{{ route('switch.tenants') }}"
                         onclick="event.preventDefault();  $('#tenant_id').val($(this).data('id')); document.getElementById('tenant-form').submit();">
                          <i class="me-50" data-feather="type"></i>  {{$tenants->name}}
                      </a>




                  @endif
              @endforeach
         {{--


        @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
          <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
            <i class="me-50" data-feather="key"></i> API Tokens
          </a>
        @endif

        <a class="dropdown-item" href="#">
          <i class="me-50" data-feather="settings"></i> Settings
        </a>

        @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Manage Team</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item"
            href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
            <i class="me-50" data-feather="settings"></i> Team Settings
          </a>
          @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <a class="dropdown-item" href="{{ route('teams.create') }}">
              <i class="me-50" data-feather="users"></i> Create New Team
            </a>
          @endcan

          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">
            Switch Teams
          </h6>
          <div class="dropdown-divider"></div>
          @if (Auth::user())
            @foreach (Auth::user()->allTeams() as $team)
              {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}

              {{-- <x-jet-switchable-team :team="$team" /> --}}
          {{-- @endforeach
         @endif
       @endif
         --}}
        @if (Auth::check())
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="me-50" data-feather="power"></i> Logout
          </a>
          <form method="POST" id="logout-form" action="{{ route('logout') }}">
            @csrf
          </form>
        @else
          <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
            <i class="me-50" data-feather="log-in"></i> Login
          </a>
        @endif
      </div>
    </li>
  </ul>
</div>
</nav>

{{-- Search Start Here --}}
<ul class="main-search-list-defaultlist d-none">

</ul>

{{-- if main search not found! --}}
<ul class="main-search-list-defaultlist-other-list d-none">
  <li class="auto-suggestion justify-content-between">
    <a class="d-flex align-items-center justify-content-between w-100 py-50">
      <div class="d-flex justify-content-start">
        <span class="me-75" data-feather="alert-circle"></span>
        <span>No results found.</span>
      </div>
    </a>
  </li>
</ul>
{{-- Search Ends --}}
<!-- END: Header-->
