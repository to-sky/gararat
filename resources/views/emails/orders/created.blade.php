@component('mail::message')
# {{ __('Order №:id created successfully!', ['id' => $order->id]) }}

<p>{{ $order->full_name }}</p>
<p>{{ __('Email') }}: {{ $order->email }} | {{ __('Phone') }}: {{ $order->phone }}</p>
<p>{{ __('Address') }}: {{ $order->full_address }}</p>
<p>{{ __('Comment') }}: {{ $order->comment }}</p>

{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
