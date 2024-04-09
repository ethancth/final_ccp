

<div class="modal fade" id="addNewInfra" tabindex="-1" aria-labelledby="addNewInfraTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewInfraTitle">Assign Infra</h1>
                <p class="text-center">Update Selected Server :</p>


                <!-- form -->
                    <form id="newInfra"  class="row gy-1 gx-2 mt-75" action="{{route("project.server.update.infra")}}" method="POST" accept-charset="UTF-8">

                    <input class="hidden" name="_token" value="{{ csrf_token() }}">
                    <input name="selected_server" id="text_select_server" readonly type="text" class="hidden">
                        <input class="hidden" name="selected_project_id" value="{{ $project->id }}">
                    <div class="col-12">
                        <label class="form-label" for="environment">Environment </label>
                        <div>
                            <select  id="environment"  name='environment' class="select2-env select2 form-select ">
                                @foreach($forms as $form)

                                    @foreach($form->selectenvform as $envforms)
                                        @if($envforms->status===1)
                                            <option value="{{$envforms->id}}">{{$envforms->display_name}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="Tier ">Tier </label>
                        <div >
                            <select  id="Tier "  name='tier' class="select2-env select2 form-select ">
                                @foreach($forms as $form)

                                    @foreach($form->selecttierform as $tierforms)
                                        @if($tierforms->status===1)
                                            <option value="{{$tierforms->id}}">{{$tierforms->display_name}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- add new card modal  -->

</div>
<!--/ add new card modal  -->
