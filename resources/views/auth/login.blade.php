@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">

@endsection

@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <a class="brand-logo" href="/">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1221 1222"  height="28">
                    <title>cisvg</title>
                    <defs>
                        <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                            <path d="m-1439.64-4917.85h21984.31v31054.64h-21984.31z"/>
                        </clipPath>
                    </defs>
                    <style>
                        .s0 { fill: #790008 }
                        .s1 { fill: #790008 }
                        .s2 { fill: #790008 }
                        /*.s2 { fill: #790008 }*/
                    </style>
                    <g id="Clip-Path: Page 1" clip-path="url(#cp1)">
                        <g id="Page 1">
                            <path id="Path 293" class="s0" d="m0.1 0.4h1220.2v1220.8h-1220.2z"/>
                            <path id="Path 294" class="s1" d="m1100.3 610.8h-647.9l-288-379.9h649.8z"/>
                            <path id="Path 295" class="s2" d="m814.2 990.6h-649.8l288-379.8h647.9z"/>
                        </g>
                    </g>
                </svg>
                <h2 class="brand-text text-primary ms-1">{{env('APP_NAME')}}</h2>
            </a>

            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                    @if($configData['theme'] === 'dark')
                        <img class="img-fluid" src="{{asset('images/pages/login-v2-dark.svg')}}" alt="Login V2" />
                    @else
                        <img class="img-fluid" src="{{asset('images/pages/login-v2.svg')}}" alt="Login V2" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- Login-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Welcome to {{env('APP_NAME')}} ! 👋</h2>
                    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                    <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="login-email">Email</label>
                            <input value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" />
                        </div>

                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('email') }}
                        </div>
                        @enderror

                        @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('password') }}
                        </div>
                        @enderror



                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{route('password.request')}}">
                                        <small>Forgot Password?</small>
                                    </a>
                                @endif
                            </div>
                            <div class="input-group input-group-merge form-password-toggle ">
                                <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" name="remember" id="remember"{{ old('remember') ? 'checked' : '' }} type="checkbox" tabindex="3" />
                                <label class="form-check-label" for="remember"> Remember Me</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                    </form>

                    <p class="text-center mt-2">
                        <span>New on our platform?</span>
                        <a href="{{ route('register' )}}"><span>&nbsp;Create an account</span></a>
                    </p>
                </div>
            </div>
            <!-- /Login-->
        </div>
    </div>

@endsection


@section('vendor-script')
    <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
@endsection
