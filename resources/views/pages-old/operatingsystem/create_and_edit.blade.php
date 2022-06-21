
@extends('layouts/contentLayoutMaster')

@section('title', 'Operating System')
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
@endsection
@section('content')
  <!-- Basic Vertical form layout section start -->
  <section id="basic-vertical-layouts">
    <div class="row match-height">
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><span class="feather icon-edit"></span>

              @if($operatingsystem->id)
                Edit Operating System Form
              @else
                Create Operating System Form
              @endif
            </h4>
          </div>
          <div class="card-content">
            <div class="card-body">

              @if($operatingsystem->id)
                <form class ="form form-vertical" action="{{ route('operating-system.update', $operatingsystem->id) }}" method="POST" accept-charset="UTF-8">
                  <input type="hidden" name="_method" value="PUT">
                  @else
                    <form action="{{ route('operating-system.store') }}" method="POST" accept-charset="UTF-8">
                      @endif

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">



                      <div class="form-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="first-name-vertical">Operating System Name</label>
                              <div class="controls">
                                <input type="text" id="cost_name" class="form-control" value="{{ old('name', $operatingsystem->name ) }}"name="name" placeholder="Operating System Name"  data-validation-required-message="This Cost Name field is required"
                                       minlength="3">
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label for="password-vertical">Price</label>
                              <div class="controls">
                                <input type="numeric" id="cost_price" class="form-control" value="{{ old('cost', $operatingsystem->price ) }}"  name="price" placeholder="Price"
                                       required
                                       data-validation-containsnumber-regex="^[1-9]\d*(\.\d+)?$"
                                       data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder="Enter Numbers only">
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label for="contact-info-vertical">Type</label>
                              <select class="form-control" name="type" required>
                                <option value="" hidden disabled {{ $operatingsystem->id ? '' : 'selected' }}>Select</option>
                                <option value="linux" {{ $operatingsystem->profile_type == 'linux' ? 'selected' : '' }}>Linux</option>
                                <option value="windows" {{ $operatingsystem->profile_type == 'windows' ? 'selected' : '' }}>Windows</option>
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
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
@endsection
