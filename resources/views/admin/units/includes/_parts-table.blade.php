<table id="partsDataTable" class="w-100 table-sm table-hover table-bordered">
    <thead class="border">
        <tr>
            <th class="pl-4">#</th>
            <th>Name</th>
            <th>Producer ID</th>
            <th width="10%">Qty</th>
            <th class="d-n">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($parts as $key => $part)
            <tr>
                <td class="pl-4">{{ $part['id'] }}</td>
                <td>{{ $part['name'] }}</td>
                <td>{{ $part['producer_id'] }}</td>
                <td>
                    <input type="number" name="parts[{{ $key }}][qty]" min="0" step="1" value="0"
                           class="form-control form-control-sm @error('qty') is-invalid @enderror" />
                    <input type="hidden" name="parts[{{ $key }}][part_id]" value="{{ $part['id'] }}" />
                </td>
                <td class="d-n text-center" data-row="actions">
                    <button type="button" class="btn ml-1 px-1 py-0 py-1 text-danger delete-part" title="Delete part">
                        <i class="ti-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>