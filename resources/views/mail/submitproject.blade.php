@extends('layouts/mailfullLayoutMaster')

@section('title', 'mail')

@section('page-style')
    <link rel="stylesheet" href="{{asset(mix('css/base/pages/app-invoice-print.css'))}}">
@endsection

@section('content')


    <section class="section-py pricing-plans-comparison">

        <div class="container">
            <h2 class="text-center mb-2"></h2>
            </div>
        <div class="container">

        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="mb-2">Project Submitted!</h2>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1>{{$project->title}} </h1>
                        <hr class="mb-2" />
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text">Total - {{$project->server->count()}} Server</h6>

                                </div>

                                <div>
                                    <h6 class="text">Cost -  <span class="badge badge-light-success profile-badge">RM {{$project->price}}</span> </h6>

                                </div>
                            </div>

                        </div>

                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text">Tier -
                                        @foreach($project->server()->distinct()->get(['display_tier'])  as $_value)
                                            <span class="badge badge-light-success profile-badge">{{$_value->display_tier}}</span>
                                            </span>
                                        @endforeach
                                    </h6>
                                    <h6 class="text">Environment -   @foreach($project->server()->distinct()->get(['display_env'])  as $_value)
                                            <span class="badge badge-light-success profile-badge">{{$_value->display_env}}</span>
                                            </span>
                                        @endforeach

                                    </h6>

                                </div>
                                <div>
                                    <h6 class="text-muted fw-bolder">CPU</h6>
                                    <h3 class="mb-0">{{$project->server->sum('v_cpu')}} </h3>
                                </div>
                                <div>
                                    <h6 class="text-muted fw-bolder">Memory</h6>
                                    <h3 class="mb-0">{{$project->server->sum('v_memory')}} GB</h3>
                                </div>
                                <div>
                                    <h6 class="text-muted fw-bolder">Storage</h6>
                                    <h3 class="mb-0">{{$project->server->sum('total_storage')}} GB</h3>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

            <div class="row mx-4">
                <div class="col-12">
                    <div class="table-responsive border rounded">
                        <table class="table table-striped text-center mb-0">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <p class="mb-1">Server </p>

                                </th>
                                <th scope="col">
                                    <p class="mb-1">Compute</p>
                                </th>
                                <th scope="col">
                                    <p class="mb-1 position-relative">Environment
                                    </p>
                                </th><th scope="col">
                                    <p class="mb-1 position-relative">Tier
                                    </p>
                                </th>
                                <th scope="col">
                                    <p class="mb-1">Cost </p>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->server as $server)
                            <tr>
                                <td>{{$server->hostname}} - {{$server->display_os}} </td>
                                <td>{{$server->v_cpu}} vCPU<br/>
                                    {{$server->v_memory}} GB vMemory<br/>

                                    {{$server->total_storage}} GB Storage</td>
                                <td>{{$server->display_env}}</td>
                                <td>{{$server->display_tier}}</td>
                                <td>${{$server->price}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

