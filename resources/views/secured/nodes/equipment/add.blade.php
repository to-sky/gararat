@extends('layouts.secured')

@section('content')
    <form action="{{ route('saveNewCatalogItemAPI') }}" method="post" autocomplete="off">
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
                                <select name="catalog" id="catalog" class="form-control" multiple style="min-height: 150px;">
                                    {!! $catalog !!}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Basic Fields -->
            <!-- Equipments Fields -->
            <div class="col-12" style="margin-bottom: 20px;">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Equipment</h6>

                </div>
            </div>
            <!-- End Equipments Fields -->
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
