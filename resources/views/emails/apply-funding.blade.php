@component('mail::message')
# {{ __('Message from') }} {{ $name }}

<p>{{ __('Phone') }}: <a href="tel:{{ $phone }}" class="inline-ltr">{{ $phone }}</a></p>
@endcomponent