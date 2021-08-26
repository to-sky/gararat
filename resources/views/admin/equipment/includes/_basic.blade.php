<!-- Basic Fields -->
<div class="form-group form-row">
    <div class="col-md-6">
        <label for="description">Description</label>
        <div class="input-group">
            <textarea rows="5" name="description" id="description" class="form-control" placeholder="English">{{ isset($item) ? $item->description : old('description') }}</textarea>
            <textarea rows="5" name="description_ar" class="form-control" placeholder="Arabic">{{ isset($item) ? $item->description_ar : old('description_ar') }}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        @include('admin.equipment.includes._main_specifications', ['item' => $item ?? ''])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="catalog">Equipment category</label>
            <select name="equipment_category_id" id="equipment_category"
                    class="form-control select2-element"
                    data-placeholder="Select category">
                <option></option>

                @foreach($parentEquipmentCategories as $parentEquipmentCategory)
                    <optgroup label="{{ $parentEquipmentCategory->name }}">
                        @foreach($parentEquipmentCategory->childs as $child)
                            <option value="{{ $child->id }}"
                                    @if (isset($item) && $item->equipment_category_id == $child->id
                                        || old('equipment_category_id') == $child->id
                                    ) selected @endif>
                                {{ $child->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
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

    <div class="col">
        <label for="qty">Qty</label>
        <div class="input-group mb-2">
            <input type="number" min="0" step="1"
                   class="form-control @error('qty') is-invalid @enderror"
                   name="qty" id="qty" placeholder="0"
                   value="{{ isset($item) ? $item->qty : old('qty') ?? 0 }}">

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
</div>

@include('admin.includes._product_images', ['item' => $item ?? null])
<!-- End Basic Fields -->
