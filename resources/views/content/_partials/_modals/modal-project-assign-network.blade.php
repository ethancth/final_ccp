<!-- add new address modal -->
<div class="modal fade" id="addNetwork" tabindex="-1" aria-labelledby="addNetwork" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-4 mx-50">
                <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Assign Network</h1>
                <p class="address-subtitle text-center mb-2 pb-75">Assign Network Base on Cluster</p>

                <form id="addNewAnyForm" class="needs-validation row gy-1 gx-2 " action="{{route("store_network")}}" method="POST" accept-charset="UTF-8">
                    <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                    <input class="hidden" id="form_server_id" name="form_server_id" value="">

                    <div class="col-12 port-form">
                        <div data-repeater-list="network_port_group">
                            <label class="form-label" for="modalPort">Network Port Group </label>
                            <div data-repeater-item>
                                <div class="row d-flex align-items-end">
                                    <div class="col-md-5 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="itemname">Nic</label>
                                            <select required class="form-select  select2-network" name="type" id="select2-custom-nic" >
                                                <option disabled selected value> Select Network </option>
                                             @foreach($available_network as $value)
                                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-5 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="ipaddress">IP Address</label>
                                            <input
                                                disabled
                                                type="text"
                                                class="form-control"
                                                id="ipaddress"
                                                name="ipaddress"
                                                aria-describedby="ipaddress"
                                                placeholder="xxx.xxx.xxx.xxx"
                                            />
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12 mb-50">
                                        <div class="mb-1">
                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                <i data-feather="x" class="me-25"></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
