@php $number = $number ?? 0; @endphp

<div class="row form-group" data-repeater-item>
    <div class="col-md-5">
        <select name="units[{{ $number }}][equipment_id]" class="form-control select2-element">
            <option value="">Select equipment</option>
            @foreach($equipment as $equipmentItem)
                <option value="{{ $equipmentItem->id }}"
                    @if (in_array($equipmentItem->id, $unit->map->equipment_id->toArray())) selected @endif>
                    {{ $equipmentItem->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <select name="units[{{ $number }}][catalog_id][]"
                class="form-control select2-element" multiple>
            @foreach($catalogs as $catalog)
                <option value="{{ $catalog->id }}"
                    @if (in_array($catalog->id, $unit->map->catalog_id->toArray())) selected @endif>
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
