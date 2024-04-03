@extends('layouts/contentLayoutMaster')

@section('title', $pagetitle)

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <!-- users list start -->
    <section class="app-user-list">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{$totaluser}}</h3>
                            <span>Total Users</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="user" class="font-medium-4"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{$active_user}}</h3>
                            <span>Active Users</span>
                        </div>
                        <div class="avatar bg-light-success p-50">
            <span class="avatar-content">
              <i data-feather="user-check" class="font-medium-4"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{$active_user}}</h3>
                            <span>Pending Users</span>
                        </div>
                        <div class="avatar bg-light-warning p-50">
            <span class="avatar-content">
              <i data-feather="user-x" class="font-medium-4"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- list and filter start -->
        <div class="card">
{{--            <div class="card-body border-bottom">--}}
{{--                <h4 class="card-title">Search & Filter</h4>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-4 user_role"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="card-datatable table-responsive pt-0">
                <table class="user-list-table table">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- Modal to add new user starts-->
            <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                <div class="modal-dialog">
                    <form class="add-new-user modal-content pt-0" id="userform" route={{ route('user.store') }} method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="form-label">Add User</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="hidden">
                                <label class="form-label" for="basic-icon-default-fullname">User </label>
                                <input
                                    type="text"
                                    class="form-control dt-full-name"
                                    id="user_id"
                                    placeholder="Full Name"
                                    name="user_id"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                <input
                                    type="text"
                                    class="form-control dt-full-name"
                                    id="name"
                                    placeholder="Full Name"
                                    name="user_fullname"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    class="form-control dt-email"
                                    placeholder="username@example.com"
                                    name="user_email"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="modalHod" data-bs-toggle="tooltip"
                                       data-bs-placement="top"
                                       data-bs-original-title="">Role</label>
                                <select id="role" name="role"
                                        class="hod-select2 select2 form-select ">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>

                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter a display name</div>
                            </div>
{{--                            <div class="mb-1">--}}
{{--                                <label class="form-label" for="modalHod" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Assign This Department will be HOD">Department - HOD</label>--}}
{{--                                <select  id="modalHod" name="modalHod[]" multiple="multiple" class="hod-select2 select2 form-select ">--}}
{{--                                    @foreach($departments as $department)--}}
{{--                                        <option value="{{$department->id}}">{{$department->department_name}}</option>--}}

{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <div class="valid-feedback">Looks good!</div>--}}
{{--                                <div class="invalid-feedback">Please enter a display name</div>--}}
{{--                            </div>--}}
{{--                            <div class="mb-1">--}}
{{--                                <label class="form-label" for="modalMember" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="This Department will be Member">Department - Member </label>--}}
{{--                                <select  id="modalMember" name="modalMember[]" multiple="multiple" class="select2 form-select">--}}
{{--                                    @foreach($departments as $department)--}}
{{--                                        <option value="{{$department->id}}">{{$department->department_name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <div class="valid-feedback">Looks good!</div>--}}
{{--                                <div class="invalid-feedback">Please enter your sentence.</div>--}}
{{--                            </div>--}}
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal to add new user Ends-->
        </div>
        <!-- list and filter end -->
    </section>
    <!-- users list ends -->
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
   <script>
       $(function () {
           ('use strict');

           var dtUserTable = $('.user-list-table'),
               newUserSidebar = $('.new-user-modal'),
               newUserForm = $('.add-new-user'),
               select = $('.select2'),
               dtContact = $('.dt-contact'),
               statusObj = {
                   1: { title: 'Pending', class: 'badge-light-warning' },
                   2: { title: 'Active', class: 'badge-light-success' },
                   3: { title: 'Inactive', class: 'badge-light-secondary' }
               };

           var assetPath = '../../../app-assets/',
               userView = '';

           if ($('body').attr('data-framework') === 'laravel') {
               assetPath = $('body').attr('data-asset-path');
               userView = assetPath + '';
           }
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

           $('tbody').on('click', '.remove-member', function () {
               var id = $(this).data('id');

               Swal.fire({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonText: 'Yes, remove it!',
                   customClass: {
                       confirmButton: 'btn btn-primary me-3',
                       cancelButton: 'btn btn-label-secondary'
                   },
                   buttonsStyling: false
               }).then(function (result) {
                   if (result.value) {
                       $.ajax({

                           type:"POST",
                           url: "{{ route('user.remove') }}",
                           data: { id: id },
                           dataType: 'json',
                           success: function () {

                           //    dtUserTable.row($(this).parents('tr')).remove().draw();
                               window.setTimeout( window.location.reload(), 3000 );
                           },
                           error: function (error) {
                               console.log(error);
                           }
                       });

                       // success sweetalert
                       Swal.fire({
                           icon: 'success',
                           title: 'Deleted!',
                           text: 'The User has been remove from this tenant!',
                           customClass: {
                               confirmButton: 'btn btn-success'
                           }
                       });
                   } else if (result.dismiss === Swal.DismissReason.cancel) {
                       Swal.fire({
                           title: 'Cancelled',
                           text: 'The action been cancel!',
                           icon: 'error',
                           customClass: {
                               confirmButton: 'btn btn-success'
                           }
                       });
                   }
               });
           });
           $('body').on('click', '.edit', function () {
               var id = $(this).data('id');
               $.ajax({
                   type:"POST",
                   url: "{{ route('user.edit') }}",
                   data: { id: id },
                   dataType: 'json',
                   success: function(res){

                       var color=res.display_icon_colour;
                       $('#modals-slide-in').modal('show');
                       $('#form-label').text("Edit Record");
                       $('#user_id').val(res.id);
                       $("#name").prop("readonly",true);
                       $("#email").prop("readonly",true);
                       $('#name').val(res.name);
                       $('#email').val(res.email);

                        $('#modalHod').val(res.department_hod.split(',')).trigger("change");
                        $('#modalMember').val(res.department_member.split(',')).trigger("change");

                       // $('#code').val(res.code);
                       // $('#author').val(res.author);
                   }
               });

           });

           select.each(function () {
               var $this = $(this);
               $this.wrap('<div class="position-relative"></div>');
               $this.select2({
                   // the following code is used to disable x-scrollbar when click in select input and
                   // take 100% width in responsive also
                   dropdownAutoWidth: true,
                   width: '100%',
                   dropdownParent: $this.parent()
               });
           });

           // Users List datatable
           if (dtUserTable.length) {
               dtUserTable.DataTable({
                   ajax: "{{ route('user') }}",
                   columns: [
                       // columns according to JSON
                       { data: '' },
                       { data: 'name' },
                       { data: 'introduction' },
                       { data: 'company_id' },
                       { data: '' }
                   ],
                   columnDefs: [
                       {
                           // For Responsive
                           className: 'control',
                           orderable: false,
                           responsivePriority: 2,
                           targets: 0,
                           render: function (data, type, full, meta) {
                               return '';
                           }
                       },
                       {
                           // User full name and username
                           targets: 1,
                           responsivePriority: 4,
                           render: function (data, type, full, meta) {
                               var $name = full['name'],
                                   $email = full['email'],
                                   $image = full['avatar'];
                               // if ($image) {
                               //     // For Avatar image
                               //     var $output =
                               //         '<img src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" height="32" width="32">';
                               // } else {
                                   // For Avatar badge
                                   var stateNum = Math.floor(Math.random() * 6) + 1;
                                   var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                   var $state = states[stateNum],
                                       $name = full['name'],
                                       $initials = $name.match(/\b\w/g) || [];
                                   $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                  var $output = '<span class="avatar-content">' + $initials + '</span>';
                               //}
                               var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
                               // Creates full output for row
                               var $row_output =
                                   '<div class="d-flex justify-content-left align-items-center">' +
                                   '<div class="avatar-wrapper">' +
                                   '<div class="avatar ' +
                                   colorClass +
                                   ' me-1">' +
                                   $output +
                                   '</div>' +
                                   '</div>' +
                                   '<div class="d-flex flex-column">' +
                                   '<a href="' +
                                   '#' +
                                   '" class="user_name text-truncate text-body"><span class="fw-bolder">' +
                                   $name +
                                   '</span></a>' +
                                   '<small class="emp_post text-muted">' +
                                   $email +
                                   '</small>' +
                                   '</div>' +
                                   '</div>';
                               return $row_output;
                           }
                       },
                       {
                           // User Role
                           targets: 2,
                           render: function (data, type, full, meta) {
                               var $role = full['role_name'];
                               var roleBadgeObj = {
                                   Requester: feather.icons['user'].toSvg({ class: 'font-medium-3 text-primary me-50' }),
                                   Approver_lv_1: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning me-50' }),
                                   Approver_lv_2: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning me-50' }),
                                   Admin: feather.icons['slack'].toSvg({ class: 'font-medium-3 text-danger me-50' })
                               };
                               return "<span class='text-truncate align-middle'>" + roleBadgeObj[$role] + $role + '</span>';
                           }
                       },
                       {
                           // User Status
                           targets: 3,
                           render: function (data, type, full, meta) {
                               //var $status = full['company_id'];
                               if(full['email_verified_at']==null){
                                   var $status = 1;
                               }else{
                                   var $status = 2;
                               }


                               return (
                                   '<span class="badge rounded-pill ' +
                                   statusObj[$status].class +
                                   '" text-capitalized>' +
                                   statusObj[$status].title +
                                   '</span>'
                               );
                           }
                       },
                       {
                           // Actions
                           targets: -1,
                           title: 'Actions',
                           orderable: false,
                           render: function (data, type, full, meta) {

                               var $id = full['id'];

                               if(full['id'] === {!!json_encode($mid)!!}){
                                   return (

                                       '<a class="me-1 edit" href="#" data-bs-toggle="tooltip" data-id="'+$id+'" data-bs-placement="top" title="Edit User">' +
                                       feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                                       '</a>'

                                   );
                               }else{
                                   return (

                                       '<a class="me-1 edit" href="#" data-bs-toggle="tooltip" data-id="'+$id+'" data-bs-placement="top" title="Edit User">' +
                                       feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                                       '</a>' +
                                       '<a class="me-1 remove-member" href="#" data-bs-toggle="tooltip" data-id="'+$id+'" data-bs-placement="top" title="Remove User">' +
                                       feather.icons['user-x'].toSvg({ class: 'font-medium-2 text-body' }) +
                                       '</a>'

                                   );
                               }



                           }
                       }
                   ],
                   order: [[1, 'desc']],
                   dom:
                       '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                       '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                       '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                       '>t' +
                       '<"d-flex justify-content-between mx-2 row mb-1"' +
                       '<"col-sm-12 col-md-6"i>' +
                       '<"col-sm-12 col-md-6"p>' +
                       '>',
                   language: {
                       sLengthMenu: 'Show _MENU_',
                       search: 'Search',
                       searchPlaceholder: 'Search..'
                   },
                   // Buttons with Dropdown
                   buttons: [
                       {
                           text: 'Add New User',
                           className: 'add-new btn btn-primary',
                           attr: {
                               'data-bs-toggle': 'modal',
                               'data-bs-target': '#modals-slide-in'
                           },
                           init: function (api, node, config) {
                               $(node).removeClass('btn-secondary');
                           },
                           action: function (){
                               $('#userform').trigger("reset");

                               $('#form-label').text("Add User");
                               $("#name").prop("readonly",false);
                               $("#email").prop("readonly",false);

                               $('#modalHod').val('').trigger("change");
                               $('#modalMember').val('').trigger("change");
                           },
                       }
                   ],
                   // For responsive popup
                   responsive: {
                       details: {
                           display: $.fn.dataTable.Responsive.display.modal({
                               header: function (row) {
                                   var data = row.data();
                                   return 'Details of ' + data['name'];
                               }
                           }),
                           type: 'column',
                           renderer: function (api, rowIdx, columns) {
                               var data = $.map(columns, function (col, i) {
                                   return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
                                       ? '<tr data-dt-row="' +
                                       col.rowIdx +
                                       '" data-dt-column="' +
                                       col.columnIndex +
                                       '">' +
                                       '<td>' +
                                       col.title +
                                       ':' +
                                       '</td> ' +
                                       '<td>' +
                                       col.data +
                                       '</td>' +
                                       '</tr>'
                                       : '';
                               }).join('');
                               return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                           }
                       }
                   },
                   language: {
                       paginate: {
                           // remove previous & next text from pagination
                           previous: '&nbsp;',
                           next: '&nbsp;'
                       }
                   },
                   initComplete: function () {
                       // Adding role filter once table initialized
                       this.api()
                           .columns(2)
                           .every(function () {
                               // var column = this;
                               // var label = $('<label class="form-label" for="UserRole">Role</label>').appendTo('.user_role');
                               // var select = $(
                               //     '<select id="UserRole" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Role </option></select>'
                               // )
                               //     .appendTo('.user_role')
                               //     .on('change', function () {
                               //         var val = $.fn.dataTable.util.escapeRegex($(this).val());
                               //         column.search(val ? '^' + val + '$' : '', true, false).draw();
                               //     });
                               //
                               // column
                               //     .data()
                               //     .unique()
                               //     .sort()
                               //     .each(function (d, j) {
                               //         select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
                               //     });
                           });
                       // Adding plan filter once table initialized
                       // this.api()
                       //     .columns(3)
                       //     .every(function () {
                       //         var column = this;
                       //         var label = $('<label class="form-label" for="UserPlan">Plan</label>').appendTo('.user_plan');
                       //         var select = $(
                       //             '<select id="UserPlan" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Plan </option></select>'
                       //         )
                       //             .appendTo('.user_plan')
                       //             .on('change', function () {
                       //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
                       //                 column.search(val ? '^' + val + '$' : '', true, false).draw();
                       //             });
                       //
                       //         column
                       //             .data()
                       //             .unique()
                       //             .sort()
                       //             .each(function (d, j) {
                       //                 select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
                       //             });
                       //     });
                       // Adding status filter once table initialized
                       //
                   }
               });
           }

           // Form Validation
           if (newUserForm.length) {
               newUserForm.validate({
                   errorClass: 'error',
                   rules: {
                       'user_fullname': {
                           required: true
                       },
                       'user_email': {
                           required: true
                       }
                   }
               });

               newUserForm.on('submit', function (e) {
                   var isValid = newUserForm.valid();
                   e.preventDefault();
                   if (isValid) {
                       document.forms["userform"].submit();
                       newUserSidebar.modal('hide');
                   }
               });
           }

       });

   </script>
@endsection
