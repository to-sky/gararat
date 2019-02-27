@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 30px; min-height: 400px;">
        <h1 class="page-title">Order #{{ $oid }} created successfully!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, deleniti eius libero porro quidem repellendus tempora velit. Ad adipisci aut, consequatur consequuntur distinctio expedita maxime, obcaecati perferendis quia quo reiciendis!</p>
        <p class="text-center"><a href="{{ route('homePage') }}">Return to home page</a></p>
    </div>
@endsection
