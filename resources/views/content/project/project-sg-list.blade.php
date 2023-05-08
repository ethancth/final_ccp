@extends('layouts/contentLayoutMaster')

@section('title', $pagetitle)

@section('vendor-style')
    <!-- Vendor css files -->

@endsection
@section('page-style')
    <!-- Page css files -->

@endsection

@section('content')


    <section id="basic-and-outline-pills">
        <div class="row match-height">
            <!-- Basic pills starts -->
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$pagetitle}}</h4>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <div class = "content-header-title me-2 ">
                                <button type="button" class="btn btn-outline-primary "  data-bs-toggle="modal" data-bs-target="#modalsslideinform">{{__('locale.Add Security Group')}}</button>
                            </div>


                            @foreach($section_array as $key =>$section)


                                <li class="nav-item">
                                    <a class="nav-link  @php
                                            //if ($key === array_key_first($section_array)) {
                                             //   echo ' active';
                                            //}
                                        @endphp" id="tab-{{$section['id']}}" data-bs-toggle="pill" href="#section-tab-{{$section['id']}}" aria-expanded="false" >  {{$section['slug']}} <span class="visually-hidden">Toggle Dropdown</span></a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">

                            @foreach($section_array as $key =>$section)
                            <div role="tabpanel" class="tab-pane
{{--                                        @php--}}
{{--                                            if ($key === array_key_first($section_array)) {--}}
{{--                                                echo ' active';--}}
{{--                                            }--}}
{{--                                        @endphp--}}

                                        " id="section-tab-{{$section['id']}}" aria-labelledby="tab-{{$section['id']}}" aria-expanded="true">
                                <p>
                                <div class="col-12">
                                    <div class = "content-header-title me-2 mb-2">
                                        <button type="button" class="btn btn-outline-primary btn-add-firewall"  id="{{$section['id']}}" value="{{$section['id']}}"   data-bs-toggle="modal" data-bs-target="#modalsslidein_rowform">{{__('locale.Add Firewall')}} in {{$section['slug']}}</button>
                                        <button type="button" class="btn btn-outline-primary btn-add-firewall-services"  id="{{$section['id']}}" value="{{$section['id']}}"   data-bs-toggle="modal" data-bs-target="#modalsslidein_rowform">{{__('locale.Add Firewall')}} Service in {{$section['slug']}}</button>
                                    </div>


                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>{{__('locale.Name')}}</th>
                                                    <th>{{__('locale.Source')}}</th>
                                                    <th>{{__('locale.Destination')}}</th>
                                                    <th>{{__('locale.Services/Port')}}</th>
                                                    <th>{{__('locale.Status')}}</th>
                                                    <th>{{__('locale.Actions')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($section['item'] as $row)
                                                    <tr>
                                                        <td>
                                                            <span class="fw-bold">{{$row['name']}}</span>
                                                        </td>
                                                        <td>{{$row['source']}}</td>
                                                        <td>{{$row['destination']}}</td>
                                                        <td>{{$row['port']}}</td>

                                                        @if($row['status']=='1')
                                                            <td><span class="badge rounded-pill badge-light-success me-1">{{__('locale.Enable')}}</span></td>
                                                        @else
                                                            <td><span class="badge rounded-pill badge-light-warning me-1">{{__('locale.Disable')}}</span></td>
                                                        @endif

                                                        <td>
                                                            <a class="me-1 btn-edit-row" data-id="{{$row['id']}}"  data-bs-placement="top" title="edit" data-bs-toggle="modal" data-bs-target="#modalsslidein_rowform">
                                                                <i data-feather="edit" class="me-50"></i>
                                                            </a>


                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </p>
                            </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    @include('content/_partials/_modals/modal-farm-section-add-edit')--}}
{{--    @include('content/_partials/_modals/modal-farm-row-add-edit')--}}

    @include('content/_partials/_modals/modal-security-group-add-edit')
@endsection

@section('vendor-script')
@endsection
@section('page-script')
    <!-- Page js files -->


    <script>

        $(document).ready(function() {
            $(".tabs").not(":first").hide();

            $(".tab .control a").click(function() {
                showTab(this.href);
            });

            var tab = window.location.hash;
            if (tab)
                showTab(tab);
        });

        function showTab(tabId) {
            $('.tab').removeClass('active');
            $('a[href="' + tabId + '"]').addClass('active');
            $(".tabs").hide();
            $(storage).show();
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

        $('body').on('click', '.btn-add-firewall', function () {
            var id = $(this).data('id');

            $('#security_env_id').val(this.id);

        });
        $('body').on('click', '.btn-edit-row', function () {
            var id = $(this).data('id');


            $.ajax({
                type:"POST",
                url: "{{ route('project.sg.env.firewall.store') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){

                    console.log(res);
                    $('#modalsslidein_rowform').trigger("reset");
                    //
                    //
                    $('#form-label-row').text("Edit Record");
                    $('#form_id').val(res.id);
                    $('#security_env_id').val(res.security_env_id);
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

        if (rowbootstrapForm.length) {
            Array.prototype.filter.call(rowbootstrapForm, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        form.classList.add('invalid');
                    }
                    form.classList.add('was-validated');

                    event.preventDefault();
                    if (form.checkValidity() === true) {
                        document.forms["rowform"].submit();
                    }

                });

            });
        }
    </script>
@endsection
