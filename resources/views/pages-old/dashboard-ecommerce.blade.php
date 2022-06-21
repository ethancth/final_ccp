
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Ecommerce')

@section('vendor-style')
        {{-- vendor css files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/pages/dashboard-ecommerce.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/pages/card-analytics.css')) }}">
@endsection

@section('content')
  {{-- Dashboard Ecommerce Starts --}}
  <section id="dashboard-ecommerce">
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">$ {{($daily_vm_cost[0]->vm_cost)}}</h2>
                    <p class="mb-0">Virtual Machine </p>
                </div>
                <div class="card-content">
                    <div id="line-area-chart-1"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-credit-card text-success font-medium-5"></i>
                        </div>
                    </div>
                  <h2 class="text-bold-700 mt-1">$ {{($daily_vm_cost[0]->vm_cpu_cost ?? 0)}}</h2>
                    <p class="mb-0">293 vCpu (6%)</p>
                </div>
                <div class="card-content">
                    <div id="line-area-chart-2"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                        </div>
                    </div>

                    <h2 class="text-bold-700 mt-1">$ {{($daily_vm_cost[0]->vm_vmem_cost ?? 0)}}</h2>
                    <p class="mb-0">1.2 TB vMemory (27%)</p>
                </div>
                <div class="card-content">
                    <div id="line-area-chart-3"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </div>
                    </div>

                    <h2 class="text-bold-700 mt-1">$ {{($daily_vm_cost[0]->vm_vstorage_cost ?? 0 )}}</h2>
                    <p class="mb-0">7.8 TB Storage (65%)</p>
                </div>
                <div class="card-content">
                    <div id="line-area-chart-4"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-lg-8 col-md-6 col-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-end">
                      <h4 class="card-title">Revenue</h4>
                      <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
                  </div>
                  <div class="card-content">
                      <div class="card-body pb-0">
                          <div class="d-flex justify-content-start">
                              <div class="mr-2">
                                  <p class="mb-50 text-bold-600">This Month</p>
                                  <h2 class="text-bold-400">
                                      <sup class="font-medium-1">$</sup>
                                      <span class="text-success">86,589</span>
                                  </h2>
                              </div>
                              <div>
                                  <p class="mb-50 text-bold-600">Last Month</p>
                                  <h2 class="text-bold-400">
                                      <sup class="font-medium-1">$</sup>
                                      <span>73,683</span>
                                  </h2>
                              </div>

                          </div>
                          <div id="revenue-chart"></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-end">
                      <h4 class="mb-0">VM Power Status</h4>
                      <p class="font-medium-5 mb-0"><i class="feather icon-help-circle text-muted cursor-pointer"></i></p>
                  </div>
                  <div class="card-content">
                      <div class="card-body px-0 pb-0">
                          <div id="goal-overview-chart" class="mt-75"></div>
                          <div class="row text-center mx-0">
                              <div class="col-6 border-top border-right d-flex align-items-between flex-column py-1">
                                  <p class="mb-50">Running</p>
                                  <p class="font-large-1 text-bold-700">{{$vmcount["total_vm_power_on"]}}</p>
                              </div>
                              <div class="col-6 border-top d-flex align-items-between flex-column py-1">
                                  <p class="mb-50">Off</p>
                                  <p class="font-large-1 text-bold-700">{{$vmcount["total_vm_power_off"]}}</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
              <h4 class="card-title">Department</h4>
               Latest
            </div>
            <div class="card-content">
              <div class="card-body py-0">
                <div id="customer-chart"></div>
              </div>
              <ul class="list-group list-group-flush customer-info">
<?php
                  $num=0;
                  $_data['department'][]='';
                  $_data['total_cost'][]='';
                  $_dataRevenue['cost_type'][]='';
                  $_dataRevenue['cost_amount'][]='';

                  function color($a)
                      {
                          if($a==1){
                              return "primary";
                          }elseif($a==2){
                              return "warning";
                          }elseif($a==3){
                              return "danger";
                          }elseif($a==4){
                              return "info";
                          }else{
                              return "success";
                          }
                      }
?>
                @foreach ($departments as $department)
                  <?php  $_temp_cost=0;?>

                  @foreach ($department->vm as $vms)
                          <?php
                          $_temp_cost= $_temp_cost+$vms->f_vm_cost;
                          ?>

                  @endforeach
                  <?php


                  $num++;
                   $_data['department'][$num]= $department->department_name;
                   $_data['total_cost'][$num]=$_temp_cost;
?>

                <li class="list-group-item d-flex justify-content-between ">
                  <div class="series-info">
                    <i class="fa fa-circle font-small-3 text-{{color($num)}}"></i>
                    <span class="text-bold-600">{{$department->department_name}}</span>
                  </div>
                  <div class="product-result">
                    <span>$ {{$_temp_cost}}</span>
                  </div>
                </li>
                @endforeach
                <?php
    //$_data['total_cost'].="]";
    //$_data['department'].="]"

                ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-12">
          <div class="card">
            <div class="card-header">
                <h4 class="card-title">Operation Cost</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <div id="bar-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">



      </div>
  </section>
<?php $_num=0;$_temp_total=0;?>
  @foreach($totalRevenue as $v)
  <?php
  $_temp_total=0;
  $_dataRevenue['cost_type'][$_num]=$v->name;
  $_dataRevenue['cost_amount'][$_num]=$v->total;
  $_num++;
  ?>
  @endforeach
  <script type="text/javascript">

      var vmcount = {!! json_encode($vmcount) !!};
      var vm_department = {!! json_encode($_data) !!};
      var cost_operation = {!! json_encode($_dataRevenue) !!};
      var daily_vm_cpu = {!!   json_encode($daily_vm_cost) !!};





  </script>



  {{-- Dashboard Ecommerce ends --}}
@endsection
@section('vendor-script')
{{-- vendor files --}}
        <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection
@section('page-script')
        {{-- Page js files --}}

        <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
@endsection

