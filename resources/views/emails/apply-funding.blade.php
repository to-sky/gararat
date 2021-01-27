@component('mail::message')
# {{ __('Message from') }} {{ $name }}

<p>{{ __('Phone') }}: <a href="tel:{{ $phone }}" class="inline-ltr">{{ $phone }}</a></p>
@if($governorate)
<p>{{ __('Governorate') }}: {{ $governorate->trans('name') }}</p>
@endif
@endcomponent
