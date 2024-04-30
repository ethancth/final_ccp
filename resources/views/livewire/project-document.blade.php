<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>{{$project->title}} </h1>
                <hr class="mb-2"/>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text">Total - {{$project->server->count()}} Server</h6>

                        </div>

                        <div>
                            <h6 class="text">Cost - <span
                                    class="badge badge-light-success profile-badge">RM {{$project->price}}</span></h6>

                        </div>
                    </div>

                </div>

                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text">Cluster -
                                @foreach($project->server()->distinct()->get(['display_tier'])  as $_value)
                                    <span
                                        class="badge badge-light-success profile-badge">{{$_value->display_tier}}</span>
                                    </span>
                                @endforeach
                            </h6>
                            <h6 class="text">Environment
                                - @foreach($project->server()->distinct()->get(['display_env'])  as $_value)
                                    <span
                                        class="badge badge-light-success profile-badge">{{$_value->display_env}}</span>
                                    </span>
                                @endforeach

                            </h6>

                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">CPU</h6>
                            <h3 class="mb-0">{{$project->server->sum('v_cpu')}} </h3>
                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">Memory</h6>
                            <h3 class="mb-0">{{$project->server->sum('v_memory')}} GB</h3>
                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">Storage</h6>
                            <h3 class="mb-0">{{$project->server->sum('total_storage')}} GB</h3>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>


    <div class="card">
        <div class="card-body">
            @if($project->status==2&&Auth::user()->hasPermissionTo('approver_level_1') || $project->status==4&&Auth::user()->hasPermissionTo('approver_level_3'))
            <button class="btn btn-primary" wire:click='store' type="submit">Save</button>
    @endif

            <form wire:submit.prevent="store">
                <input class="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="row g-1">

                        <div class="mb-1">
                            <label class="form-label">Capacity Check</label>
                            <div class="input-group">

                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input wire:model='capacity_check' @if($this->project->capacity_check) checked
                                               @endif class="form-check-input" type="checkbox" id="capacity_check"/>

                                    </div>

                                </div>
                                <input type="text" wire:model='capacity_note' class="form-control"
                                       placeholder="Capacity Note"/>


                            </div>

                            @error('capacity_check')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror

                            @error('capacity_note')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-1">
                            <label class="form-label">License Check</label>
                            <div class="input-group">

                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input wire:model='license_check' @if($this->project->license_check) checked
                                               @endif class="form-check-input" type="checkbox" id="license_check"/>

                                    </div>

                                </div>
                                <input type="text" wire:model='license_note' class="form-control"
                                       placeholder="License Note"/>


                            </div>

                            @error('license_check')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror

                            @error('license_note')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-1">
                            <label class="form-label">Work Order Check</label>
                            <div class="input-group">

                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input wire:model='work_order_check'
                                               @if($this->project->work_order_check) checked
                                               @endif class="form-check-input" type="checkbox" id="work_order_check"/>

                                    </div>

                                </div>
                                <input type="text" wire:model='work_order_note' class="form-control"
                                       placeholder="Work Order Note"/>


                            </div>

                            @error('work_order_check')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror

                            @error('work_order_note')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>

            </form>
        </div>
    </div>

</div>
