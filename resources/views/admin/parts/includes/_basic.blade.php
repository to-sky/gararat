@php($item = $item ?? null)

<div class="form-group row">
    <div class="col-md-4">
        <label for="price">Price*</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">EGP</div>
            </div>
            <input type="number" min="0" step="any"
                   class="form-control @error('price') is-invalid @enderror"
                   name="price" id="price" placeholder="0.00"
                   value="{{ old('price', optional($item)->price) }}" required>

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <label for="specialPrice">Special Price</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">EGP</div>
            </div>
            <input type="number" min="0" step="any"
                   class="form-control @error('special_price') is-invalid @enderror"
                   name="special_price" id="specialPrice" placeholder="0.00"
                   value="{{ old('special_price', optional($item)->special_price) }}">

            @error('special_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <label for="producerId">Producer ID*</label>
        <input type="text"
               class="form-control @error('producer_id') is-invalid @enderror"
               name="producer_id" id="producerId"
               value="{{ old('producer_id', optional($item)->producer_id) }}" required>

        @error('producer_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col">
        <label for="qty">Qty</label>
        <div class="input-group mb-2">
            <input type="number" min="0" step="1"
                   class="form-control @error('qty') is-invalid @enderror"
                   name="qty" id="qty" placeholder="0"
                   value="{{ old('qty', optional($item)->qty) ?? 0 }}">

            @error('qty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col pt-4 mt-2">
        <div class="custom-control custom-switch mt-1">
            <input type="hidden" name="is_special" value="0">
            <input type="checkbox" name="is_special" class="custom-control-input" id="isSpecial" value="1"
                {{ isset($item) && $item->is_special || old('is_special') ? 'checked' : '' }}>
            <label class="custom-control-label" for="isSpecial">Is special</label>
        </div>
    </div>

    <div class="col pt-4 mt-2">
        <div class="custom-control custom-switch mt-1">
            <input type="hidden" name="is_best_selling" value="0">
            <input type="checkbox" name="is_best_selling" class="custom-control-input" id="isBestSelling" value="1"
                {{ isset($item) && $item->is_best_selling || old('is_best_selling') ? 'checked' : '' }}>
            <label class="custom-control-label" for="isBestSelling">Best selling</label>
        </div>
    </div>

</div>

@include('admin.includes._product_images', ['item' => $item ?? null])
