<!-- Create Project Modal -->
<div class="modal fade" id="createProjectSecurityGroupModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Create Security Group</h1>
                </div>
                <form id="createProjectSecurityGroupForm" action= {{ route('project.securitygroup.store') }} class="row" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_pid" value="{{ $project->id }}">
                    <input type="hidden" name="_id" value="">
                    <div class="col-12">
                        <label class="form-label" for="name">Security Group Name </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="SecurityGroup Name"
                            autofocus
                            data-msg="Please enter Security Group name"
                        />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create Security Group</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
