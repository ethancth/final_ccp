
    <!DOCTYPE html>
@php $configData = Helper::applClasses(); @endphp

<html class="loading {{ $configData['theme'] === 'light' ? '' : $configData['layoutTheme'] }}"
      lang="@if (session()->has('locale')){{ session()->get('locale') }}@else{{ $configData['defaultLanguage'] }}@endif" data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
      @if ($configData['theme'] === 'dark') data-layout="dark-layout"@endif>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Cloudex</title>


    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />



    @php $configData = Helper::applClasses(); @endphp



</head>

<div>

</div>

<div
    class="vertical-layout vertical-menu-modern {{ $configData['bodyClass'] }} {{ $configData['theme'] === 'dark' ? 'dark-layout' : '' }} {{ $configData['blankPageClass'] }} blank-page"
    data-menu="vertical-menu-modern" data-col="blank-page" data-framework="laravel"
    data-asset-path="{{ asset('/') }}">

<!-- BEGIN: Content-->
<div class="app-content content {{ $configData['pageClass'] }}">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        <div class="content-body">

            {{-- Include Startkit Content --}}
            @yield('content')

        </div>
    </div>
</div>
<!-- End: Content-->

</div>

</html>
