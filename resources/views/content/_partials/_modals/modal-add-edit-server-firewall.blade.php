<div class="modal modal-slide-in fade" id="modalsslidein_rowform">
    <div class="modal-dialog sidebar-sm">
        <div class="add-new-record modal-content pt-0" id="modal_env_form" name="modalenvform">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="form-label" name="form-label">New Firewall Rule</h5>
            </div>

            <div class="modal-body flex-grow-1">
                <form class="needs-validation" novalidate id="envform" name="envform" action="{{route("server.firewall.store")}}" method="POST" accept-charset="UTF-8">
                    <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                    <input class="hidden" name="form_id" id="form_id" value="">
                    <input class="hidden" name="server_id" id="server_id" value="">
                    <div class="mb-1">
                        <label class="form-label" for="source">Source</label>

                        <input
                            type="text"
                            id="source"
                            pattern="[\w,./_=?-]+"
                            name="source"
                            class="form-control"
                            placeholder="e.g. any/other DFW"
                            aria-label="Name"
                            required
                            aria-describedby="source"
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter Firewall Source.</div>
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



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
