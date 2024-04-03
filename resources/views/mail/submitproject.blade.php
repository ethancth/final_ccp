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
        </div>
    </section>


@endsection



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <div class="row py-5 my-5 mx-5 px-5">
        <h2>Send Mail</h2>
        <form action="{{route('sendmail')}}" class="form" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <input type="email" name="email" placeholder="email" class="form-control">
                </div>
                <div class="col-lg-6">
                    <input type="text" name="title" class="form-control" placeholder="title">
                </div>
                <div class="col-lg-12 pt-2">
                        <textarea name="content" placeholder="write..." class="form-control" cols="30"
                                  rows="10"></textarea>
                </div>
                <div class="col-lg-12 pt-2">
                    <button class="btn btn-primary" type="submit">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>

</html>
