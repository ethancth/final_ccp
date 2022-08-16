<!-- create app modal -->
<div class="modal fade" id="createAppModal" tabindex="-1" aria-labelledby="createAppTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-3 px-sm-3">
                <h1 class="text-center mb-1" id="createAppTitle">Create Server</h1>
                <p class="text-center mb-2">Provide application data with this form</p>
                <div class="bs-stepper vertical wizard-modern create-app-wizard">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#create-app-details" role="tab" id="create-app-details-trigger">
                            <button type="button" class="step-trigger py-75">
                                <span class="bs-stepper-box">
                                    <i data-feather="book" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Details</span>
                                    <span class="bs-stepper-subtitle">Enter Server Name</span>
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#create-app-tier" role="tab" id="create-app-tier-trigger">
                            <button type="button" class="step-trigger py-75">
                                <span class="bs-stepper-box">
                                    <i data-feather="package" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Tier</span>
                                    <span class="bs-stepper-subtitle">Enter Information</span>
                                </span>
                            </button>
                        </div>

                        <div class="step" data-target="#create-app-compute" role="tab" id="create-app-compute-trigger">
                            <button type="button" class="step-trigger py-75">
                                <span class="bs-stepper-box">
                                    <i data-feather="settings" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Compute Resource</span>
                                    <span class="bs-stepper-subtitle">Server config </span>
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#create-app-apps" role="tab"
                             id="create-app-apps-trigger">
                            <button type="button" class="step-trigger py-75">
                                <span class="bs-stepper-box">
                                    <i data-feather="server" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Service Application</span>
                                    <span class="bs-stepper-subtitle">Apps</span>
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#create-app-review" role="tab" id="create-app-review-trigger">
                            <button type="button" class="step-trigger py-75">
                                <span class="bs-stepper-box">
                                    <i data-feather="alert-triangle" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Review</span>
                                    <span class="bs-stepper-subtitle">Review your request.</span>
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#create-app-submit" role="tab" id="create-app-submit-trigger">
                            <button type="button" class="step-trigger py-75">
                                <span class="bs-stepper-box">
                                    <i data-feather="check" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Submit</span>
                                    <span class="bs-stepper-subtitle">Submit your request.</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="bs-stepper-content shadow-none">

                        <div id="create-app-details" class="content" role="tabpanel"
                             aria-labelledby="create-app-details-trigger">
                            <form id="create-app-page1">
                                <h5>Server Name</h5>
                                <input class="form-control" type="text" placeholder="Server Name" value=""
                                       id="servername" name="servername"/>
                                <h5 class="mt-2 pt-1">Environment</h5>
                                <ul class="list-group list-group-flush" name="EnvGroup">

                                    @foreach($forms as $form)
                                        <?php
                                        $_temp_num=1;
                                        ?>
                                        @foreach($form->envform as $envforms)
                                            @if($envforms->status===1)

                                                <li class="list-group-item border-0 px-0">
                                                    <label for="createApp{{$envforms->id}}" class="d-flex cursor-pointer">
                                            <span class="avatar avatar-tag bg-light-{{$envforms->display_icon_colour}} me-1">
                                                <i data-feather="{{$envforms->display_icon}}" class="font-medium-5"></i>
                                            </span>
                                                        <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                <span class="me-1">
                                                    <span class="h5 d-block fw-bolder">{{$envforms->display_name}}</span>
                                                    <span>{{$envforms->display_description}}</span>
                                                </span>
                                                <span>
                                                    <input class="form-check-input radioEnv" id="createApp{{$envforms->id}}"
                                                           type="radio" text="{{$envforms->name}}" name="categoryEnvironment" <?php
                                                          if($_temp_num==1){echo "checked";}
                                                           ?>
                                                           value="{{$envforms->id}}"
{{--                                                     {{ $product_attribute->meterial == 'production' ? 'checked' : '' }} --}}
                                                    />
                                                </span>
                                            </span>
                                                    </label>
                                                </li>
                                            @endif
                                                <?php
                                                $_temp_num++;
                                                ?>

                                        @endforeach

                                    @endforeach

                                </ul>
                            </form>
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-outline-secondary btn-prev" disabled>
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>


                        <div id="create-app-tier" class="content" role="tabpanel"
                             aria-labelledby="create-app-tier-trigger">
                            <form id="create-app-page2">

                                <h5>Operating System Name </h5>

                                <select class="select2 form-select" name="operatingsystem" id="operatingsystem">
                                    <option value="">Select Operating System</option>
                                    @foreach($forms as $form)

                                        @foreach($form->osform as $osforms)
                                            @if($osforms->status===1)
                                                <option value="{{$osforms->id}}">{{$osforms->display_name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </select>

                                <h5 class="mt-2 pt-1">Select Tier</h5>
                                <ul class="list-group list-group-flush">

                                    @foreach($forms as $form)
                                        <?php
                                        $_temp_num_tier=1;
                                        ?>
                                        @foreach($form->tierform as $tierforms)
                                            @if($tierforms->status===1)
                                                <li class="list-group-item border-0 px-0">
                                                    <label for="createTier{{$tierforms->id}}" class="d-flex cursor-pointer">
                                                        <span class="avatar avatar-tag bg-light-{{$tierforms->display_icon_colour}} me-1">
                                                            <i data-feather="{{$tierforms->display_icon}}" class="font-medium-5"></i>
                                                        </span>
                                                        <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                            <span class="me-1">
                                                                <span class="h5 d-block fw-bolder">{{$tierforms->display_name}}</span>
                                                                <span>{{$tierforms->display_description}}</span>
                                                            </span>
                                                            <span>
                                                                <input class="form-check-input radioTier" value="{{$tierforms->id}}"
                                                                       <?php
                                                                if($_temp_num_tier==1){echo "checked";}
                                                                ?> id="createTier{{$tierforms->id}}" type="radio"
                                                                       text="{{$tierforms->name}}"
                                                                       name="tierRadio" />
                                                            </span>
                                                        </span>
                                                    </label>
                                                </li>
                                            @endif
                                <?php
                                $_temp_num_tier++;
                                ?>
                                        @endforeach

                                    @endforeach
                                </ul>
                            </form>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next ">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                    </button>
                                </div>

                        </div>

                        <div id="create-app-apps" class="content" role="tabpanel"
                             aria-labelledby="create-app-apps-trigger">
                            <form id="create-app-page3">
                            <h5>Default Service Application (Mandatory)</h5>
                                <p class="form-control-static" id="input_sam_1"></p>
{{--                                <select class="select2-data-array-mandatory form-select" id="select2-array-mandatory" name="select_sa_mandatory" multiple></select>--}}

                                <input class="hidden" id="o_server_os" name="o_server_os" value="">
                                <input class="hidden" id="o_server_env" name="o_server_env" value="">
                                <input class="hidden" id="o_server_tier" name="o_server_tier" value="">
                            <h5 class="mt-2 pt-1">Optional Service Application</h5>
                                <select class="select2-data-array-optional form-select" id="select_sa_optional" name="select_sa_optional" multiple>
                                @foreach($forms as $form)
                                    <?php
                                    $_temp_num=1;
                                    ?>
                                    @foreach($form->saform as $saforms)
                                        @if($saforms->status===1)
                                                <option value="{{$saforms->id}}">{{$saforms->display_name}}</option>
                                            @endif
                                     @endforeach
                                @endforeach
                                </select>

                            </form>
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next btn-service">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>

                        <div id="create-app-compute" class="content" role="tabpanel"
                             aria-labelledby="create-app-compute-trigger">
                            <form id="create-app-page4">
                                        <div class="col-sm-12">
                                                <div class="card-header" style="
    padding-left: 0px;
    padding-bottom: 0px;padding-top: 0px;">
                                                    <h5>vCPU</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div id="pips-range-vcpu" class="mt-1 mb-3"></div>
                                                </div>
                                        </div>
                                <div class="col-sm-12">
                                    <div class="card-header" style="
    padding-left: 0px;
    padding-bottom: 0px;padding-top: 0px;">
                                        <h5>vMemory</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="pips-range-vmemory" class="mt-1 mb-3"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card-header" style="
    padding-left: 0px;
    padding-bottom: 0px; padding-top: 0px;">
                                        <h5>vStorage (GB)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="pips-range-vstorage" class="mt-1 mb-3"></div>
                                    </div>
                                </div>

                            </form>

                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next btn-review">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>

                        <div id="create-app-review" class="content" role="tabpanel"
                             aria-labelledby="create-app-review-trigger">
                            <div class="col-sm-12 col-md-12">
                                <div class="card-header" style="
                                    padding-top: 0px;
                                    padding-left: 0px;">
                                    <div class="row">
                                    <div class="col-xl-4 col-md-4 col-4">
                                        <label class="form-label" for="disabledInput">Server Name</label>
                                        <p class="form-control-static" id="input_hostname">Production</p>
                                    </div>
                                        <div class="col-xl-4 col-md-4 col-4">
                                            <label class="form-label" for="disabledInput">Cost</label>
                                            <p class="form-control-static" id="input_cost">$123</p>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 5px;margin-bottom: 5px;">
                                    <div class="row">

                                        <div class="col-xl-4 col-md-4 col-4">
                                            <label class="form-label" for="disabledInput">Environment</label>
                                            <p class="form-control-static" id="input_environment">Production</p>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-4">
                                            <label class="form-label" for="disabledInput">Tier</label>
                                            <p class="form-control-static" id="input_tier">WEB</p>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-4">
                                            <label class="form-label" for="disabledInput">Operating System</label>
                                            <p class="form-control-static" id="input_prefer_os">WEB</p>
                                        </div>
                                    </div>

                                        <hr style="margin-top: 5px;margin-bottom: 5px;">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4 col-4">
                                            <label class="form-label" for="disabledInput">vCPU</label>
                                            <p class="form-control-static" id="input_vcpu">WEB</p>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-4">
                                            <label class="form-label" for="disabledInput">vMemory</label>
                                            <p class="form-control-static" id="input_vmemory">WEB</p>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-4">
                                            <label class="form-label" for="disabledInput">vStorage</label>
                                            <p class="form-control-static" id="input_vstorage">WEB</p>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 5px;margin-bottom: 5px;">
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <label class="form-label" for="disabledInput">Mandatory Service Application</label>
                                        <p class="form-control-static" id="input_sam">WEB</p>
                                    </div>
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <label class="form-label" for="disabledInput">Selected Service Application</label>
                                        <p class="form-control-static" id="input_sao">WEB</p>
                                    </div>

                                    <form id="projectstoreserver" action="{{route("project.storeserver")}}" method="POST" accept-charset="UTF-8">
                                        <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                                        <input class="hidden" id="server_id" name="server_id" value="">
                                        <input class="hidden" name="project_id" value="{{ $project->id }}">
                                        <input class="hidden"  id="hostname" name="hostname" value="">
                                        <input class="hidden" id="environement" name="environment" value="">
                                        <input class="hidden" id="tier" name="tier" value="">
                                        <input class="hidden" id="operating_system" name="operating_system" value="">
                                        <input class="hidden" id="operating_system_option" name="operating_system_option" value="">
                                        <input class="hidden" id="cost" name="cost" value="">
                                        <input class="hidden" id="sa_m" name="sa_m" value="">
                                        <input class="hidden" id="sa_o" name="sa_o" value="">
                                        <input class="hidden" id="operating_system_option" name="operating_system_option" value="">
                                        <input class="hidden" id="v_cpu" name="v_cpu" value="">
                                        <input class="hidden" id="v_memory" name="v_memory" value="">
                                        <input class="hidden" id="total_storage" name="total_storage" value="">
                                    </form>
                                </div>
                                <form></form>



                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Submit</span>
                                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="create-app-submit" class="content text-center" role="tabpanel"
                             aria-labelledby="create-app-submit-trigger">
                            <h3>Submit 🥳</h3>
                            <p>Submit your app to kickstart your project.</p>
                            <img src="{{asset('images/illustration/pricing-Illustration.svg')}}" height="218"
                                 alt="illustration" />
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-success btn-submit">
                                    <span class="align-middle d-sm-inline-block d-none">Submit</span>
                                    <i data-feather="check" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / create app modal -->
