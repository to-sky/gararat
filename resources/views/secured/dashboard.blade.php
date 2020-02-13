@extends('layouts.secured')

@section('title') Dashboard @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="masonry-item w-100">
                <div class="row gap-20">
                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Total Parts</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">
                                            {{ count($parts) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Total Equipment</h6>
                            </div>
                            <div class="layer w-100">

                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">
                                            {{ count($equipments) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10"><h6 class="lh-1">Total Orders</h6></div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">
                                            {{ count($orders) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10"><h6 class="lh-1">Total Users</h6></div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">
                                            {{ count($users) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
