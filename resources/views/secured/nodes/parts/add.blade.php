@extends('layouts.secured')

@section('content')
    <form action="{{ route('saveNewPartsAPI') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Basic Fields -->
            <div class="col-12" style="margin-bottom: 20px;">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-6">
                        <div class="bgc-white p-20 bd">
                            <h6 class="c-grey-900">Common English</h6>
                            <div class="form-group">
                                <label for="nameEn">Product Name*</label>
                                <input type="text" class="form-control" name="nameEn" id="nameEn" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bgc-white p-20 bd">
                            <h6 class="c-grey-900">Common Arabic</h6>
                            <div class="form-group">
                                <label for="nameAr">Product Name*</label>
                                <input type="text" class="form-control" name="nameAr" id="nameAr" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="bgc-white p-20 bd">
                            <h6 class="c-grey-900">Common</h6>
                            <div class="form-group">
                                <label for="catalog">Catalog</label>
                                <select name="catalog[]" id="catalog" class="form-control select2-element" multiple autocomplete="off" data-placeholder="Select a Catalog">
                                    {!! $catalog !!}
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="hasPhoto">Has photo</label>
                                    <select name="hasPhoto" id="hasPhoto" class="form-control" autocomplete="off">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="inStock">In stock</label>
                                    <select name="inStock" id="inStock" class="form-control" autocomplete="off">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="isSpecial">Is Special</label>
                                    <select name="isSpecial" id="isSpecial" class="form-control" autocomplete="off">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="nodePrice">Price*</label>
                                    <input type="text" class="form-control" name="nodePrice" id="nodePrice" required>
                                </div>
                                <div class="col-6">
                                    <label for="nodeSpecialPrice">Special Price</label>
                                    <input type="text" class="form-control" name="nodeSpecialPrice" id="nodeSpecialPrice" value="0.00">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="mainImage">Main Image</label>
                                    <input type="file" class="form-control" name="mainImage" id="mainImage">
                                </div>
                                <div class="col-6">
                                    <label for="additionalImages">Additional Images</label>
                                    <input type="file" class="form-control" multiple name="additionalImages[]" id="additionalImages">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Basic Fields -->
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
            <!-- SEO Fields -->
            <div class="col-12" style="margin-bottom: 20px;">
                <div class="row">
                    <div class="col-6">
                        <div class="bgc-white p-20 bd">
                            <h6 class="c-grey-900">SEO English</h6>
                            <div class="form-group">
                                <label for="seoTitleEn">SEO Title</label>
                                <input type="text" class="form-control" id="seoTitleEn" name="seoTitleEn" placeholder="Input catalog SEO title" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="seoDescriptionEn">SEO Description</label>
                                <textarea class="form-control" id="seoDescriptionEn" name="seoDescriptionEn"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bgc-white p-20 bd">
                            <h6 class="c-grey-900">SEO Arabic</h6>
                            <div class="form-group">
                                <label for="seoTitleAr">SEO Title</label>
                                <input type="text" class="form-control" id="seoTitleAr" name="seoTitleAr" placeholder="Input catalog SEO title" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="seoDescriptionAr">SEO Description</label>
                                <textarea class="form-control" id="seoDescriptionAr" name="seoDescriptionAr"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End SEO Fields -->
            <div class="col-12">
                <div class="bgc-white p-20 bd" style="display: inline-block; width: 100%;">
                    <button class="float-right btn btn-primary" type="submit">Save</button>
                    <a href="#" class="float-left btn cur-p btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection
