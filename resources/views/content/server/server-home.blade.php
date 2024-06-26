@extends('layouts/contentLayoutMaster')

@section('title', 'Server Instance')

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

    <input type="text" class="hidden" name="_status" id="_status" value="draft">


{{--    <ul class="nav nav-tabs nav-tab-status" role="tablist">--}}
{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link active"--}}
{{--                id="draft-tab"--}}
{{--                data-bs-toggle="tab"--}}
{{--                href="#"--}}
{{--                aria-controls="draft"--}}
{{--                role="tab"--}}
{{--                aria-selected="true"--}}
{{--                text="draft"--}}
{{--                value="draft"--}}
{{--            ><i data-feather="edit"></i> Draft</a--}}
{{--            >--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link"--}}
{{--                id="review-tab"--}}
{{--                data-bs-toggle="tab"--}}
{{--                href="#"--}}
{{--                aria-controls="review"--}}
{{--                role="tab"--}}
{{--                aria-selected="false"--}}
{{--                val--}}
{{--            ><i data-feather="loader"></i> Review</a--}}
{{--            >--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link"--}}
{{--                id="approve-tab"--}}
{{--                data-bs-toggle="tab"--}}
{{--                href="#"--}}
{{--                aria-controls="approve"--}}
{{--                role="tab"--}}
{{--                aria-selected="false"--}}
{{--            ><i data-feather="user"></i> Approve</a--}}
{{--            >--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link"--}}
{{--                id="inProvision-tab"--}}
{{--                data-bs-toggle="tab"--}}
{{--                href="#"--}}
{{--                aria-controls="inProvision"--}}
{{--                role="tab"--}}
{{--                aria-selected="false"--}}
{{--            ><i data-feather="slack"></i> In-Provision</a--}}
{{--            >--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link"--}}
{{--                id="complete-tab"--}}
{{--                data-bs-toggle="tab"--}}
{{--                href="#"--}}
{{--                aria-controls="complete"--}}
{{--                role="tab"--}}
{{--                aria-selected="false"--}}
{{--            ><i data-feather="award"></i> Complete</a--}}
{{--            >--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link"--}}
{{--                id="all-tab"--}}
{{--                data-bs-toggle="tab"--}}
{{--                href="#"--}}
{{--                aria-controls="all"--}}
{{--                role="tab"--}}
{{--                aria-selected="false"--}}
{{--            ><i data-feather="more-horizontal"></i> All</a--}}
{{--            >--}}
{{--        </li>--}}
{{--    </ul>--}}
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-project-index table"  id="memListTable">
                <thead class="table-light">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Hostname</th>
                    <th>status</th>
                    <th>Project Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->

{{--    @include('content/_partials/_modals/modal-create-project')--}}
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
{{--    <script src="{{ asset(mix('js/scripts/pages/modal-create-app.js')) }}"></script>--}}
    <!-- Page js files -->
    <script>

        $(function () {

            'use strict';


            var navTabStatus = document.querySelector('.nav-tab-status');
            $(navTabStatus)
                .find('.nav-link')
                .on('click', function () {
                    // console.log($(this).text());
                    $("input[name=_status]").val($(this).text().toLowerCase());
                    $('#memListTable').DataTable().ajax.reload();
                });

            var dataTableProjectIndex = $('.datatables-project-index'),
                assetPath = '../../../app-assets/',
                dt_project_index,
                statusObj = {
                    1: { title: 'Power On', class: 'badge-light-success' },
                    0: { title: 'Power Off', class: 'badge-light-secondary' },
                },
                projectHome='server/';

            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path');

            }

            // setInterval(function () {
            //
            // }, 5000);
            // Users List datatable
            if (dataTableProjectIndex.length) {
                dt_project_index = dataTableProjectIndex.DataTable({
                    processing: true,
                    serverSide: true,
                    type: 'POST',
                    ajax: {
                        url:"{{ route('server') }}",
                        data:{
                            status: function() { return $("input[name=_status]").val()}
                        }
                    },

                    columns: [
                        // columns according to JSON
                        { data: '' },
                        { data: 'id' },
                        { data: 'title' },
                        { data: 'status' },
                        { data: 'operating_system_option' },
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
                                var $status = full['id'];
                                var $status_title = full['hostname'];
                                // Creates full output for row
                                var $rowOutput = '<a class="fw-bold" href="' + projectHome +$status + '/information"> ' + $status_title + '</a>';
                                return $rowOutput;
                            }
                        },
                        {
                            // Project Status
                            targets: 3,
                            orderable: false,
                            render: function (data, type, full, meta) {

                                var $status = full['vm_power_status'];

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

                                var $project_id = full['id'];
                                return (

                                    '<a class="btn btn-sm btn-icon" href="'+projectHome+ $project_id+'">' +
                                    feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                                    '</i></a>' +
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
                        // {
                        //     text: 'Create New Project',
                        //     className: 'add-new btn btn-primary mt-50',
                        //     attr: {
                        //         'data-bs-toggle': 'modal',
                        //         'data-bs-target': '#createProjectModal'
                        //     },
                        //     init: function (api, node, config) {
                        //         $(node).removeClass('btn-secondary');
                        //     }
                        // },

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
