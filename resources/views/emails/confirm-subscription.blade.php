@component('mail::message')
<p>{{ __('Thanks for subscribing to the Gararat news email list.') }}</p>
<p>{{ __('To complete your subscription, you need to confirm you got this email. To do so, please click the button below:') }}</p>

@component('mail::button', ['url' => route('subscribe.confirm-success', $subscriber), 'color' => 'success'])
{{ __('Confirm subscription') }}
@endcomponent

{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
