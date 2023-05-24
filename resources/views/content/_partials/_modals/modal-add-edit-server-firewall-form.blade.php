<!-- add new address modal -->
<div class="modal fade" id="ServerFirewallForms" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-4 mx-50">
                <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Add New Firewall</h1>
                <p class="address-subtitle text-center mb-2 pb-75">Add new Firewall Rules</p>

                <form id="addNewAnyForm" class="needs-validation row gy-1 gx-2 " action="{{route("project.firewall.new")}}" method="POST" accept-charset="UTF-8">
                        <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                        <input class="hidden" id="form_id" name="form_id" value="">
                        <input class="hidden" id="project_id" name="project_id" value="{{$project->id}}">

                    <div class="col-12">
                        <label class="form-label" for="modalCustomIP">Source</label>
                        <div class="row custom-options-checkable">
                            <div class="col-md-6 mb-md-0 mb-2">
                                <input
                                    class="custom-option-item-check"
                                    id="SourceAnyRadio"
                                    type="radio"
                                    name="newSource"
                                    value="Any"
                                    checked
                                    onclick="showany();"
                                />
                                <label for="SourceAnyRadio" class="custom-option-item px-2 py-1">
                  <span class="d-flex align-items-center mb-50">
                    <i data-feather="globe" class="font-medium-4 me-50"></i>
                    <span class="custom-option-item-title h4 fw-bolder mb-0">Any</span>
                  </span>
                                    <span class="d-block">Source from any</span>
                                </label>
                            </div>
                            <div class="col-md-6 mb-md-0 mb-2">
                                <input
                                    class="custom-option-item-check"
                                    id="SourceCustomRadio"
                                    type="radio"
                                    name="newSource"
                                    value="custom"
                                    onclick="show();"
                                />
                                <label for="SourceCustomRadio" class="custom-option-item px-2 py-1">
                  <span class="d-flex align-items-center mb-50">
                    <i data-feather="list" class="font-medium-4 me-50"></i>
                    <span class="custom-option-item-title h4 fw-bolder mb-0">Custom</span>
                  </span>
                                    <span class="d-block">Source from the list</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4" id ="div-ip" style="display:none">
                        <label class="form-label" for="modalCustomIP">IP</label>
                        <select id="modalCustomIP" name="modalCustomIP[]" multiple="multiple" class="select2 form-select  js-select2-port">
                            <option value="">Enter IP</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4" id ="div-vm" style="display:none">
                        <label class="form-label" for="modalCustomVm">Virtual Machine</label>
                        <select id="modalCustomVm" name="modalCustomVm[]" multiple="multiple" class="select2 form-select ">
                            <option value="">Select a Virtual Machine</option>
                            @foreach($vcvms as $vcvc)
                                <option value="{{$vcvc->id}}">{{$vcvc->vm_hostname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-4" id ="div-sg" style="display:none">
                        <label class="form-label" for="modalCustomSecurityGroup">Security Group</label>

                        <select id="modalCustomSecurityGroup" name="modalCustomSecurityGroup[]" multiple="multiple" class="select2 form-select ">
                            <option value="">Select a Security Group</option>
                            @foreach($projectsgs as $value)
                                <option value="{{$value->id}}">{{$value->slug}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalPort">Destination</label>
                        <select id="modalDestination" name="modalDestination[]" class="select2 form-select">
                            @foreach($projectsgs as $value)
                                <option value="{{$value->id}}">{{$value->slug}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalPort">Service/Port</label>
                        <select id="modalPort" name="modalPort[]" multiple="multiple" class="select2 form-select js-select2-port">
                            $firewallservice
                            @foreach($firewallservice as $value)
                                <option value="{{$value->port}}">{{$value->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddressFirstName">Name</label>
                        <input
                            type="text"
                            id="modalFirewallName"
                            name="modalFirewallName"
                            class="form-control"
                            placeholder="Name for the firewall"
                            data-msg="Name for the firewall"
                        />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-1 mt-2">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / add new address modal -->
