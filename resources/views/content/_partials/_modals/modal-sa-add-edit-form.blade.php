<div class="modal modal-slide-in fade" id="modalsslideinform">
    <div class="modal-dialog sidebar-sm">
        <div class="add-new-record modal-content pt-0" id="modal_env_form" name="modalenvform">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="form-label" name="form-label">New Record</h5>
            </div>

            <div class="modal-body flex-grow-1">
                <form class="needs-validation" novalidate id="envform" name="envform" action="{{route("management.sa.store")}}" method="POST" accept-charset="UTF-8">
                    <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                    <input class="hidden" name="form_id" id="form_id" value="">
                    <div class="mb-1">
                        <label class="form-label" for="basic-addon-name">Name</label>

                        <input
                            type="text"
                            id="basic-addon-name"
                            pattern="[\w,./_=?-]+"
                            name="basic_addon_name"
                            class="form-control"
                            placeholder="e.g. MySQL Service"
                            aria-label="Name"
                            required
                            aria-describedby="basic-addon-name"
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter Service Application name.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-display-name">Display Name</label>
                        <input
                            type="text"
                            id="basic-default-display-name"
                            name="basic_default_display_name"

                            class="form-control"
                            placeholder="MySQL 5.8.."
                            aria-label="Display Name"
                            required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter a display name</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-password1">Description</label>
                        <input
                            type="text"
                            id="basic-default-desc"
                            name="basic_default_desc"
                            class="form-control"
                            placeholder="Short sentence about service application.."
                            minlength="5"
                            required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter your sentence.</div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="basic-default-password1">Cost</label>
                        <input
                            type="decimal"
                            id="basic-default-cost"
                            name="basic_default_cost"
                            class="form-control"
                            placeholder="$10"
                            min="1"
                            pattern="^\d*(\.\d{0,2})?$"
                            required
                        />
                        <small>This cost is Cost per day(temporary)</small>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter your Cost.</div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="select-satype">Cost Type</label>
                        <select class="form-select select_sa_type" id="select-satype" name="select_satype" required>
                            <option value="">Select the type</option>
                            <option value="1">Cost Per License</option>
                            <option value="2">Cost Per Core</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select cost type</div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="basic-default-cost-per-core">Number of Core</label>
                        <input
                            type="number"
                            id="basic-default-cost-per-core"
                            name="basic_default_cost_per_core"
                            class="form-control"
                            placeholder="e.g. 2"
                            min="1"
                            required
                            disabled
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter core number per license.</div>
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
