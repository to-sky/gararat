@extends('website.layouts.master')

@section('title', $equipmentCategory->trans('name'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('category', $equipmentCategory) }}

        <h1 class="page-title">{{ $equipmentCategory->trans('name') }}</h1>

        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar-filter shadow-sm border-light-sm">
                    <div class="sidebar-filter__item">
                        @if ($qtyWithPromotion)
                            <div class="sidebar-filter__item">
                                <div class="sidebar-filter__item__filters">
                                    <div class="custom-control custom-checkbox sidebar-filter__item__filter">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               name="promotion"
                                               @if (request('promotion')) checked @endif
                                               id="promotionFilter">

                                        <label class="custom-control-label" for="promotionFilter">
                                            {{ __('Promotion') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <h4 class="sidebar-filter__item__title">{{ __('Categories') }}</h4>

                        <div class="sidebar-filter__item__filters">
                            @foreach($equipmentCategory->childs as $equipmentCategoryChild)
                                <div class="custom-control custom-checkbox sidebar-filter__item__filter">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           name="equipment_categories"
                                           data-equipment-category-id="{{ $equipmentCategoryChild->id }}"
                                           @if (request('equipment_categories') && in_array($equipmentCategoryChild->id, request('equipment_categories')))
                                           checked
                                           @endif
                                           id="equipment_category_{{ $equipmentCategoryChild->id }}">

                                    <label class="custom-control-label" for="equipment_category_{{ $equipmentCategoryChild->id }}">
                                        {{ $equipmentCategoryChild->trans('name') }}
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
        $('input[name="equipment_categories"]').change(function() {
            let equipmentCategories = [];

            $.each($('input[name="equipment_categories"]:checked'), function (i, el) {
                let id = parseInt($(el).data('equipment-category-id'));

                equipmentCategories.push(id);
            });

            if (equipmentCategories.length) {
                url.query["equipment_categories[]"] = equipmentCategories;

            } else {
                delete url.query["equipment_categories[]"];
            }

            getEquipment(1);
        });

        let promotionCheckbox = $('input[name="promotion"]');
        let promotionStatus = promotionCheckbox.prop('checked');

        // Filter by promotion
        promotionCheckbox.change(function() {
            promotionStatus = promotionCheckbox.prop('checked');

            if (promotionStatus) {
                url.query['promotion'] = 1;
                url.query.page = 1;
            } else {
                delete url.query['promotion'];
            }

            getEquipment(1);
        });

        // Change page
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            let pagination = new Url($(this).attr('href'));

            url.query.page = pagination.query.page;

            getEquipment();
        });

        // Show preloader
        function showPreloader() {
            let preloaderIcon = $('<i>', {class: 'fas fa-cog fa-spin text-danger'});
            let preloader =  $('<div>', {class: 'preloader'}).append(preloaderIcon);

            $('#equipmentContainer').prepend(preloader);

            preloader.fadeIn();
        }

        // Ajax get equipment and set updated url
        function getEquipment(resetPage = false) {
            if (resetPage) {
                url.query.page = 1;
            }

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
