@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', __('Verify Your Email Address'))

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    @php
        $arr = explode('@', Auth::user()->email);
    $_getmail = $arr[1];

    if($_getmail=='outlook.com')
        {
            $_mailProtocal='outlook.com';
        }elseif($_getmail=='gmail.com'){
        $_mailProtocal=$_getmail;
        }else{
        $_mailProtocal='mail.'.$_getmail;
        }

    @endphp
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="/">
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
                        <img src="{{asset('images/illustration/verify-email-illustration-dark.svg')}}" class="img-fluid" alt="two steps verification" />
                    @else
                        <img src="{{asset('images/illustration/verify-email-illustration.svg')}}" class="img-fluid" alt="two steps verification" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- verify email cover-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">

                    <h2 class="card-title fw-bolder mb-1">Verify your email &#x2709;&#xFE0F;</h2>
                    <p class="card-text mb-2">Account activation link sent to your email address:<span class="fw-bolder">{{Auth::user()->email}}</span> Please follow the link inside to continue.</p>

                    <p class="text-center mt-2">  @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif<span>Didn&apos;t receive an email?</span>
                        <a href="Javascript:void(0)" onclick="document.getElementById('verification_resend').submit();"><span>&nbsp;Resend</span></a>

                    <form  method="POST" id='verification_resend' action="{{ route('verification.resend') }}">
                        @csrf
                    </form>

                    <form method="POST" action="{{route('logout')}}">
                        @csrf

                        <button type="submit" class="w-100 btn btn-danger">
                            Log Out
                        </button>
                    </form>
                    </p>
                </div>
            </div>
            <!-- verify email cover-->
        </div>
    </div>
@endsection
