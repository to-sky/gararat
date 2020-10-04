@extends('admin.layouts.master')

@section('title', 'Settings')

@section('content')
    <form action="{{ route('admin.settings') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <div class="body__nav-container">
            <ul class="nav nav-tabs" id="settingTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mainTab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="menuTab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="false">Menu</a>
                </li>
            </ul>
            <div class="tab-content">
                {{-- Main settings --}}
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="mainTab">
                    <div class="card mb-3 rounded-0">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6">
                                    <p>Header logo</p>

                                    <div class="bgc-grey-100 border shadow-sm w-25">
                                        <img src="{{ SettingService::getLogoUrl('header') }}" class="card-img rounded-0" alt="Footer logo">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <p>Footer logo</p>

                                    <div class="bgc-grey-100 border shadow-sm w-25">
                                        <img src="{{ SettingService::getLogoUrl('footer') }}" class="card-img rounded-0" alt="Footer logo">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-6">
                                    @include('admin.includes._input-file', [
                                        'name' => 'header_logo',
                                        'placeholder' => 'Select image',
                                        'formats' => '.jpg,.png,.tiff'
                                    ])
                                    @include('admin.includes._image_following_formats')
                                </div>

                                <div class="col-6">
                                    @include('admin.includes._input-file', [
                                        'name' => 'footer_logo',
                                        'placeholder' => 'Select images',
                                        'formats' => '.jpg,.png,.tiff'
                                    ])
                                    @include('admin.includes._image_following_formats')
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control"
                                       name="email" id="email"
                                       placeholder="example@email.com" value="{{ setting('email', old('email')) }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control"
                                       name="phone" id="phone"
                                       placeholder="+12-345-678-90-12" value="{{ setting('phone', old('phone')) }}">
                            </div>

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

                            <div class="form-group">
                                <label for="instagram">Istagram</label>
                                <input type="text" class="form-control"
                                       name="instagram" id="instagram"
                                       placeholder="https://www.instagram.com/your-page" value="{{ setting('instagram', old('instagram')) }}">
                            </div>

                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control"
                                       name="twitter" id="twitter"
                                       placeholder="https://www.twitter.com/your-page" value="{{ setting('twitter', old('twitter')) }}">
                            </div>

                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="text" class="form-control"
                                       name="linkedin" id="linkedin"
                                       placeholder="https://www.linkedin.com/your-page" value="{{ setting('linkedin', old('linkedin')) }}">
                            </div>



                            <div class="form-group">
                                <label for="footerSlogan">Footer slogan</label>
                                <div class="input-group">
                                    <input type="text" name="footer_slogan"
                                           id="footerSlogan"
                                           class="form-control"
                                           placeholder="English" value="{{ setting('footer_slogan', old('footer_slogan')) }}">

                                    <input type="text" name="footer_slogan_ar" class="form-control"
                                           placeholder="Arabic" value="{{ setting('footer_slogan_ar', old('footer_slogan_ar')) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="footerAddress">Footer address</label>
                                <div class="input-group">
                                    <input type="text" name="footer_address"
                                           id="footerAddress"
                                           class="form-control"
                                           placeholder="English" value="{{ setting('footer_address', old('footer_address')) }}">

                                    <input type="text" name="footer_address_ar" class="form-control"
                                           placeholder="Arabic" value="{{ setting('footer_address_ar', old('footer_address_ar')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Menu --}}
                <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menuTab">
                    <div class="card mb-3 rounded-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush" id="sortable">
                                @foreach(SettingService::getMenu() as $menu)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <input type="hidden" name="menu[]" value="{{ $menu['name'] }}">
                                        {{ $menu['name'] }}
                                        <i class="fas fa-bars cursor-g"></i>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => url()->previous()
        ])
    </form>
@endsection

@push('scripts')
    <script>
        // Add sortable plugin (Drag'n'Drop)
        $( "#sortable" ).sortable();
    </script>
@endpush