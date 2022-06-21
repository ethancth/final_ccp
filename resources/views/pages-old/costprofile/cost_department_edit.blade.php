
@extends('layouts/contentLayoutMaster')

@section('title', 'Cost Profile')
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
@endsection
@section('content')
  <!-- Basic Vertical form layout section start -->
  <section id="basic-vertical-layouts">
    <div class="row match-height">
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><span class="feather icon-edit"></span>

              @if($value->id)
                Edit Cluster Cost Profile Form
              @else
                Create Cluster Cost Profile Form
                @endif
              </h4>
          </div>
          <div class="card-content">
            <div class="card-body">

              @if($value->id)
                <form class ="form form-vertical" action="{{ route('department-cost-profile.update', $value->id) }}" method="POST" accept-charset="UTF-8">
                  <input type="hidden" name="_method" value="PUT">
              @else
                    <form action="{{ route('department-cost-profile.store') }}" method="POST" accept-charset="UTF-8">
              @endif

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">



                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="first-name-vertical">Cost Name</label>
                          <div class="controls">
                           <input type="text" readonly id="domain_name" class="form-control" value="{{ old('name', $value->name ) }}" name="domain_name" placeholder="Profile Name"  data-validation-required-message="This Profile Name field is required"
                                  minlength="3">
                          </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label for="contact-info-vertical">Department</label>
                        <select class="form-control" name="department_id" required>
                          <option value="" hidden disabled {{ $value->department_id ? '' : 'selected' }}>Select</option>
                          @foreach ($department as $values)
                            <option value="{{ $values->id }}" {{ $value->department_id == $values->id ? 'selected' : '' }}>
                              {{ $values->department_name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="contact-info-vertical">Profile</label>
                        <select class="form-control" name="cost_profile_id" required>
                          <option value="" hidden disabled {{ $value->cost_profile_id ? '' : 'selected' }}>Select</option>
                          @foreach ($cost_profile as $values)
                            <option value="{{ $values->id }}" {{ $value->cost_profile_id == $values->id ? 'selected' : '' }}>
                              {{ $values->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>



                    <div class="col-12">
                      <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                      <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/number-input.js')) }}"></script>
@endsection
