@extends('layouts/contentLayoutMaster')

@section('title', $data['0']->company_name??'')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">
@endsection

@section('content')
  <!-- page users view start -->
  <section class="page-users-view">
    <div class="row">
      <!-- account start -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
{{--            <div class="card-title">Company Info</div>--}}
            <div class="row">

              <div class="col-sm-4 col-12">
                <table>

                  <tr>
                    <td class="font-weight-bold">Company Name</td>
                    <td>{{ $data['0']->company_name??'' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Email</td>
                    <td>{{ $data['0']->email ??''}}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Contact</td>
                    <td>{{ $data['0']->email??''}}</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6 col-12 ">
                <table class="ml-0 ml-sm-0 ml-lg-0">
                  <tr>
                    <td class="font-weight-bold">
Total Staff
                    </td>
                    <td>

                    </td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Register Date</td>
                    <td>{{ $data['name']??'' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Manage By</td>
                    <td>{{ $data['0']->name??'' }}</td>
                  </tr>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- account end -->
    </div>
  </section>
  <!-- page users view end -->
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user.js')) }}"></script>
@endsection
