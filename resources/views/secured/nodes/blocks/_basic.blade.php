<!-- Basic Fields -->
<div class="col-12" style="margin-bottom: 20px;">
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Common English</h6>
                <div class="form-group">
                    <label for="nameEn">Product Name*</label>
                    <input type="text" class="form-control" name="nameEn" id="nameEn" required value="{{ isset($node) ? $node->n_name_en : '' }}">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Common Arabic</h6>
                <div class="form-group">
                    <label for="nameAr">Product Name*</label>
                    <input type="text" class="form-control" name="nameAr" id="nameAr" required value="{{ isset($node) ? $node->n_name_ar : '' }}">
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
                    <select name="catalog[]" id="catalog" class="form-control select2-element" multiple autocomplete="off">
                        {!! $catalogRender !!}
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label for="hasPhoto">Has photo</label>
                        <select name="hasPhoto" id="hasPhoto" class="form-control" autocomplete="off">
                            <option @if(isset($node) && $node->has_photo == 1) selected @endif value="1">Yes</option>
                            <option @if(isset($node) && $node->has_photo == 0) selected @endif value="0">No</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="inStock">In stock</label>
                        <select name="inStock" id="inStock" class="form-control" autocomplete="off">
                            <option @if(isset($node) && $node->in_stock == 1) selected @endif value="1">Yes</option>
                            <option @if(isset($node) && $node->in_stock == 0) selected @endif value="0">No</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="isSpecial">Is Special</label>
                        <select name="isSpecial" id="isSpecial" class="form-control" autocomplete="off">
                            <option @if(isset($node) && $node->is_special == 1) selected @endif value="1">Yes</option>
                            <option @if(isset($node) && $node->is_special == 0) selected @endif value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="nodePrice">Price*</label>
                        <input type="text" class="form-control" name="nodePrice" id="nodePrice" required
                               value="{{ isset($node) ? $node->price : '' }}">
                    </div>
                    <div class="col-6">
                        <label for="nodeSpecialPrice">Special Price</label>
                        <input type="text" class="form-control" name="nodeSpecialPrice" id="nodeSpecialPrice"
                               value="{{ isset($node) ? $node->special_price : '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="mainImage">Main Image</label>
                        <input type="file" class="form-control-file" name="mainImage" id="mainImage">
                        <br>
                        @isset($node)
                        <p>Upload new image to replace current.</p>
                            @foreach($node->images as $image)
                                @if($image->is_featured == 1)
                                    <img src="{{ asset($image->thumb_path) }}" height="64">
                                @endif
                            @endforeach
                        @endisset
                    </div>
                    <div class="col-6">
                        <label for="additionalImages">Additional Images</label>
                        <input type="file" class="form-control-file" multiple name="additionalImages[]" id="additionalImages">
                        <br>
                        @isset($node)
                        <p>Additional images</p>
                        <div class="row">
                            @foreach($node->images as $image)
                                @if($image->is_featured != 1)
                                    <div class="col-3">
                                        <img src="{{ asset($image->thumb_path) }}" height="64">
                                        <a href="{{ route('removeProductImage', $image->ni_id) }}">Delete</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Basic Fields -->