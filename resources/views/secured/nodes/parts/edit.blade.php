@extends('layouts.secured')

@section('title') Edit part: {{ $node->n_name_en }} @endsection

@section('content')
    <form action="{{ route('updatePartsAPI') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $node->id }}">
        <div class="row">
            @include('secured.nodes.blocks._basic')

            <!-- Parts Fields -->
            <div class="col-12" style="margin-bottom: 20px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Parts</h6>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="figNameEn">Fig. Name En</label>
                            <input type="text" class="form-control" name="figNameEn" id="figNameEn" value="{{ $node->part->fig_name_en }}">
                        </div>
                        <div class="col-6">
                            <label for="figNameAr">Fig. Name Ar</label>
                            <input type="text" class="form-control" name="figNameAr" id="figNameAr" value="{{ $node->part->fig_name_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="partGroup">Group</label>
                            <input type="text" class="form-control" name="partGroup" id="partGroup" value="{{ $node->part->group }}">
                        </div>
                        <div class="col-4">
                            <label for="figNumber">Fig. Number</label>
                            <input type="text" class="form-control" name="figNumber" id="figNumber" value="{{ $node->part->fig_no }}">
                        </div>
                        <div class="col-4">
                            <label for="posNumber">Pos. Number</label>
                            <input type="text" class="form-control" name="posNumber" id="posNumber" value="{{ $node->part->pos_no }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="qty">QTY</label>
                            <input type="text" class="form-control" name="qty" id="qty" value="{{ $node->part->qty }}">
                        </div>
                        <div class="col-4">
                            <label for="producerId">Producer ID</label>
                            <input type="text" class="form-control" name="producerId" id="producerId" value="{{ $node->part->producer_id }}">
                        </div>
                        <div class="col-4">
                            <label for="ourId">Our ID</label>
                            <input type="text" class="form-control" name="ourId" id="ourId" value="{{ $node->part->our_id }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Parts Fields -->

            @include('secured.nodes.blocks._seo')
        </div>

        @include('includes.secured.elements._save_or_back_btns', [
            'href' => route('admin.products.index', ['product_type' => 0])
        ])
    </form>
@endsection
