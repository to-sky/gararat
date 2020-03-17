<div class="repeater">
    <div class="bg-white border pt-3 pr-3 pl-3 mb-3" data-repeater-list="specifications">
        <div data-repeater-item data-repeater-tabel class="mb-3 shadow-sm">
            <div class="card rounded-0 border">
                {{-- Card header --}}
                <div class="card-header border-0 c-grey-700 rounded-0">
                    <div class="row">
                        <div class="col-md-8">
                            <span class="va-m fsz-def c-red-500">Table</span>
                        </div>

                        <div class="col-md-4">
                            <div class="btn-group pull-right shadow-sm" role="group">
                                <button class="btn btn-sm bg-white text-primary"
                                        type="button"
                                        data-toggle="collapse" data-target="#table1"
                                        aria-expanded="true" data-item-collapse>
                                    <i class="ti-arrow-circle-up"></i>

                                    <button data-repeater-delete type="button"
                                            class="btn btn-sm bg-white text-danger" title="Delete table">
                                        <i class="ti-trash"></i>
                                    </button>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card body --}}
                <div class="card-body p-0 collapse show" id="table1" data-item-header>
                        <div class="col-md-12 border-bottom py-3">

                            {{-- Table title and description --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Title</span>
                                        </div>
                                        <input type="text" name="title" class="form-control"
                                               placeholder="English">
                                        <input type="text" name="title_ar" class="form-control"
                                               placeholder="Arabic">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Description</span>
                                        </div>
                                        <input type="text" name="description"
                                               class="form-control"
                                               placeholder="English">
                                        <input type="text" name="description_ar" class="form-control"
                                               placeholder="Arabic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--Row --}}
                        <div class="inputs border-top-0 p-15">
                            <div data-repeater-list="data">
                                <div data-repeater-item>
                                    <div class="row form-group">
                                        {{--Key inputs --}}
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Key</span>
                                                </div>
                                                <input type="text" name="key[]" class="form-control"
                                                       placeholder="English">
                                                <input type="text" name="key_ar[]" class="form-control"
                                                       placeholder="Arabic">
                                            </div>
                                        </div>

                                        {{--Value inputs --}}
                                        <div class="col-md-6">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Value</span>
                                                        </div>
                                                        <input type="text" name="value[]" class="form-control"
                                                               placeholder="English">
                                                        <input type="text" name="value_ar[]" class="form-control"
                                                               placeholder="Arabic">
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <button data-repeater-delete
                                                            type="button"
                                                            class="btn ml-1 px-1 py-0 py-1 text-danger"
                                                            title="Delete row">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button data-repeater-create type="button"
                                    class="btn btn-outline-light btn-sm btn-block shadow-sm text-success border">
                                <i class="ti-plus"></i> Add row
                            </button>
                        </div>
                </div>

            </div>
        </div>
    </div>

    <button data-repeater-create type="button" class="btn btn-outline-light btn-block bg-white text-success border">
        <i class="ti-plus"></i> Add table
    </button>
</div>



