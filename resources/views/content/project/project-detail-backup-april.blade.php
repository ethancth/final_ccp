@extends('layouts/contentLayoutMaster')

@section('title', 'Project ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/nouislider.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/dragula.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">


@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice-list.css')}}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/modal-create-app.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sliders.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-todo.css')) }}">

    {{--sweetalert--}}
<link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>{{$project->projectstatus}} - {{$project->title}}  </h1>
                <h6>created by  {{$project->ownername->name}}</h6>
                <hr class="mb-2" />
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text">Total - {{$project->server->count()}} Server</h6>

                        </div>

                        <div>
                            <h6 class="text">Daily Cost -  <span class="badge badge-light-success profile-badge">$ {{$project->price}}</span> </h6>

                        </div>
                    </div>

                </div>

                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text">Tier -
                                @foreach($project->server()->distinct()->get(['display_tier'])  as $_value)
                                <span class="badge badge-light-success profile-badge">{{$_value->display_tier}}</span>
                                </span>
                                @endforeach
                            </h6>
                            <h6 class="text">Environment -   @foreach($project->server()->distinct()->get(['display_env'])  as $_value)
                                    <span class="badge badge-light-success profile-badge">{{$_value->display_env}}</span>
                                    </span>
                                @endforeach

                            </h6>

                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">CPU</h6>
                            <h3 class="mb-0">{{$project->server->sum('v_cpu')}} </h3>
                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">Memory</h6>
                            <h3 class="mb-0">{{$project->server->sum('v_memory')}} GB</h3>
                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">Storage</h6>
                            <h3 class="mb-0">{{$project->server->sum('total_storage')}} GB</h3>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>
<section class="invoice-list-wrapper">
  <div class="card">
    <div class="card-datatable table-responsive" id="ListTable">
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
@include('content/_partials/_modals/modal-project-activity')
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

<script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/dragula.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-todo.js')) }}"></script>

{{--sweetalert--}}
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
<script>
    $(function () {
        'use strict';

        var direction = 'ltr';
        if ($('html').data('textdirection') == 'rtl') {
            direction = 'rtl';
        }
        var select = $('.select2'),
            selectSaM = $('.select2-data-array-mandatory'),
            selectSaO = $('.select2-data-array-optional');


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

        selectSaO.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: selectSaO.parent(),
            placeholder: 'Select an item',
            width: '100%',
            ajax: {
                url: "/filter-policy-form",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        //myData: params.term, // search term
                        env:$("input[type='radio'].radioEnv:checked").val(),
                        tier:$("input[type='radio'].radioTier:checked").val(),
                        os:$('#operatingsystem').val(),
                        ftype:'getOptional',
                    };
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.display_name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        function checksa(){


            let $resule;
            $resule=true;

                if($('#operatingsystem').val() === $('#o_server_os').val())
                {
                }else{
                    $resule=false

                }
            if( $("input[type='radio'].radioEnv:checked").val() === $('#o_server_env').val())
            {
            }else{
                $resule=false

            }
            if($("input[type='radio'].radioTier:checked").val() === $('#o_server_tier').val())
            {

            }else{
                $resule=false
            }
            if(!$resule){
                $('#select_sa_optional').val([]).trigger("change");
                $('#select_sa_optional').trigger('change');
            }else{

            }



        }

        function ajax_getSAM(){
            checksa()
            $.ajax({
                type:"get",
                url: "{{ route('filter_policy') }}",
                data: {
                    env:$("input[type='radio'].radioEnv:checked").val(),
                    tier:$("input[type='radio'].radioTier:checked").val(),
                    os:$('#operatingsystem').val(),
                    ftype:'getMandatoryField',
                },
                dataType: 'json',
                success: function(res){
                    //console.log(res);

                     $('#sa_m').val(res.id);
                    input_sam.innerText = res.name;
                    input_sam_1.innerText = res.name;

                }
            });
        }


        var modernVerticalWizard = document.querySelector('.create-app-wizard'),
            createAppModal = document.getElementById('createAppModal'),
            assetsPath = '../../../app-assets/',
            pipsRangevCPU = document.getElementById('pips-range-vcpu'),
            pipsRangevMemory = document.getElementById('pips-range-vmemory'),
            pipsRangevstorage = document.getElementById('pips-range-vstorage');

        if ($('body').attr('data-framework') === 'laravel') {
            assetsPath = $('body').attr('data-asset-path');
        }

        // --- create app  ----- //
        if (typeof modernVerticalWizard !== undefined && modernVerticalWizard !== null) {
            var modernVerticalStepper = new Stepper(modernVerticalWizard, {
                    linear: true
                }),
                $form = $(createAppModal).find('form');
            $form.each(function () {
                var $this = $(this);
                $this.validate({
                    rules: {
                        servername: {
                            required: true
                        },
                        'operatingsystem': {
                            required: true
                        },
                        createAppDevelopment:{
                            required:true
                        },
                    }
                });
            });


            $(modernVerticalWizard)
                .find('.btn-next')
                .each(function () {
                    $(this).on('click', function (e) {
                        var isValid = $(this).parent().siblings('form').valid();
                        if (isValid) {
                            modernVerticalStepper.next();
                        } else {
                            e.preventDefault();
                        }
                    });
                });


            $(modernVerticalWizard)
                .find('.btn-prev')
                .on('click', function () {
                    modernVerticalStepper.previous();
                });

            $(modernVerticalWizard)
                .find('.btn-review')
                .on('click', function () {
                    ajax_getSAM();
                    // var vmos=document.getElementsByName('');

                    var get_radio_environment = $("input[type='radio'].radioEnv:checked").val();
                    var get_radio_tier = $("input[type='radio'].radioTier:checked").val();
                    var get_radio_os = $("input[type='radio'].osradio:checked").val();
                    var v_storage=pipsRangevstorage.noUiSlider.get();
                    document.getElementById("hostname").value = $("input[name=servername]").val();
                    document.getElementById("environement").value = get_radio_environment;
                    document.getElementById("tier").value = get_radio_tier;
                    document.getElementById("operating_system").value = $('#operatingsystem').val();
                    //document.getElementById("operating_system_option").value = get_radio_os;
                    document.getElementById("v_cpu").value = pipsRangevCPU.noUiSlider.get();
                    document.getElementById("v_memory").value = pipsRangevMemory.noUiSlider.get();
                    document.getElementById("total_storage").value = pipsRangevstorage.noUiSlider.get();
                    input_environment.innerText =  $("input[type='radio'].radioEnv:checked").attr('text');
                    input_tier.innerText = $("input[type='radio'].radioTier:checked").attr('text');
                    input_hostname.innerText = $("input[name=servername]").val();
                    input_prefer_os.innerText = $('#operatingsystem :selected').text();
                    input_vcpu.innerText = pipsRangevCPU.noUiSlider.get()+ " vCpu ";
                    input_vmemory.innerText = pipsRangevMemory.noUiSlider.get()+ "GB vMemory";
                    input_vstorage.innerText = pipsRangevstorage.noUiSlider.get()+"GB Storage";
                });

            $(modernVerticalWizard)
                .find('.btn-service')
                .on('click', function () {
                    let $data;
                    $data=$("#select_sa_optional").select2('val');
                    $('#sa_o').val($data);
                    ajax_getSAName();
                    ajax_getCost();


                   // console.log($('#operatingsystem').find(':selected'));
                    // alert('Submitted..!!');
                });

            function ajax_getSAName(){
                $.ajax({
                    type:"get",
                    url: "{{ route('service_name') }}",
                    data: {
                        sa:''+$("#select_sa_optional").select2('val')+''
                    },
                    dataType: 'json',
                    success: function(res){
                        //console.log(res);
                        input_sao.innerText = res.name;


                    }
                });
            }



            function ajax_getCost(){
                $.ajax({
                    type:"get",
                    url: "{{ route('server_cost') }}",
                    data: {
                        sao:''+$("#select_sa_optional").select2('val')+'',
                        env:$("input[type='radio'].radioEnv:checked").val(),
                        tier:$("input[type='radio'].radioTier:checked").val(),
                        os:$('#operatingsystem').val(),
                        cpu:$('#v_cpu').val(),
                        mem:$('#v_memory').val(),
                        storage:$('#total_storage').val(),
                    },
                    dataType: 'json',
                    success: function(res){
                        //console.log(res);
                        input_cost.innerText ="$ "+ res.cost;
                        $('#cost').val(res.cost);


                    }
                });
            }

            $(modernVerticalWizard)
                .find('.btn-submit')
                .on('click', function () {
                    // var vmos=document.getElementsByName('');

                    document.forms["projectstoreserver"].submit();
                    // alert('Submitted..!!');
                });


            // reset wizard on modal hide
            createAppModal.addEventListener('hide.bs.modal', function (event) {
                modernVerticalStepper.to(1);
            });
        }

        if (typeof pipsRangevCPU !== undefined && pipsRangevCPU !== null) {
            // Range
            noUiSlider.create(pipsRangevCPU, {
                start: 4,
                step: 2,
                range: {
                    min: {{$costprofile[0]->form_vcpu_min}},
                    max: {{$costprofile[0]->form_vcpu_max}}
                },
                tooltips: true,
                direction: direction,
                pips: {
                    mode: 'steps',
                    stepped: true,
                    density: 5
                },
                format: {
                    to: (v) => parseFloat(v).toFixed(0),
                    from: (v) => parseFloat(v).toFixed(0)
                }
            });
        }

        if (typeof pipsRangevMemory !== undefined && pipsRangevMemory !== null) {
            // Range
            noUiSlider.create(pipsRangevMemory, {
                start: 2,
                step: 4,
                range: {
                    min: {{$costprofile[0]->form_vmen_min}},
                    max: {{$costprofile[0]->form_vmen_max}}
                },
                tooltips: true,
                direction: direction,
                pips: {
                    mode: 'steps',
                    stepped: false,
                    density: 5
                },format: {
                    to: (v) => parseFloat(v).toFixed(0),
                    from: (v) => parseFloat(v).toFixed(0)
                }
            });
        }

        if (typeof pipsRangevstorage !== undefined && pipsRangevstorage !== null) {
            // Range
            noUiSlider.create(pipsRangevstorage, {
                start: 100,
                step: 50,
                range: {
                    min: {{$costprofile[0]->form_vstorage_min}},
                    max: {{$costprofile[0]->form_vstorage_max}}
                },
                tooltips: true,
                format: {
                    to: (v) => parseFloat(v).toFixed(0),
                    from: (v) => parseFloat(v).toFixed(0)
                }
            });
        }


        const uppercaseWords = str => str.replace(/^(.)|\s+(.)/g, c => c.toUpperCase());
        var dtInvoiceTable = $('.invoice-list-table'),
            assetPath = '../../../app-assets/',
            invoicePreview = '/project',
            invoiceAdd = '/project',
            invoiceEdit = '/project';

        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
            invoicePreview = assetPath + 'project';
            invoiceAdd = assetPath + '#';
            invoiceEdit = assetPath + '#';
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');
            var pipsRangevCPU = document.getElementById('pips-range-vcpu');
            var  pipsRangevMemory = document.getElementById('pips-range-vmemory');
            var pipsRangevstorage = document.getElementById('pips-range-vstorage');
            $.ajax({
                type:"POST",
                url: "{{ route('project.editserver') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    // $('#ajaxBookModel').html("Edit Book");
                    $('#createAppModal').modal('show');
                     $('#servername').val(res.hostname);
                     $('#server_id').val(res.id);
                     $('#operatingsystem').val(res.operating_system);
                     $('#o_server_os').val(res.operating_system);
                     $('#o_server_env').val(res.environment);
                    document.getElementById("o_server_env").checked = true;
                     $('#o_server_tier').val(res.tier);
                     $('#operatingsystem').val(res.operating_system);
                    $('#operatingsystem').select2();
                    // $('#select_sa_optional').val(res.optional_sa_field);
                    // $('#select_sa_optional').select2();

                    if(res.optional_sa_field.length>0){
                        $('#select_sa_optional').val(res.optional_sa_field.split(',')).trigger("change");
                        $('#select_sa_optional').trigger('change');
                    }

                    $("#createApp"+uppercaseWords(res.environment)).prop("checked", true);
                    $("#createTier"+uppercaseWords(res.tier)).prop("checked", true);
                    //$("#createApp"+uppercaseWords(res.operating_system_option)).prop("checked", true);
                    pipsRangevCPU.noUiSlider.set(res.v_cpu);
                    pipsRangevMemory.noUiSlider.set(res.v_memory);
                    pipsRangevstorage.noUiSlider.set(res.total_storage);

                    // $('#title').val(res.title);
                    // $('#code').val(res.code);
                    // $('#author').val(res.author);
                }
            });

        });

        $('body').on('click', '.delete', function () {


            var dt_field=$(this).parents('tr');
            var id= $(this).data('id')
            // sweetalert for confirmation of delete
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'

                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    // delete the data
                    var APP_URL = {!! json_encode(url('/')) !!};
                    // console.log(`${APP_URL}/project/${id}`);
                    $.ajax({

                        type: 'POST',
                        url: "{{ route('project.delete') }}",
                        data: { id: id },
                        success: function () {
                            dtInvoice.row(dt_field).remove().draw();

                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });

                    // success sweetalert
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The Project has been deleted!',
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

            {{--if (confirm("Delete Record?") == true) {--}}
            {{--    var id = $(this).data('id');--}}

            {{--    // ajax--}}
            {{--    $.ajax({--}}
            {{--        type:"POST",--}}
            {{--        url: "{{ route('project.delete') }}",--}}
            {{--        data: { id: id },--}}
            {{--        dataType: 'json',--}}
            {{--        success: function(res){--}}
            {{--            dtInvoice.draw();--}}
            {{--           // window.setTimeout( window.location.reload(), 3000 );--}}

            {{--        }--}}
            {{--    });--}}
            {{--}--}}

        });


        // datatable
        if (dtInvoiceTable.length) {
            var dtInvoice = dtInvoiceTable.DataTable({
                    processing: true,
                //ajax: assetPath + 'data/invoice-list.json', // JSON file to add data
                ajax:'{{ route('project.show',$project->id) }}',
                autoWidth: false,
                columns: [
                    // columns according to JSON
                    { data: 'id' },
                    { data: 'project_id' },
                    { data: 'environment' },
                    { data: 'created_at' },
                    { data: 'hostname' },
                    { data: 'total_storage' },
                    { data: 'environment' },
                    { data: 'environment' },
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
                        // Project ID
                        targets: 1,
                        width: '46px',
                        visible:false,
                        render: function (data, type, full, meta) {
                            var $invoiceId = full['id'];
                            // Creates full output for row
                            var $rowOutput = '<a class="fw-bold" href="' + invoicePreview + '"> #' + $invoiceId + '</a>';
                            return $rowOutput;
                        }
                    },
                    {
                        // environment
                        targets: 2,
                        width: '42px',
                        render: function (data, type, full, meta) {
                            var $invoiceStatus = full['environment'],
                             $field_environment = full['display_env'],
                                $field_tier = full['display_tier'],
                                $dueDate = full['created_at'],
                                $balance = full['price'],
                                roleObj = {
                                    @foreach($forms as $form)
                                        @foreach($form->envform as $envforms)
                                        {{$envforms->id}}: {{"{class:"}}'bg-light-{{$envforms->display_icon_colour}}', icon:'{{$envforms->display_icon}}'},
                                        @endforeach
                                    @endforeach
                                    // production: { class: 'bg-light-info', icon: 'briefcase' },
                                    // development: { class: 'bg-light-danger', icon: 'sliders' },
                                    // staging: { class: 'bg-light-success', icon: 'layers' },
                                    // Downloaded: { class: 'bg-light-info', icon: 'arrow-down-circle' },
                                    // 'Past Due': { class: 'bg-light-danger', icon: 'info' },
                                    // 'Partial Payment': { class: 'bg-light-warning', icon: 'pie-chart' },
                                };
                            return (
                                "<span data-bs-toggle='tooltip' data-bs-html='true' title='<span>Detail: " +
                                '<br> <span class="fw-bold">Environment:</span> ' +$field_environment+
                                '<br> <span class="fw-bold">Tier:</span> ' +$field_tier+
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
                        width: '130px',
                        render: function (data, type, full, meta) {
                            var $name = full['hostname'],
                                $email = full['display_os'],
                                $image = full['operating_system_option']+'.png',
                                stateNum = Math.floor(Math.random() * 6),
                                states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
                                $state = states[stateNum],
                                $name = full['hostname'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                           // if ($image) {
                                // For Avatar image
                                var $output =
                                    '<img  src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" width="32" height="32">';
                            //} else {
                                // For Avatar badge
                                //var  $output = '<div class="avatar-content">' + $initials + '</div>';
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
                        width: '120px',
                        render: function (data, type, full, meta) {
                            var $v_cpu = full['v_cpu'];
                            var $v_memory = full['v_memory'];
                            var $total_storage = full['total_storage'];
                            var $total = full['price'];
                            return '<span class="d-none">' + $total + '</span>' + $v_cpu + ' vCPU '+' <p style=" margin-bottom: 0px; ">'+$v_memory + ' GB vMemory '+'</p><p style=" margin-bottom: 0px; ">' +
                                $total_storage + ' GB Storage'+
                            '</p>' ;
                        }
                    },
                    {
                        // Due Date
                        targets: 5,
                        width: '130px',
                        render: function (data, type, full, meta) {
                            var $dueDate = new Date(full['created_at']);
                            // Creates full output for row
                            var $rowOutput =
                                '<span class="d-none">' +
                                moment($dueDate).format('YYYYMMDD') +
                                '</span>' +
                                moment($dueDate).format('DD MMM YYYY');
                            $dueDate;
                            return $rowOutput;
                        }
                    },{
                        // Total Invoice Amount
                        targets: 6,
                        width: '73px',
                        render: function (data, type, full, meta) {
                            var $total = full['price'];
                            return '<span class="d-none">' + $total + '</span>$' + $total;
                        }
                    },
                    // {
                    //     // Client Balance/Status
                    //     targets: 6,
                    //     width: '98px',
                    //     render: function (data, type, full, meta) {
                    //         var $balance = full['price'];
                    //         if ($balance === 0) {
                    //             var $badge_class = 'badge-light-success';
                    //             return '<span class="badge rounded-pill ' + $badge_class + '" text-capitalized> Paid </span>';
                    //         } else {
                    //             return '<span class="d-none">' + $balance + '</span>' + $balance;
                    //         }
                    //     }
                    // },

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
                            var $id = full['id'];
                            return (
                                '<div class="d-flex align-items-center col-actions">' +
                                '<a class="me-1 edit" href="#" data-bs-toggle="tooltip" data-id="'+$id+'" data-bs-placement="top" title="Edit Server">' +
                                feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                                '</a>' +
                                '<a class="me-25 delete" href="#" data-bs-toggle="tooltip"  data-id="'+$id+'" data-bs-placement="top" title="Delete">' +
                                feather.icons['trash'].toSvg({ class: 'font-medium-2 text-body' }) +
                                '</a>' +
                                // '<div class="dropdown">' +
                                // '<a class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                                // feather.icons['more-vertical'].toSvg({ class: 'font-medium-2 text-body' }) +
                                // '</a>' +
                                // '<div class="dropdown-menu dropdown-menu-end">' +
                                // '<a href="#" class="dropdown-item">' +
                                // feather.icons['download'].toSvg({ class: 'font-small-4 me-50' }) +
                                // 'Download</a>' +
                                // '<a href="#" class="dropdown-item edit" data-id="'+$id+'">' +
                                // feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                                // 'Edit</a>' +
                                // '<a href="#" class="dropdown-item">' +
                                // feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) +
                                // 'Delete</a>' +
                                // '<a href="#" class="dropdown-item">' +
                                // feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) +
                                // 'Duplicate</a>' +
                                // '</div>' +
                                // '</div>' +
                                '</div>'
                            );
                        }
                    }
                ],
                order: [[1, 'desc']],
                dom:
                    '<"row d-flex justify-content-between align-items-center m-1"' +
                    '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons_new text-xl-end text-lg-start text-lg-end text-start " B>>' +
                    '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<" ms-sm-2 width-10 "><"submit_button mt-50 width-2 me-1">>' +
                    '>t' +
                    '<"d-flex justify-content-between mx-2 row"' +
                    '<"col-sm-12 col-md-6"i>' +
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
                        @if($project->status==1 && $project->owner==Auth::id())
                        {
                        text: 'Add Server',
                        //className: 'btn btn-primary btn-add-record ms-2',
                        className: 'btn btn-primary waves-effect waves-float waves-light',
                        // action: function (e, dt, button, config) {
                        //     window.location = invoiceAdd;
                        // }
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#createAppModal',
                            'style':'margin-top:10px'
                        },
                        action: function (){
                            $('#create-app-page1').trigger("reset");
                            $('#create-app-page2').trigger("reset");
                            $('#create-app-page3').trigger("reset");
                            $('#create-app-page4').trigger("reset");
                        }
                        //$('#addEditBookForm').trigger("reset");
                    },

                    {
                        text: 'Submit Project',
                        //className: 'btn btn-primary btn-add-record ms-2',
                        className: 'btn btn-success waves-effect waves-float waves-light',
                        // action: function (e, dt, button, config) {
                        //     window.location = invoiceAdd;
                        // }
                        style: {

                        },

                        attr: {
                            'id':'confirm-text',
                            // 'data-bs-toggle': 'modal',
                            // 'data-bs-target': '#project-submit-modal',
                             'style':'margin-top:10px'
                        },
                        action: function () {

                            if ({{(count($project->server))}} > 0){
                                Swal.fire({
                                    title: 'Are you sure? ',
                                    text: "Submit this project and get review!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, Submit it!',
                                    customClass: {
                                        confirmButton: 'btn btn-primary',
                                        cancelButton: 'btn btn-outline-danger ms-1'
                                    },
                                    buttonsStyling: false
                                }).then(function (result) {
                                    if (result.value) {
                                        var $projectid = {{$project->id}};
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ route('project.submit') }}",
                                            data: {id: $projectid},
                                            dataType: 'json',
                                            success: function (res) {
                                                Swal.fire({

                                                    icon: 'success',
                                                    title: 'Submitted!',
                                                    text: 'Your Project has been Submitted.',
                                                    customClass: {
                                                        confirmButton: 'btn btn-success'
                                                    }
                                                })
                                                window.location.reload();
                                            }
                                        })

                                    }
                                });
                        }else{
                                Swal.fire({
                                    title: '',
                                    text: "Please create one server before submit",
                                    icon: 'warning',
                                    confirmButtonText: 'Ok, i got it!',
                                    customClass: {
                                        confirmButton: 'btn btn-primary',
                                        cancelButton: 'btn btn-outline-danger ms-1'
                                    },
                                    buttonsStyling: false
                                })
                            }
                        }
                        //$('#addEditBookForm').trigger("reset");
                    },
                    @endif


                        @if($project->status==2&&Auth::user()->hasPermissionTo('approver_reject_level_1'))

                    {
                        text: 'Approve Project',
                        //className: 'btn btn-primary btn-add-record ms-2',
                        className: 'btn btn-success waves-effect waves-float waves-light',
                        // action: function (e, dt, button, config) {
                        //     window.location = invoiceAdd;
                        // }
                        style: {

                        },

                        attr: {
                            'id':'confirm-text',
                            // 'data-bs-toggle': 'modal',
                            // 'data-bs-target': '#project-submit-modal',
                            'style':'margin-top:10px'
                        },
                        action: function (){
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Approve this project!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, Approve it!',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-outline-danger ms-1'
                                },
                                buttonsStyling: false
                            }).then(function (result) {
                                if (result.value) {
                                    var $projectid={{$project->id}};
                                    $.ajax({
                                        type:"POST",
                                        url: "{{ route('project.approve') }}",
                                        data: { id: $projectid },
                                        dataType: 'json',
                                        success: function(res){
                                            Swal.fire({

                                                icon: 'success',
                                                title: 'Approved!',
                                                text: 'This Project has been Approved!.',
                                                customClass: {
                                                    confirmButton: 'btn btn-success'
                                                }
                                            })
                                            window.location.reload();
                                        }
                                    })

                                }
                            });
                        }
                        //$('#addEditBookForm').trigger("reset");
                    },{
                        text: 'Reject Project',
                        //className: 'btn btn-primary btn-add-record ms-2',
                        className: 'btn btn-warning waves-effect waves-float waves-light',
                        // action: function (e, dt, button, config) {
                        //     window.location = invoiceAdd;
                        // }
                        style: {

                        },

                        attr: {
                            'id':'confirm-text',
                            // 'data-bs-toggle': 'modal',
                            // 'data-bs-target': '#project-submit-modal',
                            'style':'margin-top:10px'
                        },
                        action: function (){
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Reject this project!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, Reject it!',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-outline-danger ms-1'
                                },
                                buttonsStyling: false
                            }).then(function (result) {
                                if (result.value) {
                                    var $projectid={{$project->id}};
                                    $.ajax({
                                        type:"POST",
                                        url: "{{ route('project.reject') }}",
                                        data: { id: $projectid },
                                        dataType: 'json',
                                        success: function(res){
                                            Swal.fire({

                                                icon: 'success',
                                                title: 'Reject!',
                                                text: 'This Project has been Reject!.',
                                                customClass: {
                                                    confirmButton: 'btn btn-success'
                                                }
                                            })
                                            window.location.reload();
                                        }
                                    })

                                }
                            });
                        }
                        //$('#addEditBookForm').trigger("reset");
                    },
                        @endif

                        @if($project->status==3&&Auth::user()->hasPermissionTo('approver_reject_level_2'))

                    {
                        text: 'Approve Project',
                        //className: 'btn btn-primary btn-add-record ms-2',
                        className: 'btn btn-success waves-effect waves-float waves-light',
                        // action: function (e, dt, button, config) {
                        //     window.location = invoiceAdd;
                        // }
                        style: {

                        },

                        attr: {
                            'id':'confirm-text',
                            // 'data-bs-toggle': 'modal',
                            // 'data-bs-target': '#project-submit-modal',
                            'style':'margin-top:10px'
                        },
                        action: function (){
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Approve this project!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, Approve it!',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-outline-danger ms-1'
                                },
                                buttonsStyling: false
                            }).then(function (result) {
                                if (result.value) {
                                    var $projectid={{$project->id}};
                                    $.ajax({
                                        type:"POST",
                                        url: "{{ route('project.approve.lv2') }}",
                                        data: { id: $projectid },
                                        dataType: 'json',
                                        success: function(res){
                                            Swal.fire({

                                                icon: 'success',
                                                title: 'Approved!',
                                                text: 'This Project has been Approved!.',
                                                customClass: {
                                                    confirmButton: 'btn btn-success'
                                                }
                                            })
                                            window.location.reload();
                                        }
                                    })

                                }
                            });
                        }
                        //$('#addEditBookForm').trigger("reset");
                    },{
                        text: 'Reject Project',
                        //className: 'btn btn-primary btn-add-record ms-2',
                        className: 'btn btn-warning waves-effect waves-float waves-light',
                        // action: function (e, dt, button, config) {
                        //     window.location = invoiceAdd;
                        // }
                        style: {

                        },

                        attr: {
                            'id':'confirm-text',
                            // 'data-bs-toggle': 'modal',
                            // 'data-bs-target': '#project-submit-modal',
                            'style':'margin-top:10px'
                        },
                        action: function (){
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Reject this project!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, Reject it!',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-outline-danger ms-1'
                                },
                                buttonsStyling: false
                            }).then(function (result) {
                                if (result.value) {
                                    var $projectid={{$project->id}};
                                    $.ajax({
                                        type:"POST",
                                        url: "{{ route('project.reject') }}",
                                        data: { id: $projectid },
                                        dataType: 'json',
                                        success: function(res){
                                            Swal.fire({

                                                icon: 'success',
                                                title: 'Reject!',
                                                text: 'This Project has been Reject!.',
                                                customClass: {
                                                    confirmButton: 'btn btn-success'
                                                }
                                            })
                                            window.location.reload();
                                        }
                                    })

                                }
                            });
                        }
                        //$('#addEditBookForm').trigger("reset");
                    },
                    @endif


                ],
                // For responsive popup
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details of ' + data['hostname'];
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
                                '<select id="EnvironmentStatus" class="form-select ms-50 text-capitalize"><option value=""> Select Status </option></select>'
                            )
                                .appendTo('.environment_status')
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
                        })
                        ;
                },
                drawCallback: function () {
                    $(document).find('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        }
    });

</script>
@endsection
