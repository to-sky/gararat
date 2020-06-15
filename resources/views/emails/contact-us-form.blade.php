@component('mail::message')
# {{ __('Message from') }} {{ $name }}

<p>{{ __('Email') }}: <a href="mailto:{{ $email }}" class="inline-ltr">{{ $email }}</a></p>
<p>{{ __('Phone') }}: <a href="tel:{{ $phone }}" class="inline-ltr">{{ $phone }}</a></p>

<p>{{ $message }}</p>
@endcomponent
