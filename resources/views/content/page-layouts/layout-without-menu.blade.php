@extends('layouts/contentLayoutMaster')

@section('title', 'Company Setting')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-primary" role="alert">
                <div class="alert-body">
                    <strong>Info:</strong> Company Domain Setting
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Ecommerce Starts -->
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Company Form</h4>
            </div>
            <div class="card-body">
                    <form id="jquery-val-form" class="needs-validation" novalidate id="costform" name="costform" action="{{route("management.company.store")}}" method="POST" accept-charset="UTF-8">
                        <input class="hidden"  name="_token" value="{{ csrf_token()}}">
                    <div class="mb-1">
                        <label class="form-label" for="company_name">Company Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="company_name"
                            name="company_name"
                            placeholder="Company Name"
                        />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="company_domain">Domain</label>
                        <input
                            type="text"
                            id="company_domain"
                            name="company_domain"
                            class="form-control select-domain"
                            placeholder="{{Auth()->user()->company->name}}"
                            onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"
                        /><input
                            type="text"
                            id="company_domain1"
                            name="company_domain1"
                            class="hidden"
                            placeholder="{{Auth()->user()->company->name}}"
                            onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"
                        />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="company_default_password">Default User Password</label>
                        <input
                            type="password"
                            id="company_default_password"
                            name="company_default_password"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        />
                    </div>
                    <div class="mb-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="validationCheck" name="validationCheck" />
                            <label class="form-check-label" for="validationCheck">Agree to our terms and conditions</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    {{-- Page js files --}}
    <script>

        $(function () {
            'use strict';

            var jqForm = $('#jquery-val-form');


            jQuery.extend(jQuery.validator.messages, {

                equalTo: "This Domain Has been used"
            });

            // jQuery Validation
            // --------------------------------------------------------------------
            if (jqForm.length) {
                jqForm.validate({
                    rules: {
                        'company_name': {
                            required: true
                        },
                        'company_domain': {
                            required: true,
                            equalTo: '#company_domain1'
                        },
                        'company_default_password': {
                            required: true
                        },
                        validationCheck: {
                            required: true
                        }
                    }
                });
            }
        });

        $(document).on('change', '.select-domain', function() {
            var value = $(this).val();
            $('#company_domain1').val(value);
            $.ajax({
                type: 'GET',
                url: "{{route('getCompanyDomain')}}",
                data: {'value': value},

                success: function (response) {
                    $('#company_domain1').val('');
                    $('input[name="company_domain"]').valid();
                    // $('#formAddress').val(response.address_1);
                    // $('#formCurrency').val(response.currency);
                    // $('#formCurrencyRate').val(response.currency_rate);


                },
                error: function (err) {
                    $('#company_domain1').val(value);
                    $('input[name="company_domain"]').valid();
                }
            });
        });


    </script>
@endsection
