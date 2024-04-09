

<div wire:ignore.self class="modal fade" id="addNewInfra" tabindex="-1" aria-labelledby="addNewInfraTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewInfraTitle">Assign Infra {{$selected_server}}</h1>
                <p class="text-center">Update Selected Server :</p>


                <!-- form -->
                <form id="addNewInfraValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">

                    <input class="hidden" name="_token" value="{{ csrf_token() }}">
                    <input wire:model.live="selected_server" id="text_select_server" type="text" class="">
                    <div class="col-12">
                        <label class="form-label" for="environment">Environment </label>
                        <div wire:ignore>
                            <select wire:model="environment"  id="environment"  class="select2-env select2 form-select ">
                                @foreach($forms as $form)

                                    @foreach($form->envform as $envforms)
                                        @if($envforms->status===1)
                                            <option value="{{$envforms->id}}">{{$envforms->display_name}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        @error('environment')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="Tier ">Tier </label>
                        <div wire:ignore>
                            <select wire:model="tier"  id="Tier "  class="select2-env select2 form-select ">
                                @foreach($forms as $form)

                                    @foreach($form->tierform as $tierforms)
                                        @if($tierforms->status===1)
                                            <option value="{{$tierforms->id}}">{{$tierforms->display_name}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        @error('environment')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-12 text-center">
                        <button type="" wire:click="demo" class="btn btn-primary me-1 mt-1">test</button>
                        <button type="" wire:click="demo2" class="btn btn-primary me-1 mt-1">test</button>
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
    @script
    <script>
        setInterval(() => {
        //     var selectedValues = [];
        //     $('table#project-server-table tbody input[type="checkbox"].checkbox:checked').each(function () {
        //         selectedValues.push($(this).val());
        //     });
        //     if(selectedValues.length){
        //         Livewire.dispatch('getselected_server',[selectedValues]);
        //
        //     }


        window.addEventListener('get-server', event => {
            var selectedValues = [];
            $('table#project-server-table tbody input[type="checkbox"].checkbox:checked').each(function () {
                selectedValues.push($(this).val());
            });
            console.log(selectedValues.length);
            if(selectedValues.length){
                document.getElementById("text_select_server").value = selectedValues;
            }
        });
        }, 3000)






    </script>
    @endscript
</div>
<!--/ add new card modal  -->
