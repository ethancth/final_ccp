@extends('layouts/contentLayoutMaster')

@section('title', 'Project ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/nouislider.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/dragula.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">


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
                <h1>{{$project->title}} </h1>
                <hr class="mb-2" />
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text">Total - {{$project->server->count()}} Server</h6>

                        </div>

                        <div>
                            <h6 class="text">Cost -  <span class="badge badge-light-success profile-badge">RM {{$project->price}}</span> </h6>

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
          </tr>
        </thead>
      </table>
    </div>
  </div>
</section>
    <div class="col-12">
        <div class="card">



            </div>
        </div>

    <!-- share SecurityGroup modal -->
    <div class="modal fade" id="SecurityGroupMember" tabindex="-1" aria-labelledby="shareSecurityGroupTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-4">
                    <h1 class="text-center mb-1" id="shareSecurityGroupTitle">Security Group Member</h1>

                    <label class="form-label fw-bolder font-size font-small-4 mb-50" for="addMemberSelect"> Add members </label>
                    <form class="needs-validation" novalidate id="memberform" name="memberform" action="{{route("psg.member.store")}}" method="POST" accept-charset="UTF-8">
                        <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                        <input class="hidden" name="form_firewall_group_id" id="form_firewall_group_id" value="">
                        <select id="CustomVm" name="CustomVm[]" multiple="multiple" class="select2 form-select ">
                            <option value="">Select a Virtual Machine</option>
                            @foreach($vcvms as $vcvc)
                                <option value="{{$vcvc->id}}">{{$vcvc->hostname}}</option>
                            @endforeach
                        </select>
                        <div class="form-check form-switch hidden">
                            <input type="checkbox" class="form-check-input" value="1" name="customSwitchOverwrite" id="customSwitchOverwrite" />
                            <label class="form-check-label" for="customSwitch1">Overwrite</label>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-1 mt-2">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                Discard
                            </button>
                        </div>

                    </form>

                    <p class="fw-bolder pt-50 mt-2" id="total_number"> Members</p>

                    <!-- member's list  -->
                    <ul class="list-group list-group-flush mb-2">
                        <div id="content_member"/>
                    </ul>
                    <!--/ member's list  -->

                    <!-- SecurityGroup link -->
                </div>
            </div>
        </div>
    </div>
    <!-- / share SecurityGroup modal -->




    @include('content/_partials/_modals/modal-create-security-group')
    @include('content/_partials/_modals/modal-add-edit-server-firewall-form')
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>



<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/nouislider.min.js')) }}"></script>


<script src="{{ asset(mix('js/scripts/pages/modal-share-project.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/dragula.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-todo.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>


{{--sweetalert--}}
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection



@section('page-script')
<script>


    // ---Group Member---

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.security_group_member', function () {
        var id = $(this).data('id');
        $.ajax({
            type:"POST",
            url: "{{ route('get.psg.member') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                document.getElementById('total_number').innerHTML = 'Total member: '+res.length;
                $('#form_firewall_group_id').val(id);
               console.log(res);
                if(res.length>0){
                    let temp_market='';
                    jQuery.each(res, function(index, item) {
                        temp_market+=
                            "<li class='list-group-item d-flex align-items-start border-0 px-0'>" +
                            " <div class='avatar me-75'>" +
                            "<img src='"+window.location.origin+"/images/avatars/" +item['operating_system_option'] +".png'  alt='avatar' width='38' height='38' />" +
                            "</div>" +
                            '<div class="d-flex align-items-center justify-content-between w-100">'+
                            '<div class="me-1">'+
                            ' <h5 class="mb-25">'+item['hostname'] +'</h5>'+
                            ' <span>'+item['display_os'] +'</span>'+
                            '</div>'+
                            '<div class="dropdown">'+
                                '<button'+
                                   ' class="btn btn-flat-secondary dropdown-toggle"'+
                                    'type="button"' +
                                    'id="member1"'+
                                    'data-bs-toggle="dropdown"'+
                                    'aria-expanded="false"'+
                                '>'+
                                    '<span class="d-none d-lg-inline-block">Action</span>'+
                                '</button>' +
                                '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="member1">'+
                                    '<li><a class="dropdown-item" href="javascript:void(0)">Remove</a></li>' +
                                '</ul>'+
                            '</div>'+
                            ' </div>'+
                            '</li>';



                        //now you can access properties using dot notation
                    });

                    document.getElementById("content_member").innerHTML = temp_market;
                }else{
                    document.getElementById("content_member").innerHTML = '';
                }


                //   $.each(res, function() {
              //       $.each(this, function(k, v) {
              //           /// do stuff
              //           console.log(k);
              //       });
              //   });
                //var color=res.display_icon_colour;
                // $('#modalsslideinform').modal('show');
                // $('#form-label').text("Edit Record");
                // $('#basic-addon-name').val(res.name);
                // $('#form_id').val(res.id);
                // $('#basic-default-display-name').val(res.display_name);
                // $('#basic-default-desc').val(res.display_description);
                // $('#basic-default-icon').val(res.display_icon);
                // $("#select-colour").val(color).change();
                // $("#select-status").val(res.status).change();
                // $('#code').val(res.code);
                // $('#author').val(res.author);
            }
        }
      );



    });



    // edit firwall ports record
    $(document).on('click', '.fw-edit-record', function () {
        var user_id = $(this).data('id'),
            dtrModal = $('.dtr-bs-modal.show');

        // hide responsive modal in small screen
        if (dtrModal.length) {
            dtrModal.modal('hide');
        }

        // changing the title of offcanvas
        $('#offcanvasAddUserLabel').html('Edit User');

        // get data
        $.get(`${baseUrl}user-list\/${user_id}\/edit`, function (data) {
            $('#user_id').val(data.id);
            $('#add-user-fullname').val(data.name);
            $('#add-user-email').val(data.email);
        });
    });

    $('body').on('click', '.btn-add-server-firewall', function () {
        $('#firewalltitle').text('New Firewall');
        $('#modalCustomIP').empty();
        $('#modalCustomIP').select2('data', null)
        $('#modalCustomVm').val('').trigger('change');
        $('#modalCustomIP').val('').trigger('change');
        $('#modalCustomSecurityGroup').val('').trigger('change');
        $('#form_id').val('');
        $('#modalDestination').select2({
            placeholder: "Select the Destination Security Group"
        });
    });
    $('body').on('click', '.btn-edit-firewall-row', function () {
        var id = $(this).data('id');

        $.ajax({
                type:"GET",
                url: "{{ route('project.firewall.edit') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){

                    $('#firewalltitle').text('Edit Firewall');
                    $('#form_id').val(id);

                    $("#modalDestination").val(res.destination_id);
                    $("#modalDestination").trigger('change');

                    $('#modalCustomIP').empty();

                    $("#modalCustomSecurityGroup").val(res.source_source_custom_sg);
                    $("#modalCustomSecurityGroup").trigger('change');

                    var str_array = res.display_source_custom_ip.split(',');
                    for(var i = 0; i < str_array.length; i++) {
                        // Trim the excess whitespace.
                        if( str_array[i]!=''){
                            str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");

                            $("#modalCustomIP").append('<option value="'+str_array[i]+'">'+str_array[i]+'</option>');
                        }

                    }
                    //
                    // var str_array = res.source_source_custom_sg.split(',');
                    // for(var i = 0; i < str_array.length; i++) {
                    //     // Trim the excess whitespace.
                    //     str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
                    //
                    //     $("#modalCustomSecurityGroup").val(str_array[i]);
                    //     $("#modalCustomSecurityGroup").trigger('change');
                    // }


                    $('#modalCustomIP').val(res.display_source_custom_ip.split(',')).trigger("change");
                    $('#modalCustomVm').val(res.source_source_custom_vm.split(',')).trigger("change");
                    $('#modalCustomSecurityGroup').val(res.source_source_custom_sg.split(',')).trigger("change");



                    $.ajax({
                        type: "GET",
                        url: "{{ route('project.get.firewall.port') }}",
                        data: {id: id},
                        dataType: 'json',
                        success: function (res) {

                            let num=0;
                            $('[data-repeater-list]').empty();
                            res.forEach((record) => {

                               $('.port-form').find('[data-repeater-create]').click();
                                //portserviceform[0][portrange]
                                let $_type = 'portserviceform['+num+'][type]';
                                let $_protocol = 'portserviceform['+num+'][protocol]';
                                let $_port = 'portserviceform['+num+'][portrange]';

                                 document.getElementsByName($_type)[0].value=record.display_port_type;
                                 document.getElementsByName($_protocol)[0].value=record.protocol;
                                document.getElementsByName($_port)[0].value=record.port;

                                document.getElementsByName($_protocol)[0].setAttribute('readonly',true);
                                document.getElementsByName($_port)[0].setAttribute('readonly', true);


                                num++;

                            });



                        }
                    })




                }
            }
        );



    });

    function chek_valid_ip(ip) {
        if (ip.match('^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$') && ip.split('.').length == 4)
           return true;
        else
            return false;
    }

    function Chek(Element) {
        var status;
        var item = Element
        status = true;
            if (item.indexOf('-') != -1) {
                if (!chek_valid_diapazon(item)) {
                    status = false;
                    return status;
                }
            }
            else if (item.indexOf('/') != -1) {
                if (!chek_valid_mask(item)) {
                    status = false;
                    return status;
                }
            }
            else
            if (!chek_valid_ip(item)) {
                status = false;
                return status;
            }


    }

    function chek_valid_diapazon(diapazon) {
        var addreses = diapazon.split('-');
        if (addreses.length != 2) {
            return false;
        }
        if (!chek_valid_ip(addreses[0]) || !chek_valid_ip(addreses[1])) {
            return false;
        }
        var begin = addreses[0].split('.');
        var end = addreses[1].split('.');
        X = begin[0] * Math.pow(256, 3) + begin[1] * Math.pow(256, 2) + begin[2] * Math.pow(256, 1) + begin[3] * Math.pow(256, 0);
        Y = end[0] * Math.pow(256, 3) + end[1] * Math.pow(256, 2) + end[2] * Math.pow(256, 1) + end[3] * Math.pow(256, 0);
        if (X < Y)
            return true;
        else
            return false;
    }
    function chek_valid_mask(mask) {

        var addreses = mask.split('/');
        if (addreses.length != 2) return false;
        if (!chek_valid_ip(addreses[0])) return false;
        if (!addreses[1].match('^[2-9]$|^[1-2][0-9]$|^3[0-2]$')) return false;
        return true;
    }

    $('#modalCustomIP').on('select2:select', function (e) {
        // Do something

        let arry =$(this).val();
        arry.pop();
        var data = e.params.data;
        var result=Chek(data.text);
        if (result === undefined) {

        }else{

            $('#modalCustomIP').val(arry);
            $('#modalCustomIP').trigger('change');

        }


    });



    $(function () {
        'use strict';


        // ---form repeater use start ----- //

        $('.port-form').repeater({
            initEmpty: false,
            show: function () {
                $(this).slideDown();

                if (feather) {
                    feather.replace({ width: 14, height: 14 });
                }
            },

            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });







        $(document).on('change', '.hide-search', function() {
            var selectedValue = $(this).val();
            var $field2 = $(this).closest('div[data-repeater-item]').find('.hide-search');
            let str = $(this).attr("name")
            var $_protocol = str.slice(0, -5);
            var $new_protocol=$_protocol+'protocol]';
            var $new_port_range=$_protocol+'portrange]';



            const field = [ 'custom', 'alltcp', 'alludp'];

            if(field.includes(selectedValue)){
                switch(selectedValue) {
                    case "alltcp":
                        document.getElementsByName($new_protocol)[0].value='tcp'
                        document.getElementsByName($new_protocol)[0].setAttribute('readonly', true);
                        document.getElementsByName($new_protocol)[0].setAttribute("style", "pointer-events: none;");

                        document.getElementsByName($new_port_range)[0].value=''
                        document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                        break;
                    case "alludp":
                        document.getElementsByName($new_protocol)[0].setAttribute("style", "pointer-events: none;");
                        document.getElementsByName($new_protocol)[0].value='udp'
                        document.getElementsByName($new_protocol)[0].setAttribute('readonly', true);
                        document.getElementsByName($new_port_range)[0].value=''
                        document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                        break;
                    default:
                        document.getElementsByName($new_port_range)[0].removeAttribute('readonly');
                        document.getElementsByName($new_protocol)[0].removeAttribute('readonly');
                        document.getElementsByName($new_protocol)[0].removeAttribute("style", "pointer-events: none;");



                }
            }else{
                 $.ajax({
                     type: 'GET',
                     url: "{{route('getservice')}}",
                     data: {'value': selectedValue},

                     success: function (response) {
                         console.log(response);
                         let port ='';
                         document.getElementsByName($new_protocol)[0].value=response.protocol.toLowerCase();
                         document.getElementsByName($new_protocol)[0].setAttribute('readonly', true);
                         document.getElementsByName($new_protocol)[0].setAttribute("style", "pointer-events: none;");
                         if(response.port=='All ports')
                         {port ='';

                         }else{
                             port =response.port;
                         }
                         document.getElementsByName($new_port_range)[0].value=port;
                         document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                     }
                 });
            }




        });

        //form repeater use end
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


        $(".js-select2-port").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

        $(".select2-sg").select2({
            containerCssClass: function(e) {
                return $(e).attr('required') ? 'required' : '';
            }
        });





        const uppercaseWords = str => str.replace(/^(.)|\s+(.)/g, c => c.toUpperCase());
        var dtInvoiceTable = $('.invoice-list-table'),
            assetPath = '../../../app-assets/',
            invoicePreview = '/project';

        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
            invoicePreview = assetPath + 'project';
        }


        // datatable
        if (dtInvoiceTable.length) {
            var dtInvoice = dtInvoiceTable.DataTable({
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
                        render: function (data, type, full, meta) {
                            var $invoiceId = full['id'];
                            // Creates full output for row
                            var $rowOutput = ' #' + $invoiceId;
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
                    }
                    // ,
                    // {
                    //     // Actions
                    //     targets: -1,
                    //     title: 'Actions',
                    //     width: '80px',
                    //     orderable: false,
                    //     render: function (data, type, full, meta) {
                    //         var $id = full['id'];
                    //         return (
                    //             '<div class="d-flex align-items-center col-actions">' +
                    //             '<a class="me-1 edit" href="#" data-bs-toggle="tooltip" data-id="'+$id+'" data-bs-placement="top" title="Edit Server">' +
                    //             feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                    //             '</a>' +
                    //             '<a class="me-25 delete" href="#" data-bs-toggle="tooltip"  data-id="'+$id+'" data-bs-placement="top" title="Delete">' +
                    //             feather.icons['trash'].toSvg({ class: 'font-medium-2 text-body' }) +
                    //             '</a>' +
                    //             '<div class="dropdown">' +
                    //             '<a class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                    //             feather.icons['more-vertical'].toSvg({ class: 'font-medium-2 text-body' }) +
                    //             '</a>' +
                    //             '<div class="dropdown-menu dropdown-menu-end">' +
                    //             '<a href="#" class="dropdown-item">' +
                    //             feather.icons['download'].toSvg({ class: 'font-small-4 me-50' }) +
                    //             'Download</a>' +
                    //             '<a href="#" class="dropdown-item edit" data-id="'+$id+'">' +
                    //             feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                    //             'Edit</a>' +
                    //             '<a href="#" class="dropdown-item">' +
                    //             feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) +
                    //             'Delete</a>' +
                    //             '<a href="#" class="dropdown-item">' +
                    //             feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) +
                    //             'Duplicate</a>' +
                    //             '</div>' +
                    //             '</div>' +
                    //             '</div>'
                    //         );
                    //     }
                    // }
                ],
                order: [[1, 'desc']],
                dom:
                    '<"row d-flex justify-content-between align-items-center m-1"' +
                    '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons_new text-xl-end text-lg-start text-lg-end text-start " B>>' +
                    '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f>' +
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
