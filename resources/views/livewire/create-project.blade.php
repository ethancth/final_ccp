<!-- Create Project Modal -->
<div wire:ignore.self class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{$modal_title}}</h1>
                    <p>{{$modal_title_description}}</p>
                </div>
                <form id="createProjectForm" class="row" method="POST" accept-charset="UTF-8" wire:submit.prevent="storeProject">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-12">
                        <label class="form-label" for="title">Project Name </label>
                        <input
                            wire:model="title"
                            type="text"

                            name="title"
                            class="form-control"
                            placeholder="Project Name"
                            autofocus
                            required
                            data-msg="Please enter Project name"
                        />
                        @error('title')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 mt-75 ">
                        <div class="form-check">
                            <input wire:model="is_bau_project" class="form-check-input" type="checkbox" id="groupProject" />
                            <label class="form-check-label" for="groupProject"> is BAU project? </label>
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
