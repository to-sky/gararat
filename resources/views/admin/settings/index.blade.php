@extends('admin.layouts.master')

@section('title', 'Settings')

@section('content')
    <form action="{{ route('admin.settings') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <div class="card mb-3 rounded-0 border">
            <div class="card-body">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control"
                           name="facebook" id="facebook"
                           placeholder="https://www.facebook.com/your-page" value="{{ setting('facebook', old('facebook')) }}">
                </div>

                <div class="form-group">
                    <label for="youTube">Youtube</label>
                    <input type="text" class="form-control"
                           name="youtube" id="youTube"
                           placeholder="https://www.youtube.com/channel/your-channel" value="{{ setting('youtube', old('youtube')) }}">
                </div>

                <div class="form-group">
                    <label for="whatsApp">WhatsApp</label>
                    <input type="text" class="form-control"
                           name="whatsapp" id="whatsApp"
                           placeholder="123456789" value="{{ setting('whatsapp', old('whatsapp')) }}">
                </div>
            </div>
        </div>

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => url()->previous()
        ])
    </form>
@endsection