@extends('website.layouts.master')

@section('title', __('Parts'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('parts') }}

        <h1 class="page-title">{{ __('Parts') }}</h1>

        <div class="row">
            {{-- Sidebar filters --}}
            <div class="col-lg-3">
                <div class="bg-white mb-3 p-3 shadow-sm text-muted border-light-sm d-lg-none d-flex justify-content-between"
                     id="mobileFilterContainer">
                    <span>{{ __('Filters') }}</span>
                    <i class="fas fa-sliders-h text-danger hover-cp" id="mobileFilter"></i>
                </div>

                <div class="mb-3 sidebar-filter shadow-sm border-light-sm d-lg-block" id="sidebarContainer" style="display: none;">
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

                                    <label class="custom-control-label" for="equipmentGroup_{{ $equipmentGroup->id }}">
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
                                           @if (request('catalogs')
                                                && array_intersect($catalog->childs->map->id->toArray(), request('catalogs'))
                                                || request('union')['catalogs']
                                                && array_intersect($catalog->childs->map->id->toArray(), request('union')['catalogs'])
                                           )
                                           checked
                                           @endif
                                           id="catalog_{{ $catalog->id }}">

                                    <label class="custom-control-label" for="catalog_{{ $catalog->id }}">
                                        {{ $catalog->trans('name') }}
                                    </label>

                                    @if($catalog->childs->isNotEmpty())
                                    <i class="fas fa-chevron-down text-danger hover-cp text-sm pt-1 float-{{ isLocaleEn() ? 'right' : 'left' }}"
                                       data-toggle="collapse"
                                       data-target="#collapseCatalog_{{ $catalog->id }}"
                                       aria-expanded="false"
                                       aria-controls="collapseCatalog_{{ $catalog->id }}">
                                    </i>

                                    <div class="sidebar-filter__item__filter__collapsed collapse" id="collapseCatalog_{{ $catalog->id }}">
                                        @foreach($catalog->childs as $catalogChild)
                                            <div class="custom-control custom-checkbox sidebar-filter__item__filter px-4">
                                                <input type="checkbox"
                                                       class="custom-control-input"
                                                       name="catalogs"
                                                       data-catalog-parent-id="{{ $catalog->id }}"
                                                       data-catalog-child-id="{{ $catalogChild->id }}"
                                                       @if (request('catalogs')
                                                            && in_array($catalogChild->id, request('catalogs'))
                                                            || request('union')['catalogs']
                                                            && in_array($catalogChild->id, request('union')['catalogs'])
                                                       )
                                                       checked
                                                       @endif
                                                       id="catalog_child_{{ $catalogChild->id }}">

                                                <label class="custom-control-label" for="catalog_child_{{ $catalogChild->id }}">
                                                    {{ $catalogChild->trans('name') }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-top p-3">
                        <button id="filtering" class="btn btn-block btn-outline-danger">{{ __('Filter') }}</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                {{-- Sort fields --}}
                <div class="parts-sorting shadow-sm">
                    <div class="d-flex flex-row">
                        <div class="form-inline">
                            <label for="price">{{ __('Sort by price') }}: &nbsp;</label>

                            <select name="price" id="price" class="custom-select custom-select-sm">
                                <option value="asc">{{ __('Cheaper first') }}</option>
                                <option value="desc" @if(request('price') == 'desc') selected @endif>
                                    {{ __('Expensive first') }}
                                </option>
                            </select>
                        </div>

                        <div class="form-inline px-4">
                            <label for="inStock">{{ __('Group by')  }}: &nbsp;</label>

                            <select name="inStock" id="inStock" class="custom-select custom-select-sm">
                                <option value="desc">{{ __('In stock') }}</option>
                                <option value="asc" @if(request('inStock') == 'asc') selected @endif>
                                    {{ __('By request') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- List of parts --}}
                <div id="partsTableContainer" class="position-relative">
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

            // On click parent catalog - check or uncheck all child inputs
            if($(this).data('catalog-id')) {
                let parentId = parseInt($(this).data('catalog-id'));
                $('#collapseCatalog_' + parentId).collapse('show');

                $(this).siblings('.fa-chevron-down').addClass('fa-chevron-up');

                checkOrUncheckParentWithChildsInputs(this)
            } else {
                // For childs inputs
                let parentId = parseInt($(this).data('catalog-parent-id'));
                let checkedChildsAmount = $('input[data-catalog-parent-id=' + parentId + ']:checked').length;
                let setParentCheckStatus = checkedChildsAmount > 0;

                $('input[data-catalog-id=' + parentId + ']').prop('checked', setParentCheckStatus);
            }

            // Add all checked catalog id's for filter
            $.each($('input[name="catalogs"]:checked'), function (i, el) {
                let childId = parseInt($(el).data('catalog-child-id'));

                if (! isNaN(childId)) {
                    checked.push(childId);
                }
            });

            catalogIds = unionData.catalogs = checked;

            filter();
        });

        // Check or uncheck all child catalogs inputs
        function checkOrUncheckParentWithChildsInputs(element) {
            let isCheckedParent = $(element).prop('checked');
            let parentCatalogId = $(element).data('catalog-id');

            $.each($('input[data-catalog-parent-id=' + parentCatalogId + ']'), function (i, el) {
                $(el).prop('checked', isCheckedParent);
            });
        }

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
        }

        let slideSpeed = 600;

        // Show/Hide filters on mobile
        $('#mobileFilter').click(function () {
            $('#sidebarContainer').slideToggle(slideSpeed);
        });

        // Change filter arrow side
        $('.fa-chevron-down').click(function () {
            $(this).toggleClass('fa-chevron-up')
        });

        // Click on the filter button
        $('#filtering').click(function () {
            if ($('#mobileFilterContainer').css('display') === 'block') {
                $('#sidebarContainer').slideUp(slideSpeed);
            }
            
            getParts();
        });

        // Show preloader
        function showPreloader() {
            let preloaderIcon = $('<i>', {class: 'fas fa-cog fa-spin text-danger'});
            let preloader =  $('<div>', {class: 'preloader'}).append(preloaderIcon);

            $('#partsTableContainer').prepend(preloader);

            preloader.fadeIn();
        }

        // Ajax get parts and set updated url
        function getParts() {
            $.ajax({
                url : url,
                cache: false,
                beforeSend: function() {
                    showPreloader();
                },
                success: function (data) {
                    $('#partsTableContainer').html(data);

                    window.history.replaceState(url.query, null, url);
                }
            });
        }
    </script>
@endpush