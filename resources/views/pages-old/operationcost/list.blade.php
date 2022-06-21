

@extends('layouts/contentLayoutMaster')

@section('title', 'Operation Cost Management')

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
              <a href="operating-expense/create" class="btn btn-primary mb-2">
                <i class="feather icon-plus"></i>&nbsp; Add new cost
              </a>
              <div class="table-responsive">
                <table class="table zero-configuration">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cost Name</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Department</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  {{--//@todo: user list form action and verify--}}
                  @foreach ($operationcosts as $operationcost)
                    <tr>
                      <td> {{ $operationcost->id}}</td>
                      <td> {{ $operationcost->name}}</td>
                      <td> {{ $operationcost->description}}</td>
                      <td> {{ $operationcost->cost}}</td>
                      <td> {{ $operationcost->department->department_name}}</td>
                      <td> <span>
                                                  <a href="{{ route('operating-expense.edit', $operationcost->id) }}">
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
