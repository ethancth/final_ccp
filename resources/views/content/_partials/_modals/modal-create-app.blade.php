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
                        <div class="step" data-target="#create-app-operating-system" role="tab"
                             id="create-app-operating-system-trigger">
                            <button type="button" class="step-trigger py-75">
                                <span class="bs-stepper-box">
                                    <i data-feather="server" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Operating System</span>
                                    <span class="bs-stepper-subtitle">OS details</span>
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
                            <form>
                                <h5>Server Name</h5>
                                <input class="form-control" type="text" placeholder="Server Name" value=""
                                       id="username" name="username" />

                                <h5 class="mt-2 pt-1">Environment</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-0 px-0">
                                        <label for="createAppProduction" class="d-flex cursor-pointer">
                                            <span class="avatar avatar-tag bg-light-info me-1">
                                                <i data-feather="briefcase" class="font-medium-5"></i>
                                            </span>
                                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                <span class="me-1">
                                                    <span class="h5 d-block fw-bolder">Production</span>
                                                    <span>Scales with Any Business</span>
                                                </span>
                                                <span>
                                                    <input class="form-check-input" id="createAppProduction"
                                                           type="radio" name="categoryEnvironment" checked />
                                                </span>
                                            </span>
                                        </label>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <label for="createAppStaging" class="d-flex cursor-pointer">
                                            <span class="avatar avatar-tag bg-light-success me-1">
                                                <i data-feather="layers" class="font-medium-5"></i>
                                            </span>
                                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                <span class="me-1">
                                                    <span class="h5 d-block fw-bolder">Staging</span>
                                                    <span>One more step to Production</span>
                                                </span>
                                                <span>
                                                    <input class="form-check-input" id="createAppStaging" type="radio"
                                                           name="categoryEnvironment" />
                                                </span>
                                            </span>
                                        </label>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <label for="createAppDevelopment" class="d-flex cursor-pointer">
                                            <span class="avatar avatar-tag bg-light-danger me-1">
                                                <i data-feather="sliders" class="font-medium-5"></i>
                                            </span>
                                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                <span class="me-1">
                                                    <span class="h5 d-block fw-bolder">Development</span>
                                                    <span>Start develop today</span>
                                                </span>
                                                <span>
                                                    <input class="form-check-input" id="createAppDevelopment"
                                                           type="radio" name="categoryEnvironment" />
                                                </span>
                                            </span>
                                        </label>
                                    </li>
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
                            <form>
                                <h5>Select Tier</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-0 px-0">
                                        <label for="createAppReactNative" class="d-flex cursor-pointer">
                                            <span class="avatar avatar-tag bg-light-info me-1">
                                                <img src="{{asset('images/icons/iconsccp/web-48.png')}}" height="25"
                                                     alt="web" />
                                            </span>
                                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                <span class="me-1">
                                                    <span class="h5 d-block fw-bolder">Web</span>
                                                    <span>Create truly native apps</span>
                                                </span>
                                                <span>
                                                    <input class="form-check-input" id="createTierWeb" type="radio"
                                                           name="tierRadio" />
                                                </span>
                                            </span>
                                        </label>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <label for="createAppAngular" class="d-flex cursor-pointer">
                                            <span class="avatar avatar-tag bg-light-danger me-1">
                                                <img src="{{asset('images/icons/iconsccp/apps-48.png')}}" height="25"
                                                     alt="apps" />
                                            </span>
                                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                <span class="me-1">
                                                    <span class="h5 d-block fw-bolder">Apps</span>
                                                    <span>Most suited to your application</span>
                                                </span>
                                                <span>
                                                    <input class="form-check-input" id="createTierApp" type="radio"
                                                           name="tierRadio" checked />
                                                </span>
                                            </span>
                                        </label>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <label for="createTierDatabase" class="d-flex cursor-pointer">
                                            <span class="avatar avatar-tag bg-light-success me-1">
                                                <img src="{{asset('images/icons/iconsccp/database-40.png')}}" height="25"
                                                     alt="database" />
                                            </span>
                                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                <span class="me-1">
                                                    <span class="h5 d-block fw-bolder">Database</span>
                                                    <span>A way to store data.</span>
                                                </span>
                                                <span>
                                                    <input class="form-check-input" id="createTierDatabase" type="radio"
                                                           name="tierRadio" />
                                                </span>
                                            </span>
                                        </label>
                                    </li>
                                </ul>
                            </form>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                    </button>
                                </div>

                        </div>

                        <div id="create-app-operating-system" class="content" role="tabpanel"
                             aria-labelledby="create-app-operating-system-trigger">
                            <form>
                            <h5>Operating System Name</h5>

                            <input class="form-control" type="text" name="operatingsystem"
                                   placeholder="Prefer OS version" />

                            <h5 class="mt-2 pt-1">Select Operating System Platform</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 px-0">
                                    <label for="createAppWindows" class="d-flex cursor-pointer">
                                        <span class="avatar avatar-tag bg-light-danger me-1">
                                            <img src="{{asset('images/icons/iconsccp/microsoft-windows.png')}}"
                                                 height="30" alt="Windows" />
                                        </span>
                                        <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                            <span class="me-1">
                                                <span class="h5 d-block fw-bolder">Microsoft Windows</span>
                                                <span>Microsoft Windows</span>
                                            </span>
                                            <span>
                                                <input class="form-check-input" id="createAppWindows" type="radio"
                                                       name="osRadio" />
                                            </span>
                                        </span>
                                    </label>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <label for="createAppRHEL" class="d-flex cursor-pointer">
                                        <span class="avatar avatar-tag bg-light-secondary me-1">
                                            <img src="{{asset('images/icons/iconsccp/rhel-48.png')}}" height="45"
                                                 alt="RHEL" />
                                        </span>
                                        <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                            <span class="me-1">
                                                <span class="h5 d-block fw-bolder">Red Hat Enterprise Linux</span>
                                                <span>Red Hat Enterprise Linux</span>
                                            </span>
                                            <span>
                                                <input class="form-check-input" id="createAppRHEL" type="radio"
                                                       name="osRadio" checked />
                                            </span>
                                        </span>
                                    </label>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <label for="createAppCentos" class="d-flex cursor-pointer">
                                        <span class="avatar avatar-tag bg-light-info me-1">
                                            <img src="{{asset('images/icons/iconsccp/centos-48.png')}}" height="35"
                                                 alt="Centos" />
                                        </span>
                                        <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                            <span class="me-1">
                                                <span class="h5 d-block fw-bolder">Centos</span>
                                                <span>Centos</span>
                                            </span>
                                            <span>
                                                <input class="form-check-input" id="createAppCentos" type="radio"
                                                       name="osRadio" />
                                            </span>
                                        </span>
                                    </label>
                                </li>
                            </ul>
                            </form>
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next btn-alert1123">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>

                        <div id="create-app-compute" class="content" role="tabpanel"
                             aria-labelledby="create-app-compute-trigger">
                            <form>
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
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>

                        <div id="create-app-review" class="content" role="tabpanel"
                             aria-labelledby="create-app-review-trigger">
                            <div class="col-sm-12 col-md-12">
                                <form>
                                <div class="card-header" style="
                                    padding-left: 0px;">

                                    <h5 class="card-title" style="margin-bottom: 1px;" name="review_server">
                                        ServerHostname <small class="text-muted"> Server</small>
                                    </h5>
                                    <hr>
                                    <h5 class="card-title" style="margin-bottom: 1px; ">
                                        Production <small class="text-muted"> Environment</small>
                                    </h5>
                                    <hr>
                                    <h5 class="card-title" style="margin-bottom: 1px; ">
                                        Web <small class="text-muted"> Tier</small>
                                    </h5>
                                    <hr>
                                    <h5 class="card-title" style="margin-bottom: 1px; ">
                                        Microsoft Windows<small class="text-muted"> Operating System </small>
                                    </h5>
                                    <hr>
                                    <h5 class="card-title" style="margin-bottom: 1px; ">
                                        25 <small class="text-muted"> vCPU</small>
                                    </h5>
                                    <hr>
                                    <h5 class="card-title" style="margin-bottom: 1px; ">
                                        48 <small class="text-muted"> GB vMemory</small>
                                    </h5>
                                    <hr>
                                    <h5 class="card-title" style="margin-bottom: 1px; ">
                                        600 <small class="text-muted"> GB vStorage</small>
                                    </h5>

                                </div>
                                </form>



                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
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
