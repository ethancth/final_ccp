
@extends('layouts/contentLayoutMaster')

@section('title', 'Infra Setting')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
    <!-- Validation -->
    <section class="bs-validation">
        <div class="row">
            <!-- Bootstrap Validation -->
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">vRA Infra Setting</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate id="costform" name="costform" action="{{route("management.infra.store")}}" method="POST" accept-charset="UTF-8">
                            <input class="hidden"  name="_token" value="{{ csrf_token()}}">
                            <input class="hidden" name="form_id" id="form_id" value="{{$data->id}}">
                            <div class="row">
                                <div class="mb-1 col-md-6 col-6">
                                    <label class="form-label" for="basic-addon-name">Server FQDN</label>

                                    <input
                                        type="text"
                                        id="basic-addon-name"
                                        name="name"
                                        class="form-control"
                                        placeholder="Name"
                                        aria-label="Name"
                                        aria-describedby="basic-addon-name"
                                        value="{{$data->vra_server}}"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter vRA Server FQDN.</div>
                                </div>

                                <div class="mb-1 col-md-6 col-6">
                                    <label class="form-label" for="basic-addon-name">Server Domain</label>

                                    <input
                                        type="text"
                                        id="basic-addon-name"
                                        name="domain"
                                        class="form-control"
                                        placeholder="Domain"
                                        aria-label="Name"
                                        aria-describedby="basic-addon-name"
                                        value="{{$data->vra_domain}}"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter vRA Server Domain.</div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="mb-1 col-md-6 col-6">
                                    <label class="form-label" for="basic-default-desc">User ID</label>
                                    <input
                                        type="text"
                                        id="vra_user_id"
                                        name="vra_user_id"
                                        class="form-control"
                                        placeholder="user id"
                                        aria-label=""
                                        value="{{$data->vra_user_id}}"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">User ID Required</div>
                                </div>
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vcpu-price">Credential</label>
                                <input
                                    type="password"
                                    id="vra_credential"
                                    name="vra_credential"
                                    class="form-control"
                                    min="0"
                                    placeholder="**********"
                                    value=""
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Credential Required</div>
                            </div>

                                <div class="mb-1 col-md-6 col-6">
                                    <label class="form-label" for="basic-default-desc">Network Workflow ID</label>
                                    <input
                                        type="text"
                                        id="network_workflow"
                                        name="network_workflow"
                                        class="form-control"
                                        placeholder="vro Network Workflow ID"
                                        aria-label=""
                                        value="{{$data->network_workflow}}"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">User ID Required</div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vcpu-min">Token</label>
                                <input
                                    type="text"
                                    id="token"
                                    name="token"
                                    class="form-control"
                                    placeholder=""
                                    value="{{$data->token}}"
                                    readonly
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vCPU minimum range.</div>
                            </div>
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vcpu-max">Refresh Token</label>
                                <input
                                    type="text"
                                    id="refresh_token"
                                    name="refresh_token"
                                    class="form-control"
                                    min="0"
                                    placeholder=""
                                    value="{{$data->refresh_token}}"
                                    readonly

                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vCPU minimum range.</div>
                            </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Bootstrap Validation -->


        </div>
    </section>
    <!-- /Validation -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script>
        $(function () {
            'use strict';

            var bootstrapForm = $('.needs-validation');
            if (bootstrapForm.length) {
                Array.prototype.filter.call(bootstrapForm, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            form.classList.add('invalid');
                        }
                        form.classList.add('was-validated');
                        event.preventDefault();
                        if (form.checkValidity() === true) {
                            document.forms["costform"].submit();
                        }
                    });

                });
            }

        });

    </script>
@endsection
