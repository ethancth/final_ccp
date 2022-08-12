{{-- For submenu --}}
<ul class="menu-content">
  @if (isset($menu))
    @foreach ($menu as $submenu)
{{--      <li @if ($submenu->slug === Route::currentRouteName()) @endif>--}}
            <li class="{{ (request()->is($submenu->url)) ? 'active' : '' }}">
        <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}" class="d-flex align-items-center"
          target="{{ isset($submenu->newTab) && $submenu->newTab === true ? '_blank' : '_self' }}">
          @if (isset($submenu->icon))
            <i data-feather="{{ $submenu->icon }}"></i>
          @endif
          <span class="menu-item text-truncate">{{ __('locale.' . $submenu->name) }}</span>
        </a>
        @if (isset($submenu->submenu))
          @include('panels/submenu', ['menu' => $submenu->submenu])
        @endif
      </li>
    @endforeach
  @endif
</ul>

{{--<ul class="menu-content">--}}
{{--    @foreach($menu as $submenu)--}}
{{--        <?php--}}
{{--        $submenuTranslation = "";--}}
{{--        if(isset($menu->i18n)){--}}
{{--            $submenuTranslation = $menu->i18n;--}}
{{--        }--}}
{{--        ?>--}}
{{--        <li class="{{ (request()->is($submenu->url)) ? 'active' : '' }}">--}}
{{--            @if($submenu->url==null)--}}
{{--                <a href="{{ $submenu->url }}">--}}
{{--                    @else--}}
{{--                        <a href="{{ route($submenu->url) }}">--}}
{{--                            @endif--}}


{{--                            <i class="{{ isset($submenu->icon) ? $submenu->icon : "" }}"></i>--}}
{{--                            <span class="menu-title" data-i18n="{{ $submenuTranslation }}">{{ $submenu->name }}</span>--}}
{{--                        </a>--}}
{{--                @if (isset($submenu->submenu))--}}
{{--                    @include('panels/submenu', ['menu' => $submenu->submenu])--}}
{{--                @endif--}}
{{--        </li>--}}
{{--    @endforeach--}}
{{--</ul>--}}

