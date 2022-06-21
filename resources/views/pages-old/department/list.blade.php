

@extends('layouts/contentLayoutMaster')

@section('title', 'Department')

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
                      <h4 class="card-title">Department Management</h4>
                  </div>
                  <div class="card-content">
                      <div class="card-body card-dashboard">
                          <div class="table-responsive">
                              <table class="table zero-configuration">
                                  <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Department Name</th>
                                          <th>Head Of Department</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  {{--//@todo: user list form action and verify--}}
                                  @foreach ($departments as $department)
                                          <tr>
                                              <td> {{ $department->id}}</td>
                                              <td> {{ $department->department_name}}</td>
                                              <td> {{ $department->hod->name}}</td>
{{--                                              <td> {{ $user->department['department_name']}}</td>--}}
{{--                                              <td> {{ $user->disabled ? 'Yes':'No'}}</td>--}}
{{--                                              <td> {{ $user->email_verified_at}}</td>--}}
                                              <td> <span>
                                                  <a href="{{ route('department.edit', $department->id) }}">
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

  <script type="text/javascript">
      let users = {!! $departments !!}
      console.log(users);
  </script>
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
