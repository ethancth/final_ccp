<div class="scrolling-inside-modal">
    <!-- Button trigger modal -->
    <button
        type="button"
        class="btn btn-outline-primary"
        data-bs-toggle="modal"
        data-bs-target="#addNewAddressModal"
    >
        Scrolling Content Inside Modal
    </button>

    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModalScrollable"
        tabindex="-1"
        aria-labelledby="exampleModalScrollableTitle"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewAddressModal" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">

            <div class="modal-content">

                <div class="modal-header bg-transparent">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Add New Policy Form</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body pb-5 px-sm-4 mx-50">
                    <form id="addNewPolicyForm" class="needs-validation row gy-1 gx-2 " action="{{route("management_policyform.store")}}" method="POST" accept-charset="UTF-8">
                        <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                        <input class="hidden" id="form_id" name="form_id" value="">
                        <input class="hidden" id="form_group_a" name="form_group_a" value="">
                        <input class="hidden" id="form_group_b" name="form_group_b" value="">
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="modalFormEnv"><h3>Environment</h3></label>
                            <select id="modalFormEnv" name="modalFormEnv" class="select2 form-select" required>
                                @foreach ($envforms as $envform)
                                    @if($envform->status==1)
                                    <option value="{{$envform->id}}">{{$envform->display_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please select colour label</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="modalFormTier"><h3>Tier</h3></label>
                            <select id="modalFormTier" name="modalFormTier" class="select2 form-select">
                                @foreach ($tierforms as $tierform)
                                    @if($tierform->status==1)
                                        <option value="{{$tierform->id}}">{{$tierform->display_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="modalFormOs"><h3>Operating System</h3></label>
                            <select id="modalFormOs" name="modalFormOs" class="select2 form-select">
                                @foreach ($osforms as $osform)
                                    @if($osform->status==1)
                                        <option value="{{$osform->id}}">{{$osform->display_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <hr style=" border: 1px solid">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <h4 class="my-1">All Service Application</h4>
                                <ul class="list-group list-group-flush" id="multiple-list-group-c">
                                    <li class="list-group-item" value="">
                                        <div class="d-flex">
                                            <div class="more-info">
                                                <h5>Service Application Option</h5>
                                                <small>Try Drag below Application to Mandatory or Optional</small>

                                            </div>
                                        </div>
                                    </li>
                                    @foreach ($saforms as $saform)
                                        @if($saform->status==1)
                                            <li class="list-group-item draggable" value="{{$saform->id}}">
                                                <div class="d-flex">
                                                    <div class="more-info">
                                                        <h5>{{$saform->display_name}}</h5>
                                                        <span>{{$saform->display_description}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <h4 class="my-1">Mandatory </h4>
                                <small>This service application will be forced to choose<p>Drag the service below </small>
                                <ul class="list-group list-group-flush" id="multiple-list-group-a">

                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <h4 class="my-1">Optional </h4>
                                <small>This service application will be optional <p>Drag the service below</small>
                                <ul class="list-group list-group-flush" id="multiple-list-group-b">

                                </ul>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-1 mt-2 demo">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
