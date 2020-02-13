@extends('layouts.secured')

@section('title') Add part @endsection

@section('content')
    <form action="{{ route('saveNewPartsAPI') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @include('secured.nodes.blocks._basic')

            <!-- Parts Fields -->
            <div class="col-12" style="margin-bottom: 20px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Parts</h6>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="figNameEn">Fig. Name En</label>
                            <input type="text" class="form-control" name="figNameEn" id="figNameEn">
                        </div>
                        <div class="col-6">
                            <label for="figNameAr">Fig. Name Ar</label>
                            <input type="text" class="form-control" name="figNameAr" id="figNameAr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="partGroup">Group</label>
                            <input type="text" class="form-control" name="partGroup" id="partGroup">
                        </div>
                        <div class="col-4">
                            <label for="figNumber">Fig. Number</label>
                            <input type="text" class="form-control" name="figNumber" id="figNumber">
                        </div>
                        <div class="col-4">
                            <label for="posNumber">Pos. Number</label>
                            <input type="text" class="form-control" name="posNumber" id="posNumber">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="qty">QTY</label>
                            <input type="text" class="form-control" name="qty" id="qty">
                        </div>
                        <div class="col-4">
                            <label for="producerId">Producer ID</label>
                            <input type="text" class="form-control" name="producerId" id="producerId">
                        </div>
                        <div class="col-4">
                            <label for="ourId">Our ID</label>
                            <input type="text" class="form-control" name="ourId" id="ourId">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Parts Fields -->

            @include('secured.nodes.blocks._seo')
        </div>

        @include('includes.secured.elements._save_or_back_btns', [
            'href' => route('admin.products.index', ['product_type' => 1])
        ])
    </form>
@endsection
