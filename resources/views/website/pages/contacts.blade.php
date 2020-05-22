@extends('website.layouts.master')

@section('title', __('Contacts'))

@section('content')
    <div class="container">

        {{ Breadcrumbs::render('contacts') }}

        <h1 class="page-title">{{ __('Contact Us') }}</h1>

        <div class="row contact-us__form-map">
            <div class="col-12 col-lg-6 p-0">
                <div id="map"></div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="pt-3 px-lg-3">
                    <form action="{{ route('contact-us') }}" method="post"
                          class="needs-validation contact-us__form" id="contactFormPageForm" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}*</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="col-12 col-lg-6 form-group">
                                <label for="email">{{ __('Email') }}*</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required>

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-lg-6 form-group">
                                <label for="phone">{{ __('Phone') }}*</label>
                                <input type="text" name="phone" id="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}" required>

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">{{ __('Message') }}*</label>
                            <textarea name="message" id="message"
                                      class="form-control @error('message') is-invalid @enderror"
                                        required>{{ old('message') }}</textarea>

                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="col-sm-9 form-group contact-us__form__recaptcha">
                                @if(env('GOOGLE_RECAPTCHA_KEY'))
                                    <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                                         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                    </div>

                                    @error('g-recaptcha-response')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-3 form-group contact-us__form__submit">
                                <button class="btn btn-outline-danger contact-us__form__submit-btn" type="submit">{{ __('Send') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-around">
            @foreach($offices as $office)
                <div class="col-md-6 col-lg-4">
                    <div class="contact" data-mh="contact">
                        <h6 class="contact__title">{{ translateArrayItem($office, 'name') }}</h6>

                        <div class="contact__item">
                            <i class="fas fa-map-marker-alt contact__icon"></i>
                            <a href="#" class="contact__label">{{ translateArrayItem($office, 'address') }}</a>
                        </div>

                        <div class="contact__item">
                            <i class="fas fa-envelope contact__icon"></i>
                            <a href="mailto:{{ $office['email'] }}" class="contact__label">{{ $office['email'] }}</a>
                        </div>

                        @foreach($office['phones'] as $phone => $label)
                            <div class="contact__item">
                                <i class="fas fa-phone contact__icon"></i>
                                <a href="tel:+{{ $phone }}" class="contact__label">{{ $phone }} @if($label) ({{ $label }}) @endif</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMap" async defer></script>

    <script>
        function initMap() {
            // Create a new StyledMapType object, passing it an array of styles,
            // and the name to be displayed on the map type control.
            var styledMapType = new google.maps.StyledMapType(
                [
                    {
                        "featureType": "poi",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "color": "#969696"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#d9e0db"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#e3e3e3"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#bebebe"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#5d636c"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#e1ecfc"
                            }
                        ]
                    }
                ],
                {name: 'Styled Map'});

            // TODO: remove hardcode
            var locations = [
                ['Cairo branch', 30.015417, 31.411944, 1],
                ['Alexandria branch', 31.169722, 29.890972, 2],
                ['Luxor branch', 25.716111, 32.650028, 3]
            ];

            // Create a map object, and include the MapTypeId to add
            // to the map type control.
            // var cairoBranch = {lat: 30.015417, lng: 31.411944};

            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(28.551272, 31.832508),
                zoom: 6,
                disableDefaultUI: true,
                // zoomControl: true,
            });

            // TODO: change hardcode
            // var contentString = '<div id="content">'+
            //     '<div id="siteNotice">'+
            //     '</div>'+
            //     '<h4 id="firstHeading" class="firstHeading">Head office</h4>'+
            //     '<div id="bodyContent">'+
            //     '<p>Villa 318, Al Showaifat region, Al Tagamoa AL Khames, 90th st., New Cairo-Egypt</p>'+
            //     '<p>+20-101-620-05-99</p>'+
            //     '<p>sales@gararat.com</p>'+
            //     '</div>'+
            //     '</div>';
            //
            var infowindow = new google.maps.InfoWindow({
                // content: contentString,
                // maxWidth: 200
            });
            //
            // var marker = new google.maps.Marker({
            //     position: myLatLng,
            //     map: map,
            //     title: 'Gararat'
            // });
            // marker.addListener('click', function() {
            //     infowindow.open(map, marker);
            // });

            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');

            // Zoom animation
            // map.addListener('center_changed', function() {
            //     // 3 seconds after the center of the map has changed, pan back to the
            //     // marker.
            //     window.setTimeout(function() {
            //         map.panTo(marker.getPosition());
            //     }, 3000);
            // });


            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        // Zoom on click marker
                        map.setZoom(15);
                        map.setCenter(marker.getPosition());

                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    </script>
@endpush
