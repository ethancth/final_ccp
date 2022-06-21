
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
                                          <th>Virtual Machine</th>
                                          <th>Cluster</th>
                                          <th>Resources</th>
                                          <th>Storage</th>
                                          <th>Power Status</th>
                                          <th>Cost</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($vms as $vm)
                                        @if($vm->vm_cpu !=NULL)
                                        @if($vm->power_status =='poweredOn')

                                          <?php
                                          $color = "success";
                                          $vm_status="Power On";
                                          $_vmmem='';
                                          //$_vmmem=(intval(str_replace(' MB', ' ', $vm->vm_men)))/1024 ;
                                          $_vmmem=str_replace(' MB', ' ', $vm->vm_men) ;

                                          //$_vmen_price=$_vmmem;
                                        //  $_vcpu_price=($vm->cluster->costprofile->vcpu_price);


                                          ?>
                                        @else
                                            <?php $color = "danger";$vm_status="Power Off";?>
                                        @endif
                                        <tr>

{{--                                          <td>{{ $vm->id }}</td>--}}
                                          <td>{{ $vm->vm_name }}</td>
                                          <td>{{ $vm->cluster->name }}</td>
                                          <td>{{ $vm->vm_cpu }}<p> {{  (intval(str_replace(' MB', ' ', $vm->vm_men)))/1024 }}GB </td>
                                          @if ( number_format($vm->storage_usage, 2, '.', ',')>1000)
                                            <td>{{  number_format($vm->storage_usage, 2, '.', ',')}} TB</td>
                                            @else
                                            <td>{{  number_format($vm->storage_usage, 2, '.', ',')}} GB</td>
                                          @endif


                                          <td>
                                            <div class="chip chip-{{$color}}">
                                              <div class="chip-body">
                                                <div class="chip-text">{{ $vm_status}}</div>
                                              </div>
                                            </div>
                                          </td>
                                          <td>{{env('UNIT_COSTdashboard-ecommerce')}} {{ $vm->f_vm_cost }}</td>
                                           </tr>
                                        @endif

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
