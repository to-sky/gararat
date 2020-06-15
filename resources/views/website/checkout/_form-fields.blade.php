{{-- Username --}}
<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="firstName">{{ __('First name') }}*</label>
        <input type="text" name="first_name" id="firstName"
               class="form-control @error('first_name') is-invalid @enderror"
               value="{{ old('first_name') }}"
               required>

        @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="lastName">{{ __('Last name') }}*</label>
        <input type="text" name="last_name" id="lastName"
               class="form-control @error('last_name') is-invalid @enderror"
               value="{{ old('last_name') }}"
               required>

        @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Email|Phone --}}
<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="email">{{ __('Email') }}*</label>
        <input type="email" name="email" id="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}"
               required>

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="phone">{{ __('Phone') }}*</label>
        <input type="text" name="phone" id="phone"
               class="form-control @error('phone') is-invalid @enderror"
               value="{{ old('phone') }}"
               required>

        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Country --}}
<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="country">{{ __('Country') }}*</label>
        <select name="country_id" id="country"
                class="form-control @error('country_id') is-invalid @enderror"
                required>
            @foreach($countries as $country)
                <option @if(old('country_id') == $country->id || $country->name == 'Egypt') selected @endif
                value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>

        @error('country_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="city">{{ __('City') }}</label>
        <input type="text" name="city" class="form-control" id="city">
    </div>
</div>

{{-- Address --}}
<div class="form-row">
    <div class="col-md-8 form-group">
        <label for="address">{{ __('Address') }}</label>
        <input type="text" name="address"  class="form-control" id="address">
    </div>

    <div class="col-md-4 form-group">
        <label for="post">{{ __('Post code') }}</label>
        <input type="text" name="post" class="form-control" id="post">
    </div>
</div>

{{-- Comment --}}
<div class="form-row form-group">
    <div class="col-12">
        <label for="comment">{{ __('Comment') }}</label>
        <textarea rows="8" name="comment" class="form-control" id="comment"></textarea>
    </div>
</div>

<div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" name="subscribe" id="subscribeNews" checked>

    <label class="custom-control-label" for="subscribeNews">
        {{ __('Subscribe to our news') }}
    </label>
</div>