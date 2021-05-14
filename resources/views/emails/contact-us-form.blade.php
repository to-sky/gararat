@component('mail::message')
# {{ __('Message from') }} {{ $name }}

@if($email)
<p>{{ __('Email') }}: <a href="mailto:{{ $email }}" class="inline-ltr">{{ $email }}</a></p>
@endif
<p>{{ __('Phone') }}: <a href="tel:{{ $phone }}" class="inline-ltr">{{ $phone }}</a></p>

<p>{{ $message }}</p>
@endcomponent
