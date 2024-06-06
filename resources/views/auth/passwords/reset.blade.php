@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Reset Password')

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
                    <title>ci-svg</title>
                    <defs>
                        <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                            <path d="m-1439.64-4917.85h21984.31v31054.64h-21984.31z"/>
                        </clipPath>
                    </defs>
                    <style>
                        .s0 { fill: #790008 }
                        .s1 { fill: #ffffff }
                        .s2 { fill: #ffffff }
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
                        <img src="{{asset('images/pages/reset-password-v2-dark.svg')}}" class="img-fluid" alt="Register V2" />
                    @else
                        <img src="{{asset('images/pages/reset-password-v2.svg')}}" class="img-fluid" alt="Register V2" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- Reset password-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Reset Password 🔒</h2>
{{--                    <p class="card-text mb-2">Your new password must be different from previously used passwords</p>--}}
                    <form method="POST" class="auth-reset-password-form" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" readonly autocomplete="email" autofocus>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="reset-password-new">New Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············"  autofocus="" tabindex="1" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password_confirmation" name="password_confirmation"  type="password" placeholder="············" tabindex="2" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="3">Set New Password</button>
                    </form>
                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}">
                            <i data-feather="chevron-left"></i> Back to login
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Reset password-->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script>



        $(function () {
            'use strict';

            var pageResetPasswordForm = $('.auth-reset-password-form');

            // jQuery Validation
            // --------------------------------------------------------------------
            if (pageResetPasswordForm.length) {
                pageResetPasswordForm.validate({
                    /*
                    * ? To enable validation onkeyup
                    onkeyup: function (element) {
                      $(element).valid();
                    },*/
                    /*
                    * ? To enable validation on focusout
                    onfocusout: function (element) {
                      $(element).valid();
                    }, */
                    rules: {
                        'password': {
                            required: true,
                            minlength:8,
                            maxlength:64
                        },
                        'password_confirmation': {
                            required: true,
                            minlength: 8,
                            equalTo: '#password'
                        }
                    },
                    messages: {
                        password: {
                            required: 'Enter new password',
                            minlength: 'Enter at least 8 characters'
                        },
                        password_confirmation: {
                            required: 'Please confirm new password',
                            minlength: 'Enter at least 8 characters',
                            equalTo: 'Password mismatch'
                        }
                    }
                });
            }
        });

    </script>
@endsection
