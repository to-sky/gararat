@component('mail::message')
# {{ __('Order №:id created successfully!', ['id' => $order->id]) }}

<p>{{ $order->full_name }}</p>

<p>
    {{ __('Email') }}: <a href="mailto:{{ $order->email }}" class="inline-ltr">{{ $order->email }}</a>
</p>

<p>
    {{ __('Phone') }}: <a href="tel:{{ $order->phone }}" class="inline-ltr">{{ $order->phone }}</a>
</p>

<p>{{ __('Address') }}: {{ $order->full_address }}</p>

@if($order->comment)
<p>{{ __('Comment') }}: {{ $order->comment }}</p>
@endif

{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
