
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

              @if($costprofile->id)
                Edit Cost Profile Form
              @else
                Create Cost Profile Form
                @endif
              </h4>
          </div>
          <div class="card-content">
            <div class="card-body">

              @if($costprofile->id)
                <form class ="form form-vertical" action="{{ route('cost-profile.update', $costprofile->id) }}" method="POST" accept-charset="UTF-8">
                  <input type="hidden" name="_method" value="PUT">
              @else
                    <form action="{{ route('cost-profile.store') }}" method="POST" accept-charset="UTF-8">
              @endif

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">



                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="first-name-vertical">Cost Name</label>
                          <div class="controls">
                           <input type="text" id="cost_name" class="form-control" value="{{ old('name', $costprofile->name ) }}" name="name" placeholder="Profile Name"  data-validation-required-message="This Profile Name field is required"
                                  minlength="3">
                          </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="email-id-vertical">Description</label>
                          <div class="controls">
                            <input type="text" id="description" class="form-control" name="description"  value="{{ old('description', $costprofile->description ) }}" placeholder="Description" minlength="3" data-validation-required-message="This Description field is required">
                        </div>
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <label for="contact-info-vertical">vCpu</label>
                        <div class="controls">
                          <div class="input-group input-group-lg">
                            <input type="number" name="vcpu" class="touchspin" value="{{ old('vcpu', $costprofile->vcpu ? :'2' ) }}">
                          </div>
                        </div>
                      </div>

                    </div>
                      <div class="col-10">
                        <div class="form-group">
                          <label for="contact-info-vertical">vCpu Cost</label>
                          <div class="controls">
                            <input type="numeric" id="vcpu_price" class="form-control" value="{{ old('cpu_cost', $costprofile->vcpu_price ) }}"  name="vcpu_price" placeholder="Price"
                                   required
                                   data-validation-containsnumber-regex="^[1-9]\d*(\.\d+)?$"
                                   data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder="Enter Numbers only">
                          </div>
                        </div>

                      </div>
                    <div class="col-2">
                      <div class="form-group">
                        <label for="contact-info-vertical">vMemory (GB)</label>
                        <div class="controls">
                          <div class="input-group input-group-lg">
                            <input type="number" name="vmen" class="touchspin" value="{{ old('vmen', $costprofile->vcpu ? :'8' ) }}">
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-10">
                      <div class="form-group">
                        <label for="contact-info-vertical">vMemory Cost</label>
                        <div class="controls">
                          <input type="numeric" id="vmen_price" class="form-control" value="{{ old('cost', $costprofile->vmen_price ) }}"  name="vmen_price" placeholder="Price"
                                 required
                                 data-validation-containsnumber-regex="^[1-9]\d*(\.\d+)?$"
                                 data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder="Enter Numbers only">
                        </div>
                      </div>

                    </div>




                    <div class="col-3"></div>


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
