

@extends('layouts/contentLayoutMaster')

@section('title', 'Datastore Cost Profile')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
@endsection

@section('content')

  <!-- Column selectors with Export Options and print table -->
  <section id="column-selectors">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">

          </div>

          <div class="card-content">
            <div class="card-body card-dashboard">
              <a href={{ route('datastore-cost-profile.create') }} class="btn btn-primary mb-2">
                <i class="feather icon-plus"></i>&nbsp; Add new profile
              </a>
              <div class="table-responsive">
                <table class="table zero-configuration">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Profile Name</th>
                    <th>vStorage Cost</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  {{--//@todo: user list form action and verify--}}
                  @foreach ($costprofiles as $value)
                    <tr>
                      <td> {{ $value->id}}</td>
                      <td> {{ $value->name}}</td>
                      <td> {{ $value->vstorage}} {{ $value->vstorage_unit}} vStorage : RM {{$value->vstorage_price}}</td>
                      <td> <span>
                                                  <a href="{{ route('datastore-cost-profile.edit', $value->id) }}">
                                                    <i class="users-edit-icon feather icon-edit-1 mr-50"></i>
                                                  </a>
                                                </span>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>

                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Column selectors with Export Options and print table -->
@endsection
@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/datatables/datatable.js')) }}"></script>
@endsection
