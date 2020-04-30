{{-- Username --}}
<div class="form-row form-group mb-4">
    <div class="col-md-6">
        <label for="firstName">{{ __('First name') }}*</label>
        <input type="text" name="first_name" id="firstName" class="form-control" required>

        <span class="invalid-feedback">
            {{ __('This field is required.') }}
        </span>
    </div>

    <div class="col-md-6">
        <label for="lastName">{{ __('Last name') }}*</label>
        <input type="text" name="last_name" id="lastName" class="form-control" required>

        <div class="invalid-feedback">
            {{ __('This field is required.') }}
        </div>
    </div>
</div>

{{-- Email|Phone --}}
<div class="form-row form-group mb-4">
    <div class="col-md-6">
        <label for="email">{{ __('Email') }}*</label>
        <input type="email" name="email" id="email" class="form-control" required>

        <div class="invalid-feedback">
            {{ __('This field is required.') }}
        </div>
    </div>

    <div class="col-md-6">
        <label for="phone">{{ __('Phone') }}*</label>
        <input type="text" name="phone" id="phone" class="form-control" required>

        <div class="invalid-feedback">
            {{ __('This field is required.') }}
        </div>
    </div>
</div>

{{-- Country --}}
<div class="form-row form-group mb-4">
    <div class="col-md-6">
        <label for="country">{{ __('Country') }}*</label>
        <select name="country_id" class="form-control" id="country" required>
            @foreach($countries as $country)
                <option @if($country->name == 'Egypt') selected @endif
                value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>

        <div class="invalid-feedback">
            {{ __('This field is required.') }}
        </div>
    </div>

    <div class="col-md-6">
        <label for="city">{{ __('City') }}</label>
        <input type="text" name="city" class="form-control" id="city">
    </div>
</div>

{{-- Address --}}
<div class="form-row form-group mb-4">
    <div class="col-md-8">
        <label for="address">{{ __('Address') }}</label>
        <input type="text" name="address"  class="form-control" id="address">
    </div>

    <div class="col-md-4">
        <label for="post">{{ __('Post code') }}</label>
        <input type="text" name="post" class="form-control" id="post">
    </div>
</div>

{{-- Comment --}}
<div class="form-row form-group">
    <div class="col-9">
        <label for="comment">{{ __('Comment') }}</label>
        <textarea rows="2" name="comment" class="form-control" id="comment"></textarea>
    </div>

    <div class="col-3">
        @if(env('GOOGLE_RECAPTCHA_KEY'))
            <div class="g-recaptcha float-right pt-4"
                 data-size="compact"
                 data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
            </div>

            @error('g-recaptcha-response')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($errors->has('g-recaptcha-response'))
                <span class="float-right pt-3 text-danger">
                    <strong>{{ __('Are you a robot?') }}</strong>
                </span>
            @endif
        @endif
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif