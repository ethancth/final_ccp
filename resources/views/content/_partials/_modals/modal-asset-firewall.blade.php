<!-- customsource modal -->

<div class="modal fade" id="assetFirewallModal" tabindex="-1" aria-labelledby="twoFactorAuthTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 mx-50">
                <h1 class="text-center mb-1" id="twoFactorAuthTitle">Create New Firewall Rules</h1>
                <p class="text-center mb-3">
                   Select the source type from below option:
                </p>

                <div class="custom-options-checkable">
                    <input
                        class="custom-option-item-check"
                        type="radio"
                        name="FirewallRoleRadio"
                        id="anyMethod"
                        value="any-method"
                        checked
                    />
                    <label
                        for="anyMethod"
                        class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2 mb-2"
                    >
                                <span><i data-feather="globe" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
                                <span>
                      <span class="custom-option-item-title h3">Any</span>
                      <span class="d-block mt-75">
                       Allows all traffic on any port from any source to selected Security Group.
                      </span>
                    </span>
                    </label>

                    <input
                        class="custom-option-item-check"
                        type="radio"
                        name="FirewallRoleRadio"
                        value="custom-method"
                        id="customMethod"
                    />
                    <label
                        for="customMethod"
                        class="custom-option-item d-flex align-items-center flex-column flex-sm-row px-3 py-2"
                    >
                        <span><i data-feather="align-justify" class="font-large-2 me-sm-2 mb-2 mb-sm-0"></i></span>
                        <span>
              <span class="custom-option-item-title h3">Custom</span>
              <span class="d-block mt-75"
              >Allows custom traffic to selected Security Group.</span
              >
            </span>
                    </label>
                </div>

                <button id="nextStepAuth" class="btn btn-primary float-end mt-3">
                    <span class="me-50">Continue</span>
                    <i data-feather="chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- add authentication sms modal-->
<div
    class="modal fade"
    id="twoFactorAuthSmsModal"
    tabindex="-1"
    aria-labelledby="twoFactorAuthSmsTitle"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth-sms">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 mx-50">
                <h1 class="text-center mb-2 pb-50" id="twoFactorAuthSmsTitle">Custom source option</h1>

                <form id="firewall_source">
                    <div class="col-12">
                        IP Address
                        <select id="1modalCustomIP" name="1modalCustomIP[]" multiple="multiple" class="select2 form-select  js-select2-port">
                            <option value="">Enter IP</option>
                        </select>
                    </div>

                    <div class="col-12">
                        Virtual Machine
                        <select id="1modalCustomVm" name="1modalCustomVm[]" multiple="multiple" class="select2 form-select ">
                            <option value="">Select a Virtual Machine</option>
                            @foreach($vcvms as $vcvc)
                                <option value="{{$vcvc->id}}">{{$vcvc->vm_hostname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        Security Group
                        <select id="1modalCustomSecurityGroup" name="1modalCustomSecurityGroup[]" multiple="multiple" class="select2 form-select ">
                            <option value="">Select a Security Group</option>
                            @foreach($projectsgs as $value)
                                <option value="{{$value->id}}">{{$value->slug}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="col-12 d-flex justify-content-end">
                    <button type="reset" class="btn btn-outline-secondary mt-1 me-1" data-bs-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button id="sourcenextstep" class="btn btn-primary mt-1">
                        <span class="me-50">Continue</span>
                        <i data-feather="chevron-right"></i>
                    </button>
                </div>


            </div>
        </div>
    </div>
</div>
<div
    class="modal fade"
    id="destinationModal"
    tabindex="-1"
    aria-labelledby="anyMethodTitle"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth-apps">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pb-5 px-sm-5 mx-50">
                <h1 class="text-center mb-2 pb-50" id="anyMethodTitle">Create New Firewall Rules </h1>
                <p class="text-center mb-3">
                    Select the destination security group:
                </p>

                <form id="firewall_destination">
                    <div class="col-12">
                        <label class="form-label" for="modalPort">Destination</label>
                        <select id="modalDestination" name="modalDestination[]" class="select2 form-select">
                            @foreach($projectsgs as $value)
                                <option value="{{$value->id}}">{{$value->slug}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-secondary mt-2 me-1" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                        <button id="destinationnextstep" class="btn btn-primary mt-2">
                            <span class="me-50">Continue</span>
                            <i data-feather="chevron-right"></i>
                        </button>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- / add authentication apps modal-->


<div class="modal fade" id="assetFirewallPortModal" tabindex="-1" aria-labelledby="twoFactorAuthTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 mx-50">
                <h1 class="text-center mb-1" id="twoFactorAuthTitle">Create New Firewall Rules</h1>
                <p class="text-center mb-3">
                    Service/Port:
                </p>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{--                            <form action="#" class="port-form">--}}
                            <form id="addNewAnyForm" class=" row gy-1 gx-2 port-form" action="{{route("demo")}}" method="POST" accept-charset="UTF-8">
                                <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                                <input class="hidden"  name="project_id" value="{{$project->id}}">
                                <input class="hidden" id="_firewall_type" name="_firewall_type" value="">
                                <div data-repeater-list="portserviceform">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemname">Type</label>
                                                    <select required class="hide-search form-select select2-custom-port" name="type" id="select2-custom-port" >
                                                        <option selected value="custom">Custom</option>
                                                        <option value="ssh">SSH</option>
                                                        <option value="http">Http</option>
                                                        <option value="https">Https</option>
                                                        <option value="mysql">Mysql</option>
                                                        <option value="alltcp">All TCP</option>
                                                        <option value="alludp">All UDP</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemcost">Protocol</label>
                                                    <select required class="form-select " name="protocol" id="protocol" >
                                                        <option value="tcp">TCP</option>
                                                        <option value="udp">UDP</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemquantity">Port Range</label>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        id="portrange"
                                                        name="portrange"
                                                        aria-describedby="itemquantity"
                                                        placeholder="empty for all port"
                                                    />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12 mb-50">
                                                <div class="mb-1">
                                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                        <i data-feather="x" class="me-25"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                            <i data-feather="plus" class="me-25"></i>
                                            <span>Add New</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <button id="submitfirewall" class="btn btn-primary float-end mt-3">
                    <span class="me-50">Submit</span>
                    <i data-feather="chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>


