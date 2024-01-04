
@extends('layouts/contentLayoutMaster')

@section('title', 'Summary')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">


@endsection

@section('content')
    <section class="form-control-repeater">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1>{{$server->hostname}}  <span class="badge badge-light-primary profile-badge">{{$server->operating_system_option}}</span></h1>
                        <hr class="mb-2" />
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text">Project - {{$server->project->title}}</h6>

                                </div>

                                <div>
                                    <h6 class="text">Cost -  <span class="badge badge-light-success profile-badge">RM {{$server->price}}</span> </h6>

                                </div>
                            </div>

                        </div>

                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text">Tier - <span class="badge badge-light-{{$server->tiername->display_icon_colour?'info'}} profile-badge">{{$server->tiername->name}}</span></span> </h6>
                                    <h6 class="text">Environment -  <span class="badge badge-light-{{ $server->envname->display_icon_colour?'info'}} profile-badge">{{$server->display_env}}</span> </h6>

                                </div>
                                <div>
                                    <h6 class="text-muted fw-bolder">CPU</h6>
                                    <h3 class="mb-0">{{$server->v_cpu}} </h3>
                                </div>
                                <div>
                                    <h6 class="text-muted fw-bolder">Memory</h6>
                                    <h3 class="mb-0">{{$server->v_memory}} GB</h3>
                                </div>
                                <div>
                                    <h6 class="text-muted fw-bolder">Storage</h6>
                                    <h3 class="mb-0">{{$server->total_storage}} GB</h3>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

{{--            <div class="col-12">--}}
{{--                <div class="card">--}}

{{--                    <div class="card-body">--}}
{{--                        <h2>Firewall Rules (Inbound) </h2>--}}
{{--                        <div>--}}

{{--                                @foreach($firewallservice as $fs)--}}
{{--                                <div class="d-flex justify-content-between align-items-center">--}}
{{--                                    <div class="form-check form-check-inline">--}}
{{--                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />--}}
{{--                                        <label class="form-check-label" for="inlineCheckbox1">{{$fs->type}}</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @endforeach--}}


{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h2>Firewall Rules (Inbound) <button type="button" class="btn btn-outline-primary btn-add-firewall btn-add-server-firewall"  id="{{$server->id}}" value="{{$server->id}}}"   data-bs-toggle="modal" data-bs-target="#ServerFirewallForms">+ </button>
                        </h2>
{{--                        <div>--}}

{{--                            @foreach($firewallservice as $fs)--}}
{{--                                <div class="d-flex justify-content-between align-items-center">--}}
{{--                                    <div class="form-check form-check-inline">--}}
{{--                                        <input class="form-check-input btn-favor" data-id="{{$fs->id}}" type="checkbox" id="{{$fs->id}}" value="checked" checked />--}}
{{--                                        <label class="form-check-label" for="inlineCheckbox1">{{$fs->type}}</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}f
{{--                            @endforeach--}}


{{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <div class="row" id="table-hover-row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Source</th>
                                                <th>Ports/Predefined Service</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($server->firewalls()->get() as $fws)
                                            <tr>
                                                <td><a class="btn-edit-row btn-edit-firewall-row" data-id="{{$fws->id}}"  data-bs-placement="top" title="edit" data-bs-toggle="modal" data-bs-target="#ServerFirewallForms">{{$fws->firewall_name}}</a></td>
                                                @if($fws->source_type=='Custom')
                                                    <td>
                                                        [IP] {{$fws->display_source_custom_ip}} <br/>
                                                        [VM] {{$fws->display_source_custom_vm}}<br/>
                                                        [SG] {{$fws->display_source_custom_sg}}
                                                    </td>
                                                @else
                                                    <td>
                                                        {{$fws->source}}
                                                    </td>
                                                @endif

                                                <td> {{$fws->display_port}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item btn-edit-row btn-edit-firewall-row" data-id="{{$fws->id}}"  data-bs-placement="top" title="edit" data-bs-toggle="modal" data-bs-target="#ServerFirewallForms">
                                                            <i data-feather="edit-2" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <i data-feather="trash" class="me-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h2>Firewall Rules (Project)
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row" id="table-hover-row">
                            <div class="col-12">
                                <div class="card">

{{--                                    @foreach($projectsecuritygroup as $psg)--}}
{{--                                        @if($psg->env ==$server->tiername->name || $psg->env ==$server->envname->name|| $psg->env ==$server->envname->name.$server->tiername->name)--}}
{{--                                            {{$psg->slug}}--}}
{{--                                            <div class="table-responsive">--}}
{{--                                                <table class="table table-hover">--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th>Name</th>--}}
{{--                                                        <th>Source</th>--}}
{{--                                                        <th>Ports/Predefined Service</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody>--}}
{{--                                                    @foreach($psg->firewall as $fws)--}}
{{--                                                        <tr>--}}
{{--                                                            <td>{{$fws->name}}</td>--}}
{{--                                                            <td>--}}
{{--                                                                {{$fws->source}}--}}
{{--                                                            </td>--}}
{{--                                                            <td> {{$fws->port}}</td>--}}

{{--                                                        </tr>--}}
{{--                                                    @endforeach--}}
{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}


                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>Source</th>
                                                            <th>Destination</th>
                                                            <th>Ports/Predefined Service</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($server->securitygroups()->get() as $psg)
                                                            @foreach($psg->firewall as $fws)
                                                                <tr>
                                                                    <td>{{$fws->firewall_name}}</td>
                                                                <td>
                                                                    @if($fws->source=='Custom')
                                                                        [IP] {{$fws->display_source_custom_ip}} <br/>
                                                                        [VM]{{$fws->display_source_custom_vm}}<br/>
                                                                        [SG]{{$fws->display_source_custom_sg}}
                                                                    @else
                                                                        {{$fws->source}}
                                                                    @endif
                                                                    </td>
                                                                    <td>{{$fws->destination_name}}</td>
                                                                    <td> {{$fws->port}}</td>

                                                                </tr>
                                                            @endforeach
                                                            @foreach($psg->projectfirewall as $fwss)
                                                                <tr>
                                                                    <td>{{$fwss->firewall_name}}</td>
                                                                    <td>
                                                                        @if($fwss->source=='Custom')
                                                                            [IP] {{$fwss->display_source_custom_ip}} <br/>
                                                                            [VM]{{$fwss->display_source_custom_vm}}<br/>
                                                                            [SG]{{$fwss->display_source_custom_sg}}
                                                                        @else
                                                                            {{$fws->source}}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$fwss->destination_name}}</td>
                                                                    <td> {{$fwss->display_port}}</td>

                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>
{{--    @include('content/_partials/_modals/modal-add-edit-server-firewall')--}}
    @include('content/_partials/_modals/modal-server-firewall')
@endsection

@section('vendor-script')
    <!-- vendor files -->


    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>




        $(function () {
            ('use strict');



            var select = $('.select2');


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

            $("#modalDestination").select2({disabled:'readonly'});

            $('.port-form').repeater({
                initEmpty: false,
                show: function () {
                    $(this).slideDown();
                    // $('.hide-search').on('change', function () {
                    //     console.log('You selected: ', this.value);
                    // });
                    // Feather Icons
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

            $(".js-select2-port").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })

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

        });




        $('body').on('click', '.btn-add-server-firewall', function () {
            var id = $(this).data('id');

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

            $('#server_id').val(this.id);

        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.btn-edit-firewall-row', function () {

            $('#modalCustomIP').select2('data', null)
            var id = $(this).data('id');


            $('#modalCustomIP').select2('data', null)
            $('#modalCustomVm').val('').trigger('change');
            $('#modalCustomIP').val('').trigger('change');
            $('#modalCustomSecurityGroup').val('').trigger('change');
            $('#form_id').val('');

            $.ajax({
                    type:"GET",
                    url: "{{ route('server.firewall.edit') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){

                        $('#firewalltitle').text('Edit Firewall');
                        $('#form_id').val(id);


                        $('#modalCustomIP').empty();
                        $('#modalCustomIP').select2('data', null)
                        $('#modalCustomIP').val('').trigger('change');

                        $("#modalDestination").val(res.destination_id);
                        $("#modalDestination").trigger('change');

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


                        console.log(res);
                        $('#modalCustomIP').val(res.display_source_custom_ip.split(',')).trigger("change");
                        if(res.source_source_custom_vm!=null){
                            $('#modalCustomVm').val(res.source_source_custom_vm.split(',')).trigger("change");
                        }
                        if(res.source_source_custom_sg!=null){
                            $('#modalCustomSecurityGroup').val(res.source_source_custom_sg.split(',')).trigger("change");
                        }





                        $.ajax({
                            type: "GET",
                            url: "{{ route('server.get.firewall.port') }}",
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
                        document.forms["addNewAnyForm"].submit();
                    }

                });

            });
        }

        {{--$('body').on('click', '.btn-edit-row', function () {--}}
        {{--    var id = $(this).data('id');--}}


        {{--    $.ajax({--}}
        {{--        type:"POST",--}}
        {{--        url: "{{ route('server.firewall.edit') }}",--}}
        {{--        data: { id: id },--}}
        {{--        dataType: 'json',--}}
        {{--        success: function(res){--}}

        {{--            console.log(res);--}}
        {{--            $('#modalsslidein_rowform').trigger("reset");--}}
        {{--            //--}}
        {{--            //--}}
        {{--            $('#form-label-row').text("Edit Record");--}}
        {{--            $('#form_id').val(res.id);--}}
        {{--            $('#server_id').val(res.server_id);--}}
        {{--            $('#row_section_id').val(res.section_id);--}}
        {{--            $('#rule-name').val(res.name);--}}
        {{--            $('#source').val(res.source);--}}
        {{--            $('#destination').val(res.destination);--}}
        {{--            $('#basic-port-range').val(res.port);--}}
        {{--            $('#select-rule-type').val(res.rule).change();--}}
        {{--            $("#select-type").val(res.protocol).change();--}}
        {{--            $("#row_select_status").val(res.status).change();--}}
        {{--        }--}}
        {{--    });--}}

        {{--    $('#row_section_id').val(this.id);--}}

        {{--});--}}

            $('.btn-favor').click(function () {
                var id = $(this).data('id');
                var status = $(this).prop('checked') == true ? 1 : 0;

                console.log(status);
                $.ajax({

                    type: "POST",
                    dataType: "json",
                    url: "{{ route('firewall.subscribe',['firewallService' => 1]) }}",
                    data: {'status': status, 'id': id,'s_id': {{$server->id}}},
                    success: function(data){
                        console.log(data.success)
                        toastr[data.type](data.message, data.title, {
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true,
                        });
                    }
                });

            });

        $('body').on('click', '.toggle-class', function () {

        });
    </script>
@endsection
