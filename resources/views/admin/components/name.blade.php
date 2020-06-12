<div class="card mb-3 rounded-0 border">
    <div class="card-body">
        @if(! isset($hidden) || $hidden == false)
            <div class="form-group">
                <label for="name">Name*</label>
                <div class="input-group">
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="English" value="{{ isset($item) ? $item->name : old('name') }}" required>

                    <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                           placeholder="Arabic" value="{{ isset($item) ? $item->name_ar : old('name_ar') }}" required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @error('name_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endif

        {{ $slot }}
    </div>
</div>