@extends('website.layouts.master')

@section('title', __('Contacts'))

@section('content')
    <div class="modal fade" id="modalOffice" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content">
                <button type="button" class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-md-6 mx-3 mx-md-0" id="modalOfficeMap" style="height: 100%; min-height: 400px"></div>
                        <div class="col-md-6 p-3 mx-3 mx-md-0" id="modalOfficeContent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <div class="contact" data-mh="contact" data-toggle="modal"
                         data-target="#modalOffice" data-office-id="{{ $office->id }}"
                         data-lat="{{ $office->lat }}" data-lng="{{ $office->lng }}">
                        <h6 class="contact__title">{{ $office->trans('name') }}</h6>

                        <div class="contact__item align-items-baseline">
                            <i class="fas fa-map-marker-alt contact__icon"></i>
                            <span class="contact__label">{{ $office->trans('address') }}</span>
                        </div>

                        <div class="contact__item align-items-center">
                            <i class="fas fa-envelope contact__icon"></i>
                            <a href="mailto:{{ $office->email }}" class="contact__label">{{ $office->email }}</a>
                        </div>
                        @foreach($office->phones as $phoneData)
                            <div class="contact__item align-items-center">
                                <i class="fas fa-phone contact__icon"></i>
                                <a href="tel:+{{ $phoneData['phone'] ?? '' }}" class="contact__label">{{ $phoneData['phone'] ?? '' }}
                                    @if(isset($phoneData['phone_label']) || isset($phoneData['phone_label']))
                                        ({{ translateArrayItem($phoneData, 'phone_label') }})
                                    @endif
                                </a>
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
        // Init map
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

            var locations = Array();
            $.each(@json($offices), function (i, office) {
                var name = office["name{{ isLocaleEn() ? '' : '_ar' }}"];
                locations.push([
                    name, office['lat'], office['lng'], i+1
                ]);
            });

            // Main map
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(28.551272, 31.832508),
                zoom: 6,
                disableDefaultUI: false,
            });

            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');

            var marker, i;
            var infowindow = new google.maps.InfoWindow();
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                // Marker onmouseover event
                google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));

                // Marker click event
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

        // Get link to Google maps
        function navigate(lat, lng) {
            // If it's an iPhone..
            if ((navigator.platform.indexOf("iPhone") !== -1) || (navigator.platform.indexOf("iPod") !== -1)) {
                function iOSversion() {
                    if (/iP(hone|od|ad)/.test(navigator.platform)) {
                        // supports iOS 2.0 and later
                        var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
                        return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
                    }
                }
                var ver = iOSversion() || [0];

                var protocol = 'http://';
                if (ver[0] >= 6) {
                    protocol = 'maps://';
                }
                return protocol + 'maps.apple.com/maps?daddr=' + lat + ',' + lng + '&amp;ll=';
            }
            else {
                return 'http://maps.google.com?daddr=' + lat + ',' + lng + '&amp;ll=';
            }
        }

        // Show data in modal
        $('#modalOffice').on('show.bs.modal', function (e) {
            let button = $(e.relatedTarget); // Button that triggered the modal
            let officeContent = button.children().clone();
            let lat = button.data('lat');
            let lng = button.data('lng');

            let map;
            const mapOptions = {
                zoom: 8,
                center: { lat: lat, lng: lng },
                disableDefaultUI: true
            };
            map = new google.maps.Map(document.getElementById("modalOfficeMap"), mapOptions);
            const marker = new google.maps.Marker({
                position: {  lat: lat, lng: lng },
                map: map,
            });
            const infowindow = new google.maps.InfoWindow({
                content: "<a href='" + navigate(lat, lng) + "' target='_blank'>{{ trans('Open in Google maps') }}</a>",
            });
            google.maps.event.addListener(marker, "click", () => {
                infowindow.open(map, marker);
            });

            let modal = $(this);
            modal.find('#modalOfficeContent').html(officeContent)
        }).on('hidden.bs.modal', function (e) {
            $(this).find('#modalOfficeContent').html('')
        });

        // Stop propagation when click on tel or email in office card
        $('.contact a').click(function (e) {
            e.stopPropagation();
        });
    </script>
@endpush
