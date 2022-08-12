@extends('layouts/contentLayoutMaster')

@section('title', 'User List')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
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
                            <h3 class="fw-bolder mb-75">{{$totaluser}}</h3>
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
                            <h3 class="fw-bolder mb-75">0</h3>
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
            <div class="card-body border-bottom">
                <h4 class="card-title">Search & Filter</h4>
                <div class="row">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
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
                                <label class="form-label" for="user-role">User Role</label>
                                <select name="user_role" id="user_role" class="select2 form-select">
                                    <option selected value="User">User</option>
                                    <option value="Teamlead">Team Leader</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
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
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
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
                                   userView +
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
                               var $role = full['introduction'];
                               var roleBadgeObj = {
                                   User: feather.icons['user'].toSvg({ class: 'font-medium-3 text-primary me-50' }),
                                   teamlead: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning me-50' }),
                                   Teamlead: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning me-50' }),
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
                               var $status = 2;

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
                               return (
                                   '<div class="btn-group">' +
                                   '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                                   feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                                   '</a>' +
                                   '<div class="dropdown-menu dropdown-menu-end">' +
                                   '<a href="' +
                                   userView +
                                   '" class="dropdown-item">' +
                                   feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
                                   'Details</a>' +
                                   '<a href="javascript:;" class="dropdown-item delete-record">' +
                                   feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                                   'Delete</a></div>' +
                                   '</div>' +
                                   '</div>'
                               );
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
                           }
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
                               var column = this;
                               var label = $('<label class="form-label" for="UserRole">Role</label>').appendTo('.user_role');
                               var select = $(
                                   '<select id="UserRole" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Role </option></select>'
                               )
                                   .appendTo('.user_role')
                                   .on('change', function () {
                                       var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                       column.search(val ? '^' + val + '$' : '', true, false).draw();
                                   });

                               column
                                   .data()
                                   .unique()
                                   .sort()
                                   .each(function (d, j) {
                                       select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
                                   });
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
                       this.api()
                           .columns(5)
                           .every(function () {
                               var column = this;
                               var label = $('<label class="form-label" for="FilterTransaction">Status</label>').appendTo('.user_status');
                               var select = $(
                                   '<select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value=""> Select Status </option></select>'
                               )
                                   .appendTo('.user_status')
                                   .on('change', function () {
                                       var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                       column.search(val ? '^' + val + '$' : '', true, false).draw();
                                   });

                               column
                                   .data()
                                   .unique()
                                   .sort()
                                   .each(function (d, j) {
                                       select.append(
                                           '<option value="' +
                                           statusObj[d].title +
                                           '" class="text-capitalize">' +
                                           statusObj[d].title +
                                           '</option>'
                                       );
                                   });
                           });
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