<!-- create app modal -->
<div class="modal fade" id="modal_cost" tabindex="-1" aria-labelledby="modal_cost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="text-center mb-1" id="createAppTitle">Server Cost</h1>
                    <!-- content -->

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="py-1">Item description</th>
                            <th class="py-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="py-1">
                                <p class="card-text  mb-25">vCPU</p>
                            </td>

                            <td class="py-1">
                                <span class="" id="vcost_vcpu"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <p class="card-text  mb-25">vMemory</p>
                            </td>

                            <td class="py-1">
                                <span class="" id="vcost_memory"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <p class="card-text  mb-25">Storage</p>
                            </td>

                            <td class="py-1">
                                <span class="" id="vcost_vstorage"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <p class="card-text  mb-25">Operating System</p>
                            </td>

                            <td class="py-1">
                                <span class="" id="vcost_vos"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <p class="card-text fw-bold mb-0">Other Services</p>
                                <p class="card-text  ml-10 mb-25 text-nowrap" id="to_be_replaced"> - Backup</p>
                            </td>


                            <td class="py-1">
                                <span class="" id="vcost_backup_m"
                                      data-bs-toggle="tooltip"
                                      data-bs-placement="top"
                                      title="Monthly Cost"
                                >
                                    <p id="to_be_replaced_cost">

                                    </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="py-1">
                                <p class="card-text  fw-bold  mb-25">Total</p>
                            </td>

                            <td class="py-1">
                                <span class=" fw-bold" id="vcost_total"
                                      data-bs-toggle="tooltip"
                                      data-bs-placement="top"
                                      title="Monthly Cost">$2</span>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>





            </div>
        </div>
    </div>
</div>
<!-- / create app modal -->
