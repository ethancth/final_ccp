@extends('layouts/contentLayoutMaster')

@section('title', 'Policy')

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/dragula.min.css')) }}">
    <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-drag-drop.css')) }}">
@endsection

@section('content')
    <h3>Form Policy</h3>
    <p>Project Form Policy.</p>

    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-project-index table">
                <thead class="table-light">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Environment</th>
                    <th>Tier</th>
                    <th>OS</th>
                    <th>Mandatory</th>
                    <th>Optional</th>
                    <th>status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->

    @include('content/_partials/_modals/modal-add-edit-policy-form')
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
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/dragula.min.js')) }}"></script>
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
                    0: { title: 'Inactive', class: 'badge-light-warning' },
                    3: { title: 'Approve', class: 'badge-light-primary' },
                    4: { title: 'In-Provisioning', class: 'badge-light-info' },
                    5: { title: 'Complete', class: 'badge-light-success' },
                },
                projectHome='project/';

            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path');

            }
            // Users List datatable
            if (dataTableProjectIndex.length) {
                dt_project_index = dataTableProjectIndex.DataTable({

                    ajax: "{{ route('management_policyform') }}", // JSON file to add data
                    columns: [
                        // columns according to JSON
                        { data: '' },
                        { data: 'id' },
                        { data: 'intro' },
                        { data: 'tier_field' },
                        { data: 'os_field' },
                        { data: 'mandatory_field' },
                        { data: 'optional_field' },
                        { data: 'status' },
                        { data: 'created_at' },
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
                                var $status_title = full['envname'];
                                // Creates full output for row
                                var $rowOutput = '<a class="fw-bold" href="' + projectHome +$status + '"> ' + $status_title + '</a>';
                                return $rowOutput;
                            }
                        },
                        {
                            // Project Status
                            targets: 3,

                            render: function (data, type, full, meta) {

                                return full['tiername'];

                            }
                        },
                        {
                            // Project Status
                            targets: 4,
                            render: function (data, type, full, meta) {

                                return full['osname'];

                            }
                        },
                        {
                            // Project Status
                            targets: 5,
                            orderable: false,
                            render: function (data, type, full, meta) {

                                return full['mandatory_field'];

                            }
                        },{
                            // Project Status
                            targets: 6,
                            orderable: false,
                            render: function (data, type, full, meta) {

                                return full['optional_field'];

                            }
                        },
                        {
                            // Project Status
                            targets: 7,
                            render: function (data, type, full, meta) {

                                var $status = full['status'];

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
                        {
                            text: 'Create New Policy',
                            className: 'add-new btn btn-primary mt-50',
                            attr: {
                                'data-bs-toggle': 'modal',
                                'data-bs-target': '#addNewPolicyModal'
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

            var bootstrapForm = $('.needs-validation'),
                modalFormEnv = $('#modalFormEnv'),
                modalFormTier = $('#modalFormTier'),
                modalFormOs = $('#modalFormOs');

            // --- add new address ----- //

            // Select2 initialization
            if (modalFormEnv.length) {
                modalFormEnv.wrap('<div class="position-relative"></div>').select2({
                    dropdownParent: modalFormEnv.parent()
                });
            }
            if (modalFormTier.length) {
                modalFormTier.wrap('<div class="position-relative"></div>').select2({
                    dropdownParent: modalFormTier.parent()
                });
            }
            if (modalFormOs.length) {
                modalFormOs.wrap('<div class="position-relative"></div>').select2({
                    dropdownParent: modalFormOs.parent()
                });
            }


            dragula([document.getElementById('multiple-list-group-a'), document.getElementById('multiple-list-group-b'), document.getElementById('multiple-list-group-c')]);


            $('body').on('click', '.demo', function () {


                var lis = document.getElementById("multiple-list-group-a").getElementsByTagName("li");
                var temp =[]
                for(let i =0;i<lis.length;i++){
                    temp.push(lis[i].value);
                    console.log(lis[i].value);
                }
                $('#form_group_a').val(temp);


                var lis1 = document.getElementById("multiple-list-group-b").getElementsByTagName("li");
                var temp1 =[]
                for(let i =0;i<lis1.length;i++){
                    temp1.push(lis1[i].value);
                    console.log(lis1[i].value);
                }
                $('#form_group_b').val(temp1);

                Array.prototype.filter.call(bootstrapForm, function (form) {


                    if (form.checkValidity() === false) {
                        form.classList.add('invalid');
                    }
                    form.classList.add('was-validated');


                    if (form.checkValidity() === true) {
                        document.forms["addNewPolicyForm"].submit();
                    }



                });


            });
        });
    </script>
@endsection
