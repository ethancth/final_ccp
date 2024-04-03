<div class="content-header row">
  <div class="content-header-left col-md-9 col-12 mb-0">
    <div class="row breadcrumbs-top">
      <div class="col-12">
        <h2 class="content-header-title float-start mb-0">@yield('title')</h2>

      </div>
    </div>
  </div>
    @if(@isset($isprojectdropdown))
  <div class="content-header-right text-md-end mb-0 col-md-3 col-12 d-md-block d-none">
    <div class="mb-0 breadcrumb-right">
      <div class="dropdown">
        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="grid"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ProjectActivityModal">
            <i class="me-1" data-feather="compass"></i>
            <span class="align-middle">Project Journey</span>
          </a>
        </div>
      </div>
    </div>
  </div>
    @endif
</div>
<div class="breadcrumb-wrapper">
    @if(@isset($breadcrumbs))
        <ol class="breadcrumb">
            {{-- this will load breadcrumbs dynamically from controller --}}
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item">
                    @if(isset($breadcrumb['link']))
                        <a href="{{ $breadcrumb['link'] == 'javascript:void(0)' ? $breadcrumb['link']:url($breadcrumb['link']) }}">
                            @endif
                            {{$breadcrumb['name']}}
                            @if(isset($breadcrumb['link']))
                        </a>
                    @endif
                </li>
            @endforeach
        </ol>
    @endisset
</div>
