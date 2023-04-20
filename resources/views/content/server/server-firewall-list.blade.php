
@extends('layouts/contentLayoutMaster')

@section('title', 'Firewall Rules')

@section('content')
    <section class="form-control-repeater">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Firewall</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" class="invoice-repeater">
                            <div data-repeater-list="invoice">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">


                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="itemname">Service Name</label>
                                                <input type="text" readonly class="form-control-plaintext" id="staticprice" value="Http" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="itemname">Protocl & Type</label>
                                                <input type="text" readonly class="form-control-plaintext" id="staticprice" value="TCP : Inbound" />
                                            </div>
                                        </div>



                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="itemcost">Source</label>
                                                <input type="text" readonly class="form-control-plaintext" id="staticprice" value="Any" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="itemcost">Destination</label>
                                                <input type="text" readonly class="form-control-plaintext" id="staticprice" value="Any" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="itemcost">Port Range</label>
                                                <input type="text" readonly class="form-control-plaintext" id="staticprice" value="80" />
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12 mb-50">
                                            <div class="mb-1">
                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                    <i data-feather="x" class="me-25"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    <hr />
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-12">--}}
{{--                                    <button class="btn btn-icon btn-primary" type="button" data-repeater-create>--}}
{{--                                        <i data-feather="plus" class="me-25"></i>--}}
{{--                                        <span>Add New</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Invoice repeater -->
        </div>
    </section>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-repeater.js')) }}"></script>
@endsection
