@php
$configData = Helper::applClasses();
@endphp
{{-- Horizontal Menu --}}
<div class="horizontal-menu-wrapper">
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal
  {{$configData['horizontalMenuClass']}}
  {{($configData['theme'] === 'dark') ? 'navbar-dark' : 'navbar-light' }}
  navbar-shadow menu-border
  {{ ($configData['layoutWidth'] === 'boxed' && $configData['horizontalMenuType']  === 'navbar-floating') ? 'container-xxl' : '' }}"
  role="navigation"
  data-menu="menu-wrapper"
  data-menu-type="floating-nav">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item me-auto">
          <a class="navbar-brand" href="{{url('/')}}">
            <span class="brand-logo">
              <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1221 1222"  height="24">
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
            <h2 class="brand-text mb-0">{{env('APP_NAME')}}</h2>
          </a>
        </li>
        <li class="nav-item nav-toggle">
          <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
            <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
        @if(isset($menuData[1]))
        @foreach($menuData[1]->menu as $menu)
        @php
        $custom_classes = "";
        if(isset($menu->classlist)) {
        $custom_classes = $menu->classlist;
        }
        @endphp
        <li class="nav-item @if(isset($menu->submenu)){{'dropdown'}}@endif {{ $custom_classes }} {{ Route::currentRouteName() === $menu->slug ? 'active' : ''}}"
         @if(isset($menu->submenu)){{'data-menu=dropdown'}}@endif>
          <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="nav-link d-flex align-items-center @if(isset($menu->submenu)){{'dropdown-toggle'}}@endif" target="{{isset($menu->newTab) ? '_blank':'_self'}}"  @if(isset($menu->submenu)){{'data-bs-toggle=dropdown'}}@endif>
            <i data-feather="{{ $menu->icon }}"></i>
            <span>{{ __('locale.'.$menu->name) }}</span>
          </a>
          @if(isset($menu->submenu))
          @include('panels/horizontalSubmenu', ['menu' => $menu->submenu])
          @endif
        </li>
        @endforeach
        @endif
        {{-- Foreach menu item ends --}}
      </ul>
    </div>
  </div>
</div>
