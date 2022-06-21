
@extends('layouts/contentLayoutMaster')

@section('title', 'Virtual Machine')

@section('vendor-style')
        {{-- vendor css files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
@endsection

@section('content')
<div class="row">

  </div>
  <!-- Zero configuration table -->
  <section id="basic-datatable">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="card-title">Virtual Machine Info</h4>
                  </div>
                  <div class="card-content">
                      <div class="card-body card-dashboard">
                          <div class="table-responsive">
                              <table class="table zero-configuration">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Date</th>
                                          <th>Total of Virtual Machine</th>
                                          <th>CPU Cost</th>
                                          <th>Memory Cost</th>
                                          <th>Storage Cost </th>
                                          <th>Cost</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  @php
                                  $num=1;
                                  @endphp
                                      @foreach ($vms as $vm)
                                        <tr>

                                          <td>{{ $num++}}</td>
                                          <td>{{ $vm->date }}</td>
                                          <td>{{ $vm->total }}</td>

                                          <td>{{env('UNIT_COSTdashboard-ecommerce')}} {{ $vm->vm_cpu_cost }}</td>
                                          <td>{{env('UNIT_COSTdashboard-ecommerce')}} {{ $vm->vm_vmem_cost }}</td>
                                          <td>{{env('UNIT_COSTdashboard-ecommerce')}} {{ $vm->vm_vstorage_cost }}</td>
                                          <td>{{env('UNIT_COSTdashboard-ecommerce')}} {{ $vm->vm_cost }}</td>
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

  <!--/ Scroll - horizontal and vertical table -->
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
