
@extends('layouts/contentLayoutMaster')

@section('title', 'Form Cost Profile')

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
                        <h4 class="card-title">{{$data->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate id="costform" name="costform" action="{{route("management.costform.store")}}" method="POST" accept-charset="UTF-8">
                            <input class="hidden"  name="_token" value="{{ csrf_token()}}">
                            <input class="hidden" name="form_id" id="form_id" value="{{$data->id}}">
                            <div class="mb-1">
                                <label class="form-label" for="basic-addon-name">Name</label>

                                <input
                                    type="text"
                                    id="basic-addon-name"
                                    name="name"
                                    class="form-control"
                                    placeholder="Name"
                                    aria-label="Name"
                                    aria-describedby="basic-addon-name"
                                    value="{{$data->name}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter profile name.</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-desc">Description</label>
                                <input
                                    type="text"
                                    id="basic-default-desc"
                                    name="description"
                                    class="form-control"
                                    placeholder="Description"
                                    aria-label=""
                                    value="{{$data->description}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter description</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vcpu-price">vCPU Price</label>
                                <input
                                    type="decimal"
                                    id="basic-default-vcpu-price"
                                    name="vcpu_price"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->vcpu_price}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vCPU price.</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vcpu-min">Minimum vCPU in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vcpu-min"
                                    name="form_vcpu_min"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->form_vcpu_min}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vCPU minimum range.</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vcpu-max">Maximum vCPU in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vcpu-max"
                                    name="form_vcpu_max"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->form_vcpu_max}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vCPU minimum range.</div>
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vmen-price">vMemory Price</label>
                                <input
                                    type="decimal"
                                    id="basic-default-vmen-price"
                                    name="vmen_price"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->vmen_price}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vMemory price.</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vmen-min">Minimum vMemory in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vmen-min"
                                    name="form_vmen_min"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->form_vmen_min}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vMemory minimum range.</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vmen-max">Maximum vMemory in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vmen-max"
                                    name="form_vmen_max"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->form_vmen_max}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vMemory maximum range.</div>
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vstorage-price">vStorage Price (100 GB)</label>
                                <input
                                    type="decimal"
                                    id="basic-default-vstorage-price"
                                    name="vstorage_price"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->vstorage_price}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vStorage price.</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vstorage-min">Minimum vStorage in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vstorage-min"
                                    name="form_vstorage_min"
                                    class="form-control"
                                    min="100"
                                    placeholder="1"
                                    value="{{$data->form_vstorage_min}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vStorage minimum range.</div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-vstorage-max">Maximum vStorage in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vstorage-max"
                                    name="form_vstorage_max"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    value="{{$data->form_vstorage_max}}"
                                    required
                                />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter vStorage maximum range.</div>
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
