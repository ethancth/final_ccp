
@extends('layouts.contentLayoutMaster')

@section('title', 'Project -- '.$project->title)

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

            <a class="dropdown-item" href="#"><i class="feather icon-corner-down-right"></i>Submit</a>
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
          <th>ENVIRONMENT</th>
          <th>HOSTNAME</th>
          <th>OPERATING SYSTEM</th>
          <th>COMPUTE</th>
          <th>vSTORAGE(GB)</th>
          <th>ACTION</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($vms as $vm)
          @if($vm["status"] == '1')
            <?php $color = "success" ?>
            <?php $status_code = "success" ?>
          @elseif($vm["status"] == '2')
            <?php $color = "primary" ?>
          @elseif($vm["status"] == '3')
            <?php $color = "warning" ?>
          @elseif($vm["status"] == '4')
            <?php $color = "danger" ?>
          @elseif($vm["status"] == '5')
            <?php $color = "danger" ?>
          @else
            <?php $color = "danger" ?>
          @endif

          <?php $color = "success" ?>
          <?php
          $arr = array('success', 'primary', 'info', 'warning', 'danger');
          ?>

          <tr>
            <td></td>
            <td>
              <div class="chip chip-{{$color}}">
                <div class="chip-body">
                  <div class="chip-text">{{ $vm["environment"]}}</div>
                </div>
              </div>
            </td>
            <td class="product-name">{{ $vm["hostname"] }}</td>


            <td class="product-price">{{ $vm["operating_system"] }}</td>
            <td class="product-price">{{ $vm["v_cpu"] }} vCPU | {{$vm["v_memory"] }} GB MEM</td>
            <td class="product-price">{{ $vm["total_storage"] }}</td>



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
        <form action="{{ route('projectvm.store') }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
              <h4 class="text-uppercase">New Server</h4>
            </div>
            <div class="hide-data-sidebar">
              <i class="feather icon-x"></i>
            </div>
          </div>
          <div class="data-items pb-3">
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Server Hostname</label>
                  <input type="text" class="form-control" name="hostname" id="data-name" placeholder="Server HostName"  data-validation-required-message="This HostName field is required"
                         minlength="3">
                  <input type="hidden" class="form-control" value="{{$project->id}}" name="project_id" id="data-project_id">
                </div>
              </div>
            </div>

            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Environment</label>
                  <select class="form-control" name="environment" id="data-environment">
                    <option selected value="Production">Production</option>
                    <option value="Development">Development</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Tier</label>
                  <select class="form-control" name="tier" id="data-tier">
                    <option selected value="WEB">Web</option>
                    <option value="APP">App</option>
                    <option value="DB">DB</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Operating System</label>
                  <select class="form-control" name="operating_system" id="data-operating_system">
                    <option>Centos 6.10</option>
                    <option>Centos 7.7</option>
                    <option>Windows Server 2012 </option>
                    <option>Windows Server 2016 </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">vCPU</label>
                  <select class="form-control" name="v_cpu" id="data-cpu">
                    <option>1</option>
                    <option>2</option>
                    <option>4</option>
                    <option>6</option>
                    <option>8</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">vMemory</label>
                  <select class="form-control" name="v_memory" id="data-memory">
                    <option>1</option>
                    <option>2</option>
                    <option>4</option>
                    <option>6</option>
                    <option>8</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">Storage</label>
                  <input type="number" class="form-control" value="100" name="total_storage" id="data-total_storage">
                </div>
              </div>
            </div>


            <div class="add-data-footer d-flex justify-content-around px-1 mt-2">
              <div class="add-data-btn">
                <input type="submit" class="btn btn-primary" value="Create Server">
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
