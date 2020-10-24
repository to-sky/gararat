<div class="row">
    <div class="container">
        <h3 class="mt-4 mb-card text-center text-muted font-weight-light">{{ __('Apply for funding') }}</h3>

        <div class="bg-white p-4 mb-4 shadow-sm">
            <form action="{{ route('apply-funding') }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="col-md-5 form-group">
                        <label for="name">{{ __('Name') }}*</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>

                        @error('name')
                        <p class="d-block invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="phone">{{ __('Phone') }}*</label>
                        <input type="tel" name="phone" id="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" required>

                        @error('phone')
                        <p class="d-block invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-2 form-group">
                        <button class="btn btn-danger btn-block label-top-offset" type="submit">{{ __('Send') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>