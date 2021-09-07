@php $number = $number ?? 0; @endphp

<div class="row form-group" data-repeater-item>
    <div class="col-md-5">
        <select name="units[{{ $number }}][equipment_id]"
                class="form-control select2-element" data-placeholder="Select equipment" multiple="multiple">
            <option></option>
            @foreach($equipment as $equipmentItem)
                <option value="{{ $equipmentItem->id }}">
                    {{ $equipmentItem->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <select name="units[{{ $number }}][catalog_id][]"
                class="form-control select2-element">
            @foreach($catalogs as $catalog)
                <option value="{{ $catalog->id }}">
                    {{ $catalog->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-1 float-right">
        <div class="btn-group">
            <button data-repeater-delete type="button" data-number="{{ $number }}"
                    class="btn btn-outline-light bg-white text-danger border">
                <i class="ti-trash"></i>
            </button>
        </div>
    </div>
</div>
