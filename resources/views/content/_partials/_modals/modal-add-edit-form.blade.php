<div class="modal modal-slide-in fade" id="modalsslideinform">
    <div class="modal-dialog sidebar-sm">
        <div class="add-new-record modal-content pt-0" id="modal_env_form" name="modalenvform">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="form-label" name="form-label">New Record</h5>
            </div>

            <div class="modal-body flex-grow-1">
                <form class="needs-validation" novalidate id="envform" name="envform" action="{{route("management.env.store")}}" method="POST" accept-charset="UTF-8">
                    <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                    <input class="" name="form_id" id="form_id" value="">
                    <div class="mb-1">
                        <label class="form-label" for="basic-addon-name">Name</label>

                        <input
                            type="text"
                            id="basic-addon-name"
                            name="basic_addon_name"
                            class="form-control"
                            placeholder="e.g. Production"
                            aria-label="Name"
                            required
                            aria-describedby="basic-addon-name"
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter Environment name.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-display-name">Display Name</label>
                        <input
                            type="text"
                            id="basic-default-display-name"
                            name="basic_default_display_name"

                            class="form-control"
                            placeholder="Production Environment"
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
                            placeholder="Short sentence about environment.."
                            minlength="5"
                            required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter your sentence.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="select-colour">Color Label</label>
                        <select class="form-select" id="select-colour" name="select_colour" required>
                            <option value="">Select Colour</option>
                            <option value="danger">Red</option>
                            <option value="success">Green</option>
                            <option value="warning">Yellow</option>
                            <option value="info">Blue</option>
                            <option value="primary">Purple</option>
                            <option value="secondary">Grey</option>
                            <option value="dark">Black</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select colour label</div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="basic-default-icon">Icon</label>
                        <input
                            type="text"
                            id="basic-default-icon"
                            name="basic_default_icon"
                            class="form-control"
                            placeholder="Feather Icon value"
                            value="box"
                            required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter valid icon.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="select-status">Status</label>
                        <select class="form-select" id="select-status" name="select_status" required>
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select colour label</div>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
