@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="/">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1221 1222"  height="28">
                    <title>ci-svg</title>
                    <defs>
                        <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                            <path d="m-1439.64-4917.85h21984.31v31054.64h-21984.31z"/>
                        </clipPath>
                    </defs>
                    <style>
                        .s0 { fill: #790008 }
                        .s1 { fill: #790008 }
                        .s2 { fill: #790008 }
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
                        <img class="img-fluid" src="{{asset('images/pages/register-v2-dark.svg')}}" alt="Register V2" />
                    @else
                        <img class="img-fluid" src="{{asset('images/pages/register-v2.svg')}}" alt="Register V2" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- Register-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Adventure starts here 🚀</h2>
                    <p class="card-text mb-2">Make your app management easy and fun!</p>
                    <form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="-username">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" id="name" name="name" placeholder="name" aria-describedby="register-username" required autocomplete="name"  autofocus="" tabindex="1" />
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" type="text" name="email" placeholder="username@example.com" required autocomplete="email" aria-describedby="register-email" tabindex="2" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="email">Tenant Name</label>
                            <input class="form-control @error('tenant') is-invalid @enderror" id="tenant" type="text" name="tenant"value="{{ old('tenant') }}" placeholder="Tenant Name" required tabindex="2" />
                            @error('tenant')
                            <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="············" required aria-describedby="register-password" tabindex="3" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="password-confirm">Confirm Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password-confirm" type="password" name="password_confirmation" placeholder="············" required aria-describedby="register-password" tabindex="4" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" id="register-privacy-policy"required  name="register-privacy-policy" type="checkbox" tabindex="5" />
                                <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy & terms</a></label>
                                <div class="invalid-feedback">You must agree before submitting.</div>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="5">Sign up</button>
                    </form>
                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}"><span>&nbsp;Sign in instead</span></a>
                    </p>
{{--                    <div class="divider my-2">--}}
{{--                        <div class="divider-text">or</div>--}}
{{--                    </div>--}}
{{--                    <div class="auth-footer-btn d-flex justify-content-center">--}}
{{--                        <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>--}}
{{--                        <a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a>--}}
{{--                        <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>--}}
{{--                        <a class="btn btn-github" href="#"><i data-feather="github"></i></a>--}}
{{--                    </div>--}}
                </div>
            </div>
            <!-- /Register-->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
@endsection
