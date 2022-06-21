
@extends('layouts.contentLayoutMaster')

@section('title', 'Project')

@section('vendor-style')
  {{-- vendor files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}">
@endsection

@section('content')
  {{-- Data list view starts --}}
  <section id="data-list-view" class="data-list-view-header">
    <div class="action-btns d-none">
      <div class="btn-dropdown mr-1 mb-1">
        <div class="btn-group dropdown actions-dropodown">
          <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
          </div>
        </div>
      </div>
    </div>

    {{-- DataTable starts --}}
    <div class="table-responsive">
      <table class="table data-list-view">
        <thead>
        <tr>
          <th></th>
          <th>PROJECT NAME</th>
          <th>CREATED AT</th>
          <th>STATUS</th>
          <th>ACTION</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($projects as $project)
          @if($project["status"] == '1')
            <?php $color = "warning" ?>
            <?php $status_code = "DRAFT" ?>
          @elseif($project["status"] == '2')
            <?php $color = "primary" ?>
            <?php $status_code = "PENDING" ?>
          @elseif($project["status"] == '3')
            <?php $color = "primary" ?>
            <?php $status_code = "PENDING" ?>
          @elseif($project["status"] == '4')
            <?php $color = "info" ?>
            <?php $status_code = "IN-PROGRESS" ?>
          @elseif($project["status"] == '5')
            <?php $color = "success" ?>
            <?php $status_code = "COMPLETE" ?>
          @else
            <?php $color = "danger" ?>
            <?php $status_code = "NA" ?>
          @endif


          <?php
          $arr = array('success', 'primary', 'info', 'warning', 'danger');
          ?>

          <tr>
            <td></td>
            <td class="product-name"><a href="{{route('project.info',$project->id)}}">{{ $project["title"] }}</a></td>
            <td class="product-category">{{ $project->created_at->diffForHumans() }}</td>
            <td>
              <div class="chip chip-{{$color}}">
                <div class="chip-body">
                  <div class="chip-text">{{ $status_code}}</div>
                </div>
              </div>
            </td>

            <td class="product-action">
              <span class="action-edit"><i class="feather icon-edit"></i></span>
              <span class="action-delete"><i class="feather icon-trash"></i></span>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    {{-- DataTable ends --}}

    {{-- add new sidebar starts --}}
    <div class="add-new-data-sidebar">
      <div class="overlay-bg"></div>
      <div class="add-new-data">
        <form action="{{ route('project.store') }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
              <h4 class="text-uppercase">New Project</h4>
            </div>
            <div class="hide-data-sidebar">
              <i class="feather icon-x"></i>
            </div>
          </div>
          <div class="data-items pb-3">
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Project Name</label>
                  <input type="text" class="form-control" name="title" id="data-name">
                </div>
              </div>
            </div>
            <div class="add-data-footer d-flex justify-content-around px-1 mt-2">
              <div class="add-data-btn">
                <input type="submit" class="btn btn-primary" value="Create Project">
              </div>
              <div class="cancel-data-btn">
                <input type="reset" class="btn btn-outline-danger" value="Cancel">
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
    {{-- add new sidebar ends --}}
  </section>
  {{-- Data list view end --}}
@endsection
@section('vendor-script')
  {{-- vendor js files --}}
  <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/ui/data-list-view.js')) }}"></script>
@endsection
