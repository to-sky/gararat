@component('mail::message')
# Message from {{ $name }}

<p>Email: {{ $email }}</p>
<p>Phone: {{ $phone }}</p>

<p>{{ $message }}</p>
@endcomponent
