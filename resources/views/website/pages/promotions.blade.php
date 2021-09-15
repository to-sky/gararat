@extends('website.layouts.master')

@section('title', __('Promotions'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('promotions') }}

        <h1 class="page-title">{{ __('Promotions') }}</h1>

        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar-filter shadow-sm border-light-sm">
                    <div class="sidebar-filter__item">

                            <div class="sidebar-filter__item">
                                <div class="sidebar-filter__item__filters">
                                    <div class="custom-control custom-checkbox sidebar-filter__item__filter">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               name="product_type"
                                               data-product-type="parts"
                                               @if (request('product_type') == 'parts' ) checked @endif
                                               id="parts">

                                        <label class="custom-control-label" for="parts">
                                            {{ __('Parts') }}
                                        </label>
                                    </div>

                                    <div class="custom-control custom-checkbox sidebar-filter__item__filter">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               name="product_type"
                                               data-product-type="equipment"
                                               @if (request('product_type') == 'equipment') checked @endif
                                               id="equipment">

                                        <label class="custom-control-label" for="equipment">
                                            {{ __('Equipment') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div id="promotionItemsContainer">
                    @include('website.includes._promotion_items')
                </div>
            </div>
    </div>
@endsection

@push('scripts')
    <script>
        let url = new Url;
        let productTypeCheckboxes = $('input[name="product_type"]');

        // Filter by product type
        productTypeCheckboxes.change(function() {
            $this = this
            productTypeCheckboxes.each(function(i, el) {
                if ($this !== $(el).get(0)) {
                    $(el).prop('checked', false)
                }
            });

            if ($(this).prop('checked')) {
                url.query['product_type'] = $(this).data('product-type');
                url.query.page = 1;
            } else {
                $(this).prop('checked', false);
                delete url.query['product_type'];
            }

            getProducts(1);
        });

        // Change page
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            let pagination = new Url($(this).attr('href'));

            url.query.page = pagination.query.page;

            getProducts();
        });

        // Show preloader
        function showPreloader() {
            let preloaderIcon = $('<i>', {class: 'fas fa-cog fa-spin text-danger'});
            let preloader =  $('<div>', {class: 'preloader'}).append(preloaderIcon);

            $('#promotionItemsContainer').prepend(preloader);

            preloader.fadeIn();
        }

        // Ajax get equipment and set updated url
        function getProducts(resetPage = false) {
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
                    $('#promotionItemsContainer').html(data);

                    $('.promotion__item').matchHeight({
                        byRow: false
                    });

                    history.replaceState(url.query, null, url);
                }
            });
        }
    </script>
@endpush
