@component('mail::message')
# Your order №{{ $order->displayId() }} is successfully created!

<p>{{ $order->fullName() }}</p>
<p>Email: {{ $order->email }} | Phone: {{ $order->phone }}</p>
<p>Address: {{ $order->fullAddress() }}</p>
<p>Comment: {{ $order->comment }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
