@extends('layouts.secured')

@section('title') Edit equipment: {{ $node->n_name_en }} @endsection

@section('content')
    <form action="{{ route('updateEquipmentAPI') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $node->id }}">
        <div class="row">
            @include('secured.nodes.blocks._basic')

            <!-- Equipments Fields -->
            <div class="col-12" style="margin-bottom: 20px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Equipment English</h6>
                    <div class="form-group">
                        <label for="nodeShortBody">Short Body</label>
                        <textarea name="nodeShortBody" id="nodeShortBody" class="summernote">{{ $node->machinery->nmf_short_en }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="nodeBody">Body</label>
                        <textarea name="nodeBody" id="nodeBody" class="summernote">{{ $node->machinery->nmf_body_en }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12" style="margin-bottom: 20px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Equipment Arabic</h6>
                    <div class="form-group">
                        <label for="nodeShortBodyAr">Short Body</label>
                        <textarea name="nodeShortBodyAr" id="nodeShortBodyAr" class="summernote">{{ $node->machinery->nmf_short_ar }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="nodeBodyAr">Body</label>
                        <textarea name="nodeBodyAr" id="nodeBodyAr" class="summernote">{{ $node->machinery->nmf_body_ar }}</textarea>
                    </div>
                </div>
            </div>
            <!-- End Equipments Fields -->

            @include('secured.nodes.blocks._seo')
        </div>

        @include('includes.secured.elements._save_or_back_btns', [
            'href' => route('admin.products.index', ['product_type' => 0])
        ])
    </form>
@endsection
