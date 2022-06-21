
@extends('layouts/contentLayoutMaster')

@section('title', 'Operation Expense')
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

              @if($operationcost->id)
                Edit Cost Form
              @else
                Create Cost Form
                @endif
              </h4>
          </div>
          <div class="card-content">
            <div class="card-body">

              @if($operationcost->id)
                <form class ="form form-vertical" action="{{ route('operating-expense.update', $operationcost->id) }}" method="POST" accept-charset="UTF-8">
                  <input type="hidden" name="_method" value="PUT">
              @else
                    <form action="{{ route('operating-expense.store') }}" method="POST" accept-charset="UTF-8">
              @endif

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">



                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="first-name-vertical">Cost Name</label>
                          <div class="controls">
                           <input type="text" id="cost_name" class="form-control" value="{{ old('name', $operationcost->name ) }}"name="name" placeholder="Cost Name"  data-validation-required-message="This Cost Name field is required"
                                  minlength="3">
                          </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="email-id-vertical">Description</label>
                          <div class="controls">
                            <input type="text" id="description" class="form-control" name="description"  value="{{ old('description', $operationcost->description ) }}" placeholder="Description" minlength="3" data-validation-required-message="This Description field is required">
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="password-vertical">Price</label>
                        <div class="controls">
                          <input type="numeric" id="cost_price" class="form-control" value="{{ old('cost', $operationcost->cost ) }}"  name="cost" placeholder="Price"
                                 required
                                 data-validation-containsnumber-regex="^[1-9]\d*(\.\d+)?$"
                                  data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder="Enter Numbers only">
                          </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="contact-info-vertical">Profile</label>
                        <select class="form-control" name="profile" required>
                          <option value="" hidden disabled {{ $operationcost->id ? '' : 'selected' }}>Select</option>
                          @foreach ($ctp as $value)
                            <option value="{{ $value->id }}" {{ $operationcost->profile_type == $value->id ? 'selected' : '' }}>
                              {{ $value->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="password-vertical">Type</label>
                        <select class="form-control" name="profile_type" required>
                          <option value="" hidden disabled {{ $operationcost->id ? '' : 'selected' }}>Select</option>
                          @foreach ($c_profile as $value)
                            <option value="{{ $value->id }}" {{ $operationcost->profile_type == $value->id ? 'selected' : '' }}>
                              {{ $value->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="password-vertical">Payment Method</label>
                        <select class="form-control" name="cost_method" required>
                          <option value="" hidden disabled {{ $operationcost->id ? '' : 'selected' }}>Select</option>
                          @foreach ($cpp as $value)
                            <option value="{{ $value->id }}" {{ $operationcost->profile_type == $value->id ? 'selected' : '' }}>
                              {{ $value->name }}
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
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
@endsection
