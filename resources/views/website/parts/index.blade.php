@extends('website.layouts.master')

@section('title') {{ __('Parts') }} @endsection

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('parts') }}

        <h1 class="page-title">{{ __('Parts') }}</h1>

        <div class="row mt-3">
            <div class="col-md-3">
                <div class="sidebar-filter shadow-sm border border-light-sm">
                    <div class="sidebar-filter__item">
                        <h4 class="sidebar-filter__item__title">{{ __('Equipment groups') }}</h4>

                        <div class="sidebar-filter__item__filters">
                            @foreach($equipmentGroups as $equipmentGroup)
                                <div class="custom-control custom-checkbox sidebar-filter__item__filter">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           name="equipmentGroups"
                                           data-equipment-group-id="{{ $equipmentGroup->id }}"
                                           @if (request('equipmentGroups') && in_array($equipmentGroup->id, request('equipmentGroups'))
                                                || request('union')['equipmentGroups'] && in_array($equipmentGroup->id, request('union')['equipmentGroups'])
                                                )
                                                checked
                                           @endif
                                           id="equipmentGroup_{{ $equipmentGroup->id }}">

                                    <label class="custom-control-label pl-3 text-muted" for="equipmentGroup_{{ $equipmentGroup->id }}">
                                        {{ $equipmentGroup->trans('name') }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-filter__item">
                        <h4 class="sidebar-filter__item__title">{{ __('Catalog') }}</h4>

                        <div class="sidebar-filter__item__filters">
                            @foreach($catalogs as $catalog)
                                <div class="custom-control custom-checkbox sidebar-filter__item__filter">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           name="catalogs"
                                           data-catalog-id="{{ $catalog->id }}"
                                           @if (request('catalog') && in_array($catalog->id, request('catalog'))
                                                || request('union')['catalogs'] && in_array($catalog->id, request('union')['catalogs'])
                                                )
                                                checked
                                           @endif
                                           id="catalog_{{ $catalog->id }}">

                                    <label class="custom-control-label pl-3 text-muted" for="catalog_{{ $catalog->id }}">
                                        {{ $catalog->trans('name') }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="mb-3 border border-light-sm shadow-sm">
                    <div class="row p-3 parts-sorting">
                        <div class="ml-4 form-inline">
                            <label for="price" class="parts-sorting__label">{{ __('Sort by price') }}: &nbsp;</label>
                            <select name="price" id="price" class="custom-select">
                                <option value="asc">{{ __('Cheaper first') }}</option>
                                <option value="desc" @if(request('price') == 'desc') selected @endif>
                                    {{ __('Expensive first') }}
                                </option>
                            </select>
                        </div>

                        <div class="ml-4 form-inline">
                            <label for="inStock" class="parts-sorting__label">{{ __('Group by')  }}: &nbsp;</label>
                            <select name="inStock" id="inStock" class="custom-select">
                                <option value="desc">{{ __('In stock') }}</option>
                                <option value="asc" @if(request('inStock') == 'asc') selected @endif>
                                    {{ __('By request') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="partsTableContainer">
                    @include('website.parts._parts_table')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let url = new Url;
        let body = $('body');

        // GroupBy "In stock" or "Request" and sortBy price
        body.on('change', '#inStock, #price', function() {
            // inStock filter must be first for correct working
            url.query.inStock = $('#inStock option:selected').val();
            url.query.price = $('#price option:selected').val();

            getParts();
        });

        // Change page
        body.on('click', '.pagination a', function(e) {
            e.preventDefault();

            let pagination = new Url($(this).attr('href'));

            url.query.page = pagination.query.page;

            getParts();
        });

        let unionData = {};
        let catalogIds = [];
        let equipmentGroupIds = [];

        // Filter by equipment groups
        $('input[name="equipmentGroups"]').change(function() {
            let checked = [];

            $.each($('input[name="equipmentGroups"]:checked'), function (i, el) {
                let id = parseInt($(el).data('equipment-group-id'));

                checked.push(id);
            });

            equipmentGroupIds = unionData.equipmentGroups = checked;

            filter();
        });

        // Filter by catalog
        $('input[name="catalogs"]').change(function() {
            let checked = [];

            $.each($('input[name="catalogs"]:checked'), function (i, el) {
                let id = parseInt($(el).data('catalog-id'));

                checked.push(id);
            });

            catalogIds = unionData.catalogs = checked;

            filter();
        });

        // Clear filter params, set pagination page is 1 and add new params
        function filter() {
            // Delete old attributes
            delete url.query['catalogs[]'];
            delete url.query['equipmentGroups[]'];
            delete url.query['union[catalogs][]'];
            delete url.query['union[equipmentGroups][]'];

            // Add query attributes
            if(catalogIds.length && equipmentGroupIds.length) {
                url.query['union[catalogs][]'] = unionData.catalogs;
                url.query['union[equipmentGroups][]'] = unionData.equipmentGroups;
            } else if (catalogIds.length) {
                url.query['catalogs[]'] = catalogIds;
            } else if (equipmentGroupIds.length) {
                url.query['equipmentGroups[]'] = equipmentGroupIds;
            }

            url.query.page = 1;

            getParts();
        }

        // Ajax get parts and set updated url
        function getParts() {
            $.ajax({
                url : url,
                cache: false,
            }).done(function (data) {
                $('#partsTableContainer').html(data);

                window.history.replaceState(url.query, null, url);
            });
        }
    </script>
@endpush