@extends('website.layouts.master')

@section('title', __('Equipment'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('equipment') }}

        <h1 class="page-title">{{ __('Equipment') }}</h1>

        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar-filter shadow-sm border-light-sm">
                    <div class="sidebar-filter__item">
                        <h4 class="sidebar-filter__item__title">{{ __('Manufacturers') }}</h4>

                        <div class="sidebar-filter__item__filters">
                            @foreach($manufacturers as $manufacturer)
                                <div class="custom-control custom-checkbox sidebar-filter__item__filter">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           name="manufacturers"
                                           data-manufacturer-id="{{ $manufacturer->id }}"
                                           @if (request('manufacturers') && in_array($manufacturer->id, request('manufacturers')))
                                               checked
                                           @endif
                                           id="manufacturer_{{ $manufacturer->id }}">

                                    <label class="custom-control-label" for="manufacturer_{{ $manufacturer->id }}">
                                        {{ $manufacturer->trans('name') }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div id="equipmentContainer">
                    @include('website.equipment._equipment_items', ['equipment' => $equipment])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Set same height for equipment card
        $('.equipment-card').matchHeight({
            byRow: false
        });

        let url = new Url;

        // Filter by manufacturers
        $('input[name="manufacturers"]').change(function() {
            let manufacturers = [];

            $.each($('input[name="manufacturers"]:checked'), function (i, el) {
                let id = parseInt($(el).data('manufacturer-id'));

                manufacturers.push(id);
            });

            if (manufacturers.length) {
                url.query["manufacturers[]"] = manufacturers;
            } else {
                delete url.query["manufacturers[]"];
            }

            getEquipment(url);
        });

        // Change page
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            let pagination = new Url($(this).attr('href'));

            url.query.page = pagination.query.page;

            getEquipment(url);
        });

        // Show preloader
        function showPreloader() {
            let preloaderIcon = $('<i>', {class: 'fas fa-cog fa-spin text-danger'});
            let preloader =  $('<div>', {class: 'preloader'}).append(preloaderIcon);

            $('#equipmentContainer').prepend(preloader);

            preloader.fadeIn();
        }

        // Ajax get equipment and set updated url
        function getEquipment(url) {
            $.ajax({
                url: url,
                cache: false,
                beforeSend: function () {
                    showPreloader();
                },
                success: function (data) {
                    $('#equipmentContainer').html(data);

                    $('.equipment-card').matchHeight({
                        byRow: false
                    });

                    history.replaceState(url.query, null, url);
                }
            });
        }
    </script>
@endpush