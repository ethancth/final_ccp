
@extends('layouts/contentLayoutMaster')

@section('title', 'Datastores')

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
                      <h4 class="card-title">Datastore Info</h4>
                  </div>
                  <div class="card-content">
                      <div class="card-body card-dashboard">
                          <div class="table-responsive">
                              <table class="table zero-configuration">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Capacity Usage</th>
                                          <th>Type</th>
                                          <th>Status</th>
                                          <th>Cost Profile</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                  <?php
                                  function displaystorage($a){
                                      if($a>1024){
                                          return $capacity=number_format(($a/1024),2, '.', ',').' TB';
                                      }else{
                                          return $capacity=$a.' GB';
                                      }
                                  }
                                  ?>
                                      @foreach ($dss as $ds)
                                        @if($ds->ds_overall_status =='green')
                                          <?php
                                          $color = "success";
                                          $text="";
                                          ?>
                                        @else
                                            <?php $color = "danger";  $text="";?>
                                        @endif



                                        <tr>

{{--                                          <td>{{ $ds->id }}</td>--}}
                                          @if($ds->ds_accessible=='true')
                                            <td>{{ $ds->ds_name }}</td>
                                            @else
                                            <td>{{ $ds->ds_name }} (inaccessible)</td>
                                            @endif


                                          <td>{{ displaystorage($ds->ds_capacity-$ds->ds_freespace)}} / {{ displaystorage($ds->ds_capacity) }} </td>
                                          <td>{{ $ds->ds_type }}</td>


{{--                                          <td>{{ $ds->vm_cpu }}<p> {{  (intval(str_replace(' MB', ' ', $ds->vm_men)))/1024 }}GB </td>--}}
{{--                                          @if ( number_format($ds->storage_usage, 2, '.', ',')>1000)--}}
{{--                                            <td>{{  number_format($ds->storage_usage, 2, '.', ',')}} TB</td>--}}
{{--                                            @else--}}
{{--                                            <td>{{  number_format($ds->storage_usage, 2, '.', ',')}} GB</td>--}}
{{--                                          @endif--}}


                                          <td>
                                            <div class="chip chip-{{$color}}">
                                              <div class="chip-body">
                                                <div class="chip-text"></div>
                                              </div>
                                            </div>
                                          </td>
                                          <td>
                                            <span>
                                                  <a href="{{ route('datastore.edit', $ds->id) }}">
                                                    {{ $ds->costprofile->name }}
                                                  </a>
                                                </span></td>
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

<?php


?>

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
