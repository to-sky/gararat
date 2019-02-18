@extends('layouts.secured')

@section('content')
    <form action="{{ route('saveNewCatalogItemAPI') }}" method="post" autocomplete="off">
        @csrf
        <div class="row">

        </div>
    </form>
@endsection
