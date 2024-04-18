@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Forgot Password')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="#">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1221 1222"  height="28">
                    <title>cimb-ar21-230322-1-pdf-svg</title>
                    <defs>
                        <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                            <path d="m-1439.64-4917.85h21984.31v31054.64h-21984.31z"/>
                        </clipPath>
                    </defs>
                    <style>
                        .s0 { fill: #790008 }
                        .s1 { fill: #ffffff }
                        .s2 { fill: #ed1d24 }
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
            <!-- /Brand logo-->

            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                    @if($configData['theme'] === 'dark')
                        <img class="img-fluid" src="{{asset('images/pages/forgot-password-v2-dark.svg')}}" alt="Forgot password V2" />
                    @else
                        <img class="img-fluid" src="{{asset('images/pages/forgot-password-v2.svg')}}" alt="Forgot password V2" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- Forgot password-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Forgot Password? 🔒</h2>
                    <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>
                    <form class="auth-forgot-password-form mt-2" action="{{route("password.email")}}" method="POST">
                        @csrf
                        <div class="mb-1">


                            <label class="form-label" for="forgot-password-email">Email</label>
                            <input class="form-control" id="forgot-password-email" type="email" name="email" placeholder="john@example.com" aria-describedby="forgot-password-email" required autofocus="" tabindex="1" />
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <button class="btn btn-primary w-100" tabindex="2">Send reset link</button>
                    </form>
                    <p class="text-center mt-2">
                        <a href="{{url('/login')}}">
                            <i data-feather="chevron-left"></i> Back to login
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Forgot password-->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('js/scripts/pages/auth-forgot-password.js'))}}"></script>
@endsection
