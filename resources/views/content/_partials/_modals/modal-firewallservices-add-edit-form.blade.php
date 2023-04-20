<div class="modal modal-slide-in fade" id="modalsslideinform">
    <div class="modal-dialog sidebar-sm">
        <div class="add-new-record modal-content pt-0" id="modal_env_form" name="modalenvform">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="form-label" name="form-label">New Record</h5>
            </div>

            <div class="modal-body flex-grow-1">
                <form class="needs-validation" novalidate id="envform" name="envform" action="{{route("management_firewall_service.store")}}" method="POST" accept-charset="UTF-8">
                    <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                    <input class="hidden" name="form_id" id="form_id" value="">
                    <div class="mb-1">
                        <label class="form-label" for="basic-addon-name">Serice Name</label>

                        <input
                            type="text"
                            id="basic-addon-name"
                            pattern="[\w,./_=?-]+"
                            name="basic_addon_name"
                            class="form-control"
                            placeholder="e.g. SSH MYSQL"
                            aria-label="Name"
                            required
                            aria-describedby="basic-addon-name"
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter Firewall Service name.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="select-satype">Protocol Type</label>
                        <select class="form-select" id="select-type" name="select_type" required>
                            <option value="">Select the type</option>
                            <option value="TCP">TCP</option>
                            <option value="UDP">UDP</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select protocol type</div>
                    </div>

                                        <div class="mb-1">
                                            <label class="form-label" for="basic-default-display-name">Port Range</label>
                                            <input
                                                type="text"
                                                id="basic-port-range"
                                                name="basic_port_range"

                                                class="form-control"
                                                placeholder="Enter a single port (80) or range (8000-9000), or leave blank for all ports"
                                                aria-label="Port Range"
                                            />
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Port Range Required. Enter a single port (80) or range (8000-9000), or leave blank for all ports</div>
                                        </div>


                    <div class="mb-1">
                        <label class="form-label" for="select-satype">Rule</label>
                        <select class="form-select select_rule_type" id="select-rule_type" name="select_rule_type" required>
                            <option value="">Select the type</option>
                            <option value="Inbound">Inbound</option>
                            <option value="Outbound">Outbound</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select Firewall Rule</div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="basic-default-cost-per-core" id="label-source-destination">Target</label>
                        <input
                            type="text"
                            id="basic-source-destination"
                            name="basic_source_destination"
                            class="form-control"
                            placeholder="e.g. All IPv4,All IPv6"
                            min="1"
                            required
                            disabled
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter Target Server.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="select-status">Status</label>
                        <select class="form-select" id="select-status" name="select_status" required>
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select Status label</div>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
