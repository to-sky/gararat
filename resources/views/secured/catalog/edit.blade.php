@extends('layouts.secured')

@section('title') Edit catalog: {{ $catalog->cat_name_en }} @endsection

@section('content')
    <form action="{{ route('updateCatalogItemAPI') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cid" value="{{ $catalog->cid }}">
        <div class="row">
            <div class="col-12" style="margin-bottom: 30px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Common</h6>
                    <div class="form-group">
                        <label for="catalogNumber">Catalog Number</label>
                        <input type="text" class="form-control" id="catalogNumber" name="catalogNumber" placeholder="Input catalog number" required autocomplete="off" value="{{ $catalog->cat_number }}">
                        @if($errors->any())
                            <small id="emailHelp" class="form-text text-danger">{{$errors->first()}}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="catalogParent">Catalog Parent</label>
                        <select name="catalogParent" id="catalogParent" class="form-control select2-element" autocomplete="off">
                            <option @if($catalog->cat_number == 0) selected @endif value="0">Root Element</option>
                            {!! $catalogRender !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12" style="margin-bottom: 30px;">
                <div class="bgc-white p-20 bd">


                    <h6 class="c-grey-900">Catalog View</h6>
                    <div class="form-group row">
                        <div class="col-6 mt-1">
                            @include('includes.secured.elements._input-file', [
                                'name' => 'catalogImage',
                                'label' => 'Catalog image',
                                'placeholder' => $catalog->cat_image
                            ])

                            @if($catalog->cat_image !== null)
                                <p class="mt-2 mb-0">
                                    <img src="{{ asset($catalog->cat_image) }}" height="70">
                                </p>
                            @endif
                        </div>
                        <div class="col-6 mt-n4">
                            <label for="catalogViewType">View Type</label>
                            <select name="catalogViewType" id="catalogViewType" class="form-control" autocomplete="off">
                                <option @if($catalog->cat_view == 0) selected @endif value="0">Nodes</option>
                                <option @if($catalog->cat_view == 1) selected @endif value="1">Childs</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">English</h6>
                    <div class="form-group">
                        <label for="catalogNameEn">Catalog Name</label>
                        <input type="text" class="form-control" id="catalogNameEn" name="catalogNameEn" placeholder="Input catalog name" required autocomplete="off" value="{{ $catalog->cat_name_en }}">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoTitleEn">Catalog SEO Title</label>
                        <input type="text" class="form-control" id="catalogSeoTitleEn" name="catalogSeoTitleEn" placeholder="Input catalog SEO title" autocomplete="off" value="{{ $catalog->cat_title_en }}">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoDescriptionEn">Catalog Number</label>
                        <textarea class="form-control" id="catalogSeoDescriptionEn" name="catalogSeoDescriptionEn">{{ $catalog->cat_description_en }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Arabic</h6>
                    <div class="form-group">
                        <label for="catalogNameAr">Catalog Name</label>
                        <input type="text" class="form-control" id="catalogNameAr" name="catalogNameAr" placeholder="Input catalog name" autocomplete="off" value="{{ $catalog->cat_name_ar }}">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoTitleAr">Catalog SEO Title</label>
                        <input type="text" class="form-control" id="catalogSeoTitleAr" name="catalogSeoTitleAr" placeholder="Input catalog SEO title" autocomplete="off" value="{{ $catalog->cat_title_ar }}">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoDescriptionAr">Catalog Number</label>
                        <textarea class="form-control" id="catalogSeoDescriptionAr" name="catalogSeoDescriptionAr">{{ $catalog->cat_description_ar }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                @include('includes.secured.elements._save_or_back_btns', ['href' => route('admin.catalog.index') ])
            </div>
        </div>
    </form>
@endsection
