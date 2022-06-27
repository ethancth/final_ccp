@extends('layouts/contentLayoutMaster')

@section('title', 'Project ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/nouislider.min.css')) }}">



@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice-list.css')}}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/modal-create-app.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sliders.css')) }}">
@endsection

@section('content')
<section class="invoice-list-wrapper">
  <div class="card">
    <div class="card-datatable table-responsive">
      <table class="invoice-list-table table">
        <thead>
          <tr>
            <th></th>
            <th>#</th>
            <th><i data-feather="trending-up"></i></th>
            <th>Server </th>
            <th>Compute</th>
            <th class="text-truncate">Created Date</th>
            <th>Cost</th>
            <th>Invoice Status</th>
            <th class="cell-fit">Actions</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</section>

@include('content/_partials/_modals/modal-create-app')
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>



<script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/nouislider.min.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/pages/modal-create-app.js')) }}"></script>
@endsection

@section('page-script')
<script>
    $(function () {
        'use strict';

        var dtInvoiceTable = $('.invoice-list-table'),
            assetPath = '../../../app-assets/',
            invoicePreview = 'app-invoice-preview.html',
            invoiceAdd = 'app-invoice-add.html',
            invoiceEdit = 'app-invoice-edit.html';

        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
            invoicePreview = assetPath + 'app/invoice/preview';
            invoiceAdd = assetPath + 'app/invoice/add';
            invoiceEdit = assetPath + 'app/invoice/edit';
        }


        // datatable
        if (dtInvoiceTable.length) {
            var dtInvoice = dtInvoiceTable.DataTable({
                //ajax: assetPath + 'data/invoice-list.json', // JSON file to add data
                ajax: assetPath + '{{ route('project.show',$project->id) }}',
                autoWidth: false,
                columns: [
                    // columns according to JSON
                    { data: 'responsive_id' },
                    { data: 'invoice_id' },
                    { data: 'invoice_status' },
                    { data: 'issued_date' },
                    { data: 'client_name' },
                    { data: 'total' },
                    { data: 'balance' },
                    { data: 'invoice_status' },
                    { data: '' }
                ],
                columnDefs: [
                    {
                        // For Responsive
                        className: 'control',
                        responsivePriority: 2,
                        targets: 0
                    },
                    {
                        // Invoice ID
                        targets: 1,
                        width: '46px',
                        render: function (data, type, full, meta) {
                            var $invoiceId = full['invoice_id'];
                            // Creates full output for row
                            var $rowOutput = '<a class="fw-bold" href="' + invoicePreview + '"> #' + $invoiceId + '</a>';
                            return $rowOutput;
                        }
                    },
                    {
                        // Invoice status
                        targets: 2,
                        width: '42px',
                        render: function (data, type, full, meta) {
                            var $invoiceStatus = full['invoice_status'],
                                $dueDate = full['due_date'],
                                $balance = full['balance'],
                                roleObj = {
                                    Sent: { class: 'bg-light-secondary', icon: 'send' },
                                    Paid: { class: 'bg-light-success', icon: 'check-circle' },
                                    Draft: { class: 'bg-light-primary', icon: 'save' },
                                    Downloaded: { class: 'bg-light-info', icon: 'arrow-down-circle' },
                                    'Past Due': { class: 'bg-light-danger', icon: 'info' },
                                    'Partial Payment': { class: 'bg-light-warning', icon: 'pie-chart' }
                                };
                            return (
                                "<span data-bs-toggle='tooltip' data-bs-html='true' title='<span>" +
                                $invoiceStatus +
                                '<br> <span class="fw-bold">Balance:</span> ' +
                                $balance +
                                '<br> <span class="fw-bold">Due Date:</span> ' +
                                $dueDate +
                                "</span>'>" +
                                '<div class="avatar avatar-status ' +
                                roleObj[$invoiceStatus].class +
                                '">' +
                                '<span class="avatar-content">' +
                                feather.icons[roleObj[$invoiceStatus].icon].toSvg({ class: 'avatar-icon' }) +
                                '</span>' +
                                '</div>' +
                                '</span>'
                            );
                        }
                    },
                    {
                        // Client name and Service
                        targets: 3,
                        responsivePriority: 4,
                        width: '270px',
                        render: function (data, type, full, meta) {
                            var $name = full['client_name'],
                                $email = full['email'],
                                $image = full['avatar'],
                                stateNum = Math.floor(Math.random() * 6),
                                states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
                                $state = states[stateNum],
                                $name = full['client_name'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                           // if ($image) {
                                // For Avatar image
                               // var $output =
                              //      '<img  src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" width="32" height="32">';
                            //} else {
                                // For Avatar badge
                                var  $output = '<div class="avatar-content">' + $initials + '</div>';
                           // }
                            // Creates full output for row
                            var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : ' ';

                            var $rowOutput =
                                '<div class="d-flex justify-content-left align-items-center">' +
                                '<div class="avatar-wrapper">' +
                                '<div class="avatar' +
                                colorClass +
                                'me-50">' +
                                $output +
                                '</div>' +
                                '</div>' +
                                '<div class="d-flex flex-column">' +
                                '<h6 class="user-name text-truncate mb-0">' +
                                $name +
                                '</h6>' +
                                '<small class="text-truncate text-muted">' +
                                $email +
                                '</small>' +
                                '</div>' +
                                '</div>';
                            return $rowOutput;
                        }
                    },
                    {
                        // Total Invoice Amount
                        targets: 4,
                        width: '73px',
                        render: function (data, type, full, meta) {
                            var $total = full['total'];
                            return '<span class="d-none">' + $total + '</span>$' + $total;
                        }
                    },
                    {
                        // Due Date
                        targets: 5,
                        width: '130px',
                        render: function (data, type, full, meta) {
                            var $dueDate = new Date(full['due_date']);
                            // Creates full output for row
                            var $rowOutput =
                                '<span class="d-none">' +
                                moment($dueDate).format('YYYYMMDD') +
                                '</span>' +
                                moment($dueDate).format('DD MMM YYYY');
                            $dueDate;
                            return $rowOutput;
                        }
                    },
                    {
                        // Client Balance/Status
                        targets: 6,
                        width: '98px',
                        render: function (data, type, full, meta) {
                            var $balance = full['balance'];
                            if ($balance === 0) {
                                var $badge_class = 'badge-light-success';
                                return '<span class="badge rounded-pill ' + $badge_class + '" text-capitalized> Paid </span>';
                            } else {
                                return '<span class="d-none">' + $balance + '</span>' + $balance;
                            }
                        }
                    },
                    {
                        targets: 7,
                        visible: false
                    },
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        width: '80px',
                        orderable: false,
                        render: function (data, type, full, meta) {
                            return (
                                '<div class="d-flex align-items-center col-actions">' +
                                '<a class="me-1" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Mail">' +
                                feather.icons['send'].toSvg({ class: 'font-medium-2 text-body' }) +
                                '</a>' +
                                '<a class="me-25" href="' +
                                invoicePreview +
                                '" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview Invoice">' +
                                feather.icons['eye'].toSvg({ class: 'font-medium-2 text-body' }) +
                                '</a>' +
                                '<div class="dropdown">' +
                                '<a class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                                feather.icons['more-vertical'].toSvg({ class: 'font-medium-2 text-body' }) +
                                '</a>' +
                                '<div class="dropdown-menu dropdown-menu-end">' +
                                '<a href="#" class="dropdown-item">' +
                                feather.icons['download'].toSvg({ class: 'font-small-4 me-50' }) +
                                'Download</a>' +
                                '<a href="' +
                                invoiceEdit +
                                '" class="dropdown-item">' +
                                feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                                'Edit</a>' +
                                '<a href="#" class="dropdown-item">' +
                                feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) +
                                'Delete</a>' +
                                '<a href="#" class="dropdown-item">' +
                                feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) +
                                'Duplicate</a>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            );
                        }
                    }
                ],
                order: [[1, 'desc']],
                dom:
                    '<"row d-flex justify-content-between align-items-center m-1"' +
                    '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons_new text-xl-end text-lg-start text-lg-end text-start "B>>' +
                    '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
                    '>t' +
                    '<"d-flex justify-content-between mx-2 row"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',
                language: {
                    sLengthMenu: 'Show _MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search Server',
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                // Buttons with Dropdown
                buttons: [
                    {
                        text: 'Add Record',
                        //className: 'btn btn-primary btn-add-record ms-2',
                        className: 'btn btn-primary waves-effect waves-float waves-light',
                        // action: function (e, dt, button, config) {
                        //     window.location = invoiceAdd;
                        // }



                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#createAppModal'
                        }
                    }
                ],
                buttons_new: [
                    {
                        text: 'Add Record1',
                        className: 'btn btn-primary btn-add-record ms-2',
                        action: function (e, dt, button, config) {
                            window.location = invoiceAdd;
                        }
                    }
                ],
                // For responsive popup
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details of ' + data['client_name'];
                            }
                        }),
                        type: 'column',
                        renderer: function (api, rowIdx, columns) {
                            var data = $.map(columns, function (col, i) {
                                return col.columnIndex !== 2 // ? Do not show row in modal popup if title is blank (for check box)
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
                initComplete: function () {
                    $(document).find('[data-bs-toggle="tooltip"]').tooltip();
                    // Adding role filter once table initialized
                    this.api()
                        .columns(7)
                        .every(function () {
                            var column = this;
                            var select = $(
                                '<select id="UserRole" class="form-select ms-50 text-capitalize"><option value=""> Select Status </option></select>'
                            )
                                .appendTo('.invoice_status')
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
                },
                drawCallback: function () {
                    $(document).find('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        }
    });

</script>
@endsection

