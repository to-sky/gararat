@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 30px; min-height: 400px;">
        <h1 class="page-title">Order #{{ $oid }} created successfully!</h1>
        <p> Thank you for your order our specialists will reply you shortly! Please feel free to contact us for any enquiry.</p>
        <p class="text-center"><a href="{{ route('homePage') }}">Return to home page</a></p>
    </div>
@endsection
