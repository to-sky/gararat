@component('mail::message')
# Your order №{{ $order->displayId() }} is successfully created!

<p>{{ $order->full_name }}</p>
<p>Email: {{ $order->email }} | Phone: {{ $order->phone }}</p>
<p>Address: {{ $order->full_address }}</p>
<p>Comment: {{ $order->comment }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
