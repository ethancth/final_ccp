
@extends('layouts/contentLayoutMaster')

@section('title', 'Summary')

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
                                    <h6 class="text">Tier - <span class="badge badge-light-{{$server->tiername->display_icon_colour}} profile-badge">{{$server->tiername->name}}</span></span> </h6>
                                    <h6 class="text">Environment -  <span class="badge badge-light-{{$server->envname->display_icon_colour}} profile-badge">{{$server->envname->name}}</span> </h6>

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
                        <h2>Firewall Rules (Inbound) <button type="button" class="btn btn-outline-primary btn-add-firewall btn-add-server-firewall"  id="{{$server->id}}" value="{{$server->id}}}"   data-bs-toggle="modal" data-bs-target="#modalsslidein_rowform">+ </button>
                        </h2>
                        <div>

                            @foreach($firewallservice as $fs)
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input btn-favor" data-id="{{$fs->id}}" type="checkbox" id="{{$fs->id}}" value="checked" checked />
                                        <label class="form-check-label" for="inlineCheckbox1">{{$fs->type}}</label>
                                    </div>
                                </div>
                            @endforeach


                        </div>
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
                                            @foreach($serverfirewallservice as $fws)
                                            <tr>
                                                <td><a class="btn-edit-row " data-id="{{$fws->id}}"  data-bs-placement="top" title="edit" data-bs-toggle="modal" data-bs-target="#modalsslidein_rowform">{{$fws->type}}</a></td>
                                                <td>
                                                    {{$fws->source}}
                                                </td>
                                                <td> {{$fws->port}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item btn-edit-row" data-id="{{$fws->id}}"  data-bs-placement="top" title="edit" data-bs-toggle="modal" data-bs-target="#modalsslidein_rowform">
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
                        <h2>Security Group
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row" id="table-hover-row">
                            <div class="col-12">
                                <div class="card">

                                    @foreach($projectsecuritygroup as $psg)
                                        @if($psg->env ==$server->tiername->name)
                                            {{$psg->slug}}
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Source</th>
                                                        <th>Ports/Predefined Service</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($psg->firewall as $fws)
                                                        <tr>
                                                            <td>{{$fws->name}}</td>
                                                            <td>
                                                                {{$fws->source}}
                                                            </td>
                                                            <td> {{$fws->port}}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    @endforeach
                                        @foreach($server->securitygroups()->get() as $psg)
                                                {{$psg->slug}}
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Source</th>
                                                            <th>Ports/Predefined Service</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($psg->firewall as $fws)
                                                            <tr>
                                                                <td>{{$fws->name}}</td>
                                                                <td>
                                                                    {{$fws->source}}
                                                                </td>
                                                                <td> {{$fws->port}}</td>

                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                        @endforeach

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>
    @include('content/_partials/_modals/modal-add-edit-server-firewall')
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-repeater.js')) }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $('body').on('click', '.btn-add-server-firewall', function () {
            var id = $(this).data('id');

            $('#server_id').val(this.id);

        });
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

        $('body').on('click', '.btn-edit-row', function () {
            var id = $(this).data('id');


            $.ajax({
                type:"POST",
                url: "{{ route('server.firewall.edit') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){

                    console.log(res);
                    $('#modalsslidein_rowform').trigger("reset");
                    //
                    //
                    $('#form-label-row').text("Edit Record");
                    $('#form_id').val(res.id);
                    $('#server_id').val(res.server_id);
                    $('#row_section_id').val(res.section_id);
                    $('#rule-name').val(res.name);
                    $('#source').val(res.source);
                    $('#destination').val(res.destination);
                    $('#basic-port-range').val(res.port);
                    $('#select-rule-type').val(res.rule).change();
                    $("#select-type").val(res.protocol).change();
                    $("#row_select_status").val(res.status).change();
                }
            });

            $('#row_section_id').val(this.id);

        });

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
