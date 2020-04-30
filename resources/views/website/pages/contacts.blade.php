@extends('website.layouts.master')

@section('title', __('Contacts'))

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@section('content')
    <div class="container pb-4">

        {{ Breadcrumbs::render('contacts') }}

        <h1 class="page-title">{{ __('Contact Us') }}</h1>

        <div class="bg-white shadow-sm contacts m-0  mb-5 row">
            <div class="col-12 col-lg-6 p-0">
                <div id="map"></div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="contacts__form p-4">
                    <form action="{{ route('contact-us') }}" method="post"
                          class="bg-white contact-us" id="contactFormPageForm">
                        @csrf

                        <div class="form-row form-group">
                            <div class="col-12">
                                <label for="name">{{ __('Name') }}*</label>
                                <input type="text" name="name" id="name" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col-12 col-lg-6">
                                <label for="email">{{ __('Email') }}*</label>
                                <input type="email" name="email" id="email" required>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="phone">{{ __('Phone') }}*</label>
                                <input type="text" name="phone" id="phone" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col-12">
                                <label for="message">{{ __('Message') }}*</label>
                                <textarea name="message" id="message" required></textarea>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col-md-8">
                                @if(env('GOOGLE_RECAPTCHA_KEY'))
                                    <div class="g-recaptcha"
                                         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                    </div>

                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="pt-3">
                                            <strong>{{ __('Are you a robot?') }}</strong>
                                        </span>
                                    @endif
                                @endif
                            </div>

                            <div class="col-4">
                                <button class="btn btn-outline-danger btn-lg" type="submit">{{ __('Send') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- TODO: change hardcode --}}
        <div class="row offices">
            @foreach($offices as $office)
                <div class="col-md-4">
                    <div class="office">
                        <h6 class="office__title">{{ translateArrayItem($office, 'name') }}</h6>

                        {{-- TODO: remove inline style and fix footer icons --}}
                        <div class="office__item">
                            <i class="fas fa-map-marker-alt footer-address-icon" style="@if(! $loop->last || ! isLocaleEn()) height: 25px; @endif"></i>
                            <span class="office__label">{{ translateArrayItem($office, 'address') }}</span>
                        </div>

                        <div class="office__item">
                            <i class="fas fa-envelope office__icon align-text-bottom"></i>
                            <a href="mailto:{{ $office['email'] }}" class="office__label">{{ $office['email'] }}</a>
                        </div>

                        @foreach($office['phones'] as $phone => $label)
                            <div class="office__item">
                                <i class="fas fa-phone office__icon align-baseline"></i>
                                <a href="tel:+{{ $phone }}" class="office__label">{{ $phone }} @if($label) ({{ $label }}) @endif</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Match height for address card
        $('.office').matchHeight();

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

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMap" async defer></script>
@endpush
