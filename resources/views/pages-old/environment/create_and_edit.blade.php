
@extends('layouts/contentLayoutMaster')

@section('title', $title)
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

              @if($value->id)
                Edit {{$title}} Form
              @else
                Create {{$title}} Form
              @endif
            </h4>
          </div>
          <div class="card-content">
            <div class="card-body">

              @if($value->id)
                <form class ="form form-vertical" action="{{ route('environment.update', $value->id) }}" method="POST" accept-charset="UTF-8">
                  <input type="hidden" name="_method" value="PUT">
                  @else
                    <form action="{{ route('environment.store') }}" method="POST" accept-charset="UTF-8">
                      @endif

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">



                      <div class="form-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="first-name-vertical">Display Name</label>
                              <div class="controls">
                                <input type="text" id="cost_name" class="form-control" value="{{ old('name', $value->name ) }}"name="name" placeholder="Display Name"  data-validation-required-message="This Display Name field is required"
                                       minlength="1">
                              </div>
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="first-name-vertical">Value</label>
                              <div class="controls">
                                <input type="text" id="cost_name" class="form-control" value="{{ old('short_name', $value->short_name ) }}"name="short_name" placeholder="Value"  data-validation-required-message="This Value field is required"
                                       minlength="1">
                              </div>
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
