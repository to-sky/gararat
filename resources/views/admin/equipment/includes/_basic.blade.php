<!-- Basic Fields -->
<div class="form-group">
    <label for="description">Description</label>
    <div class="input-group">
        <textarea rows="5" name="description" id="description" class="form-control" placeholder="English">{{ isset($item) ? $item->description : old('description') }}</textarea>
        <textarea rows="5" name="description_ar" class="form-control" placeholder="Arabic">{{ isset($item) ? $item->description_ar : old('description_ar') }}</textarea>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label for="manufacturer">Manufacturer*</label>
        <select name="manufacturer_id" id="manufacturer"
                class="form-control select2-element @error('manufacturer_id') is-invalid @enderror"
                autocomplete="off" data-placeholder="Select manufacturer" required>
            @foreach ($manufacturers as $manufacturer)
                {{ $manufacturer }}
                <option value="{{ $manufacturer->id }}"
                        @if (isset($item) && $item->manufacturer_id == $manufacturer->id
                            || old('manufacturer_id') == $manufacturer->id
                        ) selected @endif>
                    {{ $manufacturer->name }}
                </option>
            @endforeach
        </select>

        @error('manufacturer_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-8">
        <label for="equipmentGroup">Equipment group*</label>
        <select name="equipment_group_id" id="equipmentGroup"
                class="form-control select2-element @error('equipment_group_id') is-invalid @enderror"
                autocomplete="off" data-placeholder="Select equipment group" required>
            @foreach ($equipmentGroups as $equipmentGroup)
                {{ $equipmentGroup }}
                <option value="{{ $equipmentGroup->id }}"
                        @if (isset($item) && $item->equipment_group_id == $equipmentGroup->id
                            || old('equipment_group_id') == $equipmentGroup->id
                        ) selected @endif>
                    {{ $equipmentGroup->name }}
                </option>
            @endforeach
        </select>

        @error('equipment_group_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

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
                   value="{{ isset($item) ? $item->price : old('price') }}" required>

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-5">
        <label for="specialPrice">Special Price</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">EGP</div>
            </div>
            <input type="number" min="0" step="any"
                   class="form-control @error('special_price') is-invalid @enderror"
                   name="special_price" id="specialPrice" placeholder="0.00"
                   value="{{ isset($item) ? $item->special_price : old('special_price') }}">

            @error('special_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col pt-4 mt-2">
        <div class="custom-control custom-switch mt-1">
            <input type="hidden" name="in_stock" value="0">
            <input type="checkbox" name="in_stock" class="custom-control-input" id="inStock" value="1"
                {{ isset($item) && $item->in_stock || old('in_stock') ? 'checked' : '' }}>
            <label class="custom-control-label" for="inStock">In stock</label>
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
</div>

<div class="form-group row">
    <div class="col">
        <p class="mb-1">Main image</p>
        @include('admin.includes._input-file', [
            'name' => 'main_image',
            'placeholder' => 'Select image'
        ])
        <small class="text-muted">
            The following file formats are supported:
            <span class="badge border p-3">jpg</span>
            <span class="badge border p-3">png</span>
            <span class="badge border p-3">tiff</span>
        </small>

        @if (isset($item) && $mainImage = $item->getFirstMedia('main_image'))
            @include('admin.includes._form-image', [
                'mediaItem' => $mainImage
            ])
        @endif

    </div>
    <div class="col-md-8">
        <p class="mb-1">Additional images</p>
        @include('admin.includes._input-file', [
            'name' => 'additional_images[]',
            'multiple' => true,
            'placeholder' => 'Select images',
            'formats' => '.jpg,.png,.tiff'
        ])
        <small class="text-muted">
            The following file formats are supported:
            <span class="badge border p-3">jpg</span>
            <span class="badge border p-3">png</span>
            <span class="badge border p-3">tiff</span>
        </small>

        @error('additional_images')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="no-gutters row">
            @if(isset($item) && $images = $item->getMedia('additional_images'))
                @foreach($images as $image)
                    @include('admin.includes._form-image', ['mediaItem' => $image])
                @endforeach
            @endif
        </div>

    </div>
</div>
<!-- End Basic Fields -->