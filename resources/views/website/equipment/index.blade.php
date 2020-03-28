@extends('website.layouts.master')

@section('title') {{ __('Equipment') }} @endsection

@section('content')
    <div class="container">
        <h1 class="page-title">{{ __('Equipment') }}</h1>

        <div class="row mt-3">
            <div class="col-md-3">
                <div class="sidebar-filter shadow-sm border border-light-sm">
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

                                    <label class="custom-control-label pl-3 text-muted" for="manufacturer_{{ $manufacturer->id }}">
                                        {{ $manufacturer->trans('name') }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row products" id="equipmentContainer">
                    @include('website.equipment._equipment_items', ['equipment' => $equipment])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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

        // Ajax get equipment and set updated url
        function getEquipment(url) {
            $.ajax({
                url : url,
                cache: false,
            }).done(function (data) {
                $('#equipmentContainer').html(data);

                history.replaceState(url.query, null, url);
            });
        }
    </script>
@endpush