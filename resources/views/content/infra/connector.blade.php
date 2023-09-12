@extends('layouts/contentLayoutMaster')

@section('title', $pagetitle)

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <h3>{{$pagetitle1}}</h3>
    <p>{{$pagetitle2}}</p>

    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-project-index table">
                <thead class="table-light">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Site</th>
                    <th>FQDN</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->
    <div class="modal modal-slide-in fade" id="modalsslideinform">
        <div class="modal-dialog sidebar-sm">
            <div class="add-new-record modal-content pt-0" id="modal_env_form" name="modalenvform">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="form-label" name="form-label">New Record</h5>
                </div>

                <div class="modal-body flex-grow-1">
                    <form class="needs-validation" novalidate id="envform" name="envform" action="{{route("infra.connector.store")}}" method="POST" accept-charset="UTF-8">
                        <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                        <input class="" name="form_id" id="form_id" value="">
                        <div class="mb-1">
                            <label class="form-label" for="basic-addon-name">Display Name</label>

                            <input
                                type="text"
                                id="basic-addon-name"
                                name="basic_addon_name"
                                pattern="[\w,./_=?-]+"
                                class="form-control"
                                placeholder="e.g. Production"
                                aria-label="Name"
                                required
                                aria-describedby="basic-addon-name"
                            />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter Site display name.</div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-default-display-name">FQDN</label>
                            <input
                                type="text"
                                id="fqdn"
                                name="fqdn"

                                class="form-control"
                                placeholder="Site Server IP or FQDN"
                                aria-label="Display Name"
                                required
                            />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter Server IP or FQDN</div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-default-password">Credential</label>
                            <input
                                type="password"
                                id="basic-default-password"
                                name="basic_default_password"
                                class="form-control"
                                placeholder="Server Credential"
                                minlength="5"
                                required
                            />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter server credential.</div>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('vendor-script')
    <!-- Vendor js files -->
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>

@endsection
@section('page-script')

    <!-- Page js files -->
    <script>
        $(function () {
            'use strict';

            var dataTableProjectIndex = $('.datatables-project-index'),
                assetPath = '../../../app-assets/',
                dt_project_index,
                statusObj = {
                    1: { title: 'Active', class: 'badge-light-success' },
                    0: { title: 'Pending...', class: 'badge-light-warning' },
                },
                projectHome='project/';

            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path');

            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var bootstrapForm = $('.needs-validation');

            if (bootstrapForm.length) {
                Array.prototype.filter.call(bootstrapForm, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            form.classList.add('invalid');
                        }
                        form.classList.add('was-validated');

                        event.preventDefault();
                        if (form.checkValidity() === true) {
                            document.forms["envform"].submit();
                        }

                    });

                });
            }

            $('body').on('click', '.edit', function () {
                var id = $(this).data('id');
                $.ajax({
                    type:"POST",
                    url: "{{ route('infra.connector.edit') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        var color=res.display_icon_colour;
                        $('#modalsslideinform').modal('show');
                        $('#form-label').text("Edit Record");
                        $('#basic-addon-name').val(res.display_name);
                        $('#form_id').val(res.id);
                        $('#fqdn').val(res.server_address);
                        $('#basic-default-password').val();
                        // $('#code').val(res.code);
                        // $('#author').val(res.author);
                    }
                });

            });

            // Users List datatable
            if (dataTableProjectIndex.length) {
                dt_project_index = dataTableProjectIndex.DataTable({

                        ajax: "{{ route('infra.connector') }}", // JSON file to add data
                    columns: [
                        // columns according to JSON
                        { data: '' },
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'display_name' },
                        { data: 'status' },
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
                            targets: 1,
                            visible: true
                        },

                        {
                            // Project Name + link
                            targets: 2,
                            width: '46px',
                            render: function (data, type, full, meta) {
                                var $id = full['id'];
                                var $status_title = full['display_name'];
                                // Creates full output for row
                                var $rowOutput = '<a class="fw-bold edit" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-id="'+$id+'"> ' + $status_title + '</a>';
                                return $rowOutput;
                            }
                        },
                        // {
                        //     // User full name and username
                        //     targets: 3,
                        //     responsivePriority: 4,
                        //     render: function (data, type, full, meta) {
                        //         var $name = full['display_name'],
                        //             $desc = full['display_description'],
                        //             $image = '',
                        //             $images = full['display_icon'],
                        //             $colour = full['display_icon_colour'];
                        //         var $id = full['id'];
                        //         // if ($image) {
                        //         //     // For Avatar image
                        //         //     var $output =
                        //         //         '<img src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" height="32" width="32">';
                        //         // } else {
                        //         // For Avatar badge
                        //         var stateNum = Math.floor(Math.random() * 6) + 1;
                        //         var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        //         var $state = states[stateNum],
                        //             $name = full['name'],
                        //             $initials = $name.match(/\b\w/g) || [];
                        //         $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                        //         var $output = '<span class="avatar-content" ><i data-feather="'+$images+'"></i></span>';
                        //         //}
                        //         var colorClass = $image === '' ? ' bg-light-' + $colour + ' ' : '';
                        //         // Creates full output for row
                        //         var $row_output =
                        //             '<div class="d-flex justify-content-left align-items-center">' +
                        //             '<div class="avatar-wrapper">' +
                        //             '<div class="avatar ' +
                        //             colorClass +
                        //             ' me-1">' +
                        //             $output +
                        //             '</div>' +
                        //             '</div>' +
                        //             '<div class="d-flex flex-column">' +
                        //             '<a href="#" class="user_name text-truncate text-body edit"  data-bs-toggle="tooltip" data-bs-placement="top" data-id="'+$id+'"><span class="fw-bolder">' +
                        //             $name +
                        //             '</span></a>' +
                        //             '<small class="emp_post text-muted">' +
                        //             $desc +
                        //             '</small>' +
                        //             '</div>' +
                        //             '</div>';
                        //         return $row_output;
                        //     }
                        // },
                        {
                            // Project Status
                            targets: 3,
                            orderable: false,
                            render: function (data, type, full, meta) {

                                var $status = full['server_address'];

                                return (
                                    [$status]
                                );
                            }
                        },
                        {
                            // Project Status
                            targets: 4,
                            orderable: false,
                            render: function (data, type, full, meta) {

                                var $status = full['connection_status'];

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
                                return (

                                    '<a class="me-1 edit" href="#" data-bs-toggle="tooltip" data-id="'+$id+'" data-bs-placement="top" title="Edit Server">' +
                                    feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                                    '</a>' +

                                    '<button class="btn btn-sm btn-icon delete-record">' +
                                    feather.icons['trash'].toSvg({ class: 'font-medium-2 text-body' }) +
                                    '</button>'
                                );
                            }
                        }
                    ],
                    order: [[1, 'desc']],
                    dom:
                        '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' +
                        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                        '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f>B>>' +
                        '><"text-nowrap" t>' +
                        '<"d-flex justify-content-between mx-2 row mb-1"' +
                        '<"col-sm-12 col-md-6"i>' +
                        '<"col-sm-12 col-md-6"p>' +
                        '>',

                    // language: {
                    sLengthMenu: 'Show _MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search..',
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    },
                    // Buttons with Dropdown
                    buttons: [
                        {
                            text: 'Create New {{$formtxt}}',
                            className: 'add-new btn btn-primary mt-50',
                            attr: {
                                'data-bs-toggle': 'modal',
                                'data-bs-target': '#modalsslideinform'
                            },
                            action: function (){
                                $('#envform').trigger("reset");
                            },
                            init: function (api, node, config) {
                                $(node).removeClass('btn-secondary');
                            }
                        },

                    ],
                    // For responsive popup
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row) {
                                    var data = row.data();
                                    return 'Details of Permission';
                                }
                            }),
                            type: 'column',
                            renderer: function (api, rowIdx, columns) {
                                var data = $.map(columns, function (col, i) {
                                    return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                        ? '<tr data-dt-row="' +
                                        col.rowIndex +
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

                                return data ? $('<table class="table"/><tbody />').append(data) : false;
                            }
                        }
                    },
                    initComplete: function () {
                        // Adding role filter once table initialized
                        this.api()
                            .columns(3)
                            .every(function () {
                                var column = this;
                                var select = $(
                                    '<select id="UserRole" class="form-select text-capitalize">' +
                                    '<option value=""> Select Status </option>' +
                                    '<option value="Draft" class="text-capitalize">Draft</option>' +
                                    '<option value="Review" class="text-capitalize">Review</option>' +
                                    '<option value="Approve" class="text-capitalize">Approve</option>' +
                                    '<option value="In-Provisioning" class="text-capitalize">In-Provisioning</option>' +
                                    '<option value="Complete" class="text-capitalize">Complete</option></select>'
                                )
                                    .appendTo('.user_role')
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                        column.search(val ? val : '', true, false).draw();
                                    });
                            });
                    }
                });
            }

            // Delete Record
            $('.datatables-project-index tbody').on('click', '.delete-record', function () {
                dt_project_index.row($(this).parents('tr')).remove().draw();
            });

            // Filter form control to default size
            // ? setTimeout used for multilingual table initialization
            setTimeout(() => {
                $('.dataTables_filter .form-control').removeClass('form-control-sm');
                $('.dataTables_length .form-select').removeClass('form-select-sm');
            }, 300);
        });
    </script>
@endsection
