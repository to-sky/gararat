<div data-repeater-item data-item-name="{{ isset($item) ? $item->name : '' }}">
    <div class="form-group repeater">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" name="name"
                   class="form-control"
                   value="{{ isset($item) ? $item->name : old('name') }}"
                   placeholder="English">
            <input type="text" name="name_ar"
                   class="form-control"
                   value="{{ isset($item) ? $item->name_ar : old('name_ar') }}"
                   placeholder="Arabic">
            @isset($item)
                <input type="hidden" name="subcategories[{{ $num }}][id]" value="{{ $item->id }}">
            @endisset

            <button data-repeater-delete
                    data-delete-url="{{ isset($item) ? route('admin.equipment-categories.destroy', $item) : '' }}"
                    type="button"
                    class="bg-white text-danger input-group-text rounded-right border-left-0"
                    style="border-radius: 0"
                    title="Delete subcategory">
                <i class="ti-trash"></i>
            </button>
        </div>
    </div>
</div>
