@extends('layouts.secured')

@section('content')
    <form action="{{ route('saveNewCatalogItemAPI') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12" style="margin-bottom: 30px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Common</h6>
                    <div class="form-group">
                        <label for="catalogNumber">Catalog Number</label>
                        <input type="text" class="form-control" id="catalogNumber" name="catalogNumber" placeholder="Input catalog number" required autocomplete="off">
                        @if($errors->any())
                            <small id="emailHelp" class="form-text text-danger">{{$errors->first()}}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="catalogParent">Catalog Parent</label>
                        <select name="catalogParent" id="catalogParent" class="form-control select2-element" autocomplete="off">
                            <option value="0">Root Element</option>
                            {!! $catalogs !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12" style="margin-bottom: 30px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Catalog View</h6>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="catalogImage">Catalog Image</label>
                            <input type="file" class="form-control-file" name="catalogImage" id="catalogImage">
                        </div>
                        <div class="col-6">
                            <label for="catalogViewType">View Type</label>
                            <select name="catalogViewType" id="catalogViewType" class="form-control" autocomplete="off">
                                <option value="0">Nodes</option>
                                <option value="1">Childs</option>
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
                        <input type="text" class="form-control" id="catalogNameEn" name="catalogNameEn" placeholder="Input catalog name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoTitleEn">Catalog SEO Title</label>
                        <input type="text" class="form-control" id="catalogSeoTitleEn" name="catalogSeoTitleEn" placeholder="Input catalog SEO title" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoDescriptionEn">Catalog SEO Description</label>
                        <textarea class="form-control" id="catalogSeoDescriptionEn" name="catalogSeoDescriptionEn"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Arabic</h6>
                    <div class="form-group">
                        <label for="catalogNameAr">Catalog Name</label>
                        <input type="text" class="form-control" id="catalogNameAr" name="catalogNameAr" placeholder="Input catalog name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoTitleAr">Catalog SEO Title</label>
                        <input type="text" class="form-control" id="catalogSeoTitleAr" name="catalogSeoTitleAr" placeholder="Input catalog SEO title" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="catalogSeoDescriptionAr">Catalog Catalog SEO Description</label>
                        <textarea class="form-control" id="catalogSeoDescriptionAr" name="catalogSeoDescriptionAr"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-12" style="margin-top: 30px;">
                <div class="bgc-white p-20 bd" style="display: inline-block; width: 100%;">
                    <button class="float-right btn btn-primary" type="submit">Save</button>
                    <a href="{{ route('securedCatalogListPage') }}" class="float-left btn cur-p btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection
