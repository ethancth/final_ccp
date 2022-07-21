<div class="modal modal-slide-in update-item-sidebar fade"  id="ProjectActivityModal">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title">Update Item</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <ul class="nav nav-tabs tabs-line">
                    <li class="nav-item">
                        <a class="nav-link nav-link-activity active" data-bs-toggle="tab" href="#tab-activity">
                            <i data-feather="activity"></i>
                            <span class="align-middle">Activity</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-2">
                    <div class="tab-pane tab-pane-update fade show active" id="tab-update" role="tabpanel">
                        @foreach ($projectservers as $server)
                            <div class="d-flex align-items-start mb-1">
                                <div class="avatar bg-light-success my-0 ms-0 me-50">
                                    <span class="avatar-content">SA</span>
                                </div>
                                <div class="more-info">
                                    <p class="mb-0"><span class="fw-bold">{{ Auth::user()->name }}</span> create server : {{ $server->hostname}}</p>
                                    <small class="text-muted">{{$server->created_at}}</small>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex align-items-start mb-1">
                            <div class="avatar bg-light-success my-0 ms-0 me-50">
                                <span class="avatar-content">SA</span>
                            </div>
                            <div class="more-info">
                                <p class="mb-0"><span class="fw-bold">{{ Auth::user()->name }}</span> create project : {{ $project->title}}</p>
                                <small class="text-muted">{{$project->created_at}}</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
