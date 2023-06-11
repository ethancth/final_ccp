<!-- Create Project Modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Create New Project</h1>
                    <p>Create New Project description.</p>
                </div>
                <form id="createProjectForm" route= {{ route('project.store') }} class="row" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-12">
                        <label class="form-label" for="modalProjectName">Project Name </label>
                        <input
                            type="text"
                            id="modalProjectName"
                            name="modalProjectName"
                            class="form-control"
                            placeholder="Project Name"
                            autofocus
                            data-msg="Please enter Project name"
                        />
                    </div>
                    <div class="col-12 mt-75 hidden">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="groupProject" />
                            <label class="form-check-label" for="groupProject"> Set as group project </label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create Project</button>
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
