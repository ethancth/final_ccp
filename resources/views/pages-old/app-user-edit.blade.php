@extends('layouts/contentLayoutMaster')

@section('title', 'Edit User Page')

@section('vendor-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
@endsection

@section('page-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">

@endsection

@section('content')
<!-- users edit start -->
<section class="users-edit">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <ul class="nav nav-tabs mb-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account"
              aria-controls="account" role="tab" aria-selected="true">
              <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">Account</span>
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
            <!-- users edit media object start -->
            <div class="media mb-2">
              <a class="mr-2 my-25" href="#">
                <img src="{{asset('images/portrait/small/avatar-s-11.jpg') }}" alt="users avatar"
                  class="users-avatar-shadow rounded" height="64" width="64">
              </a>
              <div class="media-body mt-50">
                <h4 class="media-heading">{{ old('name', $user->name) }}</h4>
                <div class="col-12 d-flex mt-1 px-0">
                  <a href="#" class="btn btn-primary d-none d-sm-block mr-75">Change</a>
                  <a href="#" class="btn btn-primary d-block d-sm-none mr-75"><i
                      class="feather icon-edit-1"></i></a>

                </div>
              </div>
            </div>
            <!-- users edit media object ends -->
            <!-- users edit account form start -->
            <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              @include('shared._error')
              <div class="row">
                <div class="col-12 col-sm-6">

                  <div class="form-group">
                    <div class="controls">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name', $user->name) }}" required
                        data-validation-required-message="This name field is required">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <label>E-mail</label>
                      <input type="email"  disabled class="form-control"  placeholder="Email" name="email" value="{{ old('email', $user->email) }}"
                        required data-validation-required-message="This email field is required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Contact</label>
                    <input type="tel" class="form-control"  name="contact" value="{{ old('contact', $user->contact) }}"
                           required data-validation-required-message="This email field is required" placeholder="Contact Number">
                  </div>
                </div>
                <div class="col-12 col-sm-6">

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control">
                      <option>Active</option>
                      <option>Blocked</option>
                      <option>deactivated</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control">
                      <option>Admin</option>
                      <option>User</option>
                      <option>Staff</option>
                    </select>
                  </div>

                </div>
                <div class="col-12">
                  <div class="table-responsive border rounded px-1 ">
                    <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2"><i
                        class="feather icon-lock mr-50 "></i>Permission</h6>
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th>Module</th>
                          <th>Read</th>
                          <th>Write</th>
                          <th>Create</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Users</td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox1"
                                class="custom-control-input" checked>
                              <label class="custom-control-label" for="users-checkbox1"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox2"
                                class="custom-control-input"><label class="custom-control-label"
                                for="users-checkbox2"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox3"
                                class="custom-control-input"><label class="custom-control-label"
                                for="users-checkbox3"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox4"
                                class="custom-control-input" checked>
                              <label class="custom-control-label" for="users-checkbox4"></label>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Articles</td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox5"
                                class="custom-control-input"><label class="custom-control-label"
                                for="users-checkbox5"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox6"
                                class="custom-control-input" checked>
                              <label class="custom-control-label" for="users-checkbox6"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox7"
                                class="custom-control-input"><label class="custom-control-label"
                                for="users-checkbox7"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox8"
                                class="custom-control-input" checked>
                              <label class="custom-control-label" for="users-checkbox8"></label>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Staff</td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox9"
                                class="custom-control-input" checked>
                              <label class="custom-control-label" for="users-checkbox9"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox10"
                                class="custom-control-input" checked>
                              <label class="custom-control-label" for="users-checkbox10"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox11"
                                class="custom-control-input"><label class="custom-control-label"
                                for="users-checkbox11"></label>
                            </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox" id="users-checkbox12"
                                class="custom-control-input"><label class="custom-control-label"
                                for="users-checkbox12"></label>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                  <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                    Changes</button>
                  <button type="reset" class="btn btn-outline-warning">Reset</button>
                </div>
              </div>
            </form>

          </div>
          </div>

      </div>
    </div>
  </div>
</section>
<!-- users edit ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/navs/navs.js')) }}"></script>
@endsection

