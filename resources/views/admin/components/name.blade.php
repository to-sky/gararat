<div class="card mb-3 rounded-0 border">
    <div class="card-body">
        <div class="form-group">
            <label for="">Name*</label>
            <div class="input-group">
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="English" value="{{ isset($item) ? $item->name : old('name') }}" required>

                <input type="text" name="name_ar" class="form-control"
                       placeholder="Arabic" value="{{ isset($item) ? $item->name_ar : old('name_ar') }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{ $slot }}
    </div>
</div>