@extends('layouts/contentLayoutMaster')

@section('title', 'User Profile - Control Panel')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection

@section('content')
    <section class="app-user-view-billing">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img
                                    class="img-fluid rounded mt-3 mb-2"
                                    src="{{ Auth::user() ? Auth::user()->avatar : asset('images/portrait/small/avatar-s-11.jpg') }}"
                                    height="110"
                                    width="110"
                                    alt="User avatar"
                                />
                                <div class="user-info text-center">
                                    <h4>{{Auth::user()->name}}</h4>
                                    <span class="badge bg-light-secondary">
                                        @if (Auth::user()->is_teamlead )
                                            Team Lead
                                        @else
                                            User
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Username:</span>
                                    <span>{{Auth::User()->name}}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Email:</span>
                                    <span>{{Auth::User()->email}}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Status:</span>
                                    <span class="badge bg-light-success">Active</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Role:</span>
                                    <span> @if (Auth::user()->is_teamlead )Team Lead @else User @endif</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>



            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="card">
                    <h4 class="card-header">Profile</h4>
                    <div class="card-body">
                        <form id="formChangePassword" method="POST" action="{{ route('change.user.password') }}">
                            <div class="alert alert-warning mb-2" role="alert">

                            </div>

                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="mb-2 col-md-6 form-password-toggle">
                                <label class="form-label" for="Username">Name</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="username"
                                        name="username"
                                        placeholder="Username"
                                        value="{{Auth::User()->name}}"
                                        maxlength="16"
                                        required
                                    />
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <h4 class="card-header">Password</h4>
                    <div class="card-body">
                        <form id="formChangePassword" method="POST" action="{{ route('change.user.password') }}">
                            <div class="alert alert-warning mb-2" role="alert">
                                <h6 class="alert-heading">Ensure that these requirements are met</h6>
                                <div class="alert-body fw-normal">Minimum 8 characters long, uppercase & symbol</div>
                            </div>

                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="mb-2 col-md-6 form-password-toggle hidden" >
                                <label class="form-label" for="Username">Name</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="username"
                                        name="username"
                                        placeholder="Username"
                                        value="{{Auth::User()->name}}"
                                        maxlength="16"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="row">

                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input
                                            class="form-control"
                                            type="password"
                                            id="newPassword"
                                            name="newPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        />
                                        <span class="input-group-text cursor-pointer">
                    <i data-feather="eye"></i>
                  </span>
                                    </div>
                                </div>

                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="confirmPassword"
                                            id="confirmPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- payment methods -->
                <div class="card" id="tenantcard">
                    <div class="card-header">
                        <h4 class="card-title mb-50">Tenants</h4>
                        @if(Auth::User()->tenant->count()<'3')
                        <button class="btn btn-primary btn-sm create-new-tenant" data-bs-toggle="modal" data-bs-target="#addNewCard">
                            <i data-feather="plus"></i>
                            <span>Create New Tenant</span>
                        </button>
                            @endif
                    </div>
                    <div class="card-body">
                        <div class="added-cards">
                            @foreach(Auth::User()->tenant as $tenants)
                                @php
                               // $_tenant=App\Models\User::find($tenants->master_id);
                                $_tenant_info=App\Models\Tenant::where('company_id','=',$tenants->id)->where('user_id','=',Auth::id())->get();

                            @endphp
                                <div class="cardMaster rounded border p-2 mb-1">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        <div class="card-information">
                                            <div class="d-flex align-items-center mb-50">
                                                <h6 class="mb-0">{{$tenants->name}}</h6>
                                                @if(Auth::User()->company_id==$tenants->id)
                                                <span class="badge badge-light-primary ms-50">Current</span>
                                                    @endif
                                            </div>
                                            <span class="card-number">Join {{$_tenant_info[0]['created_at']->diffForHumans()}}</span>
                                        </div>
                                        <div class="d-flex flex-column text-start text-lg-end">
                                            <div class="d-flex order-sm-0 order-1 mt-1 mt-sm-0">

{{--                                                <button class="btn btn-outline-secondary">Delete</button>--}}
                                            </div>
{{--                                            <span class="mt-2">Card expires at 12/24</span>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- add new card modal  -->
    <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-4 mx-50">
                    <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Add New Tenent</h1>
                    <p class="address-subtitle text-center mb-2 pb-75"></p>

                    <form id="addNewTenantForm" class="row gy-1 gx-2" method="POST" action="{{ route('tenant.create') }}">

                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input name="_id" id="_id" type="hidden" value=""/>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalAddressFirstName">Tenant Name</label>
                            <input
                                type="text"
                                id="tenant_name"
                                name="tenant_name"
                                class="form-control"
                                placeholder="Display Name"
                                data-msg="Please enter tenant name"
                                required
                            />
                            <strong style="color: #ea6666;" class="error-tenant"></strong>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-1 mt-2">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ add new card modal  -->

@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}

    <script>

        var formChangePassword = $('#formChangePassword');

        if (formChangePassword.length) {
            formChangePassword.validate({
                rules: {
                    newPassword: {
                        required: false,
                        minlength: 8
                    },
                    confirmPassword: {
                        required: false,
                        minlength: 8,
                        equalTo: '#newPassword'
                    }
                },
                messages: {
                    newPassword: {
                        required: 'Enter new password',
                        minlength: 'Enter at least 8 characters'
                    },
                    confirmPassword: {
                        required: 'Please confirm new password',
                        minlength: 'Enter at least 8 characters',
                        equalTo: 'Password mismatch'
                    }
                }
            });
        }
        // $(document).on('click', '.btn-edit-tenant', function() {
        //     $('#_id').val($(this).data("id"));
        //     $('#tenant_name').val($(this).data("name"));
        //
        // });
        $(document).on('click', '.create-new-tenant', function() {
            $('#_id').val('');

        });



        $('#addNewTenantForm').on('submit', function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '/create-tenants-profile',
                data: formData,
                success: function (res) {
                    toastAnimation.show();
                    $('#tenantcard').load(document.URL +  ' #tenantcard');
                },
                error: function (data) {
                    console.log(data);
                    $('.error-tenant').text(data.responseJSON['message']);
                }
            });
        });
    </script>
@endsection
